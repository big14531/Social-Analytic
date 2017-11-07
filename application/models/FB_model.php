<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class FB_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('file');
	}
	
	public function getPersonalPagelist()
	{
		$result = array();
		$this->db->select('* ,list.id as id ,list.name as name,  cat.name as category_list');
		$this->db->from('fb_page_list as list'); 
		$this->db->join('fb_page_category as cat', 'list.category_list = cat.id' ,'left');
		$this->db->order_by('is_owner', 'DESC');
		$this->db->order_by('is_active', 'DESC');
		$result = $this->db->get();	

		return $result;
	}
	
}
?>













