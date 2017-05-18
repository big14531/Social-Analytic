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

		write_file($this->daily_log,"\n"."--- RUN Crontab --- ".date('Y-m-d H:i:s')."\r\n",'a+');

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
		}

		if($minute%1==0)
		{
			$result = $this->updateBatchFacebookPost(50);
			$result1 = $this->updateBatchFacebookPost(50);
			if ( $result && $result1 ) 
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

	public function updateFacebookPost( $limit )
	{
		$total_result = array();
		$date = Date("Y-m-d 00:00:00" , strtotime("-1 days"));
		
		$postArray = $this->getLatedUpdatePost( $date , $limit );

		if( isset($_SESSION['accessToken']) )
		{
			foreach ($postArray as $value) 
			{
				// echo "<br><br>Last Update".$value->last_update_time."<br><br>";
				$error_count = $value->is_delete;
				$post_id =  $value->page_id."_".$value->post_id;

				$post_reaction = $this->kcl_facebook_analytic->getReactionPost( $post_id );
				print_r( $value );
				echo "<br><br><br>";

				// incresing delete score
				if ( is_object( $post_reaction ) ) 
				{
					$this->Posts_model->setDeletedPost( $value->page_id , $value->post_id , $error_count );
					write_file($this->daily_log,date('Y-m-d H:i:s')."  - Update Fail ".$post_id."\r\n",'a+');
					continue;
				}

				$post_reaction['last_update_time'] = Date("Y-m-d H:i:00");
				$post_reaction['post_id'] = $value->post_id;
				$post_reaction['created_time'] = nice_date(  $post_reaction['created_time'] , 'Y-m-d H:i:00');
				$post_reaction['is_delete'] = 0;
				array_push( $total_result , $post_reaction );
			}
			if ( count( $total_result )!=0 ) {
				$this->Posts_model->updatePost( $total_result );
			} 
		}
		return true;
	}

	public function updateBatchFacebookPost( $limit=40 )
	{
		$post_array = [];
		$date = Date("Y-m-d 00:00:00" , strtotime("-1 days"));
		$post = $this->getLatedUpdatePost( $date , $limit );

		foreach ($post as $key => $value) 
		{
			$id = $value->page_id."_".$value->post_id;
			array_push( $post_array , $id );
		}

		$batch = $this->kcl_facebook_analytic->batchUpdatePostFacebook( $post_array );
		$result = $this->Posts_model->editDataForUpdate( $batch );

		$this->Posts_model->updatePost( $result );
		return true;
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

	public function processAnalyticPost()
	{
		// Innitialize value 
		$this->load->library('THSplitLib/segment');
		$this->load->helper('analytic_helper');
		$page_id = "208428464667";  //Komchudluk page_id
		$min_date = date( "Y-m-d 00:00:00" , strtotime( "yesterday" ) );
		$max_date = date( "Y-m-d H:i:s" , strtotime( "now" ) );

		// GET POST
		$main_post =  $this->Posts_model->getPostsbyPageNameandTime( $page_id ,$min_date ,$max_date );
		$target_post =  $this->Posts_model->getAllPostbyTime( $min_date ,$max_date );
		
		$main_post = $main_post->result();

		$post_id_array = [];
		$i=0;
		foreach ($main_post as $key => $post_obj) 
		{
			if( $post_obj->type!='link' )continue;
			$compared_post = comparePostbyPostObj( $post_obj ,$target_post );
			$i+=1;
			if ($i==30) {
				break;
			}
		}
		
		


		// PUT IN ANALYTIC FUN

		// INSERT TO DB
	}
}
?>