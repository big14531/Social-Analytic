<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
error_reporting(E_ALL);
class Google_api
{
    public function getGoogleTrends()
    {
       
        $url = 'http://www.google.com/trends/hottrends/atom/feed?pn=p1';
        $referrer = 'http://www.google.com';
        $agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);

        $result = curl_exec($ch);

        $trends = new SimpleXmlElement($result);
        
        foreach($trends->channel->item as $value) { 
                echo $value->title."<br>";
        }
    }
}