<?php
login_check(); ///to check weatther user is login or not
access_check('free-valuation');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");
$var_extra = "free-valuation"; // to enable page link

if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "id desc"; // default sort by id
}

/*$dbObj->dbQuery="select * from ".PREFIX."valuation"; // for listing of records
if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}*/

$dbObj->dbQuery="select count(*) as total from ".PREFIX."valuation"; // for total number of records for paging

$dbResult = $dbObj->SelectQuery('user.php','get_admin_list()');
$totalrecords = $dbResult[0]["total"];

require_once(PHP_FUNCTION_DIR.'admin-paging2.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."valuation"; // for listing of records

if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbValuation = $dbObj->SelectQuery();
$cntH = count((array)$dbValuation);
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
      
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <?php if(!empty($msg)){ ?>
              <legend class="wizard-label">
              <?=$msg?>
              </legend>
              <?php } ?>
              <h3>Book Free Valuation</h3>
              <div class="table-responsive mt-10">
                <form action="contentController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_free_valuation"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbValuation)?>" />
                  <table class="display nowrap table table-hover table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="10%">Date of Valuation</th>
                        <th width="10%">Name</th>
                        <th width="10%">Email</th>
                        <th width="10%">Mobile Number</th>
                        <th width="10%">Purpose of Valuation</th>
                        <th width="10%">City</th>
                        <th width="10%">Location area of your property</th>
                        <th width="10%">Property Type</th>
                        <th width="10%">Area</th>
                        <th width="10%">Estimated Value of your Property</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php for($i=0;$i<$cntH;$i++){ ?>
                      <tr>
                        <td class="text-center" width="5%"><span id="<?=$dbValuation[$i]['id']?>">
                          <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbValuation[$i]['id']?>">
                          </span></td>
                        <td width="10%"><?=date('d/m/Y',strtotime($dbValuation[$i]['date']))?></td>
                        <td width="10%"><?=$dbValuation[$i]['name']?></td>
                        <td width="10%"><?=$dbValuation[$i]['email']?></td>
                        <td width="10%"><?=$dbValuation[$i]['mobile_no']?></td>
                        <td width="10%"><?=$dbValuation[$i]['purpose_of_valuation']?></td>
                        <td width="10%"><?=$dbValuation[$i]['city']?></td>
                        <td width="10%"><?=$dbValuation[$i]['location']?></td>
                        <td width="10%"><?php if($dbValuation[$i]['property_type']==1){?>
                          Flat
                          <?php }else{?>
                          Superbuilt Up Area
                          <?php }?></td>
                        <td width="10%"><?php if($dbValuation[$i]['sqf']==1){?>
                          <?=$dbValuation[$i]['area']?>
                          sq.Feet
                          <?php }else{?>
                          <?=$dbValuation[$i]['area']?>
                          sq.Yard
                          <?php }?></td>
                        <td width="10%"><?=$dbValuation[$i]['est_min_value'].' - '.$dbValuation[$i]['est_max_value']?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th><input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="10%">Date of Enquiry</th>
                        <th width="10%">Name</th>
                        <th width="10%">Email</th>
                        <th width="10%">Mobile Number</th>
                        <th width="10%">Purpose of Valuation</th>
                        <th width="10%">City</th>
                        <th width="10%">Location area of your property</th>
                        <th width="10%">Property Type</th>
                        <th width="10%">Area</th>
                        <th width="10%">Estimated Value of your Property</th>
                      </tr>
                    </tfoot>
                  </table>
                  
                  <!-- export table-->
                  
                  <table id="testTable" class="display nowrap table table-hover table-striped table-bordered" width="100%" style="display:none">
                    <thead>
                      <tr>
                        <th width="10%">Date of Valuation</th>
                        <th width="10%">Name</th>
                        <th width="10%">Email</th>
                        <th width="10%">Mobile Number</th>
                        <th width="10%">Purpose of Valuation</th>
                        <th width="10%">City</th>
                        <th width="10%">Location area of your property</th>
                        <th width="10%">Property Type</th>
                        <th width="10%">Area</th>
                        <th width="10%">Estimated Value of your Property</th>
                      </tr>
                    </thead>
                    <tbody id="changes">
                      <?php for($i=0;$i<$cntH;$i++){ ?>
                      <tr>
                        <td width="10%"><?=date('d/m/Y',strtotime($dbValuation[$i]['date']))?></td>
                        <td width="10%"><?=$dbValuation[$i]['name']?></td>
                        <td width="10%"><?=$dbValuation[$i]['email']?></td>
                        <td width="10%"><?=$dbValuation[$i]['mobile_no']?></td>
                        <td width="10%"><?=$dbValuation[$i]['purpose_of_valuation']?></td>
                        <td width="10%"><?=$dbValuation[$i]['city']?></td>
                        <td width="10%"><?=$dbValuation[$i]['location']?></td>
                        <td width="10%"><?php if($dbValuation[$i]['property_type']==1){?>
                          Flat
                          <?php }else{?>
                          Superbuilt Up Area
                          <?php }?></td>
                        <td width="10%"><?php if($dbValuation[$i]['sqf']==1){?>
                          <?=$dbValuation[$i]['area']?>
                          sq.Feet
                          <?php }else{?>
                          <?=$dbValuation[$i]['area']?>
                          sq.Yard
                          <?php }?></td>
                        <td width="10%"><?=$dbValuation[$i]['est_min_value'].' - '.$dbValuation[$i]['est_max_value']?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </form>
              </div>
              <?php if($cntH>0){ ?>
              <button onClick="return delete_records();" class="btn btn-primary pull-left" type="button" style="margin-top:10px;"> Delete</button>
              <button onClick="tableToExcel('testTable', 'W3C Example Table')" class="btn btn-primary pull-left" style="margin-left:20px;margin-top:10px;"> Export</button>
              <ul class="pagination pull-right mt-4">
                <?php  echo $page_link; ?>
              </ul>
              <!--<form method="post" action="export.php">
              <button onClick="tableToExcel('testTable', 'W3C Example Table')" class="btn btn-primary pull-left" style="margin-left:20px;margin-top:10px;"> Export</button>
              </form>-->
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

<!-- Export Excel-->
<script type="text/javascript">
var tableToExcel = (function() {

  //var uri = 'data:application/vnd.ms-excel;base64,'

  var uri = 'data:application/vnd.ms-excel;base64,'

    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>'

   // , template = 'valuation_users'

	, base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }

    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }

  return function(table, name) {

    if (!table.nodeType) table = document.getElementById(table)

    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}

    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script> 
<script type="text/javascript">
function property_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'propertyController.php?mode=property_status',
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