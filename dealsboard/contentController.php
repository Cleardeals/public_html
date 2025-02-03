<?php

ob_start(); // turn on output buffering
session_start(); //start new or resume existing session
ini_set('memory_limit','128M'); // to increse upload limit to upload files
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
require_once '../excel_reader/excel_reader.php';
$dbObj = new DBConnection(); // database connection

login_check();

$page = $dbObj->sc_mysql_escape($_REQUEST['page'] ?? ""); // paging variable
$set = $dbObj->sc_mysql_escape($_REQUEST['set'] ?? ""); // paging variable

$mode = $_REQUEST['mode'] ?? ""; // action to perform
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$info = $_REQUEST['info'] ?? ""; // data array sent from form

//to get user name
function get_user($dbObj, $id){
	//to get user name
	$dbObj->dbQuery="select full_name from ".PREFIX."adminuser where id='".$id."'";
	$dbName = $dbObj->SelectQuery();
	
	return $dbName[0]['full_name'];
}

if($mode=="add_admin_comment"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$comment = $dbObj->sc_mysql_escape($_REQUEST['comment']);

	$dbObj->dbQuery = "update ".PREFIX."valuation_comment set admin_comment	='".$comment."' where id=".$id;
	$dbObj->ExecuteQuery();
 
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=valuation_comment&msg='.$msg);
	exit; 
}

if($mode=="add_update_book_free_valuation"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	
	$info['content'] = htmlentities($dbObj->sc_mysql_escape($info['content']),ENT_NOQUOTES);
	 
	$info['published_on'] = date('Y-m-d');
	
	$dbObj->dbQuery = "update ".PREFIX."book_free_valuation_content set content='".$info['content']."' where id=".$id;
	$dbObj->ExecuteQuery();
 	
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=pages&msg='.$msg);
	exit; 
}

