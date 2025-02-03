<?php
ob_start();// turn on output buffering
session_start();//start new or resume existing session
require_once('config.php');// inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php');// to use database function
require_once(PHP_FUNCTION_DIR.'function.image.php');
include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query
include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
require_once(PHP_FUNCTION_DIR.'class.phpmailer.php');// to send mail 
$dbObj = new DBConnection();// database connection object

$page = $_REQUEST['page'] ?? ""; // paging variable
$set = $_REQUEST['set'] ?? ""; // paging variable
$mode = $_REQUEST['mode'] ?? ""; // action to perform
$id = $_REQUEST['id'] ?? "";

//to get contact details
$dbObj->dbQuery="select * from ".PREFIX."adminuser where id='1'"; // to fetch selected id's data
$dbAdmin = $dbObj->SelectQuery();

//mode to get city
if($mode=="getcity"){

	$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID']);

	//to get sub categories
	$dbObj->dbQuery="select * from ".PREFIX."city where state_id='".$stateID."' order by display_order"; // for listing of records
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


if($mode=="getcity1"){

	$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID']);

	//to get sub categories
	$dbObj->dbQuery="select * from ".PREFIX."city where state_id='".$stateID."' order by display_order"; // for listing of records
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


// mode to get location
if($mode=="getlocation"){

	$cityID = $dbObj->sc_mysql_escape($_REQUEST['cityID']);

	//to get sub categories
	$dbObj->dbQuery="select * from ".PREFIX."location where city='".$cityID."'"; // for listing of records
	$dblocation = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;
	//print_r($dblocation);exit;

	$data='<optgroup label="'.$cityID.'">';
	for($i=0;$i<count((array)$dblocation);$i++){
		if(!empty($cityID) && ($dblocation[$i]['location']==$cityID)){
		$data.='<option value="'.$dblocation[$i]['location'].'" selected>'.$dblocation[$i]['location'].'</option>';
		} else{
        	$data.='<option value="'.$dblocation[$i]['location'].'">'.$dblocation[$i]['location'].'</option>';
		}
		$data.='</optgroup>';
    }
	echo $data;
	exit;
}


//get mode serach sell property
if($mode=="search_for_sell"){

	$state = $dbObj->sc_mysql_escape($_REQUEST['state']);
	$city = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['city']));
	$location = $_REQUEST['location'];
	$property_type = str_replace(' ', '_', $dbObj->sc_mysql_escape($_REQUEST['property_type']));
	$no_of_bedrooms = $_REQUEST['no_of_bedrooms'];
	$budget_min = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['budget_min']));
	$budget_max = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['budget_max']));

	if(!empty($location)){
	if(count($location)>1){
		for($i=0;$i<count($location);$i++){
			if(!empty($location[$i])){
			$locationnames.= "'".$location[$i]."'";
			if($i!=(count($location)-1))
			 $locationnames.= ",";
			}
		}
	} else {
		 $locationnames = "'".$location[0]."'";
	}
	}
	
	$locationname = str_replace(' ', '-', $locationnames);
	
	//echo $locationname;
	//exit;

	/*if(!empty($property_type)){
	if(count($property_type)>1){
		for($i=0;$i<count($property_type);$i++){
			if(!empty($property_type[$i])){
			 $propertyType.= "'".$property_type[$i]."'";
			if($i!=(count($property_type)-1))
				echo $propertyType.= ",";
			}
		}
	} else {
		$propertyType = "'".$property_type[0]."'";
	}
	}*/

	if(!empty($no_of_bedrooms)){
	if(count($no_of_bedrooms)>1){
		for($i=0;$i<count($no_of_bedrooms);$i++){
			if(!empty($no_of_bedrooms[$i])){
			 $bedroomss.= "'".$no_of_bedrooms[$i]."'";
			if($i!=(count($no_of_bedrooms)-1))
				 $bedroomss.= ",";
			}
		}
	} else {
		$bedroomss = "'".$no_of_bedrooms[0]."'";
	}
	}
	
	$bedrooms = str_replace(' ', '-', $bedroomss);
	

	header('Location:'.HTACCESS_URL.'search-property-thumb/&sort='.$sortval.'&state='.$state.'&city='.$city.'&locationname='.$locationname.'&property_type='.$property_type.'&bedrooms='.$bedrooms.'&budget_min='.$budget_min.'&budget_max='.$budget_max.'/');
	exit;
}


