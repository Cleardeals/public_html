<?php
login_check(); ///to check weatther user is login or not
access_check('city');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$page_limit = ($_REQUEST['page_limit'] ?? "");
$var_extra = "city"; // to enable page link
//$sortLink = "services";// to get sort result of text of search
if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "display_order asc"; // default sort by id
}

$dbObj->dbQuery="select * from ".PREFIX."city where id!=''"; // for listing of records

if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbCity = $dbObj->SelectQuery();
$cntH = count($dbCity);

$dbObj->dbQuery="select * from ".PREFIX."city where id='".$id."'";
$City = $dbObj->SelectQuery();
$state_id = $City[0]['state_id'] ?? "";

$dbObj->dbQuery="select * from ".PREFIX."state where status='1'";
$dbState = $dbObj->SelectQuery();
?>
<style>
#contentLeft {
	width:100%;
}
#contentLeft li {
	list-style: none;
}
#move {
	cursor: move;
}
.boder-table {
	border-bottom:solid 1px #a3a0a0
}
.table-left {
	border-right:solid 1px #a3a0a0
}
.wizard-label {
	color:#FF0000;
	text-align:center;
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
      <form action="contentController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="add_update_city" />
        <input type="hidden" name="id" value="<?=$id?>" />
        <div class="row" id="main">
          <div class="col-md-12" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Add/Update City 
                <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <h6>State</h6>
                    <select name="info[state_id]" id="state" class="form-control">
                      <option value="">State</option>
                      <?php for($i=0;$i<count((array)$dbState);$i++){?>
                      <option value="<?=$dbState[$i]['id']?>" <?=($state_id==$dbState[$i]['id'])?'selected':''?>>
                      <?=$dbState[$i]['state_name']?>
                      </option>
                      <?php }?>
                    </select>
                    <br>
                    <br>
                    <h6>City Name</h6>
                    <input class="form-control" type="text" name="info[city_name]" id="city_name" value="<?=$City[0]['city_name'] ?? ""?>">
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
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <?php if(!empty($msg)){ ?>
              <legend class="wizard-label" style="color:#FF0000; text-align:center;font-size:14px;">
              <?=$msg?>
              </legend>
              <?php } ?>
              <div class="row">
                <div  class="text-left col-md-6"></div>
                <div class="col-md-6 text-right">
                  <p style="padding-top:5px; color:#F00">
                  Change display order work on view all entries**</p>
                </div>
              </div>
              <div class="table-responsive mt-10">
                <form action="contentController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_city"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbCity)?>" />
                  <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="10%">City Name</th>
                        <th width="10%">State</th>
                        <th width="8%">Status</th>
                        <th width="8%">Display Order</th>
                        <th width="8%">Edit</th>
                      </tr>
                    </thead>
                    <tbody id="changes">
                      <?php for($i=0;$i<$cntH;$i++){
						  $dbObj->dbQuery="select * from ".PREFIX."state where id='".$dbObj->sc_mysql_escape($dbCity[$i]['state_id'])."'";
						  $dbStateName = $dbObj->SelectQuery();
						  ?>
                      <tr>
                        <td class="text-center" width="5%">
                        <span id="<?=$dbCity[$i]['id']?>">
                          <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbCity[$i]['id']?>">
                          </span></td>
                        <td id="move" width="20%"><?=$dbCity[$i]['city_name']?>
                        </td>
                        <td id="move" width="20%"><?=$dbStateName[0]['state_name']?></td>
                        <td width="8%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbCity[$i]['status']==1)?'checked':''?> onClick="city_status(<?=$dbCity[$i]['id']?>,this.value,this.checked)" value="<?=$dbCity[$i]['id']?>"></td>
                        <td width="10%"><?=$dbCity[$i]['display_order']?></td>
                        <td width="8%"><a href="index.php?mo=city&id=<?=$dbCity[$i]['id']?>" class="text-primary">Edit</a></td>
                      </tr>
                      <?php }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th><input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="10%">City Name</th>
                        <th width="10%">State</th>
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
	if(isEmpty("State",document.getElementById("state").value)){
		document.getElementById("state").focus();
		return false;
	}
	if(isEmpty("City Name",document.getElementById("city_name").value)){
		document.getElementById("city_name").focus();
		return false;
	}
	
	return true;
}

function submit_host(){
	if(ckhform() == true){
		document.getElementById("accForm").submit();
	}    
}

function city_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'contentController.php?mode=city_status',
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
</script>