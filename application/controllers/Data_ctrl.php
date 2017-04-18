<?php defined('BASEPATH') OR exit('No direct script access allowed');    

/**
 *  Data controller
 *
 *  controller about get , update -> post and page
 *  
 */
class Data_ctrl extends CI_Controller
{
    function __construct()
    {
        parent::__construct(); 
        error_reporting(-1);
        ini_set('display_errors', 1);

        $this->load->library('Kcl_facebook_analytic'); 
        $this->load->model('Posts_model');
        $this->load->helper('date');
    }

    public function tempUpdateAll()
    {
        $this->load->view('UpdateInterval');
    }

    public function contabDataCrawler()
    {

        $this->load->helper('file');
        $result=write_file('last_crontab.txt',date('Y-m-d H:i:s'),'w+, ccs=UTF-8');
        
        $minute=date('i');
        echo $minute;
        if($minute%30==0)
        {
            $this->updateTrackingPage();
        }

        elseif($minute%6==0)
        {
            $this->sweepFacebookPost(10,0);
        }

        elseif($minute%2==0)
        {
            $this->updateFacebookPost(60);
        }
    }

    public function getAllTrackPageID()
    {
        $result = array();
        $data = $this->Posts_model->getPageID();
        $data = $data->result();

        foreach( $data as $value )
        {
            array_push($result , $value->page_id ); 
        }
        return $result;
    }

    public function updateTrackingPage()
    {
        $pageList = $this->Posts_model->getActivePagelist();
        $pageList = $pageList;
        $min_date = Date("Y-m-d 00:00");
        $max_date = Date("Y-m-d 24:00");
        $hour = Date("H");
        foreach( $pageList as $value )
        {
            $id = $value->id;
            $page_id = $value->page_id;
            $result = $this->kcl_facebook_analytic->getRawPageDetail( $page_id );

            $posts = $this->Posts_model->getSummaryPostsbyPageNameandTime( $page_id , $min_date , $max_date );

            $result['posts'] = $posts[0]->count;
            $result['shares'] = $posts[0]->shares;
            $result['comments'] = $posts[0]->comments;
            $result['likes'] = $posts[0]->likes;
            $result['love'] = $posts[0]->love;
            $result['wow'] = $posts[0]->wow;
            $result['haha'] = $posts[0]->haha;
            $result['sad'] = $posts[0]->sad;
            $result['angry'] = $posts[0]->angry;
            $result['post_rate'] = $posts[0]->count/$hour;

            $this->Posts_model->updateTrackingPage( $id , $result );     
            $this->Posts_model->updatePageLog( $result );

            /*----------------- For Debug ----------------*/
            // echo "<b>Update :".$value->name."</b><br>";
            // echo "Number Post : ". $result['posts']."<br>";
            // var_dump( $result );
            // echo "<br>";echo "<br>";echo "<br>";echo "<br>";
        }
    }

    public function sweepFacebookPost( $limit , $offset )
    {
        /* Uncomment when debug API  */
        //        echo "<b>Token Object   : </b><br>";
        //        var_dump( $_SESSION['accessToken'] );
        //        echo "<br><br><br>";
        $total_result = array();
        $pageNameArray = $this->getAllTrackPageID();

        /* Check session */
        if( isset($_SESSION['accessToken']) )
        {

            $_SESSION['post_count'] = 0;

            foreach( $pageNameArray as $pageName )
            {
                $rawData = $this->kcl_facebook_analytic->getRawPostData( $pageName , $limit , $offset  );
                print_r( $rawData['data'] );
                echo "<br><br><br><br><br>";
                $this->extractPostData( $rawData,$pageName );  

                array_push( $total_result, $rawData['data']);
                $_SESSION['post_count']++;
            }
        }
        echo json_encode( $rawData['data'] );
    }

    public function updateFacebookPost( $limit )
    {
        $total_result = array();
        $date = Date("Y-m-d 00:00:00");
        $postArray = $this->getLatedUpdatePost( $date , $limit );

        echo $date;
        print_r( $postArray );

        if( isset($_SESSION['accessToken']) )
        {
            foreach ($postArray as $value) 
            {
                echo "<br><br>Last Update".$value->last_update_time."<br><br>";
                $post_id =  $value->page_id."_".$value->post_id;

                $rawData = $this->kcl_facebook_analytic->getReactionPost( $post_id );
                $rawData['last_update_time'] = Date("Y-m-d H:i:00");
                $rawData['post_id'] = $value->post_id;
                $rawData['created_time'] = nice_date(  $rawData['created_time'] , 'Y-m-d H:i:00');
                array_push( $total_result , $rawData );
            }
            if ( count( $total_result )!=0 ) {
                $this->updatePost( $total_result );  
            } 


        }
        echo json_encode( $total_result );
    }

    public function getLatedUpdatePost( $date , $limit )
    {
        $result = array();
        $data = $this->Posts_model->getLatedUpdatePost( $date , $limit );
        $data = $data->result();
        return $data;
    }

    public function updatePost( $data )
    {   

       $this->Posts_model->updatePost( $data );
   }

   public function extractPostData( $data,$pageName )
   {
    $total_result = array();
    foreach( $data['data'] as $key => $value )
    {
        $post_result = array(
            'page_id'       => '', /* primary Key */
            'post_id'       => '', /* primary Key */
            'type'          => '',
            'message'       => '',    
            'description'   => '',        
            'link'          => '', 
            'permalink_url' => '',          
            'object_id'     => '',      
            'picture'       => '',    
            'name'          => '', 
            'icon'          => '', 
            'shares'        => '0',   
            'comments'      => '0',
            'created_time'  => ''
            );

        foreach( $value as $key => $inner_value)
        {
            if($key=='id')
            { 
                $id = explode( '_' ,$inner_value );
                $post_result['page_id'] = $id[0]; 
                $post_result['post_id'] = $id[1];
            }

            elseif($key=='shares')
                { $post_result[$key] = $inner_value['count']; }

            elseif($key=='comments')
                { $post_result[$key] = $inner_value['summary']['total_count']; }

            elseif($key=='created_time')
            { 
                /* Convert date */
                $created_time = nice_date(  $inner_value, 'Y-m-d H:i');
                $post_result[$key] = $created_time; 

            }


            else
            { 
                $inner_value = str_replace('"',"'",$inner_value);
                $post_result[$key] = $inner_value; 
            }

        }
        /* Get reaction */
        $post_result['reaction'] = $this->kcl_facebook_analytic->getReactionPost( $value['id'] );

        /* Insert to database */
        $this->Posts_model->insertPostData( $post_result );
    } 
}

}
?>