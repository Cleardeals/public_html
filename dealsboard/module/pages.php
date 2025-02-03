<?php
login_check(); ///to check weatther user is login or not
access_check('pages');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$msg1 = base64_decode($_REQUEST['msg1'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$var_extra = "pages"; // to enable page link
if(!empty($_REQUEST['sort'])){
	$sort = $_REQUEST['sort'];
} else {
	$sort = "id asc"; // default sort by id
}

$dbObj->dbQuery="select count(*) as total from ".PREFIX."sitecontent"; // for total number of records for paging
$dbResult = $dbObj->SelectQuery();
$totalrecords = $dbResult[0]["total"];

require_once(PHP_FUNCTION_DIR.'admin-paging.php'); // include paging file
$recmsg = "Page (".$page.") : Showing ".$pagerec." - ".$lastrec." Of ".$totalrecords ; // showing total records

$dbObj->dbQuery="select * from ".PREFIX."sitecontent"; // for listing of records
if(empty($view)){
	$dbObj->dbQuery.=" order by $sort $page_limit";
} else {
	$dbObj->dbQuery.=" order by $sort";
}
$dbPages = $dbObj->SelectQuery();
$cntH = count((array)$dbPages);
$list = $dbPages[0]['display_order'] ?? "";
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
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <?php if(!empty($msg)){ ?>
              <legend class="wizard-label">
              <?=$msg?>
              </legend>
              <?php } ?>
              <h3>Manage Pages</h3>
              <div class="table-responsive mt-10">
                <table width="100%" class="table table-hover table-bordered">
                  <?php if($cntH>0){ ?>
                  <thead>
                    <tr>
                      <th width="50%">Menu Name</th>
                      <th width="30%">Subpages</th>
                      <th width="20%">Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for($i=0;$i<$cntH;$i++){?>
                    <tr>
                      <td><?=$dbPages[$i]['menu_name']?></td>
                      <td><?php if($dbPages[$i]['id']=='5'){?>
                        <a href="index.php?mo=services" class="text-primary"> Manage Services</a>
                        <?php } else if($dbPages[$i]['id']=='6'){?>
                        <a href="index.php?mo=blog" class="text-primary"> Manage Blogs</a>
                        <?php } else if($dbPages[$i]['id']=='7'){?>
                        <a href="index.php?mo=faq" class="text-primary"> Manage Faq</a>
                        <?php } else if($dbPages[$i]['id']=='8'){?>
                        <a href="index.php?mo=review" class="text-primary"> Manage Review</a>
                        <?php } else if($dbPages[$i]['id']=='10'){?>
                        <a href="index.php?mo=team" class="text-primary"> Manage Team</a>
                        <?php } else if($dbPages[$i]['id']=='11'){?>
                        <a href="index.php?mo=career" class="text-primary"> Manage Careers</a>
                        <?php } else if($dbPages[$i]['id']=='12'){?>
                        <a href="index.php?mo=sell-property" class="text-primary"> Manage Pricing</a>
                        <?php } else if($dbPages[$i]['id']=='21'){?>
                        <a href="index.php?mo=book-free-valuation" class="text-primary"> Book Free Valuation</a>
                        <?php }else{echo "-";?>
                        <?php } ?></td>
                      <td><a href="index.php?mo=add_page&id=<?=$dbPages[$i]['id']?>" class="text-primary">Edit</a></td>
                    </tr>
                    <?php }?>
                  </tbody>
                  <?php }else{?>
                  <p style="color:#FF0000;text-align:center;padding-top:5px;"> No Record Found</p>
                  <?php }?>
                </table>
              </div>
              <div class="text-right right">
                <?php if($cntH>0){ ?>
                <ul class="pagination pull-right">
                  <?php if(empty($view)){
				  echo $page_link;
				   }?>
                </ul>
                <?php }?>
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