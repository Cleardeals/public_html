<?php
login_check(); ///to check weatther user is login or not
access_check('add_faq');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

//to get selected id's record
$dbObj->dbQuery="select * from ".PREFIX."faq where id='".$id."'";
$dbFaq = $dbObj->SelectQuery();
//print_r($dbRes);
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
      <form action="faqController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="add_update_faq"/>
        <input type="hidden" name="id" value="<?=$id?>"/>
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card">
                <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne">
                Add/Update Faq <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <h6>Question</h6>
                    <input class="form-control" type="text" name="info[question]" id="question" value="<?=$dbFaq[0]['question'] ?? ""?>">
                    <br>
                    <br>
                    <h6>Answer</h6>
                    <?php
					  $ckeditor = new CKEditor();
					  $ckeditor->config['toolbar'] = 'Full';
					  $ckeditor->basePath = EDITOR_DIR.'ckeditor/';
					  $ckfinder = new CKFinder();
					  $ckfinder->BasePath = '../cms_js/editor/ckfinder/'; // Note: the BasePath property in the CKFinder class starts with a capital letter.
					  $ckfinder->SetupCKEditorObject($ckeditor);
					  $ckeditor->editor('info[answer]',html_entity_decode($dbFaq[0]['answer'] ?? ""));
					  ?>
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
                      <?php if(!empty($dbFaq[0]['status'])){?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1" <?=($dbFaq[0]['status']==1)?'selected':''?>>Published</option>
                        <option value="0" <?=($dbFaq[0]['status']==0)?'selected':''?>>Unpublished</option>
                      </select>
                      <?php }else{?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                      </select>
                      <?php }?>
                    </li>
                    <li> Published on
                      <?php if(!empty($dbFaq[0]['published_on'])){?>
                      <?=date('d/m/Y',strtotime($dbFaq[0]['published_on']));?>
                      <?php }else{?>
                      <?=date('d/m/Y');?>
                      <?php }?>
                    </li>
                  </ul>
                  <div class="d-flex"> <a href="faqController.php?mode=delete_single_faq&id=<?=$dbFaq[0]['id']?>" data-confirm="Are you sure you want to delete?" class="btn waves-effect btn-sm waves-light btn-warning mr-auto">
                  Move to trash</a>
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
	// Add minus icon for collapse element which is open by default
	$(".collapse.show").each(function(){
		$(this).prev(".card-header").find(".fa").addClass("fa-caret-up").removeClass("fa-caret-down");
	});
	
	// Toggle plus minus icon on show hide of collapse element
	$(".collapse").on('show.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-caret-down").addClass("fa-caret-up");
	}).on('hide.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-caret-up").addClass("fa-caret-down");
	});
});
</script> 
<script type="text/javascript">
function ckhform(){
	
	if(isEmpty("Question",document.getElementById("question").value)){
		document.getElementById("question").focus();
		return false;
	}
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