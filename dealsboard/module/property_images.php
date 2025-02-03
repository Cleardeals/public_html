<?php
login_check(); ///to check weatther user is login or not
access_check('property_images');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$property_id = $dbObj->sc_mysql_escape($_REQUEST['property_id'] ?? "");
$var_extra = "property_images"; // to enable page link
//$sortLink = "services";// to get sort result of text of search
if(!empty($_REQUEST['sort_order'])){
	$sort = "$sort_by $sort_order";
} else {
	$sort = "display_order asc"; // default sort by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."property_images where property_id='".$property_id."'"; // for total number of records for paging
$dbResult = $dbObj->SelectQuery('user.php','get_admin_list()');
$totalrecords = $dbResult[0]["total"];
  
require_once(PHP_FUNCTION_DIR.'admin-paging.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."property_images where property_id='".$property_id."'";  // for listing of records
if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbPropertyImages = $dbObj->SelectQuery();
$cntH = count((array)$dbPropertyImages);
$count = count((array)$dbPropertyImages);
$list = $dbPropertyImages[0]['display_order'] ?? "";

$dbObj->dbQuery="select * from ".PREFIX."property_images where property_id='".$property_id."' and id='".$id."'";
$PropertyImage = $dbObj->SelectQuery();
//echo $dbObj->dbQuery;
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
      <form action="propertyController.php" method="post" id="accForm" enctype="multipart/form-data">
        <input type="hidden" name="mode" value="update_property_images" />
        <input type="hidden" name="id" value="<?=$id?>" />
        <input type="hidden" name="property_id" value="<?=$property_id?>" />
        <div class="row" id="main">
          <div class="col-md-12" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Add/Update Property Images <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <h6>Upload Image</h6>
                    <?php if(!empty($id)){ 
					  if(!empty($PropertyImage[0]['image'])){ ?>
                    <div class="mws-form-row">
                      <label class="mws-form-label">&nbsp;</label>
                      <div class="mws-form-item"> <img src="../cms_images/property/thumb/<?=$PropertyImage[0]['image']?>" width="150"/> </div>
                    </div>
                    <?php } ?>
                    <input class="form-control" type="file" name="image" id="image" value="<?=$PropertyImage[0]['image']?>">
                    <label for="picture" class="error" generated="true" style="display:none"></label>
                    <span style="color:#F00"> Supportable Image Format jpg, jpeg, png</span><br />
                    <span style="color:#F00"> Image size for should be ( 770 X 514 )</span> <br>
                    <br>
                    <button onClick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success ml-auto">Submit</button>
                    <?php } else { ?>
                    <div id="mulitplefileuploader"></div>
                    <span style="color:#F00;margin-left:25px;"> Supportable Image Format jpg, jpeg, png</span><br />
                    <span style="color:#F00;margin-left:25px;"> Image size for should be ( 770 X 514 )</span>
                    <div id="status"></div>
                    <?php } ?>
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
              <h3>Manage Property Images</h3>
              <div class="table-responsive mt-10">
                <form action="propertyController.php" method="post" id="hostForm">
                  <input type="hidden" name="mode" value="delete_property_images"/>
                  <input type="hidden" name="counter" id="counter" value="<?=count($dbPropertyImages)?>" />
                  <input type="hidden" name="id" value="<?=$id?>" />
                  <input type="hidden" name="property_id" value="<?=$property_id?>" />
                  <table width="100%" class="table table-hover table-bordered mws-datatable-fn mws-table">
                    <?php if($cntH>0){ ?>
                    <thead>
                      <tr>
                        <th width="5%"><input type="checkbox" id="select" onClick="return selectAll()"/></th>
                        <th width="10%">Image</th>
                        <th width="10%">Display Order</th>
                        <th width="10%">Front Status</th>
                        <th width="8%">Status</th>
                        <th width="8%">Edit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td colspan="6" style="margin:0;padding:0;"><div id="contentLeft">
                            <ul style="padding:0;margin:0;" id="changes">
                              <?php for($i=0;$i<$cntH;$i++){?>
                              <li id="recordsArray_<?=$dbPropertyImages[$i]['id']?>">
                                <table width="100%">
                                  <tr>
                                    <td style="text-align:center" width="5%"><input type="checkbox" id="c<?=$i?>" name="id[]" value="<?=$dbPropertyImages[$i]['id']?>"></td>
                                    <td width="10%" id="move"><img src="../cms_images/property/thumb/<?=$dbPropertyImages[$i]['image']?>" width="100" /></td>
                                    <td width="10%" id="move"><?=$dbPropertyImages[$i]['display_order']?></td>
                                    <td align="center" width="10%"><input type="checkbox" id="s<?=$i+1?>"  <?=($dbPropertyImages[$i]['front_status']==1)?'checked':''?> onClick="front_status(<?=$dbPropertyImages[$i]['id']?>,this.value,this.checked)" value="<?=$dbPropertyImages[$i]['id']?>"></td>
                                    <td align="center" width="8%"><input type="checkbox" id="s<?=$i+1?>"  <?=($dbPropertyImages[$i]['status']==1)?'checked':''?> onClick="pro_image_status(<?=$dbPropertyImages[$i]['id']?>,this.value,this.checked)" value="<?=$dbPropertyImages[$i]['id']?>"></td>
                                    <td align="center" width="8%"><a href="index.php?mo=property_images&property_id=<?=$dbPropertyImages[$i]['property_id']?>&id=<?=$dbPropertyImages[$i]['id']?>" class="text-primary">Edit</a></td>
                                  </tr>
                                </table>
                              </li>
                              <?php } ?>
                            </ul>
                          </div></td>
                      </tr>
                    </tbody>
                    <?php } else { ?>
                    <p style="color:#FF0000;text-align:center;padding-top:5px;"> No Record Found</p>
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
                  <a class="btn btn-primary" href="index.php?mo=property_images&property_id=<?=$property_id?>&view=all">View All</a>
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
		data:'id='+value+'&setval='+setval+'&page=<?=$page?>&set=<?=$set?>',
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
		data:'id='+value+'&setval='+setval+'&page=<?=$page?>&set=<?=$set?>',
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