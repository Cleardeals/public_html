<?php 
ob_start();// turn on output buffering
session_start();//start new or resume existing session
require_once('config.php');// inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php');// to use database function
include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query
include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail  
//require("/home/cleardealsconi/public_html/classes/php_functions/class.phpmailer.php");
$dbObj = new DBConnection(); // database connection object 

$info = $_REQUEST['info']; // data array sent from form
$mode = $_REQUEST['mode'] ?? "";
$id = $_REQUEST['id'] ?? "";
$from = $_REQUEST['from'] ?? ""; 
$page = $_REQUEST['page'] ?? ""; // paging variable
$set = $_REQUEST['set'] ?? ""; // paging variable
$page_id = $_REQUEST['page_id'] ?? ""; // action to perform

//to get admin's email id
$dbObj->dbQuery = "SELECT email FROM ".PREFIX."adminuser where id='1'";
$dbAdmin = $dbObj->SelectQuery();

function random_strings($length_of_string){ 

    // String of all alphanumeric character 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 

    // Shufle the $str_result and returns substring 
    // of specified length 
    return substr(str_shuffle($str_result),  
                       0, $length_of_string); 

}

// mode to get city
if($mode=="getcity"){

	$stateID = $_REQUEST['stateID'];

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



// mode to get city
if($mode=="getcitypop"){

	$stateID = $_REQUEST['stateID'];

	//to get sub categories
	$dbObj->dbQuery="select * from cities where state_id='".$stateID."'"; // for listing of records
	$dbcities = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	//print_r($dbcities);exit;

	$data='<option value="">City</option>';
	for($i=0;$i<count((array)$dbcities);$i++){
		if(!empty($stateID) && ($dbcities[$i]['name']==$stateID)){
		$data.='<option value="'.$dbcities[$i]['name'].'" selected >'.$dbcities[$i]['name'].'</option>';
		} else{
        	$data.='<option value="'.$dbcities[$i]['name'].'" >'.$dbcities[$i]['name'].'</option>';
		}
    }
	echo $data;
	exit;
}



//mode to signup
if($mode=="signup") {

		$key=substr($_SESSION['key'],0,5);
     	$number = $_REQUEST['number'] ?? "";

		$_SESSION['sign_up']['name'] = $_REQUEST['name'];
		$_SESSION['sign_up']['email'] = $_REQUEST['email'];
		$_SESSION['sign_up']['mobile_no'] = $_REQUEST['mobile_no'];
		$_SESSION['sign_up']['state'] = $_REQUEST['state'];
		$_SESSION['sign_up']['city'] = $_REQUEST['city'];
		$_SESSION['sign_up']['username'] = $_REQUEST['username'];
		$_SESSION['sign_up']['password'] = $_REQUEST['password'];
		$_SESSION['sign_up']['user_type'] = $_REQUEST['user_type'];

		if($number==$key){

		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail WHERE username='".$_SESSION['sign_up']['username']."'";
		$dbUserCheck = $dbObj->SelectQuery();

		if(count((array)$dbUserCheck)>0) {
			
		$_SESSION['signup_msg'] = base64_encode("Username Already Exists Please Try With Different Username.");
		header("location:".HTACCESS_URL."sign-up/");
		exit;
		} else{

		// generate otp
		$rndno=rand(1000, 9999);
		$_SESSION['sign_up']['otp'] = $rndno;//exit;
		//include('mobileAPI.php');
		header('Location:'.HTACCESS_URL.'otp/');
		exit;
		}
		}else{
			$_SESSION['signup_msg'] = base64_encode("Invalid security code.");
			header('location:'.HTACCESS_URL.'sign-up/');
			exit;
	}

}



//mode to verify otp
if($mode=="verify_otp") {

		if($_SESSION['sign_up']['otp']==$_REQUEST['otp']){

		$password = md5((trim($_REQUEST['password'])));

		//$uname =  substr($info['name'],0,2);//exit;
		//$usernm = rand(1000, 9999);
		//$userName = "CD".$uname.$usernm."";
		//$info['username'] = $userName;

		$info['password'] = $password;
		$info['status'] = '0';
		$info['datetime'] = date('Y-m-d H:i:s');
		$client_id = add_record($dbObj,PREFIX.'user_detail',$info);
		//echo $dbObj->dbQuery;exit;

		unset($_SESSION['sign_up']);

		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail WHERE id='".$client_id."'";
		$dbUser = $dbObj->SelectQuery();

		// generate client id
		$znum=sprintf("%04s", $client_id);
		$clientid="CLR".$znum."";//exit;

		// generate username
		//$usernm=sprintf("%04s", $client_id);
		//$userName=$dbUser[0]['name']."cleardeal".$usernm."";//exit;
		//$uname = explode('',$dbUser[0]['name']);
		//print_r($uname);

		$dbObj->dbQuery = "update ".PREFIX."user_detail set clientid='".$clientid."' where id='".$client_id."'";
		$dbObj->ExecuteQuery();
		//echo $dbObj->dbQuery;exit;

		// mail for user
		$mail = new PHPMailer();
		$mail->Priority = 3;
		$mail->From = "contact@cleardeals.co.in";
		$mail->FromName = "Cleardeals";
		$mail->Subject = "Thank you for Cleardeals signup";
		$mail->AddAddress($dbUser[0]['email'],"User");
		$mail->Body = "";
		$mail->AltBody = "";
		$body = 'a<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#ccc">
      <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png" width="180"></td>
    </tr>
    <tr>
      <td><hr style="opacity:0.3;"/></td>
    </tr>
    <tr>
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"> <b>Hello </b>'.ucwords($dbUser[0]['name']).', </font></td>
          </tr>
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"> Thank you for signup Cleardeals.co.in. </font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial,Helvetica,sans-serif;font-size:13px"> <b>Your details are as follows:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="300">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px"> Client Id : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$clientid.'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px"> Username : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$dbUser[0]['username'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px"> Password : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$_REQUEST['password'].'</font></td>
                      </tr>';
                      $body .= '
                    </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><font face="Verdana" style="font-size:12px"> Account activate after admin approvel. </font></td>
                </tr>
                <tr>
                  <td height="64"><span style="float:left;font-size:16px;"> Kind regards;<br>
                    <b>Cleardeals.co.in</b> </span></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>';

		//echo $mail->Body .= $body;exit;
		//$mail->Body .= $body;
		$mail->MsgHTML($body);
		/*if($mail->Send) {
			echo "success";
		} else {
			echo "fail";
		}exit;*/
		$mail->Send();
		$mail->ClearAllRecipients();

		header('location:'.HTACCESS_URL.'thankyou-signup/');
		exit;

		}else{
			$_SESSION['otp_msg'] = base64_encode("Invalid Otp.");
			header('location:'.HTACCESS_URL.'otp/');
			exit;
			}

}



//login
if($mode=="login_form") {

	if(empty($_REQUEST['username'])) {
		$_SESSION['login_msg'] = base64_encode("Please Enter Username.");
		header('location:'.HTACCESS_URL.'sign-up/');
		exit;
	}
	
	if(empty($_REQUEST['password'])) {
		$_SESSION['login_msg'] = base64_encode("Please Enter Password.");
		header('location:'.HTACCESS_URL.'sign-up/');
		exit;
	}

	//$key1=substr($_SESSION['key1'],0,5);
    //$number1 = $_REQUEST['number1'];

	$password = md5((trim($_REQUEST['password'])));

	//if($number1==$key1){

	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail WHERE username='".$_REQUEST['username']."' AND password='".$password."'";
	$dbLoginCheck = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;

	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail WHERE username='".$_REQUEST['username']."' AND password='".$password."' AND status='1'";
	$dbStatusCheck = $dbObj->SelectQuery();

	if(count($dbLoginCheck)<1) {

		$_SESSION['login_msg'] = base64_encode("Invalide Username Or Password Please Try Again.");
		header('location:'.HTACCESS_URL.'sign-up/');
		exit;

	} elseif(count($dbStatusCheck)<1)  {
		$_SESSION['login_msg'] = base64_encode("Your Profile is yet not activated, try after sometime.");
		header('location:'.HTACCESS_URL.'sign-up/');
		exit;
	}else{
		$_SESSION['user']['is_login'] = 1;
		$_SESSION['user']['username'] = $dbLoginCheck[0]['username'];
		$_SESSION['user']['userid'] = $dbLoginCheck[0]['id'];
		$_SESSION['user']['clientid'] = $dbLoginCheck[0]['clientid'];

		//unset($_SESSION['login']);
		header('location:'.HTACCESS_URL.'dashboard/');
		exit;

	}//}
}



//login with popup
if($mode=='login_pop'){

	//$username = $info['username'];
	//$_SESSION['register']['username'] = $info['username'];

	$username = $dbObj->sc_mysql_escape($_REQUEST['pop_username']);
	$password = $dbObj->sc_mysql_escape(md5((trim($_REQUEST['pop_password1']))));

	/*$dbObj->dbQuery = "SELECT * FROM user WHERE  email='".$email."'";
	$dbUserCheck = $dbObj->SelectQuery();

	if(!empty($dbUserCheck)){
		echo "1"; exit;
	} */


	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail WHERE username='".$username."' AND password='".$password."'";
	$dbUserCheck = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;

	if(count($dbUserCheck)<1) {
		echo "2"; exit;
	} else

		$_SESSION['user']['is_login'] = 1;
		$_SESSION['user']['username'] = $dbUserCheck[0]['username'];
		$_SESSION['user']['userid'] = $dbUserCheck[0]['id'];
		$_SESSION['user']['clientid'] = $dbUserCheck[0]['clientid'];

		echo "0";
	exit;
	//echo $dbObj->dbQuery;//exit;
}



//logout
if($mode=='logout') {
	unset($_SESSION['user']);
	session_destroy();
	session_set_cookie_params(0);
	$_SESSION['login_msg'] = base64_encode("Logout Successfully.");
	header('location:'.HTACCESS_URL.'');
	exit;
}



// forgot password
if($mode=="forgot_pass"){
 
//  $mail = new PHPMailer();
//            $mail->IsSMTP();  // telling the class to use SMTP
//            $mail->SMTPDebug = 2;

//            $mail->SMTPSecure = 'ssl';
// $mail->Host = 'ssl://smtp.gmail.com';
// $mail->Port = 465; 

//            $mail->Mailer = "smtp"; 
//            $mail->SMTPAuth = false; // turn on SMTP authentication
//            $mail->SMTPAutoTLS = true; 
//            $mail->Username = "cleardealsenquiry@gmail.com"; // SMTP username
//            $mail->Password = "Clear$123"; // SMTP password
//            $Mail->Priority = 1;
//            $mail->AddAddress("bhargav2096@gmail.com","Name");
//            $mail->SetFrom("cleardealsenquiry@gmail.com", "name1");
//            $mail->AddReplyTo("cleardealsenquiry@gmail.com", "name12");
//            $mail->Subject  = "This is a Test Message";
//            $mail->Body     = "This is a Test Messagew";
//            $mail->WordWrap = 50;
//            if(!$mail->Send()) {
//            echo 'Message was not sent.';
//            echo 'Mailer error: ' . $mail->ErrorInfo;
//            } else {
//            echo 'Message has been sent.';
//            }
//            exit();
exit();
    // $mail = new PHPMailer();

    // $mail->CharSet = "utf-8";                                       // Set mailer to use SMTP
    // $mail->Host = "mail.gmail.com";  // Specify main and backup server
    // $mail->SMTPAuth = false;     // Turn on SMTP authentication
    // $mail->Username = "cleardealsenquiry@gmail.com";  // SMTP username
    // $mail->Password = "Clear$123"; // SMTP password
    // $mail->Port = 587;  
    // $mail->From = "cleardealsenquiry@gmail.com";
    // $mail->FromName = "System-Ad";
    // $mail->AddAddress("bhargav2096@gmail.com","Bhargav");

    // $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
    // $mail->IsHTML(true);                                  // Set email format to HTML (true) or plain text (false)

    // $mail->Subject = "This is a Sampleenter code here Email";
    // $mail->Body    = "This is a Sampleenter code here Email";
    // $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
    // //print_r($mail);exit(); 
    // if($mail->Send())
    // {
       
    // 	echo "Message has been sent1";
    // exit;
    // }else{
    // 	echo "Message could not be sent. <p>";
    //    echo "Mailer Error: " . $mail->ErrorInfo;
    //    exit;
    // }

    
$to = "bhargavkachhot.rs@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: webmaster@example.com" . "\r\n" .
"CC: somebodyelse@example.com";

mail($to,$subject,$txt,$headers);
 exit;
	$username = $dbObj->sc_mysql_escape($_REQUEST['username']);

	$dbObj->dbQuery="select * from ".PREFIX."user_detail where username='".$username."' AND status='1'";
	$dbUser = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	echo count($dbUser);
	 
if(count($dbUser)<1) {

		$_SESSION['forgot_msg'] = base64_encode("This Username is not Registered with us.");
		header('location:'.HTACCESS_URL.'forgot-password/');
		exit;
	}else{
	$newpassword = random_strings(10);
	
	//if($info['pass_type']=='email'){
	
		
	$info['password'] = md5(trim($newpassword));

	modify_record($dbObj,PREFIX.'user_detail',$info,'id='.$dbUser[0]['id']); 
	//echo $dbObj->dbQuery;exit; 
	//forgot password email 

 $mail = new PHPMailer; //From email address and name 
$mail->From = "contact@cleardeals.co.in"; 
$mail->FromName = "Cleardeals"; //To address and name 
$mail->addAddress($dbUser[0]['email'],$dbUser[0]['name']);//Recipient name is optional
$mail->addAddress($dbUser[0]['email']); //Address to which recipient will reply  
$mail->isHTML(true); 
$mail->Subject = "Forgot Password"; 
$mail->Body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#ccc">
      <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png" width="180"></td>
    </tr>
    <tr>
      <td><hr style="opacity:0.3;"/></td>
    </tr>
    <tr>
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"> <b>Hello </b>'.ucwords($dbUser[0]['name']).', </font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial,Helvetica,sans-serif;font-size:13px"> <b>Your new password are as follows:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="300">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px"> Client Id : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$dbUser[0]['clientid'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px"> Username : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$dbUser[0]['username'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px"> Password : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px"> '.$newpassword.'</font></td>
                      </tr>';
                      $body .= '
                    </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td height="64"><span style="float:left;font-size:16px;"> Kind regards;<br>
                    <b>Cleardeals.co.in</b> </span></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>';
$mail->AltBody = "This is the plain text version of the email content"; 
 
	$mail->Send();
	$mail->ClearAllRecipients(); 
	$_SESSION['forgot_succ_msg'] = base64_encode("A New Password Is Sent To Your Email Address.");
	header('location:'.HTACCESS_URL.'forgot-password/');
 
	}
}



// change username
if($mode=="change_username"){

	$name = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$email = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$clientid = $dbObj->sc_mysql_escape($_REQUEST['clientid']);

	$dbObj->dbQuery="select * from ".PREFIX."user_detail where clientid='".$clientid."' AND name='".$name."' AND email='".$email."' AND status='1'";
	$dbUser = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	

	/*$uname =  substr($name,0,2);//exit;
	$usernm = rand(1000, 9999);
	$userName = "CD".$uname.$usernm."";

	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail WHERE username='".$userName."'";
	$dbUserCheck = $dbObj->SelectQuery();*/
	

	//if($info['pass_type']=='email'){
	if(count((array)$dbUserCheck)<1) {

		$unam =  substr($name,0,2);//exit;
		$usern = rand(1000, 9999);
		$userName = "CD".$unam.$usern."";
		$info['username'] = $userName;

	}else{
		$info['username'] = $userName;
	}

	/*if(count($dbUser)<1) {
		$_SESSION['forgot_msg'] = base64_encode("This Detail is not Registered with us.");
		header('location:'.HTACCESS_URL.'change-username/');
		exit;
	}else{*/

	//modify_record($dbObj,PREFIX.'user_detail',$info,'id='.$dbUser[0]['id']); 
	//echo $dbObj->dbQuery;exit;

	//forgot password email
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = 'contact@cleardeals.co.in';
	$mail->FromName = 'Cleardeals';
	$mail->Subject = "Forgot Username";
	$mail->AddAddress($dbAdmin[0]['email'],'Cleardeals');
	$mail->Body = "";
	$mail->AltBody = "";
	$body .= '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#ccc">
      <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png" width="180"></td>
    </tr>
    <tr>
      <td><hr style="opacity:0.3;"/></td>
    </tr>
    <tr>
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).'</strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello</b> Admin,</font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial,Helvetica,sans-serif;font-size:13px"><b>'.ucwords($name).' has forgot username.</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="300">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Name :</font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$name.'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Email :</font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$email.'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Id :</font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$clientid.'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Note :</font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['detail'].'</font></td>
                      </tr>';
                      
                      $body .= '
                    </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td height="64"><span style="float:left;font-size:16px;">Kind regards;<br>
                    <b>Cleardeals.co.in</b></span></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>';

	//echo $mail->Body .= $body;exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	/*if($mail->Send) {
		echo "success";
	} else {
		echo "fail";
	}exit;*/
	$mail->Send();
	$mail->ClearAllRecipients();

	$_SESSION['forgot_succ_msg'] = base64_encode("Your Request Send Successfully.");
	header('location:'.HTACCESS_URL.'change-username/');

}


//signup with popup
if($mode=='signup_pop'){

	//$username = $info['username'];
	//$_SESSION['register']['username'] = $info['username'];
	$username = $dbObj->sc_mysql_escape($_REQUEST['username']);//exit; 

	$key=substr($_SESSION['key'],0,5);
	$number = $_REQUEST['number'];

	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail WHERE username='".$username."'";
	$dbUserCheck = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;

	//if($number==$key){
	//$_SESSION['sign_up']['otp'] = $_REQUEST['check_otp'];//exit;
	//echo $_REQUEST['otp'].'<br>';

	/*if((int)$_SESSION['sign_up']['otp']!=(int)$_REQUEST['otp']){
		echo "3"; exit();
	} else */
	
	if(count((array)$dbUserCheck)>0) {
		echo "2";exit();
	} else{
		
		$password = $dbObj->sc_mysql_escape(md5((trim($_REQUEST['password']))));
		
		//$uname =  substr($info['name'],0,2);//exit;
		//$usernm = rand(1000, 9999);
		//$userName = "CD".$uname.$usernm."";

		$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
		$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
		$info['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
		if(!empty($_REQUEST['user_type']))
		$info['user_type'] = $dbObj->sc_mysql_escape($_REQUEST['user_type']);
		if(!empty($_REQUEST['state']))
		$info['state'] = $dbObj->sc_mysql_escape($_REQUEST['state']);
		if(!empty($_REQUEST['city']))
		$info['city'] = $dbObj->sc_mysql_escape($_REQUEST['city']);
		$info['username'] = $dbObj->sc_mysql_escape($_REQUEST['username']);
		$info['country'] = 'India';
		$info['password'] = $password;
		$info['status'] = '1';
		$info['datetime'] = date('Y-m-d H:i:s');

		$client_id = add_record($dbObj,PREFIX.'user_detail',$info);
		//echo $dbObj->dbQuery;//exit;

		unset($_SESSION['sign_up']);

		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."user_detail WHERE id='".$client_id."'";
		$dbUser = $dbObj->SelectQuery();

		// generate client id
		$znum=sprintf("%04s", $client_id);
		$clientid="CLR".$znum."";//exit;

		$dbObj->dbQuery = "update ".PREFIX."user_detail set clientid='".$clientid."' where id='".$client_id."'";
		$dbObj->ExecuteQuery();
		//echo $dbObj->dbQuery;//exit;

		//login
		$_SESSION['user']['is_login'] = 1;
		$_SESSION['user']['username'] = $dbUser[0]['username'];
		$_SESSION['user']['userid'] = $dbUser[0]['id'];
		$_SESSION['user']['clientid'] = $clientid;

		// mail for user
		$mail = new PHPMailer();
		$mail->Priority = 3;
		$mail->From = "contact@cleardeals.co.in";
		$mail->FromName = "Cleardeals";
		$mail->Subject = "Thank you for Cleardeals signup";
		$mail->AddAddress($dbUser[0]['email'],$dbUser[0]['name']);
		$mail->Body = "";
		$mail->AltBody = "";
		$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#ccc">
      <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png" width="180"></td>
    </tr>
    <tr>
      <td><hr style="opacity:0.3;"/></td>
    </tr>
    <tr>
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).'</strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px">Hello '.ucwords($dbUser[0]['name']).',</font></td>
          </tr>
          <tr>
            <td colspan="2"><font face="Verdana" style="font-size:12px">Thank you for signup Cleardeals.co.in.</font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial,Helvetica,sans-serif;font-size:13px"><b>Your details are as follows:</b></font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="300">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Id :</font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$clientid.'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Username :</font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbUser[0]['username'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Password :</font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['password'].'</font></td>
                      </tr>';
                      $body .= '
                    </table></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td height="64"><span style="float:left;font-size:16px;">Kind regards;<br>
                    Cleardeals.co.in</span></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>';

		//echo $mail->Body .= $body;exit;
		//$mail->Body .= $body;
		$mail->MsgHTML($body);
		/*if($mail->Send) {
			echo "success";
		} else {
			echo "fail";
		}exit;*/
		$mail->Send();
		$mail->ClearAllRecipients();

		echo "1";

	exit();
	}

}
?>