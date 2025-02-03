<?php
ob_start();// turn on output buffering
session_start();//start new or resume existing session
ini_set('memory_limit','128M'); // to increse upload limit to upload files
require_once('config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
$dbObj = new DBConnection(); // database connection

$page = $_REQUEST['page'] ?? ""; // paging variable
$set = $_REQUEST['set'] ?? ""; // paging variable

$mode = $_REQUEST['mode'] ?? ""; // action to perform
$id = $_REQUEST['id'] ?? "";


// mode to change chat view status
if($mode=="view_chat"){
	//echo $chatId = $_REQUEST['param_div_id'];
	$chatId = $dbObj->sc_mysql_escape($_REQUEST['id']);
	//echo $chatId[1];
	//exit;
	
	$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$chatId."'";
	$dbUser = $dbObj->SelectQuery();
	
	// to update 
	$dbObj->dbQuery = "update ".PREFIX."find_msg set user_read_status='read' where username='".$dbUser[0]['username']."'";
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;exit;

	header('location:'.HTACCESS_URL.'support/');
	exit;
}

// mode to send msg
if($mode=="send_msg"){
	$info = $_REQUEST['info'];
	$user_msg = $dbObj->sc_mysql_escape($_REQUEST['user_msg']);
	//exit;
	
	// code to upload attachment
	if(isset($_FILES['user_attach']) && $_FILES['user_attach']['size']>0){
	
		$image_name = time().'_'.str_replace(' ','-',$_FILES['user_attach']['name']); // to remane image
		$temp = explode('.',$_FILES['user_attach']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		/*if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG' && $ext!='pdf' && $ext!='PDF' && $ext!='xls' && $ext!='xlsx' && $ext!='docx' && $ext!='DOCX'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=find-property&id='.$id.'&msg='.$msg);
			exit;
		}*/
		
		$info['user_attach'] = $image_name;

		// to remove image
		/*$dbObj->dbQuery = "select * from ".PREFIX."sitecontent WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery();
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['admin_attach']) && !empty($imgRes[0]['admin_attach'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['admin_attach']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['admin_attach']); // remove original image form folder
		}*/
		
		//resize_img_new($_FILES['admin_attach']['tmp_name'],1903,PAGES_THUMBS_IMAGE_PATH.$image_name,$ext); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['user_attach']['tmp_name'],CHAT_ATTACHMENT.$image_name); // upload original image in original folder
	}//exit;
	
	$info['username'] = $dbObj->sc_mysql_escape($_REQUEST['username']);
	$info['user_msg'] = $user_msg;
	$info['user_read_status'] = 'read';
	$info['msgDatetime'] = date('Y-m-d H:i:s');
	$lastId = add_record($dbObj,PREFIX.'find_msg',$info);
	//echo $dbObj->dbQuery;exit;
	
	// to update 
	$dbObj->dbQuery = "update ".PREFIX."user_detail set admin_read_status='unread' where username='".$username."'";
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;exit;
	
	//$dbObj->dbQuery="select * from ".PREFIX."find_msg where user_id='".$user_id."' and id='".$lastId."'";
	//$dbRes = $dbObj->SelectQuery();
	
	//echo $dbRes[0]['user_msg'];
	header('location:'.HTACCESS_URL.'support/');
	//echo $set_val;
	exit;
}

?>