<?php
$mobnumber = "8770752151,9617839338";
$smsmsg =  "Congratulations! We have a new property matching your requirements. ".$link." Call us on 9723992255 for site visit. ClearDeals, No Brokerage!";

$curl = curl_init();

curl_setopt_array($curl, array(

  CURLOPT_URL => "https://www.smsgateway.center/SMSApi/rest/send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "userId=mrwebsolutions&password=Datta$5959$&group=$mobnumber&msg=$smsmsg&senderId=CDEALS&msgType=text&duplicateCheck=true&format=json&sendMethod=groupMsg",
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