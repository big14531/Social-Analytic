<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class TT_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('file');
	}
	
	public function insertTweetBatch( $tweet_array )
	{
        foreach ( $tweet_array as $data ) 
        {
            $insert_query = $this->db->insert_string('tt_tweet_list', $data);
            $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
			$this->db->query($insert_query);
        }

	}

}
?>













