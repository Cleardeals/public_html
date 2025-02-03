<?php
login_check(); ///to check weatther user is login or not
access_check('rent-property');
$id = '1';
$msg =  base64_decode($_REQUEST['msg'] ?? "");

//to get selected products details
$dbObj->dbQuery="select * from ".PREFIX."package where id='1'";
$dbPackage = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."package where id='2'";
$dbPackagerent = $dbObj->SelectQuery();
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
      <form action="packageController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="update_rent_package" />
        <input type="hidden" name="id" value="<?=$id?>" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Update Package <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1"> 
                    
                    <!-- Nav tabs --> 
                    
                    <!-- Tab panes -->
                    
                    <div class="tab-content tabcontent-border" style="border:none;">
                      <div class="tab-pane pa-20 active" id="profile8" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <h6>Basic Package</h6>
                            <input class="form-control" type="text" name="rdata[cost]" id="cost" placeholder="Basic Package" value="<?=$dbPackagerent[0]['cost'] ?? ""?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            <br>
                            <br>
                          </div>
                          <div class="col-md-6">
                            <h6>Plan Validity</h6>
                            <input class="form-control" type="text" name="rdata[validity]" id="validity" placeholder="Plan Validity" value="<?=$dbPackagerent[0]['validity'] ?? ""?>">
                            <br>
                            <br>
                          </div>
                          <div class="col-md-6">
                            <h6>Package List</h6>
                            <a href="index.php?mo=package_list&packageList=Rent">Manage Package List</a> <br>
                            <br>
                          </div>
                          <div class="col-md-12">
                            <h6>Video</h6>
                            <textarea class="form-control" type="text" name="rdata[video]" id="video"><?=$dbPackagerent[0]['video'] ?? ""?></textarea>
                            <br>
                            <br>
                          </div>
                          <div class="col-md-12">
                            <h6>Note</h6>
                            <textarea class="form-control" type="text" name="rdata[note]"><?=$dbPackagerent[0]['note'] ?? ""?></textarea>
                            <br>
                            <br>
                          </div>
                        </div>
                      </div>
                    </div>
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
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1" <?=($dbPackage[0]['status']==1)?'selected':''?>>Published</option>
                        <option value="0" <?=($dbPackage[0]['status']==0)?'selected':''?>>Unpublished</option>
                      </select>
                    </li>
                    <li> Published on
                      <?php if(!empty($dbPackage[0]['published_on'])){?>
                      <?=date('d/m/Y',strtotime($dbPackage[0]['published_on']));?>
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

	if(isEmpty("Cost",document.getElementById("cost").value)){
		document.getElementById("cost").focus();
		return false;
	}

	if(isEmpty("Validity",document.getElementById("validity").value)){
		document.getElementById("validity").focus();
		return false;
	}

	return true;
}

function submit_host(){
	if(ckhform() == true){
		document.getElementById("accForm").submit();
	}
}
</script>