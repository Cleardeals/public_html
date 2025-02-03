<?php
ob_start(); // turn on output buffering
session_start(); //start new or resume existing session
ini_set('memory_limit','128M'); // to increse upload limit to upload files
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
require_once '../excel_reader/excel_reader.php';
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail
$dbObj = new DBConnection(); // database connection

login_check();

$mode = $_REQUEST['mode'] ?? ""; // action to perform
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$info = $_REQUEST['info'] ?? ""; // data array sent from form

if($mode=="getcity"){
	
	$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID'] ?? "");
	
	//to get sub categories
	$dbObj->dbQuery="select * from ".PREFIX."city where state_id='".$stateID."'"; // for listing of records
	$dbcities = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	//print_r($dbcities);exit;

	$data='<option value="">City</option>';
	for($i=0;$i<count((array)$dbcities);$i++){
		if(!empty($stateID) && ($dbcities[$i]['city_name']==$stateID)){
		$data.='<option value="'.$dbcities[$i]['city_name'].'" selected >'.$dbcities[$i]['city_name'].'</option>';
		} else{
        	$data.='<option value="'.$dbcities[$i]['city_name'].'" >'.$dbcities[$i]['city_name'].'</option>';
		}
    }
	echo $data;
	exit;
}

//mode to get location
if($mode=="getlocation"){
	
	$cityID = $dbObj->sc_mysql_escape($_REQUEST['cityID'] ?? "");
	
	//to get sub categories
	$dbObj->dbQuery="select * from ".PREFIX."location where city='".$cityID."'"; // for listing of records
	$dblocation = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	//print_r($dblocation);exit;

	$data='<option value="">Location</option>';
	for($i=0;$i<count((array)$dblocation);$i++){
		if(!empty($cityID) && ($dblocation[$i]['location']==$cityID)){
		$data.='<option value="'.$dblocation[$i]['location'].'" selected>'.$dblocation[$i]['location'].'</option>';
		} else{
        	$data.='<option value="'.$dblocation[$i]['location'].'">'.$dblocation[$i]['location'].'</option>';
		}
    }
	echo $data;
	exit;
}

