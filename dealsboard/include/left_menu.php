<?php
//$dbObj->dbQuery="select count(*) as total from ".PREFIX."find_property where view_status='0'"; // for listing of records
//$dbFindProp = $dbObj->SelectQuery();
$pages = $dbObj->sc_mysql_escape($_SESSION['pages'] ?? "");
$let_nik = $dbObj->sc_mysql_escape($_SESSION['let_nik'] ?? "");
$c_support = $dbObj->sc_mysql_escape($_SESSION['c_support'] ?? "");
$state = $dbObj->sc_mysql_escape($_SESSION['state'] ?? "");
$city = $dbObj->sc_mysql_escape($_SESSION['city'] ?? "");
$location = $dbObj->sc_mysql_escape($_SESSION['location'] ?? "");
$users = $dbObj->sc_mysql_escape($_SESSION['users'] ?? "");
$property = $dbObj->sc_mysql_escape($_SESSION['property'] ?? "");
$comproperty = $dbObj->sc_mysql_escape($_SESSION['comproperty'] ?? "");
$sold_property = $dbObj->sc_mysql_escape($_SESSION['sold_property'] ?? "");
$receipt = $dbObj->sc_mysql_escape($_SESSION['receipt'] ?? "");
$gst_receipt = $dbObj->sc_mysql_escape($_SESSION['gst_receipt'] ?? "");
$services = $dbObj->sc_mysql_escape($_SESSION['services'] ?? "");
$faq = $dbObj->sc_mysql_escape($_SESSION['faq'] ?? "");
$team = $dbObj->sc_mysql_escape($_SESSION['team'] ?? "");
$blog = $dbObj->sc_mysql_escape($_SESSION['blog'] ?? "");
$careers = $dbObj->sc_mysql_escape($_SESSION['careers'] ?? "");
$review = $dbObj->sc_mysql_escape($_SESSION['review'] ?? "");
$package = $dbObj->sc_mysql_escape($_SESSION['package'] ?? "");
$video_testimonial = $dbObj->sc_mysql_escape($_SESSION['video_testimonial'] ?? "");
$cdetail = $dbObj->sc_mysql_escape($_SESSION['cdetail'] ?? "");
$pdetail = $dbObj->sc_mysql_escape($_SESSION['pdetail'] ?? "");
$free_valuation = $dbObj->sc_mysql_escape($_SESSION['free_valuation'] ?? "");
$appointment = $dbObj->sc_mysql_escape($_SESSION['appointment'] ?? "");
?>
<aside class="left-sidebar">
  
  <!-- Sidebar scroll-->
  
  <div class="scroll-sidebar"> 
    
    <!-- Sidebar navigation-->
    
    <nav class="sidebar-nav">
      <ul id="sidebarnav">
        <li class="nav-small-cap">MAIN</li>
        <li> <a class="waves-effect waves-dark <?=($mo=='dashboard')?'active':''?>" href="index.php?mo=dashboard"> <i class="mdi mdi-account-box mr-10"></i><span class="hide-menu">Dashboard</span></a></li>
        <?php if($_SESSION['srgit_cms_admin_id']=='1'){ ?>
        <li class="<?=($mo=='change_password' || $mo=='change_email' || $mo=='top_popup' || $mo=='admin_users' || $mo=='add_admin')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-account-settings-variant mr-10"></i><span class="hide-menu">Setting</span></a>
          <ul aria-expanded="false" class="<?=($mo=='change_password' || $mo=='change_email' || $mo=='top_popup' || $mo=='admin_users' || $mo=='add_admin')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=change_password" class="<?=($mo=='change_password')?'active':''?>"> Change Password</a></li>
            <li><a href="index.php?mo=change_email" class="<?=($mo=='change_email')?'active':''?>"> Change Email & Contact No</a></li>
            <li><a href="index.php?mo=top_popup" class="<?=($mo=='top_popup')?'active':''?>"> Top Popup Content</a></li>
            <li><a href="index.php?mo=admin_users" class="<?=($mo=='admin_users')?'active':''?>"> Create Admin Users</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if($pages=='Y'){ ?>
        <li><a class="waves-effect waves-dark <?=($mo=='pages' || $mo=='add_page')?'active':''?>" href="index.php?mo=pages"> <i class="mdi mdi-format-list-bulleted mr-10"></i><span class="hide-menu">Pages</span></a></li>
        <?php }?>
        <?php if($let_nik=='Y'){ ?>
        <li><a class="waves-effect waves-dark <?=($mo=='let-nik')?'active':''?>" href="index.php?mo=let-nik"> <i class="mdi mdi-format-list-bulleted mr-10"></i><span class="hide-menu">Let Nik Find Properties For You </a></li>
        <?php }?>
        <?php if($c_support=='Y'){ ?>
        <li><a class="waves-effect waves-dark <?=($mo=='find-property')?'active':''?>" href="index.php?mo=find-property"> <i class="mdi mdi-format-list-bulleted mr-10"></i><span class="hide-menu">Customer Support <span style="color: #F00;font-weight:bold;">
          <?=$dbFindProp[0]['total'] ?? ""?>
          </span></span></a></li>
        <?php }?>
        <?php if($state=='Y'){ ?>
        <li> <a class="waves-effect waves-dark <?=($mo=='states')?'active':''?>" href="index.php?mo=states"> <i class="mdi mdi-google-maps mr-10"></i><span class="hide-menu">Manage States</span></a> </li>
        <?php }?>
        <?php if($city=='Y'){ ?>
        <li> <a class="waves-effect waves-dark <?=($mo=='city')?'active':''?>" href="index.php?mo=city"> <i class="mdi mdi-map mr-10"></i><span class="hide-menu">Manage City</span></a> </li>
        <?php }?>
        <?php if($location=='Y'){ ?>
        <li> <a class="waves-effect waves-dark <?=($mo=='import_location' || $mo=='add_update_location')?'active':''?>" href="index.php?mo=import_location"> <i class="mdi mdi-map-marker mr-10"></i> <span class="hide-menu">Import Location</span></a> </li>
        <?php }?>
         
        <li> <a class="waves-effect waves-dark <?=($mo=='import_land' || $mo=='add_update_land')?'active':''?>" href="index.php?mo=import_land"> <i class="mdi mdi-map-marker mr-10"></i> <span class="hide-menu">Import Land</span></a> </li>
         
        <?php if($users=='Y'){ ?>
        <li class="<?=($mo=='add_user' || $mo=='manage_user' || $mo=='manage_user_seller' || $mo=='user_property' || $mo=='progress_report' || $mo=='payment_receipt' || $mo=='import_users')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-account mr-10"></i><span class="hide-menu"> Manage Users</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_user' || $mo=='manage_user' || $mo=='manage_user_seller' || $mo=='user_property' || $mo=='progress_report' || $mo=='payment_receipt' || $mo=='import_users')?'collapse in':'collapse'?>">
            <?php if($_SESSION['srgit_cms_admin_id']=='1'){ ?>
            <li><a href="index.php?mo=add_user" class="<?=($mo=='add_user')?'active':''?>"> Add New User</a> </li>
            <?php }?>
            <li><a href="index.php?mo=import_users" class="<?=($mo=='import_users')?'active':''?>"> Import Users</a></li>
            <li><a href="index.php?mo=manage_user" class="<?=($mo=='manage_user')?'active':''?>"> Manage Buyer Users</a></li>
            <li><a href="index.php?mo=manage_user_seller" class="<?=($mo=='manage_user_seller')?'active':''?>"> Manage Seller Users</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if($property=='Y'){ ?>
        <li class="<?=($mo=='add_property' || $mo=='property' || $mo=='property_images' || $mo=='import_property' || $mo=='deleted_property')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-animation mr-10"></i><span class="hide-menu"> Manage Property</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_property' || $mo=='property' || $mo=='property_images' || $mo=='import_property' || $mo=='deleted_property')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_property" class="<?=($mo=='add_property')?'active':''?>"> Add New Property</a> </li>
            <li><a href="index.php?mo=property" class="<?=($mo=='property')?'active':''?>"> Manage Property</a></li>
            <li><a href="index.php?mo=import_property" class="<?=($mo=='import_property')?'active':''?>"> Import Property</a></li>
            <?php if($_SESSION['srgit_cms_admin_id']=='1'){ ?>
            <li><a href="index.php?mo=deleted_property" class="<?=($mo=='deleted_property')?'active':''?>"> Deleted Property</a></li>
            <?php }?>
          </ul>
        </li>
        <?php }?>
        <?php if($comproperty=='Y'){ ?>
        <li class="<?=($mo=='add_com_property' || $mo=='com_property' || $mo=='com_property_images' || $mo=='import_com_property' || $mo=='deleted_com_property')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-animation mr-10"></i><span class="hide-menu"> Manage Commercial Property</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_com_property' || $mo=='com_property' || $mo=='com_property_images' || $mo=='import_com_property' || $mo=='deleted_com_property')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_com_property" class="<?=($mo=='add_com_property')?'active':''?>"> Add New Property</a> </li>
            <li><a href="index.php?mo=com_property" class="<?=($mo=='com_property')?'active':''?>"> Manage Property</a></li>
            <li><a href="index.php?mo=import_com_property" class="<?=($mo=='import_com_property')?'active':''?>"> Import Property</a></li>
            <?php if($_SESSION['srgit_cms_admin_id']=='1'){ ?>
            <li><a href="index.php?mo=deleted_com_property" class="<?=($mo=='deleted_com_property')?'active':''?>"> Deleted Property</a></li>
            <?php }?>
          </ul>
        </li>
        <?php }?>
        <?php if($sold_property=='Y'){ ?>
        <li class="<?=($mo=='add_sold_property' || $mo=='sold_property')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-animation mr-10"></i><span class="hide-menu"> Manage Sold Property</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_sold_property' || $mo=='sold_property')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_sold_property" class="<?=($mo=='add_sold_property')?'active':''?>"> Add New</a> </li>
            <li><a href="index.php?mo=sold_property" class="<?=($mo=='sold_property')?'active':''?>"> Manage Sold Property</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if($receipt=='Y'){ ?>
        <li class="<?=($mo=='add_receipt' || $mo=='receipt')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-animation mr-10"></i><span class="hide-menu"> Manage Receipt</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_receipt' || $mo=='receipt')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_receipt" class="<?=($mo=='add_receipt')?'active':''?>"> Generate Receipt</a> </li>
            <li><a href="index.php?mo=receipt" class="<?=($mo=='receipt')?'active':''?>"> Manage Receipt</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if($gst_receipt=='Y'){ ?>
        <li class="<?=($mo=='add_gst_receipt' || $mo=='gst_receipt')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-animation mr-10"></i><span class="hide-menu"> Manage Gst Receipt</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_gst_receipt' || $mo=='gst_receipt')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_gst_receipt" class="<?=($mo=='add_gst_receipt')?'active':''?>"> Generate Gst Receipt</a> </li>
            <li><a href="index.php?mo=gst_receipt" class="<?=($mo=='gst_receipt')?'active':''?>"> Manage Gst Receipt</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if($gst_receipt=='Y'){ ?>
        <li class="<?=($mo=='add_gst18_receipt' || $mo=='gst18_receipt')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-animation mr-10"></i><span class="hide-menu"> Manage 18% Gst Receipt</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_gst18_receipt' || $mo=='gst18_receipt')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_gst18_receipt" class="<?=($mo=='add_gst18_receipt')?'active':''?>"> Generate 18% Gst Receipt</a> </li>
            <li><a href="index.php?mo=gst18_receipt" class="<?=($mo=='gst18_receipt')?'active':''?>"> Manage 18% Gst Receipt</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if($services=='Y'){ ?>
        <li class="<?=($mo=='add_services' || $mo=='services')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-network-question mr-10"></i><span class="hide-menu">Manage Services</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_services' || $mo=='services')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_services" class="<?=($mo=='add_services')?'active':''?>"> Add New Services</a></li>
            <li><a href="index.php?mo=services" class="<?=($mo=='services')?'active':''?>"> Manage Services</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if($faq=='Y'){ ?>
        <li class="<?=($mo=='add_faq' || $mo=='faq')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-comment-question-outline mr-10"></i><span class="hide-menu">Manage Faq</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_faq' || $mo=='faq')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_faq" class="<?=($mo=='add_faq')?'active':''?>">Add New Faq</a></li>
            <li><a href="index.php?mo=faq" class="<?=($mo=='faq')?'active':''?>">Manage Faq</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if($team=='Y'){ ?>
        <li class="<?=($mo=='add_team' || $mo=='team')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-human-male-female mr-10"></i><span class="hide-menu">Manage Team</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_team' || $mo=='team')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_team" class="<?=($mo=='add_team')?'active':''?>">Add New Team</a></li>
            <li><a href="index.php?mo=team" class="<?=($mo=='team')?'active':''?>">Manage Team</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if($blog=='Y'){ ?>
        <li class="<?=($mo=='add_blog' || $mo=='blog' || $mo=='blog_comment' || $mo=='deleted_blog'  || $mo== 'blog_category' || $mo == 'blog_category_links' || $mo == 'blog_header_category' || $mo == 'blog_header_category_links'  || $mo== 'blog_sidebar_links' || $mo== 'blog_contact_us' )?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-blogger mr-10"></i><span class="hide-menu">Manage Blog</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_blog' || $mo=='blog' || $mo=='blog_comment' || $mo=='deleted_blog' || $mo== 'blog_category' || $mo== 'blog_category_links' || $mo== 'blog_header_category'  || $mo== 'blog_header_category_links'  || $mo== 'blog_sidebar_links'  || $mo== 'blog_contact_us' )?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_blog" class="<?=($mo=='add_blog')?'collapse':'collapse in'?>"> Add New Blog</a></li>
            <li> <a href="index.php?mo=blog" class="<?=($mo=='blog')?'collapse':'collapse in'?>"> Manage Blog</a></li>
            <li> <a href="index.php?mo=blog_comment" class="<?=($mo=='blog_comment')?'collapse':'collapse in'?>"> Manage Blog Comment</a></li>
            <?php if($_SESSION['srgit_cms_admin_id']=='1'){ ?>
            <li> <a href="index.php?mo=deleted_blog" class="<?=($mo=='deleted_blog')?'collapse':'collapse in'?>"> Deleted Blog</a></li>
            <?php }?>
            <li> <a href="index.php?mo=blog_category" class="<?=($mo=='blog_category')?'collapse':'collapse in'?>"> Manage Blog Categry</a></li>
            <li> <a href="index.php?mo=blog_category_links" class="<?=($mo=='blog_category_links')?'collapse':'collapse in'?>"> Manage Blog Categry Links</a></li>
            <li> <a href="index.php?mo=blog_header_category" class="<?=($mo=='blog_header_category')?'collapse':'collapse in'?>"> Manage Blog Header Categry</a></li>
            <li> <a href="index.php?mo=blog_header_category_links" class="<?=($mo=='blog_header_category_links')?'collapse':'collapse in'?>"> Manage Blog Header Categry Links</a></li>
            <li> <a href="index.php?mo=blog_sidebar_links" class="<?=($mo=='blog_sidebar_links')?'collapse':'collapse in'?>"> Manage Blog Sidebar Links</a></li>
            <li> <a href="index.php?mo=blog_contact_us" class="<?=($mo=='blog_contact_us')?'collapse':'collapse in'?>"> Manage Blog Contact Us</a></li>
          </ul>
        </li>
        <?php }?>

        <?php if($blog=='Y'){ ?>
        <li class="<?=($mo=='valuation_comment')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-blogger mr-10"></i><span class="hide-menu">Manage Valuation Page</span></a> 
          <ul aria-expanded="false" class="<?=($mo=='valuation_comment')?'collapse in':'collapse'?>">
            <li> <a href="index.php?mo=valuation_comment" class="<?=($mo=='valuation_comment')?'collapse':'collapse in'?>"> Manage Valuation Comment</a></li> 
          </ul>
        </li>
        <?php }?>

        <?php if($careers=='Y'){ ?>
        <li class="<?=($mo=='add_career' || $mo=='career')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="fa fa-file-pdf-o mr-10"></i> <span class="hide-menu"> Manage Careers</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_career' || $mo=='career')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_career" class="<?=($mo=='add_career')?'active':''?>"> Add New Careers</a></li>
            <li><a href="index.php?mo=career" class="<?=($mo=='career')?'active':''?>">Manage Careers</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if($_SESSION['srgit_cms_admin_id']=='1'){ ?>
        <li class="<?=($mo=='review' || $mo=='deleted_review' || $mo=='delete_review')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-star-circle mr-10"></i> <span class="hide-menu"> Manage Review</span></a>
          <ul aria-expanded="false" class="<?=($mo=='review' || $mo=='deleted_review' || $mo=='delete_review')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=review" class="<?=($mo=='review')?'active':''?>"> Manage Review</a></li>
            <li><a href="index.php?mo=delete_review" class="<?=($mo=='delete_review')?'active':''?>"> Delete Review</a></li>
            <li><a href="index.php?mo=deleted_review" class="<?=($mo=='deleted_review')?'active':''?>"> Deleted Review</a></li>
          </ul>
        </li>
        <?php }else{?>
        <?php if($review=='Y'){ ?>
        <li> <a class="waves-effect waves-dark <?=($mo=='review')?'active':''?>" href="index.php?mo=review"> <i class="mdi mdi-star-circle mr-10"></i><span class="hide-menu">Manage Review</span></a> </li>
        <?php }}?>
        <?php if($package=='Y'){ ?>
        <li class="<?=($mo=='package_list' || $mo=='sell-property' || $mo=='rent-property')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-archive mr-10"></i> <span class="hide-menu"> Manage Package</span></a>
          <ul aria-expanded="false" class="<?=($mo=='package_list' || $mo=='sell-property' || $mo=='rent-property')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=package_list" class="<?=($mo=='package_list')?'active':''?>"> Package List</a></li>
            <li><a href="index.php?mo=sell-property" class="<?=($mo=='sell-property')?'active':''?>"> Sell Property</a></li>
            <li><a href="index.php?mo=rent-property" class="<?=($mo=='rent-property')?'active':''?>">Rent Property</a></li>
          </ul>
        </li>
        <?php }?>
         <?php if($video_testimonial=='Y'){ ?>
        <li class="<?=($mo=='add_video_testimonial' || $mo=='video_testimonial')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-video mr-10"></i> <span class="hide-menu">Video Testimonial</span></a>
          <ul aria-expanded="false" class="<?=($mo=='add_video_testimonial' || $mo=='video_testimonial')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=add_video_testimonial" class="<?=($mo=='add_video_testimonial')?'active':''?>"> Add Video</a></li>
            <li><a href="index.php?mo=video_testimonial" class="<?=($mo=='video_testimonial')?'active':''?>"> Video Testimonial</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if($cdetail=='Y'){ ?>
        <li> <a class="waves-effect waves-dark <?=($mo=='contact_detail')?'active':''?>" href="index.php?mo=contact_detail"> <i class="mdi mdi-contact-mail mr-10"></i><span class="hide-menu"> Contact Detail</span></a> </li>
        <?php }?>
        <?php if($pdetail=='Y'){ ?>
        <li><a class="waves-effect waves-dark <?=($mo=='partner_detail')?'active':''?>" href="index.php?mo=partner_detail"> <i class="mdi mdi-account-multiple mr-10"></i><span class="hide-menu"> Partner Detail</span></a></li>
        <?php }?>
        <?php if($free_valuation=='Y'){ ?>
        <li><a class="waves-effect waves-dark <?=($mo=='free-valuation')?'active':''?>" href="index.php?mo=free-valuation"> <i class="mdi mdi-file-delimited mr-10"></i><span class="hide-menu"> Book Free Valuation</span></a></li>
        <?php }?>
        <?php if($appointment=='Y'){ ?>
        <li><a class="waves-effect waves-dark <?=($mo=='app-cleardeal')?'active':''?>" href="index.php?mo=app-cleardeal"> <i class="mdi mdi-alarm mr-10"></i><span class="hide-menu"> Appointment by Cleardeals</span></a></li>
        <?php }?>
        <?php if($_SESSION['srgit_cms_admin_id']=='1'){ ?>
        <li><a class="waves-effect waves-dark <?=($mo=='home-villa')?'active':''?>" href="index.php?mo=home-villa"> <i class="mdi mdi-home mr-10"></i><span class="hide-menu"> Home/Villa/Bunglow</span></a></li>
        <li> <a class="waves-effect waves-dark <?=($mo=='social_links')?'active':''?>" href="index.php?mo=social_links"><i class="mdi mdi-account-switch mr-10"></i><span class="hide-menu"> Social Media</span></a> </li>
        <li> <a class="waves-effect waves-dark <?=($mo=='request_call_back')?'active':''?>" href="index.php?mo=request_call_back"><i class="mdi mdi-phone  mr-10"></i><span class="hide-menu"> Request Call Back</span></a> </li>
        <li> <a class="waves-effect waves-dark <?=($mo=='career_request')?'active':''?>" href="index.php?mo=career_request"><i class="mdi mdi-account-switch mr-10"></i><span class="hide-menu"> Career Request</span></a> </li>
        <li> <a class="waves-effect waves-dark <?=($mo=='new_project_enquiry')?'active':''?>" href="index.php?mo=new_project_enquiry"><i class="mdi mdi-image-filter mr-10"></i><span class="hide-menu"> New Project Promotion Enquiry</span></a> </li>
        <li> <a class="waves-effect waves-dark <?=($mo=='free_advice')?'active':''?>" href="index.php?mo=free_advice"><i class="mdi mdi-account-switch mr-10"></i><span class="hide-menu"> Get Free Advice</span></a> </li>
        
       
        <li> <a class="waves-effect waves-dark <?=($mo=='subscribe')?'active':''?>" href="index.php?mo=subscribe"><i class="mdi mdi-email mr-10"></i><span class="hide-menu"> Subscribe Now</span></a> </li>
        <li> <a class="waves-effect waves-dark <?=($mo=='arrange_site_visit')?'active':''?>" href="index.php?mo=arrange_site_visit"><i class="mdi mdi-image-filter mr-10"></i><span class="hide-menu"> Arrange a Site Visit</span></a> </li>
        <li> <a class="waves-effect waves-dark <?=($mo=='ask_question')?'active':''?>" href="index.php?mo=ask_question"><i class="mdi mdi-network-question mr-10"></i><span class="hide-menu"> Ask a Question</span></a> </li>
        
        <li> <a class="waves-effect waves-dark <?=($mo=='prop_contact')?'active':''?>" href="index.php?mo=prop_contact"><i class="mdi mdi-network-question mr-10"></i><span class="hide-menu"> Property Contact Us</span></a> </li>
        
        <li> <a class="waves-effect waves-dark <?=($mo=='com_arrange_site_visit')?'active':''?>" href="index.php?mo=com_arrange_site_visit"><i class="mdi mdi-image-filter mr-10"></i><span class="hide-menu"> Arrange a Site Visit for Commercial </span></a> </li>
        <li> <a class="waves-effect waves-dark <?=($mo=='com_ask_question')?'active':''?>" href="index.php?mo=com_ask_question"><i class="mdi mdi-network-question mr-10"></i><span class="hide-menu"> Ask a Question for Commercial </span></a> </li>
        
        <li> <a class="waves-effect waves-dark <?=($mo=='com_prop_contact')?'active':''?>" href="index.php?mo=com_prop_contact"><i class="mdi mdi-network-question mr-10"></i><span class="hide-menu"> Commercial Property Contact Us</span></a> </li>

        <li> <a class="waves-effect waves-dark <?=($mo=='request_call_back_links')?'active':''?>" href="index.php?mo=request_call_back_links"><i class="mdi mdi-network-question mr-10"></i><span class="hide-menu">Request Call Back Links</span></a> </li>


        <li class="<?=($mo=='eligibility' || $mo=='emi')?'active':''?>"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-archive mr-10"></i> <span class="hide-menu"> Home Loan Enquiry</span></a>
          <ul aria-expanded="false" class="<?=($mo=='eligibility' || $mo=='emi')?'collapse in':'collapse'?>">
            <li><a href="index.php?mo=eligibility" class="<?=($mo=='eligibility')?'active':''?>"> Eligibility</a></li>
            <li><a href="index.php?mo=emi" class="<?=($mo=='emi')?'active':''?>"> Emi</a></li>
          </ul>
        </li>
        <?php }?>
         <li> <a class="waves-effect waves-dark <?=($mo=='upload_pricelist')?'active':''?>" href="index.php?mo=upload_pricelist"><i class="mdi mdi-network-question mr-10"></i><span class="hide-menu">Upload Price List</span></a> </li>

        <li class="nav-small-cap">OTHER OPTIONS</li>
        <li> <a class="waves-effect waves-dark" href="<?=HTACCESS_URL?>" target="_blank"> <i class="mdi mdi-web mr-10"></i><span class="hide-menu">View Website</span></a> </li>
        <li> <a class="waves-effect waves-dark" href="loginController.php?mode=logout"> <i class="mdi mdi-cellphone-link-off mr-10"></i><span class="hide-menu">Logout</span></a> </li>
      </ul>
    </nav>
    
    <!-- End Sidebar navigation --> 
    
  </div>
  
  <!-- End Sidebar scroll--> 
  
</aside>