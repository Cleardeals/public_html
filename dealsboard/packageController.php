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

$page = $dbObj->sc_mysql_escape($_REQUEST['page']); // paging variable
$set = $dbObj->sc_mysql_escape($_REQUEST['set']); // paging variable

$mode = $_REQUEST['mode'] ?? ""; // action to perform
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$info = $_REQUEST['info']; // data array sent from form

//mode to  add/update package list
if($mode=="add_update_package_list"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$packageList = $dbObj->sc_mysql_escape($_REQUEST['packageList'] ?? "");
	
	if(!empty($id)){
		
		modify_record($dbObj,PREFIX.'package_list',$info,'id='.$id); 
		//echo $dbObj->dbQuery;exit;
			
		$msg = base64_encode("Record Modified Successfully ."); // message about action performed
		header('location:index.php?mo=package_list&msg='.$msg.'&packageList='.$packageList.'&set='.$set.'&page='.$page);
		exit;
	
	} else{
	
		$info['status'] = '1';
		$info['display_order'] = '0';
		$info['published_on'] = date('Y-m-d');
		add_record($dbObj,PREFIX.'package_list',$info); 
		//echo $dbObj->dbQuery;exit;
		
		$dbObj->dbQuery = "select * from ".PREFIX."package_list where package='".$info['package']."' order by display_order ASC";
		$order = $dbObj->SelectQuery();
			
		for($i=0;$i<count($order);$i++){
			$dbObj->dbQuery = "update ".PREFIX."package_list set display_order='".($i+1)."' where id=".$order[$i]['id'];
			$dbObj->ExecuteQuery();
		}
	
		$msg = base64_encode("Record Saved Successfully ."); // message about action performed
		header('location:index.php?mo=package_list&msg='.$msg);
		exit;
	}
}

//mode to change package list status
if($mode=="package_list_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval']);
	
	//to update status
	$dbObj->dbQuery = "update ".PREFIX."package_list set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to change package list display order
if ($mode == "change_package_list_order"){
	//echo $_REQUEST['tdata'];
	$tdata = explode(",",$dbObj->sc_mysql_escape($_REQUEST['tdata']));
	
	$list = 1;
	for($i=0;$i<count($tdata);$i++){
		$query = "UPDATE ".PREFIX."package_list SET display_order = " . $list . " WHERE id = ".$tdata[$i];
		mysqli_query($dbObj->connection, $query) or die('Error, insert query failed');
		$list++;
	}
}


//mode to delete package list
if($mode=='delete_package_list'){  // to delete seleted record
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'package_list','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."package_list order by display_order asc";
	$dbResult1 = $dbObj->SelectQuery();
	
	for($k=0;$k<count((array)$dbResult1);$k++){
		$dbObj->dbQuery = "update ".PREFIX."package_list set display_order='".($k+1)."' where id=".$dbResult1[$k]['id'];
	    $dbObj->ExecuteQuery();
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=package_list&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

//mode to update package
if($mode=="update_sell_package"){
	
	//sell property
	$info['property_type'] = 'sell';
	$info['status'] = '1';
	$info['published_on'] = date('Y-m-d');
	modify_record($dbObj,PREFIX.'package',$info,'id=1'); 
	//echo $dbObj->dbQuery;exit;
	
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=sell-property&msg='.$msg);
	exit;
}

if($mode=="update_rent_package"){
	
	$rdata = $_REQUEST['rdata'];
	
	//rent property
	$rdata['property_type'] = 'rent';
	$rdata['status'] = '1';
	$rdata['published_on'] = date('Y-m-d');
	modify_record($dbObj,PREFIX.'package',$rdata,'id=2'); 
	//echo $dbObj->dbQuery;exit;
	
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=rent-property&msg='.$msg);
	exit;
}
?>