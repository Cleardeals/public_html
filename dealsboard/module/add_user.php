<?php
login_check(); ///to check weatther user is login or not
access_check('add_user');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID'] ?? "");
$cityID = $dbObj->sc_mysql_escape($_REQUEST['cityID'] ?? "");

//to get selected id's record
$dbObj->dbQuery="select * from states";
$dbState = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$id."'";
$dbUser = $dbObj->SelectQuery();
$name = explode(" ",$dbUser[0]['name'] ?? "");
$userId = $dbObj->sc_mysql_escape($dbUser[0]['id'] ?? "");

$dbObj->dbQuery="select * from ".PREFIX."user_property_detail where user_id='".$userId."'";
$dbUser_prop_detail = $dbObj->SelectQuery();
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
      <form action="userController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="add_user"/>
        <input type="hidden" name="id" value="<?=$id?>" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> 
                User Personal Detail <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>First Name</h6>
                      <input class="form-control" type="text" name="f_name" id="f_name" placeholder="First Name" value="<?=$name[0] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Last Name</h6>
                       <input class="form-control" type="text" name="l_name" id="l_name" placeholder="Last Name" value="<?=$name[1] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Mobile Number</h6>
                        <input class="form-control" type="text" name="info[mobile_no]" id="mobile_no" placeholder="Mobile Number" value="<?=$dbUser[0]['mobile_no'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Email Id</h6>
                        <input class="form-control" type="text" name="info[email]" id="email" placeholder="Email Id" value="<?=$dbUser[0]['email'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Country</h6>
                        <input class="form-control" type="text" name="info[country]" id="country" placeholder="Country" value="India">
                        <br>
                        <br>
                      </div>
                      <?php if(!empty($dbUser[0]['state'])){
						  $dbObj->dbQuery="select * from states where id='".$dbUser[0]['state']."'";
						  $dbUserState = $dbObj->SelectQuery();
						  //echo $dbUserState[0]['name'];
						  ?>
                      <div class="col-md-6">
                        <h6>State</h6>
                        <select class="form-control" type="text" name="info[state]" id="state" onChange="getstate1(this.value)">
                          <option value="">Select</option>
                          <?php for($i=0;$i<count((array)$dbState);$i++){?>
                          <option value="<?=$dbState[$i]['id']?>" <?=($dbState[$i]['id']==$dbUserState[0]['id'])?'selected':''?>>
                          <?=$dbState[$i]['name']?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php }else{?>
                      <div class="col-md-6">
                        <h6>State</h6>
                        <select class="form-control" type="text" name="info[state]" id="state" onChange="getstate1(this.value)">
                          <option value="">Select</option>
                          <?php for($i=0;$i<count((array)$dbState);$i++){?>
                          <option value="<?=$dbState[$i]['id']?>">
                          <?=$dbState[$i]['name']?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php }?>
                      <div class="col-md-6">
                        <h6>City</h6>
                        <?php if(!empty($dbUser[0]['city'])){?>
                        <select class="form-control" name="info[city]" id="selectcity1">
                          <option value="<?=$dbUser[0]['city']?>">
                          <?=$dbUser[0]['city']?>
                          </option>
                        </select>
                        <?php }else{?>
                        <select class="form-control" name="info[city]" id="selectcity1">
                          <option value="">City</option>
                        </select>
                        <?php }?>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                      <?php $user_type = $dbUser[0]['user_type'] ?? "";?>
                        <h6>User Type</h6>
                        <select class="form-control" type="text" name="info[user_type]" id="user_type">
                          <option value="">User Type</option>
                          <option value="Buyer" <?=($user_type=='Buyer')?'selected':''?>>Buyer</option>
                          <option value="Seller" <?=($user_type=='Seller')?'selected':''?>>Seller</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Address</h6>
                        <textarea class="form-control" name="info[address]" id="address"><?=$dbUser[0]['address'] ?? ""?></textarea>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row accordion" id="accordion2">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Property Detail <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseTwo" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                    <div class="col-md-4">
                        <h6>Form No.</h6>
                        <input type="text" class="form-control" name="data[form_no]" id="form_no" placeholder="Form No." value="<?=$dbUser_prop_detail[0]['form_no'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Property Name</h6>
                        <input type="text" class="form-control" name="data[property_name]" id="property_name" placeholder="Property Name" value="<?=$dbUser_prop_detail[0]['property_name'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <?php $for_property = $dbUser_prop_detail[0]['for_property'] ?? "";?>
                    <div class="col-md-4">
                        <h6>For Property</h6>
                        <select class="form-control" name="data[for_property]" id="for_property" onChange="forProperty(this.value);">
                          <option value="">For Property</option>
                          <option value="sell" <?=($for_property=='sell')?'selected':''?>> Sell</option>
                          <option value="rent" <?=($for_property=='rent')?'selected':''?>> Rent</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $property_type = $dbUser_prop_detail[0]['property_type'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Property Type</h6>
                        <select class="form-control" name="data[property_type]" id="property_type">
                          <option value="">Property Type</option>
                          <option value="Flat" <?=($property_type=='Flat')?'selected':''?>> Flat</option>
                          <option value="Apartment" <?=($property_type=='Apartment')?'selected':''?>> Apartment</option>
                          <option value="Tower" <?=($property_type=='Tower')?'selected':''?>> Tower</option>
                          <option value="Row House" <?=($property_type=='Row House')?'selected':''?>> Row House</option>
                          <option value="Individual Bunglow" <?=($property_type=='Individual Bunglow')?'selected':''?>>Individual Bunglow</option>
                          <option value="Twin Bunglow" <?=($property_type=='Twin Bunglow')?'selected':''?>> Twin Bunglow</option>
                          <option value="Individual Villa" <?=($property_type=='Individual Villa')?'selected':''?>>Individual Villa</option>
                          <option value="Weekend Homes" <?=($property_type=='Weekend Homes')?'selected':''?>> Weekend Homes</option>
                          <option value="Farm House" <?=($property_type=='Farm House')?'selected':''?>> Farm House</option>
                          <option value="Residential Plot" <?=($property_type=='Residential Plot')?'selected':''?>>Residential Plot</option>
                          <option value="Open Plot" <?=($property_type=='Open Plot')?'selected':''?>> Open Plot</option>
                          <option value="Pent House" <?=($property_type=='Pent House')?'selected':''?>> Pent House</option>
                          <option value="Duplex" <?=($property_type=='Duplex')?'selected':''?>> Duplex</option>
                          <option value="Tenament" <?=($property_type=='Tenament')?'selected':''?>> Tenament</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $no_of_bedrooms = $dbUser_prop_detail[0]['no_of_bedrooms'] ?? "";?>
                      <div class="col-md-4">
                        <h6>No. of Bedrooms</h6>
                        <select class="form-control" name="data[no_of_bedrooms]" id="no_of_bedrooms">
                          <option value="">Select</option>
                            <option value="1 RK" <?=($no_of_bedrooms=='1 RK')?'selected':''?>>1 RK</option>
                            <option value="1 BHK" <?=($no_of_bedrooms=='1 BHK')?'selected':''?>>1 BHK</option>
                            <option value="1.5 BHK" <?=($no_of_bedrooms=='1.5 BHK')?'selected':''?>>1.5 BHK</option>
                            <option value="2 BHK" <?=($no_of_bedrooms=='2 BHK')?'selected':''?>>2 BHK</option>
                            <option value="2.5 BHK" <?=($no_of_bedrooms=='2.5 BHK')?'selected':''?>>2.5 BHK</option>
                            <option value="3 BHK" <?=($no_of_bedrooms=='3 BHK')?'selected':''?>>3 BHK</option>
                            <option value="3.5 BHK" <?=($no_of_bedrooms=='3.5 BHK')?'selected':''?>>3.5 BHK</option>
                            <option value="4 BHK" <?=($no_of_bedrooms=='4 BHK')?'selected':''?>>4 BHK</option>
                            <option value="4.5 BHK" <?=($no_of_bedrooms=='4.5 BHK')?'selected':''?>>4.5 BHK</option>
                            <option value="5 BHK" <?=($no_of_bedrooms=='5 BHK')?'selected':''?>>5 BHK</option>
                            <option value="5 + BHK" <?=($no_of_bedrooms=='5 + BHK')?'selected':''?>>5 + BHK</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $no_of_bathrooms = $dbUser_prop_detail[0]['no_of_bathrooms'] ?? "";?>
                      <div class="col-md-4">
                        <h6>No of bathrooms</h6>
                        <select class="form-control" name="data[no_of_bathrooms]" id="no_of_bathrooms">
                          <option value="">Select</option>
                          <?php for($i=0;$i<30;$i++){?>
                          <option value="<?=$i?>" <?=($no_of_bathrooms==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $state = $dbUser_prop_detail[0]['state'] ?? "";?>
                      <div class="col-md-4">
                        <h6>State</h6>
                        <select class="form-control" type="text" name="data[state]" id="state" onChange="getstate(this.value)">
                          <option value="">Select</option>
                          <?php for($i=0;$i<count((array)$dbState);$i++){?>
                          <option value="<?=$dbState[$i]['id']?>" <?=($dbState[$i]['id']==$state)?'selected':''?>>
                          <?=$dbState[$i]['name']?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>City</h6>
                        <?php if(!empty($dbUser_prop_detail[0]['city'])){?>
                        <select class="form-control" name="data[city]" id="selectcity">
                          <option value="<?=$dbUser_prop_detail[0]['city']?>">
                          <?=$dbUser_prop_detail[0]['city']?>
                          </option>
                        </select>
                        <?php }else{?>
                        <select class="form-control" name="data[city]" id="selectcity">
                          <option value="">City</option>
                        </select>
                        <?php }?>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Add Property Link/Url</h6>
                        <input type="text" class="form-control" name="data[property_link]" id="property_link">
                        <br>
                        <br>
                      </div>
                      <?php
                      $overlookingval = str_replace("'",'',$dbUser_prop_detail[0]['overlooking'] ?? "");
					  $overLookingvalarray = explode(',',$overlookingval);
					  ?>
                      <div class="col-md-12">
                        <h6>Overlooking</h6>
                        <input type="checkbox" name="overlooking[]" id="overlooking" value="Park/Garden" <?=(in_array('Park/Garden',$overLookingvalarray))?'checked':''?>>
                        Park/Garden &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="overlooking[]" id="overlooking" value="Main Road" <?=(in_array('Main Road',$overLookingvalarray))?'checked':''?>>
                        Main Road &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="overlooking[]" id="overlooking" value="Club" <?=(in_array('Club',$overLookingvalarray))?'checked':''?>>
                        Club &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="overlooking[]" id="overlooking" value="Pool" <?=(in_array('Pool',$overLookingvalarray))?'checked':''?>>
                        Pool &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="overlooking[]" id="overlooking" value="Others" <?=(in_array('Others',$overLookingvalarray))?'checked':''?>>
                        Others &nbsp;&nbsp;&nbsp; <br>
                        <br>
                      </div>
                      <?php $hear_about = $dbUser_prop_detail[0]['hear_about'] ?? "";?>
                      <div class="col-md-12">
                        <h6>Where did you hear about us ? </h6>
                        <select name="data[hear_about]" class="form-control btn-default">
                          <option value="">Select Option</option>
                          <option value="Facebook/Instagram/Twitter" <?=($hear_about=='Facebook/Instagram/Twitter')?'selected':''?>>Facebook/Instagram/Twitter</option>
                          <option value="Through Company executive" <?=($hear_about=='Through Company executive')?'selected':''?>>Through Company executive</option>
                          <option value="Through Email" <?=($hear_about=='Through Email')?'selected':''?>>Through Email</option>
                          <option value="From Google search" <?=($hear_about=='From Google search')?'selected':''?>>From Google search</option>
                          <option value="From our Blog Post" <?=($hear_about=='From our Blog Post')?'selected':''?>>From our Blog Post</option>
                          <option value="From a Friend / Relative" <?=($hear_about=='From a Friend / Relative')?'selected':''?>>From a Friend / Relative</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Property Address </h6>
                        <textarea name="data[prop_add]" class="form-control"><?=$dbUser_prop_detail[0]['prop_add'] ?? ""?></textarea>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Detail </h6>
                        <textarea name="data[detail]" class="form-control"><?=$dbUser_prop_detail[0]['detail'] ?? ""?></textarea>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Remark </h6>
                        <textarea name="data[prop_remark]" class="form-control"><?=$dbUser_prop_detail[0]['prop_remark'] ?? ""?></textarea>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row accordion" id="accordion3">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree">Payment Detail <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseThree" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Cheque No</h6>
                        <input type="text" class="form-control" name="data[cheque_no]" id="cheque_no" value="<?=$dbUser_prop_detail[0]['cheque_no'] ?? ""?>" placeholder="Cheque No">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Cheque Date</h6>
                        <input type="text" class="form-control" name="data[cheque_date]" id="cheque_date" value="<?=$dbUser_prop_detail[0]['cheque_date'] ?? ""?>" placeholder="Cheque Date">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Cheque Amount</h6>
                        <input type="text" class="form-control" name="data[cheque_amt]" id="cheque_amt" value="<?=$dbUser_prop_detail[0]['cheque_amt'] ?? ""?>" placeholder="Cheque Amount">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Bank Name</h6>
                        <input type="text" class="form-control" name="data[bank_name]" id="bank_name" value="<?=$dbUser_prop_detail[0]['bank_name'] ?? ""?>" placeholder="Bank Name">
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
                      <?php if(!empty($dbUser_prop_detail[0]['post_date'])){?>
                      <?=date('d/m/Y',strtotime($dbUser_prop_detail[0]['post_date']));?>
                      <?php }else{?>
                      <?=date('d/m/Y');?>
                      <?php }?>
                    </li>
                  </ul>
                  <div class="d-flex"> <a href="userController.php?mode=delete_single_user&id=<?=$dbUser[0]['id']?>" data-confirm="Are you sure you want to delete?" class="btn waves-effect btn-sm waves-light btn-warning mr-auto" style="color:#fff;">Move to trash</a>
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
	if(isEmpty("First Name",document.getElementById("f_name").value)){
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
		  url:'userController.php?mode=getcity2',
		  data:'stateID='+stateID,
		  success:function(response){
		  //alert(response);
		  $('#selectcity').html(response);
		}
	});
}

function getstate1(stateID){
	 $.ajax({
		  url:'userController.php?mode=getcity1',
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