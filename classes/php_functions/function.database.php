<?php
// Purpose: to add records into table

//Parameters:
//  $dbObj		database connection object
//	$table		table name
//	$data		array with field names as keys, and values rep. those field values
//	$where		MySQL where statement, minus the "WHERE" text at the beginning

//echo "function.database";exit;

function add_record($dbObj, $table, $data){
	
	// fix characters that MySQL doesn't like
	foreach(array_keys($data) as $field_name) {

		$data[$field_name] = sc_php_escape($data[$field_name]);
		
		if (!isset($field_string)) {
			$field_string = "`".strtolower($field_name)."`"; 
			$value_string = "'$data[$field_name]'";
		} else {
			$field_string .= ",`".strtolower($field_name)."`";
			$value_string .= ",'$data[$field_name]'";
		}
	}

	$dbObj->dbQuery = "INSERT INTO $table ($field_string) VALUES ($value_string)";
//echo $dbObj->dbQuery;exit;
	
	// grab rn# that was just added
	$insert_id = $dbObj->InsertQuery("function.database.php", "add_record()");

	// return record number of the record just added, in case we need it
	return $insert_id;
}

//Purpose:
//	To modify a record

//Parameters:
//  $dbObj		database connection object
//	$table		table name
//	$data		array with field names as keys, and values rep. those field values
//	$where		MySQL where statement, minus the "WHERE" text at the beginning

function modify_record($dbObj, $table, $data, $where){
  //print_r($data);exit;
	// $data must be an array...if it's not...bail
	if (!is_array($data)) return;

	foreach(array_keys($data) as $field_name) { 
		$data[$field_name] = sc_php_escape($data[$field_name]);

		// if set string isn't set, set it....else append with a comma in between
		if (!isset($set_string)) {
			$set_string = "`".strtolower($field_name)."` = '$data[$field_name]'";
		} else {
			$set_string = "$set_string, `".strtolower($field_name)."` = '$data[$field_name]'";
		}
	}
	
	$dbObj->dbQuery = "UPDATE $table SET $set_string WHERE $where";
	//echo $dbObj->dbQuery;exit;
	//echo $dbObj->dbQuery;exit;
	return $dbObj->ExecuteQuery("function.database.php", "modify_record()");
}

//Purpose:
//	To delete a record

//Parameters:
//  $dbObj		database connection object
//	$table		table name
//	$where		MySQL where statement, minus the "WHERE" text at the beginning

function delete_record($dbObj, $table, $where){

	$dbObj->dbQuery = "DELETE FROM $table WHERE $where";
	//echo $dbObj->dbQuery;exit;
	return $dbObj->ExecuteQuery("function.database.php", "delete_record()");
}


//Purpose: to call mysql_real_escape_string(), stripping slashes before only if necessary
function sc_mysql_escape_old($connection, $value) {

	if (is_string($value));

	// strip out slashes IF they exist AND magic_quotes is on
	if (get_magic_quotes_gpc() && (strstr($value,'\"') || strstr($value,"\\'"))) $value = stripslashes($value);
	
	// escape string to make it safe for mysql
	return mysqli_real_escape_string($connection, $value);
}

//Purpose: to call addslashes(), stripping slashes before only if necessary
function sc_php_escape($value) {

	if (is_string($value));

	// strip out slashes IF they exist AND magic_quotes is on
	//if (get_magic_quotes_gpc() && (strstr($value,'\"') || strstr($value,"\\'"))) $value = stripslashes($value);
	if ((strstr($value,'\"') || strstr($value,"\\'"))) $value = stripslashes($value);
	
	// escape string to make it safe for mysql
	return addslashes($value);
}

function Randon_Number(){

	$stringlength = 10;
	$string = "1234567890abcdefghijklmnopqrstuvwxyz!]@[#$)%&(ABCDEFGHIJKLMNOPQRSTUVWYZ";
	$max = strlen($string)-1;
	
	$random_string="";
	for ($i=0; $i<$stringlength; $i++){
		$number = mt_rand(0,$max);
		$random_string.= substr($string,$number,1);
	}
	return $random_string;
}

