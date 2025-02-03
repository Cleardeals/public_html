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
$info = $_REQUEST['info'] ?? ""; // data array sent from form

//mode to add /update Services
if($mode=="add_update_services"){
	
	$info = $_REQUEST['info'];
	
	//code to upload images
	if(isset($_FILES['image']) && $_FILES['image']['size']>0){
	
		$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name']); // to remane image
		$temp = explode('.',$_FILES['image']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=services&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$info['image'] = $image_name;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."services WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery();
		
		if(file_exists(SERVICES_IMAGE_PATH.$imgRes[0]['image']) && !empty($imgRes[0]['image'])){
			unlink(SERVICES_THUMB_IMAGE_PATH.$imgRes[0]['image']); // remove resize image from thumbd folder
			unlink(SERVICES_IMAGE_PATH.$imgRes[0]['image']); // remove original image form folder
		}
		
		resize_img_new($_FILES['image']['tmp_name'],327,$ext,SERVICES_THUMB_IMAGE_PATH.$image_name); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image']['tmp_name'],SERVICES_IMAGE_PATH.$image_name); // upload original image in original folder
	}
	
	if(!empty($id)){
	
	modify_record($dbObj,PREFIX.'services',$info,'id='.$id);
	//echo $dbObj->dbQuery;//exit;
		
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=services&msg='.$msg);
	exit;
	
	} else {
	
	$info['published_on'] = date('Y-m-d');
	add_record($dbObj,PREFIX.'services',$info); 
	//echo $dbObj->dbQuery;exit;
	
	$msg = base64_encode("Record Saved Successfully");  // message about action performed
	header('location:index.php?mo=services&msg='.$msg);
	exit;
	}
}

//mode to change service status
if($mode=="service_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."services set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to delete Services
if($mode=='delete_services'){  // to delete seleted record
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:index.php?mo=services&id='.$id.'&msg='.$msg);
	   exit;	
	}	
	
	for($i=0;$i<count($id);$i++){
	
	delete_record($dbObj,PREFIX.'services','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	// to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."services where id=".$id[$i];
	$dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;
	 
	if(file_exists(SERVICES_IMAGE_PATH.$dbResult[0]['image']) && !empty($dbResult[0]['image'])){ 
		unlink(SERVICES_THUMB_IMAGE_PATH.$dbResult[0]['image']); // remove resize image from thumbd folder
		unlink(SERVICES_IMAGE_PATH.$dbResult[0]['image']); // remove original image form folder
	}	
	
	}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=services&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to delete Single service
if($mode=='delete_single_service'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	delete_record($dbObj,PREFIX.'services','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	//to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."services where id=".$id;
	$dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;
	 
	if(file_exists(SERVICES_IMAGE_PATH.$dbResult[0]['image']) && !empty($dbResult[0]['image'])){ 
		unlink(SERVICES_THUMB_IMAGE_PATH.$dbResult[0]['image']); // remove resize image from thumbd folder
		unlink(SERVICES_IMAGE_PATH.$dbResult[0]['image']); // remove original image form folder
	}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=services&id='.$id.'&msg='.$msg);
	exit;	
}
?>