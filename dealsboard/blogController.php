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

$mode = $dbObj->sc_mysql_escape($_REQUEST['mode'] ?? ""); // action to perform
$info = $_REQUEST['info']; // data array sent from form

//mode to add/update blog
if($mode=="add_admin_comment"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$comment = $dbObj->sc_mysql_escape($_REQUEST['comment']);

	$dbObj->dbQuery = "update ".PREFIX."blog_comment set admin_comment	='".$comment."' where id=".$id;
	$dbObj->ExecuteQuery();
 	
	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=blog_comment&msg='.$msg);
	exit; 
}


if($mode=="add_update_blog_categry"){ 
	for($k=0;$k<count($info['category']);$k++){
		$id = $k+1;
		$dbObj->dbQuery = "update ".PREFIX."blog_footer_links_category set category='".$info['category'][$k]."' where id=".$id; 
		$dbObj->ExecuteQuery(); 
	} 

	$msg = base64_encode("Record Modified Successfully."); // message about action performed
	header('location:index.php?mo=blog_category&msg='.$msg);
	exit; 
}


if($mode=="add_update_blog_categry_links"){  
	delete_record($dbObj,PREFIX.'blog_footer_links','link_category_id=1'); 
	delete_record($dbObj,PREFIX.'blog_footer_links','link_category_id=2'); 
	delete_record($dbObj,PREFIX.'blog_footer_links','link_category_id=3'); 
	delete_record($dbObj,PREFIX.'blog_footer_links','link_category_id=4'); 
	delete_record($dbObj,PREFIX.'blog_footer_links','link_category_id=5'); 
	delete_record($dbObj,PREFIX.'blog_footer_links','link_category_id=6'); 

	for($k=0;$k<count($info['name'][1]);$k++){  
		$id = $k+1; 
		if($info['name'][1][$k] != null && $info['link'][1][$k] != null){
			$array['name'] = $dbObj->sc_mysql_escape($info['name'][1][$k]);
			$array['link']= $dbObj->sc_mysql_escape($info['link'][1][$k]);
			$array['link_category_id']= 1;
			$dbObj = new DBConnection();
			add_record($dbObj,PREFIX.'blog_footer_links',$array);
		}  
	}
	for($k=0;$k<count($info['name'][2]);$k++){  
		$id = $k+1; 
		if($info['name'][2][$k] != null && $info['link'][2][$k] != null){
			$array['name'] = $dbObj->sc_mysql_escape($info['name'][2][$k]);
			$array['link']= $dbObj->sc_mysql_escape($info['link'][2][$k]);
			$array['link_category_id']= 2;
			$dbObj = new DBConnection();  
			add_record($dbObj,PREFIX.'blog_footer_links',$array);
		}  
	} 
	for($k=0;$k<count($info['name'][3]);$k++){  
		$id = $k+1; 
		if($info['name'][3][$k] != null && $info['link'][3][$k] != null){
			$array['name'] = $dbObj->sc_mysql_escape($info['name'][3][$k]);
			$array['link']= $dbObj->sc_mysql_escape($info['link'][3][$k]);
			$array['link_category_id'] = 3;
			$dbObj = new DBConnection();  
			add_record($dbObj,PREFIX.'blog_footer_links',$array);
		}  
	} 
	for($k=0;$k<count($info['name'][4]);$k++){  
		$id = $k+1; 
		if($info['name'][4][$k] != null && $info['link'][4][$k] != null){
			$array['name'] = $dbObj->sc_mysql_escape($info['name'][4][$k]);
			$array['link']= $dbObj->sc_mysql_escape($info['link'][4][$k]);
			$array['link_category_id']= 4;
			$dbObj = new DBConnection();  
			add_record($dbObj,PREFIX.'blog_footer_links',$array);
		}  
	} 
	for($k=0;$k<count($info['name'][5]);$k++){  
		$id = $k+1; 
		if($info['name'][5][$k] != null && $info['link'][5][$k] != null){
			$array['name'] = $dbObj->sc_mysql_escape($info['name'][5][$k]);
			$array['link']= $dbObj->sc_mysql_escape($info['link'][5][$k]);
			$array['link_category_id']= 5;
			$dbObj = new DBConnection();  
			add_record($dbObj,PREFIX.'blog_footer_links',$array);
		}  
	} 
	for($k=0;$k<count($info['name'][6]);$k++){  
		$id = $k+1; 
		if($info['name'][6][$k] != null && $info['link'][6][$k] != null){
			$array['name'] = $dbObj->sc_mysql_escape($info['name'][6][$k]);
			$array['link']= $dbObj->sc_mysql_escape($info['link'][6][$k]);
			$array['link_category_id']= 6;
			$dbObj = new DBConnection();  
			add_record($dbObj,PREFIX.'blog_footer_links',$array);
		}  
	}  
	$msg = base64_encode("Record Modified Successfully."); // message about action performed
	header('location:index.php?mo=blog_category_links&msg='.$msg);
	exit; 
}

