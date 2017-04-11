<?php 
	session_start();
	error_reporting(0);
	if(empty($_SESSION['UserID'])){
		header('Location:../index.php');
		exit();
	}
	define('ROOT_PATH', '../');
	define('ADMIN_PATH_IMG_CONTENT','../../../content/home/media/img/size_content/');
	define('WEB_PATH_IMG_CONTENT','http://www.komchadluek.net/media/img/size_content/');
	//define('WEB_PATH_IMG_CONTENT','http://localhost/new_kom2012/content/home/media/img/size_content/');
	
	require(ROOT_PATH.'include/libs/class/database/setting.inc.php');
	require(ROOT_PATH.'include/libs/class/database/new_db_mysql/db.mysql.php');
	require(ROOT_PATH.'include/libs/class/database/new_db_mysql/connect_db.php');
	include(ROOT_PATH.'include/libs/class/utilities/phpthumb/ThumbLib.inc.php');
	include(ROOT_PATH.'include/libs/function/custom_function.php');

	import_request_variables('p','p_');	
	$current_dt=date('Y-m-d H:i:s');
	$dt_dir=date('Y/m/d/');
	//upload photo
	  if(isset($_FILES['file_img_upload'])&& count($_FILES['file_img_upload']["tmp_name"])){
		  foreach($_FILES['file_img_upload']["tmp_name"] as $k =>$v){
            $thumb = PhpThumbFactory::create($_FILES['file_img_upload']["tmp_name"][$k]);
			$new_photo_name=$thumb->rename_thumb_name(basename($_FILES['file_img_upload']['name'][$k]));
			$new_photo_name_medium_size='medium_'.$new_photo_name;
			$new_photo_name='big_'.$new_photo_name;
			$thumb->setOptions(array('jpegQuality'=>80));
			$thumb->correctPermissions=true;
			if($_POST['photo_size']){
				$_POST['photo_size']=intval($_POST['photo_size']);
				$thumb->resize($_POST['photo_size']);
			}else{
				$thumb->resize(680);
			}
			
			$thumb->rmkdir(ADMIN_PATH_IMG_CONTENT.$dt_dir);
			$thumb->save(ADMIN_PATH_IMG_CONTENT.$dt_dir.$new_photo_name);
			//-----------------------------
			$thumb = PhpThumbFactory::create($_FILES['file_img_upload']["tmp_name"][$k]);
			$thumb->setOptions(array('jpegQuality'=>80));
			$thumb->resize(414);
			$thumb->save(ADMIN_PATH_IMG_CONTENT.$dt_dir.$new_photo_name_medium_size);
			//-----------------------------
			$arr_tb_content_photo=array();
			$arr_tb_content_photo['photo_url']=$dt_dir.$new_photo_name;
			 $arr_tb_content_photo['user_id']=$_SESSION['UserID'];
			 $arr_tb_content_photo['dt_create']=$current_dt;
			 $db->insert('tkcl_content_photo',$arr_tb_content_photo); 
		  }
	  }
     //end upload photo
	 echo('.');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>upload image</title>
<script type="text/javascript" src="<?php echo(ROOT_PATH); ?>include/js/jquery/jquery-1.6.2.min.js"></script>
<style type="text/css">
body{
	width:70%;
}
img{
	border:0px;
	cursor:pointer;
}
table {}
table th{ background-color:#fffdfa;color:#818181; text-align: left; padding:7px 10px; border-bottom:solid 1px #d2d1cb;}
table td{ background:#fbfcfc;  border-bottom:solid 1px #e0e0e0; padding:8px 10px; }
table tr.odd td{ background:#f8f8f8; }
table tr:hover td{ background:#fff9e1; }
table a.ico{ }
</style>
</head>
<body >
<!-- Header -->
				<!-- Box -->
			  <div class="box" id="frm_person" style="display:block;width:500px;height:150px;">
					<!-- Box Head -->
					<div class="box-head">
						<h2 id="title_head">upload content img</h2>
					</div>
					<!-- End Box Head -->
					
					<form action="" method="post"  enctype="multipart/form-data"  id="frm_ck_upload">
						
						<!-- Form -->
						<div class="form">
                        <p class="inline-field">
						      <label class="margin_bottom10">รูป</label>
								<input type="file" name="file_img_upload[]" id="file_img_upload"  multiple accept="image/*" />
								<span id="show_person_img"></span>
                        </p>
							
            </div>
						<!-- End Form -->
						
						<!-- Form Buttons -->
						<div class="buttons">
							<input type="submit" class="button" value="upload" onClick="jQuery(this).val('กำลังอัพโหลดรูป').attr('disabled','disabled');jQuery('#frm_ck_upload').submit();"/>
						</div>
						<input type="hidden" name="photo_size" value="<?php echo($_GET['photo_size']); ?>"  />
						<!-- End Form Buttons -->
					</form>
				</div>
				<!-- End Box -->
				<script type="text/javascript">
					function assignPhotoToCK(url){	
						//window.opener.CKEDITOR.tools.callFunction('<?php echo($_GET['CKEditorFuncNum'] ); ?>', url);
						window.opener.CKEDITOR.tools.callFunction( <?php echo($_GET['CKEditorFuncNum'] ); ?>, url, function() {
							
						} );
						window.close();
					}
				</script>
				<?php 
						$r_tb=$db->select("select * from tkcl_content_photo where user_id='".$_SESSION['UserID']."'  order by dt_create DESC limit 10;") ; 
						$total_limit=$db->num_rows($r_tb);
						$str_table='<table id="tb_infor" class="table" width="100%" border="0" cellspacing="0" cellpadding="0">
						<tbody><tr>
						<th>#</th>
						<th>รูป</th>
						</tr>';
						for($i=1;$i<=$total_limit;$i++){
								$v_tb=$db->fetch_assoc($r_tb);
								$str_table.='<tr>';
								$str_table.='<td>'.($i).'</td>';
								$str_table.='<td align="center" class="load_thumb"  ><img src="'.WEB_PATH_IMG_CONTENT.$v_tb['photo_url'].'" width="100px" onClick="assignPhotoToCK($(this).attr(\'src\'));"/></td>';
								$str_table.='</tr>';
						}
						$str_table.='</tbody></table>';
						echo($str_table);
				?>
<!-- End Footer -->
</body>
</html>