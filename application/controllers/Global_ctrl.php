<?php defined('BASEPATH') OR exit('No direct script access allowed');    

class Global_ctrl extends CI_Controller
{

	function __construct()
	{
		parent::__construct(); 
		$this->load->model('Global_model');
		$this->user_data = $this->session->all_userdata();

		// Set Object Variables
		$this->user_id = $this->user_data['login_user_id'];
	}

	public function ajaxSendChat()
	{
		$text = $this->input->post('text');
		$from = $this->user_id;
		$to = 1; // 1 is admin user_id

		$data_insert = array(
			'text' => $text,
			'from' => $from,
			'to' => $to
		);

		$data_get = array(
			'from' => $from,
			'to' => $to
		);

		$message_id = $this->Global_model->insertChatText( $data_insert );	
		echo json_encode( $message_id );	
	}

	public function ajaxGetChat()
	{
        $from = $this->user_id;
        $to = 1; // 1 is admin user_id
        $result = $this->Global_model->getChatText( $from , $to );	
		echo json_encode( $result );
	}
}
?>