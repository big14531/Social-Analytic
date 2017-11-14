<?php
error_reporting(E_ALL);
require_once("codebird-twitter/codebird.php");
class Kcl_twitter_sdk{

	protected $fb_obj;

	public function __construct(){
        $this->consumer_key = 'cq3j0YbjIUOw2e02P1r9qR1gc';
        $this->consumer_secret = 'SVuxRIIiZqHidFkqyMer0vUJ22UQ1iw8tu8J3iVfunQC5FPqcM';
        $this->access_token = '2671886117-R2hV6oDxiVZynNSBSVt1Ja64EXbO8bC5PO6O2b6'; 
        $this->access_token_secret = 'R6sBu2n8sWUMXs2Tl5n8BJ48oHleZe9cza68LY7CphHuo';

        \Codebird\Codebird::setConsumerKey($this->consumer_key,$this->consumer_secret);
        $this->cb = \Codebird\Codebird::getInstance();
        $this->cb->setToken($this->access_token,$this->access_token_secret);
    }
    
    public function getUser( $name )
	{
        $reply = $this->cb->users_show( 'screen_name='.$name );
        return $reply;
    }
    
    public function getTweetTimeline( $name )
    {
        $reply = $this->cb->statuses_homeTimeline( 'screen_name='.$name );
        return $reply;
    }

    public function searchTweet( $text )
    {
        $reply = $this->cb->search_tweets( 'q='.$text , true);
        return $reply;
    }

    
}