//get mode serach sell property listing
if($mode=="search_for_sell_listing"){

	$state = $dbObj->sc_mysql_escape($_REQUEST['state']);
	$city = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['city']));
	$location = $_REQUEST['location'];
	$property_type = str_replace(' ', '_', $dbObj->sc_mysql_escape($_REQUEST['property_type']));
	$no_of_bedrooms = $_REQUEST['no_of_bedrooms'];
	$budget_min = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['budget_min']));
	$budget_max = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['budget_max']));

	if(!empty($location)){
	if(count($location)>1){
		for($i=0;$i<count($location);$i++){
			if(!empty($location[$i])){
			$locationnames.= "'".$location[$i]."'";
			if($i!=(count($location)-1))
			 $locationnames.= ",";
			}
		}
	} else {
		 $locationnames = "'".$location[0]."'";
	}
	}//exit;
	
	$locationname = str_replace(' ', '-', $locationnames);

	/*if(!empty($property_type)){
	if(count($property_type)>1){
		for($i=0;$i<count($property_type);$i++){
			if(!empty($property_type[$i])){
			 $propertyType.= "'".$property_type[$i]."'";
			if($i!=(count($property_type)-1))
				echo $propertyType.= ",";
			}
		}
	} else {
		$propertyType = "'".$property_type[0]."'";
	}
	}*/

	if(!empty($no_of_bedrooms)){
	if(count($no_of_bedrooms)>1){
		for($i=0;$i<count($no_of_bedrooms);$i++){
			if(!empty($no_of_bedrooms[$i])){
			 $bedroomss.= "'".$no_of_bedrooms[$i]."'";
			if($i!=(count($no_of_bedrooms)-1))
				$bedroomss.= ",";
			}
		}
	} else {
		$bedroomss = "'".$no_of_bedrooms[0]."'";
	}
	}
	
	$bedrooms = str_replace(' ', '-', $bedroomss);

	header('Location:'.HTACCESS_URL.'search-property-list/&sort='.$sortval.'&state='.$state.'&city='.$city.'&locationname='.$locationname.'&property_type='.$property_type.'&bedrooms='.$bedrooms.'&budget_min='.$budget_min.'&budget_max='.$budget_max.'/');
	exit;
}


//get mode serach rent property
if($mode=="search_for_rent"){

	$state = $dbObj->sc_mysql_escape($_REQUEST['state']);
	$city = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['city']));
	$location = $_REQUEST['location'];
	$property_type = str_replace(' ', '_', $dbObj->sc_mysql_escape($_REQUEST['property_type']));
	$no_of_bedrooms = $_REQUEST['no_of_bedrooms'];
	$budget_min = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['budget_min']));
	$budget_max = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['budget_max']));

	if(!empty($location)){
	if(count($location)>1){
		for($i=0;$i<count($location);$i++){
			if(!empty($location[$i])){
			$locationnames.= "'".$location[$i]."'";
			if($i!=(count($location)-1))
			 $locationnames.= ",";
			}
		}
	} else {
		 $locationnames = "'".$location[0]."'";
	}
	}//exit;
	
	$locationname = str_replace(' ', '-', $locationnames);

	/*if(!empty($property_type)){
	if(count($property_type)>1){
		for($i=0;$i<count($property_type);$i++){
			if(!empty($property_type[$i])){
			 $propertyType.= "'".$property_type[$i]."'";
			if($i!=(count($property_type)-1))
		echo $propertyType.= ",";
			}
		}
	} else {
		$propertyType = "'".$property_type[0]."'";
	}
	}*/

	if(!empty($no_of_bedrooms)){
	if(count($no_of_bedrooms)>1){
		for($i=0;$i<count($no_of_bedrooms);$i++){
			if(!empty($no_of_bedrooms[$i])){
			 $bedroomss.= "'".$no_of_bedrooms[$i]."'";
			if($i!=(count($no_of_bedrooms)-1))
				 $bedroomss.= ",";
			}
		}
	} else {
		$bedroomss = "'".$no_of_bedrooms[0]."'";
	}
	}
	$bedrooms = str_replace(' ', '-', $bedroomss);

	header('Location:'.HTACCESS_URL.'search-rent-property-thumb/&sort='.$sortval.'&state='.$state.'&city='.$city.'&locationname='.$locationname.'&property_type='.$property_type.'&bedrooms='.$bedrooms.'&budget_min='.$budget_min.'&budget_max='.$budget_max.'/');
	exit;
}


