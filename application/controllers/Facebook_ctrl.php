<?php defined('BASEPATH') OR exit('No direct script access allowed');    

class Facebook_ctrl extends CI_Controller
{

	/**
	* [__construct description]
	*
	* 		Home_ctrl Constructor
	*/
	function __construct()
	{
		parent::__construct(); 
		$this->load->library('THSplitLib/segment'); 
        $this->load->library('Kcl_facebook_analytic'); 
        $this->load->model('Posts_model');
		$this->load->model('FB_model');
		$this->load->helper('date');
		$this->load->driver('cache');
        isLoggedin($this->session->all_userdata());
		$this->user_data = $this->session->all_userdata();
		
		// Set Object Variables
		$this->user_id = $this->user_data['login_user_id'];
	}
	
	
	/* ---------------- PostList_view Zone ---------------- */

	/**
	* [postList description]
	*
	*		Load postList View
	* 
	*/
	public function postList()
	{ 
		$result = $this->Posts_model->getActivePagelist();
		$data['page_list'] = $result;

		$this->load->view( 'facebook_view/PostList_view' ,  $data ); 
	}

	/**
	* [ajaxPostList description]
	*
	* 		Get All post by page name
	*
	*       *****   Used by "postList" and "postGraph" ******
	* 
	* @return [array] [echo json]
	*/
	public function ajaxPostList()
	{
		$result = array();

		$page_id = $_POST["page_id"];
		$min_date = date( $_POST["min_date"] );
		$max_date =  date( $_POST["max_date"] );

		$rawData = $this->Posts_model->getPostsbyPageNameandTime( $page_id , $min_date , $max_date);

		$result = $rawData->result();

		echo json_encode($result);
	}


	/* ---------------- EditPage_view Zone ---------------- */

	/**
	* [pagelist description]
	*		load Pagelist view
	* 		Get pagelist from model
	*/
	public function pagelist()
	{
        // Get user data
        
        $result = $this->FB_model->getPersonalPagelist( $this->user_id );
		$data['page_list'] = $result;
		$this->load->view( 'facebook_view/EditPage_view' ,  $data );   
	}

	/**
	* [addPagelist description]
	* 		Create new page
	*/
	public function addPagelist()
	{
		$category =	$this->input->post('category');
		$pageName = $this->input->post('pageName');
		$result = $this->kcl_facebook_analytic->getRawPageDetail( $pageName );

		if( is_string( $result ) )
		{
			$_SESSION['addPageError'] = $result;
			redirect('/facebook/editFacebookListUser');
		}
		else
		{
            $error = $this->FB_model->insertFacebookPage( $result , $category , $this->user_data['login_user_id'] );
            $_SESSION['addPageError'] = ($error)?null:'มีข้อมูลเพจนี้แล้ว กรุณาใส่เพจอื่น';
			redirect('/facebook/editFacebookListUser');
		}
	}

	/**
	* [addCategory description]
	* 		Create new category
	*/
	public function addCategory()
	{
		$cat_name = $this->input->post('category_list');
		$error = $this->Posts_model->insertCategory( $cat_name );
		$_SESSION['addPageError'] = $error;
		redirect('/editPageList');
	}

	/**
	* [editPagelist description]
	*		Edit page attribute
	* 
	*/
	public function editPagelist()
	{

		$link = $this->input->post('link');
		$website = $this->input->post('website');
		$id = $this->input->post('page_id');
		$category_list = $this->input->post('category_list');
		$is_owner = ( $this->input->post('is_owner')=='on'? 1:0 );

		$this->Posts_model->updateEditPage( $id , $link , $website , $is_owner , $category_list );

		redirect('/editPageList');
	}

	/**
	* [toggleIsActivePage description]
	*		Callback for set active/disabled page
	*/
	public function toggleIsActivePage( $page_id , $is_active )
	{
		$is_active = ($is_active == 1 ? 0 : 1);
		$this->FB_model->toggleIsActivePage( $page_id , $this->user_data['login_user_id'] , $is_active );
		redirect('/facebook/editFacebookListUser');
	}

	public function ajaxGetPageCategory()
	{
		$result = $this->Posts_model->getCategorylist();
		echo json_encode( $result );
	}

	/**
	* [ajaxGetActivePage description]
	*
	* 	Get active page 
	* 	
	*/
	public function ajaxGetActivePage()
	{
		$page_list = $this->FB_model->getPersonalPagelist( $this->user_id );
		echo json_encode( $page_list );
	}
	
}
?>