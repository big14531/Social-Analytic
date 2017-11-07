<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class FB_model extends CI_Model
{
	
	function isEmpty($result)
	{
		return ( $result->num_rows() > 0 ) ? $result->result() : false;
	}

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
		$this->load->helper('file');
	}
		
	public function insertPostData( $posts )
	{   

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

	public function insertCategory( $cat_name )
	{   
		$this->db->db_debug = FALSE;
		$check = $this->db->insert( 'fb_page_category' , ['id' => $cat_name , 'name' => $cat_name ] );
		if ($check===TRUE) 
		{
			return;
		}
		else	
		{
			$this->db->error();
			return "ERROR Already have this Category!!";
		}   
	}

	public function getCategorylist()
	{
		$result = $this->db->get( 'fb_page_category' );
		return $result->result();
	}
	
	public function getPagelist()
	{
		$result = array();
		$this->db->select('* ,list.id as id ,list.name as name,  cat.name as category_list');
		$this->db->from('fb_page_list as list'); 
		$this->db->join('fb_page_category as cat', 'list.category_list = cat.id' ,'left');
		$this->db->order_by('is_owner', 'DESC');
		$this->db->order_by('is_active', 'DESC');
		$result = $this->db->get();	

		return $this->isEmpty($result);
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
		$this->db->select('page_id,post_id,last_update_time,created_time,is_delete');
		$this->db->from('fb_facebook_post as post');
		$this->db->where('post.last_update_time >',$date);
		$this->db->where('post.created_time >',$date);
		$this->db->where('post.is_delete <',5);
		$result = $this->db->get();

		return $result;
	}

	public function getLatedCreatePost( $date )
	{
		$result = array();
		$this->db->order_by('created_time', 'DESC');
		$this->db->select('page_id,post_id,last_update_time,created_time,is_delete');
		$this->db->from('fb_facebook_post as post');
		$this->db->where('post.last_update_time >',$date);
		$this->db->where('post.created_time >',$date);
		$this->db->where('post.is_delete <',5);
		$result = $this->db->get();

		return $result;
	}

	public function insertKeyword( $keyword_list )
	{
		foreach ($keyword_list as $key => $value) 
		{	
			$keyword = $value['keyword'];
			$created_time = $value['created_time'];
			$this->db->select( 'keyword , created_time' );
			$this->db->from( 'keyword' ); 
			$this->db->where( 'created_time' , $created_time );
			$this->db->where( 'keyword' , $keyword );
			$is_insert = $this->db->get()->result();
			if( !$is_insert )
			{
				$this->db->insert( 'keyword' , $value );
			}
			
	   }
	}


	public function insertBatchOwnerPost( $data )
	{
		foreach ($data as $post) 
		{
			$insert_query = $this->db->insert_string('fb_owner_post', $post);
			$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
			$this->db->query($insert_query);			
		}
	}

	public function insertBatchPost( $data )
	{
		foreach ($data as $post) 
		{
			$insert_query = $this->db->insert_string('fb_facebook_post', $post);
			$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
			$this->db->query($insert_query);			
		}
	}

	public function updateBatchOwnerPost( $data )
	{
		$this->db->update_batch('fb_owner_post', $data, 'post_id');
	}

	public function updatePost( $data )
	{
		if($data)
		{
			foreach($data as $k =>$v)
			{
				$post_id=$v['post_id'];
				unset($v['post_id']);
				$this->db->update('fb_facebook_post', $v,array('post_id'=>$post_id));
			}
		}

		//$this->db->update_batch('fb_facebook_post', $data, 'post_id');

	}

	public function getActivePagelist()
	{
		$result = array();
		$this->db->where('is_active', '1');
		$result = $this->db->get( 'fb_page_list' );

		return $result->result();
	}

	public function getAllFanpage()
	{
		$this->db->select('page_id,fan_count');
		$this->db->where('is_active', '1');
		$result = $this->db->get( 'fb_page_list' );
		return $result->result();
	}

	public function insertPageDetail( $data , $category_name )
	{
		$this->db->db_debug = FALSE;

		$array = array
		(
			'about' => $data['about'],
			'category_list' => $category_name,
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

	public function updateEditPage( $id , $link , $website , $is_owner , $category_list )
	{
		$array = array
		(
			'link' => $link,
			'website' => $website,
			'is_owner' => $is_owner,
			'category_list' => $category_list	
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
			'post_rate_p' => $result['post_rate_p'],
			'picture' => $result['picture']['data']['url'],
			'rank' => $result['rank'],
			'avg_engagement' => $result['avg_engagement']
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

		$result = array();
		$this->db->order_by('create_time', 'ASC');
		$this->db->where('create_time >', $time);
		$this->db->where('page_id', $page);
		$result = $this->db->get( 'fb_page_log' );

		return $result;
	}

	public function getPagebyPageID( $page_id )
	{
		$result = array();
		$this->db->from('fb_page_list');
		$this->db->where('page_id',$page_id);
		$result = $this->db->get();
		return $result->result();
	}

	public function getTrendbyDate( $min_date , $max_date )
	{
		$result = array();
		$result = $this->db->query( " SET sql_mode = ''; " );
		$this->db->select( '*,count(intensive) as count' );
		$this->db->from('keyword');
		$this->db->where('created_time >',$min_date);
		$this->db->where('created_time <',$max_date);
		$this->db->group_by( 'keyword' );
		$this->db->order_by( 'count' , 'DESC' );
		$this->db->limit( 100 );
		$result = $this->db->get();

		return $result->result();
	}

	public function getTopPostbyPageIDandDate( $page_id , $min_date , $max_date )
	{
		$result = array();
		$query = "SELECT 
						* ,
						( shares+comments+likes+love+wow+haha+sad+angry ) as engage,
						( likes+love+wow+haha+sad+angry ) as reaction
					FROM  fb_facebook_post  
					WHERE  created_time  >= '".$min_date."' 
						AND created_time  <= '".$max_date."' 
						AND  page_id =".$page_id." 
					GROUP BY message
					ORDER BY engage DESC
					LIMIT 5";	
		$result = $this->db->query( " SET sql_mode = ''; " );
		$result = $this->db->query( $query );
		return $result->result();
	}

	public function getMinPostbyPageIDandDate( $page_id , $min_date , $max_date )
	{
		$result = array();
		$query = "SELECT 
					* ,
					( shares+comments+likes+love+wow+haha+sad+angry ) as engage,
					( likes+love+wow+haha+sad+angry ) as reaction
				FROM  fb_facebook_post  
				WHERE  created_time  >= '".$min_date."' 
					AND created_time  <= '".$max_date."' 
					AND  page_id =".$page_id." 
				ORDER BY engage ASC
				LIMIT 5";	

		$result = $this->db->query( $query );
		return $result->result();
	}

	public function setIsAnalytic( $page_id , $post_id )
	{
		$data = array
		(
			'is_analytic' => 1
			);
		$this->db->where( 'page_id' , $page_id );
		$this->db->where( 'post_id' , $post_id );
		$this->db->update( 'fb_facebook_post' , $data );
		
		return true;
	}

	public function getPostsbyPageNameandTimeForAnalytic( $page_id , $min_date , $max_date)
	{
		$result = array();

		$this->db->select('post.* , ( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage, , list.name as page_name');
		$this->db->from('fb_facebook_post as post'); 

		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id');
		$this->db->where('list.page_id',$page_id);
		$this->db->where('list.is_active',1);
		$this->db->where('post.is_delete<',5);
		$this->db->where('post.is_analytic',0);
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);

		$result = $this->db->get();

		return $result;
	}

	public function getSessionbyPageNameandTime( $page_id , $min_date , $max_date)
	{
		$result = array();

		$this->db->select('session , count(session) as count ,sum(owner.other_clicks+link_clicks+photo_view+video_play) as click , sum( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage , avg( owner.other_clicks+link_clicks+photo_view+video_play ) as click_avg , avg(  post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage_avg');
		$this->db->from('fb_facebook_post as post'); 
		$this->db->join('fb_owner_post as owner', 'post.post_id = owner.post_id');
		$this->db->where('post.page_id',$page_id);
		$this->db->where('post.is_delete<',5);
		// $this->db->where('post.engage_rank','B');
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);
		$this->db->where('post.session !=', null);
		$this->db->group_by( 'session' );
		$this->db->order_by( 'engage' , 'DESC' );

		$result = $this->db->get();

		return $result->result();
	}

	public function getEngageRankbySessionandRank( $page_id , $min_date , $max_date , $session_type , $alphabet)
	{
		$result = array();

		$this->db->select('post.engage_rank , count(engage_rank) as count');
		$this->db->from('fb_facebook_post as post'); 
		// $this->db->join('fb_owner_post as owner', 'post.post_id = list.post_id');
		$this->db->where('post.page_id',$page_id);
		$this->db->where('post.is_delete<',5);
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);
		$this->db->where('post.session ',$session_type);
		$this->db->where('post.engage_rank', $alphabet);
		$this->db->group_by( 'post.engage_rank' );

		$result = $this->db->get();

		return $result->result();
	}

	public function getClickRankbySessionandRank( $page_id , $min_date , $max_date , $session_type , $alphabet)
	{
		$result = array();

		$this->db->select('owner.click_rank , count( owner.click_rank ) as count , SUM( owner.other_clicks+link_clicks+photo_view+video_play ) as sum_click , SUM( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as sum_engage');
		$this->db->from('fb_facebook_post as post'); 
		$this->db->join('fb_owner_post as owner', 'post.post_id = owner.post_id');
		$this->db->where('post.page_id',$page_id);
		$this->db->where('post.is_delete<',5);
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);
		$this->db->where('post.session ',$session_type);
		$this->db->where('owner.click_rank ', $alphabet);
		$this->db->group_by( 'owner.click_rank' );

		$result = $this->db->get();

		return $result->result();
	}

	public function getOwnerPostsbyPageNameandDate( $page_id , $min_date)
	{
		$result = array();

		$this->db->select('owner.*');
		$this->db->from('fb_owner_post as owner'); 
		$this->db->where('owner.page_id',$page_id);
		$this->db->where('owner.created_time >',$min_date);
		$this->db->order_by('owner.updated_time', 'asc');
		$result = $this->db->get();

		return $result;
	}

	public function getPostsbyPageNameandTime( $page_id , $min_date , $max_date)
	{
		$result = array();

		$this->db->select('post.* , list.picture as page_logo , ( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage, , list.name as page_name');
		$this->db->from('fb_facebook_post as post'); 

		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id');
		$this->db->where_in('list.page_id',$page_id);
		$this->db->where('list.is_active',1);
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);
		$this->db->order_by('last_update_time', 'DESC');
		$this->db->limit( 2000 );
		$result = $this->db->get();

		return $result;
	}

	public function getAvgEngagementWeekAgo( $page_id )
	{
		$result = array();
		
		$min_date = Date("Y-m-d 00:00:00",strtotime("-7 days"));
		$max_date = Date("Y-m-d 23:59:59",strtotime("-1 days"));

		$this->db->select(' AVG( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as avg_engage , SUM( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as sum_engage');
		$this->db->from('fb_facebook_post as post'); 
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);
		$this->db->where('post.page_id',$page_id);
		$result = $this->db->get();

		return $result->result();
	}

	public function getYesterdayPostRate( $page_id )
	{
		$min_date = Date("Y-m-d 00:00:00",strtotime("-1 days"));
		$max_date = Date("Y-m-d 23:59:59",strtotime("-1 days"));

		$result = array();
		$this->db->select( "(posts/24) as post_rate" );
		$this->db->order_by('create_time', 'desc');
		$this->db->where('create_time >',$min_date);
		$this->db->where('create_time <',$max_date);
		$this->db->where('page_id', $page_id);
		$this->db->limit(1);
		$result = $this->db->get( 'fb_page_log' );

		return $result->result();
	}

	public function setDeletedPost( $page_id , $post_id , $error_count )
	{
		$data = array
		(
			'is_delete' => 1 + $error_count
			);
		$this->db->where( 'page_id' , $page_id );
		$this->db->where( 'post_id' , $post_id );
		$this->db->update( 'fb_facebook_post' , $data );
	}

	public function getSummaryPostsbyPageNameandTime( $page_id , $min_date , $max_date )
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

	public function getRecentPostbyPage( $page_id )
	{
		$result = array();

		$this->db->select( "* , ( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage, ( post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as interact" );
		$this->db->from('fb_facebook_post as post');
		$this->db->where('post.page_id ',$page_id);
		$this->db->order_by('created_time', 'DESC');
		$this->db->limit( 30 );
		// echo $this->db->get_compiled_select();
		// exit();
		$result = $this->db->get();

		return $result->result();
	}

	public function getRecentPostbyPagelist( $page_id_list )
	{
		$result = array();

		$this->db->select( "* ,( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage , list.picture as page_picture , post.picture as picture , post.name as name , (list.fan_count*(0.5/100) ) as min_rate " );
		$this->db->from('fb_facebook_post as post');
		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id','inner' );
		$this->db->where_in('post.page_id ',$page_id_list);
		// $this->db->having('engage > min_rate');
		$this->db->having('engage >', 500);
		$this->db->order_by('created_time', 'DESC');
		$this->db->limit( 100 );
		// echo $this->db->get_compiled_select();
		// exit();
		$result = $this->db->get();
		return $result->result();
	}

	public function getHighlightPostbyPagelist( $page_id_list )
	{
		$result = array();
		$this->db->select( "* ,( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage , list.picture as page_picture , post.picture as picture , post.name as name , (list.fan_count*(0.5/100) ) as min_rate " );
		$this->db->from('fb_facebook_post as post');
		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id','inner' );
		$this->db->where_in('post.page_id ',$page_id_list);
		$this->db->having('engage >', 1000);
		$this->db->order_by('created_time', 'DESC');
		$this->db->limit( 5 );
		$result = $this->db->get();
		return $result->result();
	}

	public function getPagebyKeywordandTime( $keyword , $min_date , $max_date )
	{
		$result = array();
		$this->db->select( "list.page_id , list.name , list.picture" );
		$this->db->from('fb_facebook_post as post');
		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id' );
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);
		$this->db->where( "(post.message LIKE '%".$keyword."%' OR post.name LIKE '%".$keyword."%' OR post.description LIKE '%".$keyword."%')", NULL, FALSE );
		$this->db->group_by( 'post.page_id' );
		$result = $this->db->get();	
		return $result->result();
	}

	public function getPostbyKeywordandTime ( $keyword , $min_date , $max_date )
	{
		$result = array(); 
		$this->db->select( "* ,( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage , ( post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as reaction" );
		$this->db->from('fb_facebook_post as post');
		$this->db->where('created_time >',$min_date);
		$this->db->where('created_time <',$max_date);
		$this->db->where( "(message LIKE '%".$keyword."%' OR name LIKE '%".$keyword."%' OR description LIKE '%".$keyword."%')", NULL, FALSE );
		$this->db->group_by( 'post.page_id' );
		$this->db->group_by( 'post.link' );
		$this->db->order_by('engage', 'DESC'); 

		// echo $this->db->get_compiled_select();
		// exit();
		$result = $this->db->get();

		return $result->result();
	}
	
	public function getBestReactionPostbyPageandTime ( $page_id , $time )
	{
		$result = array();
		$this->db->select( "* ,( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage , ( post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as reaction" );
		$this->db->from('fb_facebook_post as post');
		$this->db->where('post.page_id ',$page_id);
		$this->db->where('post.created_time >=',$time);
		$this->db->order_by('post.likes', 'DESC'); 
		$this->db->limit( 1 );
		// echo $this->db->get_compiled_select();
		// exit();
		$result = $this->db->get();

		return $result->result();
	}

	public function getRecentPostbyPageandTime( $page_id , $min_date )
	{
		$result = array();

		$this->db->select( "* , ( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage, ( post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as interact" );
		$this->db->from('fb_facebook_post as post');
		$this->db->where('post.page_id ',$page_id);
		$this->db->where('post.created_time >',$min_date);
		$this->db->order_by('created_time', 'DESC');
		// echo $this->db->get_compiled_select();
		// exit();
		$result = $this->db->get();

		return $result->result();
	}

	public function getPagebyCategory( $category_name  )
	{
		$result = array();
		$this->db->select('*');
		$this->db->from('fb_page_list as list');
		$this->db->where('list.category_list =',$category_name );
		// $this->db->join('fb_facebook_post as post', 'list.page_id = post.page_id','right' );
		// $this->db->where('post.created_time >',$min_date );
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

	public function getOwnerPostbyDate( $page_id , $min_date , $max_date )
	{
		$result = [];
		$this->db->select( "owner.*,post.*,( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage, (owner.link_clicks+owner.other_clicks+owner.photo_view+owner.video_play) as total_click" );
		$this->db->from('fb_facebook_post as post');
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);
		$this->db->where_in('post.page_id',$page_id);
		$this->db->join( 'fb_owner_post as owner', 'post.post_id = owner.post_id' );
		$this->db->order_by('post.created_time', 'DESC');

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
					count(case type when 'link' then 1 else null end) as link ,
					count(case type when 'video' then 1 else null end) as video ,
					count(case type when 'photo' then 1 else null end) as photo ,
					sum( comments ) as comments ,
					( sum(shares)+sum(comments)+sum(likes)+sum(love)+sum(wow)+sum(haha)+sum(sad)+sum(angry) ) as total,
					( sum(likes)+sum(love)+sum(wow)+sum(haha)+sum(sad)+sum(angry) ) as reaction,
					count( post_id ) as post_count
				FROM  fb_facebook_post  
				WHERE  created_time  >= '".$min_date."' 
					AND created_time  <= '".$max_date."' 
					AND  page_id =".$page_id." 
				GROUP BY created_time_out
				ORDER BY created_time_out DESC";	

		$result = $this->db->query( $query );

		return $result->result();
	}

	public function getPostbySessionPageTimeRank( $page_id , $session , $min_date , $max_date )
	{
		
		$result = array();
		$this->db->select('post.*, ( owner.other_clicks+link_clicks+photo_view+video_play ) as sum_click, owner.click_rank , ( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage , ( post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as interact ');
		$this->db->from('fb_facebook_post as post');
		$this->db->join('fb_owner_post as owner', 'post.post_id = owner.post_id');
		$this->db->where('post.page_id =',$page_id);
		$this->db->where('post.session =',$session);
		$this->db->where('post.is_delete <',5);
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);
		$result = $this->db->get(); 

		return $result->result();
	}

	public function getSessionSummaryGroupbyDate( $page_id , $session , $min_date , $max_date)
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
					count(case type when 'link' then 1 else null end) as link ,
					count(case type when 'video' then 1 else null end) as video ,
					count(case type when 'photo' then 1 else null end) as photo ,
					sum( comments ) as comments ,
					( sum(shares)+sum(comments)+sum(likes)+sum(love)+sum(wow)+sum(haha)+sum(sad)+sum(angry) ) as total,
					( sum(likes)+sum(love)+sum(wow)+sum(haha)+sum(sad)+sum(angry) ) as reaction,
					count( post_id ) as post_count
				FROM  fb_facebook_post  
				WHERE  created_time  >= '".$min_date."' 
					AND created_time  <= '".$max_date."' 
					AND  page_id =".$page_id." 
					AND  session ='".$session."'
					AND  is_delete <'5'
				GROUP BY created_time_out";	

		$result = $this->db->query( $query );

		return $result->result();
	}

	public function getPageSummaryGroupbyHour( $page_id , $min_date , $max_date)
	{
		$result = array();
		$query = "SELECT 
					page_id,
					DATE_FORMAT( created_time,  '%H' ) as created_time_out,
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
					count( post_id ) as posts
				FROM  fb_facebook_post as post
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

		$this->db->select('post.*,( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage, ( post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as interact  ,  list.name as page_name , list.picture as page_picture , list.link as page_link');
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

	public function getAllPostbyTime( $min_date , $max_date )
	{
		$result = array();

		$this->db->select('post.*,( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage, ( post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as interact  ,  list.name as page_name , list.picture as page_picture , list.link as page_link');
		$this->db->from('fb_facebook_post as post');

		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id','inner' );
		$this->db->where('list.is_active',1);
		$this->db->where('post.created_time >',$min_date);
		$this->db->where('post.created_time <',$max_date);
	  // echo $this->db->get_compiled_select();
	  //   exit()
		$result = $this->db->get();

		return $result->result();   
	}
	
	public function getPostbyID( $page_id , $post_id )
	{

		$result = array();
		$this->db->select('post.*, ( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage , ( post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as interact  , list.name as page_name , list.picture as page_picture , list.link as page_link');
		$this->db->from('fb_facebook_post as post');
		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id','inner' );
		$this->db->where('post.page_id =',$page_id);
		$this->db->where('post.post_id =',$post_id );
		$result = $this->db->get(); 

		return $result->result();
	}

	public function getPostbyArrayID( $id_array )
	{

		$result = array();
		$this->db->select('post.*, ( post.shares+post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as engage , ( post.comments+post.likes+post.love+post.wow+post.haha+post.sad+post.angry ) as interact  , list.name as page_name , list.picture as page_picture , list.link as page_link');
		$this->db->from('fb_facebook_post as post');
		$this->db->join('fb_page_list as list', 'post.page_id = list.page_id','inner' );
		$this->db->where_in('post.post_id',$id_array );
		$this->db->order_by( 'engage' ,'DESC');
		$result = $this->db->get(); 

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

	public function getAllDeletedPost()
	{
		$result = array();
		$this->db->order_by('last_update_time', 'DESC');
		$this->db->from('fb_facebook_post as post');
		$this->db->where('post.is_delete >',0);
		$result = $this->db->get();

		return $result->result();
	}

	public function setActivePost( $page_id , $post_id )
	{
		$data = array
		(
			'is_delete' => 0
			);
		$this->db->where( 'page_id' , $page_id );
		$this->db->where( 'post_id' , $post_id );
		$this->db->update( 'fb_facebook_post' , $data );
		
		return true;
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


	/////////////////////////////////////////////////////////////////////////////


	public function getTestPostID()
	{
		$result = array();
		$this->db->select('post_id');
		$this->db->from('tmp');
		$this->db->group_by('post_id');
		$result = $this->db->get();
		return $result->result();   
	}
	public function getTestPost( $post_id )
	{
		$result = array();
		$this->db->select('*');
		$this->db->from('tmp');
		$this->db->where('post_id' , $post_id);
		$result = $this->db->get();
		return $result->result();   
	}	

}
?>













