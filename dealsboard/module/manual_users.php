<?php
login_check(); ///to check weatther user is login or not
access_check('manual_users');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$sort_order = $dbObj->sc_mysql_escape($_REQUEST['sort_order'] ?? "");
$stateID = $dbObj->sc_mysql_escape($_REQUEST['stateID'] ?? "");
$cityID = $dbObj->sc_mysql_escape($_REQUEST['cityID'] ?? "");
$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id'] ?? "");
$for_property = $dbObj->sc_mysql_escape($_REQUEST['for_property'] ?? "");
$property_type = $dbObj->sc_mysql_escape($_REQUEST['property_type'] ?? "");
$prop_state = $dbObj->sc_mysql_escape($_REQUEST['prop_state'] ?? "");
$prop_city = $dbObj->sc_mysql_escape($_REQUEST['prop_city'] ?? "");
$location = $dbObj->sc_mysql_escape($_REQUEST['location'] ?? "");
$locationname = $dbObj->sc_mysql_escape($_REQUEST['locationname'] ?? "");
$bedroom = $dbObj->sc_mysql_escape($_REQUEST['bedroom'] ?? "");
$bathroom = $dbObj->sc_mysql_escape($_REQUEST['bathroom'] ?? "");
$s_price = $dbObj->sc_mysql_escape($_REQUEST['s_price'] ?? "");
$e_price = $dbObj->sc_mysql_escape($_REQUEST['e_price'] ?? "");	

$dbObj->dbQuery="select * from ".PREFIX."property where id='".$property_id."'"; // for listing of records
$dbProperty = $dbObj->SelectQuery();

$searchtext = "&property_id=".$property_id."&for_property=".$for_property."&property_type=".$property_type."&prop_state=".$prop_state."&prop_city=".$prop_city."&locationname".$locationname."&bedroom=".$bedroom."&bathroom=".$bathroom."&s_price=".$s_price."&e_price=".$e_price;