//get mode serach rent property listing
if($mode=="search_for_rent_listing"){

	$state = $dbObj->sc_mysql_escape($_REQUEST['state']);
	$city = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['city']));
	$location = $_REQUEST['location'];
	$property_type = str_replace(' ', '_', $dbObj->sc_mysql_escape($_REQUEST['property_type']));
	$no_of_bedrooms = $_REQUEST['no_of_bedrooms'];
	$budget_min = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['budget_min']));
	$budget_max = str_replace(' ', '-', $dbObj->sc_mysql_escape($_REQUEST['budget_max']));

	if(!empty($location)){
	if(count($location)>1){
		for($i=0;$i<count($location);$i++){
			if(!empty($location[$i])){
			$locationnames.= "'".$location[$i]."'";
			if($i!=(count($location)-1))
			 $locationnames.= ",";
			}
		}
	} else {
		 $locationnames = "'".$location[0]."'";
	}
	}//exit;
	
	$locationname = str_replace(' ', '-', $locationnames);

	/*if(!empty($property_type)){
	if(count($property_type)>1){
		for($i=0;$i<count($property_type);$i++){
			if(!empty($property_type[$i])){
			 $propertyType.= "'".$property_type[$i]."'";
			if($i!=(count($property_type)-1))
		echo $propertyType.= ",";
			}
		}

	} else {
		$propertyType = "'".$property_type[0]."'";
	}
	}*/

	if(!empty($no_of_bedrooms)){
	if(count($no_of_bedrooms)>1){
		for($i=0;$i<count($no_of_bedrooms);$i++){
			if(!empty($no_of_bedrooms[$i])){
			 $bedroomss.= "'".$no_of_bedrooms[$i]."'";
			if($i!=(count($no_of_bedrooms)-1))
				 $bedroomss.= ",";
			}
		}
	} else {
		$bedroomss = "'".$no_of_bedrooms[0]."'";
	}
	}
	
	$bedrooms = str_replace(' ', '-', $bedroomss);

	header('Location:'.HTACCESS_URL.'search-rent-property-list/&sort='.$sortval.'&state='.$state.'&city='.$city.'&locationname='.$locationname.'&property_type='.$property_type.'&bedrooms='.$bedrooms.'&budget_min='.$budget_min.'&budget_max='.$budget_max.'/');
	exit;
}


// get location free valuation
if($mode=="get_city") {

	$cityName = $dbObj->sc_mysql_escape($_REQUEST['cityName']);

	$dbObj->dbQuery="select * from ".PREFIX."location where city='".$cityName."'";
	$dbLocation = $dbObj->SelectQuery();
	//echo $dbObj->dbQuery;

	for($i=0;$i<count($dbLocation);$i++){
        	$data.='"'.$dbLocation[$i]['location'].'",';
		}

	$newdata = substr($data, 0, -1);
	echo $newdata;
	exit;
}


