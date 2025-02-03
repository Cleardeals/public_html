<?php
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.smsgateway.center/SMSApi/rest/send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "userId=mrwebsolutions&password=Datta$5959$&mobile=918770752151&msg=Hello+World%21+This+is+a+test+message%21&senderId=CDEALS&dltEntityId=1201159281703332820&dltTemplateId=1207162132311696704&msgType=text&duplicateCheck=true&format=json&sendMethod=simpleMsg",
  CURLOPT_HTTPHEADER => array(
    "apikey: somerandomuniquekey",
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