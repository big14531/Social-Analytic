<?php
//query ข่าวโดยระบุเงื่อนไขช่วงวันจาก databse มาแล้วเอามาเปรียบเทียบ
// โค้ด เช็คข่าวที่มีเนื้อหาที่ใกล้เคียงกันมากที่สุด

//ตัวอย่างข่าวที่ดึงมาจาก database
$v_news=array(
              '\'ทรัมป์\' ชม จนท.จับคนร้ายเร็ว',
              'ทรัมป์เริ่มทยอยไล่จนท.ในรัฐบาลโอบามาออก',
              'ระทึก! จนท.กัน \'ทรัมป\' ลงเวทีที่เนวาดา หลังจับชายต้องสงสัย(ชมคลิป)',
              '\'ทรัมป์\' เล็งเพิ่มงบประมาณกองทัพครั้งประวัติศาสตร์',
              'ประมวลภาพ อเมริกันนับถอยหลัง ทรัมป์ สาบานตนรับตำแหน่ง ปธน.ใหม่',
              '"จอร์จ ดับเบิล ยู บุช" ช่วยน้องหาเสียง'
            );
// pattern regular expression, i=case-insensitive search
$main_string='/ทรัมป์|จนท|ทำงานรวดเร็ว|ชม|จับ|คน|ร้าย|บุก|ทำ|เนียบ|ขาว|รวด|เร็ว/i';
$arr_count_match=array();
foreach($v_news as $k =>$v)
{
  //เช็คข่าวแต่ละข่าวว่าข่าวไหนที่มีคำตรงกับกลุ่มคำที่ต้องการหามากที่สุด
  $v_check_match=preg_match_all($main_string,$v, $matches);
  //print_r($v.'<br>');
//  print_r($matches);
  //$arr_count_match[$k]=0;
  // ถ้าเช็คแล้วมีเจอคำมากว่าหรือเท่า 1 คำหรือเปล่า
  if($v_check_match)
  {
    $arr_count_match[$k]=count($matches[0]);
  }

}
// เรียงข้อมูลใน array  จากมากไปน้อย
arsort($arr_count_match);
$arr_complete_sort=array();
$i=0;
foreach($arr_count_match as $k =>$v_total_match)
{
  $arr_complete_sort[$i]['title']=$v_news[$k];
  $arr_complete_sort[$i]['total_match']=$v_total_match;
  $i++;
}
print_r($arr_complete_sort);
?>
