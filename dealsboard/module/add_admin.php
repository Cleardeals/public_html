<?php
login_check(); ///to check weatther user is login or not
access_check('add_admin');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
//to get selected id's record
$dbObj->dbQuery="select * from ".PREFIX."city where status='1' order by display_order";
$dbCity = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."adminuser where id='".$id."'";
$dbUser = $dbObj->SelectQuery();

$access = explode(',',$dbUser[0]['privilege'] ?? "");

for($i=0;$i<count($access);$i++){
$access_value[$access[$i]] = $access[$i];
}
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
      <form action="loginController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="add_admin"/>
        <input type="hidden" name="id" value="<?=$id?>" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> 
                Add/Update Admin <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Admin Name</h6>
                      <input class="form-control" type="text" name="info[full_name]" id="full_name" placeholder="Full Name" value="<?=$dbUser[0]['full_name'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Admin Username</h6>
                       <input class="form-control" type="text" name="info[username]" id="username" placeholder="Username" value="<?=$dbUser[0]['username'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Admin Mobile Number</h6>
                        <input class="form-control" type="text" name="info[contact_no]" id="contact_no" placeholder="Mobile Number" value="<?=$dbUser[0]['contact_no'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Admin Email Id</h6>
                        <input class="form-control" type="text" name="info[email]" id="email" placeholder="Email Id" value="<?=$dbUser[0]['email'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>City</h6>
                        <select class="form-control" name="info[city]" id="city">
                        <option value="">Select</option>
                        <?php for($i=0;$i<count((array)$dbCity);$i++){?>
                        <?php if(!empty($id)){?>
                          <option value="<?=$dbCity[$i]['city_name']?>" <?=($dbUser[0]['city']== $dbCity[$i]['city_name'])?'selected':''?>>
                          <?=$dbCity[$i]['city_name']?>
                          </option>
                          <?php }else{?>
                          <option value="<?=$dbCity[$i]['city_name']?>">
                          <?=$dbCity[$i]['city_name']?>
                          </option>
                          <?php }?>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Password</h6>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" value="<?=$dbUser[0]['password'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                       <div class="col-md-6">
                        <h6>Retype Password</h6>
                        <input class="form-control" type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" value="<?=$dbUser[0]['password'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-12">
                        <h6>Privileges</h6>
                       <!-- <input type="checkbox" name="pages" value="pages" <?=(!empty($access_value['pages']))?'checked':''?>>
                         &nbsp;&nbsp;Pages<br /><br />-->
                         <input type="checkbox" name="c_support" value="c_support" <?=(!empty($access_value['c_support']))?'checked':''?>>
                         &nbsp;&nbsp;Customer Support<br/><br />
                       <!--  <input type="checkbox" name="state" value="state" <?=(!empty($access_value['state']))?'checked':''?>>
                         &nbsp;&nbsp;Manage States<br/>
                        <br/>
                         <input type="checkbox" name="city" value="city" <?=(!empty($access_value['city']))?'checked':''?>>
                         &nbsp;&nbsp;Manage City<br/>
                        <br/>
                         <input type="checkbox" name="location" value="location" <?=(!empty($access_value['location']))?'checked':''?>>
                         &nbsp;&nbsp;Import Location<br/>
                        <br/>
                         <input type="checkbox" name="users" value="users" <?=(!empty($access_value['users']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Users<br/>
                        <br/>-->
                        <input type="checkbox" name="property" value="property" <?=(!empty($access_value['property']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Property<br/>
                        <br/>
                        <input type="checkbox" name="receipt" value="receipt" <?=(!empty($access_value['receipt']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Receipt<br/>
                        <br/>
                         <input type="checkbox" name="users" value="users" <?=(!empty($access_value['users']))?'checked':''?>>
                         &nbsp;&nbsp;Upload Payment Receipt & Progress Report<br/>
                        <br/>
                        <!--<input type="checkbox" name="services" value="services" <?=(!empty($access_value['services']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Services<br/>
                        <br/>
                        <input type="checkbox" name="faq" value="faq" <?=(!empty($access_value['faq']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Faq<br/>
                        <br/>
                        <input type="checkbox" name="team" value="team" <?=(!empty($access_value['team']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Team<br/>
                        <br/>-->
                         <input type="checkbox" name="blog" value="blog" <?=(!empty($access_value['blog']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Blog<br/>
                        <br/>
                         <!--<input type="checkbox" name="careers" value="careers" <?=(!empty($access_value['careers']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Careers<br/>
                        <br/>-->
                         <input type="checkbox" name="review" value="review" <?=(!empty($access_value['review']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Review<br/>
                                <br/>
                                <!--<input type="checkbox" name="package" value="package" <?=(!empty($access_value['package']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Package<br/>
                                <br/>
                                <input type="checkbox" name="cdetail" value="cdetail" <?=(!empty($access_value['cdetail']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Contact Detail<br/>
                                <br/>
                                <input type="checkbox" name="pdetail" value="pdetail" <?=(!empty($access_value['pdetail']))?'checked':''?>>
                         &nbsp;&nbsp;Manage Partner Detail<br/>
                                <br/>-->
                                <input type="checkbox" name="free_valuation" value="free_valuation" <?=(!empty($access_value['free_valuation']))?'checked':''?>>
                         &nbsp;&nbsp;Book Free Valuation<br/>
                        <br/>
                        <input type="checkbox" name="appointment" value="appointment" <?=(!empty($access_value['appointment']))?'checked':''?>>
                         &nbsp;&nbsp;Appointment by Cleardeals<br/>
                        <br/>
                        <br>
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
                      <?php if(!empty($dbUser[0]['status'])){?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1" <?=($dbUser[0]['status']==1)?'selected':''?>>Published</option>
                        <option value="0" <?=($dbUser[0]['status']==0)?'selected':''?>>Unpublished</option>
                      </select>
                      <?php }else{?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                      </select>
                      <?php }?>
                    </li>
                    <li> Published on
                      <?php if(!empty($dbUser_prop_detail[0]['post_date'])){?>
                      <?=date('d/m/Y',strtotime($dbUser_prop_detail[0]['post_date']));?>
                      <?php }else{?>
                      <?=date('d/m/Y');?>
                      <?php }?>
                    </li>
                  </ul>
                  <div class="d-flex"> 
                   <?php if($id!='1'){ ?>
                  <a href="userController.php?mode=delete_single_user&id=<?=$dbUser[0]['id']?>" data-confirm="Are you sure you want to delete?" class="btn waves-effect btn-sm waves-light btn-warning mr-auto" style="color:#fff;">Move to trash</a>
                  <?php }?>
                    <button onClick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success ml-auto">
                    Save</button>
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
	if(isEmpty("Full Name",document.getElementById("full_name").value)){
		document.getElementById("full_name").focus();
		return false;
	}
	if(isEmpty("Username",document.getElementById("username").value)){
		document.getElementById("username").focus();
		return false;
	}
	/*if(isEmpty("Mobile No.",document.getElementById("mobile_no").value)){
		document.getElementById("mobile_no").focus();
		return false;
	}
	if(isEmpty("Email",document.getElementById("email").value)){
		document.getElementById("email").focus();
		return false;
	}
	if(!validateEmail("Email",document.getElementById("email").value)) {
		document.getElementById("email").focus();
		return false;
	}*/
	if(isEmpty("City",document.getElementById("city").value)){
		document.getElementById("city").focus();
		return false;
	}
	if(isEmpty("Password",document.getElementById("password").value)){
		document.getElementById("password").focus();
		return false;
	}
	if(isEmpty("Confirm Password",document.getElementById("cpassword").value)){
		document.getElementById("cpassword").focus();
		return false;
	}
	if(document.getElementById("cpassword").value!='') {
		if(document.getElementById("cpassword").value!=document.getElementById("password").value) {
			alert("Password do not match.");
			document.getElementById("cpassword").focus();
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