<?php 
ob_start();// turn on output buffering
session_start();//start new or resume existing session
require_once('config.php');// inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php');// to use database function
include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query
include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
//require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail 
$dbObj = new DBConnection(); // database connection object

$info = $_REQUEST['info']; // data array sent from form
$mode = $_REQUEST['mode'] ?? ""; 
$id = $_REQUEST['id'] ?? "";
$from = $_REQUEST['from'] ?? "";

//to get admin's email id
$dbObj->dbQuery = "SELECT * FROM ".PREFIX."adminuser where id='1'";
$dbAdmin = $dbObj->SelectQuery();
//echo $dbAdmin[0]['email'];exit;
	
//step 1
if($mode=="step_1") {
 	 $_SESSION['prop']['city'] = $dbObj->sc_mysql_escape($info['city']);
	 $_SESSION['prop']['location'] = $dbObj->sc_mysql_escape($info['location']);
	 $_SESSION['prop']['property_type'] = $dbObj->sc_mysql_escape($info['property_type']);
	 $_SESSION['prop']['area'] = $dbObj->sc_mysql_escape($info['area']);
	 $_SESSION['prop']['sqf'] = $dbObj->sc_mysql_escape($info['sqf']);//exit;
	
	$dbObj->dbQuery="select * from ".PREFIX."location where location='".$_SESSION['property']['location']."'";
	$dbLocation = $dbObj->SelectQuery();
	
	/*if(count((array)$dbPricelist)>0){
		//echo '11111';
		header("location:".HTACCESS_URL."user-detail/");
		//exit;
		}else{*/
			
			//echo '222';
			//$_SESSION['location_error_msg'] = base64_encode("Location not found. Try with a nearby location.");
	       // header("location:".HTACCESS_URL."".$_SESSION['property']['city']."/");
		   header("location:".HTACCESS_URL."user-detail/");
			exit;
		// header('location:index.php?mo=user-detail');
	      //}
	
}




if($mode=='checkloc'){
	//$username = $info['username'];
	//$_SESSION['register']['username'] = $info['username'];
	$tags = $dbObj->sc_mysql_escape($_REQUEST['tags']);
	
	$dbObj->dbQuery = "SELECT * FROM ".PREFIX."location WHERE  location='".$tags."'";
	$dbLocationCheck = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;exit;

	if(!empty($dbLocationCheck)){
		echo "1"; exit;
	} else
		echo "0";
	exit;
	//echo $dbObj->dbQuery;//exit;
}

if($mode=="get_otp"){
	
	$_SESSION['prop']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['MobileNo']);//exit;
	//$num = $dbObj->sc_mysql_escape($_REQUEST['itemId']);
	
	// generate otp
	$rndno=rand(1000, 9999);
	$_SESSION['prop']['otp'] = $rndno;//exit;
	include('valuationmobileAPI.php');
	
	echo $_SESSION['prop']['otp'];
	exit;
}

//step 2
/*if($mode=="step_2") {

$_SESSION['prop']['name'] = $info['name'];
$_SESSION['prop']['email'] = $info['email'];
$_SESSION['prop']['mobile_no'] = $info['mobile_no'];
$_SESSION['prop']['purpose_of_valuation'] = $info['purpose_of_valuation'];

$key=substr($_SESSION['key'],0,5);
$number = $_REQUEST['number'];

if($number==$key){
// generate otp
$rndno=rand(1000, 9999);
$_SESSION['prop']['otp'] = $rndno;//exit;
include('valuationmobileAPI.php');

header("location:".HTACCESS_URL."user-detail-otp/");
exit;	
}else{
		$_SESSION['val_captcha_msg'] = base64_encode("Invalid security code.");
		header("location:".HTACCESS_URL."user-detail/");
		exit;
		}
}*/


