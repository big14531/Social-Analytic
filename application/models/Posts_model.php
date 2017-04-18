<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Posts_model extends CI_Model
{
	var $query;
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	public function insertPostData( $posts )
	{   

		// var_dump( $posts );
		$data = array( 
			'page_id' => $posts['page_id'],
			'post_id' => $posts['post_id'],
			'type' => $posts['type'],
			'message' => $posts['message'],
			'description' => $posts['description'],
			'link' => $posts['link'],
			'permalink_url' => $posts['permalink_url'],
			'object_id' => $posts['object_id'],
			'picture' => $posts['picture'],
			'name' => $posts['name'],
			'icon' => $posts['icon'],
			'shares' => $posts['shares'],
			'comments' => $posts['comments'],
			'likes' => $posts['reaction']['likes'],
			'love' => $posts['reaction']['love'],
			'wow' => $posts['reaction']['wow'],
			'haha' => $posts['reaction']['haha'],
			'sad' => $posts['reaction']['sad'],
			'angry' => $posts['reaction']['angry'],
			'created_time' => $posts['created_time']
			);


		$query = "INSERT IGNORE INTO fb_facebook_post 
		(
		page_id,
		post_id,
		type,
		message,
		description,
		link,
		permalink_url,
		object_id,
		picture,
		name,
		icon,
		shares,
		comments,
		likes,
		love,
		wow,
		haha,
		sad,
		angry,
		created_time
		) 
		VALUES 
		(
		".$posts['page_id'].",
		".$posts['post_id'].",
		".'"'.$posts['type'].'"'.",
		".'"'.$posts['message'].'"'.",
		".'"'.$posts['description'].'"'.",
		".'"'.$posts['link'].'"'.",
		".'"'.$posts['permalink_url'].'"'.",
		".'"'.$posts['object_id'].'"'.",
		".'"'.$posts['picture'].'"'.",
		".'"'.$posts['name'].'"'.",
		".'"'.$posts['icon'].'"'.",
		".$posts['shares'].",
		".$posts['comments'].",
		".$posts['reaction']['likes'].",
		".$posts['reaction']['love'].",
		".$posts['reaction']['wow'].",
		".$posts['reaction']['haha'].",
		".$posts['reaction']['sad'].",
		".$posts['reaction']['angry'].",
		".'"'.$posts['created_time'].'"'."
		)";

		$this->db->query( $query );

		return true;
	}

	public function getPagelist()
	{
		$result = array();
		$this->db->order_by('is_owner', 'DESC');
		$this->db->order_by('is_active', 'DESC');
		$result = $this->db->get( 'fb_page_list' );

		return $result;
	}

	public function getPageID()
	{
		$result = array();

		$this->db->select('page_id');
		$this->db->where( 'is_active' , '1' );
		$result = $this->db->get( 'fb_page_list' );
		return $result;
	}

	public function getLatedUpdatePost( $date , $limit )
	{
		$result = array();
		$this->db->limit( $limit );
		$this->db->order_by('last_update_time', 'ASC');
		$this->db->select('page_id,post_id,last_update_time,created_time');
		$this->db->from('fb_facebook_post as post');
		$this->db->where('post.last_update_time >',$date);
		$this->db->where('post.created_time >',$date);
		$result = $this->db->get();

		return $result;
	}

	public function updatePost( $data )
	{
		$this->db->update_batch('fb_facebook_post', $data, 'post_id');
	}

	public function getActivePagelist()
	{
		$result = array();
		$this->db->where('is_active', '1');
		$result = $this->db->get( 'fb_page_list' );

		return $result->result();
	}

	public function insertPageDetail( $data )
	{
		$this->db->db_debug = FALSE;

		$array = array
		(
			'about' => $data['about'],
			/*'category_list' => $data['category_list']['0']['name'],*/
			'cover_photo' => $data['cover']['source'],
			'fan_count' => $data['fan_count'],
			'link' => $data['link'],
			'name' => $data['name'],
			'website' => $data['website'],
			'page_id' => $data['id'],
			'picture' => $data['picture']['data']['url']
			);

		$check = $this->db->insert( 'fb_page_list' , $array );

		if ($check===TRUE) 
		{
			return;
		}
		else
		{
			$this->db->error();
			return "ERROR Already have this Page!!";
		}   
	}

	public function updateEditPage( $id , $link , $website , $is_owner )
	{
		$array = array
		(
			'link' => $link,
			'website' => $website,
			'is_owner' => $is_owner
			);
		$this->db->where( 'id' , $id );
		$this->db->update( 'fb_page_list' , $array );
	}

	public function toggleIsActivePage( $id , $is_active )
	{
		$array = array
		(
			'is_active' => $is_active
			);
		$this->db->where( 'id' , $id );
		$this->db->update( 'fb_page_list' , $array );
	}

	public function updateTrackingPage( $id , $result )
	{
		$array1 = array
		(
			'about' => $result['about'],
			'cover_photo' => $result['cover']['source'],
			'fan_count' => $result['fan_count'],
			'link' => $result['link'],
			'name' => $result['name'],
			'website' => $result['website'],
			'page_id' => $result['id'],
			'picture' => $result['picture']['data']['url']
			);
		$this->db->where( 'id' , $id );
		$this->db->update( 'fb_page_list' , $array1 );
	}

	public function updatePageLog( $result )
	{
		$array2 = array
		(
			'page_id' => $result['id'],
			'fan_count' => $result['fan_count'] ,
			'posts' => $result['posts'] ,
			'shares' => $result['shares'],
			'comments' => $result['comments'],
			'likes' => $result['likes'],
			'love' => $result['love'],
			'wow' => $result['wow'],
			'haha' => $result['haha'],
			'sad' => $result['sad'],
			'angry' => $result['angry'],
			'post_rate' => $result['post_rate']
			);
		$this->db->insert( 'fb_page_log' , $array2 );
	}

	public function getPageLog( $min_date , $max_date , $page )
	{
		//  EXMAPLE JOIN TABLE
		// 
		// $result = array();
		// $this->db->select('*');
		// $this->db->from('fb_page_log as log');
		// $this->db->join('fb_page_list as list', 'list.page_id = log.page_id');
		// $this->db->order_by('log.create_time', 'ASC');
		// $this->db->where('log.create_time >', $time);
		// $this->db->where('log.page_id', $page);

		// $result = $this->db->get();

		// return $result;

		$result = array();
		$this->db->order_by('create_time', 'ASC');
		$this->db->where('create_time >', $min_date);
		$this->db->where('create_time <', $max_date);
		$this->db->where('page_id', $page);
		$result = $this->db->get( 'fb_page_log' );

		return $result;
	}

	public function getPostRateLog( $page )
	{
		//  EXMAPLE JOIN TABLE
		// 
		// $result = array();
		// $this->db->select('*');
		// $this->db->from('fb_page_log as log');
		// $this->db->join('fb_page_list as list', 'list.page_id = log.page_id');
		// $this->db->order_by('log.create_time', 'ASC');
		// $this->db->where('log.create_time >', $time);
		// $this->db->where('log.page_id', $page);

		// $result = $this->db->get();

		// return $result;

		$result = array();
		$this->db->order_by('create_time', 'ASC');
		$this->db->where('create_time >', $time);
		$this->db->where('page_id', $page);
		$result = $this->db->get( 'fb_page_log' );

		return $result;
	}

	public function getPostsbyPageNameandTime( $page_id , $min_date , $max_date)
	{
		$result = array();

		$this->db->select('post.*, list.name as page_name');
		$this->db->from('fb_facebook_post as post');

		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id');
		$this->db->where('list.page_id',$page_id);
		$this->db->where('list.is_active',1);
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);

		$result = $this->db->get();

		return $result;
	}

	public function getSummaryPostsbyPageNameandTime( $page_id , $min_date , $max_date)
	{
		$result = array();
		$this->db->select_sum( 'shares' );
		$this->db->select_sum( 'comments' );
		$this->db->select_sum( 'likes' );
		$this->db->select_sum( 'love' );
		$this->db->select_sum( 'wow' );
		$this->db->select_sum( 'haha' );
		$this->db->select_sum( 'sad' );
		$this->db->select_sum( 'angry' );
		$this->db->select( "COUNT(page_id) as count" );

		$this->db->from('fb_facebook_post');
		$this->db->where('page_id',$page_id );
		$this->db->where('created_time >',$min_date);
		$this->db->where('created_time <',$max_date);

		$result = $this->db->get();

		return $result->result();
	}

	public function getActivePageSummary( $min_date , $max_date)
	{
		$result = array();

		$this->db->select_sum( 'shares' );
		$this->db->select_sum( 'comments' );
		$this->db->select_sum( 'likes' );
		$this->db->select_sum( 'love' );
		$this->db->select_sum( 'wow' );
		$this->db->select_sum( 'haha' );
		$this->db->select_sum( 'sad' );
		$this->db->select_sum( 'angry' );
		$this->db->select( "list.* , COUNT(post.post_id) as count" );

		$this->db->from('fb_facebook_post as post');
		$this->db->group_by('list.page_id');
		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id' , 'INNER');
		$this->db->where('list.is_active',1);
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);
		// echo $this->db->get_compiled_select();
		// exit();
		$result = $this->db->get();

		return $result->result();
	}

	public function getPageSummaryGroupbyDate( $page_id , $min_date , $max_date)
	{
		$result = array();
		$query = "SELECT 
					page_id,
					DATE_FORMAT( created_time,  '%Y-%m-%d' ) as created_time_out,
					sum(likes) as likes, 
					sum( love ) as love ,
					sum( wow ) as wow ,
					sum( haha ) as haha ,
					sum( sad ) as sad ,
					sum( angry ) as angry ,
					sum( shares ) as shares ,
					sum( comments ) as comments ,
					( sum(shares)+sum(comments)+sum(likes)+sum(love)+sum(wow)+sum(haha)+sum(sad)+sum(angry) ) as total,
					( sum(likes)+sum(love)+sum(wow)+sum(haha)+sum(sad)+sum(angry) ) as reaction,
					count( post_id ) as post_count
				FROM  fb_facebook_post  
				WHERE  created_time  >= '".$min_date."' 
					AND created_time  <= '".$max_date."' 
					AND  page_id =".$page_id." 
				GROUP BY created_time_out";	

		$result = $this->db->query( $query );

		return $result->result();
	}

	public function getPostbyTimeRangeandRegEx( $RegEx , $min_date , $max_date )
	{
		$result = array();

		$this->db->select('post.*, list.name as page_name , list.picture as page_picture , list.link as page_link');
		$this->db->from('fb_facebook_post as post');

		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id','inner' );
		$this->db->where('list.is_active',1);
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);
		$this->db->where("post.message REGEXP'(".$RegEx.")'");
	  // echo $this->db->get_compiled_select();
	  //   exit()
		$result = $this->db->get();

		return $result->result();   
	}

	public function getPostbyID( $page_id , $post_id )
	{

		$result = array();
		$this->db->select('post.*, list.name as page_name , list.picture as page_picture , list.link as page_link');
		$this->db->from('fb_facebook_post as post');
		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id','inner' );
		$this->db->where('post.page_id =',$page_id);
		$this->db->where('post.post_id =',$post_id );
		$result = $this->db->get(); 


	   //  $result = array();
	   // $this->db->from('fb_facebook_post');
	   // $this->db->where('page_id =',$page_id);
	   // $this->db->where('post_id =',$post_id );
	   // $result = $this->db->get();

		return $result->result();
	}

	public function getAllUser()
	{
		$result = array();
		$this->db->from('fb_user');
		$result = $this->db->get(); 
		return $result->result(); 
	}

	public function createUser( $data )
	{
		$check = $this->db->insert( 'fb_user' , $data );
		return $check;
	}

	public function editUser( $id , $data )
	{
		$this->db->where( 'user_id' , $id );
		$check = $this->db->update( 'fb_user' , $data );
		return $check;
	}

	public function toggleIsActiveUser( $id , $is_active )
	{
		$array = array
		(
			'user_active' => $is_active
			);
		$this->db->where( 'user_id' , $id );
		$this->db->update( 'fb_user' , $array );
	}

}














