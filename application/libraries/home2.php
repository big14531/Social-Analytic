<?Php
include('inc/config.php');
?>

<?Php include("admin/config/config.php");?>
<?Php include("admin/lib/medoo.min.php");?>
<?php include("admin/inc/database.class.php");?>
<?Php include("admin/inc/function.php");?>
<?Php include("include/class.page.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Nine.co.th</title>
<link rel="stylesheet" type="text/css" href="css/styles.css"/>
<link rel="stylesheet" type="text/css" href="css/fontawesome.css"/>
<link rel="stylesheet" type="text/css" href="css/scrolling.css"/>
<link href="css/jquery.bxslider.css" rel="stylesheet" />


<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>


<!-- bxSlider Javascript file -->


<script src="js/jquery.bxslider.min.js"></script>
<!-- bxSlider CSS file -->



</head>

<body>
<div class="scroll-top-wrapper "> <span class="scroll-top-inner"> <i class="fa fa-arrow-up fa-2x"></i> </span> </div><!-- Scroll Back to top -->
<div id="wrapper">
  <div class="container">
    <?Php include("inc_header.php");?>
  </div>
</div>
<!--./Wrapper Header--->
<div id="wrapperBody">
  <div class="container">
   <!--div class="top-banner"><img src="images/banner_top_2.png" usemap="#Map" border="0" />
     <map name="Map" id="Map">
       <area shape="rect" coords="181,9,348,83" href="pdf/NINE_FormWarrant.pdf" target="_blank" />
       <area shape="rect" coords="367,13,538,81" href="corporate.php" />
       <area shape="rect" coords="557,16,723,76" href="shareholders.php" />
     </map>
   </div-->
    <div class="box-embed">
      <?Php
     ///GEN Latest Video
	 
	  $highlightVideo = $database->select("tbvideo",array("[>]tbprogram"=>"programid"),"*",array("AND"=>array("isHighlight"=>1,"tbvideo.isShow"=>"1"),"ORDER"=>"videoid DESC","LIMIT"=>array(0,1)));
	  foreach($highlightVideo as $highlightVideo2){
		 	  
	 ?>
      <div class="embed-code">
       <?Php
              echo get_youtube_embed($highlightVideo2['url']);
			 ?>
             <script>
             $(".embed-code object embed").css({"width":"469px","height":"300px"});
             </script>
      </div>
     
      <div class="embed-detail">
        <div class="watch-header"> <img src="images/to_watch_head_corner.gif" /> </div>
        <div class="box-channel-logo"> <img src="logo/<?Php echo $highlightVideo2['program_logo']?>" class="logo" />
          <p>ออกอากาศทุก<?Php echo $highlightVideo2['showDate']?><br>
            เวลา <?Php echo $highlightVideo2['showTime']?> ช่อง <?Php echo $highlightVideo2['channel']?></p>
        </div>
        <div class="box-more-button">
          <button onclick="window.location='watch.php?pid=<?Php echo $highlightVideo2['programid']?>';">VIEW<br>
          <b>ALL</b></button>
        </div>
      </div>
	  <?
	  }
	  ?>
      <div class="box-watch-slider">
      <ul id="slide01">
      <?Php
         $vdoList = $database->select("tbvideo","*",array("isShow"=>1,"ORDER"=>"videoid DESC","LIMIT"=>array(1,10)));	  
		  foreach($vdoList as $videoList){
			   echo "<li><a href='watch_detail.php?id=".$videoList['videoid']."'><img src='".youtube_thumb_url($videoList['url'])."' style='width:300px;height:auto;' title='".$videoList['title']."'></a></li>";	
			    
			  } 
	   ?>
        </ul>
      </div>
    </div>
    <!--./box embed--->
    <div class="container-read">
      <hr class="content" />
      <div class="box-read-title">
        <div class="read-header"> <img src="images/to_read_corner.gif" /> </div>
        <p>กลุ่มบริษัทฯ ประกอบธุรกิจตัวแทนจำหน่าย
          สิ่งพิมพ์ต่างประเทศชั้นนำและบริการที่เกี่ยวข้อง
          ผ่านตัวบริษัทฯ เอง ณ วันที่ 31 ธันวาคม  2554 
          สิ่งพิมพ์ที่บริษัทฯให้บริการมีทั้งหมด 118 หัว
          ประกอบด้วยหนังสือพิมพ์ภาษาต่างประเทศ
          และนิตยสารภาษาต่างประเทศ <br />
          <br />
          <a href="section.php?sid=3" class="green">Continue...</a></p>
      </div>
      <div class="box-read-highlight"> 
       <?Php
       $read01 = $database->select("tbcontent","*",array("AND"=>array("isHighlight"=>1,"sectionid"=>3),"ORDER"=>"contentid DESC","LIMIT"=>array(0,1)));
	   foreach($read01 as $rsRead01){
	   ?>
      <img src="thumnail/<?Php echo $rsRead01['picture'];?>" />
        <h3><a href="detail.php?id=<?Php echo $rsRead01['contentid'];?>"><?Php echo $rsRead01['headline']?></a></h3>
        <p><?Php echo $rsRead01['title']?></p>
          
       <?
         }
	   ?>   
      </div>
      <div class="box-read-other">
        <ul>
         <?Php
       $read02 = $database->select("tbcontent","*",array("AND"=>array("isHighlight"=>0,"sectionid"=>3),"ORDER"=>"contentid DESC","LIMIT"=>array(0,2)));
	   foreach($read02 as $rsRead02){
	   ?>
          <li>  <img src="thumnail/<?Php echo $rsRead02['picture'];?>" />
            <h3><a href="detail.php?id=<?Php echo $rsRead02['contentid'];?>"><?Php echo $rsRead02['headline']?></a></h3>
            <p><?Php echo $rsRead02['title']?></p>
          </li>
      <?Php } ?>    
         
        </ul>
        <a href='section.php?sid=3'><img src="images/see_all.gif" /></a> </div>
    </div><!--./read--> 
    
    <div class="container-enjoy">
     <hr class="content" />
     <div class="box-enjoy">
     <div class="enjoy-header">
      <img src="images/to_enjoy_head.gif" />
     </div> 
           <p>NEE ได้รับความไว้วางใจให้เป็นผู้ผลิตนำเข้า และจำหน่ายสื่อสิ่งพิมพ์สำหรับเยาวชนที่ได้รับลิขสิทธิ์จากเจ้าของลิขสิทธิ์
และสำนักพิมพ์ชั้นนำจากกลุ่มประเทศแถบยุโรปอเมริกาและออสเตรเลีย อาทิเช่น Walt Disney, Warner Bros. Simon &Schustersประเทศสหรัฐอเมริกา <br />
          <br />
          <a href="section.php?sid=9" class="green">Nation Kids</a> | <a href="section.php?sid=10" class="green">Charactor Management</a></p>
          
         <div class="box-enjoy-slide">
          <ul>
          <?Php
          /// Call To Enjoy Data
		  
		 /*  $enjoy = $database->select("tbcontent","*",array("AND"=>array("isShow"=>1,"sectionid"=>5),"ORDER"=>"contentid DESC","LIMIT"=>array(0,10)));
		   $i=1;
		  foreach($enjoy as $rsEnjoy){
			  $i = $i % 2;
			  if($i==0){echo "<li class='bg-gray'>";}else{ echo "<li class='bg-black'>"; }
			 
		  ?>
           
           <img src="thumnail/<?Php echo $rsEnjoy['picture'];?>" />
           <h3><a href="detail.php?id=<?Php echo $rsEnjoy['contentid'];?>"><?Php echo $rsEnjoy['headline'];?></a></h3>
           <p><?Php echo $rsEnjoy['title'];?></p>
           </li>
           <?Php
		   $i = $i + 1;
           } */
		   ?>
           
            <?Php  
		  $nationkids = $database->select("tbcontent","*",array("AND"=>array("isShow"=>1,"isHighlight"=>1,"sectionid"=>9),"ORDER"=>"contentid DESC","LIMIT"=>array(0,1)));
		   foreach($nationkids as $rsKids){
		   ?>
           <li class="bg-black"><a href="detail.php?id=<?Php echo $rsKids['contentid'];?>"><img src="thumnail/<?Php echo $rsKids['picture'];?>" /></a>
           <h3><a href="detail.php?id=<?Php echo $rsKids['contentid'];?>"><?Php echo $rsKids['headline'];?></a></h3>
           <p><?Php echo $rsKids['title'];?></p>
           </li>
           <?Php }?>
           
            <?Php  
		  $charactor = $database->select("tbcontent","*",array("AND"=>array("isShow"=>1,"isHighlight"=>1,"sectionid"=>10),"ORDER"=>"contentid DESC","LIMIT"=>array(0,1)));
		   foreach($charactor as $rsCharactor){
		   ?>
           <li class="bg-gray"><a href="detail.php?id=<?Php echo $rsCharactor['contentid'];?>"><img src="thumnail/<?Php echo $rsCharactor['picture'];?>" /></a>
           <h3><a href="detail.php?id=<?Php echo $rsCharactor['contentid'];?>"><?Php echo $rsCharactor['headline'];?></a></h3>
           <p><?Php echo $rsCharactor['title'];?></p>
           </li>
           <?Php }?>
          
          </ul>
         </div>
         <div class="box-enjoy-ad">
          <!--img src="images/ad01.jpg" /-->
          <object width="300" height="300">
    <param name="movie" value="banner/banner-nj2.swf">
    <embed src="banner/banner-nj.swf" width="300" height="300">
    </embed>
</object>

   <script language='JavaScript' type='text/javascript' src='http://adssrv.nationmultimedia.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://adssrv.nationmultimedia.com/adjs.php?n=" + phpAds_random + "&autoPlay=true&play=1&play=true");
   document.write ("&amp;what=zone:45");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://adssrv.nationmultimedia.com/adclick.php?n=a479bea9' target='_blank'><img src='http://adssrv.nationmultimedia.com/adview.php?what=zone:45&amp;n=a479bea9' border='0' alt=''></a></noscript>
         </div>
          <!--div class="box-enjoy-more"><a href='section.php?sid=4'><img src="images/see_all.gif" /></a></div-->
     </div> 
    </div><!----./ Enjoy ---->


<div class="container-expert">
      <hr class="content" />
      <div class="box-expert-title">
        <div class="expert-header"> <img src="images/to_expert_corner.gif" /> </div>
        <p>กลุ่มบริษัทฯ ประกอบธุรกิจตัวแทนจำหน่าย
          สิ่งพิมพ์ต่างประเทศชั้นนำและบริการที่เกี่ยวข้อง
          ผ่านตัวบริษัทฯ เอง ณ วันที่ 31 ธันวาคม  2554 
          สิ่งพิมพ์ที่บริษัทฯให้บริการมีทั้งหมด 118 หัว
          ประกอบด้วยหนังสือพิมพ์ภาษาต่างประเทศ
          และนิตยสารภาษาต่างประเทศ <br />
          <br />
          <a href="section.php?sid=6" class="green">Continue...</a></p>
      </div>
     
     <?Php 
	 /// Get Expert Highlight Data
	 
	 $expert01 = $database->get("tbcontent","*",array("AND"=>array("sectionid"=>6,"isShow"=>1,"isHighlight"=>1),"ORDER"=>"contentid DESC","LIMIT"=>array(0,1)));
	 
	 ?> 
      
      <div class="box-expert-highlight"> <img src="thumnail/<?Php echo $expert01['picture'];?>" />
        <h3><a href="detail.php?id=<?Php echo $expert01['contentid'];?>"><?Php echo $expert01['headline'];?></a></h3>
        <p><?Php echo $expert01['title'];?></p>
          <!--a href="detail.php?id=<?Php echo $expert01['contentid'];?>"><img src="images/see_all2.gif" class="moreBtn" /></a-->
      </div>
      <div class="box-expert-other">
        <ul>
        <?Php
        $expert02 = $database->select("tbcontent","*",array("AND"=>array("sectionid"=>6,"isShow"=>1,"isHighlight[!]"=>1),"ORDER"=>"contentid DESC","LIMIT"=>array(0,2)));
		foreach($expert02 as $rsExpert02){
		?>
          <li> <img src="thumnail/<?Php echo $rsExpert02['picture']; ?>" />
            <h3><a href="detail.php?id=<?Php echo $rsExpert02['contentid'];?>"><?Php echo $rsExpert02['headline'];?></a></h3>
            <p><?Php echo subString($rsExpert02['title']);?></p>
          </li>
        <?Php }?>
        </ul>
        <a href='section.php?sid=6'><img src="images/see_all.gif" /></a> </div>
    </div><!-------./expert----------> 
    
    
     <div class="container-play">
     <hr class="content" />
     <div class="box-play">
     <div class="play-header">
      <img src="images/to_play_corner.gif" />
     </div> 
        <p>NEE ได้รับความไว้วางใจให้เป็นผู้ผลิตนำเข้า และจำหน่ายสื่อสิ่งพิมพ์สำหรับเยาวชนที่ได้รับลิขสิทธิ์จากเจ้าของลิขสิทธิ์
และสำนักพิมพ์ชั้นนำจากกลุ่มประเทศแถบยุโรปอเมริกาและออสเตรเลีย อาทิเช่น Walt Disney, Warner Bros. Simon &Schustersประเทศสหรัฐอเมริกา <br />
          <br />
          <a href="section.php?sid=4" class="green">Continue...</a></p>
         <div class="box-play">
          <div class="box-play-slide">
          <ul id="slide03">
          <?Php  
		  $play = $database->select("tbcontent","*",array("AND"=>array("isShow"=>1,"sectionid"=>4),"ORDER"=>"contentid DESC","LIMIT"=>array(0,10)));
		   foreach($play as $rsPlay){
		   ?>
           <li><a href="detail.php?id=<?Php echo $rsPlay['contentid'];?>"><img src="thumnail/<?Php echo $rsPlay['picture'];?>" /></a></li>
           <?Php }?>
           </ul>
         </div> 
         </div>
         <div class="box-play-more"><a href='section.php?sid=4'><img src="images/see_all.gif" /></a></div>
     </div> 
    </div><!----./ play ---->
    
    <div class="container-learn">
      <hr class="content" />
      <div class="box-learn-title">
        <div class="learn-header"> <img src="images/to_learn_corner.gif" /> </div>
        <p>กลุ่มบริษัทฯ ประกอบธุรกิจตัวแทนจำหน่าย
          สิ่งพิมพ์ต่างประเทศชั้นนำและบริการที่เกี่ยวข้อง
          ผ่านตัวบริษัทฯ เอง ณ วันที่ 31 ธันวาคม  2554 
          สิ่งพิมพ์ที่บริษัทฯให้บริการมีทั้งหมด 118 หัว
          ประกอบด้วยหนังสือพิมพ์ภาษาต่างประเทศ
          และนิตยสารภาษาต่างประเทศ <br />
          <br />
          <!--a href="section.php?sid=2" class="green">Continue...</a></p-->
         <ul style="list-style:none;">
            <li>| <a href="section.php?sid=2" class="green">NJMagazine</a></li>
            <li>| <a href="section.php?sid=11" class="green">B-Bright Academy</a></li>
            <li>| <a href="section.php?sid=12" class="green">Britannica</a></li>
           </ul>

       </div>
      
      <?Php
      /// Gen NJ Learn Data
	  
	  $learn = $database->get("tbcontent","*",array("AND"=>array("sectionid"=>2,"isShow"=>1,"isHighlight"=>1),"ORDER"=>"contentid DESC","LIMIT"=>array(0,1)));
	  
	  ?>
      
      <div class="box-learn-highlight"> <img src="thumnail/<?Php echo $learn['picture'];?>" class="tn_learn" />
        <h3><a href="detail.php?id=<?Php echo $learn['contentid'];?>"><?Php echo $learn['headline'];?></a></h3>
        <p><?Php echo $learn['title'];?></p>
          
      </div>
      <div class="box-learn-other">
        <ul>
       <?Php
        /// Gen Other learn
		$otherLearn01 = $database->select("tbcontent","*",array("AND"=>array("isShow"=>1,"sectionid"=>11,"isHighlight"=>1),"ORDER"=>"contentid DESC","LIMIT"=>array(0,1)));
		foreach($otherLearn01 as $rsOtherLearn01){
		?>
          <li> <img src="thumnail/<?Php echo $rsOtherLearn01['picture'];?>" />
            <h3><a href="detail.php?id=<?Php echo $rsOtherLearn01['contentid'];?>"><?Php echo $rsOtherLearn01['headline'];?></a></h3>
            <p><?Php echo $rsOtherLearn01['title'];?></p>
          </li>
         <?Php }?>
		 
          <?Php
        /// Gen Other learn
		$otherLearn02 = $database->select("tbcontent","*",array("AND"=>array("isShow"=>1,"sectionid"=>12,"isHighlight"=>1),"ORDER"=>"contentid DESC","LIMIT"=>array(0,1)));
		foreach($otherLearn02 as $rsOtherLearn02){
		?>
          <li> <img src="thumnail/<?Php echo $rsOtherLearn02['picture'];?>" />
            <h3><a href="detail.php?id=<?Php echo $rsOtherLearn02['contentid'];?>"><?Php echo $rsOtherLearn02['headline'];?></a></h3>
            <p><?Php echo $rsOtherLearn02['title'];?></p>
          </li>
         <?Php }?>
        </ul>
        <!--a href='section.php?sid=2'><img src="images/see_all.gif" /></a--> </div>
    </div><!-------./learn----------> 
    
     <div class="container-join">
     
     <hr class="content" />
       <div class="box-join">
         <div class="join-header">
          <img src="images/to_join_corner.gif" />
            <p>อัพเดทเรื่องราว ข่าวสาร กิจกรรม ในเครือ NINE</p>
         </div>
         <div class="join-slide">
          <ul id="slide04">
          
          <?Php
            $join = $database->select("tbcontent","*",array("AND"=>array("sectionid"=>1,"isShow"=>1),"ORDER"=>"contentid DESC","LIMIT"=>array(0,2)));
			foreach($join as $rsJoin){
		  ?>
           <li>
           <img src="thumnail/<?Php echo $rsJoin['picture'];?>" />
           <p><?Php echo $rsJoin['headline'];?><br><a href="detail.php?id=<?Php echo $rsJoin['contentid'];?>" class="green">Continue...</a></p>
           </li>
            <?Php }?>
                            
          </ul>
          
         </div>      
           <div class="box-join-more"><a href="section.php?sid=1"><img src="images/see_all.gif" /></a></div> 
       </div>
      
    </div><!----./ Join ---->
    
    
    <div class="container-order" style="display:none;">
    <hr class="content" />
    <div class="box-order-header">
     <img src="images/to_order_corner.gif" />
     </div>
     <p>NSOTRE ดำเนินธุรกิจการผลิตและจัดจำหน่ายสิ่งพิมพ์อิเล็กทรอนิกส์<br>
หลากหลายแนวที่สอดคล้องกับรสนิยมการอ่านในแต่ละไลฟ์สไตล์<br>
<br>
<a href="http://www.nstore.net" class="green" target="_blank">Continue...</a></p>
     <div class="box-nstore">
      <div class="box-nstore-code">
      <center>
       <iframe src="http://nstore-static.s3.amazonaws.com/nstore/index_600x250.html" width="600" height="250" scrolling="no" border="0" marginwidth="0" style="border:none;" frameborder="0"></iframe>
     </center>
      </div>
      
      
     </div>
     <div><a href="http://www.nstore.net" target="_blank"><img src="images/see_all.gif" class="right" /></a></div>
     <hr class="content" />
    </div><!---./Order----->
  </div><!----./container Body---->
</div><!-------./Wrapper Body----------->

<div id="wrapper_footer">
 <div class="container">
  <?Php include("inc_footer.php");?>
 </div>
</div><!--./Wrapper Footer-->


<script>
 $('#slide01').bxSlider({
minSlides: 4,
  maxSlides: 4,
  slideWidth: 400,
  slideMargin: 10,
  auto:true,
  captions:true
});

$('#slide02').bxSlider({
minSlides: 2,
  maxSlides: 2,
  slideWidth: 300,
  slideMargin: 10
});

$('#slide03').bxSlider({
auto:true,	
minSlides: 5,
  maxSlides: 5,
  slideWidth: 300,
  slideMargin: 10
});

$(function(){
 
    $(document).on( 'scroll', function(){
 
        if ($(window).scrollTop() > 100) {
            $('.scroll-top-wrapper').addClass('show');
        } else {
            $('.scroll-top-wrapper').removeClass('show');
        }
    });
 
    $('.scroll-top-wrapper').on('click', scrollToTop);
});
 
function scrollToTop() {
    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
    element = $('body');
    offset = element.offset();
    offsetTop = offset.top;
    $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}
//88888
</script>

</body>

</html>