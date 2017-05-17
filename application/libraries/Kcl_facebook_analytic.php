<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once("Facebook/autoload.php");
error_reporting(E_ALL);

class Kcl_facebook_analytic
{

	protected $fb_obj;
	protected $helper;

	public function __construct()
	{
		$this->fb_obj= new Facebook\Facebook([
			'app_id' => '272658633175667',
			'app_secret' => 'dab47779eaca2c8d2deb8b5cc844a992',
			'default_graph_version' => 'v2.7'
			]);
		$this->getToken();
		$this->fb_obj->setDefaultAccessToken( $_SESSION['accessToken'] );
	}

	public function getToken()
	{
		$_SESSION['accessToken'] = "272658633175667|afmrK1I172gDdS-eXfc7jlJnzhU";
	}

	public function getRawPostData( $pageName , $limit , $offset=0 )
	{
		// echo '<h1>'.$pageName.'</h1>';

		/* API QUERY */
		$url = '/'.$pageName.'/posts?limit='.$limit.'
		&offset='.$offset.'
		&fields=
		id,
		link,
		picture,
		message,
		description,
		object_id,
		name,
		icon,
		created_time,
		permalink_url,
		shares,
		comments.limit(0).summary(true),
		type';

		$url = preg_replace('/\s+/', '', $url); 
		$res = $this->fb_obj->get( $url );
		return $res->getDecodedBody();
	}

	/* Get Reaction Count */
	public function getReactionPost( $post_id )
	{
		$result = array();
		try 
		{
			$react = $this->fb_obj->get( $post_id.'/?fields=created_time,reactions.type(LIKE).summary(total_count).limit(0).as(like),reactions.type(LOVE).summary(total_count).limit(0).as(love),reactions.type(WOW).summary(total_count).limit(0).as(wow),reactions.type(HAHA).summary(total_count).limit(0).as(haha),reactions.type(SAD).summary(total_count).limit(0).as(sad),reactions.type(ANGRY).summary(total_count).limit(0).as(angry),shares,comments.limit(0).summary(true)');
			$react = $react->getDecodedBody();
			foreach( $react as $key => $value)
			{
				if($key=='id')continue;
				elseif ($key=='like') { $result['likes'] = $value['summary']['total_count']; }
				elseif ($key=='created_time') { $result['created_time'] = $value; }
				elseif ($key=='shares') { $result['shares'] = $value['count']; }
				else{ $result[$key] = $value['summary']['total_count'];  }
			}
		} 
		catch (Exception $e) 
		{
			$result = $e;
		}

		return $result;
	}

	public function getRawPageDetail( $pageName )
	{
		$this->fb_obj= new Facebook\Facebook([
			'app_id' => '272658633175667',
			'app_secret' => 'dab47779eaca2c8d2deb8b5cc844a992',
			'default_graph_version' => 'v2.7'
			]);

		$this->fb_obj->setDefaultAccessToken( $_SESSION['accessToken'] );

		/* API QUERY */
		$url = '/'.$pageName.'
		?fields=
		about,
		fan_count,
		category_list,
		link,
		website,
		cover,
		name,
		picture{url}'
		;


		$url = preg_replace('/\s+/', '', $url);

		try {
			$res = $this->fb_obj->get( $url );
			$result = $res->getDecodedBody(); 
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			$result = $e->getMessage();
			return $result;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			$result = $e->getMessage();
			return $result;
		}
		$key = array('about',
			'fan_count',
			'category_list',
			'link',
			'website',
			'cover',
			'name',
			'picture');
		$result = $this->createEmptyKey( $key , $result );
		return $result;
	}

	public function getFullPageDetail( $pageName )
	{
		$this->fb_obj= new Facebook\Facebook([
			'app_id' => '272658633175667',
			'app_secret' => 'dab47779eaca2c8d2deb8b5cc844a992',
			'default_graph_version' => 'v2.7'
			]);

		$this->fb_obj->setDefaultAccessToken( $_SESSION['accessToken'] );

		/* API QUERY */
		$url = '/'.$pageName.'
		?fields=
		about,
		fan_count,
		category_list,
		link,
		website,
		cover,
		name,
		category,
		displayed_message_response_time,
		engagement,
		is_verified,
		verification_status,
		location,
		talking_about_count,
		picture.height(961){url}'
		;


		$url = preg_replace('/\s+/', '', $url);

		try {
			$res = $this->fb_obj->get( $url );
			$result = $res->getDecodedBody(); 
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			$result = $e->getMessage();
			return $result;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			$result = $e->getMessage();
			return $result;
		}
		$key = array('about',
			'fan_count',
			'category_list',
			'link',
			'website',
			'cover',
			'name',
			'category',
			'displayed_message_response_time',
			'engagement',
			'is_verified',
			'verification_status',
			'location',
			'talking_about_count',
			'picture');

		$result = $this->createEmptyKey( $key , $result );
		return $result;
	}

