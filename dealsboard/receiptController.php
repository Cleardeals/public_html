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

$page = $dbObj->sc_mysql_escape($_REQUEST['page'] ?? ""); // paging variable
$set = $dbObj->sc_mysql_escape($_REQUEST['set'] ?? ""); // paging variable

$mode = $_REQUEST['mode'] ?? ""; // action to perform
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$info = $_REQUEST['info'] ?? ""; // data array sent from form

if($mode=="generatemnr"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? ""); // id to modify record
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."adminuser where id='".$dbObj->sc_mysql_escape($_SESSION['srgit_cms_admin_id'])."' ";
	$dbAdmin = $dbObj->SelectQuery('edithome.php','aboutEdit()');
	
	$info['createdby'] = $dbAdmin[0]['full_name'];
	if(!empty($id)){ // check requested id to update record
	    
		modify_record($dbObj,PREFIX.'receipt',$info,'id='.$id); 
		//echo $dbObj->dbQuery;exit;
		
		$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	    header('location:index.php?mo=receipt&msg='.$msg.'&id='.$id.'&page='.$page.'&set='.$set);
	    exit;
		
	} else { // if id is empty than add new record\
		$info['recp_date'] = date('Y-m-d');
		$info['status'] = 1;
		
		$rid = add_record($dbObj,PREFIX.'receipt',$info); 
		//echo $dbObj->dbQuery;
		$recep_no = 'CDC00'.$rid;
		
		// to update Image status
		$dbObj->dbQuery = "update ".PREFIX."receipt set recep_no='".$recep_no."' where id=".$rid;
		$dbObj->ExecuteQuery();//exit;
		
		$msg = base64_encode("Record Saved Successfully");  // message about action performed
	    header('location:index.php?mo=receipt&msg='.$msg.'&id='.$id.'&page='.$page.'&set='.$set);
	    exit;
	} 
}

//mode to change receipt status
if($mode=="receipt_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."receipt set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to delete receipt
if($mode=='delete_receipt'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	delete_record($dbObj,PREFIX.'receipt','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=receipt&id='.$id.'&msg='.$msg);
	exit;	
}
?>