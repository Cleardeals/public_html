<?php
login_check(); ///to check weatther user is login or not
//access_check('video_testimonial');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");
$var_extra = "video_testimonial"; // to enable page link
//$sortLink = "services";// to get sort result of text of search

if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "display_order asc"; // default sort by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."testimonial_video where id!=''"; // for total number of records for paging
$dbResult = $dbObj->SelectQuery('user.php','get_admin_list()');
$totalrecords = $dbResult[0]["total"];

require_once(PHP_FUNCTION_DIR.'admin-paging.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."testimonial_video where id!=''"; // for listing of records
if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbVideo = $dbObj->SelectQuery();
$cntH = count((array)$dbVideo);
$list = $dbVideo[0]['display_order'];
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
                <div  class="text-left col-md-6"> <a href="index.php?mo=add_video_testimonial" class="btn waves-effect waves-light btn-rounded btn-primary"> Add New</a></div>
                <div class="col-md-6 text-right">
                  <p style="padding-top:5px; color:#F00"> Change display order work on view all entries**</p>
                </div>
              </div>
              <div class="table-responsive mt-10">
                <form action="videoController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_faq"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbVideo)?>" />
                  <table id="myTable" class="display nowrap table table-hover table-striped table-bordered" width="100%">
                    <thead>
                      <tr>
                        <th class="text-center" width="5%"> S.No.<!--<input type="checkbox" id="select" onClick="return selectAll()"/>--></th>
                        <th width="10%">Video</th>
                        <th width="5%">Display Order</th>
                        <th width="5%">Status</th>
                        <th width="5%">Edit</th>
                      </tr>
                    </thead>
                    <tbody id="changes">
                      <?php for($i=0;$i<$cntH;$i++){?>
                      <tr>
                        <td class="text-center" width="5%"><span id="<?=$dbVideo[$i]['id']?>">
                          <input type="hidden" id="c<?=$i?>" name="id[]" value="<?=$dbVideo[$i]['id']?>">
                          <?=$i+1?>
                          </span></td>
                        <td id="move" width="10%"><iframe width="250" height="100" src="https://www.youtube.com/embed/<?=$dbVideo[$i]['embed_code']?>" frameborder="0" allowfullscreen></iframe></td>
                        <td id="move" width="5%"><?=$dbVideo[$i]['display_order']?></td>
                        <td width="5%"><input type="checkbox" id="s<?=$i+1?>" <?=($dbVideo[$i]['status']==1)?'checked':''?> onClick="video_status(<?=$dbVideo[$i]['id']?>,this.value,this.checked)" value="<?=$dbVideo[$i]['id']?>"></td>
                        <td width="5%"><a href="index.php?mo=add_video_testimonial&id=<?=$dbVideo[$i]['id']?>" class="text-primary"> <i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="videoController.php?mode=delete_video&id=<?=$dbVideo[$i]['id']?>" class="text-primary" data-confirm="Are you sure you want to delete?"> <i class="fa fa-trash"></i></a></td>
                      </tr>
                      <?php }?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="text-center" width="5%"> S.No.<!--<input type="checkbox" id="select" onClick="return selectAll()"/>--></th>
                        <th width="10%">Video</th>
                        <th width="5%">Display Order</th>
                        <th width="5%">Status</th>
                        <th width="5%">Edit</th>
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

<!-- <script src="../cms_js/jquery.min.js"></script> --> 
<script type="text/javascript">
function video_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'videoController.php?mode=video_status',
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