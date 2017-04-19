<?php defined('BASEPATH') OR exit('No direct script access allowed');    

class Home_ctrl extends CI_Controller
{

	/**
	* [__construct description]
	*
	* 		Home_ctrl Constructor
	*/
	function __construct()
	{
		parent::__construct(); 
		// error_reporting(-1);
		// ini_set('display_errors', 1);
		// print_r( $this->session->all_userdata() );
		// 
		$this->load->library('THSplitLib/segment'); 
		$this->load->library('Kcl_facebook_analytic'); 
		$this->load->model('Posts_model');
		$this->load->helper('date');
		isLoggedin($this->session->all_userdata());
	}
	
	/* ---------------- Dashboard Zone ---------------- */

	/**
	* [dashboard description]
	*
	*		Index function
	* 
	*/
	public function dashboard()
	{
		$this->load->view( 'Homepage_view' );
	}


	/* ---------------- Pagelist_view Zone ---------------- */

	/**
	* [pagelist description]
	*
	*		load Pagelist view
	* 		Get pagelist from model
	* 
	*/
	public function pagelist( $data=array() )
	{
		checkManagerAutho($this->session->all_userdata());
		$result = $this->Posts_model->getPagelist();
		$data['page_list'] = $result->result();
		$this->load->view( 'Pagelist_view' ,  $data );   
	}

	/**
	* [addPagelist description]
	*
	* 		Create new page
	* 		
	* @param  array  $pageName [ get from POST]
	* @return redirect to editPageList [description]
	* 
	*/
	public function addPagelist()
	{
		$array = array
		(
			'about' => '',
			'category_list' => null,
			'cover_photo' => '',
			'fan_count' => '',
			'link' => '',
			'name' => '',
			'website' => '',
			'page_id' => '',
			'picture' => ''
			);

		$pageName = $this->input->post('pageName');
		$result = $this->kcl_facebook_analytic->getRawPageDetail( $pageName );
		// var_dump( $result );

		if( is_string( $result ) )
		{
			$_SESSION['addPageError'] = $result;
			redirect('/editPageList');
		}
		else
		{
			$error = $this->Posts_model->insertPageDetail( $result );
			$_SESSION['addPageError'] = $error;
			redirect('/editPageList');
		}
	}

	/**
	* [editPagelist description]
	*
	*		Edit page attribute
	*		
	* @param link [ get from POST]
	* @param website [ get from POST]
	* @param page_id [ get from POST]
	* @param is_owner [ get from POST]
	* @return redirect to editPageList [description]
	* 
	*/
	public function editPagelist()
	{

		$link = $this->input->post('link');
		$website = $this->input->post('website');
		$id = $this->input->post('page_id');
		$is_owner = ( $this->input->post('is_owner')=='on'? 1:0 );

		$this->Posts_model->updateEditPage( $id , $link , $website , $is_owner );

		redirect('/editPageList');
	}

	/**
	* [toggleIsActivePage description]
	*
	*		Callback for set active/disabled page
	* 
	* @param  [type] $id        [description]
	* @param  [type] $is_active [description]
	* @return [type]            [description]	
	* 
	*/
	public function toggleIsActivePage( $id , $is_active )
	{
		$is_active = ($is_active == 1 ? 0 : 1);;
		$this->Posts_model->toggleIsActivePage( $id , $is_active );

		redirect('/editPageList');
	}

	/* ---------------- PostList_view Zone ---------------- */

	/**
	* [postList description]
	*
	*		Load postList View
	* 
	*/
	public function postList()
	{
		$result = $this->Posts_model->getActivePagelist();
		$data['page_list'] = $result;

		$this->load->view( 'PostList_view' ,  $data ); 
	}

	/**
	* [ajaxPostList description]
	*
	* 		Get All post by page name
	*
	*       *****   Used by "postList" and "postGraph" ******
	* 
	* @return [array] [echo json]
	*/
	public function ajaxPostList()
	{
		$result = array();

		$page_id = $_POST["page_id"];
		$min_date = date( $_POST["min_date"] );
		$max_date =  date( $_POST["max_date"] );

		$rawData = $this->Posts_model->getPostsbyPageNameandTime( $page_id , $min_date , $max_date);

		$result = $rawData->result();

		echo json_encode($result);
	}

	/* ---------------- PostGraph_view Section ---------------- */