function login_check(){
	
	if(!isset($_SESSION['is_admin'])){
		$msg = base64_encode("Please Login");
		header("Location:index.php?mo=login&msg=".$msg);
		exit;
	}
}

function login_check_redirect($redirectpage){
//echo base64_decode($redirectpage);
	$sunadmin = base64_encode("/webadmin/");
		if($redirectpage==$sunadmin || empty($redirectpage)){
			header('location:index.php?mo=dashboard');
			//echo "1";
		} else if(!empty($redirectpage)){
			$temp1 = explode("/",base64_decode($redirectpage));
			//echo "2";
			header('location:'.$temp1[2]);
		} else {
			//echo "3";
			header('location:index.php?mo=dashboard');
		}
}

function user_login_check(){

	if(!isset($_SESSION['is_user_login']) && empty($_SESSION['is_user_login'])){
		$msg = base64_encode("Please Login.");
		header('Location:index.php?mo=login&m=login&msg='.$msg);
		exit;
	}
}

function replace_string($string){
	$str_val = str_replace(' ','-',str_replace('-','_',str_replace('&','$',trim($string))));
	return($str_val);
}

function string_rep($string){
	$str_val = str_replace('$','&',str_replace('_','-',str_replace('-',' ',trim($string))));
	return($str_val);
}

function just_clean($string){
	// Replace other special chars
	/*$specialCharacters = array('#' => '','$' => '','%' => '','&' => '','@' => '','.' => '','€' => '','+' => '','=' => '','§' => '','\\' => '','/' => '','?'=>'','('=>'',')'=>'','<'=>'','<'=>'',','=>'','*'=>'','_'=>'','-'=>'',' '=>'','\\'=>'',':'=>'','http://'=>'','www.'=>'','|'=>'','||'=>'',"'"=>'');
	
	while (list($character, $replacement) = each($specialCharacters)) {
		$string = str_replace($character, '-' . $replacement . '-', $string);
	}
	
	$string = strtr($string,"ÀÁÂÃÄÅáâãäåà?ÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
	"AAAAAAaaaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn");
	
	// Remove all remaining other unknown characters
	$string = preg_replace('/[^a-zA-Z0-9\-]/', ' ', $string);
	
	$string = preg_replace('/^[\-]+/', ' ', $string);
	
	$string = preg_replace('/[\-]+$/', ' ', $string);
	
	$string = preg_replace('/[\-]{2,}/', ' ', $string);
		
	$string = str_replace(' ', '-', trim($string));*/
	
	$specialCharacters = str_replace(array('#' , '$' , '%' , '&' , '@' , '.' ,'€' , '+' , '=' , '§' , '\\' , '/' , '?' , '(' , ')' , '<' , '<' , ',' , '*' , '_' , '-' , ' ' , '\\' , ':' , 'http://' , 'www.' , '|' , '||' , "'"), '-', $string);
	
	return strtolower($string);
}

// used in csv export
function cleanData(&$str){
	if($str == 't') 
		$str = 'TRUE'; 
	
	if($str == 'f') 
		$str = 'FALSE'; 
	
	if(preg_match("/^0/", $str) || preg_match("/^\+?\d{8,}$/", $str) || preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)){
		$str = "'$str"; 
	} 
	
	if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}


function checksearchdata($word){
	//echo $word;exit;
	if(trim($word)=='the')
		return false;
	else if(trim($word)=='for')
		return false;
	else if(trim($word)=='are')
		return false;
	else if(trim($word)=='has')
		return false;
	else if(trim($word)=='you')
		return false;
	else if(trim($word)=='should')
		return false;
	else if(trim($word)=='how')
		return false;
	else if(trim($word)=='shall')
		return false;
	else if(trim($word)=='can')
		return false;
	else if(trim($word)=='one')
		return false;
	else if(trim($word)=='two')
		return false;
	else
		return true;
}

