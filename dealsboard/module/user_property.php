<?php
login_check(); ///to check weatther user is login or not
access_check('user_property');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");
$var_extra = "user_property"; // to enable page link
//$sortLink = "services";// to get sort result of text of search
if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "id asc"; // default sort by id
}

$dbObj->dbQuery="select * from ".PREFIX."user_property_detail where user_id='".$id."'"; // for listing of records

if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbUserProp = $dbObj->SelectQuery();
//echo $dbObj->dbQuery;
$cntH = count((array)$dbUserProp);
?>
<link rel="stylesheet" href="css/popupw3.css">
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
              <h3>Manage Users Property</h3>
              <div class="row">
                <div class="text-left col-md-6"> </div>
              </div>
              <div class="table-responsive mt-10">
                <form action="userController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_user_property"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbUserProp)?>" />
                  <input type="hidden" name="user_id" value="<?=$id?>"/>
                  <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="5%">Client Id</th>
                        <th width="5%">For Property</th>
                        <th width="5%">State</th>
                        <th width="5%">City</th>
                        <th width="5%">Payment Mode</th>
                        <th width="5%">Payment Status</th>
                        <!--<th width="5%">Invoice</th>--> 
                      </tr>
                    </thead>
                    <tbody id="changes">
                      <?php for($i=0;$i<$cntH;$i++){ 
					  	$dbObj->dbQuery="select * from ".PREFIX."state where id='".$dbObj->sc_mysql_escape($dbUserProp[$i]['state'])."'"; 
						$dbState = $dbObj->SelectQuery();

						$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$dbObj->sc_mysql_escape($dbUserProp[$i]['user_id'])."'"; 
						$dbUser = $dbObj->SelectQuery();
					  ?>
                      <tr>
                        <td class="text-center" width="5%"><span id="<?=$dbUserProp[$i]['id']?>">
                          <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbUserProp[$i]['id']?>">
                          </span></td>
                        <td width="5%"><?=$dbUser[0]['clientid']?></td>
                        <td width="5%"><?php if(!empty($dbUserProp[$i]['for_property'])){?>
                          <?=$dbUserProp[$i]['for_property']?>
                          <?php }else{?>
                          -
                          <?php }?></td>
                        <td width="5%"><?=$dbState[0]['state_name']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['city']?></td>
                        <td width="5%"><?php if(!empty($dbUserProp[$i]['paymentMode'])){?>
                          <?=$dbUserProp[$i]['paymentMode']?>
                          <?php }else{?>
                          -
                          <?php }?></td>
                        <td><select name="pay_status" onChange="setPaystatus('<?=$dbUserProp[$i]['id']?>',this.value)">
                            <option value="Paid" <?=($dbUserProp[$i]['pay_status'] == "Paid")?'selected':''?>>Paid </option>
                            <option value="Unpaid" <?=($dbUserProp[$i]['pay_status'] == "Unpaid")?'selected':''?>>Unpaid </option>
                          </select></td>
                      </tr>
                      <?php }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th><input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="5%">Client Id</th>
                        <th width="5%">For Property</th>
                        <th width="5%">State</th>
                        <th width="5%">City</th>
                        <th width="5%">Payment Mode</th>
                        <th width="5%">Payment Status</th>
                        <!--<th width="5%">Invoice</th>--> 
                      </tr>
                    </tfoot>
                  </table>
                  
                  <!--export table-->
                  <table id="testTable" class="display nowrap table table-hover table-striped table-bordered" width="100%" style="display:none">
                    <thead>
                      <tr>
                        <th width="5%">Client Id</th>
                        <th width="5%">For Property</th>
                        <th width="5%">Form Number</th>
                        <th width="5%">Property Name</th>
                        <th width="5%">Property Type</th>
                        <th width="5%">No. of Bedrooms</th>
                        <th width="5%">No. of Bathrooms</th>
                        <th width="5%">State</th>
                        <th width="5%">City</th>
                        <th width="5%">Where did you hear about us</th>
                        <th width="5%">Property Address </th>
                        <th width="5%">Detail</th>
                        <th width="5%">Overlooking</th>
                        <th width="5%">Amount</th>
                        <th width="5%">Validity</th>
                        <th width="5%">Remark</th>
                        <th width="5%">Cheque No</th>
                        <th width="5%">Cheque Date</th>
                        <th width="5%">Cheque Amount</th>
                        <th width="5%">Bank Name</th>
                        <th width="5%">Payment Status</th>
                      </tr>
                    </thead>
                    <tbody id="changes">
                      <?php for($i=0;$i<$cntH;$i++){ 
					  	$dbObj->dbQuery="select * from ".PREFIX."state where id='".$dbObj->sc_mysql_escape($dbUserProp[$i]['state'])."'"; 
						$dbState = $dbObj->SelectQuery();

						$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$dbObj->sc_mysql_escape($dbUserProp[$i]['user_id'])."'"; 
						$dbUser = $dbObj->SelectQuery();
					  ?>
                      <tr>
                        <td width="5%"><?=$dbUser[0]['clientid']?></td>
                        <td width="5%"><?php if(!empty($dbUserProp[$i]['for_property'])){?>
                          <?=$dbUserProp[$i]['for_property']?>
                          <?php }else{?>
                          -
                          <?php }?></td>
                        <td width="5%"><?=$dbUserProp[$i]['form_no']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['property_name']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['property_type']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['no_of_bedrooms']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['no_of_bathrooms']?></td>
                        <td width="5%"><?=$dbState[0]['state_name']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['city']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['hear_about']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['prop_add']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['detail']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['overlooking']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['amount']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['validity']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['prop_remark']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['cheque_no']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['cheque_date']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['cheque_amt']?></td>
                        <td width="5%"><?=$dbUserProp[$i]['bank_name']?></td>
                        <td><?php if($dbUserProp[$i]['pay_status'] == "Paid"){?>
                          Paid
                          <?php }else{?>
                          Unpaid
                          <?php }?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </form>
              </div>
              <?php if($cntH>0){ ?>
              <button onClick="return delete_records();" class="btn btn-primary pull-left" type="button"> Delete</button>
              <button onClick="tableToExcel('testTable', 'W3C Example Table')" class="btn btn-primary pull-left" style="margin-left:10px;"> Export</button>
              <?php }?>
            </div>
          </div>
        </div>
      </div>
      
      <!-- modal start-->
      <?php for($i=0;$i<$cntH;$i++){
		 
	 	//get user detail
		$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$dbObj->sc_mysql_escape($dbUserProp[$i]['user_id'])."'";
		$dbUser = $dbObj->SelectQuery();
		
		$dbObj->dbQuery = "SELECT * FROM ".PREFIX."state WHERE id='".$dbObj->sc_mysql_escape($dbUserProp[$i]['state'])."'";
		$dbState = $dbObj->SelectQuery();
		
		// generate reciept number
		$znum=sprintf("%05s", $dbUserProp[$i]['id']);
		$recieptNo="CDC".$znum."";//exit;
	 ?>
      <div id="id<?=$dbUserProp[$i]['id']?>" class="w3-modal">
        <div class="w3-modal-content">
          <div class="w3-container"> <span onClick="document.getElementById('id<?=$dbUserProp[$i]['id']?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <div class="center-section-in" style="padding-top:10px;">
              <table width="800" cellpadding="5" align="center">
                <tr>
                  <th scope="col"><img src="<?=HTACCESS_URL?>assets/img/logo.png"></th>
                  <th scope="col" style="text-align:right"><b>RECEIPT NO:
                    <?=$recieptNo?>
                    </b><br />
                    DATE:
                    <?=date('d-M-Y')?></th>
                </tr>
                <tr>
                  <td colspan="2"><p style="margin-top:15px;">From: ClearDeals Properties<br />
                      52, 1st Floor, Stadium House, 
                      Navrangpura, Ahmedabad</p></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>RECEIVED WITH THANKS FROM</strong><br />
                    <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
                    <?=$dbUser[0]['name']?>
                    </span></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>FORM NO</strong><br />
                    <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
                    <?=$dbUserProp[$i]['form_no']?>
                    </span></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>PROPERTY NAME</strong><br />
                    <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
                    <?php if(!empty($dbUserProp[$i]['property_name'])){?>
                    <?=$dbUserProp[$i]['property_name']?>
                    <?php }?>
                    <?php if(!empty($dbUserProp[$i]['prop_add'])){?>
                    ,
                    <?=$dbUserProp[$i]['prop_add']?>
                    <?php }?>
                    <?php if(!empty($dbUserProp[$i]['city'])){?>
                    ,
                    <?=$dbUserProp[$i]['city']?>
                    <?php }?>
                    <?php if(!empty($dbUserProp[$i]['state'])){?>
                    ,
                    <?=$dbState[0]['state_name']?>
                    <?php }?>
                    </span></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>THE SUM OF RUPEES</strong><br />
                    <span style="display:block;width:100%;margin-bottom:5px;border-bottom:1px solid #000;">
                    <?=number_format($dbUserProp[$i]['amount'],2)?>
                    </span> <span style="display:block; width:100%; margin-bottom:25px;">BY CHEQUE/CASH/DD</span></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>REMARKS</strong><br />
                    <span style="display:block;width:100%;margin-bottom:25px;border-bottom:1px solid #000;">
                    <?=$dbUserProp[$i]['prop_remark']?>
                    </span></td>
                </tr>
                <tr>
                  <td colspan="2"><span style="display:block;width:100%;margin-bottom:25px;padding:25px 30px;border-radius:10px;border:2px solid #ccc;font-size:130%;font-weight:700">Rs.
                    <?=number_format($dbUserProp[$i]['amount'],2)?>
                    </span></td>
                </tr>
                <tr>
                  <td><label>
                      <input type="checkbox"/>
                      Please click here to calculate Total.</label></td>
                  <td style="text-align:right"><p style="margin-bottom:5px"><strong>CGST 0%:</strong> 0.00</p>
                    <p style="margin-bottom:5px"><strong>SGST 0%:</strong> 0.00</p>
                    <p><strong>GSTIN/UIN :</strong> <span style="border-bottom:1px solid #000000;">
                      <?=number_format($dbUserProp[$i]['amount'],2)?>
                      </span></p></td>
                </tr>
                <tr>
                  <td colspan="2" style="text-align:left"><hr />
                    <strong style="margin-bottom:15px; display:inline-block">Created By</strong></td>
                </tr>
                <tr style="border-bottom:1px solid #000">
                  <td> ClearDeals Properties </td>
                  <td style="text-align:right"> This is online receipt and doesnot require a Signature </td>
                </tr>
                <tr>
                  <td colspan="2" style="text-align:right"><br />
                    <a href="" style="display:inline-block;padding:15px;border-radius:10px;border:2px solid #ccc;font-size:130%; font-weight:700" onclick='printDiv();'>Generate Receipt</a></td>
                </tr>
              </table>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
<script>
function printDiv(){
var divToPrint=document.getElementById('id<?=$dbUserProp[$i]['id']?>');
var newWin=window.open('','Print-Window');
newWin.document.open();
newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
newWin.document.close();
setTimeout(function(){newWin.close();},10);
}
</script>
      <?php }?>
      <!-- modal end--> 
      
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

function setPaystatus(id,value){
	$.ajax({
		url:'userController.php?mode=pay_status',
		data:'id='+id+'&setval='+value,
		//cache:false,
		success:function(response){
		//alert(response);	
		//$('#msg').html(response);
		}
	});
}
</script>