	/**
	* [postGraph description]
	*
	* 		Load postList View
	* 
	*/
	public function postGraph()
	{
		$result = $this->Posts_model->getActivePagelist();
		$data['page_list'] = $result;

		$this->load->view( 'PostGraph_view' ,  $data ); 
	}


	/* ---------------- PostAnalytic_view Zone ---------------- */

	/**
	* [postAnalytic description]
	*
	*		Load postAnalytic View
	* 
	*/
	public function postAnalytic( $page_id , $post_id )
	{
		$data['id'] = array( 'page_id' => $page_id , 'post_id' => $post_id );
		$this->load->view( 'PostAnalytic_view' ,  $data ); 
	}

	/**
	* [splitThaiWord description]
	*
	*		Used for split Thai word
	*		Call external library
	* 	
	* @param  [type] $text [ raw text ]
	* @return [type] $splited [ split text]
	*/
	public function splitThaiWord( $text )
	{
		$result = array();
		$segment = new Segment();
		$splited = $segment->get_segment_array($text);

		return $splited;
	}

	/**
	* [removeUnnecessaryWord description]
	*
	*		Remove unnecessary work
	*
	* 		In array [nope_word]
	* 
	* @param  [type] $array [ array text ]
	* @return [type] $result [ output text ]
	*
	*/
	public function removeUnnecessaryWord( $array )
	{
		$nope_word = array( 'ฯ','และ','หรือ','ที่','คือ' );
		$result = array();
		foreach ($array as $value) 
		{
			if ( !in_array( $value, $nope_word ) ) 
			{
				array_push( $result , $value );
			}
		}
		return $result;
	}

	/**
	* [sortNestArray description]
	*
	* 		Sort array text 
	* 
	* @param  [type] $result [ array ]
	* @return [type] $arr_complete [ array ]
	*/
	public function sortNestArray( $result )
	{
		$arr_count_match=array();
		foreach($result as $k =>$v)
		{
			$arr_count_match[$k]=$v['count'];
		} 
		arsort($arr_count_match);
		$arr_complete=array();
		$i=0;
		foreach($arr_count_match as $k =>$v)
		{
			$arr_complete[$i][0]=$result[$k]['0'];
			$arr_complete[$i][1]=$result[$k]['1'];
			$arr_complete[$i]['count']=$result[$k]['count'];
			$i++;
		}

		return $arr_complete;
	}

	/**
	* [ajaxAnalyticPost description]
	*
	*		Callback for ajax 
	*		return data by json
	* 
	* @return [type] [json]
	*/
	public function ajaxAnalyticPost()
	{
		$page_id = $_POST['page_id'];
		$post_id = $_POST['post_id'];   

		$result = array();

		$target_post = $this->Posts_model->getPostbyID( $page_id , $post_id );

		$target_post_date = date("Y-m-d",strtotime($target_post[0]->created_time));
		$min_date = $target_post_date." 00:00:00";
		$max_date = $target_post_date." 23:59:59";

		$target_text_raw = $target_post[0]->name;
		$target_text = $this->splitThaiWord( $target_text_raw );
		$target_text = $this->removeUnnecessaryWord( $target_text );
		$regexp = implode('|', $target_text);



		$comp_post = $this->Posts_model->getPostbyTimeRangeandRegEx( $regexp ,  $min_date , $max_date );

		foreach ($comp_post as $value) 
		{
			$comp_text_raw = $value->name.$value->description;
			$comp_text = str_replace("!", " ", $comp_text_raw);
			$comp_text = $this->splitThaiWord( $comp_text );
			$match_count = array_intersect( $target_text , $comp_text  );

			if( count( $match_count ) >= 5 )
			{
				array_push( $result , array ( $value, $match_count , "count"=>count($match_count) ) );
			}

		}

		$result = $this->sortNestArray( $result );  

		$data['target_post'] = $target_post;
		$data['match_post'] = $result;

		echo json_encode( $data );
	}

	/* ---------------- Table page list Section ---------------- */

	/**
	* [showPageTable description]
	*
	*		Load PageTable_view View		
	*		
	*/
	public function showPageTable()
	{
		$this->load->view( 'PageTable_view' );
	}

	/**
	* [ajaxPageTable description]
	*
	*		Callback for ajax 
	*		return data by json
	* 
	* @return [type] [json]
	*/
	public function ajaxPageTable()
	{
		$min_date = $_POST['min_date'];
		$max_date = $_POST['max_date'];

		$result = $this->Posts_model->getActivePageSummary( $min_date , $max_date );
		echo json_encode( $result );
	}

