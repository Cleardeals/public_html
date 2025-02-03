<?php
login_check(); ///to check weatther user is login or not
$msg = base64_decode($_REQUEST['msg'] ?? "");

//to get selected id's record
$dbObj->dbQuery="select * from ".PREFIX."adminuser where id='".$dbObj->sc_mysql_escape($_SESSION['srgit_cms_admin_id'])."'";
$dbRes = $dbObj->SelectQuery();
?>
<!-- summernotes CSS -->
<link href="assets/vendors/summernote/dist/summernote.css" rel="stylesheet"/>
<link href="assets/vendors/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<!-- page css -->
<link href="assets/css/pages/tab-page.css" rel="stylesheet"/>
<style>
.error {
	text-align:center;
	color:#FF0000;
	padding-top:10px;
	font-size:14px;
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
        <input type="hidden" name="mode" value="update_email" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Change Your Email 
                <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <h6>Email</h6>
                    <input class="form-control" type="text" name="info[email]" id="email" value="<?=$dbRes[0]['email']?>">
                    <br>
                    <br>
                    <h6>Mobile Number</h6>
                    <input class="form-control" type="text" name="info[contact_no]" id="contact_no" value="<?=$dbRes[0]['contact_no']?>">
                    <br>
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

<script type="text/javascript">
function ckhform(){
	if(isEmpty("Email",document.getElementById("email").value)){
		document.getElementById("email").focus();
		return false;
	}
	if(!validateEmail("Email",document.getElementById("email").value)){
		document.getElementById("email").value="";
		document.getElementById("email").focus();
		return false;
	}
	if(isEmpty("Contact Number",document.getElementById("contact_no").value)) {
		document.getElementById("contact_no").focus();
		return false;
	}
	if(document.getElementById("contact_no").value!=''){ 
		  var phoneno = /^\d{10}$/; 
		  var i;
		  var inputtxt = document.getElementById("contact_no").value;  
		  if(document.getElementById("contact_no").value.match(phoneno)) {  
			  i = 1;
		  } else {
			  i = 2;  
				
		  }	
		  
		  if(i==2){
			    alert('Please enter only 10 digits contact number.');
				//document.getElementById("error1").innerHTML=('Please enter only 10 digits mobile number.');
				document.getElementById("contact_no").value='';
				document.getElementById("contact_no").focus();
				return false;    
		  }
	}
	return true;
}

function submit_host(){
	if(ckhform() == true){
		document.getElementById("accForm").submit();
	}    
}
</script> 