<?php
login_check(); ///to check weatther user is login or not
access_check('package_list');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$packageList = $dbObj->sc_mysql_escape($_REQUEST['packageList'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");

$var_extra = "package_list&packageList=".$packageList; // to enable page link
//$sortLink = "services";// to get sort result of text of search

if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "display_order asc"; // default sort by id
}

$dbObj->dbQuery="select * from ".PREFIX."package_list where id!=''"; // for listing of records

if(!empty($packageList)) {
	$dbObj->dbQuery .= " and package='".$packageList."'";
}

if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbPackage = $dbObj->SelectQuery();
$cntH = count($dbPackage);

$dbObj->dbQuery="select * from ".PREFIX."package_list where id='".$id."'";
$Package = $dbObj->SelectQuery();
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
      
      <form action="packageController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="add_update_package_list" />
        <input type="hidden" name="id" value="<?=$id?>" />
        <input type="hidden" name="packageList" value="<?=$packageList?>" />
        <div class="row" id="main">
          <div class="col-md-12" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Add/Update Package List <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <h6>Package</h6>
                    <?php $packages = $Package[0]['package'] ?? "";?>
                    <select class="form-control" name="info[package]" id="package" onChange="Package(this.value);">
                      <option value="">Select Package</option>
                      <option value="Sell" <?=($packages=='Sell')?'selected':''?>>Sell Property</option>
                      <option value="Rent" <?=($packages=='Rent')?'selected':''?>>Rent Property</option>
                    </select>
                    <br>
                    <br>
                    <h6>Title</h6>
                    <input class="form-control" type="text" name="info[title]" id="title" value="<?=$Package[0]['title'] ?? ""?>">
                    <br>
                    <br>
                    <?php $basic_package = $Package[0]['basic_package'] ?? "";?>
                    <h6>Premium Package</h6>
                    <select class="form-control" name="info[basic_package]" id="basic_package" onChange="basicPackage(this.value);">
                      <option value="">Select</option>
                      <option value="check_basic" <?=($basic_package=='check_basic')?'selected':''?>>Yes</option>
                      <option value="no_basic" <?=($basic_package=='no_basic')?'selected':''?>>No</option>
                      <option value="input_box_basic" <?=($basic_package=='input_box_basic')?'selected':''?>>Input Box</option>
                    </select>
                    <br>
                    <br>
                    <?php $basic_package = $Package[0]['basic_package'] ?? "";?>
                    <?php if($basic_package=='input_box_basic'){?>
                    <div id="inputdivbasic">
                      <h6></h6>
                      <input class="form-control" type="text" name="info[textbox_basic]" value="<?=$Package[0]['textbox_basic'] ?? ""?>">
                      <br>
                      <br>
                    </div>
                    <?php }else{?>
                    <div id="inputdivbasic" style="display:none;">
                      <h6></h6>
                      <input class="form-control" type="text" name="info[textbox_basic]">
                      <br>
                      <br>
                    </div>
                    <?php }?>
                    <div id="inputdivpac">
                      <?php $title_type_premium = $Package[0]['title_type_premium'] ?? "";?>
                      <h6>Quick Sell-Money Back Package</h6>
                      <select class="form-control" name="info[title_type_premium]" id="title_type_premium" onChange="premiumPackage(this.value);">
                        <option value="">Select</option>
                        <option value="check_premium" <?=($title_type_premium=='check_premium')?'selected':''?>>Yes</option>
                        <option value="no_premium" <?=($title_type_premium=='no_premium')?'selected':''?>>No</option>
                        <option value="input_box_premium" <?=($title_type_premium=='input_box_premium')?'selected':''?>>Input Box</option>
                      </select>
                      <br>
                      <br>
                      <?php if($title_type_premium=='input_box_premium'){?>
                      <div id="inputdivpremium">
                        <h6></h6>
                        <input class="form-control" type="text" name="info[textbox_premium]" value="<?=$Package[0]['textbox_premium'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <?php }else{?>
                      <div id="inputdivpremium" style="display:none;">
                        <h6></h6>
                        <input class="form-control" type="text" name="info[textbox_premium]">
                        <br>
                        <br>
                      </div>
                      <?php }?>
                      <?php $title_type_split = $Package[0]['title_type_split'] ?? "";?>
                      <h6>Split Fee Package</h6>
                      <select class="form-control" name="info[title_type_split]" id="title_type_split" onChange="splitPackage(this.value);">
                        <option value="">Select</option>
                        <option value="check_split" <?=($title_type_split=='check_split')?'selected':''?>>Yes</option>
                        <option value="no_split" <?=($title_type_split=='no_split')?'selected':''?>>No</option>
                        <option value="input_box_split" <?=($title_type_split=='input_box_split')?'selected':''?>>Input Box</option>
                      </select>
                      <br>
                      <br>
                      <?php if($title_type_split=='input_box_split'){?>
                      <div id="inputdivsplit">
                        <h6></h6>
                        <input class="form-control" type="text" name="info[textbox_split]" value="<?=$Package[0]['textbox_split'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <?php }else{?>
                      <div id="inputdivsplit" style="display:none;">
                        <h6></h6>
                        <input class="form-control" type="text" name="info[textbox_split]">
                        <br>
                        <br>
                      </div>
                      <?php }?>
                    </div>
                    <button onClick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success ml-auto"> Submit</button>
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
                <div  class="text-left col-md-6"></div>
                <div class="col-md-6 text-right"> 
                  <!--<p style="padding-top:5px; color:#F00"> Change display order work on view all entries**</p>--> 
                </div>
              </div>
              <div class="table-responsive mt-10">
                <form action="packageController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_package_list"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbPackage)?>" />
                  <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="10%">Package</th>
                        <th width="10%">Title</th>
                        <th width="8%">Status</th>
                        <th width="8%">Display Order</th>
                        <th width="8%">Edit</th>
                      </tr>
                    </thead>
                    <tbody id="changes">
                      <?php for($i=0;$i<$cntH;$i++){?>
                      <tr>
                        <td class="text-center" width="5%"><span id="<?=$dbPackage[$i]['id']?>">
                          <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbPackage[$i]['id']?>">
                          </span></td>
                        <td id="move" width="10%"><?=$dbPackage[$i]['package']?></td>
                        <td id="move" width="10%"><?=$dbPackage[$i]['title']?></td>
                        <td width="8%"><input type="checkbox" id="s<?=$i+1?>"  <?=($dbPackage[$i]['status']==1)?'checked':''?> onClick="package_list_status(<?=$dbPackage[$i]['id']?>,this.value,this.checked)" value="<?=$dbPackage[$i]['id']?>"></td>
                        <td width="10%"><?=$dbPackage[$i]['display_order']?></td>
                        <td width="8%"><a href="index.php?mo=package_list&id=<?=$dbPackage[$i]['id']?>&packageList=<?=$packageList?>&set=<?=$set?>&page=<?=$page?>" class="text-primary">Edit</a></td>
                      </tr>
                      <?php }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th><input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="10%">Package</th>
                        <th width="10%">Title</th>
                        <th width="8%">Status</th>
                        <th width="8%">Display Order</th>
                        <th width="8%">Edit</th>
                      </tr>
                    </tfoot>
                  </table>
                </form>
              </div>
              <?php if($cntH>0){ ?>
              <button onClick="return delete_records();" class="btn btn-primary pull-left" type="button"> Delete</button>
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
<script src="assets/vendors/dt-table/jquery.dataTables.min.js"></script> 
<script src="assets/vendors/dt-table/custom.dragdrop.sort.js"></script> 

<!--<script src="../cms_js/jquery.min.js"></script>--> 

<script type="text/javascript">
function ckhform(){

	if(isEmpty("Package",document.getElementById("package").value)){
		document.getElementById("package").focus();
		return false;
	}

	if(isEmpty("Title",document.getElementById("title").value)){
		document.getElementById("title").focus();
		return false;
	}

	if(isEmpty("Basic Package",document.getElementById("basic_package").value)){
		document.getElementById("basic_package").focus();
		return false;
	}
	
	/*if(isEmpty("Premium Digitour Package",document.getElementById("title_type_premium").value)){
		document.getElementById("title_type_premium").focus();
		return false;
	}
	
	if(isEmpty("Split Fee Package",document.getElementById("title_type_split").value)){
		document.getElementById("title_type_split").focus();
		return false;
	}*/

	return true;
}

function submit_host(){
	if(ckhform() == true){
		document.getElementById("accForm").submit();
	}
}

function package_list_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'packageController.php?mode=package_list_status',
		data:'id='+value+'&setval='+setval,
		success:function(response){
			//alert(response);
			//document.getElementById("msg").innerHTML = "Status Successfully Changed";
			//alert("Status changed successfully.");
		}
	});
}


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
   		alert("Please select atleast one record to delete.");
     	return false;
   } else {
     	var r = confirm("Are you sure you want to delete?");
		if (r == true) {
			document.getElementById('hostForm').submit();
		} 
   }
}

function basicPackage(dropval){

	if(dropval== 'input_box_basic'){
		document.getElementById('inputdivbasic').style.display = 'block';
	}else{
		document.getElementById('inputdivbasic').style.display = 'none';
		}
};

function premiumPackage(dropval){

	if(dropval== 'input_box_premium'){
		document.getElementById('inputdivpremium').style.display = 'block';
	}else{
		document.getElementById('inputdivpremium').style.display = 'none';
		}
};

function splitPackage(dropval){

	if(dropval== 'input_box_split'){
		document.getElementById('inputdivsplit').style.display = 'block';
	}else{
		document.getElementById('inputdivsplit').style.display = 'none';
		}
};

function Package(dropval){

	if(dropval== 'Rent'){
		document.getElementById('inputdivpac').style.display = 'none';
	}else{
		document.getElementById('inputdivpac').style.display = 'block';
		}
};
</script>