if($mode=="add_update_mainpages"){
		
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$adata = $_REQUEST['adata'] ?? "";
	$hdata = $_REQUEST['hdata'] ?? "";
	
	$info['content'] = htmlentities($dbObj->sc_mysql_escape($info['content']),ENT_NOQUOTES); //Convert all applicable characters to HTML entities
	
	// code to upload images
	if(isset($_FILES['image']) && $_FILES['image']['size']>0){
	
		$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name']); // to remane image
		$temp = explode('.',$_FILES['image']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=add_page&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$info['image'] = $image_name;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."sitecontent WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery();
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['image']) && !empty($imgRes[0]['image'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['image']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['image']); // remove original image form folder
		}
		
		resize_img_new($_FILES['image']['tmp_name'],1903,$ext,PAGES_THUMBS_IMAGE_PATH.$image_name); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image']['tmp_name'],PAGES_IMAGE_PATH.$image_name); // upload original image in original folder
	}
	
	// code to upload about images
	if(isset($_FILES['image1']) && $_FILES['image1']['size']>0){
	
		$image_name1 = time().'_'.str_replace(' ','-',$_FILES['image1']['name']); // to remane image
		$temp = explode('.',$_FILES['image1']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=add_page&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$adata['image1'] = $image_name1;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."sitecontent WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['image1']) && !empty($imgRes[0]['image1'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['image1']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['image1']); // remove original image form folder
		}
		
		resize_img_new($_FILES['image1']['tmp_name'],566,$ext,PAGES_THUMBS_IMAGE_PATH.$image_name1); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image1']['tmp_name'],PAGES_IMAGE_PATH.$image_name1); // upload original image in original folder
	}
	
	// code to upload about image
	if(isset($_FILES['image2']) && $_FILES['image2']['size']>0){
	
		$image_name2 = time().'_'.str_replace(' ','-',$_FILES['image2']['name']); // to remane image
		$temp = explode('.',$_FILES['image2']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=add_page&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$adata['image2'] = $image_name2;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."sitecontent WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['image2']) && !empty($imgRes[0]['image2'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['image2']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['image2']); // remove original image form folder
		}
		
		resize_img_new($_FILES['image2']['tmp_name'],566,$ext,PAGES_THUMBS_IMAGE_PATH.$image_name2); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image2']['tmp_name'],PAGES_IMAGE_PATH.$image_name2); // upload original image in original folder
	}
	
	// code to upload about image
	if(isset($_FILES['image3']) && $_FILES['image3']['size']>0){
	
		$image_name3 = time().'_'.str_replace(' ','-',$_FILES['image3']['name']); // to remane image
		$temp = explode('.',$_FILES['image3']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=add_page&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$adata['image3'] = $image_name3;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."sitecontent WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['image3']) && !empty($imgRes[0]['image3'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['image3']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['image3']); // remove original image form folder
		}
		
		resize_img_new($_FILES['image3']['tmp_name'],566,$ext,PAGES_THUMBS_IMAGE_PATH.$image_name3); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image3']['tmp_name'],PAGES_IMAGE_PATH.$image_name3); // upload original image in original folder
	}
	
	// code to upload about image
	if(isset($_FILES['image4']) && $_FILES['image4']['size']>0){
	
		$image_name4 = time().'_'.str_replace(' ','-',$_FILES['image4']['name']); // to remane image
		$temp = explode('.',$_FILES['image4']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=add_page&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$adata['image4'] = $image_name4;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."sitecontent WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['image4']) && !empty($imgRes[0]['image4'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['image4']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['image4']); // remove original image form folder
		}
		
		resize_img_new($_FILES['image4']['tmp_name'],566,$ext,PAGES_THUMBS_IMAGE_PATH.$image_name4); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image4']['tmp_name'],PAGES_IMAGE_PATH.$image_name4); // upload original image in original folder
	}
	
	
	// code to upload home images
	if(isset($_FILES['image1']) && $_FILES['image1']['size']>0){
	
		$image_name1 = time().'_'.str_replace(' ','-',$_FILES['image1']['name']); // to remane image
		$temp = explode('.',$_FILES['image1']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=add_page&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$hdata['image1'] = $image_name1;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."sitecontent WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['image1']) && !empty($imgRes[0]['image1'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['image1']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['image1']); // remove original image form folder
		}
		
		resize_img_new($_FILES['image1']['tmp_name'],55,$ext,PAGES_THUMBS_IMAGE_PATH.$image_name1); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image1']['tmp_name'],PAGES_IMAGE_PATH.$image_name1); // upload original image in original folder
	}
	
	// code to upload home image
	if(isset($_FILES['image2']) && $_FILES['image2']['size']>0){
	
		$image_name2 = time().'_'.str_replace(' ','-',$_FILES['image2']['name']); // to remane image
		$temp = explode('.',$_FILES['image2']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=add_page&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$hdata['image2'] = $image_name2;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."sitecontent WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['image2']) && !empty($imgRes[0]['image2'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['image2']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['image2']); // remove original image form folder
		}
		
		resize_img_new($_FILES['image2']['tmp_name'],55,$ext,PAGES_THUMBS_IMAGE_PATH.$image_name2); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image2']['tmp_name'],PAGES_IMAGE_PATH.$image_name2); // upload original image in original folder
	}
	
	// code to upload home image
	if(isset($_FILES['image3']) && $_FILES['image3']['size']>0){
	
		$image_name3 = time().'_'.str_replace(' ','-',$_FILES['image3']['name']); // to remane image
		$temp = explode('.',$_FILES['image3']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=add_page&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$hdata['image3'] = $image_name3;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."sitecontent WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['image3']) && !empty($imgRes[0]['image3'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['image3']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['image3']); // remove original image form folder
		}
		
		resize_img_new($_FILES['image3']['tmp_name'],55,$ext,PAGES_THUMBS_IMAGE_PATH.$image_name3); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image3']['tmp_name'],PAGES_IMAGE_PATH.$image_name3); // upload original image in original folder
	}
	
	// code to upload home image
	if(isset($_FILES['image4']) && $_FILES['image4']['size']>0){
	
		$image_name4 = time().'_'.str_replace(' ','-',$_FILES['image4']['name']); // to remane image
		$temp = explode('.',$_FILES['image4']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=add_page&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$hdata['image4'] = $image_name4;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."sitecontent WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['image4']) && !empty($imgRes[0]['image4'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['image4']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['image4']); // remove original image form folder
		}
		
		resize_img_new($_FILES['image4']['tmp_name'],55,$ext,PAGES_THUMBS_IMAGE_PATH.$image_name4); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image4']['tmp_name'],PAGES_IMAGE_PATH.$image_name4); // upload original image in original folder
	}
	
	//echo $id;exit;
	if(!empty($id)){
		
		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."sitecontent WHERE id=".$id."";
		$dbContent = $dbObj->SelectQuery();
		
		$info['published_on'] = date('Y-m-d');
		
		modify_record($dbObj,PREFIX.'sitecontent',$info,'id='.$id);
		//echo $dbObj->dbQuery;exit;
		
		modify_record($dbObj,PREFIX.'about',$adata,'pageid='.$id);
		//echo $dbObj->dbQuery;exit;
		
		modify_record($dbObj,PREFIX.'home',$hdata,'pageid='.$id);
		//echo $dbObj->dbQuery;exit;
			
		$msg = base64_encode("Record Modified Successfully."); // message about action performed
		header('location:index.php?mo=pages&msg='.$msg);
		exit;
	
	} else {
		
		// code of url
		$heading = $dbObj->sc_mysql_escape($info['menu_name']);
		$dbObj->dbQuery = "select * from ".PREFIX."sitecontent where menu_name='".$heading."'";
		if(!empty($id)){
			$dbObj->dbQuery .= "and id != $id";
		}
		$Res1 = $dbObj->SelectQuery();
		
		if(count($Res1)>0){
			$i = $Res1[0]['id'];
			$catname1 = str_replace(' ','-',just_clean($heading));
			$info['url'] = $catname1.'-'.($i+1);
		} else {
			$info['url'] = str_replace(' ','-',just_clean($heading));
		}
		
		$info['published_on'] = date('Y-m-d'); 
		add_record($dbObj,PREFIX.'sitecontent',$info);
		//echo $dbObj->dbQuery;exit;
		
		$msg = base64_encode("Record Saved Successfully");  // message about action performed
	    header('location:index.php?mo=pages&msg='.$msg);
		exit;
	}
}

