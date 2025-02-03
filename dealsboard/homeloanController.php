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

$page = $dbObj->sc_mysql_escape($_REQUEST['page'] ?? ""); //paging variable
$set = $dbObj->sc_mysql_escape($_REQUEST['set'] ?? ""); //paging variable

$mode = $dbObj->sc_mysql_escape($_REQUEST['mode'] ?? ""); //action to perform
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$info = $_REQUEST['info'] ?? ""; // data array sent from form

//mode to delete home loan enquiry
if($mode=='delete_eligibility'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'home_loan_enquiry','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=eligibility&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}


//mode to delete home loan enquiry
if($mode=='delete_emi'){  //to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  //array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'home_loan_enquiry','id='.$id[$i]); //to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); //message about action performed
	header('location:index.php?mo=emi&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}
?>