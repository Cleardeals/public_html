<?php
login_check(); ///to check weatther user is login or not
access_check('progress_report');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$user_id = $dbObj->sc_mysql_escape($_REQUEST['user_id'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");
$var_extra = "progress_report"; // to enable page link
//$sortLink = "services";// to get sort result of text of search
if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "display_order asc"; // default sort by id
}

$dbObj->dbQuery="select * from ".PREFIX."progress_report where user_id='".$user_id."'"; // for listing of records

if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbProgress = $dbObj->SelectQuery();
$cntH = count((array)$dbProgress);

$dbObj->dbQuery="select * from ".PREFIX."progress_report where id='".$id."'"; // for listing of records
$dbRes = $dbObj->SelectQuery();
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
      <form action="userController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="progress_report" />
        <input type="hidden" name="id" value="<?=$id?>" />
        <input type="hidden" name="user_id" value="<?=$user_id?>" />
        <div class="row" id="main">
          <div class="col-md-12" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Progress Report <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <h6>Title</h6>
                    <input class="form-control" type="text" name="info[title]" id="title" value="<?=$dbRes[0]['title'] ?? ""?>">
                    <br/>
                    <br/>
                    <h6>Upload Progress Report</h6>
                    <?php if(!empty($dbRes[0]['upload_file'])) {?>
                    <a href="../cms_images/progress_report/<?=$dbRes[0]['upload_file']?>" style="color:#00F;"> Download</a>
                    <?php } ?>
                    <input class="form-control" type="file" name="upload_file" id="file" accept=".xls">
                    <br/>
                    <p style="font-size:12px;color:#F00;margin-top:10px;"> Excel (File Will Accept)</p>
                    <br>
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
              <h3>Manage Progress Report</h3>
              <div class="table-responsive mt-10">
                <form action="userController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_report"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbProgress)?>" />
                  <input type="hidden" name="user_id" value="<?=$user_id?>" />
                  <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="10%">Title</th>
                        <th width="10%">File</th>
                        <th width="5%">Status</th>
                        <!--<th width="5%">Display Order</th>-->
                        <th width="8%">Edit</th>
                      </tr>
                    </thead>
                    <tbody id="changes">
                      <?php for($i=0;$i<$cntH;$i++){ ?>
                      <tr>
                        <td class="text-center" width="5%"><span id="<?=$dbProgress[$i]['id']?>">
                          <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbProgress[$i]['id']?>">
                          </span></td>
                        <td width="10%"><?=$dbProgress[$i]['title']?></td>
                        <td width="10%"><a href="../cms_images/progress_report/<?=$dbProgress[$i]['upload_file']?>">
                          <?=$dbProgress[$i]['upload_file']?>
                          </a></td>
                        <td width="10%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbProgress[$i]['status']==1)?'checked':''?> onClick="report_status(<?=$dbProgress[$i]['id']?>,this.value,this.checked)" value="<?=$dbProgress[$i]['id']?>"></td>
                        <!--<td width="10%"><?=$dbProgress[$i]['display_order']?></td>-->
                        <td width="8%"><a href="index.php?mo=progress_report&user_id=<?=$dbProgress[$i]['user_id']?>&id=<?=$dbProgress[$i]['id']?>" class="text-primary">Edit</a></td>
                      </tr>
                      <?php }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th><input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="10%">Title</th>
                        <th width="10%">File</th>
                        <th width="5%">Status</th>
                        <!--<th width="5%">Display Order</th>-->
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
	if(isEmpty("Title",document.getElementById("title").value)){
		document.getElementById("title").focus();
		return false;
	}
	
	<?php if(empty($dbRes[0]['upload_file'])) {?>
	if(isEmpty("Progress Report",document.getElementById("file").value)){
		document.getElementById("file").focus();
		return false;
	}
	<?php }?>
	
	return true;
}

function submit_host(){
	if(ckhform() == true){
		document.getElementById("accForm").submit();
	}    
}

function report_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'userController.php?mode=report_status',
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