//mode to add/update manual users
if($mode=="import_users"){
	
	$info = $_REQUEST['info'];
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	
	if(isset($_REQUEST['delete'])){
		$dbObj->dbQuery = "TRUNCATE TABLE ".PREFIX."manual_users" ;
		$dbRes = $dbObj->ExecuteQuery('banner.php','get_detail()');
		
		$dbObj->dbQuery = "TRUNCATE TABLE ".PREFIX."user_email" ;
		$dbRes = $dbObj->ExecuteQuery('banner.php','get_detail()');
		
		$msg = base64_encode("Data Deleted Successfully");  // message about action performed
	    header('location:index.php?mo=import_users&msg='.$msg);
	    exit;
	} 
	
	if(isset($_REQUEST['excel'])){
		
		if(!isset($_FILES['upload_xls'])){
		$msg=base64_encode('Please Select xls Files.'); // message about action performed
		header('location:index.php?mo=import_users&msg='.$msg);
		exit;	
		}
		// code to upload xls
		// code to upload xls
	if(isset($_FILES['upload_xls']) && $_FILES['upload_xls']['size']>0){
	
		$image_name = time().'_'.str_replace(" ","_",$_FILES['upload_xls']['name']); // to remane image
		$temp = explode('.',$_FILES['upload_xls']['name']); // explode to get image extension
		$ext = $temp[count($temp)-1];
		
		if($ext!='xls' && $ext!='xlsx'){ // check format
		//echo "9";
		$msg=base64_encode('Please Select xls Files.'); // message about action performed
		header('location:index.php?mo=import_users&msg='.$msg);
		exit;
		}
		
		move_uploaded_file($_FILES['upload_xls']['tmp_name'],USER_EXC_PATH.$image_name);
		
	}
	
	$file = USER_EXC_PATH.$image_name;
	$excel = new PhpExcelReader; // creates object instance of the class
	$excel->read($file); // reads and stores the excel file data
	
//echo "Total Sheets in this xls file: ".count((array)$excel->sheets)."<br /><br />";exit;
 
 
$html="<table border='1'>";

for($i=0;$i<count((array)$excel->sheets);$i++) // Loop to get all sheets in a file.
{	
	if(count((array)$excel->sheets[$i][CELLS])>0) // checking sheet not empty
	{
		echo "Sheet $i:<br /><br />Total rows in sheet $i  ".count((array)$excel->sheets[$i][CELLS])."<br />";
		for($j=2;$j<=count((array)$excel->sheets[$i][CELLS]);$j++) // loop used to get each row of the sheet
		{ 
			$html.="<tr>";
			for($k=1;$k<=count((array)$excel->sheets[$i][CELLS][$j]);$k++) // This loop is created to get data in a table format.
			{
				$html.="<td>";
				$html.=$excel->sheets[$i][CELLS][$j][$k];
				$html.="</td>";
			}
			
			//$id = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][1]);
			//$location = str_replace(",",'',mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][1]));
			
			$name = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][1]);
			$email = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][2]);
			$mobile_no = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][3]);
			$country = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][4]);
			$state = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][5]);
			$city = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][6]);
			$user_type = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][7]);
			$address = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][8]);
			$for_property = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][9]);
			$property_type = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][10]);
			$bedroom = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][11]);
			$bathroom = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][12]);
			$prop_state = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][13]);
			$prop_city = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][14]);
			$location = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][15]);
			$price = mysqli_real_escape_string($dbObj->connection, $excel->sheets[$i][CELLS][$j][16]);
			
			$query = "insert into ".PREFIX."manual_users(name,email,mobile_no,country,state,city,user_type,address,for_property,property_type,bedroom,bathroom,prop_state,prop_city,location,price,status,post_date) values('".$name."','".$email."','".$mobile_no."','".$country."','".$state."','".$city."','".$user_type."','".$address."','".$for_property."','".$property_type."','".$bedroom."','".$bathroom."','".$prop_state."','".$prop_city."','".$location."','".$price."','1','".date('Y-m-d')."')";
 
			mysqli_query($dbObj->connection, $query);
						
			$html.="</tr>";
		}
 
}
 
$html.="</table>";
echo $html;
echo "<br />Data Inserted in dababase";

		
	}
	$msg = base64_encode("Record Saved Successfully");  // message about action performed
	    header('location:index.php?mo=import_users&msg='.$msg);
	    exit;
	}//exit;

}

//mode to search user
if($mode=="search_users"){
	
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id'] ?? "");
	$for_property = $dbObj->sc_mysql_escape($_REQUEST['for_property'] ?? "");
	$property_type = $dbObj->sc_mysql_escape($_REQUEST['property_type'] ?? "");
	$prop_state = $dbObj->sc_mysql_escape($_REQUEST['prop_state'] ?? "");
	$prop_city = $dbObj->sc_mysql_escape($_REQUEST['prop_city'] ?? "");
	$location = $dbObj->sc_mysql_escape($_REQUEST['location'] ?? "");
	$bedroom = $dbObj->sc_mysql_escape($_REQUEST['bedroom'] ?? "");
	$bathroom = $dbObj->sc_mysql_escape($_REQUEST['bathroom'] ?? "");
	$s_price = $dbObj->sc_mysql_escape($_REQUEST['s_price'] ?? "");
	$e_price = $dbObj->sc_mysql_escape($_REQUEST['e_price'] ?? "");
	
	if(!empty($location)){
	if(count($location)>1){
		for($i=0;$i<count($location);$i++){
			if(!empty($location[$i])){
			$locationname.= "'".$location[$i]."'";
			if($i!=(count($location)-1))
			$locationname.= ",";
			}
		}
	} else {
		$locationname = "'".$location[0]."'";
	}
	}
	
	header('Location:index.php?mo=manual_users&property_id='.$property_id.'&for_property='.$for_property.'&property_type='.$property_type.'&prop_state='.$prop_state.'&prop_city='.$prop_city.'&locationname='.$locationname.'&bedroom='.$bedroom.'&bathroom='.$bathroom.'&s_price='.$s_price.'&e_price'.$e_price.'');
	exit();
}

