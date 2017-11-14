<?php defined('BASEPATH') OR exit('No direct script access allowed');    

class Twitter_ctrl extends CI_Controller
{
	function __construct()
	{
		parent::__construct(); 
		$this->load->library('Kcl_twitter_sdk');
        $this->load->model('Posts_model');
		$this->load->helper('date');
		$this->load->driver('cache');
        isLoggedin($this->session->all_userdata());
		$this->user_data = $this->session->all_userdata();
		
		// Set Object Variables
		$this->user_id = $this->user_data['login_user_id'];
    }
    
    public function twitterList()
    {
        $this->load->view( 'twitter_view/EditTwitter_view' );
	}
	
	public function getUserDetail( $name )
	{
		$result = $this->kcl_twitter_sdk->getUser( $name );
		print_r( $result );
	}

	public function getUserTimeline( $name )
	{
		$result = $this->kcl_twitter_sdk->getTweetTimeline( $name );
		print_r( $result );
	}

	public function getSearchTweet( $keyword )
	{
		$result = $this->kcl_twitter_sdk->searchTweet( $keyword );
		print_r( $result );
	}
}
?>    