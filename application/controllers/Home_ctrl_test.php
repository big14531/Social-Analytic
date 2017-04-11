<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_ctrl_test extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        error_reporting(-1);
        ini_set('display_errors', 1);


        $this->load->library('THSplitLib/segment');
        $this->load->library('Kcl_facebook_analytic');
        $this->load->model('Posts_model_test','Posts_model');
        $this->load->helper('date');
    }

    public function dashboard()
    {

        $this->load->view( 'Homepage_view' );
    }


    /* ---------------- edit page list Section ---------------- */

    public function pagelist( $data=array() )
    {
        $result = $this->Posts_model->getPagelist();
        $data['page_list'] = $result->result();

        $this->load->view( 'Pagelist_view' ,  $data );
    }

    public function addPagelist()
    {
        $array = array
        (
            'about' => '',
            'category_list' => null,
            'cover_photo' => '',
            'fan_count' => '',
            'link' => '',
            'name' => '',
            'website' => '',
            'page_id' => '',
            'picture' => ''
            );

        $pageName = $this->input->post('pageName');
        $result = $this->kcl_facebook_analytic->getRawPageDetail( $pageName );
        // var_dump( $result );

        if( is_string( $result ) )
        {
            $_SESSION['addPageError'] = $result;
            redirect('/editPageList');
        }
        else
        {
            $error = $this->Posts_model->insertPageDetail( $result );
            $_SESSION['addPageError'] = $error;
            redirect('/editPageList');
        }
    }

    public function editPagelist()
    {

        $link = $this->input->post('link');
        $website = $this->input->post('website');
        $id = $this->input->post('page_id');
        $is_owner = ( $this->input->post('is_owner')=='on'? 1:0 );

        $this->Posts_model->updateEditPage( $id , $link , $website , $is_owner );

        redirect('/editPageList');
    }

    public function toggleIsActivePage( $id , $is_active )
    {
        $is_active = ($is_active == 1 ? 0 : 1);;
        $this->Posts_model->toggleIsActivePage( $id , $is_active );

        redirect('/editPageList');
    }


    /* ---------------- Post list Section ---------------- */
    public function postList()
    {
       $result = $this->Posts_model->getActivePagelist();
       $data['page_list'] = $result->result();

       $this->load->view( 'PostList_view' ,  $data );
    }

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

    public function convertRawPostData( $rawData )
    {
        $result = array();

        /* Do something */

        return $result;
    }


/* ---------------- post analytic Section ---------------- */

    public function splitThaiWord( $text )
    {
        $result = array();
        $segment = new Segment();
        $splited = $segment->get_segment_array($text);

        return $splited;
    }

    public function removeUnnecessaryWord( $str_orignal )
    {
      if($str_orignal)
      {
         $nope_word = array('?',"&",".",'…','ฯ','และ','หรือ','ที่','คือ','!','#','$','%','*','()',')','“','”',"'",'"',"’","‘");
         $str_orignal=str_replace($nope_word,array(' '),$str_orignal);
         $str_orignal=@preg_replace('/[&\/\\#,+()$~%.\'"!:*?<>{}]/', ' ', $str_orignal);
       }
       return $str_orignal;
    }

    public function sortNestArray( $result )
    {
        $arr_count_match=array();
        foreach($result as $k =>$v)
        {
            $arr_count_match[$k]=$v['count'];
        }
        arsort($arr_count_match);
        $arr_complete=array();
        $i=0;
        foreach($arr_count_match as $k =>$v)
        {
           $arr_complete[$i][0]=$result[$k]['0'];
           $arr_complete[$i][1]=$result[$k]['1'];
           $arr_complete[$i]['count']=$result[$k]['count'];
           $i++;
        }

        return $arr_complete;
    }

    public function postAnalytic( $page_id , $post_id )
    {
        $data['id'] = array( 'page_id' => $page_id , 'post_id' => $post_id );
        $this->load->view( 'PostAnalytic_view' ,  $data );
    }

    public function ajaxAnalyticPost()
    {
        $page_id = $_POST['page_id'];
        $post_id = $_POST['post_id'];

        //    $page_id = 208428464667;
        // $post_id = 10155302699204668;
        $result = array();
        $target_post = $this->Posts_model->getPostbyID( $page_id , $post_id );

        $target_post_date = date("Y-m-d",strtotime($target_post[0]->created_time));
        $min_date = $target_post_date." 00:00:00";
        $max_date = $target_post_date." 23:59:59";

        // $target_text_raw = $target_post[0]->message.$target_post[0]->description.$target_post[0]->name;
        $target_text_raw = $target_post[0]->name.' '.$target_post[0]->description;
        $target_text_raw = $this->removeUnnecessaryWord($target_text_raw );
        $target_text = $this->splitThaiWord( $target_text_raw );
        //
        @preg_match_all( '/"([^"]+)"|“([^“]+)”|\'([^\']+)\'|‘([^‘]+)’/' , $target_post[0]->message.$target_post[0]->description.$target_post[0]->name, $match_keyword );
        if($match_keyword[0])
        {
          $target_text=array();
            foreach($match_keyword[0] as $k =>$v)
            {
                $v=trim($v);
                $v=$this->removeUnnecessaryWord($v);
                if($v)
                {
                  $v2=explode(' ',$v);
                  foreach($v2 as $v_v2)
                  {
                    array_push($target_text,$v_v2);
                  }
                }

            }
        }
        //
        $target_text=array_unique($target_text);

        $regexp = implode('|', $target_text);
        //echo($regexp);exit();

        $comp_post = $this->Posts_model->getPostbyTimeRangeandRegEx( $regexp ,  $min_date , $max_date );
        foreach($comp_post as $value)
        {
            $comp_text_raw = $value->name.$value->description;
            $comp_text = $this->removeUnnecessaryWord($comp_text_raw);

            $comp_text = $this->splitThaiWord( $comp_text );
            $match_count = array_intersect( $target_text , $comp_text  );
            if( count( $match_count ) >= 1)
            {
                array_push( $result , array ( $value, $match_count , "count"=>count($match_count) ) );
            }

        }

        $result = $this->sortNestArray( $result );

        $data['target_post'] = $target_post;
        $data['match_post'] = $result;
        echo json_encode( $data );
        // $this->load->view( 'PostAnalytic_view' ,  $data );
    }


