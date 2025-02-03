<?php
login_check(); ///to check weatther user is login or not
access_check('contact_detail');
$msg =  base64_decode($_REQUEST['msg'] ?? "");
$id = '1';
//to get selected products details
$dbObj->dbQuery="select * from ".PREFIX."contact_detail where id='1'";
$dbContact = $dbObj->SelectQuery();
?>
<!-- summernotes CSS -->
<link href="assets/vendors/summernote/dist/summernote.css" rel="stylesheet"/>
<link href="assets/vendors/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<!-- page css -->
<link href="assets/css/pages/tab-page.css" rel="stylesheet"/>
<style>
.wizard-label {
	color: #FF0000;
	text-align: center;
	font-size: 14px;
}
</style>
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
      <?php if(!empty($msg)){ ?>
      <legend class="wizard-label">
      <?=$msg?>
      </legend>
      <?php } ?>
      <form action="contentController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="update_contact_detail" />
        <input type="hidden" name="id" value="<?=$id?>" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Update Contact Detail <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <h6>Address</h6>
                    <textarea class="form-control" name="info[address]"><?=$dbContact[0]['address'] ?? ""?></textarea>
                    <br>
                    <br>
                    <h6>Email</h6>
                    <input class="form-control" type="text" name="info[email]" placeholder="Email" value="<?=$dbContact[0]['email'] ?? ""?>">
                    <br>
                    <br>
                    <h6>Conatct No.</h6>
                    <input class="form-control" type="text" name="info[contact_no]" placeholder="Conatct No." value="<?=$dbContact[0]['contact_no'] ?? ""?>">
                    <br>
                    <br>
                    <h6>Google Map Embeded Code</h6>
                    <textarea class="form-control" name="info[google_map]"><?=$dbContact[0]['google_map'] ?? ""?></textarea>
                    <br>
                    <br>
                  </div>
                </div>
              </div>
            </div>
            <div class="row accordion" id="accordion3">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree">Update Footer Detail <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseThree" class="card-body collapse font-13" data-parent="#accordion">
                    <h6>Upload Footer Logo</h6>
                    <?php if(!empty($dbContact[0]['image'])) {?>
                    <div class="mws-form-row">
                      <label class="mws-form-label">&nbsp;</label>
                      <div class="mws-form-item"> <img src="../cms_images/pages/original/<?=$dbContact[0]['image']?>" width="150" />
                        <label for="picture" class="error" generated="true" style="display:none"></label>
                      </div>
                    </div>
                    <br>
                    <br>
                    <?php } ?>
                    <input class="form-control" type="file" name="image">
                    <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                    Image size should be (239 X 100)</span> <br>
                    <br>
                    <h6>Footer Content</h6>
                    <?php
					$ckeditor = new CKEditor();
					$ckeditor->config['toolbar'] = 'Full';
					$ckeditor->basePath = EDITOR_DIR.'ckeditor/';
					$ckfinder = new CKFinder();
					$ckfinder->BasePath = '../cms_js/editor/ckfinder/'; // Note: the BasePath property in the CKFinder class starts with a capital letter.
					$ckfinder->SetupCKEditorObject($ckeditor);
					$ckeditor->editor('info[content]',html_entity_decode($dbContact[0]['content'] ?? ""));
					?>
                    <br>
                    <br>
                  </div>
                </div>
              </div>
            </div>
            <div class="row accordion" id="accordion2">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Update Footer Copyright Detail <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseTwo" class="card-body collapse font-13" data-parent="#accordion"> 
                    <!--<h6>Created By</h6>
                    <input class="form-control" type="text" name="info[created_by]" placeholder="Created By" value="<?=$dbContact[0]['powered_by']?>">
                    <br>
                    <br>
                    <h6>Created By Url</h6>
                    <input class="form-control" type="text" name="info[link]" placeholder="Created By Url" value="<?=$dbContact[0]['link']?>">
                    <br>
                    <br>-->
                    <h6>Copyright Content</h6>
                    <textarea class="form-control" name="info[copyright]"><?=$dbContact[0]['copyright'] ?? ""?></textarea>
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
                    <li> Published on
                      <?php if(!empty($dbContact[0]['published_on'])){?>
                      <?=date('d/m/Y',strtotime($dbContact[0]['published_on']));?>
                      <?php }else{?>
                      <?=date('d/m/Y');?>
                      <?php }?>
                    </li>
                  </ul>
                  <div class="d-flex">
                    <button onClick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success mr-auto">Save</button>
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
	
	/*if(isEmpty("Menu Name",document.getElementById("menu_name").value)){
		document.getElementById("menu_name").focus();
		return false;
	}*/
	return true;
}

function submit_host(){
	if(ckhform() == true){
		document.getElementById("accForm").submit();
	}    
}
</script>