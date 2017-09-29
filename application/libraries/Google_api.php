<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
error_reporting(E_ALL);
class Google_api
{
    public function getGoogleTrends()
    {
        $result = [];

        $url = 'https://trends.google.co.th/trends/hottrends/atom/feed?pn=p33';
        $check_url_https=FALSE;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_PROXY,'192.168.52.125:3128');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
        $data= curl_exec($ch);
        curl_close($ch);

        $data = $this->kcl_xml_to_array($data);

        if( $data ){
            foreach ($data['RSS']['CHANNEL']['ITEM'] as $key => $value) 
            {
                // print_r( $value );
                $title = $value['TITLE'];
                $intensive = str_replace( array( "+" , "," ) ,"", $value["HT:APPROX_TRAFFIC"] );
                $raw_date =  explode( " " , $value['PUBDATE'] );
                $raw_time = strtotime($raw_date[1]." ".$raw_date[2]." ".$raw_date[3]." ".$raw_date[4] );
                $timestamp = date('Y-m-d H:i:s',$raw_time);
    
                $keyword = [ "keyword" => $title , "intensive" => $intensive/1000 , "created_time" =>$timestamp , "source" => "google"];
    
                array_push( $result , $keyword );
            }
        }
        return $result;
    }

    function kcl_xml_to_array($XML)
    {
        $xml_array=[];
        $xml_parser = xml_parser_create();
        xml_parse_into_struct($xml_parser, $XML, $vals);
        xml_parser_free($xml_parser);
        // wyznaczamy tablice z powtarzajacymi sie tagami na tym samym poziomie
        $_tmp='';
        foreach ($vals as $xml_elem){
            $x_tag=$xml_elem['tag'];
            $x_level=$xml_elem['level'];
            $x_type=$xml_elem['type'];
            if ($x_level!=1 && $x_type == 'close') {
                if (isset($multi_key[$x_tag][$x_level]))
                    $multi_key[$x_tag][$x_level]=1;
                else
                    $multi_key[$x_tag][$x_level]=0;
            }
            if ($x_level!=1 && $x_type == 'complete') {
                if ($_tmp==$x_tag)
                    $multi_key[$x_tag][$x_level]=1;
                $_tmp=$x_tag;
            }
        }
        // jedziemy po tablicy
        foreach ($vals as $xml_elem) {
            $x_tag=$xml_elem['tag'];
            $x_level=$xml_elem['level'];
            $x_type=$xml_elem['type'];
            if ($x_type == 'open')
                $level[$x_level] = $x_tag;
            $start_level = 1;
            $php_stmt = '$xml_array';
            if ($x_type=='close' && $x_level!=1)
                $multi_key[$x_tag][$x_level]++;
            while ($start_level < $x_level) {
                $php_stmt .= '[$level['.$start_level.']]';
                if (isset($multi_key[$level[$start_level]][$start_level]) && $multi_key[$level[$start_level]][$start_level])
                    $php_stmt .= '['.($multi_key[$level[$start_level]][$start_level]-1).']';
                $start_level++;
            }
            $add='';
            if (isset($multi_key[$x_tag][$x_level]) && $multi_key[$x_tag][$x_level] && ($x_type=='open' || $x_type=='complete')) {
                if (!isset($multi_key2[$x_tag][$x_level]))
                    $multi_key2[$x_tag][$x_level]=0;
                else
                    $multi_key2[$x_tag][$x_level]++;
                $add='['.$multi_key2[$x_tag][$x_level].']';
            }
            if (isset($xml_elem['value']) && trim($xml_elem['value'])!='' && !array_key_exists('attributes', $xml_elem)) {
                if ($x_type == 'open')
                    $php_stmt_main=$php_stmt.'[$x_type]'.$add.'[\'content\'] = $xml_elem[\'value\'];';
                else
                    $php_stmt_main=$php_stmt.'[$x_tag]'.$add.' = $xml_elem[\'value\'];';
                eval($php_stmt_main);
            }
            if (array_key_exists('attributes', $xml_elem)) {
                if (isset($xml_elem['value'])) {
                    $php_stmt_main=$php_stmt.'[$x_tag]'.$add.'[\'content\'] = $xml_elem[\'value\'];';
                    eval($php_stmt_main);
                }
                foreach ($xml_elem['attributes'] as $key=>$value) {
                    $php_stmt_att=$php_stmt.'[$x_tag]'.$add.'[$key] = $value;';
                    eval($php_stmt_att);
                }
            }
        }
        return $xml_array;
    }
}