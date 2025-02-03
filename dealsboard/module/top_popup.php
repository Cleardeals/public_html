<?php
login_check(); ///to check weatther user is login or not
access_check('top_popup');
$msg = base64_decode($_REQUEST['msg'] ?? "");
//to get selected id's record
$dbObj->dbQuery="select * from ".PREFIX."settings where id='1'";
$dbRes = $dbObj->SelectQuery();
?>
<!-- summernotes CSS -->
<link href="assets/vendors/summernote/dist/summernote.css" rel="stylesheet"/>
<link href="assets/vendors/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<!-- page css -->
<link href="assets/css/pages/tab-page.css" rel="stylesheet"/>
<style>
.error {
	text-align: center;
	color: #FF0000;
	padding-top: 10px;
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
      <p class="error">
        <?=$msg?>
      </p>
      <?php } ?>
      <form class="mws-form wzd-default" action="loginController.php" method="post" id="accForm">
        <input type="hidden" name="mode" value="update_content" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Change Your Content <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <h6>Content</h6>
                    <input class="form-control" type="text" name="info[popup]" id="popup" value="<?=$dbRes[0]['popup']?>">
                    <br>
                    <br>
                    <h6>Display</h6>
                    <input type="radio" name="info[popupstatus]" <?=($dbRes[0]['popupstatus']==1)?'checked':''?> value="1">
                    Show
                    <input type="radio" name="info[popupstatus]" <?=($dbRes[0]['popupstatus']==0)?'checked':''?> value="0" >
                    Hide <br>
                    <br>
                    <h6>Commission Min</h6>
                    <input class="form-control" type="text" name="info[commin]" id="commin" value="<?=$dbRes[0]['commin']?>">
                    <br>
                    <br>
                    <h6>Commission Max</h6>
                    <input class="form-control" type="text" name="info[commax]" id="commax" value="<?=$dbRes[0]['commax']?>">
                    <br>
                    <br>
                    <h6>Display</h6>
                    <input type="radio" <?=($dbRes[0]['commstatus']==1)?'checked':''?> name="info[commstatus]" value="1">
                    Show
                    <input type="radio" name="info[commstatus]" <?=($dbRes[0]['commstatus']==0)?'checked':''?> value="0" >
                    Hide <br>
                    <br>
                    <button onClick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success ml-auto">Submit</button>
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
<script type="text/javascript">
function ckhform(){
	if(isEmpty("Content",document.getElementById("popup").value)){
		document.getElementById("popup").focus();
		return false;
	}
	if(isEmpty("Commission Min",document.getElementById("commin").value)){
		document.getElementById("commin").focus();
		return false;
	}
	if(isEmpty("Commission Max",document.getElementById("commax").value)){
		document.getElementById("commax").focus();
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