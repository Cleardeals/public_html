<?php
login_check(); ///to check weatther user is login or not
access_check('property_images');
$page = $dbObj->sc_mysql_escape($_REQUEST['page'] ?? ""); // paging variable
$set = $dbObj->sc_mysql_escape($_REQUEST['set'] ?? ""); // paging variable
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");
$var_extra = "delete_review"; // to enable page link
//$sortLink = "services";// to get sort result of text of search
if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "display_order asc"; // default sort by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."review where id!=''"; // for total number of records for paging
$dbResult = $dbObj->SelectQuery('user.php','get_admin_list()');
$totalrecords = $dbResult[0]["total"];
  
require_once(PHP_FUNCTION_DIR.'admin-paging.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."review where id!=''";  // for listing of records
if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbReview = $dbObj->SelectQuery();
$cntH = count((array)$dbReview);
$list = $dbReview[0]['display_order'];

$dbObj->dbQuery="select * from ".PREFIX."property_images where property_id='".$property_id."' and id='".$id."'";
$PropertyImage = $dbObj->SelectQuery();
//echo $dbObj->dbQuery;
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
              <h3>Manage Review</h3>
              <div class="table-responsive mt-10">
                <form action="reviewController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_review"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbReview)?>" />
                  <input type="hidden" name="id" value="<?=$id?>" />
                  <input type="hidden" name="page" value="<?=$page?>">
                  <input type="hidden" name="set" value="<?=$set?>">
                  <table width="100%" class="table table-hover table-bordered mws-datatable-fn mws-table">
                    <?php if($cntH>0){ ?>
                    <thead>
                      <tr>
                        <th width="5%"><input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="15%">Name</th>
                        <th width="25%">Email</th>
                        <th width="25%">Review</th>
                        <th width="5%">Rating</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="6" style="margin:0;padding:0;">
                        <div id="contentLeft">
                            <ul style="padding:0;margin:0;" id="changes">
                              <?php for($i=0;$i<$cntH;$i++){?>
                              <li id="recordsArray_<?=$dbReview[$i]['id']?>">
                                <table width="100%">
                                  <tr>
                                    <td style="text-align:center" width="5%"><input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbReview[$i]['id']?>"></td>
                                    <td width="15%"><?=$dbReview[$i]['name']?></td>
                                    <td width="25%">
									<?=$dbReview[$i]['email']?>
                                    </td>
                                    <td align="center" width="25%"><?=wordwrap($dbReview[$i]['review'],45,"<br>\n");?></td>
                                    <td align="center" width="5%"><?=$dbReview[$i]['rating']?> star</td>
                                  </tr>
                                </table>
                              </li>
                              <?php } ?>
                            </ul>
                          </div></td>
                      </tr>
                    </tbody>
                    <?php } else { ?>
                    <p style="color:#FF0000;text-align:center;padding-top:5px;">
                    No Record Found</p>
                    <?php } ?>
                  </table>
                </form>
              </div>
              <?php if($cntH>0){ ?>
              <button onClick="return delete_records();" class="btn btn-primary pull-left" type="button"> Delete</button>
              <div class="text-right right">
                <ul class="pagination pull-right">
                  <?php if(empty($view)){
				  		echo $page_link;
				   }?>
                  <a class="btn btn-primary" href="index.php?mo=delete_review&view=all">View All</a>
                </ul>
              </div>
              <?php } ?>
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
<script src="../cms_js/jquery.min.js"></script>
<link href="multiimageuploader/uploadfilemulti.css" rel="stylesheet">
<script src="multiimageuploader/jquery.fileuploadmulti.min.js"></script> 
<script type="text/javascript" src="../cms_js/jquery-drag-n-drop/jquery-ui-1.7.1.custom.min.js"></script> 
<script type="text/javascript">
function ckhform(){
	<?php if(empty($id)){ ?>
	if(isEmpty("Image",document.getElementById("image").value)){
		document.getElementById("image").focus();
		return false;
	}
	<?php } ?>
	if(document.getElementById("image").value!=''){
		if(!isValidateimage(document.getElementById("image").value,'jpg,jpeg,png')){	
			document.getElementById("image").focus();
			return false;
		}
	}
	
	return true;
}

function submit_host(){
	if(ckhform() == true){
		document.getElementById("accForm").submit();
	}
}

$.noConflict();
jQuery( document ).ready(function( $ ) {

var settings = {
	url: "upload.php?property_id=<?=$property_id?>",
	method: "POST",
	allowedTypes:"jpg,jpeg,png",
	fileName: "myfile",
	multiple: true,
	onSuccess:function(files,data,xhr){
		//alert(data);
		$("#status").html("<font color='green'>Upload successful</font>");
	},
    afterUploadAll:function(){
        $("#error_msg").html("<font color='red'>all images successfully uploaded.</font>");
		reloadpage();
    },
	onError: function(files,status,errMsg){		
		$("#status").html("<font color='red'>Upload is Failed</font>");
	}
}
$("#mulitplefileuploader").uploadFile(settings);

$(function() {
		$("#contentLeft ul").sortable({ opacity: 0.6, handle: '#move', update: function() {
			var order = $(this).sortable("serialize") + '&action=change_property_images_order' + '&list=<?=$list?>' + '&count=<?=$count?>'+ '&page=<?=$page?>'+ '&page_limit=<?=$page_limit?>'+ '&property_id=<?=$property_id?>'; 
			$.post("propertyController.php", order, function(theResponse){
				//alert(theResponse);
				$("#changes").html(theResponse);
				window.location.reload();
			}); 															 
		}								  
		});
	});

});

function reloadpage(){
	setTimeout(window.location.reload(), 8000);
}

function front_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'propertyController.php?mode=front_status',
		data:'id='+value+'&setval='+setval,
		success:function(response){
			//alert(response);
			//document.getElementById("msg").innerHTML = "Status Successfully Changed";
			//alert("Status changed successfully.");
		}
	});
}

function pro_image_status(id,value,is_check){
	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'propertyController.php?mode=pro_image_status',
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