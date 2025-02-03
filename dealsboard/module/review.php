<?php
login_check(); ///to check weatther user is login or not
access_check('review');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");
$var_extra = "review"; // to enable page link
//$sortLink = "services";// to get sort result of text of search
if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "display_order asc"; // default sort by id
}

$dbObj->dbQuery="select * from ".PREFIX."review where id!=''"; // for listing of records
if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbReview = $dbObj->SelectQuery();
$cntH = count((array)$dbReview);
$list = $dbReview[0]['display_order'];

$dbObj->dbQuery="select * from ".PREFIX."review where admin_del='0'"; // for listing of records
if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbAdminReview = $dbObj->SelectQuery();
//$cntH = count((array)$dbReview);
$list = $dbAdminReview[0]['display_order'];
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
              <div class="row">
                <div  class="text-left col-md-6">
                  <h3>Manage Review</h3>
                </div>
                <div class="col-md-6 text-right">
                  <p style="padding-top:5px;color:#F00"> Change display order work on view all entries**</p>
                </div>
              </div>
              <div class="table-responsive mt-10">
                <form action="reviewController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_review"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbReview)?>" />
                  <table id="myTable" class="display table table-hover table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center" width="3%"> <!--<input type="checkbox" id="select" onClick="return selectAll()"/>--> 
                          S.No. </th>
                        <th width="8%">Name</th>
                        <th width="8%">Email</th>
                        <th width="15%">Review</th>
                        <th width="5%">Rating</th>
                        <th width="5%">Display Order</th>
                        <th width="5%">Display Home Page</th>
                        <th width="5%">Display Sell Property</th>
                        <th width="5%">Display Rent Property</th>
                        <th width="5%">Approve Status</th>
                        <!--<th width="5%">Action</th>--> 
                      </tr>
                    </thead>
                    <?php if($_SESSION['srgit_cms_admin_id']!='1'){ ?>
                    <tbody id="changes">
                      <?php for($i=0;$i<count((array)$dbAdminReview);$i++){?>
                      <tr>
                        <td class="text-center" width="3%"><span id="<?=$dbAdminReview[$i]['id']?>">
                          <input type="hidden" id="c<?=$i?>" name="id[]" value="<?=$dbReview[$i]['id']?>">
                          <?=$i+1?>
                          </span></td>
                        <td id="move" width="8%"><?=$dbAdminReview[$i]['name']?></td>
                        <td id="move" width="8%"><?=$dbAdminReview[$i]['email']?></td>
                        <td id="move" width="15%"><?=$dbAdminReview[$i]['review']?></td>
                        <td id="move" width="5%"><?=$dbAdminReview[$i]['rating']?>
                          star</td>
                        <td width="5%"><?=$dbAdminReview[$i]['display_order']?></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbAdminReview[$i]['home_status']==1)?'checked':''?> onClick="review_home_status(<?=$dbAdminReview[$i]['id']?>,this.value,this.checked)" value="<?=$dbAdminReview[$i]['id']?>"></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbAdminReview[$i]['sell_status']==1)?'checked':''?> onClick="review_sell_status(<?=$dbAdminReview[$i]['id']?>,this.value,this.checked)" value="<?=$dbAdminReview[$i]['id']?>"></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbAdminReview[$i]['rent_status']==1)?'checked':''?> onClick="review_rent_status(<?=$dbAdminReview[$i]['id']?>,this.value,this.checked)" value="<?=$dbAdminReview[$i]['id']?>"></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbAdminReview[$i]['status']==1)?'checked':''?> onClick="review_status(<?=$dbAdminReview[$i]['id']?>,this.value,this.checked)" value="<?=$dbAdminReview[$i]['id']?>"></td>
                        <!--<td width="5%"><a href="reviewController.php?mode=delete_admin_review&id=<?=$dbAdminReview[$i]['id']?>" class="text-primary" data-confirm="Are you sure you want to delete?"><i class="fa fa-trash"></i></a></td>--> 
                      </tr>
                      <?php }?>
                    </tbody>
                    <?php }else{?>
                    <tbody id="changes">
                      <?php for($i=0;$i<$cntH;$i++){?>
                      <tr>
                        <td class="text-center" width="3%"><span id="<?=$dbReview[$i]['id']?>">
                          <input type="hidden" id="c<?=$i?>" name="id[]" value="<?=$dbReview[$i]['id']?>">
                          <?=$i+1?>
                          </span></td>
                        <td id="move" width="8%"><?=$dbReview[$i]['name']?></td>
                        <td id="move" width="8%"><?=$dbReview[$i]['email']?></td>
                        <td id="move" width="15%"><?=$dbReview[$i]['review']?></td>
                        <td id="move" width="5%"><?=$dbReview[$i]['rating']?>
                          star</td>
                        <td width="5%"><?=$dbReview[$i]['display_order']?></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbReview[$i]['home_status']==1)?'checked':''?> onClick="review_home_status(<?=$dbReview[$i]['id']?>,this.value,this.checked)" value="<?=$dbReview[$i]['id']?>"></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbReview[$i]['sell_status']==1)?'checked':''?> onClick="review_sell_status(<?=$dbReview[$i]['id']?>,this.value,this.checked)" value="<?=$dbReview[$i]['id']?>"></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbReview[$i]['rent_status']==1)?'checked':''?> onClick="review_rent_status(<?=$dbReview[$i]['id']?>,this.value,this.checked)" value="<?=$dbReview[$i]['id']?>"></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbReview[$i]['status']==1)?'checked':''?> onClick="review_status(<?=$dbReview[$i]['id']?>,this.value,this.checked)" value="<?=$dbReview[$i]['id']?>"></td>
                        <!--<td width="5%"><a href="reviewController.php?mode=delete_review&id=<?=$dbReview[$i]['id']?>" class="text-primary" data-confirm="Are you sure you want to delete?"><i class="fa fa-trash"></i></a></td>--> 
                      </tr>
                      <?php }?>
                    </tbody>
                    <?php }?>
                    <tfoot>
                      <tr>
                        <th class="text-center" width="5%"> <!--<input type="checkbox" id="select" onClick="return selectAll()"/>--> 
                          S.No. </th>
                        <th width="8%">Name</th>
                        <th width="8%">Email</th>
                        <th width="15%">Review</th>
                        <th width="5%">Rating</th>
                        <th width="5%">Display Order</th>
                        <th width="5%">Display Home Page</th>
                        <th width="5%">Display Sell Property</th>
                        <th width="5%">Display Rent Property</th>
                        <th width="5%">Approve Status</th>
                        <!--<th width="5%">Action</th>--> 
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
<!--<script src="../cms_js/jquery.min.js"></script> --> 
<script type="text/javascript">
function review_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'reviewController.php?mode=review_status',
		data:'id='+value+'&setval='+setval,
		success:function(response){
			//alert(response);
			//document.getElementById("msg").innerHTML = "Status Successfully Changed";
			//alert("Status changed successfully.");
		}
	});
}

function review_sell_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'reviewController.php?mode=review_sell_status',
		data:'id='+value+'&setval='+setval,
		success:function(response){
			//alert(response);
			//document.getElementById("msg").innerHTML = "Status Successfully Changed";
			//alert("Status changed successfully.");
		}
	});
}

function review_rent_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'reviewController.php?mode=review_rent_status',
		data:'id='+value+'&setval='+setval,
		success:function(response){
			//alert(response);
			//document.getElementById("msg").innerHTML = "Status Successfully Changed";
			//alert("Status changed successfully.");
		}
	});
}

function review_home_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'reviewController.php?mode=review_home_status',
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

$(document).on('click', ':not(form)[data-confirm]', function(e){
    if(!confirm($(this).data('confirm'))){
      e.stopImmediatePropagation();
      e.preventDefault();
	}
});
</script>