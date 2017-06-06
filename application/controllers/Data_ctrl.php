<?php defined('BASEPATH') OR exit('No direct script access allowed');    

ini_set('max_execution_time', 600); 
ini_set('memory_limit','2048M');

class Data_ctrl extends CI_Controller
{

	function __construct()
	{

		parent::__construct(); 
		error_reporting(-1);
		ini_set('display_errors', 1);

		$this->load->library('Kcl_facebook_analytic'); 
		$this->load->model('Posts_model');
		$this->load->helper('date');
		$this->load->helper('file');
		$this->load->helper('analytic_helper');
		$this->daily_log = "logs/log-".date('Y-m-d').".txt";
	}

	public function tempUpdateAll()
	{
		echo "test path";
	}

	public function contabDataCrawler()
	{
		if( !isset($_SESSION['accessToken']) )
		{
			return false;
		}

		$minute = date('i');
		$hour = date('H');
		write_file($this->daily_log,"\n"."--- RUN Crontab --- ".date('Y-m-d H:i:s')."\r\n",'a+');
		
		if ($hour==='06') 
		{
			$result = $this->processAnalyticPost();
			if ( $result )
			{
				write_file($this->daily_log,date('Y-m-d H:i:s')."  - Analytic Post\r\n",'a+');
			}
		}

		if($minute%30==0)
		{	
			$result = $this->updateTrackingPage();
			if ( $result )
			{
				write_file($this->daily_log,date('Y-m-d H:i:s')."  - update Page\r\n",'a+');
			}
		}

		if($minute%4==0)
		{
			$result = $this->newSweepFacebookPost();
			if ( $result )
			{
				write_file($this->daily_log,date('Y-m-d H:i:s')."  - New Sweep Post\r\n",'a+');
			}
			$this->updateInsight();
		}

		if($minute%1==0)
		{
			$result = $this->updateBatchFacebookPost( 150 );
			if ( $result ) 
			{
				write_file($this->daily_log,date('Y-m-d H:i:s')."  - update Post\r\n",'a+');
			}
		}		
	}

	public function newSweepFacebookPost()
	{
		$page_array=[];
		$page_list = $this->Posts_model->getActivePagelist();


		// Get Post from active page
		foreach( $page_list as $page )
		{
			array_push( $page_array , $page->page_id );
		}

		$raw_post_array = $this->kcl_facebook_analytic->batchGetPostFacebook( $page_array );
		$result = $this->kcl_facebook_analytic->newExtractPostData( $raw_post_array );
		$this->Posts_model->insertBatchPost( $result );
		print_r( $result );

		return true;
	}

	public function updateTrackingPage()
	{
		$pageList = $this->Posts_model->getActivePagelist();
		$pageList = $pageList;
		$min_date = Date("Y-m-d 00:00");
		$max_date = Date("Y-m-d 24:00");
		$hour = Date("H");
		foreach( $pageList as $value )
		{
			$id = $value->id;
			$page_id = $value->page_id;
			$result = $this->kcl_facebook_analytic->getRawPageDetail( $page_id );
			$posts = $this->Posts_model->getSummaryPostsbyPageNameandTime( $page_id , $min_date , $max_date );
			$post_rate = $this->Posts_model->getYesterdayPostRate( $page_id );

			if ( is_array( $result )==false || $result['link']==false || $result['name']==false || $result['id']==false ) 
			{
				write_file($this->daily_log,date('Y-m-d H:i:s')."  - Page Error\r\n ".$result."\r\n",'a+');
				continue;
			}

			$post_rate = empty($post_rate)==1?0:$post_rate[0]->post_rate;

			$result['post_rate_p'] = $post_rate;
			$result['posts'] = $posts[0]->count;
			$result['shares'] = $posts[0]->shares;
			$result['comments'] = $posts[0]->comments;
			$result['likes'] = $posts[0]->likes;
			$result['love'] = $posts[0]->love;
			$result['wow'] = $posts[0]->wow;
			$result['haha'] = $posts[0]->haha;
			$result['sad'] = $posts[0]->sad;
			$result['angry'] = $posts[0]->angry;
			$result['post_rate'] = $posts[0]->count/$hour;
			
			$this->Posts_model->updateTrackingPage( $id , $result );     
			$this->Posts_model->updatePageLog( $result );

			/*----------------- For Debug ----------------*/
			// echo "<b>Update :".$value->name."</b><br>";
			// echo "Number Post : ". $result['posts']."<br>";
			// var_dump( $result );
			// echo "<br>";echo "<br>";echo "<br>";echo "<br>";
		}
		return true;
	}

