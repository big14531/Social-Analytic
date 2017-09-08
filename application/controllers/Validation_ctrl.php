<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Validation_ctrl extends CI_Controller
{

    public function __construct()
    {
          parent::__construct();
          $this->load->database();
          $this->load->library('form_validation');
          $this->load->model('Login_model');
          $this->load->model('Posts_model');
          
     }

    public function index()
    {
        // Check session if it's exist , redirect to dashboard
        checkLoginPage($this->session->all_userdata());
        $this->load->view( 'Login_view' );
    }

    public function register()
    {
		$data = array(
			"user_name_surname" => html_escape( $this->input->post( 'name' ) ),
			"username"          => html_escape( $this->input->post( 'email' ) ),
			"password"          => password_hash( html_escape( $this->input->post( 'password' ) ) , PASSWORD_DEFAULT),
			"email"             => 0,
			"user_active"       => 1,   
			"user_last_login"   => date("Y-m-d H:i:s"),
			"permission_user"   => 1,
			"permission_manager"=> 1,
			"permission_admin"  => 1
			);
        $result = $this->Posts_model->createUser( $data );
        redirect('/');
    }
    public function verifyLogin()
    {
        // Create data
        $session_user = array();
        $username = html_escape( $this->input->post( 'username' ) );
        $password = html_escape( $this->input->post( 'password' ) );

        // Get User data
        $data = $this->Login_model->getUserbyUsername( $username );

        // Check password and return boolean
        $result = password_verify( $password , $data[0]->password );

        if( $result )
        {
            $session_user['logged_in'] = TRUE;
            $session_user['login_user_id'] = $data[0]->user_id;
            $session_user['login_username'] = $data[0]->username;
            $session_user['login_name'] = $data[0]->user_name_surname;
            $session_user['login_last_login'] = $data[0]->user_last_login;
            $session_user['profile'] = $data[0]->default_profile;
            $session_user['user_email'] = $data[0]->email;
            $session_user['permission_user'] = $data[0]->permission_user;
            $session_user['permission_manager'] = $data[0]->permission_manager;
            $session_user['permission_admin'] = $data[0]->permission_admin;
            $this->session->set_userdata($session_user);

            // Set session
            $name = $this->session->userdata('login_username');

            // Get User data
            $date = date("Y-m-d H:i:s");
            $this->Login_model->updateLastLogin( $data[0]->user_id , $date );

            redirect('/');
        }
        else
        {
            redirect('/login?loginfail=1');
        }
    }

    public function logout()
    {
        // Destory Session and go to login page
        $this->session->sess_destroy();
        redirect('/login');
    }
}?>