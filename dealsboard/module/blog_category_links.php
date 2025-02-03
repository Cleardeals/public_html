<?php
login_check(); ///to check weatther user is login or not
//access_check('add_property');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."blog_footer_links_category";
$dbCategory = $dbObj->SelectQuery();
$cntH = count((array)$dbCategory);
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
      <form action="blogController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="add_update_blog_categry_links"/>
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Add/Update Category Links<i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <?php for($i=0;$i<$cntH;$i++){?>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-sm-11">
                            <h6>Category Name :
                              <?=$dbCategory[$i]['category']?>
                            </h6>
                          </div>
                          <div class="col-sm-1">
                            <button type="button" class="btn btn-primary add_category" data-j="<?=$dbCategory[$i]['id']?>"> <i class="fa fa-plus" aria-hidden="true"></i> </button>
                          </div>
                        </div>
                        <?php
                            $dbObj->dbQuery="select * from ".PREFIX."blog_footer_links where link_category_id='".$dbObj->sc_mysql_escape($dbCategory[$i]['id'])."'"; 
                            $dbCategoryLinks = $dbObj->SelectQuery();
                            $link_count = count((array)$dbCategoryLinks);
                          ?>
                        <?php for($j=0;$j<$link_count;$j++){?>
                        <div class="row category_div_<?=$dbCategory[$i]['id']?>">
                          <div class="col-md-6">
                            <label>Name</label>
                            <input type="hidden" name="info[id][<?=$dbCategoryLinks[$j]['link_category_id']?>][]" value="<?=$dbCategoryLinks[$j]['id']?>">
                            <input class="form-control" type="text" name="info[name][<?=$dbCategoryLinks[$j]['link_category_id']?>][]" id="name" placeholder="Category Name" value="<?=$dbCategoryLinks[$j]['name']?>">
                          </div>
                          <div class="col-md-6">
                            <label>Link</label>
                            <input class="form-control" type="text" name="info[link][<?=$dbCategoryLinks[$j]['link_category_id']?>][]" id="name" placeholder="Category Link" value="<?=$dbCategoryLinks[$j]['link']?>">
                          </div>
                        </div>
                        <br>
                        <?php }?>
                      </div>
                    </div>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
          <script type="text/javascript">
             
            $(".add_category").click(function(){
            var category_id = $(this).data('j'); 
			  var html= $(".category_div_"+category_id).last().html();
			  var row = '<div class="row category_div_'+category_id+'">';
			  $(".category_div_"+category_id).last().parent().append(row+html+"</div><br>");  
			});
          </script>
          <div class="col-md-3 position-relative">
            <div>
              <div class="card" id="sidebar">
                <div class="card-body">
                  <h4 class="card-title text-uppercase">Publish Page</h4>
                  <ul class="page-publish">
                    <li>Status:
                      <?php if(!empty($dbProperty[0]['status'])){?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1" <?=($dbProperty[0]['status']==1)?'selected':''?>>Published</option>
                        <option value="0" <?=($dbProperty[0]['status']==0)?'selected':''?>>Unpublished</option>
                      </select>
                      <?php }else{?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                      </select>
                      <?php }?>
                    </li>
                    <li> Published on
                      <?php if(!empty($dbProperty_detail[0]['post_date'])){?>
                      <?=date('d/m/Y',strtotime($dbProperty_detail[0]['post_date']));?>
                      <?php }else{?>
                      <?=date('d/m/Y');?>
                      <?php }?>
                    </li>
                  </ul>
                  <div class="d-flex"> <a href="propertyController.php?mode=delete_single_property&id=<?=$dbProperty[0]['id']?>" data-confirm="Are you sure you want to delete?" class="btn waves-effect btn-sm waves-light btn-warning mr-auto" style="color:#fff;"> Move to trash</a>
                    <button onClick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success ml-auto"> Save</button>
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
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="js/bootstrap-multiselect.css" type="text/css"/>
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
function submit_host(){ 
    document.getElementById("accForm").submit(); 
}
</script>