<?php
login_check(); ///to check weatther user is login or not
//access_check('valuation_comment');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$var_extra = "valuation_comment"; // to enable page link
//$sortLink = "services";// to get sort result of text of search

if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "id asc"; // default sort by id
}

$dbObj->dbQuery="select * from ".PREFIX."valuation_comment"; // for listing of records 
$dbValuationComment = $dbObj->SelectQuery();
$cntH = count((array)$dbValuationComment);  
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
                <div class="text-left col-md-6">
                  <h3>Manage Valuation Comment</h3>
                </div>
              </div>
              <div class="table-responsive mt-10">
                <table id="myTable" class="display table table-hover table-striped table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>
                      <th width="10%">Name</th>
                      <th width="10%">Email</th>
                      <th width="10%">Comment</th>
                      <th width="10%">Comment Date</th>
                      <th width="10%">Reply comment</th>
                      <th width="5%">Status</th>
                    </tr>
                  </thead>
                  <tbody id="changes">
                    <?php for($i=0;$i<$cntH;$i++){?>
                    <tr>
                      <td class="text-center" width="5%"><span id="<?=$dbValuationComment[$i]['id']?>">
                        <input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbValuationComment[$i]['id']?>">
                        </span></td>
                      <td width="10%"><?=$dbValuationComment[$i]['name']?></td>
                      <td width="10%"><?=$dbValuationComment[$i]['email']?></td>
                      <td width="10%"><?=$dbValuationComment[$i]['comment']?></td>
                      <td width="10%"><?=$dbValuationComment[$i]['comment_date']?></td>
                      <td  width="10%"><?php 
                          if($dbValuationComment[$i]['admin_comment'] == null){
                          ?>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_<?=$i+1?>">Replay</button>
                        
                        <!-- Modal -->
                        
                        <div id="myModal_<?=$i+1?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <form action="contentController.php" method="post" >
                              <!-- Modal content-->
                              <input type="hidden" name="mode" value="add_admin_comment" />
                              <input type="hidden" name="id" value="<?=$dbValuationComment[$i]['id']?>" />
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
                        <?=$dbValuationComment[$i]['admin_comment']?>
                        <?php 
                          }
                          ?></td>
                      <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbValuationComment[$i]['status']==1)?'checked':''?> onClick="comment_status(<?=$dbValuationComment[$i]['id']?>,this.value,this.checked)" value="<?=$dbValuationComment[$i]['id']?>"></td>
                    </tr>
                    <?php }?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="text-center" width="5%"> <input type="checkbox" id="select" onClick="return selectAll()"/></th>
                      <th width="10%">Name</th>
                      <th width="10%">Email</th>
                      <th width="10%">Comment</th>
                      <th width="10%">Comment Date</th>
                      <th width="10%">Reply comment</th>
                      <th width="5%">Status</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
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
		url:'blogController.php?mode=valuation_comment_status',
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
</script>