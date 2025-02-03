<?php
login_check(); ///to check weatther user is login or not
  
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");
$var_extra = "import_land"; // to enable page link
//$sortLink = "services";// to get sort result of text of search
if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "id asc"; // default sort by id
}

$dbObj->dbQuery="select * from ".PREFIX."land where id!=''"; // for listing of records

if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbland = $dbObj->SelectQuery();
$cntH = count((array)$dbland);

$dbObj->dbQuery="select * from ".PREFIX."land where id='".$id."'";
$land = $dbObj->SelectQuery();
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
      <form action="contentController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="import_pricelist" />
        <div class="row" id="main">
          <div class="col-md-12" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Upload Apartment Price list file <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <span style="color:red;"> <? echo base64_decode($_REQUEST['msg']);?></span>
                    <h6>Apartment excelsheet of predefine format</h6>
                    <input class="form-control" type="file" name="upload_xls" id="file" accept=".xls,.xlsx">
                    <br/>
                    Example file: <a href="Apartment_price_list.xlsx" style="color:#00F;">Download</a> <br>
                    <br>
                    <button type="submit"class="btn waves-effect btn-sm waves-light btn-success ml-auto">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      
      
      <form action="contentController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="import_pricelistbunglow" />
        <div class="row" id="main">
          <div class="col-md-12" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Upload Bunglow Price list file <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <span style="color:red;"> <? echo base64_decode($_REQUEST['msg2']);?></span>
                    <h6>Bunglow excelsheet of predefine format</h6>
                    <input class="form-control" type="file" name="upload_xls" id="file" accept=".xls,.xlsx">
                    <br/>
                    Example file: <a href="Bunglow_price_list.xlsx" style="color:#00F;">Download</a> <br>
                    <br>
                    <button type="submit"class="btn waves-effect btn-sm waves-light btn-success ml-auto">Submit</button>
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
<!-- This is data table -->
<script src="assets/vendors/dt-table/jquery.dataTables.min.js"></script> 
<script src="assets/vendors/dt-table/custom.dragdrop.sort.js"></script> 

<!--<script src="../cms_js/jquery.min.js"></script>--> 
<script type="text/javascript">
function ckhform(){
	if(isEmpty("City",document.getElementById("city").value)){
		document.getElementById("city").focus();
		return false;
	}
	if(isEmpty("Excel File",document.getElementById("file").value)){
		document.getElementById("file").focus();
		return false;
	}
	
	return true;
}

function submit_host(){
	if(ckhform() == true){
		document.getElementById("accForm").submit();
	}    
}

 
 
</script>