	public function createEmptyKey( $key , $data )
	{
		foreach( $key as $k_value )
		{
			$dataKey = array_keys( $data );
			if( in_array( $k_value , $dataKey ) == false)
			{
				$data[$k_value]=false;
			}
		}
		return $data;
	}

	public function batchGetPostFacebook( $page_array )
	{
		$result = [];
		$batch = [];

		$this->fb_obj= new Facebook\Facebook([
			'app_id' => '272658633175667',
			'app_secret' => 'dab47779eaca2c8d2deb8b5cc844a992',
			'default_graph_version' => 'v2.7'
			]);

		$this->fb_obj->setDefaultAccessToken( $_SESSION['accessToken'] );

		$request_field = '/posts?limit=10&fields=id,link,picture,message,description,object_id,name,icon,created_time,permalink_url,type,shares,comments.limit(0).summary(true),likes.limit(0).summary(true)';

		foreach ($page_array as $page_id) 
		{
			$page1 = $this->fb_obj->request('GET', '/'.$page_id.$request_field);
			array_push( $batch , array( $page_id =>  $page1 ) );
		}

		try {
			$responses = $this->fb_obj->sendBatchRequest($batch);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {

			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {

			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		foreach ($responses as $key => $response) {
			if ($response->isError()) {
				$e = $response->getThrownException();
			} else {
				array_push( $result , json_decode( $response->getBody() ) );
			}
		}
		return $result;
	}
	
	public function batchUpdatePostFacebook( $post_array )
	{
		$result = [];
		$batch = [];
		
		$this->fb_obj= new Facebook\Facebook([
			'app_id' => '272658633175667',
			'app_secret' => 'dab47779eaca2c8d2deb8b5cc844a992',
			'default_graph_version' => 'v2.7'
			]);

		$this->fb_obj->setDefaultAccessToken( $_SESSION['accessToken'] );

		$request_field = '/?fields=created_time,reactions.summary(total_count).as(reaction),reactions.type(LIKE).summary(total_count).limit(0).as(like),reactions.type(LOVE).summary(total_count).limit(0).as(love),reactions.type(WOW).summary(total_count).limit(0).as(wow),reactions.type(HAHA).summary(total_count).limit(0).as(haha),reactions.type(SAD).summary(total_count).limit(0).as(sad),reactions.type(ANGRY).summary(total_count).limit(0).as(angry),shares,comments.limit(0).summary(true)';

		foreach ($post_array as $post_id) 
		{
			$post1 = $this->fb_obj->request('GET', '/'.$post_id.$request_field);
			array_push( $batch , array( $post_id =>  $post1 ) );
		}
		
		try {
			$responses = $this->fb_obj->sendBatchRequest($batch);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {

			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {

			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		foreach ($responses as $key => $response) {
			if ($response->isError()) {
				$e = $response->getThrownException();
			} else {
				array_push( $result , json_decode( $response->getBody() ) );
			}
		}
		return $result;
	}

	public function newExtractPostData( $data )
	{
		$result=[];
		foreach ($data as $key => $value)
		{
			$post_list = $value->data;

			foreach ($post_list as $in_key => $post_data) 
			{
				$posts=[];
				
				$posts['created_time'] 	= nice_date(  $post_data->created_time, 'Y-m-d H:i');
				$posts['page_id'] 		= explode("_", $post_data->id )[0];
				$posts['post_id'] 		= explode("_", $post_data->id )[1];
				$posts['type'] 			= $post_data->type;
				$posts['message'] 		= ( empty($post_data->message) ) 		? '' : $post_data->message;
				$posts['description'] 	= ( empty($post_data->description) ) 	? '' : $post_data->description;
				$posts['link'] 			= ( empty($post_data->link) ) 			? '' : $post_data->link;
				$posts['permalink_url'] = ( empty($post_data->permalink_url) ) 	? '' : $post_data->permalink_url;
				$posts['object_id'] 	= ( empty($post_data->object_id) ) 		? '' : $post_data->object_id;
				$posts['picture'] 		= ( empty($post_data->picture) ) 		? '' : $post_data->picture; 
				$posts['name'] 			= ( empty($post_data->name) ) 			? '' : $post_data->name;
				$posts['icon'] 			= ( empty($post_data->icon) ) 			? '' : $post_data->icon;
				$posts['likes'] 		= ( empty($post_data->likes->summary->total_count) ) ? 0 : $post_data->likes->summary->total_count; 
				$posts['comments'] 		= ( empty($post_data->comments->summary->total_count) ) ? 0 : $post_data->comments->summary->total_count;
				$posts['shares'] 		= ( empty($post_data->shares->count) ) ? 0 : $post_data->shares->count;
				array_push( $result , $posts );
			}
		}
		return $result;
	}
}