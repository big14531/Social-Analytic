<?php
/*include(WEB_ROOT_DIR.'sp-app/config/app.php');
$file_name='';
if(isset($_FILES)){
	foreach($_FILES as $k => $v){
 	 	$fileName = $v["name"];
 		move_uploaded_file($v["tmp_name"],ROOT_UPLOAD_DIR.PHOTOGALLERY_DIR.$fileName);
		$file_name=WEB_URL.PHOTOGALLERY_DIR.$fileName;
	}
 }
 $funcNum = $_GET['CKEditorFuncNum'] ;
 */
 ?>
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
	  if(isset($_FILES['upload'])&& file_exists($_FILES['upload']["tmp_name"])){
            $thumb = PhpThumbFactory::create($_FILES['upload']["tmp_name"]);
			$new_photo_name=$thumb->rename_thumb_name(basename($_FILES['upload']['name']));
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
			$thumb->resize(414);
			$thumb->save(ADMIN_PATH_IMG_CONTENT.$dt_dir.$new_photo_name_medium_size);
			//-----------------------------
			$arr_tb_content_photo=array();
			$arr_tb_content_photo['photo_url']=$dt_dir.$new_photo_name;
			 $arr_tb_content_photo['user_id']=$_SESSION['UserID'];
			 $arr_tb_content_photo['dt_create']=$current_dt;
			 $db->insert('tkcl_content_photo',$arr_tb_content_photo); 
	  }
	   $funcNum = $_GET['CKEditorFuncNum'] ;
     //end upload photo
?>
<script type="text/javascript">
window.parent.CKEDITOR.tools.callFunction( <?php echo($funcNum); ?>, '<?php echo(WEB_PATH_IMG_CONTENT.$dt_dir.$new_photo_name); ?>', ''); 
</script>