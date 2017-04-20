<?php defined('BASEPATH') OR exit('No direct script access allowed');    

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
	}

	public function tempUpdateAll()
	{
		$this->load->view('UpdateInterval');
	}

	public function contabDataCrawler()
	{
		if( !isset($_SESSION['accessToken']) )
		{
			return false;
		}

		$minute = date('i');

		write_file('last_crontab.txt',"\n"."--- RUN Crontab --- ".date('Y-m-d H:i:s')."\r\n",'a+');

		if($minute%30==0)
		{
			$result = $this->updateTrackingPage();
			write_file('last_crontab.txt',date('Y-m-d H:i:s')."  - update Page\r\n",'a+');
		}
		if($minute%7==0)
		{
			$result = $this->sweepFacebookPost(10,0);
			write_file('last_crontab.txt',date('Y-m-d H:i:s')."  - Sweep Post\r\n",'a+');
		}

		if($minute%1==0)
		{
			$result = $this->updateFacebookPost(40);
			write_file('last_crontab.txt',date('Y-m-d H:i:s')."  - update Post\r\n",'a+');
		}		
	}

	public function sweepFacebookPost( $limit , $offset )
	{
		// get active page
		$pageList = $this->Posts_model->getActivePagelist();

		// Get Post from active page
		foreach( $pageList as $page )
		{
			$page_id = $page->page_id;
			$raw_post_array = $this->kcl_facebook_analytic->getRawPostData( $page_id , $limit , $offset  );
		
			$raw_post_list = $raw_post_array['data'];

			// Extract data from facebook_api and save to database
			foreach ( $raw_post_list as $post ) 
			{
				$post = $this->extractPostData( $post );

				// Write log when can't get data from dacebook
				if ($post == false) 
				{
					write_file('last_crontab.txt',date('Y-m-d H:i:s')."  - Sweep Fail ".$post['page_id']."_".$post['post_id']."\r\n",'a+');
					continue;
				}
				$this->Posts_model->insertPostData( $post );
			}			
		}
	}

	public function extractPostData( $value )
	{
		$post_result = array(
			'page_id'       => '',
			'post_id'       => '',
			'type'          => '',
			'message'       => '',    
			'description'   => '',        
			'link'          => '', 
			'permalink_url' => '',          
			'object_id'     => '',      
			'picture'       => '',    
			'name'          => '', 
			'icon'          => '', 
			'shares'        => '0',   
			'comments'      => '0',
			'created_time'  => ''
			);

		$post_reaction = $this->kcl_facebook_analytic->getReactionPost( $value['id'] );

		// Case return error
		if ( is_object( $post_reaction ) ) 
		{
			return $post_reaction;
		}

		$post_result['reaction'] = $post_reaction;

		foreach( $value as $key => $inner_value)
		{
			if($key=='id')
			{ 
				$id = explode( '_' ,$inner_value );
				$post_result['page_id'] = $id[0]; 
				$post_result['post_id'] = $id[1];
			}

			elseif($key=='shares')
				{ $post_result[$key] = $inner_value['count']; }

			elseif($key=='comments')
				{ $post_result[$key] = $inner_value['summary']['total_count']; }

			elseif($key=='created_time')
			{ 
				$created_time = nice_date(  $inner_value, 'Y-m-d H:i');
				$post_result[$key] = $created_time; 
			}

			else
			{ 
				$inner_value = str_replace('"',"'",$inner_value);
				$post_result[$key] = $inner_value; 
			}

		}
		return $post_result;		
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
			print_r( $result );
			echo "<br><br><br>";
			$posts = $this->Posts_model->getSummaryPostsbyPageNameandTime( $page_id , $min_date , $max_date );
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
	}

	public function updateFacebookPost( $limit )
	{
		$total_result = array();
		$date = Date("Y-m-d 00:00:00");
		$postArray = $this->getLatedUpdatePost( $date , $limit );

		if( isset($_SESSION['accessToken']) )
		{
			foreach ($postArray as $value) 
			{
				// echo "<br><br>Last Update".$value->last_update_time."<br><br>";
				$post_id =  $value->page_id."_".$value->post_id;

				$post_reaction = $this->kcl_facebook_analytic->getReactionPost( $post_id );

				if ( is_object( $post_reaction ) ) 
				{
					write_file('last_crontab.txt',date('Y-m-d H:i:s')."  - Update Fail ".$post_id."\r\n",'a+');
					continue;
				}

				$post_reaction['last_update_time'] = Date("Y-m-d H:i:00");
				$post_reaction['post_id'] = $value->post_id;
				$post_reaction['created_time'] = nice_date(  $post_reaction['created_time'] , 'Y-m-d H:i:00');
				array_push( $total_result , $post_reaction );
			}
			if ( count( $total_result )!=0 ) {
				$this->Posts_model->updatePost( $total_result );
			} 
		}
		// echo json_encode( $total_result );
	}

	public function getLatedUpdatePost( $date , $limit )
	{
		$result = array();
		$data = $this->Posts_model->getLatedUpdatePost( $date , $limit );
		$data = $data->result();
		return $data;
	}

}
?>