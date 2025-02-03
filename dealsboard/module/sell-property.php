<?php
login_check(); ///to check weatther user is login or not
access_check('sell-property');

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
        <input type="hidden" name="mode" value="update_sell_package"/>
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
                      <div class="tab-pane active" id="home8" role="tabpanel">
                        <div class="pa-20">
                          <div class="row">
                            <div class="col-md-4">
                              <h6>Package 1 Name</h6>
                              <input class="form-control" type="text" name="info[plan1]" id="plan1" placeholder="Plan Name" value="<?=$dbPackage[0]['plan1'] ?? ""?>" >
                              <br>
                              <br>
                            </div>
                            <div class="col-md-4">
                              <h6>Package Cost</h6>
                              <input class="form-control" type="text" name="info[cost]" id="cost" placeholder="Basic Package" value="<?=$dbPackage[0]['cost'] ?? ""?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                              <br>
                              <br>
                            </div>
                            <div class="col-md-4">
                              <h6>Package Validity</h6>
                              <input class="form-control" type="text" name="info[validity]" id="validity" placeholder="Basic Plan Validity" value="<?=$dbPackage[0]['validity']?>">
                              <br>
                              <br>
                            </div>
                            <div class="col-md-4">
                              <h6>Package 2 Name</h6>
                              <input class="form-control" type="text" name="info[plan2]" id="plan2" placeholder="Plan Name" value="<?=$dbPackage[0]['plan2'] ?? ""?>" >
                              <br>
                              <br>
                            </div>
                            <div class="col-md-4">
                              <h6> Package Cost</h6>
                              <input class="form-control" type="text" name="info[cost_premium]" id="cost_premium" placeholder="Premium Digitour Package" value="<?=$dbPackage[0]['cost_premium'] ?? ""?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                              <br>
                              <br>
                            </div>
                            <div class="col-md-4">
                              <h6>Package Validity</h6>
                              <input class="form-control" type="text" name="info[validity_premium]" id="validity_premium" placeholder="Premium Plan Validity" value="<?=$dbPackage[0]['validity_premium'] ?? ""?>">
                              <br>
                              <br>
                            </div>
                            <div class="col-md-4">
                              <h6>Package 3 Name</h6>
                              <input class="form-control" type="text" name="info[plan3]" id="plan3" placeholder="Plan Name" value="<?=$dbPackage[0]['plan3'] ?? ""?>" >
                              <br>
                              <br>
                            </div>
                            <div class="col-md-4">
                              <h6>Package Cost</h6>
                              <input class="form-control" type="text" name="info[cost_split]" id="cost_split" placeholder="Split Fee Package" value="<?=$dbPackage[0]['cost_split'] ?? ""?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                              <br>
                              <br>
                            </div>
                            <div class="col-md-4">
                              <h6>Package Validity</h6>
                              <input class="form-control" type="text" name="info[validity_split]" id="validity_split" placeholder="Split Plan Validity" value="<?=$dbPackage[0]['validity_split'] ?? ""?>">
                              <br>
                              <br>
                            </div>
                            <div class="col-md-6">
                              <h6>Package List</h6>
                              <a href="index.php?mo=package_list&packageList=Sell">Manage Package List</a> <br>
                              <br>
                            </div>
                            <div class="col-md-12">
                              <h6>Video</h6>
                              <textarea class="form-control" type="text" name="info[video]" id="video"><?=$dbPackage[0]['video'] ?? ""?></textarea>
                              <br>
                              <br>
                            </div>
                            <div class="col-md-12">
                              <h6>Note</h6>
                              <textarea class="form-control" type="text" name="info[note]"><?=$dbPackage[0]['note'] ?? ""?></textarea>
                              <br>
                              <br>
                            </div>
                            <div class="col-md-12">
                              <h6>Select Plan to display on Home page</h6>
                              <select class="form-control" type="text" name="info[onhome]" >
                                <option value="plan1" <?=($dbPackage[0]['onhome']=='plan1')?'selected':''?>>Package 1</option>
                                <option value="plan2" <?=($dbPackage[0]['onhome']=='plan2')?'selected':''?>>Package 2</option>
                                <option value="plan3" <?=($dbPackage[0]['onhome']=='plan3')?'selected':''?>>Package 3</option>
                              </select>
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

	if(isEmpty("Premium Digitour Package",document.getElementById("cost_premium").value)){
		document.getElementById("cost_premium").focus();
		return false;
	}

	if(isEmpty("Premium Plan Validity",document.getElementById("validity_premium").value)){
		document.getElementById("validity_premium").focus();
		return false;
	}

	if(isEmpty("Split Fee Package",document.getElementById("cost_split").value)){
		document.getElementById("cost_split").focus();
		return false;
	}

	if(isEmpty("Split Plan Validity",document.getElementById("validity_split").value)){
		document.getElementById("validity_split").focus();
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