if($mode=="add_update_blog_header_category"){
	
	for($k=0;$k<count($info['category']);$k++){  
		$id = $k+1;
		$dbObj->dbQuery = "update ".PREFIX."blog_category set name='".$dbObj->sc_mysql_escape($info['category'][$k])."' where id=".$id; 
		$dbObj->ExecuteQuery(); 
	} 

	$msg = base64_encode("Record Modified Successfully."); // message about action performed
	header('location:index.php?mo=blog_header_category&msg='.$msg);
	exit; 
}

if($mode=="delete_single_category_link"){
	
	delete_record($dbObj,PREFIX.'blog_sub_category','id='.$dbObj->sc_mysql_escape($info['delete_id']));
	
	$msg = base64_encode("Record Deleted Successfully."); // message about action performed
	header('location:index.php?mo=blog_header_category_links&msg='.$msg);
	exit; 
}


if($mode=="add_new_blog_hader_link"){ 
	//echo HTACCESS_URL."cms_images/blog/category";echo "*".BLOG_IMAGE_PATH; exit();

	if(isset($_FILES['image']) && $_FILES['image']['size'] > 0 ){ 

		$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name']); // to remane image 
		$temp = explode('.',$_FILES['image']['name']); // explode to get image extension 
		$ext = $temp[count($temp)-1]; // get image extension 

		 // upload original image in original folder 
		if (move_uploaded_file($_FILES['image']['tmp_name'],"/home/cleardealsconi/public_html/cms_images/blog/category/".$image_name)) {
		    $info['image'] = $image_name;  
		} else { 
		    $msg = base64_encode("Sorry, there was an error uploading your file."); // message about action performed
			header('location:index.php?mo=blog_category_links&msg='.$msg);
			exit;
		} 
	} 

 
	$info['name'] = $dbObj->sc_mysql_escape($info['name']); 
	$info['link']= str_replace(' ', '-', strtolower($info['name'])); 
	$info['category_id'] = $dbObj->sc_mysql_escape($info['category_id']); 
	add_record($dbObj,PREFIX.'blog_sub_category',$info);
	//echo $dbObj->dbQuery;exit;

	$msg = base64_encode("Record Added Successfully."); // message about action performed
	header('location:index.php?mo=blog_header_category_links&msg='.$msg);
	exit; 
}



