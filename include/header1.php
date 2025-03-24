<?php
$id = $dbObj->sc_mysql_escape($_REQUEST['id'] ?? "");
$mo = !empty($_REQUEST['mo'])?trim($_REQUEST['mo']):'';
$pageurl = $dbObj->sc_mysql_escape($_REQUEST['url'] ?? "");

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."adminuser where id='1'";
$dbAdmin = $dbObj->SelectQuery();

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."sitecontent";
$dbSiteContent = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."services where status='1'";
$dbServices = $dbObj->SelectQuery();

if(!empty($_SESSION['user']['userid'])) {
$dbObj->dbQuery="select * from ".PREFIX."user_detail where id='".$dbObj->sc_mysql_escape($_SESSION['user']['userid'])."'";
$dbUserDetail = $dbObj->SelectQuery();

$dbObj->dbQuery="select * from ".PREFIX."find_msg where username='".$dbUserDetail[0]['username']."' order by id desc";
$dbUserMsg = $dbObj->SelectQuery();
$user_read_status = $dbUserMsg[0]['user_read_status'] ?? "";
}

$dbObj->dbQuery="select * from ".PREFIX."settings where id='1'";
$dbSettings = $dbObj->SelectQuery();
?>
<nav class="navbar navbar-expand-lg navbar-light fixed-top p-0 mainmenu nav-boder" id="mainNav">
  <div class="container-fluid">
    <div class="row2">
      <?php if($dbSettings[0]['popupstatus']==1){?>
      <div id="top-div-1" style="background-color:#e9ecf0;color:#1c304e;">
        <button type="button" class="close" id="hide" data-dismiss="modal"> <img id="headline" width="20" src="<?=HTACCESS_URL?>assets/img/Close-Blue.svg"> </button>
        <div class="container montserrat">
          <?=$dbAdmin[0]['popup']?>
        </div>
      </div>
      <?php }?>
      <div class="top-part2 position-relative">
        <div class="container"> 
          <!--<a href="https://api.whatsapp.com/send?phone=9723992200&text=I&source=&data=" target="_blank"
        class="btn text-white call-bt"><i class="fa fa-whatsapp"></i> 9723992200</a>--> 
          <a href="tel:+91-9723992200" class="btn text-white call-bt-neww"><i class="fa fa-phone"></i> 9723992200</a> <a href="<?=HTACCESS_URL?>book-free-valuation/" class="btn text-white call-bt call-bt3 flashing" target="_blank"> Book free Valuation <i class="flaticon-clipboard-with-pencil"></i></a>
          <?php if(!empty($_SESSION['user']['userid'])) { ?>
          <?php if($user_read_status=='unread'){?>
          <?php if(!isset($_SESSION['user']['is_login'])) {?>
          <a class="nav-link sign-up call-bt-neww pl-1 pr-1" style="color:#fff!important;" href="<?=HTACCESS_URL?>sign-up/" target="_blank"> <i class="fa fa-user themecolor font-15" aria-hidden="true"></i> Sign in  / Sign Up </a>
          <?php }else{?>
          <a class="nav-link sign-up call-bt-neww pl-1 pr-1" style="color:#fff!important;" href="<?=HTACCESS_URL?>supportController.php?mode=view_chat&id=<?=$_SESSION['user']['userid']?>"> <span style="color:#F00">New Message</span> </a>
          <?php }?>
          <?php }}?>
          
          <?php if(!isset($_SESSION['user']['is_login'])) {?>
          <a class="nav-link sign-up call-bt-neww pl-1 pr-1" style="color:#fff!important;" href="<?=HTACCESS_URL?>sign-up/" target="_blank"> <i class="fa fa-user themecolor font-15" aria-hidden="true"></i> Sign in  / Sign Up </a>
          <?php }else{?>
          <a class="nav-link sign-up call-bt-neww pl-1 pr-1" style="color:#fff!important;"href="<?=HTACCESS_URL?>dashboard/" target="_blank"> <i class="fa fa-home themecolor font-15" aria-hidden="true"></i> Dashboard </a>
          <?php }?>
          <button type="button" id="sidebarCollapse" class="btn btn-info font-14 font-bold themebg text-uppercase border-0"> <i class="fa fa-align-left"></i> <span>Menu1</span> </button>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="container"><a class="navbar-brand js-scroll-trigger" href="<?=HTACCESS_URL?>"> <img  width="210" src="<?=HTACCESS_URL?>assets/img/logo.png"></a>
        <div class="navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav montserrat">
            <li class="nav-item none-nav"><a class="nav-link" href="<?=HTACCESS_URL?>search-property-thumb/" target="_blank"> Buy Property </a> </li>
            <li class="nav-item none-nav"> <a class="nav-link" href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" target="_blank"> Sell property </a> </li>
            <li class="nav-item none-nav"> <a href="<?=HTACCESS_URL?>request-call-back/" class="nav-link" target="_blank"> <i class="flaticon-phone"></i> Request Call Back</a> </li>
            <!--<li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
              <div class="dropdown-menu"> <a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a> </div>
            </li>-->
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- Header --> 

