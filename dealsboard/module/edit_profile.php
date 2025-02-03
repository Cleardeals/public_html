<?php
login_check(); ///to check weatther user is login or not
//access_check('add_admin');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

//to get selected id's record
$dbObj->dbQuery="select * from ".PREFIX."city where status='1' order by display_order";
$dbCity = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."adminuser where id='".$_SESSION['srgit_cms_admin_id']."'";
$dbUser = $dbObj->SelectQuery();
?>
<style>
.error {
	text-align: center;
	color: #FF0000;
	padding-top: 10px;
	font-size: 14px;
}
</style>
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
      
      <form action="loginController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="edit_profile"/>
        <input type="hidden" name="id" value="<?=$dbUser[0]['id']?>" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <?php if(!empty($msg)){ ?>
            <p class="error">
              <?=$msg?>
            </p>
            <?php } ?>
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Edit Profile <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Admin Name</h6>
                        <input class="form-control" type="text" name="info[full_name]" id="full_name" placeholder="Full Name" value="<?=$dbUser[0]['full_name']?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Admin Mobile Number</h6>
                        <input class="form-control" type="text" name="info[contact_no]" id="contact_no" placeholder="Mobile Number" value="<?=$dbUser[0]['contact_no']?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Admin Email Id</h6>
                        <input class="form-control" type="text" name="info[email]" id="email" placeholder="Email Id" value="<?=$dbUser[0]['email']?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>City</h6>
                        <select class="form-control" name="info[city]" id="city">
                          <option value="">Select</option>
                          <?php for($i=0;$i<count((array)$dbCity);$i++){?>
                          <option value="<?=$dbCity[$i]['city_name']?>" <?=($dbUser[0]['city']== $dbCity[$i]['city_name'])?'selected':''?>>
                          <?=$dbCity[$i]['city_name']?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <button onClick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success ml-auto"> Save</button>
                    </div>
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
function submit_host(){
	//if(ckhform() == true){
		document.getElementById("accForm").submit();
	//}    
}

$(document).on('click', ':not(form)[data-confirm]', function(e){
    if(!confirm($(this).data('confirm'))){
      e.stopImmediatePropagation();
      e.preventDefault();
	}
});

function getstate(stateID){
	 $.ajax({
		  url:'propertyController.php?mode=getcity',
		  data:'stateID='+stateID,
		  success:function(response){
		  //alert(response);		
		  $('#selectcity').html(response);
		}
	});
}

function getstate1(stateID){
	 $.ajax({
		  url:'userController.php?mode=getcity',
		  data:'stateID='+stateID,
		  success:function(response){
		  //alert(response);
		  $('#selectcity1').html(response);
		}
	});
}

function forProperty(dropval){
	if(dropval== 'rent'){
		document.getElementById('rentdiv').style.display = 'block';
		document.getElementById('selldiv').style.display = 'none';
	} else if(dropval== 'sell'){
		document.getElementById('rentdiv').style.display = 'none';
		document.getElementById('selldiv').style.display = 'block';
	}
};
</script> 
<script>
$(document).ready(function() {
	$('#example-getting-started').multiselect({
		includeSelectAllOption: true,
		maxHeight: 400,
		dropUp: true
	});
});

$(document).ready(function() {
	$('#example-getting-started1').multiselect({
		includeSelectAllOption: true,
		maxHeight: 400,
		dropUp: true
	});
});
</script>