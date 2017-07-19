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
    public function getTestPost()
    {
		if( $this->cache->redis->get('result_test') )
		{
			$data['result'] = $this->cache->redis->get('result_test');
			$this->load->view( 'expPost' , $data );
		}
		$result=[];
		$post_id = $this->Posts_model->getTestPostID();
		
		foreach( $post_id as $key => $value){

			$post = $this->Posts_model->getTestPost( $value->post_id );
			array_push( $result , $post );
		}
		$this->cache->redis->save('result_test', $result, 3600);
		$data['result'] = $result;
		$this->load->view( 'expPost' , $data );
    }
}
