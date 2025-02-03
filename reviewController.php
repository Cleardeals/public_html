<?php
ob_start();// turn on output buffering
session_start();//start new or resume existing session
ini_set('memory_limit','128M'); // to increse upload limit to upload files
require_once('config.php'); // config file
require_once(MYSQL_CLASS_DIR.'DBConnection.php'); // file to make database connection
require_once(PHP_FUNCTION_DIR.'function.database.php');  // file to access predefine php funtion
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail 
$dbObj = new DBConnection(); // database connection

$page = $_REQUEST['page'] ?? ""; // paging variable
$set = $_REQUEST['set'] ?? ""; // paging variable

$mode = $_REQUEST['mode'] ?? ""; // action to perform
$id = $_REQUEST['id'] ?? "";
$info = $_REQUEST['info']; // data array sent from form

// to get contact details
$dbObj->dbQuery="select * from ".PREFIX."adminuser where id='1'"; // to fetch selected id's data
$dbAdmin = $dbObj->SelectQuery();
//echo $dbAdmin[0]['email'];exit;

// mode to add review
if($mode=="add_review"){
	
	$key=substr($_SESSION['key'],0,5);
    $number = $dbObj->sc_mysql_escape($_REQUEST['number']);
	
	$_SESSION['reviews']['rating'] = $dbObj->sc_mysql_escape($info['rating']);
	$_SESSION['reviews']['name'] = $dbObj->sc_mysql_escape($info['name']);
	$_SESSION['reviews']['email'] = $dbObj->sc_mysql_escape($info['email']);
	$_SESSION['reviews']['designation'] = $dbObj->sc_mysql_escape($info['designation']);
	$_SESSION['reviews']['review'] = $dbObj->sc_mysql_escape($info['review']);
	
	if($number==$key){
	
	if(!empty($_SESSION['reviews']['rating']) && !empty($_SESSION['reviews']['name']) && !empty($_SESSION['reviews']['email']) && !empty($_SESSION['reviews']['designation']) && !empty($_SESSION['reviews']['review'])){
	
	 // mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals Review";
	$mail->Subject = "Cleardeals Review";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
	//$mail->AddBcc('swalehap@srgit.com', "SRGIT");
	$mail->Body = "";
	$mail->AltBody = "";
	$body .= '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#fff">
      <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png" width="180"></td>
    </tr>
    <tr>
      <td><hr style="opacity:0.3;"/></td>
    </tr>
    <tr>
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px">Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> 
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"><b>Dear Management & Staff,</b>
			    <br/>
                <br/>
                Add new review details are as follows:</font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['reviews']['name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['reviews']['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Designation : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['reviews']['designation'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Review : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_SESSION['reviews']['review'].'</font></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>';
	
	//echo $mail->Body .= $body;//exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	/*if($mail->Send) {
		echo "success";
	} else {
		echo "fail";
	}exit;*/
	$mail->Send();
	$mail->ClearAllRecipients();
	
	// mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals Review";
	$mail->Subject = "Cleardeals Review";
	$mail->AddAddress($_SESSION['reviews']['email'],"User");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
    <tr style="background:#fff">
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
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> 
			<font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"><b> Dear</b>
			&nbsp;'.$_SESSION['reviews']['name'].',</font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="300">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left"><font face="Verdana" style="font-size:12px">Thank you for add review</font></td>
                      </tr>
                      <tr>
                        <td align="left"><font face="Verdana" style="font-size:12px">Your review display after admin approvel.</font></td>
                      </tr>
                      <tr>
                        <td height="64"><span style="float:left;font-size:16px;">Kind regards;<br>
                          <b>Cleardeals.co.in</b> </span></td>
                      </tr>
                    </table></td>
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
	
	$info['display_order']= 0;
	$info['home_status'] =0;
	$info['status']= 0;
	$info['published_on'] = date('Y-m-d');
	add_record($dbObj,PREFIX.'review',$info);
	//echo $dbObj->dbQuery;exit;
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."review order by display_order ASC";
	$dbRevieworder = $dbObj->SelectQuery();
	
	for($k=0;$k<count($dbRevieworder);$k++){
	   $dbObj->dbQuery = "update ".PREFIX."review set display_order='".($k+1)."' where id=".$dbRevieworder[$k]['id'];
	   $dbObj->ExecuteQuery();
	}
	
	unset($_SESSION['reviews']);
	header('location:'.HTACCESS_URL.'review-us-form/#thank-you-popup');
	exit;
	}}else{
		$_SESSION['review_msg'] = base64_encode("Invalid security code.");
		header('location:'.HTACCESS_URL.'review-us/');
		exit;
		}
}

?>