<?php
login_check(); ///to check weatther user is login or not
access_check('blog_comment');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");
$var_extra = "blog_comment"; // to enable page link
//$sortLink = "services";// to get sort result of text of search
if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "id asc"; // default sort by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."blog_comment where id!=''"; // for total number of records for paging

$dbResult = $dbObj->SelectQuery('user.php','get_admin_list()');
$totalrecords = $dbResult[0]["total"];
  
require_once(PHP_FUNCTION_DIR.'admin-paging.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."blog_comment where id!=''"; // for listing of records
if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbBlogComment = $dbObj->SelectQuery();
$cntH = count((array)$dbBlogComment);
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
	border-bottom:solid 1px #a3a0a0;
}
.table-left {
	border-right:solid 1px #a3a0a0;
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
              <div class="row">
                <div class="text-left col-md-6">
                  <h3>Manage Blog Comment</h3>
                </div>
              </div>
              <div class="table-responsive mt-10">
                <!--<form action="blogController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_blog_comment"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbBlogComment)?>" />-->
                  <table id="myTable" class="display table table-hover table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <!--<th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>-->
                        <th width="5%">Blog Id</th>
                        <th width="10%">Name</th>
                        <th width="10%">Email</th>
                        <th width="10%">Comment</th>
                        <th width="10%">Comment Date</th>
                        <th width="10%">Admin Comment</th>
                        <th width="5%">Status</th>
                        <th width="5%">Action</th>
                      </tr>
                    </thead>
                    <tbody id="changes">
                      <?php for($i=0;$i<$cntH;$i++){?>
                      <tr>
                        <!--<td class="text-center" width="5%"><span id="<?=$dbBlogComment[$i]['id']?>">
                          <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbBlogComment[$i]['id']?>">
                          </span></td>-->
                        <td width="5%"><?=$dbBlogComment[$i]['blog_id']?></td>
                        <td width="10%"><?=$dbBlogComment[$i]['name']?></td>
                        <td width="10%"><?=$dbBlogComment[$i]['email']?></td>
                        <td width="10%"><?=$dbBlogComment[$i]['comment']?></td>
                        <td width="10%"><?=$dbBlogComment[$i]['comment_date']?></td>
                        <td  width="10%">
                          <?php 
                          if($dbBlogComment[$i]['admin_comment'] == null){
                          ?> 
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_<?=$i+1?>">Replay</button>

                            <!-- Modal -->
                            <div id="myModal_<?=$i+1?>" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <form action="blogController.php" method="post" >
                                <!-- Modal content-->
                                <input type="hidden" name="mode" value="add_admin_comment" />
                                    <input type="hidden" name="id" value="<?=$dbBlogComment[$i]['id']?>" />
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Reply Comment</h4>
                                  </div>
                                  <div class="modal-body">
                                   <div class="form-group"> 
                              <textarea class="form-control" rows="5" id="comment" name="comment" placeholder="Comment"></textarea>
                            </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                     <button type="submit" class="btn btn-success" >Submit</button>
                                  </div>
                                </div>
                              </form>
                              </div>
                            </div>
                          <?php   
                          }else{
                          ?> 
                            <?=$dbBlogComment[$i]['admin_comment']?>
                            <?php 
                          }
                          ?> 
                           
</td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbBlogComment[$i]['status']==1)?'checked':''?> onClick="comment_status(<?=$dbBlogComment[$i]['id']?>,this.value,this.checked)" value="<?=$dbBlogComment[$i]['id']?>"></td>
                        <td width="5%"><a href="blogController.php?mode=delete_blog_comment&id=<?=$dbBlogComment[$i]['id']?>" class="text-primary" data-confirm="Are you sure you want to delete?"><i class="fa fa-trash"></i></a></td>
                      </tr>
                      <?php }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <!--<th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>-->
                        <th width="5%">Blog Id</th>
                        <th width="10%">Name</th>
                        <th width="10%">Email</th>
                        <th width="10%">Comment</th>
                        <th width="10%">Comment Date</th>
                        <th width="10%">Admin Comment</th>
                        <th width="5%">Status</th>
                        <th width="5%">Action</th>
                      </tr>
                    </tfoot>
                  </table>
                <!--</form>-->
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

<!-- <script src="../cms_js/jquery.min.js"></script> --> 
<script type="text/javascript">
function comment_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'blogController.php?mode=comment_status',
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