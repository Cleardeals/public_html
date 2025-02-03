<?php
ob_start();
session_start();
require_once('../config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php'); // file to access predefine php funtion
include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query
include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail 
$dbObj = new DBConnection();

$mode = $_REQUEST['mode'] ?? "";
//$info = $_REQUEST['info'];
$link = $dbObj->sc_mysql_escape($_REQUEST['link'] ?? "");
$page = $dbObj->sc_mysql_escape($_REQUEST['page'] ?? "");
$set = $dbObj->sc_mysql_escape($_REQUEST['set'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

//LOGOUT MODULE
if($mode=='logout'){

	unset($_SESSION['is_admin']); // to unset login session
	unset($_SESSION['admin_user_name']); // to unset login session
	unset($_SESSION['access']);
	unset($_SESSION['srgit_cms_admin_id']);
	unset($_SESSION['pages']);
	unset($_SESSION['c_support']);
	unset($_SESSION['state']);
	unset($_SESSION['city']);
	unset($_SESSION['location']);
	unset($_SESSION['property']);
	unset($_SESSION['comproperty']);
	unset($_SESSION['services']);
	unset($_SESSION['receipt']);
	unset($_SESSION['gst_receipt']);
	unset($_SESSION['users']);
	unset($_SESSION['faq']);
	unset($_SESSION['team']);
	unset($_SESSION['blog']);
	unset($_SESSION['careers']);
	unset($_SESSION['review']);
	unset($_SESSION['package']);
	unset($_SESSION['cdetail']);
	unset($_SESSION['pdetail']);
	unset($_SESSION['free_valuation']);
	unset($_SESSION['appointment']);
	unset($_SESSION['let_nik']);
	unset($_SESSION['video_testimonial']);

	$msg = base64_encode("Logout successfully....");
	header('location:index.php?mo=login&msg='.$msg);
	exit;
}

//LOGIN MODULE
if($mode=="login_step1"){ 
	
	$name = $dbObj->sc_mysql_escape($_POST['username'] ?? "");
	
	$dbObj->dbQuery="select * from ".PREFIX."adminuser where username='".$name."'";
    $dbResult = $dbObj->SelectQuery();
	//print_r($dbResult);exit;
	
	if(count((array)$dbResult)>0){ //if username and password get match with database
	
		//generate otp
		$rndno=rand(1000, 9999);
		$_SESSION['adminLogin']['otp'] = $rndno;//exit;
		$_SESSION['adminLogin']['mobile_no'] = $dbResult[0]['contact_no'];
		$_SESSION['adminLogin']['email'] = $dbResult[0]['email'];
		
		include('mobileAPI.php');
		
		 $to = "".$dbResult[0]['full_name']." <".$dbResult[0]['email'].">";//change receiver address 
		 $subject = "Login Otp";  
		 $message = '<table cellpadding="5" cellspacing="0" width="500px">
		<tr>
		  <td><font face="Verdana" style="font-size:12px"> <b>Hello '.$dbResult[0]['full_name'].',</b></font></td>
		</tr>
		<tr>
		  <td><font face="Verdana" style="font-size:12px"> Your otp is '.$_SESSION['adminLogin']['otp'].'.</font></td>
		</tr>
		<tr>
		  <td><br />
			<font face="Verdana" style="font-size:12px" color="#0B1D24"> <b>Regards,<br />
			<font face="Verdana" style="font-size:12px" color="#0B1D24"> Cleardeals.co.in</font></b> </font></td>
		</tr>
	  </table>';
		
		 $header = "From:Cleardeals <contact@cleardeals.co.in> \r\n";  
		 $header .= "MIME-Version: 1.0 \r\n";  
		 $header .= "Content-type: text/html;charset=UTF-8 \r\n";  
		
		 $result = mail ($to,$subject,$message,$header);
		
		$msg = base64_encode("Your otp send to mobile number/email.");
		header('location:index.php?mo=login-otp&msg='.$msg);
		//login_check_redirect($_REQUEST['referurl']);
		exit;	
	
	} else { //if user and password does not match with database
	
		$msg = base64_encode("Invalid Username....");
		header('location:index.php?mo=login&msg='.$msg);
		exit;
	}
}

//LOGIN MODULE
if($mode=="login"){ 

	$otp = $dbObj->sc_mysql_escape($_POST['otp'] ?? "");

	$dbObj->dbQuery="select * from ".PREFIX."adminuser where contact_no='".$_SESSION['adminLogin']['mobile_no']."' and email='".$_SESSION['adminLogin']['email']."'";
    $dbResult = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;

	if($otp==$_SESSION['adminLogin']['otp']){ // if username and password get match with database

		$_SESSION['is_admin'] = 1;	// ligin session is set
		$_SESSION['admin_user_name'] = $dbResult[0]['username'];
		$_SESSION['srgit_cms_admin_id'] = $dbResult[0]['id'];

			$access = explode(',',$dbResult[0]['privilege'] ?? "");

			for($i=0;$i<count($access);$i++){
				if(!empty($access[$i])){
					//echo $access[$i];
					$_SESSION[$access[$i]] = 'Y';
				}
			}

			/*if($dbResult[0]['id']!=1){

			$info['user_id'] = $dbResult[0]['id'];
			$info['username'] = $dbResult[0]['username'];
			$info['datetime'] = date('Y-m-d H:i:s');
			add_record($dbObj,PREFIX.'login_log',$info);
			}*/

		//}

		//echo $_SESSION['srgit_cms_admin_id'];
		//exit;
		//print_r($_SESSION['access'] ?? "");exit;
		
		unset($_SESSION['adminLogin']);
		header('location:index.php?mo=dashboard');
		//login_check_redirect($_REQUEST['referurl']);
		exit;	

	} else { // if user and password does not match with database

		$msg = base64_encode("Invalid Otp....");
		header('location:index.php?mo=login-otp&msg='.$msg);
		exit;
	}
}


//change Password
if($_REQUEST['mode']=="change_password"){

	if(empty($_REQUEST['password'])){
		$msg = base64_encode("Please Enter Password."); // message about action performed
		header('location:index.php?mo=change_password&msg='.$msg);
		exit;
	}

	if(empty($_REQUEST['rpassword'])){
		$msg = base64_encode("Please Re-Type Password."); // message about action performed
		header('location:index.php?mo=change_password&msg='.$msg);
		exit;
	}

	if($_REQUEST['password']!=$_REQUEST['rpassword']){
		$msg = base64_encode("Passwords donot match."); // message about action performed
		header('location:index.php?mo=change_password&msg='.$msg);
		exit;
	}

	$info['password'] = $dbObj->sc_mysql_escape(trim(md5($_REQUEST['password']))); // encrypt the passwords
	$id = $dbObj->sc_mysql_escape($_SESSION['id']);

	modify_record($dbObj,PREFIX.'adminuser',$info,'id='.$id); // to modify record
	//echo $dbObj->dbQuery ;exit;

	$msg = base64_encode("Password Successfully Modified."); // message about action performed
	header('location:index.php?mo=change_password&msg='.$msg);
	exit;
}


//forgot password
if($_POST['mode']=="forgot_password"){

	$username = $dbObj->sc_mysql_escape($_POST['username']);
	$dbResult = get_data($dbObj,"adminuser","username='$username'","*");
	//print_r($dbResult);exit;

	if(count($dbResult)>0){ // username get match with database

	$password = Randon_Number(); // Randon_Number() return random password
	//$info['username'] = $username;
	$info['password'] = md5($password); // to encrypt password

	modify_record($dbObj,PREFIX.'adminuser',$info,'id='.$dbResult[0]['id']); // to modify record

	$mail = new PHPMailer();
	$mail->Priority = 3; // COPY
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Admin";
	$mail->Subject = "Password Recovery";
	$mail->AddAddress($dbResult[0]['email'], "Administrator");
	$mail->Body = "";
	$mail->AltBody = "";

	$body .= '<table cellpadding="5" cellspacing="0" width="500px">
  <tr>
    <td><font face="Verdana" style="font-size:12px"> <b>Hello Administrator,</b></font></td>
  </tr>
  <tr>
    <td><font face="Verdana" style="font-size:12px"> Access For Admin Panel.</font></td>
  </tr>
  <tr>
    <td><font face="Verdana" style="font-size:12px"> Admin User Name - <strong>'.$dbResult[0]['username'].'</strong></font></td>
  </tr>
  <tr>
    <td><font face="Verdana" style="font-size:12px"> New Password - <strong>'.$password.'</strong></font></td>
  </tr>
  <tr>
    <td><br />
      <font face="Verdana" style="font-size:12px" color="#0B1D24"> <b>Regards,<br />
      <font face="Verdana" style="font-size:12px" color="#0B1D24"> Cleardeals.co.in</font></b> </font></td>
  </tr>
</table>';

	$mail->MsgHTML($body);
	$mail->Send();
	$mail->ClearAllRecipients();

	$msg ="A New Password Is Sent To Your Email Address";
	} else { // if username did not match with database
	$msg ="Invalid User Name.";
	}
	redirect($msg,"login&m=1");
}


//change email
if($mode=='update_email'){
	
	modify_record($dbObj,PREFIX.'adminuser',$info,'id='.$dbObj->sc_mysql_escape($_SESSION['srgit_cms_admin_id'])); // to modify record
	//echo $dbObj->dbQuery ;exit;

	$msg = base64_encode("Record Successfully Modified."); // message about action performed
	header('location:index.php?mo=change_email&msg='.$msg);
	exit;
}


//change content
if($mode=='update_content'){
	
	modify_record($dbObj,PREFIX.'settings',$info,'id=1'); // to modify record
	//echo $dbObj->dbQuery ;exit;

	$msg = base64_encode("Record Successfully Modified."); // message about action performed
	header('location:index.php?mo=top_popup&msg='.$msg);
	exit;
}


//change content
if($mode=='update_links'){ 

$servername = "localhost";
$username = "cleardealsconi_newdeals";
$password = "2}g]vhoD1z+j";
$dbname = "cleardealsconi_newdeals";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname); 
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}

foreach ($info as $key => $value) {
		foreach ($value as $sub_key => $sub_value) {
			$id = $sub_key+1;
			$sql = "UPDATE clear_request_callback_links SET name='".$sub_value."' WHERE id=".$id." "; 
			$conn->query($sql); 
		}
	}

	foreach ($link as $key => $value) {
		foreach ($value as $sub_key => $sub_value) {
			$id = $sub_key+1;
			$sql = "UPDATE clear_request_callback_links SET link='".$sub_value."' WHERE id=".$id." "; 
			$conn->query($sql); 
		}
	} 

 	$conn->close();
 	$msg = base64_encode("Record Successfully Modified."); // message about action performed
	header('location:index.php?mo=request_call_back_links&msg='.$msg);
	exit;
}