if($mode=="add_update_blog_hader_links"){ 
 
// echo "<pre>";
//    print_r($_FILES['image']['tmp_name']);
// echo "</pre>";
// exit();


	for($k=0;$k<count($info['name'][1]);$k++){  
		$id = $k+1; 
		if($info['name'][1][$k] == null){  
			delete_record($dbObj,PREFIX.'blog_sub_category','id='.$dbObj->sc_mysql_escape($info['id'][1][$k]));
		}else{
			$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set name='".$dbObj->sc_mysql_escape($info['name'][1][$k])."' where id=".$dbObj->sc_mysql_escape($info['id'][1][$k]); 
			$dbObj->ExecuteQuery(); 
			$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set link='".str_replace(' ', '-', strtolower($info['name'][1][$k]))."' where id=".$dbObj->sc_mysql_escape($info['id'][1][$k]); 
			$dbObj->ExecuteQuery();  

			if(isset($_FILES['image']['name'][1]) != null){ 
				$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name'][1][$k]);
				$temp = explode('.',$_FILES['image']['name'][1][$k]);   
				$ext = $temp[count($temp)-1];  
				if (move_uploaded_file($_FILES['image']['tmp_name'][1][$k],"/home/cleardealsconi/public_html/cms_images/blog/category/".$image_name)) { 
				    $dbObj->dbQuery = "update ".PREFIX."blog_sub_category set image='".$image_name."' where id=".$dbObj->sc_mysql_escape($info['id'][1][$k]); 
					$dbObj->ExecuteQuery();  
				}  
			} 

		} 
	} 
	for($k=0;$k<count($info['name'][2]);$k++){  
		$id = $k+1; 
		$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set name='".$dbObj->sc_mysql_escape($info['name'][2][$k])."' where id=".$dbObj->sc_mysql_escape($info['id'][2][$k]); 
		$dbObj->ExecuteQuery(); 
		$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set link='".str_replace(' ', '-', strtolower($info['name'][2][$k]))."' where id=".$dbObj->sc_mysql_escape($info['id'][2][$k]); 
		$dbObj->ExecuteQuery();

		if(isset($_FILES['image']['name'][2]) != null){ 
				$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name'][2][$k]);
				$temp = explode('.',$_FILES['image']['name'][2][$k]);   
				$ext = $temp[count($temp)-1];  
				if (move_uploaded_file($_FILES['image']['tmp_name'][2][$k],"/home/cleardealsconi/public_html/cms_images/blog/category/".$image_name)) { 
				    $dbObj->dbQuery = "update ".PREFIX."blog_sub_category set image='".$image_name."' where id=".$dbObj->sc_mysql_escape($info['id'][2][$k]); 
					$dbObj->ExecuteQuery();  
				}  
			} 
	}
	for($k=0;$k<count($info['name'][3]);$k++){  
		$id = $k+1; 
		$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set name='".$dbObj->sc_mysql_escape($info['name'][3][$k])."' where id=".$dbObj->sc_mysql_escape($info['id'][3][$k]); 
		$dbObj->ExecuteQuery(); 
		$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set link='".str_replace(' ', '-', strtolower($info['name'][3][$k]))."' where id=".$dbObj->sc_mysql_escape($info['id'][3][$k]);
		$dbObj->ExecuteQuery();

		if(isset($_FILES['image']['name'][3]) != null){ 
				$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name'][3][$k]);
				$temp = explode('.',$_FILES['image']['name'][3][$k]);   
				$ext = $temp[count($temp)-1];  
				if (move_uploaded_file($_FILES['image']['tmp_name'][3][$k],"/home/cleardealsconi/public_html/cms_images/blog/category/".$image_name)) { 
				    $dbObj->dbQuery = "update ".PREFIX."blog_sub_category set image='".$image_name."' where id=".$dbObj->sc_mysql_escape($info['id'][3][$k]); 
					$dbObj->ExecuteQuery();  
				}  
			} 
	}
	for($k=0;$k<count($info['name'][4]);$k++){  
		$id = $k+1; 
		$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set name='".$dbObj->sc_mysql_escape($info['name'][4][$k])."' where id=".$dbObj->sc_mysql_escape($info['id'][4][$k]); 
		$dbObj->ExecuteQuery(); 
		$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set link='".str_replace(' ', '-', strtolower($info['name'][4][$k]))."' where id=".$dbObj->sc_mysql_escape($info['id'][4][$k]); 
		$dbObj->ExecuteQuery();

		if(isset($_FILES['image']['name'][4]) != null){ 
				$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name'][4][$k]);
				$temp = explode('.',$_FILES['image']['name'][4][$k]);   
				$ext = $temp[count($temp)-1];  
				if (move_uploaded_file($_FILES['image']['tmp_name'][4][$k],"/home/cleardealsconi/public_html/cms_images/blog/category/".$image_name)) { 
				    $dbObj->dbQuery = "update ".PREFIX."blog_sub_category set image='".$image_name."' where id=".$dbObj->sc_mysql_escape($info['id'][4][$k]); 
					$dbObj->ExecuteQuery();  
				}  
			} 
	}
	for($k=0;$k<count($info['name'][5]);$k++){  
		$id = $k+1; 
		$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set name='".$dbObj->sc_mysql_escape($info['name'][5][$k])."' where id=".$dbObj->sc_mysql_escape($info['id'][5][$k]); 
		$dbObj->ExecuteQuery(); 
		$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set link='".str_replace(' ', '-', strtolower($info['name'][5][$k]))."' where id=".$dbObj->sc_mysql_escape($info['id'][5][$k]);
		$dbObj->ExecuteQuery();

		if(isset($_FILES['image']['name'][5]) != null){ 
				$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name'][5][$k]);
				$temp = explode('.',$_FILES['image']['name'][5][$k]);   
				$ext = $temp[count($temp)-1];  
				if (move_uploaded_file($_FILES['image']['tmp_name'][5][$k],"/home/cleardealsconi/public_html/cms_images/blog/category/".$image_name)) { 
				    $dbObj->dbQuery = "update ".PREFIX."blog_sub_category set image='".$image_name."' where id=".$dbObj->sc_mysql_escape($info['id'][5][$k]); 
					$dbObj->ExecuteQuery();  
				}  
			} 
	}
	for($k=0;$k<count($info['name'][6]);$k++){  
		$id = $k+1; 
		$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set name='".$dbObj->sc_mysql_escape($info['name'][6][$k])."' where id=".$dbObj->sc_mysql_escape($info['id'][6][$k]); 
		$dbObj->ExecuteQuery(); 
		$dbObj->dbQuery = "update ".PREFIX."blog_sub_category set link='".str_replace(' ', '-', strtolower($info['name'][6][$k]))."' where id=".$dbObj->sc_mysql_escape($info['id'][6][$k]);
		$dbObj->ExecuteQuery();

		if(isset($_FILES['image']['name'][6]) != null){ 
				$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name'][6][$k]);
				$temp = explode('.',$_FILES['image']['name'][6][$k]);   
				$ext = $temp[count($temp)-1];  
				if (move_uploaded_file($_FILES['image']['tmp_name'][6][$k],"/home/cleardealsconi/public_html/cms_images/blog/category/".$image_name)) { 
				    $dbObj->dbQuery = "update ".PREFIX."blog_sub_category set image='".$image_name."' where id=".$dbObj->sc_mysql_escape($info['id'][6][$k]); 
					$dbObj->ExecuteQuery();  
				}  
			} 
	} 
	 
	$msg = base64_encode("Record Modified Successfully."); // message about action performed
	header('location:index.php?mo=blog_header_category_links&msg='.$msg);
	exit; 
}