/* redirect($msg,$location_with_parameter)- To redirect to a location with its parameter and msg with index.php page and mode value
	Parameters
	1.$msg - message that we want to send
	2.$location_with_parameter - location with parameter to where we want to redirect
	Return Value-no return value
*/

function redirect_session($location_with_parameter)
{
	//echo "Location:index.php?mo=$location_with_parameter&msg=".$msg;exit;
	
	header("Location:".LINK."$location_with_parameter/");
	exit();
}

/* redirect_page($msg,$location_with_parameter)- To redirect to a particlar page location with its parameter and msg
	Parameters
	1.$msg - message that we want to send
	2.$location_with_parameter - location with parameter to where we want to redirect
	Return Value-no return value
*/
function redirect_page($msg,$location_with_parameter)
{
	$msg =base64_encode($msg);
	header("Location:$location_with_parameter&msg=".$msg);
	exit();
}


/* redirect_page($msg,$location_with_parameter)- To redirect to a particlar page location with its parameter and msg
	Parameters
	1.$msg - message that we want to send
	2.$location_with_parameter - location with parameter to where we want to redirect
	Return Value-no return value
*/
function redirect_page_sesssion($location_with_parameter)
{
	header("Location:$location_with_parameter");
	exit();
}

function access_check($page_name){
	
	$plist = array("change_password","change_email");

	if($_SESSION['pages']=='Y'){
		$plist = array_merge($plist,array("pages","add_page"));
	}

	if($_SESSION['let_nik']=='Y'){
		$plist = array_merge($plist,array("let-nik"));
	}

	if($_SESSION['c_support']=='Y'){
		$plist = array_merge($plist,array("find-property"));
	}

	if($_SESSION['state']=='Y'){
		$plist = array_merge($plist,array("states"));
	}

	if($_SESSION['city']=='Y'){
		$plist = array_merge($plist,array("city"));
	}

	if($_SESSION['location']=='Y'){
		$plist = array_merge($plist,array("import_location","add_update_location"));
	}

	if($_SESSION['users']=='Y'){
		$plist = array_merge($plist,array("manage_user","manage_user_seller","add_user","user_property","progress_report","payment_receipt","import_users"));
	}

	if($_SESSION['property']=='Y'){
		$plist = array_merge($plist,array("property","property_images","import_property","add_property","manual_users","edit_manual_user"));
	}
	if($_SESSION['comproperty']=='Y'){
		$plist = array_merge($plist,array("com_property","com_property_images","import_com_property","add_com_property","manual_users","edit_manual_user"));
	}
	
	if($_SESSION['sold_property']=='Y'){
		$plist = array_merge($plist,array("add_sold_property","sold_property"));
	}

	if($_SESSION['receipt']=='Y'){
		$plist = array_merge($plist,array("receipt","add_receipt"));
	}
	
	if($_SESSION['gst_receipt']=='Y'){
		$plist = array_merge($plist,array("gst_receipt","add_gst_receipt"));
	}

	if($_SESSION['services']=='Y'){
		$plist = array_merge($plist,array("services","add_services"));
	}

	if($_SESSION['faq']=='Y'){
		$plist = array_merge($plist,array("faq","add_faq"));
	}

	if($_SESSION['team']=='Y'){
		$plist = array_merge($plist,array("team","add_team"));
	}

	if($_SESSION['blog']=='Y'){
		$plist = array_merge($plist,array("add_blog","blog","blog_comment"));
	}

	if($_SESSION['careers']=='Y'){
		$plist = array_merge($plist,array("career","add_career"));
	}

	if($_SESSION['review']=='Y'){
		$plist = array_merge($plist,array("review"));
	}

	if($_SESSION['package']=='Y'){
		$plist = array_merge($plist,array("package_list","sell-property","rent-property"));
	}
	
	if($_SESSION['video_testimonial']=='Y'){
		$plist = array_merge($plist,array("add_video_testimonial","video_testimonial"));
	}

	if($_SESSION['cdetail']=='Y'){
		$plist = array_merge($plist,array("contact_detail"));
	}

	if($_SESSION['pdetail']=='Y'){
		$plist = array_merge($plist,array("partner_detail"));
	}

	if($_SESSION['free_valuation']=='Y'){
		$plist = array_merge($plist,array("free-valuation"));
	}

	if($_SESSION['appointment']=='Y'){
		$plist = array_merge($plist,array("app-cleardeal"));
	}
	
	if($_SESSION['home_loan']=='Y'){
		$plist = array_merge($plist,array("eligibility","emi"));
	}

	if($_SESSION['srgit_cms_admin_id']=='1'){

		$plist = array("top_popup","add_admin","admin_users","free-valuation","app-cleardeal","home-villa","social_links","request_call_back","career_request","new_project_enquiry","free_advice","subscribe","arrange_site_visit","ask_question","prop_contact","pages","add_page","find-property","states","city","import_location","add_update_location","manage_user","manage_user_seller","add_user","user_property","progress_report","payment_receipt","import_users","property","property_images","import_property","manual_users","edit_manual_user","deleted_property","add_property","add_sold_property","sold_property","receipt","add_receipt","gst_receipt","add_gst_receipt","services","add_services","faq","add_faq","team","add_team","add_blog","blog","blog_comment","deleted_blog","career","add_career","review","deleted_review","package_list","sell-property","rent-property","add_video_testimonial","video_testimonial","contact_detail","partner_detail","let-nik","eligibility","emi","com_property","com_property_images","import_com_property","add_com_property","manual_users","edit_manual_user");

	}
	//print_r($plist);exit;
	if(!in_array($page_name,$plist)){
		header("Location:index.php?mo=dashboard");
		exit;
	}
}

