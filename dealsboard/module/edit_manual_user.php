<?php
login_check(); ///to check weatther user is login or not
access_check('edit_manual_user');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id'] ?? "");
$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID'] ?? "");
$cityID = $dbObj->sc_mysql_escape($_REQUEST['cityID'] ?? "");

//to get selected id's record
$dbObj->dbQuery="select * from ".PREFIX."manual_users where id='".$id."'";
$dbUser = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."user_property_detail where user_id='".$dbUser[0]['id']."'";
$dbUser_prop_detail = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."state where status='1' order by display_order";
$dbState = $dbObj->SelectQuery();
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
      <form action="manualuserController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="update_manual_users"/>
        <input type="hidden" name="id" value="<?=$id?>" />
        <input type="hidden" name="property_id" value="<?=$property_id?>" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Update Manual User <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Name</h6>
                        <input class="form-control" type="text" name="info[name]" id="name" placeholder="Name" value="<?=$dbUser[0]['name']?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Email</h6>
                        <input class="form-control" type="text" name="info[email]" id="email" placeholder="Last Name" value="<?=$dbUser[0]['email']?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Mobile Number</h6>
                        <input class="form-control" type="text" name="info[mobile_no]" id="mobile_no" placeholder="Mobile Number" value="<?=$dbUser[0]['mobile_no']?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Country</h6>
                        <input class="form-control" type="text" name="info[country]" id="country" placeholder="Country" value="<?=$dbUser[0]['country']?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>State</h6>
                        <input class="form-control" type="text" name="info[state]" id="state" placeholder="State" value="<?=$dbUser[0]['state']?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>City</h6>
                        <input class="form-control" type="text" name="info[city]" id="city" placeholder="City" value="<?=$dbUser[0]['city']?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>User Type</h6>
                        <select class="form-control" type="text" name="info[user_type]" id="user_type">
                          <option value="">User Type</option>
                          <option value="Buyer" <?=($dbUser[0]['user_type']=='Buyer')?'selected':''?>>Buyer</option>
                          <option value="Seller" <?=($dbUser[0]['user_type']=='Seller')?'selected':''?>>Seller</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Address</h6>
                        <input type="text" class="form-control" name="info[address]" id="address" value="<?=$dbUser[0]['address']?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>For Property</h6>
                        <select class="form-control" type="text" name="info[for_property]" id="for_property">
                          <option value="">For Property</option>
                          <option value="Sell" <?=($dbUser[0]['for_property']=='Sell')?'selected':''?>>Sell</option>
                          <option value="Rent" <?=($dbUser[0]['for_property']=='Rent')?'selected':''?>>Rent</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Property Type</h6>
                        <select class="form-control" type="text" name="info[property_type]" id="property_type">
                          <option value="" >Property Type</option>
                          <option value="Flat" <?=($dbUser[0]['property_type']=='Flat')?'selected':''?>>Flat</option>
                          <option value="Apartment" <?=($dbUser[0]['property_type']=='Apartment')?'selected':''?>>Apartment</option>
                          <option value="Tower" <?=($dbUser[0]['property_type']=='Tower')?'selected':''?>>Tower</option>
                          <option value="Row House" <?=($dbUser[0]['property_type']=='Row House')?'selected':''?>>Row House</option>
                          <option value="Individual Bunglow" <?=($dbUser[0]['property_type']=='Individual Bunglow')?'selected':''?>> Individual Bunglow</option>
                          <option value="Twin Bunglow" <?=($dbUser[0]['property_type']=='Twin Bunglow')?'selected':''?>> Twin Bunglow</option>
                          <option value="Individual Villa" <?=($dbUser[0]['property_type']=='Individual Villa')?'selected':''?>> Individual Villa </option>
                          <option value="Weekend Homes" <?=($dbUser[0]['property_type']=='Weekend Homes')?'selected':''?>> Weekend Homes</option>
                          <option value="Farm House" <?=($dbUser[0]['property_type']=='Farm House')?'selected':''?>> Farm House</option>
                          <option value="Residential Plot" <?=($dbUser[0]['property_type']=='Residential Plot')?'selected':''?>> Residential Plot </option>
                          <option value="Open Plot" <?=($dbUser[0]['property_type']=='Open Plot')?'selected':''?>>Open Plot</option>
                          <option value="Pent House" <?=($dbUser[0]['property_type']=='Pent House')?'selected':''?>> Pent House</option>
                          <option value="Duplex" <?=($dbUser[0]['property_type']=='Duplex')?'selected':''?>>Duplex</option>
                          <option value="Tenament" <?=($dbUser[0]['property_type']=='Tenament')?'selected':''?>>Tenament</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Bedrooms</h6>
                        <select class="form-control" type="text" name="info[bedroom]" id="bedroom">
                          <option value="" >Bedrooms</option>
                          <option value="1 RK" <?=($dbUser[0]['bedroom']=='1 RK')?'selected':''?>>1 RK</option>
                          <option value="1 BHK" <?=($dbUser[0]['bedroom']=='1 BHK')?'selected':''?>>1 BHK</option>
                          <option value="1.5 BHK" <?=($dbUser[0]['bedroom']=='1.5 BHK')?'selected':''?>>1.5 BHK</option>
                          <option value="2 BHK" <?=($dbUser[0]['bedroom']=='2 BHK')?'selected':''?>>2 BHK</option>
                          <option value="2.5 BHK" <?=($dbUser[0]['bedroom']=='2.5 BHK')?'selected':''?>>2.5 BHK</option>
                          <option value="3 BHK" <?=($dbUser[0]['bedroom']=='3 BHK')?'selected':''?>>3 BHK</option>
                          <option value="3.5 BHK" <?=($dbUser[0]['bedroom']=='3.5 BHK')?'selected':''?>>3.5 BHK</option>
                          <option value="4 BHK" <?=($dbUser[0]['bedroom']=='4 BHK')?'selected':''?>>4 BHK</option>
                          <option value="4.5 BHK" <?=($dbUser[0]['bedroom']=='4.5 BHK')?'selected':''?>>4.5 BHK</option>
                          <option value="5 BHK" <?=($dbUser[0]['bedroom']=='5 BHK')?'selected':''?>>5 BHK</option>
                          <option value="5 + BHK" <?=($dbUser[0]['bedroom']=='5 + BHK')?'selected':''?>>5 + BHK</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Bathroom</h6>
                        <select class="form-control" type="text" name="info[bathroom]" id="bathroom">
                          <option value="" >Bathrooms</option>
                          <?php for($i=0;$i<16;$i++){?>
                          <option value="<?=$i?>" <?=($dbUser[0]['bathroom']==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Property State</h6>
                        <select class="form-control" name="info[prop_state]" id="prop_state" onChange="getstate(this.value)">
                          <option value="">State</option>
                          <?php for($i=0;$i<count((array)$dbState);$i++){?>
                          <option value="<?=$dbState[$i]['id']?>" <?=($dbState[$i]['id']==$dbUser[0]['prop_state'])?'selected':''?>>
                          <?=$dbState[$i]['state_name']?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>City</h6>
                        <?php if(empty($dbUser[0]['city'])){?>
                        <select class="form-control" name="info[prop_city]" id="selectcity" onChange="getcity(this.value)">
                          <option value="">City</option>
                        </select>
                        <?php }else{?>
                        <select class="form-control" name="info[prop_city]" id="selectcity" onChange="getcity(this.value)">
                          <option value="<?=$dbUser[0]['city']?>">
                          <?=$dbUser[0]['city']?>
                          </option>
                        </select>
                        <?php }?>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Location Area</h6>
                        <?php if(empty($dbUser[0]['location'])){?>
                        <select class="form-control" type="text" name="info[location]" id="selectlocation">
                          <option value="">Location</option>
                        </select>
                        <?php }else{?>
                        <select class="form-control" type="text" name="info[location]" id="selectlocation">
                          <option value="<?=$dbUser[0]['location']?>">
                          <?=$dbUser[0]['location']?>
                          </option>
                        </select>
                        <?php }?>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Price</h6>
                        <input type="text" class="form-control" name="info[price]" id="price" value="<?=$dbUser[0]['price']?>">
                        <br>
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
                      <?php if(!empty($dbUser[0]['post_date'])){?>
                      <?=date('d/m/Y',strtotime($dbUser[0]['post_date']));?>
                      <?php }else{?>
                      <?=date('d/m/Y');?>
                      <?php }?>
                    </li>
                  </ul>
                  <div class="d-flex"> <a href="manualuserController.php?mode=delete_single_user&id=<?=$dbUser[0]['id']?>&property_id=<?=$property_id?>" data-confirm="Are you sure you want to delete?" class="btn waves-effect btn-sm waves-light btn-warning mr-auto" style="color:#fff;">Move to trash</a>
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
	/*if(isEmpty("First Name",document.getElementById("f_name").value)){
		document.getElementById("f_name").focus();
		return false;
	}
	if(isEmpty("Last Name",document.getElementById("l_name").value)){
		document.getElementById("l_name").focus();
		return false;
	}
	if(isEmpty("Mobile No.",document.getElementById("mobile_no").value)){
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
	}
	if(isEmpty("User Type",document.getElementById("user_type").value)){
		document.getElementById("user_type").focus();
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

function getcity(cityID){
	 $.ajax({
		  url:'propertyController.php?mode=getlocation',
		  data:'cityID='+cityID,
		  success:function(response){
		  //alert(response);
		  $('#selectlocation').html(response);
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