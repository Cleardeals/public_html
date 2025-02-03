<?php
login_check(); ///to check weatther user is login or not
access_check('add_blog');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

//to get selected id's record
$dbObj->dbQuery="select * from ".PREFIX."blog where id='".$id."'";
$dbBlog = $dbObj->SelectQuery();
//print_r($dbBlog);

$dbObj->dbQuery="select * from ".PREFIX."blog_sub_category";
$dbBlogSubCategory = $dbObj->SelectQuery();
$cntH = count((array)$dbBlogSubCategory);
?>
<!-- summernotes CSS -->
<link href="assets/vendors/summernote/dist/summernote.css" rel="stylesheet"/>
<link href="assets/vendors/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<!-- page css -->
<link href="assets/css/pages/tab-page.css" rel="stylesheet"/>
<body class="fix-header card-no-border fix-sidebar">
<!-- ============================================================== --> 
<!-- Main wrapper - style you can find in pages.scss --> 
<!-- ============================================================== -->
<div id="main-wrapper"> 
  <!-- ============================================================== --> 
  <!-- Topbar header - style you can find in pages.scss --> 
  <!-- ============================================================== -->
  <?php include(ADMIN_INCLUDE_DIR.'header.php'); ?>
  <!-- ============================================================== --> 
  <!-- End Topbar header --> 
  <!-- ============================================================== --> 
  <!-- ============================================================== --> 
  <!-- Left Sidebar - style you can find in sidebar.scss  --> 
  <!-- ============================================================== -->
  <?php include(ADMIN_INCLUDE_DIR.'left_menu.php'); ?>
  <!-- ============================================================== --> 
  <!-- End Left Sidebar - style you can find in sidebar.scss  --> 
  <!-- ============================================================== --> 
  <!-- ============================================================== --> 
  <!-- Page wrapper  --> 
  <!-- ============================================================== -->
  <div class="page-wrapper"> 
    <!-- ============================================================== --> 
    <!-- Container fluid  --> 
    <!-- ============================================================== -->
    <div class="container-fluid"> 
      <!-- Start Page Content --> 
      <!-- ============================================================== -->
      <form action="blogController.php" method="post" id="accForm" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="mode" value="add_update_blog" />
        <input type="hidden" name="id" value="<?=$id?>" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> 
                <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> 
                Add/Update Blog <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                     <h6>Blog Sub Category</h6>
                    <select name="info[blog_sub_category_id]" class="form-control" >
                        <?php for($i=0;$i<$cntH;$i++){?>
                        <?php 
							$category_id = $dbObj->sc_mysql_escape($dbBlogSubCategory[$i]['category_id'] ?? "");
							$blog_sub_category_id = $dbObj->sc_mysql_escape($dbBlog[0]['blog_sub_category_id'] ?? "");
                          $dbObj->dbQuery="select * from ".PREFIX."blog_category where id='".$category_id."'";
                          $dbBlogCategory = $dbObj->SelectQuery();

                        ?>
                        <option value="<?=$dbBlogSubCategory[$i]['id']?>"  <?=($blog_sub_category_id == $dbBlogSubCategory[$i]['id'])?'selected':''?> > <b> <?=$dbBlogSubCategory[$i]['name']?> </b> (<?=$dbBlogCategory[0]['name'] ?? ""?>)</option> 
                        <?php }?>
                      </select>
                    <br>
                    <br>  
                    <h6>Title</h6>
                    <input class="form-control" type="text" name="info[title]" id="title" value="<?=$dbBlog[0]['title'] ?? ""?>">
                    <br>
                    <br>
                    <h6>Image</h6>
                    <?php if(!empty($dbBlog[0]['image'])) {?>
                    <div class="mws-form-row">
                      <label class="mws-form-label">&nbsp;</label>
                      <div class="mws-form-item"> 
                      <img src="../cms_images/blog/original/<?=$dbBlog[0]['image']?>" width="150"/>
                      <label for="picture" class="error" generated="true" style="display:none"></label>
                      </div>
                    </div>
                    <?php } ?>
                    <br>
                    <br>
                    <input class="form-control" type="file" name="image" id="image">
                    <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                    Image size should be (772 X 280)</span> <br>
                    <br>
                    <br>
                     <h6>Image Title</h6>
                      <input class="form-control" name="info[image_title]" id="image_title" type="text" value="<?=$dbBlog[0]['image_title'] ?? ""?>">
                      <br>
                      <br>
                      <h6>Image Alt</h6>
                      <input class="form-control" name="info[image_alt]" id="image_alt" type="text" value="<?=$dbBlog[0]['image_alt'] ?? ""?>">
                      <br>
                      <br>
                    <h6>Short Description</h6>
                    <textarea class="form-control" name="info[short_desc]" id="short_desc"><?=$dbBlog[0]['short_desc'] ?? ""?></textarea>
                    <br>
                    <br>
                    <h6>Content</h6>
                    <?php
						$ckeditor = new CKEditor();
						$ckeditor->config['toolbar'] = 'Full';
						$ckeditor->basePath = EDITOR_DIR.'ckeditor/';
						$ckfinder = new CKFinder();
						$ckfinder->BasePath = '../cms_js/editor/ckfinder/'; // Note: the BasePath property in the CKFinder class starts with a capital letter.
						$ckfinder->SetupCKEditorObject($ckeditor);
						$ckeditor->editor('info[content]',html_entity_decode($dbBlog[0]['content'] ?? ""));
						?>
                    <br>
                    <br>
                     <h6>Url Link</h6>
                    <input class="form-control" type="text" name="info[url]" id="url" value="<?=$dbBlog[0]['url'] ?? ""?>">
                     <br>
                      <br>
                     <h6>Meta Title</h6>
                      <input class="form-control" name="info[seo_title]" id="seo_title" type="text" value="<?=$dbBlog[0]['seo_title'] ?? ""?>">
                      <br>
                      <br>
                      <h6>Meta Keywords</h6>
                      <textarea class="form-control" name="info[meta_keyword]" id="meta_keyword"><?=$dbBlog[0]['meta_keyword'] ?? ""?>
                      </textarea>
                      <br>
                      <br>
                      <h6>Meta Description</h6>
                      <textarea class="form-control" name="info[meta_desc]" id="meta_desc"><?=$dbBlog[0]['meta_desc'] ?? ""?>
                      </textarea>
                      <br>
                      <br>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 position-relative">
            <div>
              <div class="card" id="sidebar">
                <div class="card-body">
                  <h4 class="card-title text-uppercase">Publish Page</h4>
                  <ul class="page-publish">
                    <li>Status:
                      <?php if(!empty($dbBlog[0]['status'])){?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1" <?=($dbBlog[0]['status']==1)?'selected':''?>>Published</option>
                        <option value="0" <?=($dbBlog[0]['status']==0)?'selected':''?>>Unpublished</option>
                      </select>
                      <?php }else{?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                      </select>
                      <?php }?>
                    </li>
                    <li> Published on
                      <?php if(!empty($dbBlog[0]['published_on'])){?>
                      <?=date('d/m/Y',strtotime($dbBlog[0]['published_on']));?>
                      <?php }else{?>
                      <?=date('d/m/Y');?>
                      <?php }?>
                    </li>
                  </ul>
                  <div class="d-flex"> <a href="blogController.php?mode=delete_single_blog&id=<?=$dbBlog[0]['id']?>" data-confirm="Are you sure you want to delete?" class="btn waves-effect btn-sm waves-light btn-warning mr-auto"> Move to trash</a>
                    <button onClick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success ml-auto">Save</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <!-- ============================================================== --> 
      <!-- End PAge Content --> 
      <!-- ============================================================== --> 
      <!-- ============================================================== --> 
      <!-- Right sidebar --> 
      <!-- ============================================================== --> 
      <!-- .right-sidebar --> 
      
      <!-- ============================================================== --> 
      <!-- End Right sidebar --> 
      <!-- ============================================================== --> 
    </div>
    <!-- ============================================================== --> 
    <!-- End Container fluid  --> 
    <!-- ============================================================== --> 
    <!-- ============================================================== --> 
    <!-- footer --> 
    <!-- ============================================================== -->
    <?php include(ADMIN_INCLUDE_DIR.'footer.php'); ?>
    <!-- ============================================================== --> 
    <!-- End footer --> 
    <!-- ============================================================== --> 
  </div>
  <!-- ============================================================== --> 
  <!-- End Page wrapper  --> 
  <!-- ============================================================== --> 