//to update partner detail
if($mode=='update_partner_detail'){
	
	// code to upload images
	if(isset($_FILES['image']) && $_FILES['image']['size']>0){
	
		$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name']); // to remane image
		$temp = explode('.',$_FILES['image']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=contact&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$info['image'] = $image_name;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."partner_detail WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery();
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['image']) && !empty($imgRes[0]['image'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['image']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['image']); // remove original image form folder
		}
		
		//resize_img_new($_FILES['image']['tmp_name'],1900,PAGES_THUMBS_IMAGE_PATH.$image_name,$ext); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image']['tmp_name'],PAGES_IMAGE_PATH.$image_name); // upload original image in original folder
	}
	
	
	$info['published_on'] = date('Y-m-d');
	modify_record($dbObj,PREFIX.'partner_detail',$info,'id='.$id); 
	//echo $dbObj->dbQuery;exit;
		
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=partner_detail&msg='.$msg);
	exit;
}

//to update contact detail
if($mode=='update_contact_detail'){
	
	// code to upload images
	if(isset($_FILES['image']) && $_FILES['image']['size']>0){
	
		$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name']); // to remane image
		$temp = explode('.',$_FILES['image']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension
		
		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=contact&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$info['image'] = $image_name;

		// to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."contact_detail WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery('banner.php','get_detail()');
		
		if(file_exists(PAGES_IMAGE_PATH.$imgRes[0]['image']) && !empty($imgRes[0]['image'])){
			unlink(PAGES_THUMBS_IMAGE_PATH.$imgRes[0]['image']); // remove resize image from thumbd folder
			unlink(PAGES_IMAGE_PATH.$imgRes[0]['image']); // remove original image form folder
		}
		
		//resize_img_new($_FILES['image']['tmp_name'],1900,PAGES_THUMBS_IMAGE_PATH.$image_name,$ext); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image']['tmp_name'],PAGES_IMAGE_PATH.$image_name); // upload original image in original folder
	}
	
	
	$info['published_on'] = date('Y-m-d');
	modify_record($dbObj,PREFIX.'contact_detail',$info,'id='.$id); 
	//echo $dbObj->dbQuery;exit;
		
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=contact_detail&msg='.$msg);
	exit;
}

//to update social media
if($mode=='update_social_links'){
	
	if(empty($info['link'])){ 
		$msg = base64_encode("Please Enter Social Link.");
	 	header('location:index.php?mo=social_links&msg='.$msg);
	 	exit;
	}
	
	modify_record($dbObj,PREFIX.'social_links',$info,'id='.$id); 
	//echo $dbObj->dbQuery;exit;
	
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=social_links&msg1='.$msg);
	exit;
}

//mode to add/update state
if($mode=="add_update_state") {
	
	$info = $_REQUEST['info'];
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	 
	if(!empty($id)){
		
		modify_record($dbObj,PREFIX.'state',$info,'id='.$id); 
		//echo $dbObj->dbQuery;exit;
			
		$msg = base64_encode("Record Modified Successfully ."); // message about action performed
		header('location:index.php?mo=states&msg='.$msg.'&set='.$set.'&page='.$page);
		exit;
	
	} else{
		$info['status'] = "1";
		$info['display_order'] = "0";
		add_record($dbObj,PREFIX.'state',$info); 
		//echo $dbObj->dbQuery;exit;
		
		$dbObj->dbQuery = "select * from ".PREFIX."state order by display_order ASC";
		$order = $dbObj->SelectQuery();
		
		for($i=0;$i<count($order);$i++){
			$dbObj->dbQuery = "update ".PREFIX."state set display_order='".($i+1)."' where id=".$order[$i]['id'];
			$dbObj->ExecuteQuery();
		}

	$msg = base64_encode("Record Saved Successfully"); // message about action performed
	header('location:index.php?mo=states&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;
	}
}

//mode to change state status
if($mode=="state_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	//to update status
	$dbObj->dbQuery = "update ".PREFIX."state set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//mode to delete state
if($mode=='delete_state'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'state','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."state order by display_order asc";
	$dbResult1 = $dbObj->SelectQuery();
	
	for($k=0;$k<count((array)$dbResult1);$k++){
		$dbObj->dbQuery = "update ".PREFIX."state set display_order='".($k+1)."' where  id=".$dbResult1[$k]['id'];
	    $dbObj->ExecuteQuery();
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=states&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to change state display order
if($mode == "change_state_order"){
	//echo $_REQUEST['tdata'];
	$tdata = explode(",",$dbObj->sc_mysql_escape($_REQUEST['tdata']));
	
	$list = 1;
	for($i=0;$i<count($tdata);$i++){
		$query = "UPDATE ".PREFIX."state SET display_order = " . $list . " WHERE id = ".$tdata[$i];
		mysqli_query($dbObj->connection, $query) or die('Error, insert query failed');
		$list++;
	}
}

//mode to add/update city
if($mode=="add_update_city") {
	
	$info = $_REQUEST['info'];
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$state = $dbObj->sc_mysql_escape($_REQUEST['state'] ?? "");//exit;
	
	if(!empty($id)){
		
		modify_record($dbObj,PREFIX.'city',$info,'id='.$id); 
		//echo $dbObj->dbQuery;exit;
			
		$msg = base64_encode("Record Modified Successfully ."); // message about action performed
		header('location:index.php?mo=city&msg='.$msg.'&state='.$state.'&id='.$id.'&set='.$set.'&page='.$page);
		exit;
	
	} else{
		
		$info['status'] = "1";
		$info['display_order'] = "0";
		add_record($dbObj,PREFIX.'city',$info); 
		//echo $dbObj->dbQuery;exit;
		
		$dbObj->dbQuery = "select * from ".PREFIX."city order by display_order ASC";
		$order = $dbObj->SelectQuery();
		
		for($i=0;$i<count($order);$i++){
			$dbObj->dbQuery = "update ".PREFIX."city set display_order='".($i+1)."' where id=".$order[$i]['id'];
			$dbObj->ExecuteQuery();
		}

	$msg = base64_encode("Record Saved Successfully"); // message about action performed
	header('location:index.php?mo=city&msg='.$msg.'&state='.$state.'&set='.$set.'&page='.$page);
	exit;
	}
}

//mode to change city status
if($mode=="city_status"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval'] ?? "");
	
	// to update Image status
	$dbObj->dbQuery = "update ".PREFIX."city set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();
	
	echo $set_val;
	exit;
}

//delete city
if($mode=='delete_city'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	$state = $dbObj->sc_mysql_escape($_REQUEST['state'] ?? "");
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'city','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."city order by display_order asc";
	$dbResult1 = $dbObj->SelectQuery();
	
	for($k=0;$k<count((array)$dbResult1);$k++){
		$dbObj->dbQuery = "update ".PREFIX."city set display_order='".($k+1)."' where  id=".$dbResult1[$k]['id'];
	    $dbObj->ExecuteQuery();
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=city&msg='.$msg.'&state='.$state.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to change city display order
if ($mode == "change_city_order"){
	//echo $_REQUEST['tdata'];
	$tdata = explode(",",$dbObj->sc_mysql_escape($_REQUEST['tdata']));
	
	$list = 1;
	for($i=0;$i<count($tdata);$i++){
		$query = "UPDATE ".PREFIX."city SET display_order = " . $list . " WHERE id = ".$tdata[$i];
		mysqli_query($dbObj->connection, $query) or die('Error, insert query failed');
		$list++;
	}
}

//mode to add location
if($mode=="import_land"){
	
	$info = $_REQUEST['info'];
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	
	/*$dbObj->dbQuery = "TRUNCATE TABLE ".PREFIX."price_list" ;
	$dbRes = $dbObj->ExecuteQuery('banner.php','get_detail()');*/
	
		// code to upload xls
	if(isset($_FILES['upload_xls']) && $_FILES['upload_xls']['size']>0){
	
		$image_name = time().'_'.str_replace(" ","_",$_FILES['upload_xls']['name']); // to remane image
		$temp = explode('.',$_FILES['upload_xls']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1];
		
		if($ext!='xls' && $ext!='xlsx'){ // check format
		//echo "9";
		$msg=base64_encode('Please Select xls Files.'); // message about action performed
		header('location:index.php?mo=import_land/');
		exit;
		}
		
		move_uploaded_file($_FILES['upload_xls']['tmp_name'],EXC_IMAGE_PATH.$image_name);
		
	}
	
	$city = $dbObj->sc_mysql_escape($info['city']);
	
	$file = EXC_IMAGE_PATH.$image_name;
	$excel = new PhpExcelReader; // creates object instance of the class
	$excel->read($file); // reads and stores the excel file data
	
//echo "Total Sheets in this xls file: ".count((array)$excel->sheets)."<br /><br />";exit;
 
$html="<table border='1'>";

for($i=0;$i<count((array)$excel->sheets);$i++) // Loop to get all sheets in a file.
{	
	if(count((array)$excel->sheets[$i][CELLS])>0) // checking sheet not empty
	{
		echo "Sheet $i:<br /><br />Total rows in sheet $i  ".count((array)$excel->sheets[$i][CELLS])."<br />";
		for($j=1;$j<=count((array)$excel->sheets[$i][CELLS]);$j++) // loop used to get each row of the sheet
		{ 
			$html.="<tr>";
			for($k=1;$k<=count((array)$excel->sheets[$i][CELLS][$j]);$k++) // This loop is created to get data in a table format.
			{
				$html.="<td>";
				$html.=$excel->sheets[$i][CELLS][$j][$k];
				$html.="</td>";
			}
			
			$id = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][1]);
			$land = str_replace(",",'',mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][2]));
			//$location = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][2]);
			$price_min_sq = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][3]);
			$price_max_sq = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][4]);
			$price_min_sq_yrd = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][5]);
			$price_max_sq_yrd = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][6]);
			
			$query = "insert into ".PREFIX."land(land,price_min_sq,price_max_sq,price_min_sq_yrd,price_max_sq_yrd,city) values('".$land."','".$price_min_sq."','".$price_max_sq."','".$price_min_sq_yrd."','".$price_max_sq_yrd."','".$city."')";
 
			mysqli_query($dbObj->connection, $query);
				
			$html.="</tr>";
		}
 
}
 
