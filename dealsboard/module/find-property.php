<?php
login_check(); ///to check weatther user is login or not
access_check('find-property');
$msg = base64_decode($_REQUEST['msg'] ?? "");
$view = $dbObj->sc_mysql_escape($_REQUEST['view'] ?? "");
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$var_extra = "find-property"; // to enable page link

$dbObj->dbQuery="select * from ".PREFIX."user_detail where status='1' order by admin_read_status desc";
//$dbObj->dbQuery="select * from ".PREFIX."find_property GROUP BY user_id order by id desc"; // for listing of records
$dbUser = $dbObj->SelectQuery();
//echo $dbObj->dbQuery;
//print_r($dbFindProp);
//echo count((array)$dbFindProp);
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
.nav-link {
	display: block;
	padding: 0;
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
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Users</h4>
            </div>
          </div>
          <div class="inbox_chat">
            <ul class="" role="tablist">
              <?php for($i=0;$i<count((array)$dbUser);$i++){ 
		  
				  $dbObj->dbQuery="select * from ".PREFIX."find_property where user_id='".$dbObj->sc_mysql_escape($dbUser[$i]['id'])."'";
				  $dbFindProp = $dbObj->SelectQuery();
				  $FindPropStatus = $dbFindProp[0]['view_status'] ?? "";
				  
				  $dbObj->dbQuery="select * from ".PREFIX."find_msg where username='".$dbObj->sc_mysql_escape($dbUser[$i]['username'])."' order by id desc";
				  $dbPropUsers = $dbObj->SelectQuery();
				  $admin_read_status = $dbPropUsers[0]['admin_read_status'] ?? "";
				  
				  if(!empty($id)){
				  ?>
              <li> 
                <!--<a onClick="window.location='index.php?mo=find-property&id=<?=$dbUser[$i]['id']?>'" class="<?=$id==$dbUser[$i]['id']?'nav-link active_chat':'nav-link'?>">--> 
                <a onClick="window.location='supportController.php?mode=view_chat&id=<?=$dbUser[$i]['id']?>'" class="<?=$id==$dbUser[$i]['id']?'nav-link active_chat':'nav-link'?>">
                <div class="chat_list">
                  <div class="chat_people">
                    <div class="chat_ib">
                      <h5>
                        <?=$dbUser[$i]['name']?>
                        <?php if($FindPropStatus=='0'){ ?>
                        <span style="color:#F00;font-weight:bold">New Message</span>
                        <?php }elseif($admin_read_status=='unread'){?>
                        <span style="color:#F00;font-weight:bold">New Message</span>
                        <?php }?>
                      </h5>
                      <p>Username -
                        <?=$dbUser[$i]['username']?>
                      </p>
                    </div>
                  </div>
                </div>
                </a> </li>
              <?php }else{?>
              <li> 
                <!--<a onClick="window.location='index.php?mo=find-property&id=<?=$dbUser[$i]['id']?>'" class="<?=$i=='0'?'nav-link active_chat':'nav-link'?>">--> 
                <a onClick="window.location='supportController.php?mode=view_chat&id=<?=$dbUser[$i]['id']?>'" class="<?=$id==$dbUser[$i]['id']?'nav-link active_chat':'nav-link'?>">
                <div class="chat_list">
                  <div class="chat_people">
                    <div class="chat_ib">
                      <h5>
                        <?=$dbUser[$i]['name']?>
                        <?php if($FindPropStatus=='0'){ ?>
                        <span style="color:#F00;font-weight:bold">New Message</span>
                        <?php }elseif($admin_read_status=='unread'){?>
                        <span style="color:#F00;font-weight:bold">New Message</span>
                        <?php }?>
                      </h5>
                      <p>Username -
                        <?=$dbUser[$i]['username']?>
                      </p>
                    </div>
                  </div>
                </div>
                </a> </li>
              <?php }}?>
            </ul>
          </div>
        </div>
        <?php for($i=0;$i<count((array)$dbUser);$i++){
			  $dbObj->dbQuery="select * from ".PREFIX."find_msg where username='".$dbObj->sc_mysql_escape($dbUser[$i]['username'])."' and admin_read_status='read' order by id desc";
			  $dbAdminMsg = $dbObj->SelectQuery();
		?>
        <div id="main_place" class="tab-content">
          <?php if(!empty($id)){
			 $dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$id."'";
			 $dbUserDetail = $dbObj->SelectQuery();	
			 
			  $pDate = explode(' ', $dbFindPropty[0]['currentDate'] ?? "");
		?>
          <div class="<?=$id==$dbUser[$i]['id']?'tab-pane active':'tab-pane'?>">
            <div class="mesgs">
              <div class="msg_history"> <br />
                <form action="supportController.php" method="post" id="accForm" onSubmit="return ckhform();" enctype="multipart/form-data">
                  <input type="hidden" name="mode" value="send_msg">
                  <input type="hidden" name="id" value="<?=$dbUserDetail[0]['id']?>"/>
                  <div class="row" style="margin-left:0;margin-right:0;">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <div class="box-boder">
                        <input type="text" class="form-control" name="username" id="username" value="<?=$dbUserDetail[0]['username']?>" readonly>
                        <br />
                        <br />
                        <!--<input type="text" id="myInput<?=$dbUser[$i]['id']?>" oninput="myFunction()">

		  <input type="text" name="admin_msg" id="demo<?=$dbUser[$i]['id']?>" value="">--> 
                        <!--<input type="text" class="form-control" id="myInput" oninput="myFunction()">
          <input type="text" class="form-control" id="demo">-->
                        <textarea class="form-control" name="admin_msg<?=$dbUser[$i]['id']?>" id="admin_msg" placeholder="Type Message"></textarea>
                        <br />
                        <br />
                        <h6>Attachment</h6>
                        <input type="file" name="admin_attach<?=$dbUser[$i]['id']?>" id="admin_attach">
                        <br />
                        <br />
                        <button type="submit" class="btn waves-effect btn-sm waves-light btn-success mr-auto">Send Message</button>
                      </div>
                    </div>
                    <div class="col-md-2"></div>
                  </div>
                </form>
                <br />
                <?php for($j=0;$j<count((array)$dbAdminMsg);$j++){
			  
			  $dbObj->dbQuery="select * from ".PREFIX."user_detail where username='".$dbObj->sc_mysql_escape($dbAdminMsg[$j]['username'])."'";
			  $dbUserMsg = $dbObj->SelectQuery();
			  
			  $mDate = explode(' ', $dbAdminMsg[$j]['msgDatetime']);
			  
			  ?>
                <?php if(!empty($dbAdminMsg[$j]['user_msg'])){?>
                <div class="incoming_msg">
                  <div class="received_msg">
                    <div class="received_withd_msg">
                      <p><strong>
                        <?=$dbUserMsg[0]['name']?>
                        </strong><br />
                        <?=$dbAdminMsg[$j]['user_msg']?>
                        <br />
                        <?php if(!empty($dbAdminMsg[$j]['user_attach'])){?>
                        <a href="../cms_images/chat_attachment/<?=$dbAdminMsg[$j]['user_attach']?>" style="color:#F00;" target="_blank"> Attachment</a>
                        <?php }?>
                      </p>
                      <span class="time_date">
                      <?=date('G:i A', strtotime($mDate[1]));?>
                      |
                      <?=date('M d', strtotime($mDate[0]));?>
                      </span> </div>
                  </div>
                </div>
                <?php }?>
                <?php if(!empty($dbAdminMsg[$j]['admin_msg'])){?>
                <div class="outgoing_msg">
                  <div class="sent_msg">
                    <p><strong>Admin</strong><br />
                      <?=$dbAdminMsg[$j]['admin_msg']?>
                      <br />
                      <?php if(!empty($dbAdminMsg[$j]['admin_attach'])){?>
                      <a href="../cms_images/chat_attachment/<?=$dbAdminMsg[$j]['admin_attach']?>" style="color:#F00;" target="_blank"> Attachment</a>
                      <?php }?>
                    </p>
                    <span class="time_date">
                    <?=date('G:i A', strtotime($mDate[1]));?>
                    |
                    <?=date('M d', strtotime($mDate[0]));?>
                    </span> </div>
                </div>
                <?php }}?>
              </div>
            </div>
          </div>
          <?php }else{?>
          <div class="<?=$i=='0'?'tab-pane active':'tab-pane'?>">
            <div class="mesgs">
              <div class="msg_history"> <br />
                <div class="box-boder">
                  <form action="supportController.php" method="post" id="accForm" onSubmit="return ckhform();" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="send_msg">
                    <input type="hidden" name="id" value="<?=$id?>"/>
                    <div class="row" style="margin-left:0;margin-right:0;">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" name="username" id="username" value="<?=$dbUser[$i]['username']?>" readonly>
                        <br />
                        <br />
                        <textarea class="form-control" name="admin_msg<?=$dbUser[$i]['id']?>" id="admin_msg" placeholder="Type Message"></textarea>
                        <br />
                        <br />
                        <h6>Attachment</h6>
                        <input type="file" name="admin_attach" id="admin_attach">
                        <br />
                        <br />
                        <button type="submit" class="btn waves-effect btn-sm waves-light btn-success mr-auto">Send Message</button>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </form>
                </div>
                <br />
                <?php for($j=0;$j<count((array)$dbAdminMsg);$j++){
			  
					  $dbObj->dbQuery="select * from ".PREFIX."user_detail where username='".$dbObj->sc_mysql_escape($dbAdminMsg[$j]['username'])."'";
					  $dbUserMsg = $dbObj->SelectQuery();
					  
					  $mDate = explode(' ', $dbAdminMsg[$j]['msgDatetime']);
					  
					  ?>
                <?php if(!empty($dbAdminMsg[$j]['user_msg'])){?>
                <div class="incoming_msg">
                  <div class="received_msg">
                    <div class="received_withd_msg">
                      <p><strong>
                        <?=$dbUserMsg[0]['name']?>
                        </strong><br />
                        <?=$dbAdminMsg[$j]['user_msg']?>
                      </p>
                      <span class="time_date">
                      <?=date('G:i A', strtotime($mDate[1]));?>
                      |
                      <?=date('M d', strtotime($mDate[0]));?>
                      </span> </div>
                  </div>
                </div>
                <?php }?>
                <?php if(!empty($dbAdminMsg[$j]['admin_msg'])){?>
                <div class="outgoing_msg">
                  <div class="sent_msg">
                    <p><strong>Admin</strong><br />
                      <?=$dbAdminMsg[$j]['admin_msg']?>
                      <br />
                      <?php if(!empty($dbAdminMsg[$j]['admin_attach'])){?>
                      <a href="../cms_images/chat_attachment/<?=$dbAdminMsg[$j]['admin_attach']?>" style="color:#F00;" download="download"> Attachment</a>
                      <?php }?>
                    </p>
                    <span class="time_date">
                    <?=date('G:i A', strtotime($mDate[1]));?>
                    |
                    <?=date('M d', strtotime($mDate[0]));?>
                    </span> </div>
                </div>
                <?php }}?>
              </div>
            </div>
          </div>
          <?php }?>
        </div>
        <?php }?>
      </div>
    </div>
    <!-- ============================================================== --> 
    <!-- ============================================================== --> 
    <!-- End Container fluid  --> 
    <!-- ============================================================== --> 
    <!-- ============================================================== --> 
    <!-- footer --> 
    <!-- ============================================================== -->
    <?php include(ADMIN_INCLUDE_DIR.'footer.php'); ?>
  </div>
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
	
	/*if(isEmpty("Username",document.getElementById("username").value)){
		document.getElementById("username").focus();
		return false;
	}*/
	/*if(isEmpty("Message",document.getElementById("admin_msg").value)){
		document.getElementById("admin_msg").focus();
		return false;
	}*/
	return true;
}