<!-- Sidebar -->
<nav id="sidebar">
  <div id="dismiss"><img width="20" src="<?=HTACCESS_URL?>assets/img/cross2.svg"></div>
  <div class="sidebar-header">
    <h3>&nbsp;</h3>
  </div>
  <div class="list-group panel"> <a href="#menu4" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"> <span class="hidden-sm-down">My Account </span> </a>
    <div class="collapse" id="menu4"> <a href="<?=HTACCESS_URL?>your-favourite-properties/" class="list-group-item" target="_blank">Your Favourite Properties </a> <a href="<?=HTACCESS_URL?>properties-for-you/" class="list-group-item" target="_blank">Let Nik find Properties for you </a> <a href="<?=HTACCESS_URL?>support/" class="list-group-item" target="_blank">Customer Support </a> <a href="<?=HTACCESS_URL?>recent-property/" class="list-group-item" target="_blank">Recent property </a> <a href="<?=HTACCESS_URL?>billing-invoice/" class="list-group-item" target="_blank">Payment Receipt for Paid Client </a> <a href="<?=HTACCESS_URL?>progress-report/" class="list-group-item" target="_blank"> Progress Report for Paid Client </a> <a href="<?=HTACCESS_URL?>my-account/" class="list-group-item" target="_blank"> Edit My Profile </a> <a href="<?=HTACCESS_URL?>change-password/" class="list-group-item" target="_blank"> Change password</a> <a href="<?=HTACCESS_URL?>logout/" class="list-group-item"> Logout</a> </div>
    <a class="list-group-item" href="<?=HTACCESS_URL?>home/" target="_blank">
    <?=$dbSiteContent[0]['menu_name']?>
    </a> <a class="list-group-item" href="<?=HTACCESS_URL?>about/" target="_blank">
    <?=$dbSiteContent[1]['menu_name']?>
    </a> <a href="#menu1" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"> <span class="hidden-sm-down">Core Services </span> </a>
    <div class="collapse" id="menu1"> <a href="<?=HTACCESS_URL?>search-property-thumb/" class="list-group-item" target="_blank">Search Property </a> <a href="<?=HTACCESS_URL?>pricing-details-for-sell-property/" class="list-group-item" target="_blank">
      <?=$dbSiteContent[2]['menu_name']?>
      </a> <a href="<?=HTACCESS_URL?>pricing-details-for-rent-property/" class="list-group-item" target="_blank">
      <?=$dbSiteContent[3]['menu_name']?>
      </a> <a href="<?=HTACCESS_URL?>book-free-valuation/" class="list-group-item" target="_blank"> Book Free Valuation</a> </div>
    <a href="#menu2" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"> <span class="hidden-sm-down"> Additional Services</span> </a>
    <div class="collapse" id="menu2">
      <?php for($i=0;$i<count((array)$dbServices);$i++){?>
      <a class="list-group-item" href="<?=HTACCESS_URL?>services/#propertyservice<?=$dbServices[$i]['id']?>" target="_blank">
      <?=$dbServices[$i]['title']?>
      </a>
      <?php }?>
    </div>
    <a class="list-group-item" href="<?=HTACCESS_URL?>new-projects-promotion/" target="_blank">
    <?=$dbSiteContent[16]['menu_name']?>
    </a> <a class="list-group-item" href="<?=HTACCESS_URL?>blogs/" target="_blank">
    <?=$dbSiteContent[5]['menu_name']?>
    </a> <a class="list-group-item" href="<?=HTACCESS_URL?>faq/" target="_blank">
    <?=$dbSiteContent[6]['menu_name']?>
    </a> <a class="list-group-item" href="<?=HTACCESS_URL?>review-us/" target="_blank">
    <?=$dbSiteContent[7]['menu_name']?>
    </a> <a class="list-group-item" href="<?=HTACCESS_URL?>contact/" target="_blank">
    <?=$dbSiteContent[8]['menu_name']?>
    </a> <a class="list-group-item" href="<?=HTACCESS_URL?>media/" target="_blank">Media</a> <a class="list-group-item" href="<?=HTACCESS_URL?>the-team/" target="_blank">
    <?=$dbSiteContent[9]['menu_name']?>
    </a> <a class="list-group-item" href="<?=HTACCESS_URL?>careers/" target="_blank">
    <?=$dbSiteContent[10]['menu_name']?>
    </a>
    <?php if(isset($_SESSION['user']['is_login'])) {?>
    <a class="list-group-item" href="<?=HTACCESS_URL?>logout/"> Logout </a>
    <?php }?>
  </div>
</nav>