if($mode=="add_update_blog_sidebar_links"){ 
	for($k=0;$k<count($info['name']);$k++){  
		$id = $k+1;
		$dbObj->dbQuery = "update ".PREFIX."blog_links set name='".$dbObj->sc_mysql_escape($info['name'][$k])."' where id=".$id; 
		$dbObj->ExecuteQuery(); 
	} 
	for($k=0;$k<count($info['link']);$k++){  
		$id = $k+1;
		$dbObj->dbQuery = "update ".PREFIX."blog_links set link='".$dbObj->sc_mysql_escape($info['link'][$k])."' where id=".$id; 
		$dbObj->ExecuteQuery(); 
	} 

	$msg = base64_encode("Record Modified Successfully."); // message about action performed
	header('location:index.php?mo=blog_sidebar_links&msg='.$msg);
	exit; 
}

if($mode=="add_update_blog"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);

	$dbObj->dbQuery = "select * from ".PREFIX."blog WHERE id!='".$id."' AND url='".$dbObj->sc_mysql_escape($info['url'])."' ";
	$is_url_exists = $dbObj->SelectQuery();
	
	// if(count($is_url_exists)<1){
	// 	$info['url'] = $info['url'];
	// }else{
	// 	$msg = base64_encode("Url is already exist try with another Url.");  
	// 	header('location:index.php?mo=blog&msg='.$msg); 
	// 	exit();
	// } 

	$info['content'] = htmlentities($dbObj->sc_mysql_escape($info['content']),ENT_NOQUOTES);
	$info['seo_title'] = $dbObj->sc_mysql_escape($info['seo_title']);
	$info['meta_keyword'] = $dbObj->sc_mysql_escape($info['meta_keyword']);
	$info['meta_desc'] = $dbObj->sc_mysql_escape($info['meta_desc']);
	$info['image_title'] = $dbObj->sc_mysql_escape($info['image_title']);
	$info['image_alt'] = $dbObj->sc_mysql_escape($info['image_alt']);
	$info['blog_sub_category_id'] = $dbObj->sc_mysql_escape($info['blog_sub_category_id']);
	//print_r($info['blog_sub_category_id']);exit;
	
	//code to upload images
	if(isset($_FILES['image']) && $_FILES['image']['size']>0){

		$image_name = time().'_'.str_replace(' ','-',$_FILES['image']['name']); // to remane image
		$temp = explode('.',$_FILES['image']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1]; // get image extension

		if($ext!='jpg' && $ext!='jpeg' && $ext!='JPEG' && $ext!='JPG' && $ext!='png' && $ext!='PNG'){ // check image format
			$msg=base64_encode('Please Select jpg,jpeg Images.'); // message about action performed
			header('location:index.php?mo=blog&id='.$id.'&msg='.$msg);
			exit;
		}
		
		$info['image'] = $image_name;
		
		if(!empty($id)){
		//to remove image
		$dbObj->dbQuery = "select * from ".PREFIX."blog WHERE id='".$id."'";
		$imgRes = $dbObj->SelectQuery();
		
		if(file_exists(BLOG_IMAGE_PATH.$imgRes[0]['image']) && !empty($imgRes[0]['image'])){
			unlink(BLOG_THUMB_IMAGE_PATH.$imgRes[0]['image']); // remove resize image from thumbd folder
			unlink(BLOG_IMAGE_PATH.$imgRes[0]['image']); // remove original image form folder
		}
		}
		
		resize_img_new($_FILES['image']['tmp_name'],725,$ext,BLOG_THUMB_IMAGE_PATH.$image_name); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES['image']['tmp_name'],BLOG_IMAGE_PATH.$image_name); // upload original image in original folder
	}
	
	if(!empty($id)){  
	$info['published_on'] = date('Y-m-d');
	
	modify_record($dbObj,PREFIX.'blog',$info,'id='.$id); 
	//echo $dbObj->dbQuery;exit;

	$msg = base64_encode("Record Modified Successfully ."); // message about action performed
	header('location:index.php?mo=blog&msg='.$msg);
	exit;

	} else {

	//code of url
	$title = $dbObj->sc_mysql_escape($info['title']);
	$dbObj->dbQuery = "select * from ".PREFIX."blog where title='".$title."'";
	if(!empty($id)){
		$dbObj->dbQuery .= "and id != $id";
	}
	$Res1 = $dbObj->SelectQuery();
	
	// if(count($Res1)>0){
	// 	$i = $Res1[0]['id'];
	// 	$catname1 = str_replace(' ','-',just_clean($title));
	// 	$info['url'] = $catname1.'-'.($i+1);
	// } else {
	// 	$info['url'] = str_replace(' ','-',just_clean($title));
	// }

	if(count($Res1)>0){ 
		$info['url'] = $catname1.'-'.($i+1);
	} else {
		$info['url'] = str_replace(' ','-',just_clean($title));
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."blog WHERE id='".$id."'";
	$is_url_exists = $dbObj->SelectQuery();
	//exit;
	
	$info['display_order'] = 0;
	$info['status']= 1;
	$info['published_on'] = date('Y-m-d');

	add_record($dbObj,PREFIX.'blog',$info);
	//echo $dbObj->dbQuery;
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."blog order by display_order ASC";
	$dbBlog = $dbObj->SelectQuery();

	for($k=0;$k<count($dbBlog);$k++){
		$dbObj->dbQuery = "update ".PREFIX."blog set display_order='".($k+1)."' where id=".$dbObj->sc_mysql_escape($dbBlog[$k]['id']);
		$dbObj->ExecuteQuery();
	}
	//exit;

	$msg = base64_encode("Record Saved Successfully");  // message about action performed
	header('location:index.php?mo=blog&msg='.$msg);
	exit;
	}
}


