<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'header.php') ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'header1.php') ?>
<?php }?>
<?php
$url = $dbObj->sc_mysql_escape($_REQUEST['url']); 

$dbObj->dbQuery="select * from ".PREFIX."blog_sub_category where link='".$url."'";
$dbBlogSubCategory = $dbObj->SelectQuery(); 

$dbObj->dbQuery="select * from ".PREFIX."blog_category where id='".$dbBlogSubCategory[0]['category_id']."'";
$dbBlogCategory = $dbObj->SelectQuery(); 

$dbObj->dbQuery="select * from ".PREFIX."blog where blog_sub_category_id='".$dbBlogSubCategory[0]['id']."' and status='1' order by display_order";
$dbBlogs = $dbObj->SelectQuery();
?>
<style>
#error1 {
	margin: 0;
	padding: 0;
	font-size: 15px;
	text-align: right;
	color: #FF0000;
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
body {
	margin-top: 20px;
}
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
.article .article-content h1, .article .article-content h2, .article .article-content h3, .article .article-content h4, .article .article-content h5, .article .article-content h6 {
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
<div class="center-section-in">
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background: white">
      <li class="breadcrumb-item"><a href="#" style="color: black;">Home</a></li>
      <li class="breadcrumb-item"><a href="<?=HTACCESS_URL?>blogs/" style="color: black;">Blogs</a></li>
      <li class="breadcrumb-item active" aria-current="page" style="color: red;">
        <?=$dbBlogCategory[0]['name']?>
      </li>
    </ol>
  </nav>
  <br>
  <div class="row justify-content-center">
    <div class="col-lg-12 blog-post-text wow fadeIn">
      <section class="blog-listing">
        <div class="container">
          <div class="row align-items-start">
            <div class="col-lg-8 m-15px-tb">
              <div class="row">
                <?php for($i=0;$i<count((array)$dbBlogs);$i++){?>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="blog-grid">
                    <div class="blog-img">
                      <div class="date">
                        <?=date('j F, Y',strtotime($dbBlogs[$i]['published_on']))?>
                      </div>
                      <a href="<?=HTACCESS_URL?>blogs/<?=$_REQUEST['url']?>/<?=$dbBlogs[$i]['url']?>/"> <img src="<?=HTACCESS_URL?>cms_images/blog/original/<?=$dbBlogs[$i]['image']?>" title="<?=$dbBlogs[$i]['image_title']?>" alt="<?=$dbBlogs[$i]['image_title']?>"> </a> </div>
                    <div class="blog-info">
                      <h5><a href="<?=HTACCESS_URL?>blogs/<?=$_REQUEST['url']?>/<?=$dbBlogs[$i]['url']?>/">
                        <?=substr($dbBlogs[$i]['title'], 0, 40)?>
                        </a></h5>
                      <p>
                        <?=mb_strimwidth($dbBlogs[$i]['short_desc'], 0, 40,'...')?>
                      </p>
                      <div class="btn-bar"> <a href="<?=HTACCESS_URL?>blogs/<?=$_REQUEST['url']?>/<?=$dbBlogs[$i]['url']?>/" class="px-btn-arrow"> <span>Read More</span> <i class="arrow"></i> </a> </div>
                    </div>
                  </div>
                </div>
                <?php }?>
              </div>
            </div>
            <?php include(INCLUDE_DIR.'blog-sidebar.php'); ?>
          </div>
        </div>
      </section>
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
<?php include(INCLUDE_DIR.'footer.php');?>
