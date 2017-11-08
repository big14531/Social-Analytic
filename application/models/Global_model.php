<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Global_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('file');
	}
	
	public function insertChatText( $data )
	{
        $this->db->insert( 'global_chat_log' , $data );
        return $this->db->insert_id();
	}
	
	public function getChatText( $from , $to )
	{
        $this->db->select('*');
        $this->db->from('global_chat_log'); 
        $this->db->where( 'from' , $from );
        $this->db->where( 'to' , $to );
        $this->db->order_by( 'id' , 'desc' );
        $this->db->limit( 5 );
        $result = $this->db->get();	
        return $result->result();
	}

	
}
?>