//mode to arrange a site visit
if($mode=="site_visit"){

	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id'] ?? "");
	$time_otp = $dbObj->sc_mysql_escape($_REQUEST['time_otp'] ?? "");
	
	//echo $_SESSION['prop_site_visit']['otp'];exit;

	if($_SESSION['prop_site_visit']['otp']==$time_otp){
	//if(!empty($dbUser[0]['id']) && !empty($property_id) && !empty($_REQUEST['site_visit_date_time'])){
	
	$info['user_id'] = $_SESSION['user']['userid'];
	$info['property_id'] = $property_id;
	$info['site_visit_date_time'] = $dbObj->sc_mysql_escape($_REQUEST['site_visit_date_time']);
	$info['currentDate'] = date('Y-m-d H:i:s');

	add_record($dbObj,PREFIX."site_visit",$info);
	//echo $dbObj->dbQuery;//exit;

	$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."'";
	$dbUser = $dbObj->SelectQuery();
	
	$dbObj->dbQuery="select * from ".PREFIX."property where id='".$property_id."'";
	$dbProperty = $dbObj->SelectQuery();

	$dbObj->dbQuery="select * from ".PREFIX."property_detail where property_id='".$property_id."'";
	$dbPropertyDetail = $dbObj->SelectQuery();
	
	include('usersmsSiteVisit.php');

	include('adminSiteVisitsms.php');
	
	// mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Arrange a Site Visit";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
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
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"><b>Dear Management & Staff,</b> <br/>
                <br/>
                Arrange a site visit details are as follows:</font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Id : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbUser[0]['clientid'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbUser[0]['name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbUser[0]['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Mobile No. : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbUser[0]['mobile_no'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Type : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_type'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">For Property : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['for_property'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Location Area : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['location'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">City : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['city'].'</font></td>
                      </tr>';
                      
                      if(!empty($dbPropertyDetail[0]['offer_price'])){
                      
                      $body .= '
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Price : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbPropertyDetail[0]['offer_price'].' '.$dbPropertyDetail[0]['offer_price_unit'].'</font></td>
                      </tr>';
                      
                      }
                      
                      $body .= '
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Site Visit Date & Time : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['site_visit_date_time'].'</font></td>
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
	//if($mail->Send) {
//		echo "success";
//	} else {
//		echo "fail";
//	}exit;
	$mail->Send();
	$mail->ClearAllRecipients();
	

	//mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Arrange a Site Visit";
	$mail->AddAddress($dbUser[0]['email'],$dbUser[0]['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($dbUser[0]['name']).',</font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> Thank you for your Enquiry on "Arrange a Site Visit" <br />
                <br />
                Our Support Team will contact you soon. <br />
                <br />
                For More Details Contact our support team <br />
                <br />
                contact@cleardeals.co.in<br />
                <br />
                Mo: 9723992200</font></p></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>';

	//echo $mail->Body .= $body;exit;
	//$mail->Body .= $body;
	$mail->MsgHTML($body);
	//if($mail->Send) {
//		echo "success";
//	} else {
//		echo "fail";
//	}exit;
	$mail->Send();
	$mail->ClearAllRecipients();
	
	unset($_SESSION['prop_site_visit']);
	echo 1;
	exit;
	
	}else{
	echo 2;	
	exit;
	}

}



// mode to ask a question
if($mode=="ask_a_question"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);

	$dbObj->dbQuery="select * from ".PREFIX."property where id='".$property_id."'";
	$dbProperty = $dbObj->SelectQuery();

	$dbObj->dbQuery="select * from ".PREFIX."property_detail where property_id='".$property_id."'";
	$dbPropertyDetail = $dbObj->SelectQuery();
	
	$_SESSION['prop_ask']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$_SESSION['prop_ask']['question'] = $dbObj->sc_mysql_escape($_REQUEST['question']);
	
	if($_SESSION['prop_ask']['otp']==$_REQUEST['ask_otp']){

	if(!empty($_REQUEST['user_id']) && !empty($property_id) && !empty($_REQUEST['name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['mobile_no']) && !empty($_REQUEST['question'])){

	$info['user_id'] = $dbObj->sc_mysql_escape($_REQUEST['user_id']);
	$info['property_id'] = $property_id;
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$info['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$info['question'] = $dbObj->sc_mysql_escape($_REQUEST['question']);
	$info['current_datetime'] = date('Y-m-d H:i:s');

	add_record($dbObj,PREFIX."ask_question",$info);
	//echo $dbObj->dbQuery;exit;

	include('usersmsAskQue.php');
	
	include('adminAskQuesms.php');

	// mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Ask a Question";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
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
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"><b>Dear Management & Staff,</b> <br/>
                <br/>
                Ask a question details are as follows:</font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Id : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['clientid'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Mobile No. : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['mobile_no'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Type : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_type'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">For Property : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['for_property'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Location Area : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['location'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">City : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['city'].'</font></td>
                      </tr>';
                      
                      if(!empty($dbPropertyDetail[0]['offer_price'])){
                      
                      $body .= '
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Price : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbPropertyDetail[0]['offer_price'].'  '.$dbPropertyDetail[0]['offer_price_unit'].'</font></td>
                      </tr>';
                      
                      }
                      
                      $body .= '
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Question : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['question'].'</font></td>
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
	

	// mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Ask a Question";
	$mail->AddAddress($_REQUEST['email'],$_REQUEST['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($_REQUEST['name']).',</font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> Thank you for your Enquiry on "Ask a Question" <br />
                <br />
                Our Support Team will contact you soon. <br />
                <br />
                For More Details Contact our support team <br />
                <br />
                contact@cleardeals.co.in<br />
                <br />
                Mo: 9723992200</font></p></td>
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
	
	unset($_SESSION['prop_ask']);
	echo 1;
	//$_SESSION['question_msg'] = base64_encode("Your request for ask a question send to admin."); 
	//header('location:'.HTACCESS_URL.'ask-a-question/'.$dbProperty[0]['id'].'/');
	exit();
	}
	}else{
	echo 2;
	exit;
	}

}



// mode to make an offer
if($mode=="make_an_offer"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);

	$dbObj->dbQuery="select * from ".PREFIX."property where id='".$property_id."'";
	$dbProperty = $dbObj->SelectQuery();

	if(!empty($_REQUEST['user_id']) && !empty($property_id) && !empty($_REQUEST['name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['mobile_no']) && !empty($_REQUEST['offer'])){

	$info['user_id'] = $dbObj->sc_mysql_escape($_REQUEST['user_id']);
	$info['property_id'] = $property_id;
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$info['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$info['offer'] = $dbObj->sc_mysql_escape($_REQUEST['offer']);
	$info['current_datetime'] = date('Y-m-d H:i:s');

	add_record($dbObj,PREFIX."make_offer",$info);
	//echo $dbObj->dbQuery;exit;

	//mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Make An Offer";
	$mail->AddAddress($dbAdmin[0]['email'],"Administrator");
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
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"><b>Dear Management & Staff,</b> <br/>
                <br/>
                Make an offer details are as follows:</font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Id : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['clientid'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Mobile No. : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['mobile_no'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Type : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_type'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">For Property : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['for_property'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Offer : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['offer'].'</font></td>
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

	$_SESSION['offer_msg'] = base64_encode("Your request for make an offer send to admin."); 
	header('location:'.HTACCESS_URL.'make-an-offer/'.$dbProperty[0]['id'].'/');
	exit;
	}
}


// mode to property contact
if($mode=="property_contact"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);//exit;
	//echo $_REQUEST['message'];exit;

	$dbObj->dbQuery="select * from ".PREFIX."property where id='".$property_id."'";
	$dbProperty = $dbObj->SelectQuery();

	$dbObj->dbQuery="select * from ".PREFIX."property_detail where property_id='".$property_id."'";
	$dbPropertyDetail = $dbObj->SelectQuery();
	
	$_SESSION['prop']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$_SESSION['prop']['message'] = $dbObj->sc_mysql_escape($_REQUEST['message']);
	//echo $_REQUEST['message'];exit;
	
	if($_SESSION['prop']['otp']==$_REQUEST['contact_otp']){
	
	if(!empty($property_id) && !empty($_REQUEST['clientid']) && !empty($_REQUEST['name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['mobile_no']) && !empty($_REQUEST['message'])){

	$info['property_id'] = $property_id;
	$info['clientid'] = $dbObj->sc_mysql_escape($_REQUEST['clientid']);
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$info['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$info['message'] = $dbObj->sc_mysql_escape($_REQUEST['message']);//exit;
	$info['current_datetime'] = date('Y-m-d H:i:s');

	add_record($dbObj,PREFIX."prop_contact",$info);
	//echo $dbObj->dbQuery;exit;

	include('usersmscontact.php');

	include('adminEnquirysms.php');

	// mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Property Contact Us";
	$mail->AddAddress($dbAdmin[0]['email'],"Admin");
	//$mail->AddBcc('swalehap@srgit.com',"SRGIT");
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
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"><b>Dear Management & Staff,</b> <br/>
                <br/>
                Property Contact us details are as follows:</font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Id : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['clientid'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Mobile No. : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['mobile_no'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Type : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_type'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">For Property : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['for_property'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Location Area : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['location'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">City : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['city'].'</font></td>
                      </tr>';
                      
                      if(!empty($dbPropertyDetail[0]['offer_price'])){
                      
                      $body.='
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Price : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbPropertyDetail[0]['offer_price'].' '.$dbPropertyDetail[0]['offer_price_unit'].'</font></td>
                      </tr>';
                      
                      }
                      
                      $body.='
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Message : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['message'].'</font></td>
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
	

	// mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Property Contact Us";
	$mail->AddAddress($_REQUEST['email'],$_REQUEST['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($_REQUEST['name']).',</font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> Thank you for your Enquiry on "Property Contact Us" <br />
                <br />
                Our Support Team will contact you soon. <br />
                <br />
                For More Details Contact our support team <br />
                <br />
                contact@cleardeals.co.in<br />
                <br />
                Mo: 9723992200</font></p></td>
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
	
	
	unset($_SESSION['prop']);
	echo 1;
	//$_SESSION['contact_msg'] = base64_encode("Your request for contact us send to admin."); 
	//header('location:'.HTACCESS_URL.'search-property-thumb/#thank-you-popup');
	exit();
	}
	}else{
	//$_SESSION['contact_msg'] = base64_encode("Invalid Otp."); 	
	//header('location:'.HTACCESS_URL.'search-property-thumb/#contact-us-popup'.$property_id);
	echo 2;
	exit();	
	}
}


// mode to property listing contact
if($mode=="property_listing_contact"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	//echo $_REQUEST['exe_email'];exit;

	$dbObj->dbQuery="select * from ".PREFIX."property where id='".$property_id."'";
	$dbProperty = $dbObj->SelectQuery();

	$dbObj->dbQuery="select * from ".PREFIX."property_detail where property_id='".$property_id."'";
	$dbPropertyDetail = $dbObj->SelectQuery();
	
	if($_SESSION['prop_listing']['otp']==$_REQUEST['contact_otp']){
	if(!empty($property_id) && !empty($_REQUEST['clientid']) && !empty($_REQUEST['name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['mobile_no']) && !empty($_REQUEST['message'])){

	$info['property_id'] = $property_id;
	$info['clientid'] = $dbObj->sc_mysql_escape($_REQUEST['clientid']);
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$info['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$info['message'] = $dbObj->sc_mysql_escape($_REQUEST['message']);
	$info['current_datetime'] = date('Y-m-d H:i:s');

	add_record($dbObj,PREFIX."prop_contact",$info);
	//echo $dbObj->dbQuery;exit;

	//include('usersmscontact.php');

	//include('adminEnquirysms.php');

	// mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Property Contact Us";
	$mail->AddAddress($dbAdmin[0]['email'],"Admin");
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
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"><b>Dear Management & Staff,</b> <br/>
                <br/>
                Property Contact us details are as follows:</font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Id : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['clientid'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Mobile No. : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['mobile_no'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Type : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_type'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">For Property : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['for_property'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Location Area : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['location'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">City : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['city'].'</font></td>
                      </tr>';
                      
                      if(!empty($dbPropertyDetail[0]['offer_price'])){
                      
                      $body.='
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Price : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbPropertyDetail[0]['offer_price'].' '.$dbPropertyDetail[0]['offer_price_unit'].'</font></td>
                      </tr>';
                      
                      }
                      
                      $body.='
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Message : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['message'].'</font></td>
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
	
	
	//mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Property Contact Us";
	$mail->AddAddress($_REQUEST['email'],$_REQUEST['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($_REQUEST['name']).',</font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> Thank you for your Enquiry on "Property Contact Us" <br />
                <br />
                Our Support Team will contact you soon. <br />
                <br />
                For More Details Contact our support team <br />
                <br />
                contact@cleardeals.co.in<br />
                <br />
                Mo: 9723992200</font></p></td>
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
	
	unset($_SESSION['prop_listing']);
	echo 1;
	//$_SESSION['contact_msg'] = base64_encode("Your request for contact us send to executive."); 
	//header('location:'.HTACCESS_URL.'search-property-list/#thank-you-popup');
	exit;
	}
	}else{
	echo 2;
	exit;	
	}

}


//mode to rent property contact
if($mode=="rent_property_contact"){

	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	//echo $_REQUEST['exe_email'];exit;

	$dbObj->dbQuery="select * from ".PREFIX."property where id='".$property_id."'";
	$dbProperty = $dbObj->SelectQuery();

	$dbObj->dbQuery="select * from ".PREFIX."property_detail where property_id='".$property_id."'";
	$dbPropertyDetail = $dbObj->SelectQuery();

	if($_SESSION['prop_rent_thumb']['otp']==$_REQUEST['contact_otp']){
	if(!empty($property_id) && !empty($_REQUEST['clientid']) && !empty($_REQUEST['name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['mobile_no']) && !empty($_REQUEST['message'])){

	$info['property_id'] = $property_id;
	$info['clientid'] = $dbObj->sc_mysql_escape($_REQUEST['clientid']);
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$info['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$info['message'] = $dbObj->sc_mysql_escape($_REQUEST['message']);
	$info['current_datetime'] = date('Y-m-d H:i:s');

	add_record($dbObj,PREFIX."prop_contact",$info);
	//echo $dbObj->dbQuery;exit;

	include('usersmscontact.php');

	include('adminEnquirysms.php');

	// mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Property Contact Us";
	$mail->AddAddress($dbAdmin[0]['email'],"Admin");
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
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"><b>Dear Management & Staff,</b> <br/>
                <br/>
                Property Contact us details are as follows:</font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Id : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['clientid'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Mobile No. : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['mobile_no'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Type : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_type'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">For Property : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['for_property'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Location Area : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['location'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">City : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['city'].'</font></td>
                      </tr>';
                      
                      if(!empty($dbPropertyDetail[0]['offer_price'])){
                      
                      $body.='
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Price : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbPropertyDetail[0]['offer_price'].' '.$dbPropertyDetail[0]['offer_price_unit'].'</font></td>
                      </tr>';
                      
                      }
                      
                      $body.='
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Message : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['message'].'</font></td>
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

	// mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Property Contact Us";
	$mail->AddAddress($_REQUEST['email'],$_REQUEST['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($_REQUEST['name']).',</font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> Thank you for your Enquiry on "Property Contact Us" <br />
                <br />
                Our Support Team will contact you soon. <br />
                <br />
                For More Details Contact our support team <br />
                <br />
                contact@cleardeals.co.in<br />
                <br />
                Mo: 9723992200</font></p></td>
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
	
	unset($_SESSION['prop_rent_thumb']);
	echo 1;
	//$_SESSION['contact_msg'] = base64_encode("Your request for contact us send to executive."); 
	//header('location:'.HTACCESS_URL.'search-rent-property-thumb/#thank-you-popup');
	exit;
	}
	}else{
	echo 2;
	exit;	
	}

}


// mode to rent property list contact
if($mode=="rent_property_list_contact"){
	
	$id = $dbObj->sc_mysql_escape($_REQUEST['id']);
	$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id']);
	//echo $_REQUEST['exe_email'];exit;

	$dbObj->dbQuery="select * from ".PREFIX."property where id='".$property_id."'";
	$dbProperty = $dbObj->SelectQuery();

	$dbObj->dbQuery="select * from ".PREFIX."property_detail where property_id='".$property_id."'";
	$dbPropertyDetail = $dbObj->SelectQuery();
	
	if($_SESSION['prop_rent_list']['otp']==$_REQUEST['contact_otp']){

	if(!empty($property_id) && !empty($_REQUEST['clientid']) && !empty($_REQUEST['name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['mobile_no']) && !empty($_REQUEST['message'])){

	$info['property_id'] = $property_id;
	$info['clientid'] = $dbObj->sc_mysql_escape($_REQUEST['clientid']);
	$info['name'] = $dbObj->sc_mysql_escape($_REQUEST['name']);
	$info['email'] = $dbObj->sc_mysql_escape($_REQUEST['email']);
	$info['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['mobile_no']);
	$info['message'] = $dbObj->sc_mysql_escape($_REQUEST['message']);
	$info['current_datetime'] = date('Y-m-d H:i:s');

	add_record($dbObj,PREFIX."prop_contact",$info);
	//echo $dbObj->dbQuery;exit;

	include('usersmscontact.php');

	include('adminEnquirysms.php');
	
	//mail for admin
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Property Contact Us";
	$mail->AddAddress($dbAdmin[0]['email'],"Admin");
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
      <td style="background:#EEEEEE;padding:10px 0" align="center"><strong style="font-size:17px"> Date : '.date("F j, Y", strtotime(date("Y-m-d"))).' </strong></td>
    </tr>
    <tr>
      <td><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"><b>Dear Management & Staff,</b> <br/>
                <br/>
                Property Contact us details are as follows:</font></p>
              <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tr>
                  <td valign="top"><table border="0" cellspacing="0" cellpadding="2" width="100%">
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Id : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['clientid'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Email : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['email'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Client Mobile No. : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['mobile_no'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Name : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_name'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Property Type : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['property_type'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">For Property : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['for_property'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Location Area : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['location'].'</font></td>
                      </tr>
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">City : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbProperty[0]['city'].'</font></td>
                      </tr>';
                      
                      if(!empty($dbPropertyDetail[0]['offer_price'])){
                      
                      $body.='
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Price : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$dbPropertyDetail[0]['offer_price'].' '.$dbPropertyDetail[0]['offer_price_unit'].'</font></td>
                      </tr>';
                      
                      }
                      
                      $body.='
                      <tr>
                        <td align="left" width="30%"><font face="Verdana" style="font-size:12px">Message : </font></td>
                        <td align="left"><font face="Verdana" style="font-size:12px">'.$_REQUEST['message'].'</font></td>
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

	
	//mail for user
	$mail = new PHPMailer();
	$mail->Priority = 3;
	$mail->From = "contact@cleardeals.co.in";
	$mail->FromName = "Cleardeals";
	$mail->Subject = "Cleardeals Property Contact Us";
	$mail->AddAddress($_REQUEST['email'],$_REQUEST['name']);
	$mail->Body = "";
	$mail->AltBody = "";
	
	$body = '<div>
  <table align="Left" border="0" cellspacing="0" cellpadding="5" width="600" style="font-family:Arial, Helvetica, sans-serif;font-size:13px;border:1px solid #cccccc;border-collapse:collapse">
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
            <td colspan="2"><font face="Verdana" style="font-size:12px"><b>Hello </b>'.ucwords($_REQUEST['name']).',</font></td>
          </tr>
          <tr>
            <td valign="middle"><p style="font-size:13px;margin-bottom:10px;margin-top:0;padding-left:5px;"> <font style="font-family:Arial, Helvetica, sans-serif;font-size:13px"> Thank you for your Enquiry on "Property Contact Us" <br />
                <br />
                Our Support Team will contact you soon. <br />
                <br />
                For More Details Contact our support team <br />
                <br />
                contact@cleardeals.co.in<br />
                <br />
                Mo: 9723992200</font></p></td>
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
	
	unset($_SESSION['prop_rent_list']);
	echo 1;
	//$_SESSION['contact_msg'] = base64_encode("Your request for contact us send to executive."); 
	//header('location:'.HTACCESS_URL.'search-rent-property-list/#thank-you-popup');
	exit;
	}
	}else{
		echo 2;
		exit;
		}

}


//generate otp
if($mode=="get_otp"){
	
	$_SESSION['prop']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['MobileNo']);//exit;
	
	if(!empty($_REQUEST['MobileNo'])){
	
	// generate otp
	$rndno=rand(1000, 9999);
	$_SESSION['prop']['otp'] = $rndno;//exit;
	include('propContactmobileAPI.php');
	
	//echo $_SESSION['prop']['otp'];
	echo 1;
	exit();
	}
	
	
}


//generate otp
if($mode=="get_otp_listing"){
	
	$_SESSION['prop_listing']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['MobileNo']);//exit;
	
	if(!empty($_REQUEST['MobileNo'])){
	
	// generate otp
	$rndno = rand(1000, 9999);
	$_SESSION['prop_listing']['otp'] = $rndno;//exit;
	include('propListContactmobileAPI.php');
	
	echo 1;
	
	exit;
	//echo 1;
	}
	
}

//generate otp
if($mode=="get_otp_rent_thumb"){
	
	$_SESSION['prop_rent_thumb']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['MobileNo']);//exit;
	
	if(!empty($_REQUEST['MobileNo'])){
	
	// generate otp
	$rndno=rand(1000, 9999);
	$_SESSION['prop_rent_thumb']['otp'] = $rndno;//exit;
	include('propRentContactmobileAPI.php');
	
	//echo $_SESSION['prop_rent_thumb']['otp'];
	echo 1;
	}
	
	exit;
}


//generate otp
if($mode=="get_otp_rent_list"){
	
	$_SESSION['prop_rent_list']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['MobileNo']);//exit;
	
	if(!empty($_REQUEST['MobileNo'])){
	
	// generate otp
	$rndno=rand(1000, 9999);
	$_SESSION['prop_rent_list']['otp'] = $rndno;//exit;
	include('propRentListConmobileAPI.php');
	
	//echo $_SESSION['prop_rent_thumb']['otp'];
	echo 1;
	}
	
	exit;
}


//generate otp
if($mode=="get_ask_otp"){
	
	$_SESSION['prop_ask']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['MobileNo']);//exit;
	
	if(!empty($_REQUEST['MobileNo'])){
	
	// generate otp
	$rndno=rand(1000, 9999);
	$_SESSION['prop_ask']['otp'] = $rndno;//exit;
	include('propAskQuemobileAPI.php');
	
	//echo $_SESSION['prop_ask']['otp'];
	echo 1;
	}
	
	exit;
}

//generate otp
if($mode=="get_site_visit_otp"){
	
	$_SESSION['prop_site_visit']['mobile_no'] = $dbObj->sc_mysql_escape($_REQUEST['MobileNo']);//exit;
	
	if(!empty($_REQUEST['MobileNo'])){
	
	// generate otp
	$rndno=rand(1000, 9999);
	$_SESSION['prop_site_visit']['otp'] = $rndno;//exit;
	include('propSiteVisitmobileAPI.php');
	
	//echo $_SESSION['prop_site_visit']['otp'];
	echo 1;
	}
	
	exit;
}
?>