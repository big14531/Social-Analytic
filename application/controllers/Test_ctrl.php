<?php defined('BASEPATH') OR exit('No direct script access allowed');    


class Test_ctrl extends CI_Controller
{

	function __construct()
	{
		parent::__construct(); 
		$this->load->library('Kcl_facebook_analytic'); 
		$this->load->model('Posts_model');
		$this->load->helper('date');
		$this->load->helper('file');
		$this->load->helper('analytic_helper');
		$this->load->driver('cache');
	}
    public function index()
    {
        $post_array = [

        ];
        $batch = $this->kcl_facebook_analytic->batchUpdatePostFacebook( $post_array );
    }
}