//get mode to delete manual users
if($mode=="delete_manual_users"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);  // array of selected record ids to delete
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id'] ?? "");
	$searchdata = base64_decode($dbObj->sc_mysql_escape($_REQUEST['searchdata'] ?? ""));
	//print_r($_POST);
	
	if(empty($id)){	 // check empty array
	   $msg=base64_encode("Please select record"); // message about action performed
	   header('location:index.php?mo=manual_users&property_id='.$property_id.'&msg='.$msg);
	   exit;
	}
	
	$dbObj->dbQuery = "select * from ".PREFIX."property where id='".$property_id."'";
	$dbProperty = $dbObj->SelectQuery('banner.php','get_detail()');
	
	$link = "".HTACCESS_URL.""."property-detail"."/".$dbProperty[0]['url']."/";	
	
	for($i=0;$i<count($id);$i++){
		
	//delete record
	if(isset($_POST['delete'])){
		
		delete_record($dbObj,PREFIX.'manual_users','id='.$id[$i]); // to delete record
		//echo $dbObj->dbQuery;exit;'
		
		delete_record($dbObj,PREFIX.'user_email','user_id='.$id[$i]); // to delete record
		//echo $dbObj->dbQuery;exit;
		$msg = base64_encode("Record Successfully Deleted."); // message about action performed
		header('location:index.php?mo=manual_users&property_id='.$property_id.'&msg='.$msg);
		exit;	
	}
		
		//code for send mail
	if(isset($_POST['email'])){
		//echo 1111111;
		
		$dbObj->dbQuery = "select * from ".PREFIX."manual_users where id='".$id[$i]."'";
		$dbRes = $dbObj->SelectQuery('banner.php','get_detail()');
		//echo $dbRes[$i]['email'];//exit;
		
		//print_r($id);exit;
		$info = array();
		$info['user_id'] = $dbRes[0]['id'];
		$info['name'] = $dbRes[0]['name'];
		//print_r($dbRes[$i]['name']);exit;
		$info['email'] = $dbRes[0]['email'];
		$info['mobile_no'] = $dbRes[0]['mobile_no'];
		$info['property_id'] = $property_id;
		$info['send_date'] = date('Y-m-d');
		$info['type'] = 'email';
		
		add_record($dbObj,PREFIX.'user_email', $info); // to delete record
		//echo $dbObj->dbQuery;exit;
		
		//for email 
		$mail = new PHPMailer();
		$mail->Priority = 3;
		$mail->From = "noreply@cleardeals.co.in";
		$mail->FromName = "Cleardeals";
		$mail->Subject = "Matched Property";
		$mail->AddAddress($dbRes[0]['email'],"User");
		$mail->Body = "";
		$mail->AltBody = "";
		$body = '';
		$body ='<table cellpadding="5" cellspacing="0" width="500px">
  <tr>
    <td><font face="Verdana" style="font-size:12px"><b>Hello Sir/Mam,</b></font></td>
  </tr>
  <tr>
    <td><font face="Verdana" style="font-size:12px">We have a new listing of owner property matching your requirements.<br>
      Please click on below link for more details. </font></td>
  </tr>
  <tr>
    <td><font face="Verdana" style="font-size:12px">Contact us on +91 9723992255 for scheduling visit.</a> </font></td>
  </tr>
  <tr>
    <td><font face="Verdana" style="font-size:12px"><a href="'.$link.'" target="_blank">'.$link.'</a> </font></td>
  </tr>
  <tr>
    <td><br />
      <font face="Verdana" style="font-size:12px" color="#666666"><b>Thanks & Regards,<br>
      Cleardeals.co.in<br>
      No Brokerage Real Estate </font></td>
  </tr>
</table>';
		//echo $body;// exit;
		//$mail->Body .= $body;//exit;
		$mail->MsgHTML($body);
		//$mail->Body .= $body;
		$mail->Send();
		$mail->ClearAllRecipients();
		
		
	}//exit;
		 
	//code for sms
	if(isset($_POST['sms'])){
		
		$dbObj->dbQuery = "select * from ".PREFIX."manual_users WHERE id='".$id[$i]."'";
		$dbRes = $dbObj->SelectQuery('banner.php','get_detail()');
		//echo $dbRes[$i]['email'];exit;
		$info = array();
		$info['user_id'] = $dbRes[0]['id'];
		$info['name'] = $dbRes[0]['name'];
		//print_r($dbRes[$i]['name']);exit;
		$info['email'] = $dbRes[0]['email'];
		$info['mobile_no'] = $dbRes[0]['mobile_no'];
		$info['property_id'] = $property_id;
		$info['send_date'] = date('Y-m-d');
		$info['type'] = 'sms';
		add_record($dbObj,PREFIX.'user_email',$info); // to add record
		//echo $dbObj->dbQuery;exit;
		$mobile[$i] = $dbRes[0]['mobile_no'];
		//echo $mobnumber = implode(",",$mobile);
		//include("groupsms.php");
	}
	
	} //end for loop	
	if(isset($_POST['sms'])){
		echo $mobnumber = implode(",",$mobile);
		include("groupsms.php");
		/*$smsmsg =  "Congratulations! We have a new property matching your requirements. ".$link." Call us on 9723992255 for site visit. ClearDeals, No Brokerage!";
		include("groupsms.php");
		//exit;
		$smsgatewaycenter = new psmplSMSGatewayCenter("mrwebsolutions", "Chahna@5959"); //Your username and password
		$smsgatewaycenter->setMobile($mobnumber); //Your comma separated mobile numbers
		$smsgatewaycenter->setMsg($smsmsg); // Your message
		$smsgatewaycenter->setMsgType(psmplSMSGatewayCenter::MSG_TYPE_TEXT); //Change to MSG_TYPE_UNICODE for Unicode message
		$smsgatewaycenter->setSenderId("CDEALS"); // Your approved sender anem
		$smsgatewaycenter->setSendMethod(psmplSMSGatewayCenter::METHOD_SIMPLE_MSG);
		$smsgatewaycenter->sendSMS(psmplSMSGatewayCenter::SMSAPI,'send');*/
		//echo $smsgatewaycenter->getResponse();

	}//exit;
	$msg = base64_encode("Notification Send Successfully."); // message about action performed
	header('location:index.php?mo=manual_users&msg='.$msg.$searchdata);
	exit;
}

//mode to update manual users
if($mode=="update_manual_users"){
	
	$info = $_REQUEST['info'];
	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id'] ?? "");
	
	$info['post_date'] = date('Y-m-d');
	modify_record($dbObj,PREFIX.'manual_users',$info,'id='.$id ); // to add record
	//echo $dbObj->dbQuery;exit;
	
	$msg = base64_encode("Record Modify Successfully");  // message about action performed
	header('location:index.php?mo=manual_users&property_id='.$property_id.'&msg='.$msg);
	exit;
}

//mode to delete manual users
if($mode=="delete_single_user"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id'] ?? "");
	
	delete_record($dbObj,PREFIX.'manual_users','id='.$id); // to delete record
	//echo $dbObj->dbQuery;exit;
	
	$msg = base64_encode("Record Modify Successfully");  // message about action performed
	header('location:index.php?mo=manual_users&property_id='.$property_id.'&msg='.$msg);
	exit;

}
?>