//add page detail
function add_page_detail($dbObj, $table, $page_name, $action){
	
	// fix characters that MySQL doesn't like
	/*foreach(array_keys($data) as $field_name) {

		$data[$field_name] = sc_php_escape($data[$field_name]);
		
		if (!isset($field_string)) {
			$field_string = "`".strtolower($field_name)."`"; 
			$value_string = "'$data[$field_name]'";
		} else {
			$field_string .= ",`".strtolower($field_name)."`";
			$value_string .= ",'$data[$field_name]'";
		}
	}*/
	//$dbObj->dbQuery = "INSERT INTO $table ($field_string) VALUES ($value_string)";
	$dbObj->dbQuery = "INSERT INTO vkey_page_detail (admin_id,username,page_name,action,current) VALUES ('".$_SESSION['srgit_cms_admin_id']."','".$_SESSION['admin_user_name']."','".$page_name."','".$action."','".date('Y-m-d H:i:s')."')";
//echo $dbObj->dbQuery;exit;
	
	// grab rn# that was just added
	$insert_id = $dbObj->InsertQuery("function.database.php", "add_record()");

	// return record number of the record just added, in case we need it
	return $insert_id;
}


//get time ago function
function get_time_ago( $time ){

    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str ){
        $d = $time_difference / $secs;

        if( $d >= 1 ){
		
            $t = round( $d );
            return $t . ' ' . $str . ( $t > 1 ? 's' : '' );
        }
    }
}

//thousand formate function
function thousand_format($number) {
    $number = (int) preg_replace('/[^0-9]/', '', $number);
    if ($number >= 1000) {
        $rn = round($number);
        $format_number = number_format($rn);
        $ar_nbr = explode(',', $format_number);
        $x_parts = array('K', 'M', 'B', 'T', 'Q');
        $x_count_parts = count($ar_nbr) - 1;
        $dn = $ar_nbr[0] . ((int) $ar_nbr[1][0] !== 0 ? '.' . $ar_nbr[1][0] : '');
        $dn .= $x_parts[$x_count_parts - 1];

        return $dn;
    }
    return $number;
}

//money formate in india
function moneyFormatIndia($num) {
    $explrestunits = "" ;
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}
?>