//mode to add admin
if($mode == 'add_admin'){ 

	$info = $_REQUEST['info'];
	
	if(!empty($_REQUEST['pages'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['pages'].',');
	}

	if(!empty($_REQUEST['c_support'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['c_support'].',');
	}

	if(!empty($_REQUEST['state'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['state'].',');
	}

	if(!empty($_REQUEST['city'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['city'].',');
	}

	if(!empty($_REQUEST['location'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['location'].',');
	}

	if(!empty($_REQUEST['users'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['users'].',');
	}

	if(!empty($_REQUEST['property'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['property'].',');
	}
	
	if(!empty($_REQUEST['comproperty'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['comproperty'].',');
	}

	if(!empty($_REQUEST['receipt'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['receipt'].',');
	}

	if(!empty($_REQUEST['gst_receipt'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['gst_receipt'].',');
	}

	if(!empty($_REQUEST['services'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['services'].',');
	}

	if(!empty($_REQUEST['faq'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['faq'].',');
	}

	if(!empty($_REQUEST['team'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['team'].',');
	}

	if(!empty($_REQUEST['blog'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['blog'].',');
	}

	if(!empty($_REQUEST['careers'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['careers'].',');
	}

	if(!empty($_REQUEST['review'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['review'].',');
	}

	if(!empty($_REQUEST['package'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['package'].',');
	}

	if(!empty($_REQUEST['cdetail'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['cdetail'].',');
	}

	if(!empty($_REQUEST['pdetail'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['pdetail'].',');
	}

	if(!empty($_REQUEST['free_valuation'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['free_valuation'].',');
	}

	if(!empty($_REQUEST['appointment'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['appointment'].',');
	}

	if(!empty($_REQUEST['let_nik'])){
		$privilege .= $dbObj->sc_mysql_escape($_REQUEST['let_nik'].',');
	}

	/*validation compelete*/
	$info['username']= $dbObj->sc_mysql_escape($info['username']);
	$info['privilege'] = $privilege;
	//print_r($info);exit;

	if(empty($id)){

		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."adminuser WHERE username='".$dbObj->sc_mysql_escape($info['username'])."'";
		$dbRes = $dbObj->SelectQuery('edithome.php','aboutEdit()');

		if(isset($dbRes) && !empty($dbRes)){

			$msg = base64_encode("UserName already registered, Try Another...");
			header('location:index.php?mo=admin_users&msg='.$msg.'&id='.$id.'&page='.$page.'&set='.$set);
			exit;

		} else {

			$info['password'] = md5($dbObj->sc_mysql_escape($_REQUEST['password']));
		    add_record($dbObj,PREFIX.'adminuser',$info);
		}		

	} else {

		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."adminuser WHERE username='".$dbObj->sc_mysql_escape($info['username'])."' and id!='".$id."'";
		$dbRes = $dbObj->SelectQuery('edithome.php','aboutEdit()');

		if(isset($dbRes) && !empty($dbRes)){

			$msg = base64_encode("UserName already registered, Try Another...");
			header('location:index.php?mo=admin_users&msg='.$msg.'&id='.$id.'&page='.$page.'&set='.$set);
			exit;
		}

		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."adminuser WHERE id='".$id."'";
		$dbResult = $dbObj->SelectQuery('edithome.php','aboutEdit()');

		if($_REQUEST['password']==$dbResult[0]['password']){
			$info['password'] = ($dbObj->sc_mysql_escape($_REQUEST['password']));
		}else{
			$info['password'] = md5($dbObj->sc_mysql_escape($_REQUEST['password']));
		}

		modify_record($dbObj,PREFIX.'adminuser',$info,'id='.$id); // to modify record
		//echo $dbObj->dbQuery;exit;
	}

	$msg = base64_encode("Records successfully saved");
	header('location:index.php?mo=admin_users&msg='.$msg);
	exit;
}

//mode to edit profile
if($mode == 'edit_profile'){ 

	$info = $_REQUEST['info'];

	modify_record($dbObj,PREFIX.'adminuser',$info,'id='.$id); // to modify record
	//echo $dbObj->dbQuery;exit;

	$msg = base64_encode("Records successfully saved");
	header('location:index.php?mo=edit_profile&msg='.$msg);
	exit;
}
?>