$html.="</table>";
echo $html;
echo "<br />Data Inserted in dababase";//exit;

		$msg = base64_encode("Record Saved Successfully");  // message about action performed
	    header('location:index.php?mo=import_land&msg='.$msg);
	    exit;
	}

}

if($mode=="import_location"){
	$info = $_REQUEST['info'];
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	
	/*$dbObj->dbQuery = "TRUNCATE TABLE ".PREFIX."price_list" ;
	$dbRes = $dbObj->ExecuteQuery('banner.php','get_detail()');*/
	
		// code to upload xls
	if(isset($_FILES['upload_xls']) && $_FILES['upload_xls']['size']>0){
	
		$image_name = time().'_'.str_replace(" ","_",$_FILES['upload_xls']['name']); // to remane image
		$temp = explode('.',$_FILES['upload_xls']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1];
		
		if($ext!='xls' && $ext!='xlsx'){ // check format
		//echo "9";
		$msg=base64_encode('Please Select xls Files.'); // message about action performed
		header('location:index.php?mo=import_location/');
		exit;
		}
		
		move_uploaded_file($_FILES['upload_xls']['tmp_name'],EXC_IMAGE_PATH.$image_name);
		
	}
	
	$city = $dbObj->sc_mysql_escape($info['city']);
	
	$file = EXC_IMAGE_PATH.$image_name;
	$excel = new PhpExcelReader; // creates object instance of the class
	$excel->read($file); // reads and stores the excel file data
	
//echo "Total Sheets in this xls file: ".count((array)$excel->sheets)."<br /><br />";exit;
 
$html="<table border='1'>";

for($i=0;$i<count((array)$excel->sheets);$i++) // Loop to get all sheets in a file.
{	
	if(count((array)$excel->sheets[$i][CELLS])>0) // checking sheet not empty
	{
		echo "Sheet $i:<br /><br />Total rows in sheet $i  ".count((array)$excel->sheets[$i][CELLS])."<br />";
		for($j=1;$j<=count((array)$excel->sheets[$i][CELLS]);$j++) // loop used to get each row of the sheet
		{ 
			$html.="<tr>";
			for($k=1;$k<=count((array)$excel->sheets[$i][CELLS][$j]);$k++) // This loop is created to get data in a table format.
			{
				$html.="<td>";
				$html.=$excel->sheets[$i][CELLS][$j][$k];
				$html.="</td>";
			}
			
			$id = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][1]);
			$location = str_replace(",",'',mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][2]));
			//$location = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][2]);
			$price_min_sq = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][3]);
			$price_max_sq = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][4]);
			$price_min_sq_yrd = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][5]);
			$price_max_sq_yrd = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][6]);
			
			$query = "insert into ".PREFIX."location(location,price_min_sq,price_max_sq,price_min_sq_yrd,price_max_sq_yrd,city) values('".$location."','".$price_min_sq."','".$price_max_sq."','".$price_min_sq_yrd."','".$price_max_sq_yrd."','".$city."')";
 
			mysqli_query($dbObj->connection, $query);
				
			$html.="</tr>";
		}
 
}
 
