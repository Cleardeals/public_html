<?php  
if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$category = $dbObj->sc_mysql_escape($_REQUEST['category']);
$url = $dbObj->sc_mysql_escape($_REQUEST['blog']); 

$dbObj->dbQuery="select * from ".PREFIX."blog where url='".$url."'";
$dbBlogDetail = $dbObj->SelectQuery(); 

$dbObj->dbQuery="select * from ".PREFIX."blog_sub_category where link='".$category."'";
$dbBlogSubCategory = $dbObj->SelectQuery(); 

$blog_id = $dbObj->sc_mysql_escape($dbBlogDetail[0]['id']);

$dbObj->dbQuery="select * from ".PREFIX."blog_comment where blog_id='".$blog_id."' and status='1'";
$dbBlogComment = $dbObj->SelectQuery();
$comment = count((array)$dbBlogComment);

if(!empty($_SESSION['user']['userid'])){
$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."'";
$dbUser = $dbObj->SelectQuery();
}
//echo $dbObj->dbQuery;
//echo $dbUser[0]['name'];
?>
<style>
#error1 {
	margin:0;
	padding:0;
	font-size:15px;
	text-align:right;
	color:#FF0000;
}
.vl {
    border-left: 6px solid #e00813;
    height: 83px;
    float: right;
}
#error1 {
  margin:0;
  padding:0;
  font-size:15px;
  text-align:right;
  color:#FF0000;
}
.vl {
    border-left: 6px solid #e00813;
    height: 83px;
    float: right;
}
.breadcrumb-item+.breadcrumb-item::before {
    color: #000000;
    content: "//";
    letter-spacing: -5px;
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
     <nav aria-label="breadcrumb">
  <ol class="breadcrumb" style="background: white">
    <li class="breadcrumb-item"><a href="<?=HTACCESS_URL?>" style="color: black;">Home</a></li>
    <li class="breadcrumb-item"><a href="<?=HTACCESS_URL?>blogs/" style="color: black;">Blogs</a></li>
    <li class="breadcrumb-item"><a href="<?=HTACCESS_URL?>blogs/category/<?=$category?>/" style="color: black;"><?=$dbBlogSubCategory[0]['name']?></a></li>
    <li class="breadcrumb-item active" aria-current="page" style="color: red;"><?=$dbBlogDetail[0]['title']?></li>
  </ol>
</nav>
<br>
    <div class="row justify-content-center">
      <div class="col-lg-8 blog-post-text wow fadeIn">
        <h2 class="font-25 font-bold mb-3">
          <?=$dbBlogDetail[0]['title']?>
        </h2>
        <p>
          <?=$dbBlogDetail[0]['short_desc']?>
        </p>
        <div class="blog-post overflow-hidden relative">
          <div class="font-14 font-bold text-white position-absolute date-css">
            <?=date('j F, Y',strtotime($dbBlogDetail[0]['published_on']))?>
            /  Cleardeals</div>
          <img src="<?=HTACCESS_URL?>cms_images/blog/original/<?=$dbBlogDetail[0]['image']?>" class="img-fluid rounded-lg" title="<?=$dbBlogs[$i]['image_title']?>" alt="<?=$dbBlogs[$i]['image_title']?>"> </div>
        <?=html_entity_decode(stripslashes($dbBlogDetail[0]['content']))?>
        <div class="col-md-12 p-0 mt-5 mb-5">
          <hr>
        </div>
        <div class="comment-css">
          <h4 class="font-17 font-weight-bold text-uppercase mb-5">
            <?=$comment?>
            comment</h4>
          <?php for($i=0;$i<$comment;$i++){?>
          <div class="row">
            <div class="col-md-2 text-center"><img src="<?=HTACCESS_URL?>assets/img/blog/user.jpg" class="img-circle img-fluid"></div>
            <div class="col-md-10 pl-0">
              <h3 class="font-18 font-weight-bold">
                <?=$dbBlogComment[$i]['name']?>
              </h3>
              <? $commentDate = explode(' ',$dbBlogComment[$i]['comment_date']);?>
              <h5 class="font-12 text-gray font-weight-bold">
                <?=date('j M Y',strtotime($commentDate[0]))?>
              </h5>
              <p class="m-0">
                <?=$dbBlogComment[$i]['comment']?>
              </p>
            </div>
          </div>
          <div class="col-md-12 p-0 mt-5 mb-5"> 
          </div>
          <?php 
                          if($dbBlogComment[$i]['admin_comment'] != null){
                          ?>  
                             <div class="row">
                               <div class="col-md-1 text-center"><div class="vl"></div></div>
            <div class="col-md-2 text-center"><img src="<?=HTACCESS_URL?>assets/img/blog/user.jpg" class="img-circle img-fluid"></div>
            <div class="col-md-9 pl-0">
              <h3 class="font-18 font-weight-bold">
                Cleardeals
              </h3> 
              <p class="m-0">
                <?=$dbBlogComment[$i]['admin_comment']?>
              </p>
            </div>
          </div>
          <div class="col-md-12 p-0 mt-5 mb-5">
            <hr>
          </div> 
                          <?php 
                          }
                          ?> 
          <?php }?>
          <div class="comment">
            <h4 class="font-16 text-uppercase">Leave a COMMENT</h4>
            <p id="error1"></p>
            <form action="<?=HTACCESS_URL?>commentController.php" method="post" id="accForm" onSubmit="return chkform();" autocomplete="off">
              <input type="hidden" name="mode" value="blog_comment">
              <input type="hidden" name="blog_id" value="<?=$blog_id?>">
               <input type="hidden" name="user_id" value="<?=$dbUser[0]['id'] ?? ""?>">
              <input type="hidden" name="id" value="<?=$id?>">
              <div class="row">
              <div class="col-md-6">
                <input class="form-control font-13" id="name" name="name" placeholder="Name" value="<?=$dbUser[0]['name'] ?? ""?>">
              </div>
              <div class="col-md-6">
                <input class="form-control font-13" id="email" name="email" placeholder="Email" value="<?=$dbUser[0]['email'] ?? ""?>">
              </div>
              </div>
              <div class="mt-3">
                <textarea class="form-control font-13" id="comment" name="comment" placeholder="Comments" rows="3"></textarea>
              </div>
              <button type="submit" class="subscribe-now font-14 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0">POST REPLY
              </button>
            </form>
            <!--<div class="new-user">
              <h4 class="font-16 text-uppercase font-extrabold mb-3">NEW USER?</h4>
              <a data-fancybox="hello" data-src="#blog-1" href="javascript:;" class="subscribe-now  font-14 font-weight-bold text-center text-uppercase themebg text-white border-0 rounded-0 blue-bt2">
              SIGNUP TO REPLY FOR THE POST</a> </div>--> 
          </div>
        </div>
      </div>
      <?php include(INCLUDE_DIR.'blog-sidebar.php'); ?>
    </div>
  </div>
</div>
<?php include(INCLUDE_DIR.'blog-footer-links.php'); ?>

<p data-toggle="modal" class="no-margin" data-target="#myModal" id="model2"></p>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog2">
    <div class="modal-content text-center">
      <div class="modal-body modal-body2">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Thank you</h3>
        <h4 class="thanks mt-2">Your submission is recevied and we will contact you soon.</h4>
      </div>
    </div>
  </div>
</div>
<script src="<?=HTACCESS_URL?>assets/js/page.js"></script> 
<script src="<?=HTACCESS_URL?>cms_js/Validation.js"></script> 
<script type="text/javascript">
function chkform() {
	if(isEmpty("Name",document.getElementById("name").value)) {
		document.getElementById("name").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Name* ");
		return false;
	}
	if(isEmpty("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Email* ");
		return false;
	}
	if(!validateEmail("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		document.getElementById("error1").innerHTML=(" Invalid Email ");
		return false;
	}
	if(isEmpty("Comment",document.getElementById("comment").value)) {
		document.getElementById("comment").focus();
		document.getElementById("error1").innerHTML=(" Please Enter Comment* ");
		return false;
	}
	return true;
}

function submit_host(){
	if(chkform() == true){
		document.getElementById("accForm").submit();
	}
}
</script>
<?php include(INCLUDE_DIR.'footer.php');?>