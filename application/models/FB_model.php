<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class FB_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('file');
	}
	
	public function getPersonalPagelist( $user_id )
	{
		$result = array();
		$this->db->select('*,
			user.is_active as is_active,
			page.page_id as id,
			page.name as name,
			page.fan_count as fan_count,
			page.website as website,
			page.name as name,
			cat.name as category_list
			');
		$this->db->from('global_user_to_page as user'); 
		$this->db->join('fb_page_list as page', 'user.page_id = page.page_id' ,'left');
		$this->db->join('fb_page_category as cat', 'page.category_list = cat.id' ,'left');
		$this->db->where( 'user.user_id' , $user_id );
		$this->db->where( 'page.is_active' , 1 );
		$result = $this->db->get();	

		return $result->result();
	}
	
	public function insertFacebookPage( $data , $category_name , $user_id )
	{
		$this->db->db_debug = FALSE;
		$global = array
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

		$personal = array
		(
			'user_id' => $user_id,
			'page_id' => $data['id'],
			'type' => 'facebook'
			);

		// Add page to global
		$this->db->insert( 'fb_page_list' , $global );

		// Add page to global
		$check = $this->db->insert( 'global_user_to_page' , $personal );

		if ($check!==TRUE) 
		{
			return;
		}
		else
		{
			return $this->db->error();
		}   
	}

	public function toggleIsActivePage( $page_id , $user_id  , $is_active )
	{
		$array = array
		(
			'is_active' => $is_active
			);
		$this->db->where( 'page_id' , $page_id );
		$this->db->where( 'user_id',$user_id);
		$this->db->update( 'global_user_to_page' , $array );
	}
}
?>













