<?php
ob_start(); // turn on output buffering
session_start(); //start new or resume existing session
ini_set('memory_limit','128M'); // to increse upload limit to upload files
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
$dbObj = new DBConnection(); // database connection

login_check();

$mode = $_REQUEST['mode'] ?? ""; // action to perform
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
//$info = $_REQUEST['info'] ?? ""; // data array sent from form

// mode to change chat view status
if($mode=="view_chat"){
	//echo $chatId = $_REQUEST['param_div_id'];
	$chatId = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	//echo $chatId[1];
	//exit;
	
	$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$chatId."'";
	$dbUser = $dbObj->SelectQuery();
	
	// to update 
	$dbObj->dbQuery = "update ".PREFIX."find_msg set admin_read_status='read' where username='".$dbUser[0]['username']."'";
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;exit;
	
	// to update 
	$dbObj->dbQuery = "update ".PREFIX."user_detail set admin_read_status='read' where username='".$dbUser[0]['username']."'";
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;exit;
	
	// to update 
	$dbObj->dbQuery = "update ".PREFIX."find_property set view_status='1' where user_id=".$chatId;
	$dbObj->ExecuteQuery();
	//echo $dbObj->dbQuery;
	
	header('location:index.php?mo=find-property&id='.$chatId);
	exit;
}

//mode to send msg
if($mode=="send_msg"){
	 
	 $id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	 $username = $dbObj->sc_mysql_escape($_REQUEST['username'] ?? "");
	//echo $admin_msg = $_POST['admin_msg'];exit;
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail where id='".$id."' order by id";
	$dbUserDetail = $dbObj->SelectQuery();
	
	for($i=0;$i<count((array)$dbUserDetail);$i++){
		$info['admin_msg'] = $_POST["admin_msg".$dbUserDetail[$i]['id']];
		
		// code to upload attachment
	if(isset($_FILES['admin_attach'.$dbUserDetail[$i]['id']]) && $_FILES['admin_attach'.$dbUserDetail[$i]['id']]['size']>0){
	
		$image_name = time().'_'.str_replace(' ','-',$_FILES['admin_attach'.$dbUserDetail[$i]['id']]['name']); // to remane image
		$temp = explode('.',$_FILES['admin_attach'.$dbUserDetail[$i]['id']]['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG' && $ext!='pdf' && $ext!='PDF' && $ext!='xls' && $ext!='xlsx' && $ext!='docx' && $ext!='DOCX'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=find-property&id='.$id.'&msg='.$msg);
			exit;
		}
		
		 $info['admin_attach'] = $image_name;
		
		move_uploaded_file($_FILES['admin_attach'.$dbUserDetail[$i]['id']]['tmp_name'],CHAT_ATTACHMENT.$image_name); // upload original image in original folder
	}
	}
	//print_r($info);
	//exit;
	
	$info['username'] = $username;
	//$info['admin_msg'] = $admin_msg;
	$info['admin_read_status'] = 'read';
	$info['msgDatetime'] = date('Y-m-d H:i:s');
	$lastId = add_record($dbObj,PREFIX.'find_msg',$info); 
	//echo $dbObj->dbQuery;
	
	//$dbObj->dbQuery="select * from ".PREFIX."find_msg where user_id='".$user_id."' and id='".$lastId."'";
	//$dbRes = $dbObj->SelectQuery();
	
	//echo $dbRes[0]['admin_msg'];
	//echo $set_val;
	header('location:index.php?mo=find-property&id='.$id);
	exit;
}
?>