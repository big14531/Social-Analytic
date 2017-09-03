<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();

     }

     /**
      * [getUserbyUsername description]
      *
      *   Get user data by unsername
      *   
      * @param  [text] $username [ username of user ]
      * @return [array] $result [ data of user ]
      */
     function getUserbyUsername( $username )
     {
          $sql = "select * from fb_user where username = '" . $username . "' and user_active = '1'";
          $result = $this->db->query($sql);
          return $result->result();
     }

     /**
      * [updateLastLogin description]
      *
      *   update lated login time
      * 
      * @param  [type] $date [description]
      * @return [type] $result [description]
      */
     public function updateLastLogin( $id , $date )
     {
          $array = array(
               "user_last_login" => $date
               );
          $this->db->where( 'user_id' , $id );
          $this->db->update( 'fb_user', $array);
     }
}?>