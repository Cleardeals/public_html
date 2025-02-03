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

//mode to add / update career
if($mode=="add_update_career"){
	
	$info = $_REQUEST['info'];
	
	if(!empty($id)){
		
	$info['published_on'] = date('Y-m-d');
	modify_record($dbObj,PREFIX.'career',$info,'id='.$id); 
	//echo $dbObj->dbQuery;exit;
	
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=career&msg='.$msg);
	exit;
	
	} else {
		
	$info['display_order'] = 0;
	$info['status']= 1;
	$info['published_on'] = date('Y-m-d');
	add_record($dbObj,PREFIX.'career',$info); 
	//echo $dbObj->dbQuery;exit;
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."career order by display_order ASC";
	$dbFaq = $dbObj->SelectQuery();
	
	for($k=0;$k<count($dbFaq);$k++){
		$dbObj->dbQuery = "update ".PREFIX."career set display_order='".($k+1)."' where id=".$dbFaq[$k]['id'];
		$dbObj->ExecuteQuery();
	}
	
	$msg = base64_encode("Record Saved Successfully");  // message about action performed
	header('location:index.php?mo=career&msg='.$msg);
	exit;
	}
}

// mode to change career status
if($mode=="career_status"){
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."career set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to delete career
if($mode=='delete_career'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:index.php?mo=career&id='.$id.'&msg='.$msg);
	   exit;
	}	
	
	for($i=0;$i<count($id);$i++){
	
	delete_record($dbObj,PREFIX.'career','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."career where id=".$id;
	$Career = $dbObj->SelectQuery();
		
		for($i=0;$i<count($Career);$i++){
			$dbObj->dbQuery = "update ".PREFIX."career set display_order='".($i+1)."' where id=".$dbObj->sc_mysql_escape($Career[$i]['id']);
			$dbObj->ExecuteQuery();
			//echo $dbObj->ExecuteQuery;exit;
		}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=career&id='.$id.'&msg='.$msg);
	exit;
}

//mode to delete career
if($mode=='delete_single_career'){  // to delete seleted record
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	delete_record($dbObj,PREFIX.'career','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	$dbObj->dbQuery = "select * from ".PREFIX."career where id=".$id;
	$Career = $dbObj->SelectQuery();
		
		for($i=0;$i<count($Career);$i++){
			$dbObj->dbQuery = "update ".PREFIX."career set display_order='".($i+1)."' where id=".$dbObj->sc_mysql_escape($Career[$i]['id']);
			$dbObj->ExecuteQuery();
			//echo $dbObj->ExecuteQuery;exit;
		}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=career&id='.$id.'&msg='.$msg);
	exit;
}


if ($mode == "change_career_order"){
	
	$tdata = explode(",",$dbObj->sc_mysql_escape($_REQUEST['tdata']));
	$list = 1;
	for($i=0;$i<count($tdata);$i++){
		$query = "UPDATE ".PREFIX."career SET display_order = " . $list . " WHERE id = ".$tdata[$i];
		mysqli_query($dbObj->connection, $query) or die('Error, insert query failed');
		$list++;
	}	
}
?>