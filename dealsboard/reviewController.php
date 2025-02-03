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

//mode to change review status
if($mode=="review_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."review set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to change review home status
if($mode=="review_home_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."review set home_status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to change review sell status
if($mode=="review_sell_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."review set sell_status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to change review rent status
if($mode=="review_rent_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."review set rent_status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to delete review
if($mode=='delete_review'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count($id);$i++){
	
	delete_record($dbObj,PREFIX.'review','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."review where id=".$id;
	$Review = $dbObj->SelectQuery();
		
		for($i=0;$i<count($Review);$i++){
			$dbObj->dbQuery = "update ".PREFIX."review set display_order='".($i+1)."' where id=".$Review[$i]['id'];
			$dbObj->ExecuteQuery();
			//echo $dbObj->ExecuteQuery;exit;
		}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=delete_review&id='.$id.'&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

if ($mode == "change_review_order"){
	
	$tdata = explode(",",$dbObj->sc_mysql_escape($_REQUEST['tdata']));
	$list = 1;
	for($i=0;$i<count($tdata);$i++){
		$query = "UPDATE ".PREFIX."review SET display_order = " . $list . " WHERE id = ".$tdata[$i];
		mysqli_query($dbObj->connection, $query) or die('Error, insert query failed');
		$list++;
	}
	
}

//mode to delete Admin review
if($mode=='delete_admin_review'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);//exit;  // array of selected record ids to delete
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."review set admin_del='1' where id=".$id;
	$dbObj->ExecuteQuery();
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=review&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to review Restore
if($mode=='review_restore'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");//exit;  // array of selected record ids to delete
	
	// to update Image status
	$dbObj->dbQuery = "update ".PREFIX."review set admin_del='0' where id=".$id;
	$dbObj->ExecuteQuery();
	
	$msg = base64_encode("Record Restore Successfully."); // message about action performed
	header('location:index.php?mo=property&id='.$id.'&msg='.$msg);
	exit;	
}

//mode to delete deleted review
if($mode=='delete_deleted_review'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	//for($i=0;$i<count($id);$i++){
	
	delete_record($dbObj,PREFIX.'review','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	//}
	
	$dbObj->dbQuery = "select * from ".PREFIX."review where id=".$id;
	$Review = $dbObj->SelectQuery();
		
		for($i=0;$i<count($Review);$i++){
			$dbObj->dbQuery = "update ".PREFIX."review set display_order='".($i+1)."' where id=".$Review[$i]['id'];
			$dbObj->ExecuteQuery();
			//echo $dbObj->ExecuteQuery;exit;
		}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=deleted_review&id='.$id.'&msg='.$msg);
	exit;	
}
?>