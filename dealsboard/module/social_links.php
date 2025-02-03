<?php
login_check(); ///to check weatther user is login or not
access_check("social_links"); // check access permission
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$msg = base64_decode($_REQUEST['msg'] ?? "");
$page_limit = $dbObj->sc_mysql_escape($_REQUEST['page_limit'] ?? "");
if(!empty($_REQUEST['sort'])){
	$sort = $_REQUEST['sort'];
} else {
	$sort = "id asc"; // default sort by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."social_links"; // for total number of records for paging
$dbResult = $dbObj->SelectQuery('user.php','get_admin_list()');
$totalrecords = $dbResult[0]["total"];
  
require_once(PHP_FUNCTION_DIR.'admin-paging.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."social_links"; // for listing of records
$dbObj->dbQuery.=" order by $sort $page_limit";
$dbSocial = $dbObj->SelectQuery();
$cntH = count((array)$dbSocial);

$dbObj->dbQuery="select * from ".PREFIX."social_links where id='".$id."'";
$Social = $dbObj->SelectQuery();
?>
<style>
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
      <?php if(!empty($id)){ ?>
      <form class="mws-form wzd-default" action="contentController.php" method="post" id="accForm">
        <input type="hidden" name="mode" value="update_social_links" />
        <input type="hidden" name="id" value="<?=$id?>" />
        <div class="row" id="main">
          <div class="col-md-12" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Update Social Media (
                  <?=$Social[0]['site_name']?>
                  ) <i class="fa accrd-controller fa-caret-down pull-right"></i> </a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <h6>Link</h6>
                    <input class="form-control" type="text" name="info[link]" id="link" placeholder="Link" value="<?=$Social[0]['link']?>">
                    <br>
                    <br>
                    <h6>Target</h6>
                    <select class="form-control" name="info[target]">
                      <option value="">Select</option>
                      <option value="_blank" <?=($Social[0]['target'] == '_blank')?'selected':''?>>Blank</option>
                      <option value="_self" <?=($Social[0]['target'] == '_self')?'selected':''?>>Self</option>
                    </select>
                    <br>
                    <br>
                    <button onClick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success ml-auto">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <?php }?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <?php if(!empty($msg)){ ?>
              <legend class="wizard-label">
              <?=$msg?>
              </legend>
              <?php } ?>
              <h3>Manage Social Media</h3>
              <div class="table-responsive mt-10">
                <table width="100%" class="table table-hover table-bordered mws-datatable-fn mws-table">
                  <?php if($cntH>0){ ?>
                  <thead>
                    <tr>
                      <th width="20%">Site Name</th>
                      <th width="30%">Link</th>
                      <th width="8%">Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for($i=0;$i<$cntH;$i++){?>
                    <tr>
                      <td><?=$dbSocial[$i]['site_name']?></td>
                      <td><?=$dbSocial[$i]['link']?></td>
                      <td><a href="index.php?mo=social_links&id=<?=$dbSocial[$i]['id']?>" class="text-primary"> Edit</a></td>
                    </tr>
                    <?php }?>
                  </tbody>
                  <?php }else{?>
                  <p style="color:#FF0000; text-align:center; padding-top:5px;"> No Record Found</p>
                  <?php }?>
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
<script type="text/javascript">
 function ckhform(){
	if(isEmpty("Link",document.getElementById("link").value)){
		document.getElementById("link").focus();
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