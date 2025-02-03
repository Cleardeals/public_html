<?php
login_check(); ///to check weatther user is login or not
access_check('add_com_property');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID'] ?? "");
$cityID = $dbObj->sc_mysql_escape($_REQUEST['cityID'] ?? "");

//to get selected id's record
$dbObj->dbQuery="select * from ".PREFIX."state where status='1' order by display_order";
$dbState = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."com_property where id='".$id."'";
$dbProperty = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."com_property_detail where property_id='".$id."'";
$dbProperty_detail = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."amenities";
$dbAmenities = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."appliances where property_id='".$id."'";
$dbAppliances = $dbObj->SelectQuery();
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
      
      <form action="compropertyController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="add_update_property"/>
        <input type="hidden" name="id" value="<?=$id?>" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Add/Update Property <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <div class="row">
                      <div class="col-md-4">
                        <h6>Form No.</h6>
                        <input class="form-control" type="text" name="info[form_no]" id="form_no" placeholder="Form No." value="<?=$dbProperty[0]['form_no'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Date</h6>
                        <input class="form-control" type="text" name="prop_date" id="prop_date" placeholder="Date" value="<?=$dbProperty[0]['prop_date'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Property Name</h6>
                        <input class="form-control" type="text" name="info[property_name]" id="property_name" placeholder="Property Name" value="<?=$dbProperty[0]['property_name'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <?php $property_type = $dbProperty[0]['property_type'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Property Type</h6>
                        <select class="form-control" name="info[property_type]" id="property_type">
                          <option value="">Property Type</option>
                          <option value="Shops" <?=($property_type=='Shops')?'selected':''?>> Shops</option>
                          <option value="Showrooms" <?=($property_type=='Showrooms')?'selected':''?>> Showrooms</option>
                          <option value="Office Space" <?=($property_type=='Office Space')?'selected':''?>> Office Space</option>
                          <option value="Factories" <?=($property_type=='Factories')?'selected':''?>> Factories</option>
                          <option value="Industrial Sheds" <?=($property_type=='Industrial Sheds')?'selected':''?>>Industrial Sheds</option>
                          <option value="Wearhouse" <?=($property_type=='Wearhouse')?'selected':''?>> Wearhouse</option>
                          <option value="Commercial Land" <?=($property_type=='Commercial Land')?'selected':''?>>Commercial Land</option>
                          <option value="Godowns" <?=($property_type=='Godowns')?'selected':''?>> Godowns</option>
                          <option value="Co Working Space" <?=($property_type=='Co Working Space')?'selected':''?>> Co Working Space</option>
                          <option value="Basement" <?=($property_type=='Basement')?'selected':''?>>Basement</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $for_property = $dbProperty[0]['for_property'] ?? "";?>
                      <div class="col-md-4">
                        <h6>For Property</h6>
                        <select class="form-control" name="info[for_property]" id="for_property" onChange="forProperty(this.value);">
                          <option value="">For Property</option>
                          <option value="Rent" <?=($for_property=='Rent')?'selected':''?>> Rent</option>
                          <option value="Sell" <?=($for_property=='Sell')?'selected':''?>> Sell</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $membership = $dbProperty[0]['membership'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Membership</h6>
                        <select class="form-control" name="info[membership]" id="membership">
                          <option value="">Membership</option>
                          <option value="Standard" <?=($membership=='Standard')?'selected':''?>> Standard</option>
                          <option value="Premium" <?=($membership=='Premium')?'selected':''?>> Premium</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Project Name</h6>
                        <input class="form-control" type="text" name="info[project_name]" id="project_name" placeholder="Project Name" value="<?=$dbProperty[0]['project_name'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <?php $State = $dbProperty[0]['State'] ?? "";?>
                      <div class="col-md-4">
                        <h6>State</h6>
                        <select class="form-control" name="info[State]" id="State" onChange="getstate(this.value)">
                          <option value="">State</option>
                          <?php for($i=0;$i<count((array)$dbState);$i++){?>
                          <option value="<?=$dbState[$i]['id']?>" <?=($dbState[$i]['id']==$State ?? "")?'selected':''?>>
                          <?=$dbState[$i]['state_name']?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>City</h6>
                        <?php if(empty($dbProperty[0]['city'])){?>
                        <select class="form-control" name="info[city]" id="selectcity" onChange="getcity(this.value)">
                          <option value="">City</option>
                        </select>
                        <?php }else{?>
                        <select class="form-control" name="info[city]" id="selectcity" onChange="getcity(this.value)">
                          <option value="<?=$dbProperty[0]['city']?>">
                          <?=$dbProperty[0]['city']?>
                          </option>
                        </select>
                        <?php }?>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Location Area</h6>
                        <?php if(empty($dbProperty[0]['location'])){?>
                        <select class="form-control" type="text" name="info[location]" id="selectlocation">
                          <option value="">Location</option>
                        </select>
                        <?php }else{?>
                        <select class="form-control" type="text" name="info[location]" id="selectlocation">
                          <option value="<?=$dbProperty[0]['location']?>">
                          <?=$dbProperty[0]['location']?>
                          </option>
                        </select>
                        <?php }?>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Video Url</h6>
                        <input type="text" class="form-control" name="info[video_url]" id="video_url" value="<?=$dbProperty[0]['video_url'] ?? ""?>" placeholder="Video Url">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>360<span>&#176;</span> Tour</h6>
                        <input type="text" class="form-control" name="info[tour_link]" id="tour_link" value="<?=$dbProperty[0]['tour_link'] ?? ""?>" placeholder="360 Tour">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Call Us Number</h6>
                        <input type="text" class="form-control" name="data[call_us]" id="call_us" value="<?=$dbProperty_detail[0]['call_us'] ?? ""?>" placeholder="Call Us">
                        <br>
                        <br>
                      </div>
                    </div>
                    <h6>About Property</h6>
                    <textarea class="form-control" name="info[content]" rows="5"><?=$dbProperty[0]['content'] ?? ""?></textarea>
                    <?php
					/*$ckeditor = new CKEditor();
					$ckeditor->config['toolbar'] = 'Full';
					$ckeditor->basePath = EDITOR_DIR.'ckeditor/';
					$ckfinder = new CKFinder();
					$ckfinder->BasePath = '../cms_js/editor/ckfinder/'; // Note: the BasePath property in the CKFinder class starts with a capital letter.
					$ckfinder->SetupCKEditorObject($ckeditor);
					$ckeditor->editor('info[content]',html_entity_decode($dbProperty[0]['content']));
					$ckeditor->enterMode = CKEDITOR.ENTER_BR;
        			$ckeditor->shiftEnterMode = CKEDITOR.ENTER_P;*/
					?>
                    <br>
                    <br>
                  </div>
                </div>
              </div>
            </div>
            <div class="row accordion" id="accordion2">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Property Executive Details <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseTwo" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Executive Name</h6>
                        <input type="text" class="form-control" name="data[exe_name]" placeholder="Executive Name" value="<?=$dbProperty_detail[0]['exe_name'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Executive Email</h6>
                        <input type="text" class="form-control" name="data[exe_email]" placeholder="Executive Email" value="<?=$dbProperty_detail[0]['exe_email'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Executive Contact Number</h6>
                        <input type="text" class="form-control" name="data[exe_contact_no]" placeholder="Executive Contact Number" value="<?=$dbProperty_detail[0]['exe_contact_no'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Executive Address</h6>
                        <input type="text" class="form-control" name="data[exe_address]" placeholder="Executive Address" value="<?=$dbProperty_detail[0]['exe_address'] ?? ""?>">
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
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree">Property Owner Details <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseThree" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Name of Owner/Owners</h6>
                        <input type="text" class="form-control" name="data[owner_name]" placeholder="Name" value="<?=$dbProperty_detail[0]['owner_name'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Email</h6>
                        <input type="text" class="form-control" name="data[owner_email]" placeholder="Email" value="<?=$dbProperty_detail[0]['owner_email'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Contact Number</h6>
                        <input type="text" class="form-control" name="data[owner_contact_no]" placeholder="Contact Number" value="<?=$dbProperty_detail[0]['owner_contact_no'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Address</h6>
                        <input type="text" class="form-control" name="data[owner_address]" placeholder="Address" value="<?=$dbProperty_detail[0]['owner_address'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row accordion" id="accordion4">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion4" href="#collapseFour">Property Details <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseFour" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <?php $pro_curr_status = $dbProperty_detail[0]['pro_curr_status'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Current status of property</h6>
                        <select class="form-control" name="data[pro_curr_status]" id="pro_curr_status">
                          <option value="">Select</option>
                          <option value="Self Occupied" <?=($pro_curr_status=='Self Occupied')?'selected':''?>> Self Occupied</option>
                          <option value="Tenant Occupied" <?=($pro_curr_status=='Tenant Occupied')?'selected':''?>>Tenant Occupied</option>
                          <option value="Empty" <?=($pro_curr_status=='Empty')?'selected':''?>>Empty</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Availability of property</h6>
                        <input type="text" class="form-control" name="data[prop_avail]" id="prop_avail" value="<?=$dbProperty_detail[0]['prop_avail'] ?? ""?>" placeholder="Availability of property">
                        <span style="color:#F00"> within........months/Immediate</span> <br>
                        <br>
                      </div>
                      <?php $permi_avail = $dbProperty_detail[0]['permi_avail'] ?? "";?>
                      <div class="col-md-4">
                        <h6>B.U. Permission Availability</h6>
                        <select class="form-control" name="data[permi_avail]" id="permi_avail">
                          <option value="">Select</option>
                          <option value="Yes" <?=($permi_avail=='Yes')?'selected':''?>> Yes</option>
                          <option value="No" <?=($permi_avail=='No')?'selected':''?>> No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Total no. of units in Project</h6>
                        <input type="text" class="form-control" name="data[project_unit]" id="project_unit" value="<?=$dbProperty_detail[0]['project_unit'] ?? ""?>" placeholder="Total no. of units in Project">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Location of the floor of property</h6>
                        <input type="text" class="form-control" name="data[floor_loc]" id="floor_loc" value="<?=$dbProperty_detail[0]['floor_loc'] ?? ""?>" placeholder="Location of the floor of property">
                        <span style="color:#F00"> ...floor of G+....floor building or G+...storey until</span> <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Property Ownership</h6>
                        <input type="text" class="form-control" name="data[prop_ownership]" id="prop_ownership" value="<?=$dbProperty_detail[0]['prop_ownership'] ?? ""?>" placeholder="Property Ownership">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Type of flooring</h6>
                        <input type="text" class="form-control" name="data[flooring_type]" id="flooring_type" value="<?=$dbProperty_detail[0]['flooring_type'] ?? ""?>" placeholder="Type of flooring">
                        <br>
                        <br>
                      </div>
                      <?php $facing = $dbProperty_detail[0]['facing'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Facing</h6>
                        <select class="form-control" name="data[facing]" id="facing">
                          <option value="">Select</option>
                          <option value="East" <?=($facing=='East')?'selected':''?>> East</option>
                          <option value="West" <?=($facing=='West')?'selected':''?>> West</option>
                          <option value="North" <?=($facing=='North')?'selected':''?>> North</option>
                          <option value="South" <?=($facing=='South')?'selected':''?>> South</option>
                          <option value="North-East" <?=($facing=='North-East')?'selected':''?>> North-East</option>
                          <option value="South-East" <?=($facing=='South-East')?'selected':''?>> South-East</option>
                          <option value="South-West" <?=($facing=='South-West')?'selected':''?>> South-West</option>
                          <option value="North-West" <?=($facing=='South')?'selected':''?>> North-West</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $no_of_lift = $dbProperty_detail[0]['no_of_lift'] ?? "";?>
                      <div class="col-md-4">
                        <h6>No. of lifts per block</h6>
                        <select class="form-control" name="data[no_of_lift]" id="no_of_lift">
                          <option value="">Select</option>
                          <?php for($i=0;$i<10;$i++){?>
                          <option value="<?=$i?>" <?=($no_of_lift==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $no_of_bedrooms = $dbProperty_detail[0]['no_of_bedrooms'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Sq. Feet Area</h6>
                        <select class="form-control" name="data[no_of_bedrooms]" id="no_of_bedrooms">
                          <option value="">Select</option>
                          <option value="100 - 300 sq. ft" <?=($no_of_bedrooms=='100 - 300 sq. ft')?'selected':''?>>100 - 300 sq. ft</option>
                          <option value="300 - 600 sq. ft" <?=($no_of_bedrooms=='300 - 600 sq. ft')?'selected':''?>>300 - 600 sq. ft</option>
                          <option value="600 - 1000 sq. ft" <?=($no_of_bedrooms=='600 - 1000 sq. ft')?'selected':''?>>600 - 1000 sq. ft</option>
                          <option value="1000 - 1500 sq. ft" <?=($no_of_bedrooms=='1000 - 1500 sq. ft')?'selected':''?>>1000 - 1500 sq. ft</option>
                          <option value="1500 - 2000 sq. ft" <?=($no_of_bedrooms=='1500 - 2000 sq. ft')?'selected':''?>>1500 - 2000 sq. ft</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $no_of_bathrooms = $dbProperty_detail[0]['no_of_bathrooms'] ?? "";?>
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
                      <?php $no_of_balconies = $dbProperty_detail[0]['no_of_balconies'] ?? "";?>
                      <div class="col-md-4">
                        <h6>No of Work Stations</h6>
                        <select class="form-control" name="data[no_of_balconies]" id="no_of_balconies">
                          <option value="">Select</option>
                          <?php for($i=0;$i<20;$i++){?>
                          <option value="<?=$i?>" <?=($no_of_balconies==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $no_of_open_sides = $dbProperty_detail[0]['no_of_open_sides'] ?? "";?>
                      <div class="col-md-4">
                        <h6>No of open sides</h6>
                        <select class="form-control" name="data[no_of_open_sides]" id="no_of_open_sides">
                          <option value="">Select</option>
                          <?php for($i=0;$i<30;$i++){?>
                          <option value="<?=$i?>" <?=($no_of_open_sides==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $kitchen_detail = $dbProperty_detail[0]['kitchen_detail'] ?? "";?>
                      <div class="col-md-4">
                        <h6>No of Cabins </h6>
                        <select class="form-control" name="data[kitchen_detail]" id="kitchen_detail">
                          <option value="">Select</option>
                          <?php for($i=0;$i<30;$i++){?>
                          <option value="<?=$i?>" <?=($kitchen_detail==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $furniture_detail = $dbProperty_detail[0]['furniture_detail'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Furniture details of property</h6>
                        <select class="form-control" name="data[furniture_detail]" id="furniture_detail">
                          <option value="">Select</option>
                          <option value="Fully Furnished" <?=($furniture_detail=='Fully Furnished')?'selected':''?>>Fully Furnished</option>
                          <option value="Semi Furnished" <?=($furniture_detail=='Semi Furnished')?'selected':''?>>Semi Furnished</option>
                          <option value="Not Furnished" <?=($furniture_detail=='Not Furnished')?'selected':''?>>Not Furnished</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $age_of_property = $dbProperty_detail[0]['age_of_property'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Age of Property</h6>
                        <select class="form-control" name="data[age_of_property]" id="age_of_property">
                          <option value="">Select</option>
                          <option value="Under Construction" <?=($age_of_property=='Under Construction')?'selected':''?>>Under Construction</option>
                          <option value="0-1 Year" <?=($age_of_property=='0-1 Year')?'selected':''?>>0-1 Year</option>
                          <?php for($i=1;$i<51;$i++){?>
                          <option value="<?=$i?>" <?=($age_of_property==$i)?'selected':''?>>
                          <?=$i?>
                          Years</option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $power_supply = $dbProperty_detail[0]['power_supply'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Power Supply</h6>
                        <select class="form-control" name="data[power_supply]" id="power_supply">
                          <option value="">Select</option>
                          <option value="24 Hours" <?=($power_supply=='24 Hours')?'selected':''?>> 24 Hours</option>
                          <option value="Rare power cut" <?=($power_supply=='Rare power cut')?'selected':''?>> Rare power cut</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $security_guards = $dbProperty_detail[0]['security_guards'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Security Guards</h6>
                        <select class="form-control" name="data[security_guards]" id="security_guards">
                          <option value="">Select</option>
                          <option value="Yes" <?=($security_guards=='Yes')?'selected':''?>> Yes</option>
                          <option value="No" <?=($security_guards=='No')?'selected':''?>> No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $camera = $dbProperty_detail[0]['camera'] ?? "";?>
                      <div class="col-md-4">
                        <h6>CCTV Camera</h6>
                        <select class="form-control" name="data[camera]" id="camera">
                          <option value="">Select</option>
                          <option value="Yes" <?=($camera=='Yes')?'selected':''?>> Yes</option>
                          <option value="No" <?=($camera=='No')?'selected':''?>> No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $fire_avai = $dbProperty_detail[0]['fire_avai'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Fire fighting availability</h6>
                        <select class="form-control" name="data[fire_avai]" id="fire_avai">
                          <option value="">Select</option>
                          <option value="Yes" <?=($fire_avai=='Yes')?'selected':''?>> Yes</option>
                          <option value="No" <?=($fire_avai=='No')?'selected':''?>> No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $water_supply = $dbProperty_detail[0]['water_supply'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Water supply timings</h6>
                        <select class="form-control" name="data[water_supply]" id="water_supply" onChange="specifyTiming(this.value);">
                          <option value="">Select</option>
                          <option value="24 Hours" <?=($water_supply=='24 Hours')?'selected':''?>> 24 Hours</option>
                          <option value="specify Timing" <?=($water_supply=='specify Timing')?'selected':''?>> specify Timing</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4" id="userdiv" style="display:none;">
                        <h6>Enter specify Timing</h6>
                        <input type="text" name="data[water_timing]" class="form-control">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Road Width near entrance of building</h6>
                        <input type="text" class="form-control" name="data[road_width]" id="road_width" placeholder="Road Width near entrance of building" value="<?=$dbProperty_detail[0]['road_width'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <?php $parking_detail = $dbProperty_detail[0]['parking_detail'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Parking details</h6>
                        <select class="form-control" name="data[parking_detail]" id="parking_detail">
                          <option value="">Select</option>
                          <option value="Common" <?=($parking_detail=='Common')?'selected':''?>> Common</option>
                          <option value="Reserved" <?=($parking_detail=='Reserved')?'selected':''?>> Reserved</option>
                        </select>
                         <?php $parkingdetail = $dbProperty_detail[0]['parkingdetail'] ?? "";?>
                         
                        <select class="form-control" name="data[parkingdetail]"  id="parkingdetail">
                          <option value="">Select</option>
                         <option value="Basement Parking" <?=($parkingdetail=='Basement Parking')?'selected':''?>> Basement parking</option>
                          <option value="Ground Level Parking" <?=($parkingdetail=='Ground Level Parking')?'selected':''?>> Ground level parking</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $gas_supply = $dbProperty_detail[0]['gas_supply'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Lease Period</h6>
                        <select class="form-control" name="data[gas_supply]" id="gas_supply">
                          <option value="">Select</option>
                          <option value="0-1 Year" <?=($gas_supply=='0-1 Year')?'selected':''?>>0-1 Year</option>
                          <?php for($i=1;$i<51;$i++){?>
                          <option value="<?=$i?>" <?=($gas_supply==$i)?'selected':''?>>
                          <?=$i?>
                          Years</option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Other Amenities of the Project</h6>
                        <?php  

								$ameni = $dbProperty_detail[0]['amenities'] ?? "";

						 		$amenities = explode(',', $ameni);

							?>
                        <select class="mdb-select form-control btn-default" id="example-getting-started1" multiple="multiple" name="amenities[]">
                          <?php for($i=0;$i<count((array)$dbAmenities);$i++){?>
                          <option value="<?=$dbAmenities[$i]['amenities']?>" <?=(in_array($dbAmenities[$i]['amenities'],$amenities))?'selected':''?>>
                          <?=$dbAmenities[$i]['amenities']?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Please specify other Amenities</h6>
                        <input type="text" class="form-control" name="amenity" id="amenity" value="<?=$dbProperty_detail[0]['otheramenities'] ?? ""?>" placeholder="Please specify other Amenities">
                        <span style="color:#F00">Use "," to seperate each amenity.</span> <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Availability of the client (Day and Time)</h6>
                        <input type="text" class="form-control" name="data[client_avail]" id="client_avail" placeholder="Availability of the client (Day and Time)">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-12">
                        <h6>Details of furniture and appliances</h6>
                        <div>Stove  &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_stove]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_stove'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Wordrobe &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_wordrobe]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_wordrobe'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          AC &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_ac]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_ac'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Bed &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_bed]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_bed'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Chimney &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_chimney]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_chimney'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Curtains &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_curtains]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_curtains'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Dining Table &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_dtable]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_dtable'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Geyser &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_gyeser]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_gyeser'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;</div>
                        <br>
                        <div> Modular Kitchen &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[appl_mkitchen]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['appl_mkitchen'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Microwave &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_microwave]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_microwave'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Sofa &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_sofa]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_sofa'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Fridge &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_fridge]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_fridge'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          TV &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_tv]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_tv'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Washing Machine &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_wmachine]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_wmachine'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Water Purifier &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_waterp]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_waterp'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp;
                          
                          Other &nbsp;&nbsp;&nbsp;
                          <input type="text" name="adata[app_other]" id="appliances" style="width:3%;" value="<?=$dbAppliances[0]['app_other'] ?? ""?>">
                          &nbsp;&nbsp;&nbsp; </div>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-12">
                        <?php

                      $overlookingval = str_replace("'",'',$dbProperty_detail[0]['overlooking'] ?? "");

					  $overLookingvalarray = explode(',',$overlookingval);

					  ?>
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
                      <div class="col-md-12">
                        <?php

                      $somefeaturesval = str_replace("'",'',$dbProperty_detail[0]['some_features'] ?? "");

					  $someFeaturesvalarray = explode(',',$somefeaturesval);

					  ?>
                        <h6>Some features about your property</h6>
                        <input type="checkbox" name="some_features[]" id="some_features" value="In a gated society" <?=(in_array('In a gated society',$someFeaturesvalarray))?'checked':''?>>
                        In a gated society &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="some_features[]" id="some_features" value="Corner Property" <?=(in_array('Corner Property',$someFeaturesvalarray))?'checked':''?>>
                        Corner Property &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="some_features[]" id="some_features" value="Pet Friendly" <?=(in_array('Pet Friendly',$someFeaturesvalarray))?'checked':''?>>
                        Pet Friendly &nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="some_features[]" id="some_features" value="Wheelchair Friendly" <?=(in_array('Wheelchair Friendly',$someFeaturesvalarray))?'checked':''?>>
                        Wheelchair Friendly &nbsp;&nbsp;&nbsp; <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row accordion" id="accordion5">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion5" href="#collapseFive">Furniture Detail <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseFive" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-4">
                        <h6>Wardrobe</h6>
                        <select class="form-control" name="data[wardrobe]">
                          <option value="">Select</option>
                          <?php for($i=1;$i<11;$i++){?>
                          <option value="<?=$i?>" <?=($dbProperty_detail[0]['wardrobe']==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Beds</h6>
                        <select class="form-control" name="data[beds]">
                          <option value="">Select</option>
                          <?php for($i=1;$i<11;$i++){?>
                          <option value="<?=$i?>" <?=($dbProperty_detail[0]['beds']==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Fans</h6>
                        <select class="form-control" name="data[fans]">
                          <option value="">Select</option>
                          <?php for($i=1;$i<11;$i++){?>
                          <option value="<?=$i?>" <?=($dbProperty_detail[0]['fans']==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Light</h6>
                        <select class="form-control" name="data[light]">
                          <option value="">Select</option>
                          <?php for($i=1;$i<11;$i++){?>
                          <option value="<?=$i?>" <?=($dbProperty_detail[0]['light']==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $m_kitchen = $dbProperty_detail[0]['m_kitchen'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Modular Kitchen</h6>
                        <select class="form-control" name="data[m_kitchen]">
                          <option value="">Select</option>
                          <option value="Yes" <?=($m_kitchen=='Yes')?'selected':''?>>Yes</option>
                          <option value="No" <?=($m_kitchen=='No')?'selected':''?>>No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $fridge = $dbProperty_detail[0]['fridge'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Fridge</h6>
                        <select class="form-control" name="data[fridge]">
                          <option value="">Select</option>
                          <option value="Yes" <?=($fridge=='Yes')?'selected':''?>>Yes</option>
                          <option value="No" <?=($fridge=='No')?'selected':''?>>No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $ac = $dbProperty_detail[0]['ac'] ?? "";?>
                      <div class="col-md-4">
                        <h6>AC</h6>
                        <select class="form-control" name="data[ac]">
                          <option value="">Select</option>
                          <?php for($i=1;$i<11;$i++){?>
                          <option value="<?=$i?>" <?=($ac==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $geyser = $dbProperty_detail[0]['geyser'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Geyser</h6>
                        <select class="form-control" name="data[geyser]">
                          <option value="">Select</option>
                          <?php for($i=1;$i<11;$i++){?>
                          <option value="<?=$i?>" <?=($geyser==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $tv = $dbProperty_detail[0]['tv'] ?? "";?>
                      <div class="col-md-4">
                        <h6>TV</h6>
                        <select class="form-control" name="data[tv]">
                          <option value="">Select</option>
                          <?php for($i=1;$i<11;$i++){?>
                          <option value="<?=$i?>" <?=($tv==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $stove = $dbProperty_detail[0]['stove'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Stove</h6>
                        <select class="form-control" name="data[stove]">
                          <option value="">Select</option>
                          <option value="Yes" <?=($stove=='Yes')?'selected':''?>>Yes</option>
                          <option value="No" <?=($stove=='No')?'selected':''?>>No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $washing_machine = $dbProperty_detail[0]['washing_machine'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Washing Machine</h6>
                        <select class="form-control" name="data[washing_machine]">
                          <option value="">Select</option>
                          <option value="Yes" <?=($washing_machine=='Yes')?'selected':''?>>Yes</option>
                          <option value="No" <?=($washing_machine=='No')?'selected':''?>>No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $water_purifier = $dbProperty_detail[0]['water_purifier'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Water Purifier</h6>
                        <select class="form-control" name="data[water_purifier]">
                          <option value="">Select</option>
                          <option value="Yes" <?=($water_purifier=='Yes')?'selected':''?>>Yes</option>
                          <option value="No" <?=($water_purifier=='No')?'selected':''?>>No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $microwave = $dbProperty_detail[0]['microwave'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Microwave</h6>
                        <select class="form-control" name="data[microwave]">
                          <option value="">Select</option>
                          <option value="Yes" <?=($microwave=='Yes')?'selected':''?>>Yes</option>
                          <option value="No" <?=($microwave=='No')?'selected':''?>>No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $curtains = $dbProperty_detail[0]['curtains'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Curtains</h6>
                        <select class="form-control" name="data[curtains]">
                          <option value="">Select</option>
                          <option value="Yes" <?=($curtains=='Yes')?'selected':''?>>Yes</option>
                          <option value="No" <?=($curtains=='No')?'selected':''?>>No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $chimney = $dbProperty_detail[0]['chimney'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Chimney</h6>
                        <select class="form-control" name="data[chimney]">
                          <option value="">Select</option>
                          <option value="Yes" <?=($chimney=='Yes')?'selected':''?>>Yes</option>
                          <option value="No" <?=($chimney=='No')?'selected':''?>>No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $exhaust_fan = $dbProperty_detail[0]['exhaust_fan'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Exhaust Fan</h6>
                        <select class="form-control" name="data[exhaust_fan]">
                          <option value="">Select</option>
                          <option value="Yes" <?=($exhaust_fan=='Yes')?'selected':''?>>Yes</option>
                          <option value="No" <?=($exhaust_fan=='No')?'selected':''?>>No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $sofa = $dbProperty_detail[0]['sofa'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Sofa</h6>
                        <select class="form-control" name="data[sofa]">
                          <option value="">Select</option>
                          <option value="Yes" <?=($sofa=='Yes')?'selected':''?>>Yes</option>
                          <option value="No" <?=($sofa=='No')?'selected':''?>>No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <?php $dinning_table = $dbProperty_detail[0]['dinning_table'] ?? "";?>
                      <div class="col-md-4">
                        <h6>Dinning Table</h6>
                        <select class="form-control" name="data[dinning_table]">
                          <option value="">Select</option>
                          <option value="Yes" <?=($dinning_table=='Yes')?'selected':''?>>Yes</option>
                          <option value="No" <?=($dinning_table=='No')?'selected':''?>>No</option>
                        </select>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row accordion" id="accordion6">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion6" href="#collapseSix">Superbuilt up area of Property <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseSix" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-4">
                        <h6>Plot Area</h6>
                        <input type="text" class="form-control" name="data[super_plot_area]" id="super_plot_area" placeholder="Plot Area" value="<?=$dbProperty_detail[0]['super_plot_area'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <?php $super_plot_area_unit = $dbProperty_detail[0]['super_plot_area_unit'] ?? "";?>
                      <div class="col-md-2">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[super_plot_area_unit]">
                          <option value="">Select</option>
                          <option value="Sq.Feet" <?=($super_plot_area_unit=='Sq.Feet')?'selected':''?>> Sq.Feet</option>
                          <option value="Sq.Yard" <?=($super_plot_area_unit=='Sq.Yard')?'selected':''?>> Sq.Yard</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Construction Area</h6>
                        <input type="text" class="form-control" name="data[super_con_area]" id="super_con_area" placeholder="Construction Area" value="<?=$dbProperty_detail[0]['super_con_area'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <?php $super_con_area_unit = $dbProperty_detail[0]['super_con_area_unit'] ?? "";?>
                      <div class="col-md-2">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[super_con_area_unit]">
                          <option value="">Select</option>
                          <option value="Sq.Feet" <?=($super_con_area_unit=='Sq.Feet')?'selected':''?>> Sq.Feet</option>
                          <option value="Sq.Yard" <?=($super_con_area_unit=='Sq.Yard')?'selected':''?>> Sq.Yard</option>
                        </select>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row accordion" id="accordion7">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion7" href="#collapseSeven">Carpet Area of property <i class="fa accrd-controller fa-caret-down pull-right"> </i></a>
                  <div id="collapseSeven" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-4">
                        <h6>Plot Area</h6>
                        <input type="text" class="form-control" name="data[carpet_plot_area]" id="carpet_plot_area" placeholder="Plot Area" value="<?=$dbProperty_detail[0]['carpet_plot_area'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <?php $carpet_plot_area_unit = $dbProperty_detail[0]['carpet_plot_area_unit'] ?? "";?>
                      <div class="col-md-2">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[carpet_plot_area_unit]">
                          <option value="">Select</option>
                          <option value="Sq.Feet" <?=($carpet_plot_area_unit=='Sq.Feet')?'selected':''?>> Sq.Feet</option>
                          <option value="Sq.Yard" <?=($carpet_plot_area_unit=='Sq.Yard')?'selected':''?>> Sq.Yard</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4">
                        <h6>Construction Area</h6>
                        <input type="text" class="form-control" name="data[carpet_con_area]" id="carpet_con_area" placeholder="Construction Area" value="<?=$dbProperty_detail[0]['carpet_con_area'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <?php $carpet_con_area_unit = $dbProperty_detail[0]['carpet_con_area_unit'] ?? "";?>
                      <div class="col-md-2">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[carpet_con_area_unit]">
                          <option value="">Select</option>
                          <option value="Sq.Feet" <?=($carpet_con_area_unit=='Sq.Feet')?'selected':''?>> Sq.Feet</option>
                          <option value="Sq.Yard" <?=($carpet_con_area_unit=='Sq.Yard')?'selected':''?>> Sq.Yard</option>
                        </select>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php if($for_property=='Sell'){?>
            <div class="row accordion" id="accordion8">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion8" href="#collapseEight">For Sell <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseEight" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-5">
                        <h6>Offer Price (In Rupees) For Sell</h6>
                        <input type="text" class="form-control" name="data[offer_price]" id="offer_price" placeholder="Offer Price (In Rupees) For Sell" value="<?=$dbProperty_detail[0]['offer_price'] ?? ""?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $offer_price_unit = $dbProperty_detail[0]['offer_price_unit'] ?? "";?>
                      <div class="col-md-3">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[offer_price_unit]" id="offer_price_unit">
                          <option value="">Select</option>
                          <option value="Thousand" <?=($offer_price_unit=='Thousand')?'selected':''?>> Thousand</option>
                          <option value="Lacs" <?=($offer_price_unit=='Lacs')?'selected':''?>>Lacs</option>
                          <option value="Crores" <?=($offer_price_unit=='Crores')?'selected':''?>> Crores</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4" style="text-align:left;">
                        <h6>Price on request</h6>
                         <input type="checkbox"  name="pricerequest" id="pricerequest"   value="1" <?=(!empty($dbProperty_detail[0]['pricerequest']))?'checked':''?>>
                       
                      </div>
                      <div class="col-md-6">
                        <h6>Maintenence Charges</h6>
                        <input type="text" class="form-control" name="main_charges" id="main_charges" placeholder="Maintenence Charges (In Rupees)" value="<?=$dbProperty_detail[0]['main_charges'] ?? ""?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $main_charges_unit = $dbProperty_detail[0]['main_charges_unit'] ?? "";?>
                      <div class="col-md-6">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[main_charges_unit]" id="main_charges_unit">
                          <option value="">Select</option>
                          <option value="Monthly" <?=($main_charges_unit=='Monthly')?'selected':''?>> Monthly</option>
                          <option value="Annually" <?=($main_charges_unit=='Annually')?'selected':''?>>Annually</option>
                         </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-12">
                        <h6>Google Map Embed code </h6>
                        <textarea class="form-control" name="sell_google_map"><?=$dbProperty_detail[0]['google_map'] ?? ""?>
</textarea>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }elseif(empty($for_property)){?>
            <div class="row accordion" id="accordion8">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion8" href="#collapseEight">For Sell <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseEight" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-5">
                        <h6>Offer Price (In Rupees) For Sell</h6>
                        <input type="text" class="form-control" name="data[offer_price]" id="offer_price" placeholder="Offer Price (In Rupees) For Sell" value="<?=$dbProperty_detail[0]['offer_price'] ?? ""?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $offer_price_unit = $dbProperty_detail[0]['offer_price_unit'] ?? "";?>
                      <div class="col-md-3">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[offer_price_unit]" id="offer_price_unit">
                          <option value="">Select</option>
                          <option value="Thousand" <?=($offer_price_unit=='Thousand')?'selected':''?>> Thousand</option>
                          <option value="Lacs" <?=($offer_price_unit=='Lacs')?'selected':''?>>Lacs</option>
                          <option value="Crores" <?=($offer_price_unit=='Crores')?'selected':''?>> Crores</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4" style="text-align:left;">
                        <h6>Price on request</h6>
                         <input type="checkbox"  name="pricerequest" id="pricerequest"   value="1" <?=(!empty($dbProperty_detail[0]['pricerequest']))?'checked':''?>>
                       
                      </div>
                      <div class="col-md-6">
                        <h6>Maintenence Charges</h6>
                        <input type="text" class="form-control" name="main_charges" id="main_charges" placeholder="Maintenence Charges (In Rupees)" value="<?=$dbProperty_detail[0]['main_charges'] ?? ""?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $main_charges_unit = $dbProperty_detail[0]['main_charges_unit'] ?? "";?>
                      <div class="col-md-6">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[main_charges_unit]" id="main_charges_unit">
                          <option value="">Select</option>
                          <option value="Monthly" <?=($main_charges_unit=='Monthly')?'selected':''?>> Monthly</option>
                          <option value="Annually" <?=($main_charges_unit=='Annually')?'selected':''?>>Annually</option>
                         </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-12">
                        <h6>Google Map Embed code </h6>
                        <textarea class="form-control" name="sell_google_map"><?=$dbProperty_detail[0]['google_map'] ?? ""?></textarea>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>
            <?php if($for_property=='Rent'){?>
            <div class="row accordion" id="accordion9">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion9" href="#collapseNine">For Rent <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseNine" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-5">
                        <h6>Expected rent of property per month</h6>
                        <input type="text" class="form-control" name="data[expected_rent]" id="expected_rent" placeholder="Expected rent of property per month" value="<?=$dbProperty_detail[0]['expected_rent'] ?? ""?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $expected_rent_unit = $dbProperty_detail[0]['expected_rent_unit'] ?? "";?>
                      <div class="col-md-3">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[expected_rent_unit]" id="expected_rent_unit">
                          <option value="">Select</option>
                          <option value="Thousand" <?=($expected_rent_unit=='Thousand')?'selected':''?>> Thousand</option>
                          <option value="Lacs" <?=($expected_rent_unit=='Lacs')?'selected':''?>>Lacs</option>
                          <option value="Crores" <?=($expected_rent_unit=='Crores')?'selected':''?>> Crores</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-4" style="text-align:left;">
                        <h6>Price on request</h6>
                         <input type="checkbox"  name="pricerequest" id="pricerequest"   value="1" <?=(!empty($dbProperty_detail[0]['pricerequest']))?'checked':''?>>
                       
                      </div>
                      
                      <div class="col-md-6">
                        <h6>Refundable Security deposit charges</h6>
                        <input type="text" class="form-control" name="data[rent_security]" id="rent_security" placeholder="Refundable Security deposit charges" value="<?=$dbProperty_detail[0]['rent_security'] ?? "" ?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $rent_security_unit = $dbProperty_detail[0]['rent_security_unit'] ?? "";?>
                      <div class="col-md-6">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[rent_security_unit]" id="rent_security_unit">
                          <option value="">Select</option>
                          <option value="Thousand" <?=($rent_security_unit=='Thousand')?'selected':''?>> Thousand</option>
                          <option value="Lacs" <?=($rent_security_unit=='Lacs')?'selected':''?>>Lacs</option>
                          <option value="Crores" <?=($rent_security_unit=='Crores')?'selected':''?>> Crores</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Maintenance charges per month</h6>
                        <input type="text" class="form-control" name="data[maint_charge]" id="maint_charge" placeholder="Maintenance charges per month" value="<?=$dbProperty_detail[0]['maint_charge'] ?? ""?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $maint_charge_unit = $dbProperty_detail[0]['maint_charge_unit'] ?? "";?>
                      <div class="col-md-6">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[maint_charge_unit]" id="maint_charge_unit">
                          <option value="">Select</option>
                          <option value="Thousand" <?=($maint_charge_unit=='Thousand')?'selected':''?>> Thousand</option>
                          <option value="Lacs" <?=($maint_charge_unit=='Lacs')?'selected':''?>>Lacs</option>
                          <option value="Crores" <?=($maint_charge_unit=='Crores')?'selected':''?>> Crores</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Property tax charges per month approx</h6>
                        <input type="text" class="form-control" name="data[tax_charge]" id="tax_charge" placeholder="Property tax charges per month approx" value="<?=$dbProperty_detail[0]['tax_charge'] ?? ""?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $tax_charge_unit = $dbProperty_detail[0]['tax_charge_unit'] ?? "";?>
                      <div class="col-md-6">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[tax_charge_unit]" id="tax_charge_unit">
                          <option value="">Select</option>
                          <option value="Thousand" <?=($tax_charge_unit=='Thousand')?'selected':''?>> Thousand</option>
                          <option value="Lacs" <?=($tax_charge_unit=='Lacs')?'selected':''?>>Lacs</option>
                          <option value="Crores" <?=($tax_charge_unit=='Crores')?'selected':''?>> Crores</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-12">
                        <h6>Other charges please specify</h6>
                        <textarea class="form-control" name="data[other_charge]" id="other_charge"><?=$dbProperty_detail[0]['other_charge'] ?? ""?></textarea>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-12">
                        <h6>Google Map Embed code </h6>
                        <textarea class="form-control" name="rent_google_map"><?=$dbProperty_detail[0]['google_map'] ?? ""?></textarea>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }elseif(empty($for_property)){?>
            <div class="row accordion" id="accordion9">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion9" href="#collapseNine">For Rent <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseNine" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Expected rent of property per month</h6>
                        <input type="text" class="form-control" name="data[expected_rent]" id="expected_rent" placeholder="Expected rent of property per month" value="<?=$dbProperty_detail[0]['expected_rent'] ?? ""?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $expected_rent_unit = $dbProperty_detail[0]['expected_rent_unit'] ?? "";?>
                      <div class="col-md-6">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[expected_rent_unit]" id="expected_rent_unit">
                          <option value="">Select</option>
                          <option value="Thousand" <?=($expected_rent_unit=='Thousand')?'selected':''?>> Thousand</option>
                          <option value="Lacs" <?=($expected_rent_unit=='Lacs')?'selected':''?>>Lacs</option>
                          <option value="Crores" <?=($expected_rent_unit=='Crores')?'selected':''?>> Crores</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Refundable Security deposit charges</h6>
                        <input type="text" class="form-control" name="data[rent_security]" id="rent_security" placeholder="Refundable Security deposit charges" value="<?=$dbProperty_detail[0]['rent_security'] ?? ""?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $rent_security_unit = $dbProperty_detail[0]['rent_security_unit'] ?? "";?>
                      <div class="col-md-6">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[rent_security_unit]" id="rent_security_unit">
                          <option value="">Select</option>
                          <option value="Thousand" <?=($rent_security_unit=='Thousand')?'selected':''?>> Thousand</option>
                          <option value="Lacs" <?=($rent_security_unit=='Lacs')?'selected':''?>>Lacs</option>
                          <option value="Crores" <?=($rent_security_unit=='Crores')?'selected':''?>> Crores</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Maintenance charges per month</h6>
                        <input type="text" class="form-control" name="data[maint_charge]" id="maint_charge" placeholder="Maintenance charges per month" value="<?=$dbProperty_detail[0]['maint_charge'] ?? ""?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $maint_charge_unit = $dbProperty_detail[0]['maint_charge_unit'] ?? "";?>
                      <div class="col-md-6">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[maint_charge_unit]" id="maint_charge_unit">
                          <option value="">Select</option>
                          <option value="Thousand" <?=($maint_charge_unit=='Thousand')?'selected':''?>> Thousand</option>
                          <option value="Lacs" <?=($maint_charge_unit=='Lacs')?'selected':''?>>Lacs</option>
                          <option value="Crores" <?=($maint_charge_unit=='Crores')?'selected':''?>> Crores</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Property tax charges per month approx</h6>
                        <input type="text" class="form-control" name="data[tax_charge]" id="tax_charge" placeholder="Property tax charges per month approx" value="<?=$dbProperty_detail[0]['tax_charge'] ?? ""?>">
                        <span style="color:#F00">In Digit</span> <br>
                        <br>
                      </div>
                      <?php $tax_charge_unit = $dbProperty_detail[0]['tax_charge_unit'] ?? "";?>
                      <div class="col-md-6">
                        <h6>Unit</h6>
                        <select class="form-control" name="data[tax_charge_unit]" id="tax_charge_unit">
                          <option value="">Select</option>
                          <option value="Thousand" <?=($tax_charge_unit=='Thousand')?'selected':''?>> Thousand</option>
                          <option value="Lacs" <?=($tax_charge_unit=='Lacs')?'selected':''?>>Lacs</option>
                          <option value="Crores" <?=($tax_charge_unit=='Crores')?'selected':''?>> Crores</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-12">
                        <h6>Other charges please specify</h6>
                        <textarea class="form-control" name="data[other_charge]" id="other_charge"><?=$dbProperty_detail[0]['other_charge'] ?? ""?></textarea>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-12">
                        <h6>Google Map Embed code </h6>
                        <textarea class="form-control" name="rent_google_map"><?=$dbProperty_detail[0]['google_map'] ?? ""?></textarea>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>
            <!--<div class="row accordion" id="accordion10">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion10" href="#collapseTen">Nearby Localities <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseTen" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>School</h6>
                        <input type="text" class="form-control" name="data[school]" id="school" placeholder="School" value="<?=$dbProperty_detail[0]['school'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>College</h6>
                        <input type="text" class="form-control" name="data[college]" id="college" placeholder="College" value="<?=$dbProperty_detail[0]['college'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Hospital</h6>
                        <input type="text" class="form-control" name="data[hospital]" id="hospital" placeholder="Hospital" value="<?=$dbProperty_detail[0]['hospital'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Banks</h6>
                        <input type="text" class="form-control" name="data[bank]" id="bank" placeholder="Banks" value="<?=$dbProperty_detail[0]['bank'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>--> 
            <!--<div class="row accordion" id="accordion11">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion11" href="#collapseEleven">Public transport details <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseEleven" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>Near by BRTS stop</h6>
                        <input type="text" class="form-control" name="data[brts_stop]" id="brts_stop" placeholder="Near by BRTS stop" value="<?=$dbProperty_detail[0]['brts_stop'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Near by Railway Station</h6>
                        <input type="text" class="form-control" name="data[r_station]" id="r_station" placeholder="Near by Railway Station" value="<?=$dbProperty_detail[0]['r_station'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Near by metro station</h6>
                        <input type="text" class="form-control" name="data[m_station]" id="m_station" placeholder="Near by metro station" value="<?=$dbProperty_detail[0]['m_station'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Near by Airport</h6>
                        <input type="text" class="form-control" name="data[airport]" id="airport" placeholder="Near by Airport" value="<?=$dbProperty_detail[0]['airport'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>--> 
            <!--<div class="row accordion" id="accordion12">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion12" href="#collapseTwelve">Upload Brochure <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseTwelve" class="card-body collapse font-13" data-parent="#accordion">
                    <div class="row">
                      <div class="col-md-12">
                        <h6>Upload Brochure</h6>
                        <?php if(!empty($dbProperty_detail[0]['brochure'])) {?>
                        <a href="../cms_images/property/brochure/<?=$dbProperty_detail[0]['brochure']?>" style="color:#00F;"> Download</a>
                        <?php } ?>
                        <input type="file" class="form-control" name="brochure" id="brochure">
                        <p style="font-size:12px;color:#F00;margin-top:5px;">Doc / Pdf (File Will Accept)</p>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>--> 
          </div>
          <div class="col-md-3 position-relative">
            <div>
              <div class="card" id="sidebar">
                <div class="card-body">
                  <h4 class="card-title text-uppercase">Publish Page</h4>
                  <ul class="page-publish">
                    <li>Status:
                      <?php if(!empty($dbProperty[0]['status'])){?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1" <?=($dbProperty[0]['status']==1)?'selected':''?>>Published</option>
                        <option value="0" <?=($dbProperty[0]['status']==0)?'selected':''?>>Unpublished</option>
                      </select>
                      <?php }else{?>
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                      </select>
                      <?php }?>
                    </li>
                    <li> Published on
                      <?php if(!empty($dbProperty_detail[0]['post_date'])){?>
                      <?=date('d/m/Y',strtotime($dbProperty_detail[0]['post_date']));?>
                      <?php }else{?>
                      <?=date('d/m/Y');?>
                      <?php }?>
                    </li>
                  </ul>
                  <div class="d-flex"> <a href="propertyController.php?mode=delete_single_property&id=<?=$dbProperty[0]['id']?>" data-confirm="Are you sure you want to delete?" class="btn waves-effect btn-sm waves-light btn-warning mr-auto" style="color:#fff;"> Move to trash</a>
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

<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="js/bootstrap-multiselect.css" type="text/css"/>
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

	if(isEmpty("Form No",document.getElementById("form_no").value)){
		document.getElementById("form_no").focus();
		return false;
	}

	if(isEmpty("Date",document.getElementById("prop_date").value)){
		document.getElementById("prop_date").focus();
		return false;
	}

	if(isEmpty("Property Name",document.getElementById("property_name").value)){
		document.getElementById("property_name").focus();
		return false;
	}

	if(isEmpty("Property Type",document.getElementById("property_type").value)){
		document.getElementById("property_type").focus();
		return false;
	}

	if(isEmpty("For Property",document.getElementById("for_property").value)){
		document.getElementById("for_property").focus();
		return false;
	}

	if(isEmpty("Membership",document.getElementById("membership").value)){
		document.getElementById("membership").focus();
		return false;
	}

	if(isEmpty("Project Name",document.getElementById("project_name").value)){
		document.getElementById("project_name").focus();
		return false;
	}

	if(isEmpty("State",document.getElementById("State").value)){
		document.getElementById("State").focus();
		return false;
	}

	if(isEmpty("City",document.getElementById("selectcity").value)){
		document.getElementById("selectcity").focus();
		return false;
	}

	if(isEmpty("Location",document.getElementById("selectlocation").value)){
		document.getElementById("selectlocation").focus();
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

function specifyTiming(dropval){
	if(dropval== 'specify Timing'){
		document.getElementById('userdiv').style.display = 'block';
	}else{
		document.getElementById('userdiv').style.display = 'none';
	}
};

function forProperty(dropval){
	if(dropval== 'Rent'){
		document.getElementById('accordion9').style.display = 'block';
		document.getElementById('accordion8').style.display = 'none';
	} else if(dropval== 'Sell'){
		document.getElementById('accordion9').style.display = 'none';
		document.getElementById('accordion8').style.display = 'block';
	}/*else{
		document.getElementById('accordion9').style.display = 'none';
		document.getElementById('accordion8').style.display = 'block';
	}*/
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