<?php
login_check(); ///to check weatther user is login or not
access_check('com_property');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");
$var_extra = "com_property"; // to enable page link
//$sortLink = "services";// to get sort result of text of search
if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "display_order asc"; // default sort by id
}

$dbObj->dbQuery="select * from ".PREFIX."com_property"; // for listing of records

if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbProperty = $dbObj->SelectQuery();
$cntH = count((array)$dbProperty);

$dbObj->dbQuery="select * from ".PREFIX."com_property where admin_del='0'"; // for listing of records

if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbAdminProperty = $dbObj->SelectQuery();
//$cntH = count((array)$dbProperty);

//echo $_SESSION['srgit_cms_admin_id'];//exit;
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
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <?php if(!empty($msg)){ ?>
              <legend class="wizard-label">
              <?=$msg?>
              </legend>
              <?php } ?>
              <h3>Manage Property</h3>
              <div class="row">
                <div class="text-left col-md-6"> <a href="index.php?mo=add_com_property" class="btn waves-effect waves-light btn-rounded btn-primary"> Add New</a></div>
              </div>
              <div class="table-responsive mt-10">
                <form action="compropertyController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_property"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbProperty)?>" />
                  <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <!--<th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>-->
                        <th width="10%">Property Name</th>
                        <th width="10%">Property Type</th>
                        <th width="10%">For Property</th>
                        <th width="10%">Manage Images</th>
                        <th width="5%">Status</th>
                        <th width="5%">Display Order</th>
                        <th width="5%">Action</th>
                         <th width="5%"></th>
                      </tr>
                    </thead>
                     <?php if($_SESSION['srgit_cms_admin_id']!='1'){
						// echo '1111111111';
						 ?>
                         <tbody id="changes">
                      <?php for($i=0;$i<count((array)$dbAdminProperty);$i++){
					  	$dbObj->dbQuery="select * from ".PREFIX."com_property_detail where property_id='".$dbObj->sc_mysql_escape($dbAdminProperty[$i]['id'])."'";
						$dbPropertyDetail = $dbObj->SelectQuery();
					  ?>
                      <tr>
                        <!--<td class="text-center" width="5%">
                       
                          <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbProperty[$i]['id']?>">
                         </td>-->
                        <td id="move" width="10%">
                         <span id="<?=$dbAdminProperty[$i]['id']?>">
						<?=$dbAdminProperty[$i]['property_name']?>
                         </span>
                        </td>
                        <td id="move" width="10%">
						<?=$dbAdminProperty[$i]['property_type']?></td>
                        <td id="move" width="10%">
						<?=$dbAdminProperty[$i]['for_property']?></td>
                        <td width="10%"><a href="index.php?mo=com_property_images&property_id=<?=$dbAdminProperty[$i]['id']?>"> 
                        Manage Images</a></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbAdminProperty[$i]['status']==1)?'checked':''?> onClick="property_status(<?=$dbAdminProperty[$i]['id']?>,this.value,this.checked)" value="<?=$dbAdminProperty[$i]['id']?>"></td>
                        <td width="5%"><?=$dbAdminProperty[$i]['display_order']?></td>
                        <td width="5%"><a href="index.php?mo=add_com_property&id=<?=$dbAdminProperty[$i]['id']?>" class="text-primary"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="compropertyController.php?mode=delete_single_com_property&id=<?=$dbAdminProperty[$i]['id']?>" class="text-primary" data-confirm="Are you sure you want to delete?"><i class="fa fa-trash"></i></a>
                        </td>
                         <td width="5%"><a href="index.php?mo=manual_users&property_id=<?=$dbAdminProperty[$i]['id']?>&for_property=<?=$dbAdminProperty[$i]['for_property']?>&property_type=<?=$dbAdminProperty[$i]['property_type']?>&prop_state=<?=$dbAdminProperty[$i]['State']?>&prop_city=<?=$dbAdminProperty[$i]['city']?>&locationname=<?=$dbAdminProperty[$i]['location']?>&bedroom=<?=$dbPropertyDetail[0]['no_of_bedrooms']?>&bathroom=<?=$dbPropertyDetail[0]['no_of_bathrooms']?>" class="text-primary">Search User</a>
                        </td>
                      </tr>
                      <?php }?>
                    </tbody>
                    
                    <?php }else{
						//echo '222222';
						?>
                    <tbody id="changes">
                      <?php for($i=0;$i<$cntH;$i++){
					  	$dbObj->dbQuery="select * from ".PREFIX."com_property_detail where property_id='".$dbObj->sc_mysql_escape($dbProperty[$i]['id'])."'";
						$dbPropertyDetail = $dbObj->SelectQuery();
					  ?>
                      <tr>
                        <!--<td class="text-center" width="5%">
                       
                          <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbProperty[$i]['id']?>">
                         </td>-->
                        <td id="move" width="10%">
                         <span id="<?=$dbProperty[$i]['id']?>">
						<?=$dbProperty[$i]['property_name']?>
                         </span>
                        </td>
                        <td id="move" width="10%">
						<?=$dbProperty[$i]['property_type']?></td>
                        <td id="move" width="10%">
						<?=$dbProperty[$i]['for_property']?></td>
                        <td width="10%"><a href="index.php?mo=com_property_images&property_id=<?=$dbProperty[$i]['id']?>"> 
                        Manage Images</a></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbProperty[$i]['status']==1)?'checked':''?> onClick="property_status(<?=$dbProperty[$i]['id']?>,this.value,this.checked)" value="<?=$dbProperty[$i]['id']?>"></td>
                        <td width="5%"><?=$dbProperty[$i]['display_order']?></td>
                        <td width="5%"><a href="index.php?mo=add_com_property&id=<?=$dbProperty[$i]['id']?>" class="text-primary"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="compropertyController.php?mode=delete_single_com_property&id=<?=$dbProperty[$i]['id']?>" class="text-primary" data-confirm="Are you sure you want to delete?"><i class="fa fa-trash"></i></a>
                        </td>
                        <td width="5%"><a href="index.php?mo=manual_users&property_id=<?=$dbProperty[$i]['id']?>&for_property=<?=$dbProperty[$i]['for_property']?>&property_type=<?=$dbProperty[$i]['property_type']?>&prop_state=<?=$dbProperty[$i]['State']?>&prop_city=<?=$dbProperty[$i]['city']?>&locationname=<?=$dbProperty[$i]['location']?>&bedroom=<?=$dbPropertyDetail[0]['no_of_bedrooms']?>&bathroom=<?=$dbPropertyDetail[0]['no_of_bathrooms']?>" class="text-primary">Search User</a>
                      </tr>
                      <?php }?>
                    </tbody>
                    <?php }?>
                    <tfoot>
                      <tr>
                        <!--<th><input type="checkbox" id="select" onClick="return selectAll()"/></th>-->
                        <th width="10%">Property Name</th>
                        <th width="10%">Property Type</th>
                        <th width="10%">For Property</th>
                        <th width="10%">Manage Images</th>
                        <th width="5%">Status</th>
                        <th width="5%">Display Order</th>
                        <th width="5%">Action</th>
                         <th width="5%"></th>
                      </tr>
                    </tfoot>
                  </table>
                </form>
              </div>
              <?php if($cntH>0){ ?>
              <!--<button onClick="return delete_records();" class="btn btn-primary pull-left" type="button"> Delete</button>-->
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
<!--<script src="../cms_js/jquery.min.js"></script>

<script type="text/javascript" src="../cms_js/jquery-drag-n-drop/jquery-ui-1.7.1.custom.min.js"></script> -->

<script type="text/javascript">
function property_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'compropertyController.php?mode=property_status',
		data:'id='+value+'&setval='+setval,
		success:function(response){
			//alert(response);
			//document.getElementById("msg").innerHTML = "Status Successfully Changed";
			//alert("Status changed successfully.");
		}
	});
}

/*$.noConflict();
jQuery( document ).ready(function( $ ) {
$(function() {
		$("#contentLeft ul").sortable({ opacity: 0.6, handle: '#move', update: function() {
			var order = $(this).sortable("serialize") + '&action=change_property_images_order' + '&list=<?=$list?>' + '&count=<?=$count?>'+ '&page=<?=$page?>'+ '&page_limit=<?=$page_limit?>'+ '&property_id=<?=$property_id?>';
			$.post("compropertyController.php", order, function(theResponse){
				alert(theResponse);
				$("#changes").html(theResponse);
				window.location.reload();
			}); 															 
		}
		});
	});});*/


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

$(document).on('click', ':not(form)[data-confirm]', function(e){
    if(!confirm($(this).data('confirm'))){
      e.stopImmediatePropagation();
      e.preventDefault();
	}
});
</script>
