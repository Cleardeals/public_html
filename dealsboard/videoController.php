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

//mode to add/update video
if($mode=="add_update_video"){

	$info = $_REQUEST['info'];

	if(!empty($id)){

	$info['published_on'] = date('Y-m-d');

	modify_record($dbObj,PREFIX.'testimonial_video',$info,'id='.$id); 
	//echo $dbObj->dbQuery;exit;

	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=video_testimonial&msg='.$msg);
	exit;

	} else {

	$info['display_order'] = 0;
	$info['status']= 1;
	$info['published_on'] = date('Y-m-d');

	add_record($dbObj,PREFIX.'testimonial_video',$info); 
	//echo $dbObj->dbQuery;exit;

	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."testimonial_video order by display_order ASC";
	$dbFaq = $dbObj->SelectQuery();

	for($k=0;$k<count($dbFaq);$k++){
		$dbObj->dbQuery = "update ".PREFIX."testimonial_video set display_order='".($k+1)."' where id=".$dbFaq[$k]['id'];
		$dbObj->ExecuteQuery();
	}

	$msg = base64_encode("Record Saved Successfully");  // message about action performed
	header('location:index.php?mo=video_testimonial&msg='.$msg);
	exit;
	}
}

//mode to change video status
if($mode=="video_status"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update video status
	$dbObj->dbQuery = "update ".PREFIX."testimonial_video set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();

	echo $set_val;
	exit;
}

//mode to delete video
if($mode=='delete_video'){  // to delete seleted record
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete

	delete_record($dbObj,PREFIX.'testimonial_video','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	$dbObj->dbQuery = "select * from ".PREFIX."testimonial_video where id=".$id;
	$Video = $dbObj->SelectQuery();
	
	for($i=0;$i<count($Video);$i++){
		$dbObj->dbQuery = "update ".PREFIX."testimonial_video set display_order='".($i+1)."' where id=".$Video[$i]['id'];
		$dbObj->ExecuteQuery();
		//echo $dbObj->ExecuteQuery;exit;
	}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=video_testimonial&id='.$id.'&msg='.$msg);
	exit;
}

if ($mode == "change_video_order"){

	$tdata = explode(",",$dbObj->sc_mysql_escape($_REQUEST['tdata']));

	$list = 1;

	for($i=0;$i<count($tdata);$i++){
		$query = "UPDATE ".PREFIX."testimonial_video SET display_order = " . $list . " WHERE id = ".$tdata[$i];
		mysqli_query($dbObj->connection, $query) or die('Error, insert query failed');
		$list++;
	}
} 
?>