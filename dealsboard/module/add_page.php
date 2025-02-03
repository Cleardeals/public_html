<?php
login_check(); ///to check weatther user is login or not
access_check('add_page');

$msg = base64_decode($_REQUEST['msg'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");

//to get selected id's record
$dbObj->dbQuery="select * from ".PREFIX."sitecontent where id='".$id."'";
$dbRes = $dbObj->SelectQuery();
//print_r($dbRes);

//to get selected id's record
$dbObj->dbQuery="select menu_name from ".PREFIX."sitecontent where id='".$id."'";
$dbResult = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."about where pageid='".$id."'";
$dbAbout = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."home where pageid='".$id."'";
$dbHome = $dbObj->SelectQuery();
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
        <input type="hidden" name="mode" value="add_update_mainpages" />
        <input type="hidden" name="id" value="<?=$id?>" />
        <div class="row" id="main">
          <div class="col-md-9" id="content">
            <input class="form-control" type="text" name="info[menu_name]" id="menu_name" placeholder="Menu Name" value="<?=$dbRes[0]['menu_name']?>">
            <div class="perma-link"> <a href="<?=HTACCESS_URL?><?=$dbRes[0]['url']?>/" target="_blank"> 
            <i class="mdi mdi-link-variant mr-5"></i> Page Live Link</a> </div>
            <div class="row accordion" id="accordion1">
              <div class="col-md-12">
                <div class="card"> 
                <a class="card-header collapsed in card-title" data-toggle="collapse" href="#collapseOne"> 
                Page Detail <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseOne" class="card-body collapse show border font-13" data-parent="#accordion1">
                    <?php if($id=='1' || $id=='2' || $id=='3' || $id=='4' || $id=='18'){?>
                    <h6>Title</h6>
                    <input class="form-control" type="text" name="info[title]" id="title" placeholder="Title" value="<?=$dbRes[0]['title']?>">
                    <br>
                    <br>
                    <?php }?>
                    <?php if($id!='18'){?>
                    <h6>Heading</h6>
                    <input class="form-control" type="text" name="info[heading]" id="heading" placeholder="Heading" value="<?=$dbRes[0]['heading']?>">
                    <br>
                    <br>
                    <?php }?>
                    <?php if($id=='2' || $id=='5'){?>
                    <h6>Short Description</h6>
                    <textarea class="form-control" name="info[short_desc]" id="short_desc"><?=$dbRes[0]['short_desc']?></textarea>
                    <br>
                    <br>
                    <?php }?>
                    <?php if($id=='1' || $id=='2'){?>
                    <h6>Image</h6>
                    <?php if(!empty($dbRes[0]['image'])) {?>
                    <div class="mws-form-row">
                      <label class="mws-form-label">&nbsp;</label>
                      <div class="mws-form-item"> 
                      <img src="../cms_images/pages/original/<?=$dbRes[0]['image']?>" width="150"/>
                      <label for="picture" class="error" generated="true" style="display:none"></label>
                      </div>
                    </div>
                    <?php } ?>
                    <br>
                    <br>
                    <input class="form-control" type="file" name="image" id="image">
                    <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                    Image size should be (1903 X 574)</span> <br>
                    <br>
                    <?php }?>
                    <!-- <div class="summernote">
                    <h3>Default Editor</h3>
                  </div>-->
                    <?php if($id=='1' || $id=='13' || $id=='14' || $id=='15' || $id=='16' || $id=='18'){?>
                    <h6>Content</h6>
                    <?php
					$ckeditor = new CKEditor();
					$ckeditor->config['toolbar'] = 'Full';
					$ckeditor->basePath = EDITOR_DIR.'ckeditor/';
					$ckfinder = new CKFinder();
					$ckfinder->BasePath = '../cms_js/editor/ckfinder/'; // Note: the BasePath property in the CKFinder class starts with a capital letter.
					$ckfinder->SetupCKEditorObject($ckeditor);
					$ckeditor->editor('info[content]',html_entity_decode($dbRes[0]['content']));
					?>
                    <?php }?>
                    <br>
                    <br>
                    <?php if($id=='1'){?>
                     <h6>Video</h6>
                    <textarea class="form-control" name="hdata[h_video]" id="h_video"><?=$dbHome[0]['h_video']?></textarea>
                    <br>
                    <br>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
            <?php if($id=='2'){?>
            <div class="row accordion" id="accordion2">
              <div class="col-md-12">
                <div class="card"><a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo"> Section 1 <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseTwo" class="collapse font-13" data-parent="#accordion">
                    <div class="card-body">
                      <h6>Heading</h6>
                      <input class="form-control" type="text" name="adata[ab_heading]" id="ab_heading" placeholder="Heading" value="<?=$dbAbout[0]['ab_heading']?>">
                      <br>
                      <br>
                      <h6>Image 1 </h6>
                      <?php if(!empty($dbAbout[0]['image1'])) {?>
                      <div class="mws-form-row">
                        <label class="mws-form-label">&nbsp;</label>
                        <div class="mws-form-item"> 
                        <img src="../cms_images/pages/original/<?=$dbAbout[0]['image1']?>" width="150"/>
                        <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>
                      </div>
                      <?php } ?>
                      <br>
                      <br>
                      <input class="form-control" type="file" name="image1" id="image1">
                      <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                      Image size should be (566 X 610)</span> <br>
                      <br>
                      <h6>Title 1</h6>
                      <input class="form-control" type="text" name="adata[ab_title1]" id="ab_title1" placeholder="Title 1" value="<?=$dbAbout[0]['ab_title1']?>">
                      <br>
                      <br>
                      <h6>Link 1</h6>
                      <input class="form-control" type="text" name="adata[ab_url1]" id="ab_url1" placeholder="Link 1" value="<?=$dbAbout[0]['ab_url1']?>">
                      <br>
                      <br>
                      <h6>Image 2 </h6>
                      <?php if(!empty($dbAbout[0]['image2'])) {?>
                      <div class="mws-form-row">
                        <label class="mws-form-label">&nbsp;</label>
                        <div class="mws-form-item"> 
                        <img src="../cms_images/pages/original/<?=$dbAbout[0]['image2']?>" width="150"/>
                        <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>
                      </div>
                      <?php } ?>
                      <br>
                      <br>
                      <input class="form-control" type="file" name="image2" id="image2">
                      <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                      Image size should be (566 X 610)</span> <br>
                      <br>
                      <h6>Title 2</h6>
                      <input class="form-control" type="text" name="adata[ab_title2]" id="ab_title2" placeholder="Title 2" value="<?=$dbAbout[0]['ab_title2']?>">
                      <br>
                      <br>
                      <h6>Link 2</h6>
                      <input class="form-control" type="text" name="adata[ab_url2]" id="ab_url2" placeholder="Link 2" value="<?=$dbAbout[0]['ab_url2']?>">
                      <br>
                      <br>
                      <h6>Image 3 </h6>
                      <?php if(!empty($dbAbout[0]['image3'])) {?>
                      <div class="mws-form-row">
                        <label class="mws-form-label">&nbsp;</label>
                        <div class="mws-form-item"> 
                        <img src="../cms_images/pages/original/<?=$dbAbout[0]['image3']?>" width="150"/>
                        <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>
                      </div>
                      <?php } ?>
                      <br>
                      <br>
                      <input class="form-control" type="file" name="image3" id="image3">
                      <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                      Image size should be (566 X 610)</span> <br>
                      <br>
                      <h6>Title 3 </h6>
                      <input class="form-control" type="text" name="adata[ab_title3]" id="ab_title3" placeholder="Title 3" value="<?=$dbAbout[0]['ab_title3']?>">
                      <br>
                      <br>
                      <h6>Link 3 </h6>
                      <input class="form-control" type="text" name="adata[ab_url3]" id="ab_url3" placeholder="Link 3" value="<?=$dbAbout[0]['ab_url3']?>">
                      <br>
                      <br>
                      <h6>Image 4 </h6>
                      <?php if(!empty($dbAbout[0]['image4'])) {?>
                      <div class="mws-form-row">
                        <label class="mws-form-label">&nbsp;</label>
                        <div class="mws-form-item"> 
                        <img src="../cms_images/pages/original/<?=$dbAbout[0]['image4']?>" width="150"/>
                        <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>
                      </div>
                      <?php } ?>
                      <br>
                      <br>
                      <input class="form-control" type="file" name="image4" id="image4">
                      <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                      Image size should be (566 X 610)</span> <br>
                      <br>
                      <h6>Title 4 </h6>
                      <input class="form-control" type="text" name="adata[ab_title4]" id="ab_title4" placeholder="Title 4" value="<?=$dbAbout[0]['ab_title4']?>">
                      <br>
                      <br>
                      <h6>Link 4 </h6>
                      <input class="form-control" type="text" name="adata[ab_url4]" id="ab_url4" placeholder="Link 4" value="<?=$dbAbout[0]['ab_url4']?>">
                      <br>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>
             <?php if($id=='1'){?>
            <div class="row accordion" id="accordion3">
              <div class="col-md-12">
                <div class="card"><a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree"> Saving average deal time 
                <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseThree" class="collapse font-13" data-parent="#accordion">
                    <div class="card-body">
                     <h6>Title</h6>
                      <input class="form-control" type="text" name="hdata[h_title]" id="h_title" placeholder="Title" value="<?=$dbHome[0]['h_title']?>">
                      <br>
                      <br>
                       <h6>Subtitle</h6>
                      <input class="form-control" type="text" name="hdata[h_subtitle]" id="h_subtitle" placeholder="Subtitle" value="<?=$dbHome[0]['h_subtitle']?>">
                      <br>
                      <br>
                      <h6>Image 1 </h6>
                      <?php if(!empty($dbHome[0]['image1'])) {?>
                      <div class="mws-form-row">
                        <label class="mws-form-label">&nbsp;</label>
                        <div class="mws-form-item"> 
                        <img src="../cms_images/pages/thumb/<?=$dbHome[0]['image1']?>" width="150"/>
                        <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>
                      </div>
                      <?php } ?>
                      <br>
                      <br>
                      <input class="form-control" type="file" name="image1" id="image1">
                      <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                      Image size should be (55 X 55)</span> <br>
                      <br>
                      <h6>Title 1</h6>
                      <input class="form-control" type="text" name="hdata[h_title1]" id="h_title1" placeholder="Title 1" value="<?=$dbHome[0]['h_title1']?>">
                      <br>
                      <br>
                      <h6>Detail 1</h6>
                      <input class="form-control" type="text" name="hdata[h_detail1]" id="h_detail1" placeholder="Detail 1" value="<?=$dbHome[0]['h_detail1']?>">
                      <br>
                      <br>
                      <h6>Image 2 </h6>
                      <?php if(!empty($dbHome[0]['image2'])) {?>
                      <div class="mws-form-row">
                        <label class="mws-form-label">&nbsp;</label>
                        <div class="mws-form-item"> 
                        <img src="../cms_images/pages/thumb/<?=$dbHome[0]['image2']?>" width="150"/>
                        <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>
                      </div>
                      <?php } ?>
                      <br>
                      <br>
                      <input class="form-control" type="file" name="image2" id="image2">
                      <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                      Image size should be (55 X 55)</span> <br>
                      <br>
                      <h6>Title 2</h6>
                      <input class="form-control" type="text" name="hdata[h_title2]" id="h_title2" placeholder="Title 2" value="<?=$dbHome[0]['h_title2']?>">
                      <br>
                      <br>
                      <h6>Detail 2</h6>
                      <input class="form-control" type="text" name="hdata[h_detail2]" id="h_detail2" placeholder="Detail 2" value="<?=$dbHome[0]['h_detail2']?>">
                      <br>
                      <br>
                      <h6>Image 3 </h6>
                      <?php if(!empty($dbHome[0]['image3'])) {?>
                      <div class="mws-form-row">
                        <label class="mws-form-label">&nbsp;</label>
                        <div class="mws-form-item"> 
                        <img src="../cms_images/pages/thumb/<?=$dbHome[0]['image3']?>" width="150"/>
                        <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>
                      </div>
                      <?php } ?>
                      <br>
                      <br>
                      <input class="form-control" type="file" name="image3" id="image3">
                      <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                      Image size should be (55 X 55)</span> <br>
                      <br>
                      <h6>Title 3 </h6>
                      <input class="form-control" type="text" name="hdata[h_title3]" id="h_title3" placeholder="Title 3" value="<?=$dbHome[0]['h_title3']?>">
                      <br>
                      <br>
                      <h6>Detail 3 </h6>
                      <input class="form-control" type="text" name="hdata[h_detail3]" id="h_detail3" placeholder="Detail 3" value="<?=$dbHome[0]['h_detail3']?>">
                      <br>
                      <br>
                      <h6>Image 4 </h6>
                      <?php if(!empty($dbHome[0]['image4'])) {?>
                      <div class="mws-form-row">
                        <label class="mws-form-label">&nbsp;</label>
                        <div class="mws-form-item"> 
                        <img src="../cms_images/pages/thumb/<?=$dbHome[0]['image4']?>" width="150"/>
                        <label for="picture" class="error" generated="true" style="display:none"></label>
                        </div>
                      </div>
                      <?php } ?>
                      <br>
                      <br>
                      <input class="form-control" type="file" name="image4" id="image4">
                      <span style="color:#F00">Supportable Image Format jpg, jpeg, png <br />
                      Image size should be (55 X 55)</span> <br>
                      <br>
                      <h6>Title 4 </h6>
                      <input class="form-control" type="text" name="hdata[h_title4]" id="h_title4" placeholder="Title 4" value="<?=$dbHome[0]['h_title4']?>">
                      <br>
                      <br>
                      <h6>Detail 4 </h6>
                      <input class="form-control" type="text" name="hdata[h_detail4]" id="h_detail4" placeholder="Detail 4" value="<?=$dbHome[0]['h_detail4']?>">
                      <br>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }?>
            <?php 
            if($_REQUEST['id'] != 6){
              ?>
              <div class="row accordion" id="accordion4">
              <div class="col-md-12">
                <div class="card"> <a class="card-header collapsed card-title" data-toggle="collapse" data-parent="#accordion4" href="#collapseFour">Seo <i class="fa accrd-controller fa-caret-down pull-right"></i></a>
                  <div id="collapseFour" class="collapse font-13" data-parent="#accordion" >
                    <div class="card-body">
                      <h6>Title</h6>
                      <input class="form-control" name="info[seo_title]" id="seo_title" type="text" value="<?=$dbRes[0]['seo_title']?>">
                      <br>
                      <br>
                      <h6>Meta Keywords</h6>
                      <textarea class="form-control" name="info[meta_keyword]" id="meta_keyword"><?=$dbRes[0]['meta_keyword']?></textarea>
                      <br>
                      <br>
                      <h6>Meta Description</h6>
                      <textarea class="form-control" name="info[meta_desc]" id="meta_desc"><?=$dbRes[0]['meta_desc']?></textarea>
                      <br>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <?php 
            } ?>
            
          </div>
          <div class="col-md-3 position-relative">
            <div>
              <div class="card" id="sidebar">
                <div class="card-body">
                  <h4 class="card-title text-uppercase">Publish Page</h4>
                  <ul class="page-publish">
                    <li>Status:
                      <select name="info[status]" class="form-control" style="width:150px;">
                        <option value="1" <?=($dbRes[0]['status']==1)?'selected':''?>>Published</option>
                        <option value="0" <?=($dbRes[0]['status']==0)?'selected':''?>>Unpublished</option>
                      </select>
                    </li>
                    <li> Published on
                      <?php if(!empty($dbRes[0]['published_on'])){?>
                      <?=date('d/m/Y',strtotime($dbRes[0]['published_on']));?>
                      <?php }else{?>
                      <?=date('d/m/Y');?>
                      <?php }?>
                    </li>
                  </ul>
                  <div class="d-flex">
                    <button onClick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success mr-auto">Save</button>
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

<script src="assets/vendors/sticky-sidebar/stickySidebar.js"></script> 
<script>
$(document).ready(function() {
	$('#sidebar').stickySidebar({
		sidebarTopMargin: 0,
		footerThreshold: 100
	});
});
</script> 
<script>
$(document).ready(function(){
	// Add minus icon for collapse element which is open by default
	$(".collapse.show").each(function(){
		$(this).prev(".card-header").find(".fa").addClass("fa-caret-up").removeClass("fa-caret-down");
	});
	
	// Toggle plus minus icon on show hide of collapse element
	$(".collapse").on('show.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-caret-down").addClass("fa-caret-up");
	}).on('hide.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-caret-up").addClass("fa-caret-down");
	});
});
</script> 
<script type="text/javascript">
function ckhform(){
	
	if(isEmpty("Menu Name",document.getElementById("menu_name").value)){
		document.getElementById("menu_name").focus();
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