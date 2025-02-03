<?php
$rndno=rand(1000, 9999);
/*if($rndno == $_SESSION['sign_up']['otp']){
	// generate otp
	$rndno1=rand(10000, 99999);
	echo $otp = $rndno1;
}else{
	echo $otp = $rndno;
}*/

$otp = $rndno;
$message = '"'.$otp.'" is the OTP of your mobile number verification to register your account.\n
Thanks and Regards\n CDEALS ';
$mobile = '91'.$_REQUEST['pop_mobile_no'];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.smsgateway.center/SMSApi/rest/send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "userId=mrwebsolutions&password=Datta$5959$&senderId=CDEALS&sendMethod=simpleMsg&msgType=text&mobile=$mobile&msg=".$message."&duplicateCheck=true&dltEntityId=1201159281703332820&dltTemplateId=1207162132343743807&format=json",
  CURLOPT_HTTPHEADER => array(
    "apikey: ".mt_rand(10,100),
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
?>