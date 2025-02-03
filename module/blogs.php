<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='6'";
$dbSitecontent = $dbObj->SelectQuery();

$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");

$var_extra = 'blogs';

if(!empty($_REQUEST['sortby'])){
		$sortby = $_REQUEST['sortby'];
} else {
		$sortby = "id ASC"; // default sortby by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."blog_sub_category where name!=''"; // for total number of records for paging

$dbResult = $dbObj->SelectQuery('user.php','get_admin_list()');
$totalrecords = $dbResult[0]["total"];
   
require_once(PHP_FUNCTION_DIR.'blog-paging.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."blog_sub_category where name!=''"; // for listing of records 

if(empty($view)){
	$dbObj->dbQuery.=" order by $sortby $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sortby";
}

// if(empty($view)){
// 	$dbObj->dbQuery.=" order by $sort $page_limit"; 
// } 
//  else { 
// 	$dbObj->dbQuery.=" order by $sort";
//   echo "155";
// }
//print_r($dbObj);exit();
$dbBlogSubCategory = $dbObj->SelectQuery();  
?>
<style>
#error1 {
	margin:0;
	padding:0;
	font-size:15px;
	text-align:center;
	color:#FF0000;
}

body{margin-top:20px;}
.blog-listing {
    padding-top: 30px;
    padding-bottom: 30px;
}
.gray-bg {
    background-color: #f5f5f5;
}
/* Blog 
---------------------*/
.blog-grid {
  box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
  border-radius: 5px;
  overflow: hidden;
  background: #ffffff;
  margin-top: 15px;
  margin-bottom: 15px;
}
.blog-grid .blog-img {
  position: relative;
}
.blog-grid .blog-img .date {
  position: absolute;
  background: #fc5356;
  color: #ffffff;
  padding: 8px 15px;
  left: 10px;
  top: 10px;
  border-radius: 4px;
}
.blog-grid .blog-img .date span {
  font-size: 22px;
  display: block;
  line-height: 22px;
  font-weight: 700;
}
.blog-grid .blog-img .date label {
  font-size: 14px;
  margin: 0;
}
.blog-grid .blog-info {
  padding: 20px;
}
.blog-grid .blog-info h5 {
  font-size: 22px;
  font-weight: 700;
  margin: 0 0 10px;
}
.blog-grid .blog-info h5 a {
  color: #20247b;
}
.blog-grid .blog-info p {
  margin: 0;
}
.blog-grid .blog-info .btn-bar {
  margin-top: 20px;
}


/* Blog Sidebar
-------------------*/
.blog-aside .widget {
  box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
  border-radius: 5px;
  overflow: hidden;
  background: #ffffff;
  margin-top: 15px;
  margin-bottom: 15px;
  width: 100%;
  display: inline-block;
  vertical-align: top;
}
.blog-aside .widget-body {
  padding: 15px;
}
.blog-aside .widget-title {
  padding: 15px;
  border-bottom: 1px solid #eee;
}
.blog-aside .widget-title h3 {
  font-size: 20px;
  font-weight: 700;
  color: #fc5356;
  margin: 0;
}
.blog-aside .widget-author .media {
  margin-bottom: 15px;
}
.blog-aside .widget-author p {
  font-size: 16px;
  margin: 0;
}
.blog-aside .widget-author .avatar {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  overflow: hidden;
}
.blog-aside .widget-author h6 {
  font-weight: 600;
  color: #20247b;
  font-size: 22px;
  margin: 0;
  padding-left: 20px;
}
.blog-aside .post-aside {
  margin-bottom: 15px;
}
.blog-aside .post-aside .post-aside-title h5 {
  margin: 0;
}
.blog-aside .post-aside .post-aside-title a {
  font-size: 18px;
  color: #20247b;
  font-weight: 600;
}
.blog-aside .post-aside .post-aside-meta {
  padding-bottom: 10px;
}
.blog-aside .post-aside .post-aside-meta a {
  color: #6F8BA4;
  font-size: 12px;
  text-transform: uppercase;
  display: inline-block;
  margin-right: 10px;
}
.blog-aside .latest-post-aside + .latest-post-aside {
  border-top: 1px solid #eee;
  padding-top: 15px;
  margin-top: 15px;
}
.blog-aside .latest-post-aside .lpa-right {
  width: 90px;
}
.blog-aside .latest-post-aside .lpa-right img {
  border-radius: 3px;
}
.blog-aside .latest-post-aside .lpa-left {
  padding-right: 15px;
}
.blog-aside .latest-post-aside .lpa-title h5 {
  margin: 0;
  font-size: 15px;
}
.blog-aside .latest-post-aside .lpa-title a {
  color: #20247b;
  font-weight: 600;
}
.blog-aside .latest-post-aside .lpa-meta a {
  color: #6F8BA4;
  font-size: 12px;
  text-transform: uppercase;
  display: inline-block;
  margin-right: 10px;
}

.tag-cloud a {
  padding: 4px 15px;
  font-size: 13px;
  color: #ffffff;
  background: #20247b;
  border-radius: 3px;
  margin-right: 4px;
  margin-bottom: 4px;
}
.tag-cloud a:hover {
  background: #fc5356;
}

.blog-single {
  padding-top: 30px;
  padding-bottom: 30px;
}

.article {
  box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
  border-radius: 5px;
  overflow: hidden;
  background: #ffffff;
  padding: 15px;
  margin: 15px 0 30px;
}
.article .article-title {
  padding: 15px 0 20px;
}
.article .article-title h6 {
  font-size: 14px;
  font-weight: 700;
  margin-bottom: 20px;
}
.article .article-title h6 a {
  text-transform: uppercase;
  color: #fc5356;
  border-bottom: 1px solid #fc5356;
}
.article .article-title h2 {
  color: #20247b;
  font-weight: 600;
}
.article .article-title .media {
  padding-top: 15px;
  border-bottom: 1px dashed #ddd;
  padding-bottom: 20px;
}
.article .article-title .media .avatar {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  overflow: hidden;
}
.article .article-title .media .media-body {
  padding-left: 8px;
}
.article .article-title .media .media-body label {
  font-weight: 600;
  color: #fc5356;
  margin: 0;
}
.article .article-title .media .media-body span {
  display: block;
  font-size: 12px;
}
.article .article-content h1,
.article .article-content h2,
.article .article-content h3,
.article .article-content h4,
.article .article-content h5,
.article .article-content h6 {
  color: #20247b;
  font-weight: 600;
  margin-bottom: 15px;
}
.article .article-content blockquote {
  max-width: 600px;
  padding: 15px 0 30px 0;
  margin: 0;
}
.article .article-content blockquote p {
  font-size: 20px;
  font-weight: 500;
  color: #fc5356;
  margin: 0;
}
.article .article-content blockquote .blockquote-footer {
  color: #20247b;
  font-size: 16px;
}
.article .article-content blockquote .blockquote-footer cite {
  font-weight: 600;
}
.article .tag-cloud {
  padding-top: 10px;
}

.article-comment {
  box-shadow: 0 0 30px rgba(31, 45, 61, 0.125);
  border-radius: 5px;
  overflow: hidden;
  background: #ffffff;
  padding: 20px;
}
.article-comment h4 {
  color: #20247b;
  font-weight: 700;
  margin-bottom: 25px;
  font-size: 22px;
}
img {
    max-width: 100%;
}
img {
    vertical-align: middle;
    border-style: none;
} 
</style>
<div class="center-section-in">
  <div class="container">
    <h2 class="font-30 text-uppercase text-center font-extrabold header-border mb-5 wow fadeInDown"> <span class="themecolor">
      <?=$dbSitecontent[0]['heading']?>
      </span> </h2>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="row">
          <?php for($i=0;$i<count((array)$dbBlogSubCategory);$i++){?>
          <div class="col-lg-6 col-md-6 col-sm-6 wow fadeIn">
            <div class="blog-text">
              <div class="blog-img">
              <a href="<?=HTACCESS_URL?>blogs/category/<?=$dbBlogSubCategory[$i]['link']?>/"> 
              <?php if(!empty($dbBlogSubCategory[$i]['image'])){?>
              <img src="<?=HTACCESS_URL?>cms_images/blog/category/<?=$dbBlogSubCategory[$i]['image']?>" class="img-fluid"> 
              <?php }?>
              </a> </div>
              <h3 class="mt-3 mb-1">
              <span class="font-18 font-weight-bold themecolor montserrat">
               <a href="https://www.cleardeals.co.in/blogs/category/<?=$dbBlogSubCategory[$i]['link']?>/"><?=$dbBlogSubCategory[$i]['name']?></a>
                </span> 
                <span class="text-gray font-14 font-weight-bold montserrat">
                  <?php 
                  $dbObj->dbQuery="select * from ".PREFIX."blog where blog_sub_category_id=".$dbBlogSubCategory[$i]['id']."";
                  $dbArticals = $dbObj->SelectQuery();
                   ?>
                - Blogs (<?=count((array)$dbArticals)?>)</span>
              </h3> 
          </div>
        </div>
          <?php }?>
          <div class="clearfix"></div>
          <div class="col-md-12">
            <div class="text-right">
              <ul class="pagination float-right">
                <?=$page_link?> 
              </ul>
            </div>
          </div>
        </div>
      </div>
      <?php include(INCLUDE_DIR.'blog-sidebar.php'); ?>
    </div>
  </div> 
</div> 
<?php include(INCLUDE_DIR.'blog-footer-links.php'); ?>
<!-- <div id="news" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="text-center text-uppercase font-17">
        Real Estate Updates That Really Helps You </h3>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <p id="error1"></p>
        <form action="/" method="post" id="helpForm" onSubmit="return ajaxmailhelpyou();" autocomplete="off">
          <div class="form-group">
            <input type="text" name="email" id="email" class="form-control p-2" placeholder="Email">
          </div>
          <div align="center">
            <button type="button" onClick="return ajaxmailhelpyou();" class="font-15 montserrat text-uppercase w-100 border-0 font-bold themebg text-white d-block pt-2 pb-2">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> -->
<p data-toggle="modal" class="no-margin" data-target="#myModal" id="model2"></p>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content text-center">
      <div class="modal-body modal-body2">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Thank you</h3>
        <h4 class="thanks mt-2">
        Your submission is recevied and we will contact you soon.</h4>
      </div>
    </div>
  </div>
</div>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function controlBorderColor() {
  //if (this.value.length == 0) { this.style.borderColor = "#FF0000"; }
 // else { 
  this.style.borderColor = "#ced4da"; 
  //}
}

function chkform() {
	
	if(isEmpty("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Email* ");
		document.getElementById('email').style.borderColor  = '#FF0000';
		document.getElementById("email").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("email").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	if(!validateEmail("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		document.getElementById("error1").innerHTML=(" Invalid Email ");
		document.getElementById('email').style.borderColor  = '#FF0000';
		document.getElementById("email").addEventListener("keydown", controlBorderColor, false);
		document.getElementById("email").addEventListener("keyup", controlBorderColor, false);
		return false;
	}
	return true;
}

function ajaxmailhelpyou(){
	
if(chkform() == true){
	
	//alert(email);
	var form_data=$('#helpForm').serialize();
		$.ajax({
		url:"<?=HTACCESS_URL?>contactController.php?mode=help_you",
		data:form_data,
		cache:false,
		async:false,
		success: function(data) {
			//alert(data);
			if(data){
			$('#model2').click();
			$('#helpForm')[0].reset();
			$('#news').modal('hide');
			}
		}
		
		});
}
}
</script>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<script>
$(document).ready(function(){
	$("#news").modal('show');
});
</script>