$var_extra = "manual_users".$searchtext; // to enable page link
//$sortLink = "services";// to get sort result of text of search
if(!empty($sort_order)){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "id asc"; // default sort by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."manual_users where status='1'"; // for total number of records for paging

if(!empty($for_property)){
	$dbObj->dbQuery.=" and for_property='".$for_property."'";	
}

if(!empty($property_type)){
	$dbObj->dbQuery.=" and property_type='".$property_type."'";	
}

if(!empty($prop_state)){
	$dbObj->dbQuery.=" and prop_state='".$prop_state."'";	
}
if(!empty($prop_city)){
	$dbObj->dbQuery.=" and prop_city='".$prop_city."'";	
}
/*if(!empty($locationname) && strlen($locationname)>3){
	$dbObj->dbQuery.=" and location in (".$locationname.")";	
}*/
if(!empty($locationname)){
	$dbObj->dbQuery.=" and location='".$locationname."'";	
}
if(!empty($bedroom)){
	$dbObj->dbQuery.=" and bedroom='".$bedroom."'";		
}
if(!empty($bathroom)){
	$dbObj->dbQuery.=" and bathroom='".$bathroom."'";		
}
if(!empty($s_price) && !empty($e_price)){
	$dbObj->dbQuery.=" and  (price>=$s_price and price<=$e_price)";
}

//echo $dbObj->dbQuery;exit;
$dbResult = $dbObj->SelectQuery();
$totalrecords = $dbResult[0]["total"] ?? "";
  
require_once(PHP_FUNCTION_DIR.'admin-paging.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."manual_users where status='1'"; // for listing of records

if(!empty($for_property)){
	$dbObj->dbQuery.=" and for_property='".$for_property."'";	
}

if(!empty($property_type)){
	$dbObj->dbQuery.=" and property_type='".$property_type."'";	
}

if(!empty($prop_state)){
	$dbObj->dbQuery.=" and prop_state='".$prop_state."'";	
}
if(!empty($prop_city)){
	$dbObj->dbQuery.=" and prop_city='".$prop_city."'";	
}
if(!empty($locationname)){
	$dbObj->dbQuery.=" and location='".$locationname."'";	
}
if(!empty($bedroom)){
	$dbObj->dbQuery.=" and bedroom='".$bedroom."'";		
}
if(!empty($bathroom)){
	$dbObj->dbQuery.=" and bathroom='".$bathroom."'";		
}
if(!empty($s_price) && !empty($e_price)){
	$dbObj->dbQuery.=" and  (price>=$s_price and price<=$e_price)";
}

$dbObj->dbQuery.=" group by mobile_no order by $sort $page_limit";
$dbManualUsers = $dbObj->SelectQuery('slider.php','slider_images()');

$dbObj->dbQuery="select * from ".PREFIX."state where status='1' order by display_order";
$dbState = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."location  where city='".$prop_city."'";
$Location = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."city where status='1'";
$dbCity = $dbObj->SelectQuery();
?>
<style>
#contentLeft {
	width: 100%;
}
#contentLeft li {
	list-style: none;
}
#move {
	cursor: move;
}
.boder-table {
	border-bottom: solid 1px #a3a0a0;
}
.table-left {
	border-right: solid 1px #a3a0a0;
}
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
      <form action="manualuserController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="search_users" />
        <input type="hidden" name="property_id" value="<?=$property_id?>" />
        <div class="row" id="main">
          <div class="col-md-12" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Manage Manual Users :
                  <?=$dbProperty[0]['property_name'] ?? ""?>
                  <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <div class="row">
                      <div class="col-md-3">
                        <h6>For Property</h6>
                        <select name="for_property" id="for_property" class="form-control">
                          <option value="">For Property</option>
                          <option value="Sell" <?=($for_property=='Sell')?'selected':''?>>Sell</option>
                          <option value="Rent" <?=($for_property=='Rent')?'selected':''?>>Rent</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-3">
                        <h6>Property Type</h6>
                        <select name="property_type" id="property_type" class="form-control">
                          <option value="" >Property Type</option>
                          <option value="Flat" <?=($property_type=='Flat')?'selected':''?>>Flat</option>
                          <option value="Apartment" <?=($property_type=='Apartment')?'selected':''?>>Apartment</option>
                          <option value="Tower" <?=($property_type=='Tower')?'selected':''?>>Tower</option>
                          <option value="Row House" <?=($property_type=='Row House')?'selected':''?>>Row House</option>
                          <option value="Individual Bunglow" <?=($property_type=='Individual Bunglow')?'selected':''?>> Individual Bunglow</option>
                          <option value="Twin Bunglow" <?=($property_type=='Twin Bunglow')?'selected':''?>> Twin Bunglow</option>
                          <option value="Individual Villa" <?=($property_type=='Individual Villa')?'selected':''?>> Individual Villa </option>
                          <option value="Weekend Homes" <?=($property_type=='Weekend Homes')?'selected':''?>> Weekend Homes</option>
                          <option value="Farm House" <?=($property_type=='Farm House')?'selected':''?>> Farm House</option>
                          <option value="Residential Plot" <?=($property_type=='Residential Plot')?'selected':''?>> Residential Plot </option>
                          <option value="Open Plot" <?=($property_type=='Open Plot')?'selected':''?>>Open Plot</option>
                          <option value="Pent House" <?=($property_type=='Pent House')?'selected':''?>> Pent House</option>
                          <option value="Duplex" <?=($property_type=='Duplex')?'selected':''?>>Duplex</option>
                          <option value="Tenament" <?=($property_type=='Tenament')?'selected':''?>>Tenament</option>
                        </select>
                        <br/>
                        <br>
                      </div>
                      <div class="col-md-3">
                        <h6>State</h6>
                        <select name="prop_state" id="prop_state" onChange="getstate(this.value)" class="form-control">
                          <option value="">State</option>
                          <?php for($i=0;$i<count((array)$dbState);$i++){?>
                          <option value="<?=$dbState[$i]['id']?>" <?=($prop_state==$dbState[$i]['id'])?'selected':''?>>
                          <?=$dbState[$i]['state_name']?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-3">
                        <h6>City</h6>
                        <?php if(!empty($prop_city)){?>
                        <select name="prop_city" id="selectcity" onChange="getcity(this.value)" class="form-control">
                          <option value="<?=$prop_city?>">
                          <?=$prop_city?>
                          </option>
                        </select>
                        <?php }else{?>
                        <select name="prop_city" id="selectcity" onChange="getcity(this.value)" class="form-control">
                          <option value="">City</option>
                        </select>
                        <?php }?>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-3">
                        <h6>Location</h6>
                        <?php if(!empty($prop_city)){?>
                        <select class="mdb-select form-control btn-default" style="width:100%" multiple="multiple" data-placeholder="Choose Location" name="location[]" id="example-getting-started">
                          <?php
							$locationval = str_replace("'",'',$locationname);
						  	$locationarray = explode(',',$locationval);
							?>
                          <?php for($i=0;$i<count((array)$Location);$i++){?>
                          <option value="<?=$Location[$i]['location']?>" <?=(in_array($Location[$i]['location'],$locationarray))?'selected':''?>>
                          <?=$Location[$i]['location']?>
                          </option>
                          <?php }?>
                        </select>
                        <?php }else{?>
                        <select class="mdb-select form-control btn-default" style="width:100%" multiple="multiple" data-placeholder="Choose Location" name="location[]" id="example-getting-started">
                        </select>
                        <?php }?>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-3">
                        <h6>Bedrooms</h6>
                        <select name="bedroom" id="bedroom" class="form-control">
                          <option value="" >Bedrooms</option>
                          <option value="1 RK" <?=($bedroom=='1 RK')?'selected':''?>>1 RK</option>
                          <option value="1 BHK" <?=($bedroom=='1 BHK')?'selected':''?>>1 BHK</option>
                          <option value="1.5 BHK" <?=($bedroom=='1.5 BHK')?'selected':''?>>1.5 BHK</option>
                          <option value="2 BHK" <?=($bedroom=='2 BHK')?'selected':''?>>2 BHK</option>
                          <option value="2.5 BHK" <?=($bedroom=='2.5 BHK')?'selected':''?>>2.5 BHK</option>
                          <option value="3 BHK" <?=($bedroom=='3 BHK')?'selected':''?>>3 BHK</option>
                          <option value="3.5 BHK" <?=($bedroom=='3.5 BHK')?'selected':''?>>3.5 BHK</option>
                          <option value="4 BHK" <?=($bedroom=='4 BHK')?'selected':''?>>4 BHK</option>
                          <option value="4.5 BHK" <?=($bedroom=='4.5 BHK')?'selected':''?>>4.5 BHK</option>
                          <option value="5 BHK" <?=($bedroom=='5 BHK')?'selected':''?>>5 BHK</option>
                          <option value="5 + BHK" <?=($bedroom=='5 + BHK')?'selected':''?>>5 + BHK</option>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-3">
                        <h6>Bathrooms</h6>
                        <select name="bathroom" id="bathroom" class="form-control">
                          <option value="" >Bathrooms</option>
                          <?php for($i=0;$i<16;$i++){?>
                          <option value="<?=$i?>" <?=($bathroom==$i)?'selected':''?>>
                          <?=$i?>
                          </option>
                          <?php }?>
                        </select>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-3">
                        <h6>Start Price</h6>
                        <input name="s_price" id="s_price" class="form-control"  type="text"  placeholder="Start Price" value="<?=(!empty($s_price))?$s_price:''?>"/>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-3">
                        <h6>Start Price</h6>
                        <input name="e_price" id="e_price" class="form-control"  type="text"  placeholder="Start Price" value="<?=(!empty($s_price))?$s_price:''?>"/>
                        <br>
                        <br>
                      </div>
                    </div>
                    <button type="submit" class="btn waves-effect btn-sm waves-light btn-success ml-auto">Search</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <?php if(!empty($msg)){ ?>
              <legend class="wizard-label">
              <?=$msg?>
              </legend>
              <?php } ?>
              <div class="row">
                <div class="text-left col-md-6"></div>
                <div class="col-md-6 text-right"></div>
              </div>
              <?php if(count((array)$dbManualUsers)>0){ ?>
              <form action="manualuserController.php" method="post" id="hostForm">
                <input type="hidden" name="mode" value="delete_manual_users"/>
                <input type="hidden" name="counter" id="counter" value="<?=count($dbManualUsers)?>" />
                <input type="hidden" name="property_id" value="<?=$property_id ?>" />
                <input type="hidden" name="searchdata" value="<?=base64_encode($searchtext)?>" />
                <div class="table-responsive mt-10">
                  <table id="" class="display nowrap table table-hover table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="10%">Name</th>
                        <th width="10%">Last Notification</th>
                        <th width="10%">Email</th>
                        <th width="5%">Mobile No.</th>
                        <th width="5%">For Property</th>
                        <th width="5%">Property Type</th>
                        <th width="5%">Bedroom</th>
                        <th width="5%">Bathroom</th>
                        <th width="5%">State</th>
                        <th width="5%">City</th>
                        <th width="10%">Location</th>
                        <th width="5%">Price</th>
                        <th width="5%">Action</th>
                      </tr>
                    </thead>
                    <tbody id="changes">
                      <?php for($i=0;$i<count((array)$dbManualUsers);$i++){ 
					  
					  $dbObj->dbQuery="select * from ".PREFIX."user_email where user_id='".$dbObj->sc_mysql_escape($dbManualUsers[$i]['id'])."' and type='sms'";
					  $dbUsersSMS = $dbObj->SelectQuery();
					  
					  $dbObj->dbQuery="select * from ".PREFIX."user_email where user_id='".$dbObj->sc_mysql_escape($dbManualUsers[$i]['id'])."' and type='email'";
					  $dbUsersEmail = $dbObj->SelectQuery();
					  
					  $dbObj->dbQuery="select * from ".PREFIX."state where id='".$dbObj->sc_mysql_escape($dbManualUsers[$i]['prop_state'])."'";
					  $dbPropState = $dbObj->SelectQuery();
					  ?>
                      <tr>
                        <td class="text-center" width="5%"><span id="<?=$dbManualUsers[$i]['id']?>">
                          <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbManualUsers[$i]['id']?>">
                          </span></td>
                        <td width="10%"><?=$dbManualUsers[$i]['name']?></td>
                        <td width="10%">SMS :
                          <?php if(!empty($dbUsersSMS[0]['send_date'])){?>
                          <?=date('d-m-Y', strtotime($dbUsersSMS[0]['send_date']))?>
                          <?php }?>
                          <br />
                          Email :
                          <?php if(!empty($dbUsersEmail[0]['send_date'])){?>
                          <?=date('d-m-Y', strtotime($dbUsersEmail[0]['send_date']))?>
                          <?php }?></td>
                        <td width="10%"><?=$dbManualUsers[$i]['email']?></td>
                        <td width="5%"><?=$dbManualUsers[$i]['mobile_no']?></td>
                        <td width="5%"><?=$dbManualUsers[$i]['for_property']?></td>
                        <td width="5%"><?=$dbManualUsers[$i]['property_type']?></td>
                        <td width="5%"><?=$dbManualUsers[$i]['bedroom']?></td>
                        <td width="5%"><?=$dbManualUsers[$i]['bathroom']?></td>
                        <td width="5%"><?=$dbPropState[0]['state_name'] ?? ""?></td>
                        <td width="5%"><?=$dbManualUsers[$i]['prop_city']?></td>
                        <td width="10%"><?=$dbManualUsers[$i]['location']?></td>
                        <td width="5%"><?=$dbManualUsers[$i]['price']?></td>
                        <td width="5%"><a href="index.php?mo=edit_manual_user&id=<?=$dbManualUsers[$i]['id']?>&property_id=<?=$property_id?>" class="text-primary"><i class="fa fa-edit"></i></a></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
                <div style="margin-top:10px;">
                  <button onClick="return delete_records();" name="delete" value="delete" class="btn btn-primary pull-left" type="submit"> Delete</button>
                  <button onClick="return delete_records();" name="email" value="email" class="btn btn-primary pull-left" type="submit" style="margin-left:20px;"> Send Email</button>
                  <button onClick="return delete_records();" name="sms" value="sms" class="btn btn-primary pull-left" type="submit" style="margin-left:20px;"> Send SMS</button>
                </div>
              </form>
              <div style="float:right"> <?php echo $page_link;?> </div>
              <?php }else{?>
              <p style="color:#F00;text-align:center;">No Record Found</p>
              <?php }?>
            </div>
          </div>
        </div>
      </div>
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
<!-- This is data table --> 

<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="js/bootstrap-multiselect.css" type="text/css"/>
<!--<script src="../cms_js/jquery.min.js"></script>--> 
<script type="text/javascript">
function getstate(stateID){
	 $.ajax({
			url:'manualuserController.php?mode=getcity',
			data:'stateID='+stateID,
			success:function(response){
			//alert(response);
			$('#selectcity').html(response);
		}
	});
}

function getcity(cityID){
	 $.ajax({
			url:'manualuserController.php?mode=getlocation',
			data:'cityID='+cityID,
			success:function(response){
			//alert(response);		
			$('#example-getting-started').html(response);
		}
	});
}

$(document).ready(function() {
$('#example-getting-started').multiselect({
includeSelectAllOption: true,
maxHeight: 400,
dropUp: true
});
});

function selectAll(){    
	var cnt=document.getElementById("counter").value;
	if(document.getElementById("select").checked==true){
		for( var i=0;i<cnt;i++){
			document.getElementById("c"+i).checked=true;
		}
	}
	if(document.getElementById("select").checked==false){
		for( var i=0;i<cnt;i++){
			document.getElementById("c"+i).checked=false;
		}
	}
};

function delete_records(){

	var cnt = document.getElementById("counter").value;
   	for( var i=0;i<cnt;i++){
		if(document.getElementById("c"+i).checked==true){
			var t = 1; 
			break;
		}
   }
   if( t!=1){
   		alert("Please select atleast one record.");
     	return false;
   } /*else {
     	var r = confirm("Are you sure you want to delete?");
		if (r == true) {
			document.getElementById('hostForm').submit();
		} 
   }*/
}

$(document).on('click', ':not(form)[data-confirm]', function(e){
    if(!confirm($(this).data('confirm'))){
      e.stopImmediatePropagation();
      e.preventDefault();
	}
});
</script>