$html.="</table>";
echo $html;
echo "<br />Data Inserted in dababase";//exit;

		$msg = base64_encode("Record Saved Successfully");  // message about action performed
	    header('location:index.php?mo=import_location&msg='.$msg);
	    exit;
	}

}

//mode to add update location
if($mode=="add_update_location") {
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	 
	if(!empty($id)){
		
		modify_record($dbObj,PREFIX.'location',$info,'id='.$id); 
		//echo $dbObj->dbQuery;exit;
			
		$msg = base64_encode("Record Modified Successfully ."); // message about action performed
		header('location:index.php?mo=import_location&msg='.$msg);
		exit;
	
	} else{
		
		add_record($dbObj,PREFIX.'location',$info); 
		//echo $dbObj->dbQuery;exit;
			
		$msg = base64_encode("Record Saved Successfully ."); // message about action performed
		header('location:index.php?mo=import_location&msg='.$msg);
		exit;
	}
}


if($mode=="add_update_land") {
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	 
	if(!empty($id)){
		
		modify_record($dbObj,PREFIX.'land',$info,'id='.$id); 
		//echo $dbObj->dbQuery;exit;
			
		$msg = base64_encode("Record Modified Successfully ."); // message about action performed
		header('location:index.php?mo=import_land&msg='.$msg);
		exit;
	
	} else{
		
		add_record($dbObj,PREFIX.'land',$info); 
		//echo $dbObj->dbQuery;exit;
			
		$msg = base64_encode("Record Saved Successfully ."); // message about action performed
		header('location:index.php?mo=import_land&msg='.$msg);
		exit;	
	}
}


