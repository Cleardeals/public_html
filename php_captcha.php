<?php
session_start();

$RandomStr = 12345;// md5 to generate the random string

$ResultStr = '12345';//trim 5 digit 

$NewImage =imagecreatefromjpeg("img3.jpg");//image create by existing image and as back ground 

$LineColor = imagecolorallocate($NewImage,227,227,227);//line color 
$TextColor = imagecolorallocate($NewImage, 14, 14, 14);//text color-white

imageline($NewImage,1,1,40,40,$LineColor);//create line 1 on image 
imageline($NewImage,1,100,60,0,$LineColor);//create line 2 on image 

imagestring($NewImage, 5, 20, 10, $ResultStr, $TextColor);// Draw a random string horizontally 

$_SESSION['key'] = $ResultStr;// carry the data through session

header("Content-Type: image/jpeg");// out out the image 

imagejpeg($NewImage);//Output image to browser 

?>
