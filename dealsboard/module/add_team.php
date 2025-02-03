<?php
login_check(); ///to check weatther user is login or not
access_check('add_team');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

//to get selected id's record
$dbObj->dbQuery="select * from ".PREFIX."team where id='".$id."'";
$dbTeam = $dbObj->SelectQuery();
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
      <form action="teamController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="add_update_team" />
        <input type="hidden" name="id" value="<?=$id?>" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> 
                <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne">
                Add/Update Team <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <h6>Name</h6>
                    <input class="form-control" type="text" name="info[name]" id="name" value="<?=$dbTeam[0]['name'] ?? ""?>">
                    <br>
                    <br>
                    <h6>Designation</h6>
                    <input class="form-control" type="text" name="info[designation]" id="designation" value="<?=$dbTeam[0]['designation'] ?? ""?>">
                    <br>
                    <br>
                    <h6>Image</h6>
                    <?php if(!empty($dbTeam[0]['image'])) {?>
                    <div class="mws-form-row">
                      <label class="mws-form-label">&nbsp;</label>
                      <div class="mws-form-item"> 
                      <img src="../cms_images/team/original/<?=$dbTeam[0]['image']?>" width="150"/>
                      <label for="picture" class="error" generated="true" style="display:none"></label>
                      </div>
                    </div>
                    <?php } ?>
                    <br>
                    <br>
                    <input class="form-control" type="file" name="image" id="image">
                    <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                    Image size should be (500 X 500)</span> <br>
                    <br>
                    <!--<h6>Short Description</h6>
                    <textarea class="form-control" name="info[short_desc]" id="short_desc"><?=$dbTeam[0]['short_desc'] ?? ""?></textarea>
                    <br>
                    <br>-->
                    <h6>Facebook Url</h6>
                    <input class="form-control" type="text" name="info[fb]" id="fb" value="<?=$dbTeam[0]['fb'] ?? ""?>">
                    <br>
                    <br>
                    <h6>Twitter Url</h6>
                    <input class="form-control" type="text" name="info[twitter]" id="twitter" value="<?=$dbTeam[0]['twitter'] ?? ""?>">
                    <br>
                    <br>
                    <h6>Instagram Url</h6>
                    <input class="form-control" type="text" name="info[insta]" id="insta" value="<?=$dbTeam[0]['insta'] ?? ""?>">
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
                      <?php if(!empty($dbTeam[0]['status'])){?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1" <?=($dbTeam[0]['status']==1)?'selected':''?>>Published</option>
                        <option value="0" <?=($dbTeam[0]['status']==0)?'selected':''?>>Unpublished</option>
                      </select>
                      <?php }else{?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                      </select>
                      <?php }?>
                    </li>
                    <li> Published on
                      <?php if(!empty($dbTeam[0]['published_on'])){?>
                      <?=date('d/m/Y',strtotime($dbTeam[0]['published_on']));?>
                      <?php }else{?>
                      <?=date('d/m/Y');?>
                      <?php }?>
                    </li>
                  </ul>
                  <div class="d-flex"> <a href="faqController.php?mode=delete_single_team&id=<?=$dbTeam[0]['id']?>" data-confirm="Are you sure you want to delete?" class="btn waves-effect btn-sm waves-light btn-warning mr-auto">Move to trash</a>
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
	if(isEmpty("Name",document.getElementById("name").value)){
		document.getElementById("name").focus();
		return false;
	}
	if(isEmpty("Designation",document.getElementById("designation").value)){
		document.getElementById("designation").focus();
		return false;
	}
	<?php if(empty($id)){?>
	if(isEmpty("Image",document.getElementById("image").value)){
		document.getElementById("image").focus();
		return false;
	}
	<?php }?>
	/*if(isEmpty("Short Description",document.getElementById("short_desc").value)){
		document.getElementById("short_desc").focus();
		return false;
	}*/
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