	/* ---------------- Growth page Section ---------------- */

	/**
	* [growthPage description]
	*
	*		Load growthPage View		
	*		
	*/
	public function growthPage()
	{
		$result = $this->Posts_model->getActivePagelist();
		$data['page_list'] = $result;
		$this->load->view( 'GrowthPage_view',$data );
	}

	/**
	* [getGrowthPage description]
	*
	*		Callback for ajax 
	*		return data by json
	* 
	* @return [type] [json]
	*/
	public function ajaxGrowthPage()
	{
		$arrayPage = array();
		$arrayPageValue = array();

		$min_date = $_POST['min_date'];
		$max_date = $_POST['max_date'];

		$pageList = $this->Posts_model->getActivePagelist();


		foreach( $pageList as $value )
		{
			$arrayPageValue = array();
			$arrayPageFan = array();
			$arrayPagePost = array();

			$postData = $this->Posts_model->getPageSummaryGroupbyDate( $value->page_id ,$min_date , $max_date );
			$result = $this->Posts_model->getPageLog( $min_date , $max_date , $value->page_id );
			$result = $result->result();

			$arrayPageValue['id'] = $value->id;
			$arrayPageValue['page_name'] = $value->name;
			$arrayPageValue['page_id'] = $value->page_id;
			$arrayPageValue['picture'] = $value->picture;
			foreach( $result as $logValue )
			{
			// Multiple 1000 because flot graph need its.
				array_push( $arrayPagePost, array ( strtotime( $logValue->create_time )*1000 , $logValue->posts ) );
				array_push( $arrayPageFan, array ( strtotime( $logValue->create_time )*1000 , $logValue->fan_count ) );
			}

			foreach( $postData as $dailyData )
			{
				$dailyData->created_time = strtotime( $dailyData->created_time_out )*1000;
			}

			$arrayPageValue['posts_array'] = $arrayPagePost;
			$arrayPageValue['fan_array'] = $arrayPageFan;
			$arrayPageValue['post_data'] = $postData;
			array_push(  $arrayPage , $arrayPageValue );
		}
		echo json_encode( $arrayPage );
	}

	/* ---------------- User page Section ---------------- */

	public function userPage()
	{
		checkAdminAutho($this->session->all_userdata());
		$this->load->view( 'UserEdit_view' );
	} 

	public function initialize()
	{
		$result = array();
		$data = $this->Posts_model->getAllUser();

		foreach ($data as $key => $value  ) {
			$data[ $key ]->password = "Nope";
		}
		echo json_encode( $data );
	} 

	public function createUser()
	{
		$data = array(
			"user_name_surname" => $this->input->post('user_name_surname'),
			"username" => $this->input->post('username'),
			"password" => password_hash( $this->input->post('password') , PASSWORD_DEFAULT),
			"employee_code" => $this->input->post('employee_code'),
			"email" => $this->input->post('email'),
			"user_active" => $this->input->post('user_active'),
			"user_last_login" => date("Y-m-d 00:00:00"),
			"permission_user" => $this->input->post('autho_user'),
			"permission_manager" => $this->input->post('autho_manager'),
			"permission_admin" => $this->input->post('autho_admin')
			);



		$error = $this->Posts_model->createUser( $data );
		echo json_encode( $data );
	}

	public function editUser()
	{
		$id = $this->input->post('id');
		$data = array(
			"user_name_surname" => $this->input->post('user_name_surname'),
			"username" => $this->input->post('username'),
			"employee_code" => $this->input->post('employee_code'),
			"email" => $this->input->post('email'),
			"permission_user" => $this->input->post('autho_user'),
			"permission_manager" => $this->input->post('autho_manager'),
			"permission_admin" => $this->input->post('autho_admin')
			);

		$error = $this->Posts_model->editUser( $id , $data );
		echo json_encode( $data );
	}

	public function toggleIsActiveUser( $id , $is_active )
	{
		$is_active = ($is_active == 1 ? 0 : 1);
		$this->Posts_model->toggleIsActiveUser( $id , $is_active );
		redirect('/userPage');
	}

	public function changePassword()
	{
		$id = $this->input->post('id');
		$hash = password_hash( $this->input->post('password') , PASSWORD_DEFAULT);
		$data = array(
			"password" => $hash
			);

		$error = $this->Posts_model->editUser( $id , $data );
		// password_verify( '024204615' , $hash );

		echo json_encode( $error );
	}


}
?>