function submit_host(){
	if(ckhform() == true){
		document.getElementById("accForm").submit();
	}
}
</script>
<style>
.container{
	max-width:1170px; 
	margin:auto;
}
img{ 
	max-width:100%;
}
.inbox_people {
	background: #f8f8f8 none repeat scroll 0 0;
	float: left;
	overflow: hidden;
	width: 40%; border-right:1px solid #c4c4c4;
}
.inbox_msg {
	border: 1px solid #c4c4c4;
	clear: both;
	overflow: hidden;
}
.top_spac{ 
	margin: 20px 0 0;
}
.recent_heading {
	float: left; 
	width:40%;
}
.srch_bar {
	display: inline-block;
	text-align: right;
	width: 60%; padding:
}
.headind_srch{ 
	padding:10px 29px 10px 20px; 
	overflow:hidden; 
	border-bottom:1px solid #c4c4c4;
}
.recent_heading h4 {
	color: #05728f;
	font-size: 21px;
	margin: auto;
}
.srch_bar input{ 
	border:1px solid #cdcdcd; 
	border-width:0 0 1px 0; 
	width:80%; 
	padding:2px 0 9px 0; 
	background:none;
}
.srch_bar .input-group-addon button {
	background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
	border: medium none;
	padding: 0;
	color: #707070;
	font-size: 18px;
}
.srch_bar .input-group-addon { 
	margin: 0 0 0 -27px;
}
.chat_ib h5{ 
	font-size:18px; 
	color:#464646; 
	margin:0 0 8px 0; 
	font-family:Arial, Helvetica, sans-serif;
}
.chat_ib h5 span{ 
	font-size:13px; 
	float:right;
}
.chat_ib p{ 
	font-size:14px; 
	color:#989898; 
	margin:auto
}
.chat_img {
	float: left;
	width: 11%;
}
.chat_ib {
	float: left;
	padding:0;
	width:100%;
}
.chat_people{ 
	overflow:hidden; 
	clear:both;
}
.chat_list {
	border-bottom: 1px solid #c4c4c4;
	margin: 0;
	padding: 18px 16px 10px;
	cursor:pointer;
}
.inbox_chat { 
	height: 550px; 
	overflow-y: scroll;
}
.active_chat{ 
	background:#ebebeb;
}
.incoming_msg_img {
	display: inline-block;
	width: 6%;
}
.received_msg {
	display:block;
	padding:0;
	vertical-align: top;
	width:100%;
}
.received_withd_msg p {
	background: #74b9ff none repeat scroll 0 0;
	border-radius: 3px;
	color:#fff;
	font-size: 14px;
	margin: 0;
	padding:15px;
	width:80%;
}
.time_date {
	color: #747474;
	display: block;
	font-size: 12px;
	margin: 8px 0 15px 0;
}
.received_withd_msg { 
	width:80%; 
	float:right;
}
.mesgs {
	float: left;
	padding: 10px 15px 0 25px;
	width: 60%;
}
.sent_msg p {
	background:#eee none repeat scroll 0 0;
	border-radius: 3px;
	font-size: 14px;
	margin: 0; color:#000;
	padding:15px;
}
.outgoing_msg{ 
	overflow:hidden; 
	margin:0; 
	width:70%; 
	padding:10px;
}
.sent_msg {}
.input_msg_write input {
	background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
	border: medium none;
	color: #4c4c4c;
	font-size: 15px;
	min-height: 48px;
	width: 100%;
}
.type_msg {
	border-top: 1px solid #c4c4c4;
	position: relative;
}
.msg_send_btn {
	background: #05728f none repeat scroll 0 0;
	border: medium none;
	border-radius: 50%;
	color: #fff;
	cursor: pointer;
	font-size: 17px;
	height: 33px;
	position: absolute;
	right: 0;
	top: 11px;
	width: 33px;
}
.messaging { 
	padding:0;
}
.msg_history {
	height:516px;
	overflow-y: auto;
}
.box-boder {
	background: #eee;
	padding: 30px;
	margin-bottom: 30px;
	border-radius: 10px;
}
.btn-sm { 
	font-weight:normal!important;
}
</style>