<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once("Facebook/autoload.php");
error_reporting(E_ALL);

class Kcl_facebook_analytic{

    protected $fb_obj;
    protected $helper;

    public function __construct()
    {
        $this->fb_obj= new Facebook\Facebook([
            'app_id' => '272658633175667',
            'app_secret' => 'dab47779eaca2c8d2deb8b5cc844a992',
            'default_graph_version' => 'v2.7'
        ]);
        $this->getToken();
        $this->fb_obj->setDefaultAccessToken( $_SESSION['accessToken'] );
    }

    public function getToken()
    {
        $_SESSION['accessToken'] = "272658633175667|afmrK1I172gDdS-eXfc7jlJnzhU";
    }

    public function getRawPostData( $pageName , $limit , $offset=0 )
    {
        // echo '<h1>'.$pageName.'</h1>';

        /* API QUERY */
        $url = '/'.$pageName.'/posts?limit='.$limit.'
            &offset='.$offset.'
            &fields=
                id,
                link,
                picture,
                message,
                description,
                object_id,
                name,
                icon,
                created_time,
                permalink_url,
                shares,
                comments.limit(0).summary(true),
                type';

        $url = preg_replace('/\s+/', '', $url); 
        $res = $this->fb_obj->get( $url );
        return $res->getDecodedBody();
    }

    /* Get Reaction Count */
    public function getReactionPost( $post_id )
    {
        $result = array();
        try 
        {
            $react = $this->fb_obj->get( $post_id.'/?fields=created_time,reactions.type(LIKE).summary(total_count).limit(0).as(like),reactions.type(LOVE).summary(total_count).limit(0).as(love),reactions.type(WOW).summary(total_count).limit(0).as(wow),reactions.type(HAHA).summary(total_count).limit(0).as(haha),reactions.type(SAD).summary(total_count).limit(0).as(sad),reactions.type(ANGRY).summary(total_count).limit(0).as(angry),shares,comments.limit(0).summary(true)');
            $react = $react->getDecodedBody();
            foreach( $react as $key => $value)
            {
                if($key=='id')continue;
                elseif ($key=='like') { $result['likes'] = $value['summary']['total_count']; }
                elseif ($key=='created_time') { $result['created_time'] = $value; }
                elseif ($key=='shares') { $result['shares'] = $value['count']; }
                else{ $result[$key] = $value['summary']['total_count'];  }
            }
        } 
        catch (Exception $e) 
        {
            $result = $e;
        }

        return $result;
    }

    public function getRawPageDetail( $pageName )
    {
        $this->fb_obj= new Facebook\Facebook([
            'app_id' => '272658633175667',
            'app_secret' => 'dab47779eaca2c8d2deb8b5cc844a992',
            'default_graph_version' => 'v2.7'
        ]);

        $this->fb_obj->setDefaultAccessToken( $_SESSION['accessToken'] );

        /* API QUERY */
        $url = '/'.$pageName.'
            ?fields=
                about,
                fan_count,
                category_list,
                link,
                website,
                cover,
                name,
                picture{url}'
            ;


        $url = preg_replace('/\s+/', '', $url);

        try {
            $res = $this->fb_obj->get( $url );
            $result = $res->getDecodedBody(); 
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            $result = $e->getMessage();
            return $result;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            $result = $e->getMessage();
            return $result;
        }
        $key = array('about',
                     'fan_count',
                     'category_list',
                     'link',
                     'website',
                     'cover',
                     'name',
                     'picture');
        $result = $this->createEmptyKey( $key , $result );
        return $result;
    }

    public function createEmptyKey( $key , $data )
    {
        foreach( $key as $k_value )
        {
            $dataKey = array_keys( $data );
            if( in_array( $k_value , $dataKey ) == false)
            {
                $data[$k_value]="nope";
            }
        }
        return $data;
    }

}