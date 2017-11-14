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
    }
    
    public function get_user()
	{
        \Codebird\Codebird::setConsumerKey($this->consumer_key,$this->consumer_secret);
        $cb = \Codebird\Codebird::getInstance();
        $cb->setToken($this->access_token,$this->access_token_secret);
        $reply = $cb->users_show('screen_name=big14531');
        return $reply;
    }
}

/*
error
stdClass Object
(
    [errors] => Array
        (
            [0] => stdClass Object
                (
                    [code] => 187
                    [message] => Status is a duplicate.
                )

        )

    [httpstatus] => 403
    [rate] => 
)
*/

/*
complete

stdClass Object
(
    [created_at] => Sun Sep 25 14:51:42 +0000 2016
    [id] => 780057193378832385
    [id_str] => 780057193378832385
    [text] => ‘กีฟ’ ลั่นตัดขาด 'เกรซ' น้องสาวชั่วชีวิต  https://t.co/UkfAjWt0IH
    [truncated] => 
    [entities] => stdClass Object
        (
            [hashtags] => Array
                (
                )

            [symbols] => Array
                (
                )

            [user_mentions] => Array
                (
                )

            [urls] => Array
                (
                    [0] => stdClass Object
                        (
                            [url] => https://t.co/UkfAjWt0IH
                            [expanded_url] => http://www.komchadluek.net/news/ent/240991
                            [display_url] => komchadluek.net/news/ent/240991
                            [indices] => Array
                                (
                                    [0] => 42
                                    [1] => 65
                                )

                        )

                )

        )

    [source] => <a href="http://adminkcl.komchadluek.net" rel="nofollow">KclAutoTweet</a>
    [in_reply_to_status_id] => 
    [in_reply_to_status_id_str] => 
    [in_reply_to_user_id] => 
    [in_reply_to_user_id_str] => 
    [in_reply_to_screen_name] => 
    [user] => stdClass Object
        (
            [id] => 87412652
            [id_str] => 87412652
            [name] => Thossaphol_Saehan
            [screen_name] => jomphol
            [location] => Teh internets
            [description] => 
            [url] => 
            [entities] => stdClass Object
                (
                    [description] => stdClass Object
                        (
                            [urls] => Array
                                (
                                )

                        )

                )

            [protected] => 
            [followers_count] => 1
            [friends_count] => 27
            [listed_count] => 0
            [created_at] => Wed Nov 04 10:58:17 +0000 2009
            [favourites_count] => 2
            [utc_offset] => 
            [time_zone] => 
            [geo_enabled] => 1
            [verified] => 
            [statuses_count] => 93
            [lang] => en
            [contributors_enabled] => 
            [is_translator] => 
            [is_translation_enabled] => 
            [profile_background_color] => FFFFFF
            [profile_background_image_url] => http://abs.twimg.com/images/themes/theme1/bg.png
            [profile_background_image_url_https] => https://abs.twimg.com/images/themes/theme1/bg.png
            [profile_background_tile] => 
            [profile_image_url] => http://pbs.twimg.com/profile_images/508474561/jomphol_copy_normal.jpg
            [profile_image_url_https] => https://pbs.twimg.com/profile_images/508474561/jomphol_copy_normal.jpg
            [profile_link_color] => 0084B4
            [profile_sidebar_border_color] => C0DEED
            [profile_sidebar_fill_color] => DDEEF6
            [profile_text_color] => 333333
            [profile_use_background_image] => 1
            [has_extended_profile] => 
            [default_profile] => 
            [default_profile_image] => 
            [following] => 
            [follow_request_sent] => 
            [notifications] => 
        )

    [geo] => 
    [coordinates] => 
    [place] => 
    [contributors] => 
    [is_quote_status] => 
    [retweet_count] => 0
    [favorite_count] => 0
    [favorited] => 
    [retweeted] => 
    [possibly_sensitive] => 
    [lang] => th
    [httpstatus] => 200
    [rate] => 
)
*/