<?php

function comparePostbyPostObj( $post_obj , $target_post )
{
    $CI =& get_instance();

   	// print_r( $post_obj );
   	$result =[];
   	$json_obj =[];
   	$text = $post_obj->message.' '.$post_obj->name;
   	$text = removeUnnecessaryWord( $text );

	$segment = new Segment();
	$splited = $segment->get_segment_array($text);

	$splited = cleanArray( $splited );
	$max = sizeof( $splited );
	$regexp = '/'.implode('|', $splited).'/i';

	// Uncomment for echo regexp
	echo "<br>".$regexp."<br>";

	foreach ($target_post as $value	) 
	{
		$matches = null;
		$target_text = $value->message.' '.$value->name;
		$returnValue = preg_match_all( $regexp , $target_text, $matches, PREG_PATTERN_ORDER);
		if ( $returnValue == 0) continue;
		if ( $returnValue < $max*(80/100) ) continue;

		$target_data = array(
			'post_id' => $value->page_id.'_'.$value->post_id,
			'engage' => $value->engage 	
			);
		array_push( $result ,$target_data );
	}
	usort($result,"cmp");
	$result = array_slice($result, 0, 10);
	$result = json_encode( $result );

 	return $result;
}

function cleanArray( $array )
{
	$splited = array_unique($array);
	$nope_word = array('ๆ','ทำ','สุด','ฯ','ก็','ไป','','นี้','ได้','ยัง','จึง','ไม่','ให้','กับ','แล้ว','และ','หรือ','ที่','คือ','เป็น','สี','ว่า','จะ','มี','ใน');

	foreach ($splited as $key => $value) 
	{
		if ( mb_strlen($value,"UTF-8")==1 ) 
		{
			unset($splited[$key]);
		}
		if( in_array( $value , $nope_word) )
		{
			unset($splited[$key]);			
		}
	}

	return $splited;
}

function cmp($a, $b) 
{
   return $b['engage'] - $a['engage'];
}

function removeUnnecessaryWord( $str_orignal )
{
	if($str_orignal)
	{
		$str_orignal=@preg_replace('/[&\/\\#,.+()$~%\'"!:*?<>{}]/', ' ', $str_orignal);
	}
	return $str_orignal;
}

function rankCriteriaCalculator( $value , $fanpage )
{
	$reach 			= ($fanpage*1)/100;
	$max_success 	= $reach/2;
	$CriteriaA 		= floor( ( $max_success*100 )/100 );
	$CriteriaB 		= floor( ( $max_success*80 )/100 );
	$CriteriaC 		= floor( ( $max_success*60 )/100 );
	$CriteriaD 		= floor( ( $max_success*40 )/100 );
	$CriteriaE 		= floor( ( $max_success*20 )/100 );
	$CriteriaF 		= 0;

	if 		( $value>$CriteriaA  ) 	{ $rank = 'A'; }
	elseif 	( $value>$CriteriaB  ) 	{ $rank = 'B'; }
	elseif 	( $value>$CriteriaC  ) 	{ $rank = 'C'; }
	elseif 	( $value>$CriteriaD  ) 	{ $rank = 'D'; }
	elseif 	( $value>$CriteriaE  ) 	{ $rank = 'E'; }
	elseif 	( $value>$CriteriaF  ) 	{ $rank = 'F'; }
	else { $rank ='F';}
	return $rank;
}