	public function updateBatchFacebookPost( $limit=150 )
	{
		$post_array = [];
		$date = Date("Y-m-d 00:00:00" , strtotime("-1 days"));
		$post = $this->getLatedUpdatePost( $date , $limit );
		$page = $this->getAllPageFanpage();
		
		foreach ($post as $key => $value) 
		{
			$id = $value->page_id."_".$value->post_id;
			array_push( $post_array , $id );
		}
		$post_id_array = array_chunk( $post_array , 50 );
		
		foreach ($post_id_array as $value) 
		{
			$batch = $this->kcl_facebook_analytic->batchUpdatePostFacebook( $value );
			$result = $this->editDataForUpdate( $batch , $post , $page);
			if ( is_string( $result[0]) ) 
			{
				return;
			}
			$this->Posts_model->updatePost( $result );
			// print_r( $result );
		}
		return true;
	}

	public function getAllPageFanpage()
	{
		$result = [];
		$post = $this->Posts_model->getAllFanpage();
		foreach ($post as $key => $value) 
		{
			$result[ $value->page_id ] = $value->fan_count;
		}
		return $result;
	}

	public function editDataForUpdate( $data , $main_post , $page)
	{
		$result =[];
		foreach( $data as $key => $value)
		{	 
			if ( is_string($value) ) 
			{
				$del_count = $main_post[$key]->is_delete;
				$id = explode('_', $value );
				$this->Posts_model->setDeletedPost( $id[0] , $id[1] , $del_count );
				continue;
			}
			$post =[];
			$page_id	= explode("_", $value->id )[0];
			$post_id	= explode("_", $value->id )[1];
			$shares 	= intval( ( empty( $value->shares ) ? 0 : $value->shares->count ) );
			$comments 	= intval( ( empty( $value->comments ) ? 0 : $value->comments->summary->total_count ) );
			$likes 		= intval( ( empty( $value->like ) ? 0 : $value->like->summary->total_count ) );
			$love 		= intval( ( empty( $value->love ) ? 0 : $value->love->summary->total_count ) );
			$wow 		= intval( ( empty( $value->wow ) ? 0 : $value->wow->summary->total_count ) );
			$haha 		= intval( ( empty( $value->haha ) ? 0 : $value->haha->summary->total_count ) );
			$sad 		= intval( ( empty( $value->sad ) ? 0 : $value->sad->summary->total_count ) );
			$angry 		= intval( ( empty( $value->angry ) ? 0 : $value->angry->summary->total_count ) );
			$engage 	= $shares + $comments + $likes + $love + $wow + $haha + $sad + $angry;
			$fan_page 	= $page[$page_id];
			$engage 	= rankCriteriaCalculator( $engage , $fan_page );

			$post['shares'] 			= $shares;
			$post['comments'] 			= $comments;
			$post['likes'] 				= $likes;
			$post['love'] 				= $love;
			$post['wow'] 				= $wow;
			$post['haha'] 				= $haha;
			$post['sad'] 				= $sad;
			$post['angry'] 				= $angry;
			$post['last_update_time'] 	= Date("Y-m-d H:i:55");
			$post['page_id'] 			= $page_id;
			$post['post_id'] 			= $post_id;
			$post['is_delete'] 			= 0;
			$post['engage_rank'] 		= $engage;
			print_r( $post );
			array_push( $result , $post );
		}
		
		return $result;
	}

	public function getLatedUpdatePost( $date , $limit )
	{
		$result = array();
		$data = $this->Posts_model->getLatedUpdatePost( $date , $limit );
		$data = $data->result();
		return $data;
	}

	public function getOldPost( $date , $limit )
	{
		$result = array();
		$data = $this->Posts_model->getLatedUpdatePost( $date , $limit );
		$data = $data->result();
		return $data;
	}

