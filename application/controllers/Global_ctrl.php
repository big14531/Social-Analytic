<?php defined('BASEPATH') OR exit('No direct script access allowed');    

class Global_ctrl extends CI_Controller
{

	function __construct()
	{
        parent::__construct(); 
        $this->load->model('FB_model');
	}

    public function editFacebookListUser()
    {
        $result = $this->FB_model->getPersonalPagelist();
		$data['page_list'] = $result;
		$this->load->view( 'Pagelist_view' ,  $data );   
    }

    public function editInstagramListUser()
    {
        # code...
    }
    
    public function editTwitterListUser()
    {
        # code...
    }
    
    
    
    

}
?>