//delete location
if($mode=='delete_location'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	//for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'location','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	//}
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=import_location&msg='.$msg);
	exit;	
}


if($mode=='delete_land'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	//for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'land','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	//}
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=import_land&msg='.$msg);
	exit;	
}

// mode to delete appointment home/vill/bunglow
if($mode=='delete_appointment'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'appointment','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=home-villa&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete appointment
if($mode=='delete_app'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'date_time','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=app-cleardeal&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete subscription
if($mode=='delete_subscription'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'subscribe','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=subscribe&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete request call back
if($mode=='delete_req_call_back'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'req_call_back','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=request_call_back&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete career request
if($mode=='delete_career_req'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'career_request','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=career_request&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete new project enquiry
if($mode=='delete_peoject_enq'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'new_project_enquiry','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=new_project_enquiry&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete services free advice
if($mode=='delete_free_advice'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'free_advice','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=free_advice&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete services enquiry
if($mode=='delete_service_enquiry'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'service_enquiry','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=services_enquiry&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete free valuation
if($mode=='delete_free_valuation'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'valuation','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=free-valuation&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete site visit
if($mode=='delete_site_visit'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'site_visit','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=arrange_site_visit&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete ask question
if($mode=='delete_ask_question'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'ask_question','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=ask_question&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete make offer
if($mode=='delete_make_offer'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'make_offer','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=make_offer&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}

// mode to delete property contact us
if($mode=='delete_prop_contact'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	for($i=0;$i<count((array)$id);$i++){
	
	delete_record($dbObj,PREFIX.'prop_contact','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	}	
		
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=prop_contact&msg='.$msg.'&set='.$set.'&page='.$page);
	exit;	
}


//mode to add location
if($mode=="import_pricelist"){
	
		
		// code to upload xls
	if(isset($_FILES['upload_xls']) && $_FILES['upload_xls']['size']>0){
		// Get the file extension
		$temp = explode('.', $_FILES['upload_xls']['name']);
		$ext = strtolower(end($temp)); // Get the extension and make it case-insensitive
	
		// Check if the file is an xlsx file
		if ($ext != 'xlsx') {
			$msg = base64_encode('Please Select xlsx Files.');
			header('location:index.php?mo=upload_pricelist&msg='.$msg);
			exit;
		}
		
		// Always save the file as 'Apartment_price_list.xlsx'
		$image_name = 'Apartment_price_list.xlsx';
	
		// Move the uploaded file to the desired location with the new name
		if (move_uploaded_file($_FILES['upload_xls']['tmp_name'], ROOT_DIR . 'calc/' . $image_name)) {
			
			
			// File uploaded successfully
			$msg = base64_encode('File uploaded successfully.');
			header('location:index.php?mo=upload_pricelist&msg='.$msg);
			exit;
		} else {
			// Handle error
			$msg = base64_encode('File upload failed.');
			header('location:index.php?mo=upload_pricelist&msg='.$msg);
			exit;
		}
		
		 
		
	} else {
		// Handle the case when no file is uploaded or the file size is zero
		$msg = base64_encode('No file selected or the file is empty.');
		header('location:index.php?mo=upload_pricelist&msg='.$msg);
		exit;	
	}
}

//mode to add location
if($mode=="import_pricelistbunglow"){
	
		
		// code to upload xls
	if(isset($_FILES['upload_xls']) && $_FILES['upload_xls']['size']>0){
		// Get the file extension
		$temp = explode('.', $_FILES['upload_xls']['name']);
		$ext = strtolower(end($temp)); // Get the extension and make it case-insensitive
	
		// Check if the file is an xlsx file
		if ($ext != 'xlsx') {
			$msg = base64_encode('Please Select xlsx Files.');
			header('location:index.php?mo=upload_pricelist&msg2='.$msg);
			exit;
		}
		
		// Always save the file as 'Apartment_price_list.xlsx'
		$image_name = 'Bunglow_price_list.xlsx';
	
		// Move the uploaded file to the desired location with the new name
		if (move_uploaded_file($_FILES['upload_xls']['tmp_name'], ROOT_DIR . 'calc/' . $image_name)) {
			
			
			// File uploaded successfully
			$msg = base64_encode('File uploaded successfully.');
			header('location:index.php?mo=upload_pricelist&msg2='.$msg);
			exit;
		} else {
			// Handle error
			$msg = base64_encode('File upload failed.');
			header('location:index.php?mo=upload_pricelist&msg2='.$msg);
			exit;
		}
		
		 
		
	} else {
		// Handle the case when no file is uploaded or the file size is zero
		$msg = base64_encode('No file selected or the file is empty.');
		header('location:index.php?mo=upload_pricelist&msg2='.$msg);
		exit;	
	}
}
?>