	public function updateInsight()
	{
		$page_id = "208428464667";  //Komchudluk page_id
		$min_date = date( "Y-m-d 00:00:00" , strtotime( "yesterday" ) );

		// GET POST
		$main_post =  $this->Posts_model->getOwnerPostsbyPageNameandDate( $page_id , $min_date )->result();

		$post_id_array = [];
		foreach ($main_post as $key => $value) 
		{
			array_push( $post_id_array , $value->page_id.'_'.$value->post_id );
		}

		$post_id_array = array_chunk( $post_id_array , 50 , true );

		foreach ($post_id_array as $value) 
		{
			$result=[];
			$raw_post_array = $this->kcl_facebook_analytic->getInsightPost( $value );
			foreach ($raw_post_array as $inner_value) 
			{
				$id = explode('/', $inner_value->data[0]->id );
				$id = explode('_', $id[0] );
				$insight_data = $inner_value->data[0]->values[0]->value;
				$other_clicks = empty($insight_data->{'other clicks'})==1?0:$insight_data->{'other clicks'};
				$photo_view = empty($insight_data->{'photo view'})==1?0:$insight_data->{'photo view'};
				$link_clicks = empty($insight_data->{'link clicks'})==1?0:$insight_data->{'link clicks'};
				$total_click =  $other_clicks + $photo_view + $link_clicks;
				switch ( $total_click ) {
					case $total_click>20000:
						$total_click = 'A';
						break;
					case $total_click>10000:
						$total_click = 'B';
						break;
					case $total_click>5000:
						$total_click = 'C';
						break;
					case $total_click>1000:
						$total_click = 'D';
						break;
					case $total_click>500:
						$total_click = 'E';
						break;	
					case $total_click<500:
						$total_click = 'F';
						break;				
					default:
						$total_click = null;
						break;
				}
				$data['post_id'] = $id[1];
				$data['page_id'] = $id[0];
				$data['other_clicks'] = $other_clicks;
				$data['photo_view'] = $photo_view;
				$data['link_clicks'] = $link_clicks;
				$data['click_rank'] = $total_click;
				array_push( $result , $data );
			}
			// print_r( $result );
			$this->Posts_model->updateBatchOwnerPost( $result );
		}	
	}

	public function processAnalyticPost()
	{
		$this->load->library('THSplitLib/segment');
		$page_id = "208428464667";  //Komchudluk page_id
		$min_date = date( "Y-m-d 00:00:00" , strtotime( "yesterday" ) );
		$max_date = date( "Y-m-d 23:59:59" , strtotime( "yesterday" ) );

		// GET POST
		$main_post =  $this->Posts_model->getPostsbyPageNameandTimeForAnalytic( $page_id ,$min_date ,$max_date )->result();
		$target_post =  $this->Posts_model->getAllPostbyTime( $min_date ,$max_date );
		print_r( $main_post );
		foreach ($main_post as $key => $post_obj) 
		{
			$result = [];
			// print_r( $post_obj );
			// if( $post_obj->type!='link' )continue;
			$related_post_json = comparePostbyPostObj( $post_obj ,$target_post );
			// Uncomment for check output

			$result['post_id'] = $post_obj->post_id;
			$result['page_id'] = $post_obj->page_id;
		 	$result['related_post'] = $related_post_json;

			$this->Posts_model->insertBatchOwnerPost( [$result] );
			$this->Posts_model->setIsAnalytic( $post_obj->page_id , $post_obj->post_id );
		}
		return true;
	}

	public function tempUpdateSession()
	{
	// 	for ($i=15; $i <= 25 ; $i++) 
	// 	{ 
	// 		$post = $this->Posts_model->getPostsbyPageNameandTime( '208428464667' , '2017-05-'.$i.' 00:00:00' , '2017-05-'.$i.' 23:59:00' );
	// 		$out=[];
	// 		foreach ($post->result() as  $value) 
	// 		{
	// 			$item = file_get_contents("http://www.komchadluek.net/api/section?url=".$value->link);
	// 			$result =  json_decode( $item );
	// 			if (  $item=='null' || isset($result->error) )
	// 			{
	// 				continue;
	// 			}
	// 			echo $value->post_id." ".$result->section_name."<br>";
	// 			array_push( $out,['post_id'=>$value->post_id , 'session'=>$result->section_name] );
				
	// 		}
	// 		// print_r( $out );
	// 		$this->Posts_model->updatePost($out);
	// 	}
	}

	// Description
	// This Function use for track grow rate of post
	// And Result save in text file
	public function trackPostExperiment()
	{
		$post_array = [
			''
		];
		$batch = $this->kcl_facebook_analytic->batchUpdatePostFacebook( $post_array );


	}
}
?>