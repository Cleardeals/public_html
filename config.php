<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

@date_default_timezone_set('Asia/Calcutta');

if(!$_SERVER["HTTPS"]){
	$host = $_SERVER['HTTP_HOST'];
	header("Location:https://".$host);
}


if($_SERVER["HTTPS"]){
	$host = $_SERVER['HTTP_HOST'];
	$host1 = explode(".",$host);
	if($host1[0]!='www'){
		$host = "www.".$host;
		$page = $_SERVER['PHP_SELF'];
		header("Location:http://".$host);
	}	
}

// Set url constant
define('SITE_URL', 'https://www.cleardeals.co.in');
define('SITE_NAME', 'Cleardeal');
define('LINK', SITE_URL.'/');
define('HTACCESS_URL', SITE_URL.'/');//For htaccess


// Set folder constant
define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'].'/');///kunden/homepages/12/d202029888/htdocs/ 
define('EDITOR_JS_DIR', HTACCESS_URL.'cms_js/editor/');
define('EDITOR_DIR', ROOT_DIR.'cms_js/editor/');
define('CLASS_DIR', ROOT_DIR.'classes/');
define('MYSQL_CLASS_DIR', CLASS_DIR.'mysql/');
define('PHP_FUNCTION_DIR', CLASS_DIR.'php_functions/');
define('OUTPUT_DIR', ROOT_DIR.'output/');
define('ERROR_LOG', OUTPUT_DIR.'errorlog/');
define('IMAGE_FOLDER_PATH', ROOT_DIR.'cms_images/');
define('MODULE_DIR',ROOT_DIR.'module/');
define('INCLUDE_DIR',ROOT_DIR.'include/');

define('ADMIN_ROOT_DIR',ROOT_DIR.'dealsboard/');
define('ADMIN_MODULE_DIR',ADMIN_ROOT_DIR.'module/');
define('ADMIN_INCLUDE_DIR',ADMIN_ROOT_DIR.'include/');


////Prifix
define('PREFIX', 'clear_');
define("CELLS", 'cells');

define('ADMIN', 'dealsboard/');

//testing old
//define('SECRET_KEY','493e1e07503b678141b8967a0b05ef7868fcbfed');
//define('APP_ID','171558d31a2803ed631c348a455171');

//testing new
//define('SECRET_KEY','02d112d243a82b4e57de8ea03ab04155f4cabce1');
//define('APP_ID','50710043e5135f576bfbadb4c01705');

//live old
//define('SECRET_KEY','a5a42d711a2e3a7cca9a9bb79634240db30b11ab');
//define('APP_ID','505129428adbec6a51ecba51f21505');

//live new
define('SECRET_KEY','8790031ca7a01279d9457d394e9e886836419813');
define('APP_ID','960196f647795e3d6a854ebc291069');

// MYSQL Database Related
define('MYSQL_DB_SERVER','localhost');
define('MYSQL_DB_NAME', 'cleardealsconi_newdeals');
define('MYSQL_DB_USER','cleardealsconi_newdeals');
define('MYSQL_DB_PWD','2}g]vhoD1z+j');

// AUTH MICROSERVICE URL
define('AUTH_MICROSERVICE_URL', 'http://127.0.0.1:3000/auth');

if(isset($_SESSION['view_all']) && !empty($_SESSION['view_all'])){
	define("RECORD_PER_PAGE",$_SESSION['view_all']); // records per page for admin
} else {
	define("RECORD_PER_PAGE",12); // records per page for admin
}
define("RECORD_PER_PAGE2",800); // records per page for admin
define("RECORD_PER_PAGE_PROPERTY",12);
define("RECORD_PER_PAGE_FAV",10);
define("RECORD_PER_PAGE_BLOG",12);
define("PAGE_LINKS_PER_PAGE", 10); // links per page

//pages module
define("PAGES_IMAGE_PATH", IMAGE_FOLDER_PATH.'pages/original/');  // pages image folder path
define("PAGES_THUMBS_IMAGE_PATH", IMAGE_FOLDER_PATH.'pages/thumb/'); // pages image folder path

//property module
define("PROPERTY_IMAGE_PATH", IMAGE_FOLDER_PATH.'property/original/');  // property image folder path
define("PROPERTY_THUMB_IMAGE_PATH", IMAGE_FOLDER_PATH.'property/thumb/'); // property image folder path
define("PROPERTY_BROCHURE", IMAGE_FOLDER_PATH.'property/brochure/'); // property brochure folder path

//sold property module
define("SOLD_PROPERTY_IMAGE_PATH", IMAGE_FOLDER_PATH.'sold-property/original/');  // sold property image folder path
define("SOLD_PROPERTY_THUMB_IMAGE_PATH", IMAGE_FOLDER_PATH.'sold-property/thumb/'); // sold property image folder path

//services module
define("SERVICES_IMAGE_PATH", IMAGE_FOLDER_PATH.'services/original/');  // services image folder path
define("SERVICES_THUMB_IMAGE_PATH", IMAGE_FOLDER_PATH.'services/thumb/'); // services image folder path

//team module
define("TEAM_IMAGE_PATH", IMAGE_FOLDER_PATH.'team/original/');  // team image folder path
define("TEAM_THUMB_IMAGE_PATH", IMAGE_FOLDER_PATH.'team/thumb/'); // team image folder path

//blog module
define("BLOG_IMAGE_PATH", IMAGE_FOLDER_PATH.'blog/original/');  // blog image folder path
define("BLOG_THUMB_IMAGE_PATH", IMAGE_FOLDER_PATH.'blog/thumb/'); // blog image folder path

//career module
define("CAREER_DOC_PATH", IMAGE_FOLDER_PATH.'career/');  // career folder path

//excel module
define("EXC_IMAGE_PATH", IMAGE_FOLDER_PATH.'excel/');  // excel folder path

//property excel module
define("PROP_EXC_PATH", IMAGE_FOLDER_PATH.'property_excel/');  // property excel folder path

//user excel module
define("USER_EXC_PATH", IMAGE_FOLDER_PATH.'user_excel/');  // user excel folder path

//progress module
define("PROGRESS_PATH", IMAGE_FOLDER_PATH.'progress_report/');  // progress folder path

//payment receipt module
define("PAYMENT_RECEIPT_PATH", IMAGE_FOLDER_PATH.'payment_receipt/');  // payment receipt folder path

//chat attachment module
define("CHAT_ATTACHMENT", IMAGE_FOLDER_PATH.'chat_attachment/');  // chat attachment folder path
?>