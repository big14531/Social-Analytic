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

	public function ajaxDashboard()
	{
		$arrayPage = array();
		$arrayPageValue = array();

		$min_date = $this->input->post('min_date');
		$max_date = $this->input->post('max_date');
		$page_id = $this->input->post('page_id');

		$page_detail = $this->kcl_facebook_analytic->getFullPageDetail( $page_id );
		$postData = $this->Posts_model->getPageSummaryGroupbyDate( $page_id ,$min_date , $max_date );

		echo json_encode( array( $postData,$page_detail ) );
	}

	/**
	* [ajaxDashboardRankPost description]
	*
	*	Lazy too comment sry
	* 
	*/
	public function ajaxDashboardRankPost()
	{
		$result = array();
		$page_id = $this->input->post('page_id');
		$min_date = $this->input->post('min_date');
		$max_date = $this->input->post('max_date');


		$top_array = $this->Posts_model->getTopPostbyPageIDandDate( $page_id , $min_date , $max_date );
		$min_array = $this->Posts_model->getMinPostbyPageIDandDate( $page_id , $min_date , $max_date );

		array_push( $result , $top_array );
		array_push( $result , $min_array );

		echo json_encode( $result );
	}


	/* ---------------- analytic List Zone ---------------- */
	public function analyticList()
	{
		$this->load->view( 'AnalyticList_view' );
	}

	public function ajaxAnalyticList()
	{
		$result =[];
		$min_date = date("Y-m-25 00:00:00" );
		$max_date = date("Y-m-25 24:00:00" );
		$post_array = $this->Posts_model->getOwnerPostbyDate( $min_date , $max_date );

		echo json_encode( $post_array );
	}

	/* ---------------- Social Deck Zone ---------------- */

	/**
	* [socialDeck description]
	*
	* 		Load View
	*
	*/
	public function socialDeck()
	{
		$this->load->view( 'SocialDeck_view' );
	}

	/**
	* [ajaxFirstTimePost description]
	*
	*	Get Newest Post from database ( 15 Min ago )  
	* 
	* @return [json] [ post array ]
	*/
	public function ajaxFirstTimePost()
	{
		$result = array();
		$page_id = $this->input->post('page_id');
		foreach ($page_id as $value) 
		{
			$post_list = $this->Posts_model->getRecentPostbyPage( $value );
			array_push( $result, $post_list );
		}
		echo json_encode( $result );
	}

	/**
	* [ajaxEditPageCard description]
	*
	*	Get Newest Post ( One page ) and page data
	* 
	* @return [type] [description]
	*/
	public function ajaxEditPageCard()
	{
		$result = array();
		$page_id = $this->input->post('page_id');

		$post_list = $this->Posts_model->getRecentPostbyPage( $page_id );
		$page_data = $this->Posts_model->getPagebyPageID( $page_id );

		array_push( $result, $post_list );
		array_push( $result, $page_data );

		echo json_encode( $result );
	}

	public function ajaxGetNewPost()
	{
		$result = array();
		$page_id = $this->input->post('page_id');
		$min_date = $this->input->post('min_date');

		foreach ($page_id as $key => $value) 
		{
			$post_list = $this->Posts_model->getRecentPostbyPageandTime( $value  , $min_date[$key] );
			array_push( $result, $post_list );
		}
		
		echo json_encode( $result );
	}

	public function ajaxUpdatePost()
	{
		$result = array();
		$post_array = $this->input->post('post_array');
		$reaction = $this->kcl_facebook_analytic->batchUpdatePostFacebook( $post_array );
		echo json_encode( $reaction );

		// $batch = $this->Posts_model->editDataForUpdate( $reaction );
		// $this->Posts_model->updatePost( $batch );
	}

	public function ajaxGetHighlightPost()
	{
		$result = array();
		$page_id = $this->input->post('page_id');
		$time = date("Y-m-d H:i:s", strtotime('30 minutes ago') );
		foreach ($page_id as $key => $value) 
		{
			$post_list = $this->Posts_model->getBestReactionPostbyPageandTime( $value , $time );
			array_push( $result, $post_list );
		}
		
		echo json_encode( $result );
	}

	/* ---------------- Rank posts Zone ---------------- */

	/**
	* [dashboard description]
	*
	*		Index function
	* 
	*/
	public function rankPosts()
	{
		$this->load->view( 'RankPost_view' );
	}	

	/**
	* [ajaxRankPosts description]
	*
	*	Lazy too comment sry
	* 
	*/
	public function ajaxRankPost()
	{
		$result = array();
		$top_array = array();
		$min_array = array();
		$min_date = $this->input->post('min_date');
		$max_date = $this->input->post('max_date');

		$page_list = $this->Posts_model->getActivePagelist();

		foreach ($page_list as $value) 
		{
			$page_id = $value->page_id;
			$top_post_list = $this->Posts_model->getTopPostbyPageIDandDate( $page_id , $min_date , $max_date );

			$min_post_list = $this->Posts_model->getMinPostbyPageIDandDate( $page_id , $min_date , $max_date );

			array_push( $top_array , $top_post_list );
			array_push( $min_array , $min_post_list );
			
		}
		array_push( $result , $top_array );
		array_push( $result , $min_array );

		echo json_encode( $result );
	}

	/**
	* [ajaxGetActivePage description]
	*
	* 	Get active page 
	* 	
	*/
	public function ajaxGetActivePage()
	{
		$page_list = $this->Posts_model->getActivePagelist();
		echo json_encode( $page_list );
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
	public function postAnalytic( $page_id , $post_id , $keyword1 )
	{
		$data['id'] = array( 'page_id' => $page_id , 'post_id' => $post_id , 'keyword' => $keyword1 );
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
	public function removeUnnecessaryWord( $str_orignal )
	{
		if($str_orignal)
		{
			$nope_word = array('-','•','?',"&",".",'…','ฯ','ได้','ยัง','จึง','ไม่','ให้','กับ','แล้ว','และ','หรือ','ที่','คือ','!','#','$','%','*','()',')','“','”',"'",'"',"’","‘");
			$str_orignal=str_replace($nope_word,array(' '),$str_orignal);
			$str_orignal=@preg_replace('/[&\/\\#,+()$~%.\'"!:*?<>{}]/', ' ', $str_orignal);
		}
		return $str_orignal;
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
		$keyword = $_POST['keyword'];
		$result = array();
		$target_post = $this->Posts_model->getPostbyID( $page_id , $post_id );

		$target_post_date = date("Y-m-d",strtotime($target_post[0]->created_time));
		$min_date = $target_post_date." 00:00:00";
		$max_date = $target_post_date." 23:59:59";


	// 	WAIT FOR RECODE
	// 	
		// if ( $keyword[0]=='-' ) {
		// 				$regexp = substr( implode('|' ,$keyword),0,-1 );
		// 	$comp_post = $this->Posts_model->getPostbyTimeRangeandRegEx( addslashes($regexp) ,  $min_date , $max_date );



        // $target_text_raw = $target_post[0]->message.$target_post[0]->description.$target_post[0]->name;
		$target_text_raw = $target_post[0]->name.' '.$target_post[0]->description;
		$target_text_raw = $this->removeUnnecessaryWord($target_text_raw );
		$target_text = $this->splitThaiWord( $target_text_raw );
		$target_text_name_only = $this->splitThaiWord( $this->removeUnnecessaryWord($target_post[0]->name) );
        // $target_text_name_only=explode(' ', $this->removeUnnecessaryWord($target_post[0]->name));
        // if(count($target_text_name_only)<=3)
        // {
        //   $target_text_name_only = $this->splitThaiWord( $this->removeUnnecessaryWord($target_post[0]->name) );
        // }

        //
		$str_importan_word_raw='';
		$str_importan_word='';
		$array_importan_word=array();
		@preg_match_all( '/"([^"]+)"|“([^“]+)”|\'([^\']+)\'|‘([^‘]+)’/' ,$target_post[0]->description.' '.$target_post[0]->name, $match );
		if($match[0])
		{
			foreach($match[0] as $k =>$v)
			{
				$v=trim($v);
				$v=$this->removeUnnecessaryWord($v);
				$v_importan_word=explode(' ',$v);
				foreach($v_importan_word as $v_sub_word)
				{

					if($str_importan_word_raw)
					{
						$str_importan_word_raw.='|';
					}
					$str_importan_word_raw.=$v_sub_word;
					array_push($array_importan_word,$v_sub_word);
					array_push($array_importan_word,$v_sub_word."'");
					array_push($array_importan_word,$v_sub_word.'"');
					array_push($array_importan_word,"'".$v_sub_word);
					array_push($array_importan_word,'"'.$v_sub_word);
                  //--------------------------------------
					array_push($array_importan_word,$v_sub_word."’");
					array_push($array_importan_word,$v_sub_word.'”');
					array_push($array_importan_word,"‘".$v_sub_word);
					array_push($array_importan_word,'“'.$v_sub_word);
				}
			}
			$array_importan_word=array_unique($array_importan_word);
			$str_importan_word= implode('|', $array_importan_word);
			$target_text=array_merge($target_text,$array_importan_word);
		}
        //
		$word_space=$this->removeUnnecessaryWord($target_post[0]->message.' '.$target_post[0]->description.' '.$target_post[0]->name);
		$word_space=explode(" ",$word_space);
		$word_space=array_unique($word_space);
		$arr_word_space=array();
		foreach($word_space as $v)
		{
			if($v)
			{
				if(mb_strlen($v)>2 && mb_strlen($v)<=8)
					array_push($target_text,$v);
				array_push($arr_word_space,$v);
			}

		}
        //
		$target_text=array_unique($target_text);
        //clear empty array
		foreach($target_text as $k =>$v)
		{
			if(empty($v))
			{
				unset($target_text[$k]);
			}
			elseif(mb_strlen($v)<=1)
			{
				unset($target_text[$k]);
			}

		}
		$regexp = implode('|', $target_text);
		$comp_post = $this->Posts_model->getPostbyTimeRangeandRegEx( addslashes($regexp) ,  $min_date , $max_date );

		foreach($comp_post as $value)
		{

			$comp_text_raw = $value->name.' '.$value->description;
			if($str_importan_word)
			{
				$comp_text = $comp_text_raw;
			}
			else
			{
				$comp_text = $this->removeUnnecessaryWord($comp_text_raw);
			}

            //new analytic
			$v_check_match=preg_match_all('/'.$regexp.'/i',$comp_text, $match_count);
			$check_total_match=0;
			if(isset($match_count[0]))
			{
				$match_count[0]=array_unique($match_count[0]);

				$check_total_match=count($match_count[0]);
			}
			if( $check_total_match >=3)
			{

				array_push( $result , array ( $value, $check_total_match , "count"=>$check_total_match,"keyword"=>$regexp) );
			}
			elseif(!empty($str_importan_word_raw))
			{
				if(preg_match('/'.$str_importan_word_raw.'/i',$comp_text_raw))
				{
					array_push( $result , array ( $value, $check_total_match , "count"=>$check_total_match,"keyword"=>$regexp) );
				}
			}
		}

		$result = $this->sortNestArray( $result );
		$total_raw_result=count($result);
		if($total_raw_result>25)
		{
			foreach($target_text_name_only as $k =>$v)
			{
				if(mb_strlen($v)<=3)
				{
					unset($target_text[$k]);
				}
			}
			$regexp = implode('|', $target_text_name_only);
			foreach($result as $k =>$v)
			{
				if($k>24)
				{

					preg_match_all('/'.$regexp.'/i',$v[0]->name, $match_count);
					if(count(array_unique($match_count[0]))<=2)
					{

						if(!preg_match_all('/'.$str_importan_word.'/i',$v[0]->name.' '.$v[0]->description) || empty($str_importan_word))
						{
							unset($result[$k]);
						}
						else
						{
                  //echo($str_importan_word.'<br>');
						}
					}
					else
					{
              //print_r($match_count);
					}
				}
				else
				{

					preg_match_all('/'.$regexp.'/i',$v[0]->name, $match_count);

					if(count(array_unique($match_count[0]))<=2)
					{
                //print_r($match_count);
						if(!preg_match('/'.$str_importan_word.'/i',$v[0]->name.' '.$v[0]->description) || empty($str_importan_word) )
						{
							unset($result[$k]);
						}
						else
						{
                  //print_r($match_count);
						}
					}
					else
					{
                //print_r($v);
					}
				}
			}
		}
        //exit();

		$result = $this->sortNestArray( $result);
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

	/* ---------------- Deleted post Section ---------------- */

	/**
	* [postDeletedList description]
	*
	*
	*		Load deleted post View
	* 
	*/
	public function postManageList()
	{
		$this->load->view( 'ManagePosts_view' );
	}

	/**
	* [ajaxManageList description]
	*
	*		Callback for ajax 
	*		return data by json
	* 
	* @return [type] [json]
	*/
	public function ajaxManageList()
	{
		$data = $this->Posts_model->getAllDeletedPost();
		echo json_encode( $data );
	}

	/**
	* [ajaxSetActivePost description]
	*
	*
	* 
	* @param  [int] $post_id [ Get from POST methods ] 
	* @param  [int] $page_id [ Get from POST methods ]
	*/
	public function ajaxSetActivePost()
	{	
		$post_id = $this->input->post('post_id');
		$page_id = $this->input->post('page_id');
		$result = $this->Posts_model->setActivePost( $page_id , $post_id );
		echo json_encode( $page_id." ".$post_id );
	}


	/* ---------------- Post Rate post Section ---------------- */

	/**
	* [postDeletedList description]
	*
	*
	*		Load deleted post View
	* 
	*/
	public function summaryTable()
	{
		$this->load->view( 'SummaryPost_view' );
	}

	public function ajaxSummaryPost()
	{
		$result = array();

		$type = $this->input->post('type');
		$min_date = $this->input->post('min_date');
		$max_date = $this->input->post('max_date');
		$page_list = $this->Posts_model->getActivePagelist();
		// array_push( $result , $this->Posts_model->getAllPostsbyDate( $min_date , $max_date ); );
		foreach ($page_list as $value) 
		{
			$page_data = $this->Posts_model->getPagebyPageID( $value->page_id );
			array_push( $page_data , $this->Posts_model->getPageSummaryGroupbyHour( $value->page_id ,$min_date , $max_date ) );

			array_push( $result , $page_data );
		}
		

		echo json_encode( $result );
	}

	/* ---------------- User page Section ---------------- */

	/**
	 * [userPage description]
	 * 
	 */
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