//mode to change blog status
if($mode=="blog_status"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval']);
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."blog set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();

	echo $set_val;
	exit;
}


//mode to delete blog
if($mode=='delete_blog'){  // to delete seleted record
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	if(empty($id)){	 // check empty array
	   $msg = base64_encode("Please select record to delete"); // message about action performed
	   header('location:index.php?mo=blog&id='.$id.'&msg='.$msg);
	   exit;
	}
	
	for($i=0;$i<count($id);$i++){
		
	//to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."blog where id=".$id[$i];
	$dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;

	if(file_exists(BLOG_IMAGE_PATH.$dbResult[0]['image']) && !empty($dbResult[0]['image'])){ 
		unlink(BLOG_THUMB_IMAGE_PATH.$dbResult[0]['image']); // remove resize image from thumbd folder
		unlink(BLOG_IMAGE_PATH.$dbResult[0]['image']); // remove original image form folder
	}
	
	delete_record($dbObj,PREFIX.'blog','id='.$id[$i]); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	}

	$dbObj->dbQuery = "select * from ".PREFIX."blog where id=".$id;
	$Blog = $dbObj->SelectQuery();

	for($i=0;$i<count($Blog);$i++){

		$dbObj->dbQuery = "update ".PREFIX."blog set display_order='".($i+1)."' where id=".$dbObj->sc_mysql_escape($Blog[$i]['id']);
		$dbObj->ExecuteQuery();
		//echo $dbObj->ExecuteQuery;exit;
	}

	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=blog&id='.$id.'&msg='.$msg);
	exit;
}