</div>
<!-- ============================================================== --> 
<!-- End Wrapper --> 
<!-- ============================================================== --> 
<!-- ============================================================== --> 
<!-- All Jquery --> 
<!-- ============================================================== --> 

<script src="assets/vendors/sticky-sidebar/stickySidebar.js"></script> 
<script>
$(document).ready(function() {
	$('#sidebar').stickySidebar({
		sidebarTopMargin: 0,
		footerThreshold: 100
	});
});
</script> 
<script>
$(document).ready(function(){
	//Add minus icon for collapse element which is open by default
	$(".collapse.show").each(function(){
		$(this).prev(".card-header").find(".fa").addClass("fa-caret-up").removeClass("fa-caret-down");
	});
	
	//Toggle plus minus icon on show hide of collapse element
	$(".collapse").on('show.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-caret-down").addClass("fa-caret-up");
	}).on('hide.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-caret-up").addClass("fa-caret-down");
	});
});
</script> 
<script type="text/javascript">
function ckhform(){
	if(isEmpty("Title",document.getElementById("title").value)){
		document.getElementById("title").focus();
		return false;
	}
	<?php if(empty($id)){?>
	if(isEmpty("Image",document.getElementById("image").value)){
		document.getElementById("image").focus();
		return false;
	}
	<?php }?>
	return true;
}

function submit_host(){
	if(ckhform() == true){
		document.getElementById("accForm").submit();
	}
}

$(document).on('click', ':not(form)[data-confirm]', function(e){
    if(!confirm($(this).data('confirm'))){
      e.stopImmediatePropagation();
      e.preventDefault();
	}
});
</script> 