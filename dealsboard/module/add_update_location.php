<?php
login_check(); ///to check weatther user is login or not
access_check('add_update_location');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

//to get selected id's record
$dbObj->dbQuery="select * from ".PREFIX."location where id='".$id."'";
$dbLocation = $dbObj->SelectQuery();

//$dbObj->dbQuery="select * from ".PREFIX."city where id='".$dbLocation[0]['id']."'";
//$dbCity = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."city where status='1' order by display_order";
$City = $dbObj->SelectQuery();
?>
<!-- summernotes CSS -->
<link href="assets/vendors/summernote/dist/summernote.css" rel="stylesheet"/>
<link href="assets/vendors/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<!-- page css -->
<link href="assets/css/pages/tab-page.css" rel="stylesheet"/>
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
        <input type="hidden" name="mode" value="add_update_location" />
        <input type="hidden" name="id" value="<?=$id?>" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> Add/Update Location 
                <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <div class="row">
                      <div class="col-md-6">
                        <h6>City</h6>
                        <?php if(!empty($dbLocation[0]['city'])){?>
                        <select class="form-control" name="info[city]" id="city">
                          <option value="">City</option>
                          <?php for($i=0;$i<count((array)$City);$i++){?>
                          <option value="<?=$City[$i]['city_name']?>" <?=($dbLocation[0]['city']==$City[$i]['city_name'])?'selected':''?>>
                          <?=$City[$i]['city_name']?>
                          </option>
                          <?php }?>
                        </select>
                        <?php }else{?>
                        <select class="form-control" name="info[city]" id="city">
                          <option value="">City</option>
                          <?php for($i=0;$i<count((array)$City);$i++){?>
                          <option value="<?=$City[$i]['city_name']?>">
                          <?=$City[$i]['city_name']?>
                          </option>
                          <?php }?>
                        </select>
                        <?php }?>
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Location</h6>
                        <input class="form-control" type="text" name="info[location]" id="location" placeholder="Location" value="<?=$dbLocation[0]['location'] ?? ""?>">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Price Range (Min.) Rs./sq.ft</h6>
                        <input class="form-control" type="text" name="info[price_min_sq]" id="price_min_sq" placeholder="Price Range (Min.) Rs./sq.ft" value="<?=$dbLocation[0]['price_min_sq'] ?? ""?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Price Range (Max.) Rs./sq.ft</h6>
                        <input class="form-control" type="text" name="info[price_max_sq]" id="price_max_sq" placeholder="Price Range (Max.) Rs./sq.ft" value="<?=$dbLocation[0]['price_max_sq'] ?? ""?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Price Range (Min.) Rs./sq.yd</h6>
                        <input class="form-control" type="text" name="info[price_min_sq_yrd]" id="price_min_sq_yrd" placeholder="Price Range (Min.) Rs./sq.yd" value="<?=$dbLocation[0]['price_min_sq_yrd'] ?? ""?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <br>
                        <br>
                      </div>
                      <div class="col-md-6">
                        <h6>Price Range (Max.) Rs./sq.yd</h6>
                        <input class="form-control" type="text" name="info[price_max_sq_yrd]" id="price_max_sq_yrd" placeholder="Price Range (Max.) Rs./sq.yd" value="<?=$dbLocation[0]['price_max_sq_yrd'] ?? ""?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <br>
                        <br>
                      </div>
                    </div>
                    <button onClick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success ml-auto">Save</button>
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
<!-- ============================================================== --> 
<!-- All Jquery --> 
<!-- ============================================================== --> 
<script type="text/javascript">
function ckhform(){
	if(isEmpty("City",document.getElementById("city").value)){
		document.getElementById("city").focus();
		return false;
	}
	if(isEmpty("Location",document.getElementById("location").value)){
		document.getElementById("location").focus();
		return false;
	}
	if(isEmpty("Price Range (Min.) Rs./sq.ft",document.getElementById("price_min_sq").value)){
		document.getElementById("price_min_sq").focus();
		return false;
	}
	if(isEmpty("Price Range (Max.) Rs./sq.ft",document.getElementById("price_max_sq").value)){
		document.getElementById("price_max_sq").focus();
		return false;
	}
	if(isEmpty("Price Range (Min.) Rs./sq.yd",document.getElementById("price_min_sq_yrd").value)){
		document.getElementById("price_min_sq_yrd").focus();
		return false;
	}
	if(isEmpty("Price Range (Max.) Rs./sq.yd",document.getElementById("price_max_sq_yrd").value)){
		document.getElementById("price_max_sq_yrd").focus();
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