//mode to delete blog
if($mode=='delete_single_blog'){  // to delete seleted record
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	//to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."blog where id='".$id."'";
	$dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;
	
	if(file_exists(BLOG_IMAGE_PATH.$dbResult[0]['image']) && !empty($dbResult[0]['image'])){ 
		unlink(BLOG_THUMB_IMAGE_PATH.$dbResult[0]['image']); // remove resize image from thumbd folder
		unlink(BLOG_IMAGE_PATH.$dbResult[0]['image']); // remove original image form folder
	}
	
	delete_record($dbObj,PREFIX.'blog','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	$dbObj->dbQuery = "select * from ".PREFIX."blog where id=".$id;
	$Blog = $dbObj->SelectQuery();

		for($i=0;$i<count($Blog);$i++){
			$dbObj->dbQuery = "update ".PREFIX."blog set display_order='".($i+1)."' where id=".$dbObj->sc_mysql_escape($Blog[$i]['id']);
			$dbObj->ExecuteQuery();
			//echo $dbObj->ExecuteQuery;exit;
		}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=blog&id='.$id.'&msg='.$msg);
	exit;
}


if($mode == "change_blog_order"){

	$tdata = explode(",",$dbObj->sc_mysql_escape($_REQUEST['tdata']));
	$list = 1;

	for($i=0;$i<count($tdata);$i++){
		$query = "UPDATE ".PREFIX."blog SET display_order = " . $list . " WHERE id = ".$tdata[$i];
		mysqli_query($dbObj->connection, $query) or die('Error, insert query failed');
		$list++;
	}
}


//mode to change blog comment status
if($mode=="comment_status"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval']);

	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."blog_comment set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();

	echo $set_val;
	exit;
}


if($mode=="valuation_comment_status"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$set_val = $dbObj->sc_mysql_escape($_REQUEST['setval']);

	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."valuation_comment set status='".$set_val."' where id=".$id;
	$dbObj->ExecuteQuery();

	echo $set_val;
	exit;
}

//mode to delete blog comment
if($mode=='delete_blog_comment'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	//for($i=0;$i<count($id);$i++){

	delete_record($dbObj,PREFIX.'blog_comment','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	//}
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=blog_comment&id='.$id.'&msg='.$msg);
	exit;
}


//mode to delete Admin blog
if($mode=='delete_admin_blog'){  // to delete seleted record

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);//exit;  //array of selected record ids to delete
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."blog set admin_del='1' where id=".$id;
	$dbObj->ExecuteQuery();
	
	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=blog&id='.$id.'&msg='.$msg);
	exit;
}


//mode to blog Restore
if($mode=='blog_restore'){  // to delete seleted record
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);//exit;  // array of selected record ids to delete
	
	//to update Image status
	$dbObj->dbQuery = "update ".PREFIX."blog set admin_del='0' where id=".$id;
	$dbObj->ExecuteQuery();
	
	$msg = base64_encode("Record Restore Successfully."); // message about action performed
	header('location:index.php?mo=deleted_blog&id='.$id.'&msg='.$msg);
	exit;
}

//mode to delete blog
if($mode=='delete_deleted_blog'){  // to delete seleted record
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	
	//to remove image
	$dbObj->dbQuery = "select * from ".PREFIX."blog where id=".$id;
	$dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;
	
	if(file_exists(BLOG_IMAGE_PATH.$dbResult[0]['image']) && !empty($dbResult[0]['image'])){ 
		unlink(BLOG_THUMB_IMAGE_PATH.$dbResult[0]['image']); // remove resize image from thumbd folder
		unlink(BLOG_IMAGE_PATH.$dbResult[0]['image']); // remove original image form folder
	}
	
	delete_record($dbObj,PREFIX.'blog','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	$dbObj->dbQuery = "select * from ".PREFIX."blog where id=".$id;
	$Blog = $dbObj->SelectQuery();

		for($i=0;$i<count($Blog);$i++){
			$dbObj->dbQuery = "update ".PREFIX."blog set display_order='".($i+1)."' where id=".$dbObj->sc_mysql_escape($Blog[$i]['id']);
			$dbObj->ExecuteQuery();
			//echo $dbObj->ExecuteQuery;exit;
		}

	$msg = base64_encode("Record Successfully Deleted."); // message about action performed
	header('location:index.php?mo=deleted_blog&id='.$id.'&msg='.$msg);
	exit;
}

?>