/* ---------------- post graph Section ---------------- */

    public function postGraph()
    {
        $result = $this->Posts_model->getActivePagelist();
        $data['page_list'] = $result->result();

        $this->load->view( 'PostGraph_view' ,  $data );
    }



/* ---------------- Table page list Section ---------------- */

public function showPageTable()
{
    $min_date = date("Y-m-d 00:00:00");
    $max_date = date("Y-m-d 23:59:59");

    $result = $this->Posts_model->getActivePageSummary( $min_date , $max_date );
    $data['page_list'] = $result;
    $this->load->view( 'PageTable_view',$data );
}

public function ajaxPageTable()
{
    $min_date = $_POST['min_date'];
    $max_date = $_POST['max_date'];

    $result = $this->Posts_model->getActivePageSummary( $min_date , $max_date );
    echo json_encode( $result );
}



/* ---------------- Growth page Section ---------------- */

public function growthPage()
{
    $result = $this->Posts_model->getActivePagelist();
    $data['page_list'] = $result->result();
    $this->load->view( 'GrowthPage_view',$data );
}

public function getGrowthPage()
{
    $arrayPage = array();
    $arrayPageValue = array();

    $min_date = $_POST['min_date'];
    $max_date = $_POST['max_date'];

    $date = date("Y-m-d 00:00:00");
    $pageList = $this->Posts_model->getActivePagelist();
    $pageList = $pageList->result();

    foreach( $pageList as $value )
    {
        $arrayPageValue = array();
        $arrayPageFan = array();
        $arrayPagePost = array();

        $result = $this->Posts_model->getPageLog( $min_date , $max_date , $value->page_id );
        $result = $result->result();

        $arrayPageValue['id'] = $value->id;
        $arrayPageValue['page_name'] = $value->name;
        $arrayPageValue['page_id'] = $value->page_id;
        $arrayPageValue['picture'] = $value->picture;
        foreach( $result as $logValue )
        {
            // Multiple 1000 because flot graph need its.
            array_push( $arrayPagePost, array ( strtotime( $logValue->create_time )*1000 , $logValue->posts ) );
            array_push( $arrayPageFan, array ( strtotime( $logValue->create_time )*1000 , $logValue->fan_count ) );


        }
        $arrayPageValue['posts_array'] = $arrayPagePost;
        $arrayPageValue['fan_array'] = $arrayPageFan;

        array_push(  $arrayPage , $arrayPageValue );

            // // For DEBUG DATA
            // var_dump( $value );
            // echo  "<br>".$value->name;
            // echo  "<br>".$value->page_id;
            // echo  "<br>".$value->picture;
            // echo  "<br>".$value->fan_count;
            // echo "<br><br>";
            // foreach( $result as $logValue )
            // {
            //     echo  "<br>".$logValue->create_time." - ".$logValue->fan_count;
            // }
            // echo "<br><br><br>-----------------------------------------------------<br><br><br>";

            // print_r($arrayPage);
    }
    echo json_encode( $arrayPage );
}

/* ---------------- User page Section ---------------- */

public function userPage()
{
    $result = array();
    $user_list = $this->Posts_model->getAllUser();
    $data['user_list'] = $user_list;
    $this->load->view( 'UserEdit_view',$data );
}

public function createUser()
{
    $data = array(
        "user_name_surname" => $this->input->post('user_name_surname'),
        "username" => $this->input->post('username'),
        "password" => $this->input->post('password'),
        "employee_code" => $this->input->post('employee_code'),
        "user_active" => $this->input->post('user_active'),
        "user_last_login" => $this->input->post('user_last_login'),
        "permission_manager" => $this->input->post('permission_manager'),
        "permission_admin" => $this->input->post('permission_admin')
        );

    $user_list = $this->Posts_model->createUser();

}


}
?>
