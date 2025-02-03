<?php
login_check(); ///to check weatther user is login or not
access_check('receipt');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$cnum = $dbObj->sc_mysql_escape($_REQUEST['cnum'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");
$var_extra = "receipt"; // to enable page link
//$sortLink = "services";// to get sort result of text of search
if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "id asc"; // default sort by id
}

$dbObj->dbQuery="select * from ".PREFIX."receipt"; // for listing of records
if(!empty($cnum)){
	$dbObj->dbQuery.=" where c_num='".$cnum."'";
}
if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbReceipt = $dbObj->SelectQuery();
//$cntH = count((array)$dbProperty);

//echo $_SESSION['srgit_cms_admin_id'];//exit;
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
              <h3>Manage Receipt</h3>
              <div class="row">
                <div class="text-left col-md-6"> <a href="index.php?mo=add_receipt" class="btn waves-effect waves-light btn-rounded btn-primary"> Generate Receipt</a></div>
              </div>
              <div class="table-responsive mt-10">
                <form action="propertyController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_property"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbReceipt)?>" />
                  <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" width="100%">
                    <thead>
                      <tr> 
                        <!--<th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>-->
                        <th width="10%">Receipt No.</th>
                        <th width="10%">Date</th>
                        <th width="10%">Form No.</th>
                        <th width="10%">Property Name</th>
                        <th width="5%">Status</th>
                        <th width="5%">Action</th>
                      </tr>
                    </thead>
                    <?php //if($_SESSION['srgit_cms_admin_id']!='1'){
						// echo '1111111111';
						 ?>
                    <tbody id="changes">
                      <?php for($i=0;$i<count((array)$dbReceipt);$i++){ ?>
                      <tr> 
                        <!--<td class="text-center" width="5%">
                          <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbProperty[$i]['id']?>">
                         </td>-->
                        <td width="10%"><?=$dbReceipt[$i]['recep_no']?></td>
                        <td width="10%"><?=date('d-m-Y',strtotime($dbReceipt[$i]['recp_date']))?></td>
                        <td width="10%"><?=$dbReceipt[$i]['c_num']?></td>
                        <td width="10%"><?=$dbReceipt[$i]['transno']?></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbReceipt[$i]['status']==1)?'checked':''?> onClick="receipt_status(<?=$dbReceipt[$i]['id']?>,this.value,this.checked)" value="<?=$dbReceipt[0]['id']?>"></td>
                        <td width="5%"><a href="index.php?mo=add_receipt&id=<?=$dbReceipt[$i]['id']?>" class="text-primary"><i class="fa fa-edit"></i></a>
                          <?php if($_SESSION['srgit_cms_admin_id']=='1'){
						// echo '1111111111';
						 ?>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="receiptController.php?mode=delete_receipt&id=<?=$dbReceipt[$i]['id']?>" class="text-primary" data-confirm="Are you sure you want to delete?"><i class="fa fa-trash"></i></a>
                          <?php }?></td>
                      </tr>
                      <?php }?>
                    </tbody>
                    <tfoot>
                      <tr> 
                        <!--<th><input type="checkbox" id="select" onClick="return selectAll()"/></th>-->
                        <th width="10%">Receipt No.</th>
                        <th width="10%">Date</th>
                        <th width="10%">Form No.</th>
                        <th width="10%">Property Name</th>
                        <th width="5%">Status</th>
                        <th width="5%">Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </form>
              </div>
              <?php //if($cntH>0){ ?>
              <!--<button onClick="return delete_records();" class="btn btn-primary pull-left" type="button"> Delete</button>-->
              <?php //}?>
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
<script type="text/javascript">
function receipt_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'receiptController.php?mode=receipt_status',
		data:'id='+value+'&setval='+setval,
		success:function(response){
			//alert(response);
			//document.getElementById("msg").innerHTML = "Status Successfully Changed";
			//alert("Status changed successfully.");
		}
	});
}

$(document).on('click', ':not(form)[data-confirm]', function(e){
    if(!confirm($(this).data('confirm'))){
      e.stopImmediatePropagation();
      e.preventDefault();
	}
});
</script>