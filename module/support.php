<?php include(INCLUDE_DIR.'header1.php') ?>
<?php
if(!isset($_SESSION['user']['is_login'])) {
	header('location:'.HTACCESS_URL.'sign-up/');
	exit;
}

$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$_SESSION['user']['userid']."'"; // for listing of records
$dbUsers = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."find_msg where username='".$dbUsers[0]['username']."' and user_read_status='read' order by id desc"; // for listing of records
$dbUserMsg = $dbObj->SelectQuery();
//print_r($dbUserMsg);

// calculate time
function humanTiming ($time)
					{
					
						$time = time() - $time; // to get the time since that moment
						$time = ($time<1)? 1 : $time;
						$tokens = array (
							31536000 => 'year',
							2592000 => 'month',
							604800 => 'week',
							86400 => 'day',
							3600 => 'hour',
							60 => 'minute',
							1 => 'second'
						);
					
						foreach ($tokens as $unit => $text) {
							if ($time < $unit) continue;
							$numberOfUnits = floor($time / $unit);
							return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
						}
					
					}
?>
<link rel="stylesheet" href="<?=HTACCESS_URL?>assets/css/dashboard.css">
<div class="center-section">
  <div class="container">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <?php include(INCLUDE_DIR.'left-menu.php'); ?>
        </div>
        <div class="col-lg-9">
          <h2 class="font-24 text-uppercase text-center font-extrabold header-border mb-1 pb-2"> <span class="themecolor">Support </span> </h2>
          <div class="row justify-content-center">
            <form action="<?=HTACCESS_URL?>supportController.php" method="post" id="accForm" autocomplete="off" enctype="multipart/form-data" class="w-100">
              <input type="hidden" name="mode" value="send_msg">
              <input type="hidden" name="username" id="username" value="<?=$dbUsers[0]['username']?>">
              <div class="box-boder">
                <div class="row">
                  <div class="col-lg-6 col-md-5">
                    <div class="form-group">
                      <textarea class="form-control select2-search__field" name="user_msg" id="user_msg" placeholder="Type Message"></textarea>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-4">
                    <h6 class="mb-2 mt-2">Attachment</h6>
                    <div class="form-group">
                      <input type="file" name="user_attach" id="user_attach">
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 text-center">
                    <div class="form-group">
                      <button onclick="submit_host();" type="button" class="btn waves-effect btn-sm waves-light btn-success mr-auto mt-3">Send Message</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div style="overflow-y:auto; height:400px; background:#fbfbfb; padding:15px" class="mb-2">
            <div class="col-11 comments-main rounded">
              <ul class="p-0">
                <?php for($i=0;$i<count($dbUserMsg);$i++){
				  
				 $dbObj->dbQuery="select * from ".PREFIX."user_detail where username='".$dbUserMsg[$i]['username']."'";
			     $dbUserDetail = $dbObj->SelectQuery();
				 
				 //$time = strtotime('2018-02-28 15:09:43');
				  $time = strtotime(''.$dbUserMsg[$i]['msgDatetime'].'');
				 
			  ?>
                <?php if(!empty($dbUserMsg[$i]['admin_msg'])){?>
                <li>
                  <div class="row comments mb-1">
                    <div class="col-md-10 col-sm-10 col-12  rounded mb-2">
                      <div class="row">
                        <div class="col-md-6">
                          <?php if(!empty($dbUserMsg[$i]['admin_attach'])){?>
                          <p class="mt-1 mb-1"><a href="<?=HTACCESS_URL?>cms_images/chat_attachment/<?=$dbUserMsg[$i]['admin_attach']?>" style="color:#F00" target="_blank">Attachment</a></p>
                          <?php }?></div>
                        <div class="col-md-6 text-right"><a href="#" class="font-bold">Admin</a> <time><? echo ''.humanTiming($time).' ago';?></time>
                        </div>
                      </div>
                      <div class="comment chat-bubble--left">
                        <like></like>
                        <p class="mb-0">
                          <?=$dbUserMsg[$i]['admin_msg']?>
                          <br />
                      </div>
                      <div class="col-md-2 col-sm-2 col-12"></div>
                    </div>
                  </div>
                </li>
                <?php }?>
                <ul class="p-0">
                  <?php if(!empty($dbUserMsg[$i]['user_msg'])){?>
                  <li>
                    <div class="row comments mb-1">
                      <div class="col-md-2 col-sm-2 col-12"></div>
                      <div class="col-md-10 col-sm-10 col-12  rounded mb-2 pull-right">
                        <div class="row">
                          <div class="col-md-6"><?php if(!empty($dbUserMsg[$i]['user_attach'])){?>
                            <p class="mb-0"><a href="<?=HTACCESS_URL?>cms_images/chat_attachment/<?=$dbUserMsg[$i]['user_attach']?>" style="color:#F00" target="_blank">Attachment</a></p>
                            <?php }?></div>
                          <div class="col-md-6 text-right"><a href="#" class="font-bold">
                            <?=$dbUserDetail[0]['name']?>
                            </a>
                            <time><?php echo ''.humanTiming($time).' ago';?></time>
                          </div>
                        </div>
                        <div class="comment comment2 chat-bubble--right ">
                          <like></like>
                          <p class="mb-0">
                            <?=$dbUserMsg[$i]['user_msg']?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </li>
                  <?php }}?>
                  <li>
                    <div class="row comments  mb-2">
                      <p id="result"></p>
                    </div>
                  </li>
                </ul>
              </ul>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<script type="text/javascript" src="<?=HTACCESS_URL?>cms_js/javascript/formValidation.js"></script>
<script type="text/javascript">
function ckhform(){
	if(isEmpty("Message",document.getElementById("user_msg").value)){
		document.getElementById("user_msg").focus();
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
<?php unset($_SESSION['find_msg']);?>
<?php if(!isset($_SESSION['user']['is_login'])) {?>
<?php include(INCLUDE_DIR.'footer.php'); ?>
<?php }else{?>
<?php include(INCLUDE_DIR.'footer1.php'); ?>
<?php }?>