//step 3
if($mode=="step_3") {
	
	$_SESSION['prop']['name'] = $dbObj->sc_mysql_escape($info['name']);
	$_SESSION['prop']['email'] = $dbObj->sc_mysql_escape($info['email']);
	$_SESSION['prop']['mobile_no'] = $dbObj->sc_mysql_escape($info['mobile_no']);
	$_SESSION['prop']['purpose_of_valuation'] = $dbObj->sc_mysql_escape($info['purpose_of_valuation']);
	$info['date'] = date('Y-m-d, H:i:s');
	
	$key=substr($_SESSION['key'],0,5);
	$number = $dbObj->sc_mysql_escape($_REQUEST['number'] ?? "");
	
	if($_SESSION['prop']['otp']==$_REQUEST['val_otp']){
		if(!empty($info['city']) && !empty($info['location']) && !empty($info['property_type']) && !empty($info['area']) && !empty($info['sqf']) && !empty($info['name']) && !empty($info['email']) && !empty($info['mobile_no']) && !empty($info['purpose_of_valuation'])){
	
	$dbObj->dbQuery="select * from ".PREFIX."location where location='".$_SESSION['prop']['location']."'";
	$dbPricelist = $dbObj->SelectQuery();

	// square fit calculation
	$minPrice_sq = $_SESSION['prop']['area'] * $dbPricelist[0]['price_min_sq'];
	$maxPrice_sq = $_SESSION['prop']['area'] * $dbPricelist[0]['price_max_sq'];

	// square fit yard calculation
	$minPrice_sq_yard = $_SESSION['prop']['area'] * $dbPricelist[0]['price_min_sq_yrd'];
	$maxPrice_sq_yard = $_SESSION['prop']['area'] * $dbPricelist[0]['price_max_sq_yrd'];
	
	
	function count_digit($number) {
  return strlen($number);
}

function divider($number_of_digits) {
    $tens="1";

  if($number_of_digits>8)
    return 10000000;

  while(($number_of_digits-1)>0)
  {
    $tens.="0";
    $number_of_digits--;
  }
  return $tens;
}
if($_SESSION['prop']['sqf']==1){
//function call min square fit
$num = $minPrice_sq;
$ext="";//thousand,lac, crore
$number_of_digits = count_digit($num); //this is call :)
    if($number_of_digits>3)
{
    if($number_of_digits%2!=0)
        $divider=divider($number_of_digits-1);
    else
        $divider=divider($number_of_digits);
}
else
    $divider=1;

$fraction=$num/$divider;
$fraction=number_format($fraction,2);
if($number_of_digits==4 ||$number_of_digits==5)
    $ext1="k";
if($number_of_digits==6 ||$number_of_digits==7)
    $ext1="Lac";
if($number_of_digits==8 ||$number_of_digits==9)
    $ext1="Cr";
echo $info['est_min_value'] = $fraction." ".$ext1;
}else{
//function call min square fit yard

$num2 = $minPrice_sq_yard;
$ext="";//thousand,lac, crore
$number_of_digits = count_digit($num2); //this is call :)
    if($number_of_digits>3)
{
    if($number_of_digits%2!=0)
        $divider=divider($number_of_digits-1);
    else
        $divider=divider($number_of_digits);
}
else
    $divider=1;

$fraction2=$num2/$divider;
$fraction2=number_format($fraction2,2);
if($number_of_digits==4 ||$number_of_digits==5)
    $ext="k";
if($number_of_digits==6 ||$number_of_digits==7)
    $ext="Lac";
if($number_of_digits==8 ||$number_of_digits==9)
    $ext="Cr";
echo $info['est_min_value'] = $fraction2." ".$ext;

}

 if($_SESSION['prop']['sqf']==1){
//function call max square fit
$num1 = $maxPrice_sq;
$ext="";//thousand,lac, crore
$number_of_digits = count_digit($num1); //this is call :)
    if($number_of_digits>3)
{
    if($number_of_digits%2!=0)
        $divider=divider($number_of_digits-1);
    else
        $divider=divider($number_of_digits);
}
else
    $divider=1;

$fraction1=$num1/$divider;
echo $fraction1=number_format($fraction1,2);
if($number_of_digits==4 ||$number_of_digits==5)
    $ext="k";
if($number_of_digits==6 ||$number_of_digits==7)
    $ext="Lac";
if($number_of_digits==8 ||$number_of_digits==9)
    $ext="Cr";
echo $info['est_max_value'] = $fraction1." ".$ext;
 
 }else{
//function call max square fit yard
$num3 = $maxPrice_sq_yard;
$ext="";//thousand,lac, crore
$number_of_digits = count_digit($num3); //this is call :)
    if($number_of_digits>3)
{
    if($number_of_digits%2!=0)
        $divider=divider($number_of_digits-1);
    else
        $divider=divider($number_of_digits);
}
else
    $divider=1;

$fraction3=$num3/$divider;
//echo $fraction3;
//echo $fraction3=number_format($fraction3,2);
if($number_of_digits==4 ||$number_of_digits==5)
    $ext="k";
if($number_of_digits==6 ||$number_of_digits==7)
    $ext="Lac";
if($number_of_digits==8 ||$number_of_digits==9)
    $ext="Cr";
echo $info['est_max_value'] = $fraction3." ".$ext;
 }
//exit;
	$info['date'] = date('Y-m-d');
$insert_id = add_record($dbObj,PREFIX.'valuation',$info);
//echo $dbObj->dbQuery;exit;

$_SESSION['last_id'] = $insert_id;

$dbObj->dbQuery="select * from ".PREFIX."valuation where id='".$_SESSION['last_id']."'";
$dbUserDetail = $dbObj->SelectQuery();

$estminval = explode(' ',$dbUserDetail[0]['est_min_value']);
$estminval1 = $estminval[0];
$estminval2 = $estminval[1];

if($estminval2=="k"){
echo	$estmin = $estminval1 * 1000;
echo '<br/>';
}elseif($estminval2=="Lac"){
echo	$estmin = $estminval1 * 100000;
echo '<br/>';
}elseif($estminval2=="Cr"){
echo	$estmin = $estminval1 * 10000000; 
echo '<br/>';
}

$estmaxval = explode(' ',$dbUserDetail[0]['est_max_value']);
$estmaxval1 = $estmaxval[0];
$estmaxval2 = $estmaxval[1];

if($estmaxval2=="k"){
echo	$estmax = $estmaxval1 * 1000;
echo '<br/>';
}elseif($estmaxval2=="Lac"){
echo	$estmax = $estmaxval1 * 100000;
echo '<br/>';
}elseif($estmaxval2=="Cr"){
echo	$estmax = $estmaxval1 * 10000000; 
echo '<br/>';
}


$average_add =	$estmin+$estmax;

echo $average = $average_add/2;
	
$nums = $average;
$ext="";//thousand,lac, crore
$number_of_digits = count_digit($nums); //this is call :)
    if($number_of_digits>3)
{
    if($number_of_digits%2!=0)
        $divider=divider($number_of_digits-1);
    else
        $divider=divider($number_of_digits);
}
else
    $divider=1;

$fractions=$nums/$divider;
$fractions=number_format($fractions,2);
if($number_of_digits==4 ||$number_of_digits==5)
    $ext="k";
if($number_of_digits==6 ||$number_of_digits==7)
    $ext="Lac";
if($number_of_digits==8 ||$number_of_digits==9)
    $ext="Cr";
echo $estimatedval = $fractions." ".$ext;

	
		//--------------------------------------------- mail send to user ----------------------------------------
	
	$mail = new PHPMailer();
	$mail->Priority = 3; // COPY
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals.co.in";			
	$mail->Subject = "Cleardeals Instant Free Valuation";
	$mail->AddAddress($dbUserDetail[0]['email'],$dbUserDetail[0]['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	
	$body ='<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#d00243;font-size:25px;font-family:Arial,Helvetica,sans-serif"> Hi '.$info['name'].',</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px">Thanks for using our instant valuation tool. Here is the<br>
      estimated value of Your Property:</td>
  </tr>
  <tr>
    <td align="center" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px"><table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr style="background:#d00243" bgcolor="#d00243">
          <td height="40" style="color:#fff;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;font-weight:bold">Average estimate:</td>
          <td align="right" style="color:#fff;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;font-weight:bold">INR '.$estimatedval.' </td>
        </tr>
        <tr style="background:#f2f2f2" bgcolor="#f2f2f2">
          <td height="40" width="50%" style="color:#000;font-size:17px;font-family:Arial,Helvetica, sans-serif;line-height:29px;border-top:solid 2px #fff">Lowest estimate:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">INR '.$dbUserDetail[0]['est_min_value'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">Highest estimate:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">INR '.$dbUserDetail[0]['est_max_value'].'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#000;font-size:14px;font-family:Arial,Helvetica,sans-serif; line-height:29px">An online valuation is a great place to start, but every property is unique.</td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#000;font-size:14px;font-family:Arial,Helvetica,sans-serif; line-height:29px">When you are ready to get an accurate picture of what your homes really worth, your Cleardeals local property executive would be happy to provide you with a free, 
      no-strings-attached valuation.</td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#000;font-size:14px;font-family:Arial,Helvetica,sans-serif; line-height:29px">Just let us know a time that suits you.</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p style="color:#000;font-size:14px;font-family:Arial,Helvetica,sans-serif; line-height:29px;margin:0;padding:0">Speak soon,</p>
      <p style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:20px; margin:0;padding:0"><b> Powered by Cleardeals.co.in </b> </font> </td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
  <tr >
    <td >&nbsp;</td>
  </tr>
  <tr >
    <td >&nbsp;</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px">&nbsp;</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px"><span style="font-size:18px;font-weight:bold;margin:0;padding:0;"> <span>Powered by Cleardeals.co.in</span></span></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" height="7"></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px"><p style="margin:0;padding:0;font-size:15px;font-style:italic"> (+91) 9723992226, <a href="contact@cleardeals.co.in" style="color:#fff;text-decoration:none">contact@cleardeals.co.in</a> <br>
        Copyright@2021. Cleardeals.co.in</p></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center">&nbsp;</td>
  </tr>
</table>';
			
	//echo $mail->Body .= $body;//exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	$mail->Send();
	$mail->ClearAllRecipients();
	
	//--------------------------------------------- mail send to admin ----------------------------------------
	
	$mail = new PHPMailer();
	$mail->Priority = 3; // COPY
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals.co.in";			
	$mail->Subject = "Cleardeals Instant Free Valuation";
	$mail->AddAddress($dbAdmin[0]['email'],"Admin");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#d00243;font-size:25px;font-family:Arial,Helvetica,sans-serif"> Hi Admin,</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px"><table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr style="background:#d00243" bgcolor="#d00243">
          <td height="40" style="color:#fff;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;font-weight:bold">Average estimate:</td>
          <td align="right" style="color:#fff;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;font-weight:bold">INR '.$estimatedval.' </td>
        </tr>
        <tr style="background:#f2f2f2" bgcolor="#f2f2f2">
          <td height="40" width="50%" style="color:#000;font-size:17px;font-family:Arial,Helvetica, sans-serif;line-height:29px;border-top:solid 2px #fff">Lowest estimate:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">INR '.$dbUserDetail[0]['est_min_value'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">Highest estimate:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">INR '.$dbUserDetail[0]['est_max_value'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">City:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> '.$dbUserDetail[0]['city'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">Location:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> '.$dbUserDetail[0]['location'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">Property Type:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> Flat</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">Area:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> '.$dbUserDetail[0]['area'].'&nbsp;'; 
            if($dbUserDetail[0]['sqf']==1){
            $body.= 'Sq.Feet';
            }else{
            $body .= 'Sq.Yard';
            }
            $body.='</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">Name:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> '.$dbUserDetail[0]['name'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">Email:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> '.$dbUserDetail[0]['email'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">Mobile Number:</td>
          <td  align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> '.$dbUserDetail[0]['mobile_no'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">Purpose of Valuation:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> '.$dbUserDetail[0]['purpose_of_valuation'].'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px">&nbsp;</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px"><span style="font-size:18px;font-weight:bold;margin:0;padding:0;"> <span>Powered by Cleardeals.co.in</span></span></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" height="7"></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px"><p style="margin:0;padding:0;font-size:15px;font-style:italic"> (+91) 9723992226, <a href="contact@cleardeals.co.in" style="color:#fff;text-decoration:none">contact@cleardeals.co.in</a> <br>
        Copyright@2021. Cleardeals.co.in</p></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center">&nbsp;</td>
  </tr>
</table>';
			
	//echo $mail->Body .= $body;exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	$mail->Send();
	$mail->ClearAllRecipients();
	
	include('usersmsValuation.php');
	//exit;
	}
	unset($_SESSION['prop']);
	header("location:".HTACCESS_URL."thank-you-for-valuation/");
	exit;
	}else{
		$_SESSION['val_captcha_msg'] = base64_encode("Invalid otp.");
		header("location:".HTACCESS_URL."user-detail/");
		exit;
	}
	 
}


if($mode=='checkcap'){
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$info['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$info['purpose_of_valuation'] = $dbObj->sc_mysql_escape($_REQUEST['purpose_of_valuation']);
	$info['app_date'] = date('Y-m-d H:i:s',strtotime($dbObj->sc_mysql_escape($_REQUEST['app_date'])));
	$info['current_date'] = date('Y-m-d');
	$key=substr($_SESSION['key'],0,5);
    $number = $dbObj->sc_mysql_escape($_REQUEST['number'] ?? "");
	
	if($number==$key){
		
	if(!empty($_REQUEST['name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['mobile_no']) && !empty($_REQUEST['purpose_of_valuation']) && !empty($_REQUEST['app_date'])){
	add_record($dbObj,PREFIX.'appointment',$info);
	//echo $dbObj->dbQuery;//exit;
	
	include('usersmsHomeVilla.php');
	
	include('adminHomeVillasms.php');
		
	//--------------------------------- mail send to user ----------------------------------------
	
	$mail = new PHPMailer();
	$mail->Priority = 3; // COPY
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals.co.in";			
	$mail->Subject = "Cleardeals Home/Villas/Bunglows";
	$mail->AddAddress($_REQUEST['email'],$_REQUEST['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	
	$body = '<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#d00243;font-size:25px;font-family:Arial,Helvetica,sans-serif">
	Hi '.$_REQUEST['name'].',</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	Your Cleardeals Home/Villas/Bunglows details as follows :</td>
  </tr>
  <tr>
    <td align="center" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	&nbsp;</td>
  </tr>
  <tr>
    <td align="center" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	<table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr style="background:#d00243" bgcolor="#d00243">
          <td height="40" style="color:#fff;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px; font-weight:bold">Name:</td>
          <td align="right" style="color:#fff;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;font-weight:bold">'.$_REQUEST['name'].'</td>
        </tr>
        <tr style="background:#f2f2f2" bgcolor="#f2f2f2">
          <td height="40" width="50%" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;  border-top: solid 2px #fff">Email:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">'.$_REQUEST['email'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Mobile Number:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">'.$_REQUEST['mobile_no'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Purpose of Valuation:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">'.$_REQUEST['purpose_of_valuation'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Appointment Date/Time:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">'.$_REQUEST['app_date'].'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p style="color:#000;font-size:14px;font-family:Arial,Helvetica,sans-serif;line-height:29px; margin:0;padding:0">Kind Regards,</p>
      <p style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:20px;margin:0; padding:0"><b>Powered by Cleardeals.co.in </b> </font> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px">&nbsp;</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	<span style="font-size:18px;font-weight:bold;margin:0;padding:0;"><span>Cleardeals.co.in</span></span>
	</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" height="7"></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	<p style="margin:0;padding:0;font-size:15px;font-style:italic"> (+91) 9723992226, 
	<a href="contact@cleardeals.co.in" style="color:#fff;text-decoration:none">contact@cleardeals.co.in</a><br>
        Copyright@2021. Cleardeals.co.in</p></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center">&nbsp;</td>
  </tr>
</table>';
		
	//echo $mail->Body .= $body;//exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	$mail->Send();
	$mail->ClearAllRecipients();
	
	//--------------------------------------------- mail send to admin ----------------------------------------
	
	$mail = new PHPMailer();
	$mail->Priority = 3; // COPY
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals.co.in";
	$mail->Subject = "Cleardeals Home/Villas/Bunglows";
	$mail->AddAddress($dbAdmin[0]['email'],"Admin");
	//epropvalue@gmail.com
	$mail->Body = "";
	$mail->AltBody = "";
	
	$body ='<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#d00243;font-size:25px;font-family:Arial,Helvetica,sans-serif">Hi Admin,</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	'.ucwords($_REQUEST['name']).' has Home/Villas/Bunglows Cleardeals.</td>
  </tr>
  <tr>
    <td align="left" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	<b>User details are as follows:</b></td>
  </tr>
  <tr>
    <td align="center" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	&nbsp;</td>
  </tr>
  <tr>
    <td align="center" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	<table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr style="background:#d00243" bgcolor="#d00243">
          <td height="40" style="color:#fff;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px; font-weight:bold">Name:</td>
          <td align="right" style="color:#fff;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;font-weight:bold"> '.ucwords($_REQUEST['name']).'</td>
        </tr>
        <tr style="background:#f2f2f2" bgcolor="#f2f2f2">
          <td height="40" width="50%" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">Email:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">'.$_REQUEST['email'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Mobile Number:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">'.$_REQUEST['mobile_no'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Purpose of Valuation:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">'.$_REQUEST['purpose_of_valuation'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Appointment date & time:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">'.$_REQUEST['app_date'].'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px">&nbsp;</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	<span style="font-size:18px;font-weight:bold;margin:0;padding:0;"><span>Cleardeals.co.in</span></span>
	</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" height="7"></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	<p style="margin:0;padding:0;font-size:15px;font-style:italic"> (+91) 9723992226, 
	<a href="contact@cleardeals.co.in" style="color:#fff;text-decoration:none">contact@cleardeals.co.in</a><br>
        Copyright@2021. Cleardeals</p></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center">&nbsp;</td>
  </tr>
</table>';
			
	//echo $mail->Body .= $body;exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	$mail->Send();
	$mail->ClearAllRecipients();
	
	//unset($_SESSION['property']);
	header("location:".HTACCESS_URL."thankyou-app/");
		echo 0;
		exit;
	}} else{
			$_SESSION['captcha_msg'] = base64_encode("Invalid security code.");
		echo 1;
		exit;
	}
}

//mode to add time
if($mode=="add_time") {
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	
	$dbObj->dbQuery="select * from ".PREFIX."valuation where id='".$_SESSION['last_id']."'";
	$dbUser = $dbObj->SelectQuery();
	
	if(!empty($_REQUEST['p_date_time'])){
	
	$datetime = $dbObj->sc_mysql_escape($_REQUEST['p_date_time']);
	$info['p_date_time'] = $datetime;
	$info['current'] = date('Y-m-d');
	add_record($dbObj,PREFIX.'date_time',$info);
	//echo $dbObj->dbQuery;//exit;
	
	
	include('usersmsAppointment.php');
	
	include('adminAppointmentsms.php');
	
	//--------------------------------------------- mail send to user ----------------------------------------
	
	$mail = new PHPMailer();
	$mail->Priority = 3; // COPY
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals.co.in";			
	$mail->Subject = "Cleardeals Personal Appointment";
	$mail->AddAddress($dbUser[0]['email'],$dbUser[0]['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	
	$body ='<table border="0" cellspacing="0" cellpadding="5" width="100%">
  <tr>
    <td colspan="2" align="left" style="color:#000;font-size:14px;font-family:Arial,Helvetica,sans-serif; line-height:29px"><b>Hello '.ucwords($dbUser[0]['name']).',</b></font></td>
  </tr>
  <tr>
    <td align="left" style="color:#000;font-size:14px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	Thank You for giving us an opportunity to meet you and discuss about your property valuation. Our Cleardeals Local Property Expert will contact you soon. </font>
      </p>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><p style="color:#000;font-size:18px;font-family:Arial,Helvetica,sans-serif;margin:0; padding:0;font-weight:bold;line-height:20px;">Thanking You,<br />
            </p>
            <p style="color:#000; font-size:14px;font-family:Arial,Helvetica,sans-serif;margin:0;padding:0; line-height:29px;"> For,</p>
            <p style="color:#000;font-size:14px;font-family:Arial,Helvetica,sans-serif;line-height:20px;margin:0; padding:0">Cleardeals.co.in</p>
            <p style="color:#000;font-size:14px;font-family:Arial,Helvetica,sans-serif;margin:0;padding:0; line-height:20px;">Mobile: 9723992200 <br />
              <a href="contact@cleardeals.co.in">contact@cleardeals.co.in</a></p></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="left"><a href="http://cleardeals.co.in">
		  <img src="'.HTACCESS_URL.'assets/img/book-now.jpg" style="border:0"></a></td>
        </tr>
      </table></td>
  </tr>
</table>';
			
	//echo $mail->Body .= $body;//exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	$mail->Send();
	$mail->ClearAllRecipients();
	
	//--------------------------------------------- mail send to admin ----------------------------------------
	
	$mail = new PHPMailer();
	$mail->Priority = 3; // COPY
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals.co.in";			
	$mail->Subject = "Cleardeals Personal Appointment";
	$mail->AddAddress($dbAdmin[0]['email'],"Admin");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#d00243;font-size:25px;font-family:Arial,Helvetica,sans-serif">Hi Admin,</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	'.ucwords($dbUser[0]['name']).' has Personal Appointment Cleardeals.</td>
  </tr>
  <tr>
    <td align="left" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	<b>User details are as follows:</b></td>
  </tr>
  <tr>
    <td align="center" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	&nbsp;</td>
  </tr>
  <tr>
    <td align="center" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	<table width="100%" border="0" cellspacing="0" cellpadding="10">
        <tr style="background:#d00243" bgcolor="#d00243">
          <td height="40" style="color:#fff;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px; font-weight:bold">Name:</td>
          <td align="right" style="color:#fff;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;font-weight:bold"> '.ucwords($dbUser[0]['name']).'</td>
        </tr>
        <tr style="background:#f2f2f2" bgcolor="#f2f2f2">
          <td height="40" width="50%" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">Email:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">'.$dbUser[0]['email'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Mobile Number:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">'.$dbUser[0]['mobile_no'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Location area of your property:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> '.$dbUser[0]['location'].'</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Property Type:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> Flat</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Area :</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> '.$dbUser[0]['area'].'&nbsp;';
            if($dbUser[0]['sqf']==1){
            $body.=' sq.Feet';
            }else{
            $body.=' sq.Yard';
            }
            $body.='</td>
        </tr>
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Estimated Value of your Property:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff"> '.$dbUser[0]['est_min_value'].' - '.$dbUser[0]['est_max_value'].'; </td>
        </tr>
        ';
        $datef = $datetime;
        $app_dates = explode(" ",$datef);
        $date = $app_dates[0];
        $time = $app_dates[1];
        $dates = date('d/m/Y',strtotime($date));
        $body.='
        <tr style="background:#f2f2f2;" bgcolor="#f2f2f2">
          <td height="40" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif;line-height:29px;  border-top:solid 2px #fff">Appointment date & time:</td>
          <td align="right" style="color:#000;font-size:17px;font-family:Arial,Helvetica,sans-serif; line-height:29px;border-top:solid 2px #fff">'.$dates.' '.$time.'</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px">&nbsp;</td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	<span style="font-size:18px;font-weight:bold;margin:0;padding:0;"> <span>Cleardeals.co.in</span></span></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" height="7"></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center" style="color:#fff;font-family:Arial,Helvetica,sans-serif;line-height:29px">
	<p style="margin:0;padding:0;font-size:15px;font-style:italic"> (+91) 9723992226, 
	<a href="contact@cleardeals.co.in" style="color:#fff;text-decoration:none">contact@cleardeals.co.in</a><br>
        Copyright@2021. Cleardeals</p></td>
  </tr>
  <tr bgcolor="#000000" style="background:#000000">
    <td align="center">&nbsp;</td>
  </tr>
</table>';
			
	//echo $mail->Body .= $body;exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	$mail->Send();
	$mail->ClearAllRecipients();
	
	//unset($_SESSION['property']);
	header("location:".HTACCESS_URL."thank-you-for-valuation/#thank-you-popup");
	//echo 1;
	exit;
	}
	
}
?>