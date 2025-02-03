<?php
/*ob_start();// turn on output buffering
session_start();//start new or resume existing session
require_once('config.php');// inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php');// to use database function
include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query
include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
require_once(PHP_FUNCTION_DIR.'function.image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'resize_image.php'); // file to resize image
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail 
$dbObj = new DBConnection(); // database connection object*/
//$lastId = '23';
//enquiry@cleardeals.co.in
$dbObj->dbQuery="select * from ".PREFIX."user_property_detail where id='".$lastId."'";
$dbPropDetail = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$dbPropDetail[0]['user_id']."' order by id desc";
$dbUser = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."state where id='".$dbUser[0]['state']."'";
$dbState = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."state where id='".$dbPropDetail[0]['state']."'";
$dbPropState = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."adminuser where id='1'"; 
$dbAdminEmail = $dbObj->SelectQuery();

//--------------------- mail send to user ----------------------------

	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Your Billing Detail";
	$mail->AddAddress($dbUser[0]['email'],$dbUser[0]['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '';
	$body ='<table width="100%" border="0" style=" border-collapse:collapse; margin:0; padding:0">
  <tr>
    <td scope="col" align="center">
	<table border="0" cellspacing="0" cellpadding="5" width="800" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; border:1px solid #cccccc; border-collapse:collapse">
        <tr>
          <td width="494"></td>
        </tr>
        <tr style="background:#fff">
          <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png" width="150"></td>
        </tr>
        <tr>
          <td><hr style="opacity:0.3;" /></td>
        </tr>
        <tr>
          <td align="center"><strong style="font-size:17px">
		  Date : '.date("F j, Y", strtotime(date("Y-m-d"))).'</strong></td>
        </tr>
        <tr>
          <td style="background:#EEEEEE; padding:10px 0" align="center">
		  <font style="font-family:Arial, Helvetica, sans-serif; font-size:17px"><strong>
		  Order No: # '.$orderId.'</strong><br /></font></td>
        </tr>';
        
        $body.='
        <tr>
          <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
              <tr>
                <td valign="top"><p style="font-size:13px; margin-bottom:10px; margin-top:0; padding-left:5px;">
				<font style="font-family:Arial, Helvetica, sans-serif; font-size:15px"></font></p>
                  <table border="0" cellspacing="0" cellpadding="0" width="300">
                    <tr>
                      <td valign="top"><table border="0" cellspacing="0" cellpadding="5" width="100%">
                          <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">
							'.ucfirst($dbUser[0]['name']).'</font></td>
                          </tr>
                          <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">
							'.$dbState[0]['state_name'].'</font>
                          </tr>
						  <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">
							'.$dbUser[0]['city'].',</font>
                          </tr>
						   <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">
							'.$dbUser[0]['address'].'</font>
                          </tr>
                          <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> 
							'.$dbUser[0]['mobile_no'].' </font></td>
                          </tr>
                          <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> 
							'.$dbUser[0]['email'].' </font></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>';
                
                $body.='</tr>
            </table></td>
        </tr>';
        
        $body.='
        <tr>
          <td><table border="0" cellspacing="0" cellpadding="10" width="100%">
              <tr>
                <th align="left" width="20%" style="border:solid 1px #b3b3b3; border-right:none; padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>Property Name</strong></font></th>
                <th align="left"  width="10%" style="border:solid 1px #b3b3b3; border-right:none;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>For Property</strong></font></th>
                <th align="left" width="10%" style="border:solid 1px #b3b3b3; border-right:none;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>Property Type</strong></font></th>
                <th align="left" width="10%" style="border:solid 1px #b3b3b3; border-right:none;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>No. of<br />Bedroom</strong></font></th>
				
                <th align="left" width="10%"style="border:solid 1px #b3b3b3;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>No. of<br /> Bathrooms</strong></font></th>
				 <th align="left" width="10%"style="border:solid 1px #b3b3b3;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>State</strong></font></th>
				  <th align="left" width="10%"style="border:solid 1px #b3b3b3;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>City</strong></font></th>
				  <th align="left" width="10%"style="border:solid 1px #b3b3b3;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>Validity</strong></font></th>
				  <th align="left" width="10%"style="border:solid 1px #b3b3b3;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>Amount</strong></font></th>
              </tr>';
			  
              
	  $body.='<tr>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['property_name'].'</font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['for_property'].'</font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> '.$dbPropDetail[0]['property_type'].' </font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> '.$dbPropDetail[0]['no_of_bedrooms'].' </font></td>
				
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['no_of_bathrooms'].'</font></td>
				 <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropState[0]['state_name'].'</font></td>
				  <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['city'].'</font></td>
				  <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['validity'].'</font></td>
				  <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['amount'].'/-</font></td>
              </tr>';
             
              $body.='
              <tr>
                <td colspan="8" align="right" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>CGST</strong>&nbsp; </font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3;border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> 0.00 </font></td>
              </tr>
			   <tr>
                <td colspan="8" align="right" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>SGST</strong>&nbsp; </font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3;border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> 0.00 </font></td>
              </tr>
			   <tr>
                <td colspan="8" align="right" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>Total</strong>&nbsp; </font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3;border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> '.$dbPropDetail[0]['amount'].'/- </font></td>
              </tr>
            </table>
			</td>
        </tr>
        <tr>
          <td valign="top" height="4"></td>
        </tr>
      </table>
	  </td>
  </tr>
</table>';

	//echo $body;// exit;
	//$mail->Body .= $body;//exit;
	$mail->MsgHTML($body);
	//$mail->Body .= $body;
	$mail->Send();
	$mail->ClearAllRecipients();

	//-------------------------------- mail send to admin ---------------------

	
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "".$dbUser[0]['name']." Billing Detail";
	$mail->AddAddress($dbAdminEmail[0]['email'],"Cleardeals");
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '';
	$body ='<table width="100%" border="0" style=" border-collapse:collapse; margin:0; padding:0">
  <tr>
    <td scope="col" align="center">
	<table border="0" cellspacing="0" cellpadding="5" width="800" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; border:1px solid #cccccc; border-collapse:collapse">
        <tr>
          <td width="494"></td>
        </tr>
        <tr style="background:#fff">
          <td align="center"><img src="'.HTACCESS_URL.'assets/img/logo.png" width="150"></td>
        </tr>
        <tr>
          <td><hr style="opacity:0.3;" /></td>
        </tr>
        <tr>
          <td align="center"><strong style="font-size:17px">
		  Date : '.date("F j, Y", strtotime(date("Y-m-d"))).'</strong></td>
        </tr>
        <tr>
          <td style="background:#EEEEEE; padding:10px 0" align="center">
		  <font style="font-family:Arial, Helvetica, sans-serif; font-size:17px"><strong>
		  Order No: # '.$orderId.'</strong><br /></font></td>
        </tr>';
        
        $body.='
        <tr>
          <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
              <tr>
                <td valign="top"><p style="font-size:13px; margin-bottom:10px; margin-top:0; padding-left:5px;">
				<font style="font-family:Arial, Helvetica, sans-serif; font-size:15px"></font></p>
                  <table border="0" cellspacing="0" cellpadding="0" width="300">
                    <tr>
                      <td valign="top"><table border="0" cellspacing="0" cellpadding="5" width="100%">
                          <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">
							'.ucfirst($dbUser[0]['name']).'</font></td>
                          </tr>
                          <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">
							'.$dbState[0]['state_name'].'</font>
                          </tr>
						  <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">
							'.$dbUser[0]['city'].',</font>
                          </tr>
						   <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">
							'.$dbUser[0]['address'].'</font>
                          </tr>
                          <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> 
							'.$dbUser[0]['mobile_no'].' </font></td>
                          </tr>
                          <tr>
                            <td align="left" bgcolor="#FFFFFF">
							<font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> 
							'.$dbUser[0]['email'].' </font></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>';
                
                $body.='</tr>
            </table></td>
        </tr>';
        
        $body.='
        <tr>
          <td><table border="0" cellspacing="0" cellpadding="10" width="100%">
              <tr>
                <th align="left" width="20%" style="border:solid 1px #b3b3b3; border-right:none; padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>Property Name</strong></font></th>
                <th align="left"  width="10%" style="border:solid 1px #b3b3b3; border-right:none;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>For Property</strong></font></th>
                <th align="left" width="10%" style="border:solid 1px #b3b3b3; border-right:none;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>Property Type</strong></font></th>
                <th align="left" width="10%" style="border:solid 1px #b3b3b3; border-right:none;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>No. of<br />Bedroom</strong></font></th>
				
                <th align="left" width="10%"style="border:solid 1px #b3b3b3;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>No. of<br /> Bathrooms</strong></font></th>
				 <th align="left" width="10%"style="border:solid 1px #b3b3b3;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>State</strong></font></th>
				  <th align="left" width="10%"style="border:solid 1px #b3b3b3;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>City</strong></font></th>
				  <th align="left" width="10%"style="border:solid 1px #b3b3b3;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>Validity</strong></font></th>
				  <th align="left" width="10%"style="border:solid 1px #b3b3b3;padding:7px; background:#eeeeee"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>Amount</strong></font></th>
              </tr>';
			  
              
	  $body.='<tr>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['property_name'].'</font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['for_property'].'</font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> '.$dbPropDetail[0]['property_type'].' </font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> '.$dbPropDetail[0]['no_of_bedrooms'].' </font></td>
				
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['no_of_bathrooms'].'</font></td>
				 <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropState[0]['state_name'].'</font></td>
				  <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['city'].'</font></td>
				  <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['validity'].'</font></td>
				  <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">'.$dbPropDetail[0]['amount'].'/-</font></td>
              </tr>';
             
              $body.='
              <tr>
                <td colspan="8" align="right" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>CGST</strong>&nbsp; </font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3;border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> 0.00 </font></td>
              </tr>
			   <tr>
                <td colspan="8" align="right" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>SGST</strong>&nbsp; </font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3;border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> 0.00 </font></td>
              </tr>
			   <tr>
                <td colspan="8" align="right" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3; border-right:none; border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"><strong>Total</strong>&nbsp; </font></td>
                <td align="left" bgcolor="#FFFFFF" style="border:solid 1px #b3b3b3;border-top:none;"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px"> '.$dbPropDetail[0]['amount'].'/- </font></td>
              </tr>
            </table>
			</td>
        </tr>
        <tr>
          <td valign="top" height="4"></td>
        </tr>
      </table>
	  </td>
  </tr>
</table>';

	//echo $body;//exit;
	//echo $mail->Body .= $body;exit;
	$mail->MsgHTML($body);
	//$mail->Body .= $body;
	/*if($mail->Send) {
			echo "success";
		} else {
			echo "fail";
		}*/
	$mail->Send();
	$mail->ClearAllRecipients();


?>