<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>uploads/logo/NC1.png">
  <title><?= $title; ?></title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->

  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
    .form-error1 {
      color: #a76161;
    }
   .skin-blue .main-header .navbar {
    background-color: #f0569c;
}
.skin-blue .main-header .logo {
    background-color: #f0569c;
    color: #fff;
    border-bottom: 0 solid transparent;
}
.skin-blue .main-header .logo:hover {
    background-color: #041551;
}
.skin-blue .main-header .navbar .sidebar-toggle:hover {
    background-color: #041551;
} 
.skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #201804;
}
.skin-blue .sidebar-menu>li.header {
    color: #4b646f;
    background: black;
}
.skin-blue .sidebar-menu>li.active>a {
    border-left-color: #0000ff;
}
.skin-blue .main-header li.user-header {
    background-color: #1dc2f1;
}
.box.box-warning {
    border-top-color:#0000ff;
}
.btn-default:hover, .btn-default:active, .btn-default.hover {
    background-color: #f0569c;
    color: #fff !important;
}
.nav-tabs-custom>.nav-tabs>li.active {
    border-top-color: #f0569c;
}
.box.box-primary {
    border-top-color: #f0569c;
}
.btn-success {
    background-color: #f0569c;
    border-color: #0000ff;
}
.box.box-danger {
    border-top-color: #f0569c;
}
.box-header.with-border {
    background: #f0569c;
    color: #fff;
}
.main-footer {
    background: #041551;
    padding: 15px;
    color: #fff;
    border-top: 1px solid #d2d6de;
}
.admin-action {
    list-style: none;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333 !important;
}
.btn-box-tool {
    padding: 5px;
    font-size: 12px;
    background: transparent;
    color: #ecf0f5;
}
div#track ul li {
    list-style-type: none;
    border-bottom: 2px solid #eee;
    padding: 8px;
    padding-left: 20px;
    color: #666;
    font-size: 14px;
    margin-top: 20px;
}
div#track ul li a {
    text-decoration: none;
    color: #666;
}
div#track ul li span {
    display: inline-block;
    float: right;
    padding-right: 10px;
}
.reposrtImage img {
    width: 50px;
    / top: 17px; /
    position: absolute;
    / right: -68px; /
    left: 0px;
}
.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 3;
    color: #fff;
    cursor: default;
    background-color: #f0569c;
    border-color: #f0569c;
}

.skin-blue .main-header li.user-header {
    background-color: #f0569c;
}
i.fa.fa-edit.editIcon {
    font-size: 18px;
}

i.fa.fa-fw.fa-remove.deleteIcon {
    color: #b52929;
    font-size: 20px;
}
	</style>





</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <?php if($admin['role'] == 0) { ?><a href="<?= site_url();?>/admin/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>NL</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>NicoLive</b></span>

    </a>
  <?php }else{ ?>

    <a href="javascript:void()" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>NL</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>NicoLive</b></span>

    </a>

<?php   } ?>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
           <!--li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>

          <span class="label label-warning"><?= $newOrder;?></span>
            </a>
            <ul class="dropdown-menu">

              <li class="header"><a href="<?php echo site_url()?>/Bookings">You have total <?= $newOrders?> Orders.</a></li>
            </ul>
          </li-->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php if(!empty($admin['image'])){?>
              	<img src="<?php echo base_url(). $admin['image'];?>" class="user-image" alt="User Image">
							<?php } else{ ?>
								<img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
							<?php }?>
              <span class="hidden-xs"><?php echo $admin['name']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(). $admin['image'];?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $admin['designation'];?>
                  <small><?php echo $admin['education'];?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url()?>/admin/edit_profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url();?>/admin/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <?php if(!empty($admin['image'])){?>
            <img src="<?php echo base_url(). $admin['image'];?>" class="img-circle" alt="User Image">
          <?php } else{ ?>
            <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          <?php }?>
        </div>
        <div class="pull-left info">
          <p><?php echo $admin['name']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
  <?php
    if($admin['assignRole'] == 'SUBADMIN'){ ?>
      <li class="header">ACCOUNTS MANAGEMENT</li>
          <li class="<?php if($active == 'managePendingHostRequest' || $active == 'approvedHostRequest' || $active == 'rejectedHostRequest'){ echo "active"; }?> treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Host</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($active == 'managePendingHostRequest'){ echo "active"; }?>"><a href="<?php echo site_url()?>/UserVerification/manageHost/1"><i class="fa fa-circle-o"></i>Pending Host Request</a></li>
                <li class="<?php if($active == 'approvedHostRequest'){ echo "active"; }?>"><a href="<?php echo site_url()?>/UserVerification/manageHost/2"><i class="fa fa-circle-o"></i>Approved Host Request</a></li>
                <li class="<?php if($active == 'rejectedHostRequest'){ echo "active"; }?>"><a href="<?php echo site_url()?>/UserVerification/manageHost/3"><i class="fa fa-circle-o"></i>Rejected Host Request</a></li>
              </ul>
            </li>

  <?php }  elseif($admin['assignRole'] == 'ADMIN'){ ?>

     <li class="<?php if($active == 'addSubAdmin' || $active == 'subAdmin'){ echo "active"; }?> treeview">
          <a href="#">
            <i class="fa fa-support"></i> <span>Sub Admin</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($active == 'addSubAdmin'){ echo "active"; }?>"><a href="<?php echo site_url()?>/SubAdmin/addSubAdmin"><i class="fa fa-circle-o"></i>Add Sub Admin</a></li>
			     <li class="<?php if($active == 'subAdmin'){ echo "active"; }?>"><a href="<?php echo site_url()?>/SubAdmin/manage"><i class="fa fa-circle-o"></i>View Sub Admin</a></li>
           <li class="<?php if($active == 'subAdminCoinHistory'){ echo "active"; }?>"><a href="<?php echo site_url()?>/SubAdmin/coinsHistory"><i class="fa fa-circle-o"></i>SubAdmin Coins History</a></li>

          </ul>
        </li>
  <!--<li class="<?php if($active == 'badges'){ echo "active"; }?> treeview">-->
  <!--    <a href="#">-->
  <!--       <i class="fa fa-book"></i> <span>Badges</span>-->
  <!--       <span class="pull-right-container">-->
  <!--          <i class="fa fa-angle-left pull-right"></i>-->
  <!--       </span>-->
  <!--    </a>-->
  <!--    <ul class="treeview-menu">-->
  <!--      <li class="<?php if($active == 'badges'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Badges"><i class="fa fa-circle-o"></i>Badges</a></li>-->
  <!--    </ul>-->
  <!--</li>-->

  <!--<li class="<?php if($active == 'crown'){ echo "active"; }?> treeview">-->
  <!--    <a href="#">-->
  <!--        <i class="fa fa-book"></i> <span>Crown</span>-->
  <!--        <span class="pull-right-container">-->
  <!--      <i class="fa fa-angle-left pull-right"></i>-->
  <!--   </span>-->
  <!--    </a>-->
  <!--    <ul class="treeview-menu">-->
  <!--        <li class="<?php if($active == 'crown'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Badges/manageCrown"><i class="fa fa-circle-o"></i>Crown</a></li>-->
  <!--    </ul>-->
  <!--</li>-->


  <!--<li class="<?php if($active == 'addGift' || $active == 'gift'){ echo "active"; }?> treeview">-->
  <!--  <a href="#">-->
  <!--    <i class="fa fa-gift"></i> <span>Gift</span>-->
  <!--    <span class="pull-right-container">-->
  <!--      <i class="fa fa-angle-left pull-right"></i>-->
  <!--    </span>-->
  <!--  </a>-->
  <!--  <ul class="treeview-menu">-->
  <!--    <li class="<?php if($active == 'addGift'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Gift/add"><i class="fa fa-circle-o"></i>Add Gift</a></li>-->
  <!--    <li class="<?php if($active == 'gift'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Gift/manage"><i class="fa fa-circle-o"></i>View Gift</a></li>-->
  <!--  </ul>-->
  <!--</li>-->



  <!--<li class="<?php if($active == 'addliveGift' || $active == 'liveGift' || $active == 'liveGiftCategory'){ echo "active"; }?> treeview">-->
  <!--  <a href="#">-->
  <!--    <i class="fa fa-gift"></i> <span>Live Gift</span>-->
  <!--    <span class="pull-right-container">-->
  <!--      <i class="fa fa-angle-left pull-right"></i>-->
  <!--    </span>-->
  <!--  </a>-->
  <!--  <ul class="treeview-menu">-->
  <!--    <li class="<?php if($active == 'liveGiftCategory'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Gift/liveGiftCategory"><i class="fa fa-circle-o"></i>Gift Category</a></li>-->
  <!--    <li class="<?php if($active == 'addliveGift'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Gift/addliveGift"><i class="fa fa-circle-o"></i>Add Live Gift</a></li>-->
  <!--    <li class="<?php if($active == 'liveGift'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Gift/liveGift"><i class="fa fa-circle-o"></i>View Live Gift</a></li>-->
  <!--  </ul>-->
  <!--</li>-->


  <!--<li class="<?php if($active == 'addCoin' || $active == 'coin'){ echo "active"; }?> treeview">-->
  <!--  <a href="#">-->
  <!--    <i class="fa fa-gift"></i> <span>Coins</span>-->
  <!--    <span class="pull-right-container">-->
  <!--      <i class="fa fa-angle-left pull-right"></i>-->
  <!--    </span>-->
  <!--  </a>-->
  <!--  <ul class="treeview-menu">-->
  <!--    <li class="<?php if($active == 'addCoin'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Coins/add"><i class="fa fa-circle-o"></i>Add Coins</a></li>-->
  <!--    <li class="<?php if($active == 'coin'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Coins/manage"><i class="fa fa-circle-o"></i>View Coins</a></li>-->
  <!--  </ul>-->
  <!--</li>-->


      <!--<li class="<?php if($active == 'beanschange' || $active == 'dollarexchange'){ echo "active"; }?> treeview">-->
      <!--    <a href="#">-->
      <!--        <i class="fa fa-gift"></i> <span>Beans Exchange</span>-->
      <!--        <span class="pull-right-container">-->
      <!--  <i class="fa fa-angle-left pull-right"></i>-->
      <!--</span>-->
      <!--    </a>-->
      <!--    <ul class="treeview-menu">-->
      <!--        <li class="<?php if($active == 'dollarexchange'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Beans/dollarExchange"><i class="fa fa-circle-o"></i>Dollar Exchange</a></li>-->
      <!--        <li class="<?php if($active == 'beanschange'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Beans/beansExchangePackages"><i class="fa fa-circle-o"></i>Beans Exchange Packages</a></li>-->


      <!--    </ul>-->
      <!--</li>-->


      <!--<li class="<?php if($active == 'addlevel' || $active == 'viewlevel'){ echo "active"; }?> treeview">-->
      <!--    <a href="#">-->
      <!--        <i class="fa fa-gift"></i> <span>Level</span>-->
      <!--        <span class="pull-right-container">-->
      <!--  <i class="fa fa-angle-left pull-right"></i>-->
      <!--</span>-->
      <!--    </a>-->
      <!--    <ul class="treeview-menu">-->
      <!--        <li class="<?php if($active == 'addlevel'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Level/addlevel"><i class="fa fa-circle-o"></i>Add Level</a></li>-->
      <!--        <li class="<?php if($active == 'viewlevel'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Level/manageLevels"><i class="fa fa-circle-o"></i>View Level</a></li>-->
      <!--    </ul>-->
      <!--</li>-->


<?php }  elseif($admin['assignRole'] == 'PAYMENT MANAGEMENT'){ ?>



      <li class="header">PAYMENT MANAGEMENT</li>

      <li class="<?php if($active == 'payment' || $active == 'revenue'  || $active == 'ppvpayment' ){ echo "active"; }?> treeview">
            <a href="#">
              <i class="fa fa-credit-card"></i> <span>Payments</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <!--li class="<?php if($active == 'revenue'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/revenue"><i class="fa fa-circle-o"></i>Revenue System</a></li-->
        <li class="<?php if($active == 'payment'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/manage"><i class="fa fa-circle-o"></i>Coin History</a></li>
        <!-- <li class="<?php if($active == 'ppvpayment'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/ppvpayment"><i class="fa fa-circle-o"></i>PPV Payments</a></li> -->
            </ul>
          </li>


<?php }
   elseif($admin['assignRole'] == 'OFFLINE PAYMENT MANAGEMENT'){ ?>

     <li class="<?php if($active == 'viewWallet'  ){ echo "active"; }?> treeview">
           <a href="#">
             <i class="fa fa-credit-card"></i> <span>Wallet</span>
             <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
           <ul class="treeview-menu">
              <!-- <li class="<?php if($active == 'addCoins1'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/addCoins"><i class="fa fa-circle-o"></i>Add Coins</a></li> -->
              <li class="<?php if($active == 'viewWallet'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/viewWallet"><i class="fa fa-circle-o"></i>View Wallet</a></li>

         </ul>
     </li>


     <li class="<?php if($active == 'payment1' || $active == 'addCoins1'  ){ echo "active"; }?> treeview">
           <a href="#">
             <i class="fa fa-credit-card"></i> <span>Payments</span>
             <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
           <ul class="treeview-menu">
              <li class="<?php if($active == 'addCoins1'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/addCoins"><i class="fa fa-circle-o"></i>Send Coins</a></li>
              <li class="<?php if($active == 'payment1'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/subAdminCoinsHistory/1"><i class="fa fa-circle-o"></i>Coin History</a></li>
              <
         </ul>

     </li>

  <?php }
   elseif($admin['assignRole'] == 'VIDEO MANAGEMENT'){ ?>

 <li class="header">BADGES & GIFT</li>
   <li class="<?php if($active == 'badges'){ echo "active"; }?> treeview">
       <a href="#">
          <i class="fa fa-book"></i> <span>Badges</span>
          <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
          </span>
       </a>
       <ul class="treeview-menu">
         <li class="<?php if($active == 'badges'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Badges"><i class="fa fa-circle-o"></i>Badges</a></li>
       </ul>
   </li>

   <li class="<?php if($active == 'crown'){ echo "active"; }?> treeview">
       <a href="#">
           <i class="fa fa-book"></i> <span>Crown</span>
           <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
      </span>
       </a>
       <ul class="treeview-menu">
           <li class="<?php if($active == 'crown'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Badges/manageCrown"><i class="fa fa-circle-o"></i>Crown</a></li>
       </ul>
   </li>


  <li class="header">VIDEO MANAGEMENT</li>

  <li class="<?php if($active == 'pendingVideo' || $active == 'apporveVideo' || $active == 'rejectVideo'){ echo "active"; }?> treeview">
    <a href="#">
      <i class="fa fa-video-camera"></i> <span>Videos</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <!--li class="<?php if($active == 'admin_video'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/admin_video"><i class="fa fa-circle-o"></i>Admin Videos</a></li-->
      <li class="<?php if($active == 'pendingVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/pending"><i class="fa fa-circle-o"></i>Approved Videos</a></li>
      <li class="<?php if($active == 'apporveVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/trending"><i class="fa fa-circle-o"></i>Trending Videos</a></li>
      <li class="<?php if($active == 'rejectVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/rejected"><i class="fa fa-circle-o"></i>Rejected Videos</a></li>
    </ul>
  </li>
  <li class="<?php if($active == 'addAdminVideo' || $active == 'adminVideo' ){ echo "active"; }?> treeview">
    <a href="#">
      <i class="fa fa-video-camera"></i> <span>Admin Video</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li class="<?php if($active == 'addAdminVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/addAdminVideo"><i class="fa fa-circle-o"></i>Add Videos</a></li>
      <li class="<?php if($active == 'adminVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/adminVideo"><i class="fa fa-circle-o"></i>View Videos</a></li>
    </ul>
  </li>


       <li class="<?php if($active == 'addhash' || $active == 'managehash'){ echo "active"; }?> treeview">
        <a href="#">
          <i class="fa fa-suitcase"></i> <span>Hashtags</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($active == 'addhash'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Hashtags/addHash"><i class="fa fa-circle-o"></i>Add Hashtags</a></li>
    <li class="<?php if($active == 'managehash'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Hashtags/manage"><i class="fa fa-circle-o"></i>View Hashtags</a></li>
        </ul>
      </li>

  <li class="<?php if($active == 'slider' || $active == 'addSlider'){ echo "active"; }?> treeview">
        <a href="#">
          <i class="fa fa-diamond"></i> <span>Sliders</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($active == 'addSlider'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Slider/add"><i class="fa fa-circle-o"></i>Slider</a></li>
    <li class="<?php if($active == 'slider'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Slider/manage"><i class="fa fa-circle-o"></i>View Slider</a></li>
        </ul>
      </li>

  <li class="<?php if($active == 'addCountry' || $active == 'GetCountry'){ echo "active"; }?> treeview">
        <a href="#">
          <i class="fa fa-diamond"></i> <span>Country Flag</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if($active == 'addCountry'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Country/add"><i class="fa fa-circle-o"></i>Add Country Flag</a></li>
    <li class="<?php if($active == 'GetCountry'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Country/manage"><i class="fa fa-circle-o"></i>View Country Flag</a></li>
        </ul>
      </li>

      <?php }  elseif($admin['assignRole'] == 'REPORTS MANAGEMENT'){ ?>

        <li class="header">REPORTS MANAGEMENT</li>
        <li class="<?php if($active == 'report' || $active == 'streamReport' || $active == 'problemReport' || $active == 'userReport'){ echo "active"; }?> treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Reports</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($active == 'report'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Report/manage"><i class="fa fa-circle-o"></i>Reports</a></li>
                <li class="<?php if($active == 'streamReport'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Report/streamReport"><i class="fa fa-circle-o"></i>User Report</a></li>
                <li class="<?php if($active == 'problemReport'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Report/problemReport"><i class="fa fa-circle-o"></i>Problem Report</a></li>
                <li class="<?php if($active == 'userReport'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Report/problemReport"><i class="fa fa-circle-o"></i>UserProblem Report</a></li>
                <li class="<?php if($active == 'userReport'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Report/userProblem"><i class="fa fa-circle-o"></i>User video Report</a></li>


              </ul>
            </li>
  <?php } else{ ?>

	  <li class="<?php if($active == 'dashboard'){ echo "active"; }?>"><a href="<?php echo site_url()?>/admin/dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>


		<li class="header">ACCOUNTS MANAGEMENT</li>
        <li class="<?php if($active == 'addUser' || $active == 'user' || $active == 'verifyUser' || $active == 'userreport' || $active == 'userMessage' || $active == 'liveuser' || $active == 'hotlist'){ echo "active"; }?> treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--<li class="<?php if($active == 'addUser'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/addUser"><i class="fa fa-circle-o"></i>Add User</a></li>-->
			      <li class="<?php if($active == 'user'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/manage"><i class="fa fa-circle-o"></i>View Users</a></li>
           <li class="<?php if($active == 'hotlist'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/hotListUser"><i class="fa fa-circle-o"></i>Top User</a></li>
            <li class="<?php if($active == 'liveuser'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/liveUser"><i class="fa fa-circle-o"></i>Live User</a></li>
        <li class="<?php if($active == 'liveRequest'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/liveRequest"><i class="fa fa-circle-o"></i>Live Request</a></li>
            <li class="<?php if($active == 'userreport'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/userReport"><i class="fa fa-circle-o"></i>User Report</a></li>
				    <li class="<?php if($active == 'userMessage'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/message"><i class="fa fa-circle-o"></i>Push Message</a></li>
          </ul>
        </li>


		<!--<li class="<?php if($active == 'addModerators' || $active == 'moderators'){ echo "active"; }?> treeview">-->
  <!--        <a href="#">-->
  <!--          <i class="fa fa-users"></i> <span>Moderators</span>-->
  <!--          <span class="pull-right-container">-->
  <!--            <i class="fa fa-angle-left pull-right"></i>-->
  <!--          </span>-->
  <!--        </a>-->
  <!--        <ul class="treeview-menu">-->
  <!--          <li class="<?php if($active == 'addModerators'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Moderators/addModerators"><i class="fa fa-circle-o"></i>Add Moderators</a></li>-->
		<!--	<li class="<?php if($active == 'moderators'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Moderators/manage"><i class="fa fa-circle-o"></i>View Moderators</a></li>-->
  <!--        </ul>-->
  <!--      </li>-->



        <li class="<?php if($active == 'managePendingHostRequest' || $active == 'approvedHostRequest' || $active == 'rejectedHostRequest'){ echo "active"; }?> treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Host</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($active == 'managePendingHostRequest'){ echo "active"; }?>"><a href="<?php echo site_url()?>/UserVerification/manageHost/1"><i class="fa fa-circle-o"></i>Pending Host Request</a></li>
                <li class="<?php if($active == 'approvedHostRequest'){ echo "active"; }?>"><a href="<?php echo site_url()?>/UserVerification/manageHost/2"><i class="fa fa-circle-o"></i>Approved Host Request</a></li>
                <li class="<?php if($active == 'rejectedHostRequest'){ echo "active"; }?>"><a href="<?php echo site_url()?>/UserVerification/manageHost/3"><i class="fa fa-circle-o"></i>Rejected Host Request</a></li>
              </ul>
            </li>


        <li class="<?php if($active == 'penidngAgency' || $active == 'agency' || $active == 'rejectedAgency'){ echo "active"; }?> treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Agency</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($active == 'penidngAgency'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Agency/manage/3"><i class="fa fa-circle-o"></i>Pending Agency</a></li>
                <li class="<?php if($active == 'agency'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Agency/manage/1"><i class="fa fa-circle-o"></i>Approved Agency</a></li>
                <li class="<?php if($active == 'rejectedAgency'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Agency/manage/2"><i class="fa fa-circle-o"></i>Rejected Agency</a></li>
              </ul>
            </li>
            
            <li class="<?php if($active == 'penidngAgency' || $active == 'agency' || $active == 'rejectedAgency'){ echo "active"; }?> treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Manage Agency</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class="<?php if($active == 'addAgency'){ echo "active"; }?>"><a href="<?php echo site_url()?>/SubAdmin/addAgency"><i class="fa fa-circle-o"></i>Add Agency</a></li>
                <!--<li class="<?php if($active == 'penidngAgency'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Agency/manage/3"><i class="fa fa-circle-o"></i>Pending Agency</a></li>-->
                <!--<li class="<?php if($active == 'agency'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Agency/manage/1"><i class="fa fa-circle-o"></i>Approved Agency</a></li>-->
                <!--<li class="<?php if($active == 'rejectedAgency'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Agency/manage/2"><i class="fa fa-circle-o"></i>Rejected Agency</a></li>-->
              </ul>
            </li>


		<li class="<?php if($active == 'addSubAdmin' || $active == 'subAdmin'){ echo "active"; }?> treeview">
          <a href="#">
            <i class="fa fa-support"></i> <span>Sub Admin</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($active == 'addSubAdmin'){ echo "active"; }?>"><a href="<?php echo site_url()?>/SubAdmin/addSubAdmin"><i class="fa fa-circle-o"></i>Add Sub Admin</a></li>
			     <li class="<?php if($active == 'subAdmin'){ echo "active"; }?>"><a href="<?php echo site_url()?>/SubAdmin/manage"><i class="fa fa-circle-o"></i>View Sub Admin</a></li>
           <li class="<?php if($active == 'subAdminCoinHistory'){ echo "active"; }?>"><a href="<?php echo site_url()?>/SubAdmin/coinsHistory"><i class="fa fa-circle-o"></i>SubAdmin Coins History</a></li>

          </ul>
        </li>

        <!--<li class="header">BADGES & GIFT</li>-->
    	<!--<li class="<?php if($active == 'badges'){ echo "active"; }?> treeview">-->
     <!-- 		<a href="#">-->
     <!--  			 <i class="fa fa-book"></i> <span>Badges</span>-->
     <!--  			 <span class="pull-right-container">-->
     <!--     			<i class="fa fa-angle-left pull-right"></i>-->
     <!--  			 </span>-->
     <!-- 		</a>-->
     <!-- 		<ul class="treeview-menu">-->
     <!--   		<li class="<?php if($active == 'badges'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Badges"><i class="fa fa-circle-o"></i>Badges</a></li>-->
     <!-- 		</ul>-->
    	<!--</li>-->

      <!--<li class="<?php if($active == 'crown'){ echo "active"; }?> treeview">-->
      <!--    <a href="#">-->
      <!--        <i class="fa fa-book"></i> <span>Crown</span>-->
      <!--        <span class="pull-right-container">-->
      <!--      <i class="fa fa-angle-left pull-right"></i>-->
      <!--   </span>-->
      <!--    </a>-->
      <!--    <ul class="treeview-menu">-->
      <!--        <li class="<?php if($active == 'crown'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Badges/manageCrown"><i class="fa fa-circle-o"></i>Crown</a></li>-->
      <!--    </ul>-->
      <!--</li>-->


      <!--<li class="<?php if($active == 'addGift' || $active == 'gift'){ echo "active"; }?> treeview">-->
      <!--  <a href="#">-->
      <!--    <i class="fa fa-gift"></i> <span>Gift</span>-->
      <!--    <span class="pull-right-container">-->
      <!--      <i class="fa fa-angle-left pull-right"></i>-->
      <!--    </span>-->
      <!--  </a>-->
      <!--  <ul class="treeview-menu">-->
      <!--    <li class="<?php if($active == 'addGift'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Gift/add"><i class="fa fa-circle-o"></i>Add Gift</a></li>-->
      <!--    <li class="<?php if($active == 'gift'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Gift/manage"><i class="fa fa-circle-o"></i>View Gift</a></li>-->
      <!--  </ul>-->
      <!--</li>-->



      <!--<li class="<?php if($active == 'addliveGift' || $active == 'liveGift' || $active == 'liveGiftCategory'){ echo "active"; }?> treeview">-->
      <!--  <a href="#">-->
      <!--    <i class="fa fa-gift"></i> <span>Live Gift</span>-->
      <!--    <span class="pull-right-container">-->
      <!--      <i class="fa fa-angle-left pull-right"></i>-->
      <!--    </span>-->
      <!--  </a>-->
      <!--  <ul class="treeview-menu">-->
      <!--    <li class="<?php if($active == 'liveGiftCategory'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Gift/liveGiftCategory"><i class="fa fa-circle-o"></i>Gift Category</a></li>-->
      <!--    <li class="<?php if($active == 'addliveGift'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Gift/addliveGift"><i class="fa fa-circle-o"></i>Add Live Gift</a></li>-->
      <!--    <li class="<?php if($active == 'liveGift'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Gift/liveGift"><i class="fa fa-circle-o"></i>View Live Gift</a></li>-->
      <!--  </ul>-->
      <!--</li>-->


      <!--<li class="<?php if($active == 'addCoin' || $active == 'coin'){ echo "active"; }?> treeview">-->
      <!--  <a href="#">-->
      <!--    <i class="fa fa-gift"></i> <span>Coins</span>-->
      <!--    <span class="pull-right-container">-->
      <!--      <i class="fa fa-angle-left pull-right"></i>-->
      <!--    </span>-->
      <!--  </a>-->
      <!--  <ul class="treeview-menu">-->
      <!--    <li class="<?php if($active == 'addCoin'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Coins/add"><i class="fa fa-circle-o"></i>Add Coins</a></li>-->
      <!--    <li class="<?php if($active == 'coin'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Coins/manage"><i class="fa fa-circle-o"></i>View Coins</a></li>-->
      <!--  </ul>-->
      <!--</li>-->


          <!--<li class="<?php if($active == 'beanschange' || $active == 'dollarexchange'){ echo "active"; }?> treeview">-->
          <!--    <a href="#">-->
          <!--        <i class="fa fa-gift"></i> <span>Beans Exchange</span>-->
          <!--        <span class="pull-right-container">-->
          <!--  <i class="fa fa-angle-left pull-right"></i>-->
          <!--</span>-->
          <!--    </a>-->
          <!--    <ul class="treeview-menu">-->
          <!--        <li class="<?php if($active == 'dollarexchange'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Beans/dollarExchange"><i class="fa fa-circle-o"></i>Dollar Exchange</a></li>-->
          <!--        <li class="<?php if($active == 'beanschange'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Beans/beansExchangePackages"><i class="fa fa-circle-o"></i>Beans Exchange Packages</a></li>-->


          <!--    </ul>-->
          <!--</li>-->


          <!--<li class="<?php if($active == 'addlevel' || $active == 'viewlevel'){ echo "active"; }?> treeview">-->
          <!--    <a href="#">-->
          <!--        <i class="fa fa-gift"></i> <span>Level</span>-->
          <!--        <span class="pull-right-container">-->
          <!--  <i class="fa fa-angle-left pull-right"></i>-->
          <!--</span>-->
          <!--    </a>-->
          <!--    <ul class="treeview-menu">-->
          <!--        <li class="<?php if($active == 'addlevel'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Level/addlevel"><i class="fa fa-circle-o"></i>Add Level</a></li>-->
          <!--        <li class="<?php if($active == 'viewlevel'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Level/manageLevels"><i class="fa fa-circle-o"></i>View Level</a></li>-->
          <!--    </ul>-->
          <!--</li>-->

      <!--<li class="header">Dummy Views</li>-->
      <!-- <li class="<?php if($active == 'dummyView' || $active == 'defaultViewCounts' || $active == 'dummyUserView'){ echo "active"; }?> treeview">-->
      <!--  <a href="#">-->
      <!--   <i class="fa fa-circle"></i></i> <span>Dummy Views</span>-->
      <!--    <span class="pull-right-container">-->
      <!--      <i class="fa fa-angle-left pull-right"></i>-->
      <!--    </span>-->
      <!--  </a>-->
      <!--  <ul class="treeview-menu">-->
      <!--    <li class="<?php if($active == 'dummyView'){ echo "active"; }?>"><a href="<?php echo site_url()?>/LiveViews/dummyView"><i class="fa fa-circle-o"></i>Manage Dummy View</a></li>-->
      <!--    <li class="<?php if($active == 'dummyUserView'){ echo "active"; }?>"><a href="<?php echo site_url()?>/LiveViews/dummyUserView"><i class="fa fa-circle-o"></i>Manage User Dummy View</a></li>-->
      <!--    <li class="<?php if($active == 'defaultViewCounts'){ echo "active"; }?>"><a href="<?php echo site_url()?>/LiveViews/defaultViewCounts"><i class="fa fa-circle-o"></i>Default View Counts</a></li>-->

      <!--  </ul>-->
      <!--</li>-->

    <!--<li class="header">WHEEL MANAGEMENT</li>
     <li class="<?php if($active == 'viewWheel'){ echo "active"; }?> treeview">
      <a href="#">
       <i class="fa fa-circle"></i></i> <span>wheel history</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if($active == 'viewWheel'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/viewWheel"><i class="fa fa-circle-o"></i>View Wheel History</a></li>

      </ul>
    </li>-->





		<!--<li class="header">VIDEO MANAGEMENT</li>-->

    <!--<li class="<?php if($active == 'pendingVideo' || $active == 'trendingVideo' || $active == 'rejectVideo' || $active == 'trendingVideo' || $active == 'nonViewedVideo' ){ echo "active"; }?> treeview">-->
    <!--  <a href="#">-->
    <!--    <?php $countShortVIdeo = $this->db->get_where('userVideos')->num_rows();?>-->
    <!--    <i class="fa fa-video-camera"></i> <span>Videos  (<?php echo $countShortVIdeo; ?>)</span>-->
    <!--    <span class="pull-right-container">-->
    <!--      <i class="fa fa-angle-left pull-right"></i>-->
    <!--    </span>-->
    <!--  </a>-->
    <!--  <ul class="treeview-menu">-->
        
    <!--    <li class="<?php if($active == 'nonViewedVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/nonViewed"><i class="fa fa-circle-o"></i>Non Viewed Videos (<?php echo $countShortNonViewdVIdeo; ?>)</a></li>-->
    <!--    <li class="<?php if($active == 'pendingVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/pending"><i class="fa fa-circle-o"></i>Viewed Videos (<?php echo $countShortViewdVIdeo; ?>)</a></li>-->
    <!--    <li class="<?php if($active == 'trendingVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/trending"><i class="fa fa-circle-o"></i>Trending Videos (<?php echo $countShortTrendingVIdeo; ?>)</a></li>-->
    <!--    <li class="<?php if($active == 'rejectVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/rejected"><i class="fa fa-circle-o"></i>Rejected Videos (<?php echo $countShortRejectVIdeo; ?>)</a></li>-->
    <!--  </ul>-->
    <!--</li>-->

    <!-- <li class="<?php if($active == 'pendingVideo' || $active == 'apporveVideo' || $active == 'rejectVideo'){ echo "active"; }?> treeview">
      <a href="#">
        <i class="fa fa-video-camera"></i> <span>Videos</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu"> -->
        <!--li class="<?php if($active == 'admin_video'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/admin_video"><i class="fa fa-circle-o"></i>Admin Videos</a></li-->
        <!-- <li class="<?php if($active == 'pendingVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/pending"><i class="fa fa-circle-o"></i>Non Viewed Videos</a></li>
        <li class="<?php if($active == 'pendingVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/pending"><i class="fa fa-circle-o"></i>Approved Videos</a></li>
        <li class="<?php if($active == 'apporveVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/trending"><i class="fa fa-circle-o"></i>Trending Videos</a></li>
        <li class="<?php if($active == 'rejectVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/rejected"><i class="fa fa-circle-o"></i>Rejected Videos</a></li>
      </ul>
    </li> -->
    <!--<li class="<?php if($active == 'addAdminVideo' || $active == 'adminVideo' ){ echo "active"; }?> treeview">-->
    <!--  <a href="#">-->
    <!--    <i class="fa fa-video-camera"></i> <span>Admin Video</span>-->
    <!--    <span class="pull-right-container">-->
    <!--      <i class="fa fa-angle-left pull-right"></i>-->
    <!--    </span>-->
    <!--  </a>-->
    <!--  <ul class="treeview-menu">-->
    <!--    <li class="<?php if($active == 'addAdminVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/addAdminVideo"><i class="fa fa-circle-o"></i>Add Videos</a></li>-->
    <!--    <li class="<?php if($active == 'adminVideo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Videos/adminVideo"><i class="fa fa-circle-o"></i>View Videos</a></li>-->
    <!--  </ul>-->
    <!--</li>-->
		<!--<li class="<?php if($active == 'addCategory' || $active == 'category'){ echo "active"; }?> treeview">
          <a href="#">
            <i class="fa fa-suitcase"></i> <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($active == 'addCategory'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Category/addCategory"><i class="fa fa-support"></i>Add Category</a></li>
			<li class="<?php if($active == 'category'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Category/manage"><i class="fa fa-circle-o"></i>View Category</a></li>
          </ul>
        </li>
		<li class="<?php if($active == 'addSubCategory' || $active == 'subCategory'){ echo "active"; }?> treeview">
          <a href="#">
            <i class="fa fa-suitcase"></i> <span>Sub Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($active == 'addSubCategory'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Category/addSubCategory"><i class="fa fa-circle-o"></i>Add Sub Category</a></li>
			<li class="<?php if($active == 'subCategory'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Category/subCategory"><i class="fa fa-circle-o"></i>View Sub Category</a></li>
          </ul>
        </li>-->
      <!--  <li class="<?php if($active == 'addSound' || $active == 'manage'){ echo "active"; }?> treeview">-->
      <!--    <a href="#">-->
      <!--      <i class="fa fa-suitcase"></i> <span>Sounds</span>-->
      <!--      <span class="pull-right-container">-->
      <!--        <i class="fa fa-angle-left pull-right"></i>-->
      <!--      </span>-->
      <!--    </a>-->
      <!--    <ul class="treeview-menu">-->
      <!--      <li class="<?php if($active == 'addSound'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Sounds/addSound"><i class="fa fa-circle-o"></i>Add Sound</a></li>-->
      <!--<li class="<?php if($active == 'manage'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Sounds/Sound"><i class="fa fa-circle-o"></i>View Sound</a></li>-->
      <!--    </ul>-->
      <!--  </li>-->
      <!--   <li class="<?php if($active == 'addhash' || $active == 'managehash'){ echo "active"; }?> treeview">-->
      <!--    <a href="#">-->
      <!--      <i class="fa fa-suitcase"></i> <span>Hashtags</span>-->
      <!--      <span class="pull-right-container">-->
      <!--        <i class="fa fa-angle-left pull-right"></i>-->
      <!--      </span>-->
      <!--    </a>-->
      <!--    <ul class="treeview-menu">-->
      <!--      <li class="<?php if($active == 'addhash'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Hashtags/addHash"><i class="fa fa-circle-o"></i>Add Hashtags</a></li>-->
      <!--<li class="<?php if($active == 'managehash'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Hashtags/manage"><i class="fa fa-circle-o"></i>View Hashtags</a></li>-->
      <!--    </ul>-->
      <!--  </li>-->

		<!--<li class="<?php if($active == 'slider' || $active == 'addSlider'){ echo "active"; }?> treeview">-->
  <!--        <a href="#">-->
  <!--          <i class="fa fa-diamond"></i> <span>Sliders</span>-->
  <!--          <span class="pull-right-container">-->
  <!--            <i class="fa fa-angle-left pull-right"></i>-->
  <!--          </span>-->
  <!--        </a>-->
  <!--        <ul class="treeview-menu">-->
  <!--          <li class="<?php if($active == 'addSlider'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Slider/add"><i class="fa fa-circle-o"></i>Slider</a></li>-->
		<!--	<li class="<?php if($active == 'slider'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Slider/manage"><i class="fa fa-circle-o"></i>View Slider</a></li>-->
  <!--        </ul>-->
  <!--      </li>-->

		<!--<li class="<?php if($active == 'addCountry' || $active == 'GetCountry'){ echo "active"; }?> treeview">-->
  <!--        <a href="#">-->
  <!--          <i class="fa fa-diamond"></i> <span>Country Flag</span>-->
  <!--          <span class="pull-right-container">-->
  <!--            <i class="fa fa-angle-left pull-right"></i>-->
  <!--          </span>-->
  <!--        </a>-->
  <!--        <ul class="treeview-menu">-->
  <!--          <li class="<?php if($active == 'addCountry'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Country/add"><i class="fa fa-circle-o"></i>Add Country Flag</a></li>-->
		<!--	<li class="<?php if($active == 'GetCountry'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Country/manage"><i class="fa fa-circle-o"></i>View Country Flag</a></li>-->
  <!--        </ul>-->
  <!--      </li>-->
    <li class="header">REPORTS MANAGEMENT</li>
    <li class="<?php if($active == 'report' || $active == 'streamReport' || $active == 'problemReport' || $active == 'userReport'){ echo "active"; }?> treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($active == 'report'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Report/manage"><i class="fa fa-circle-o"></i>Reports</a></li>
            <li class="<?php if($active == 'streamReport'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Report/streamReport"><i class="fa fa-circle-o"></i>User Report</a></li>
            <!-- <li class="<?php if($active == 'problemReport'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Report/problemReport"><i class="fa fa-circle-o"></i>Problem Report</a></li> -->
            <li class="<?php if($active == 'userReport'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Report/problemReport"><i class="fa fa-circle-o"></i>UserProblem Report</a></li>
            <li class="<?php if($active == 'userReport'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Report/userProblem"><i class="fa fa-circle-o"></i>User video Report</a></li>


          </ul>
        </li>
		<!--<li class="header">PAYMENT MANAGEMENT</li>-->

		<!--<li class="<?php if($active == 'payment' || $active == 'revenue'  || $active == 'ppvpayment'  ){ echo "active"; }?> treeview">-->
  <!--        <a href="#">-->
  <!--          <i class="fa fa-credit-card"></i> <span>Payments</span>-->
  <!--          <span class="pull-right-container">-->
  <!--            <i class="fa fa-angle-left pull-right"></i>-->
  <!--          </span>-->
  <!--        </a>-->
  <!--        <ul class="treeview-menu">-->
            <!--li class="<?php if($active == 'revenue'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/revenue"><i class="fa fa-circle-o"></i>Revenue System</a></li-->
		<!--	<li class="<?php if($active == 'payment'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/manage"><i class="fa fa-circle-o"></i>Subscription Payments</a></li>-->
		<!--	<li class="<?php if($active == 'ppvpayment'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/ppvpayment"><i class="fa fa-circle-o"></i>PPV Payments</a></li>-->
      <!-- <li class="<?php if($active == 'subAdminCoinsHistory'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/subAdminCoinsHistory"><i class="fa fa-circle-o"></i>Sub Admin Coins History</a></li> -->

  <!--        </ul>-->
  <!--      </li>-->

        <li class="<?php if( $active == 'subAdminCoinsHistory' || $active == 'addSubadminCoins'){ echo "active"; }?> treeview">
              <a href="#">
                <i class="fa fa-credit-card"></i> <span>Recharge</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <!--li class="<?php if($active == 'revenue'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/revenue"><i class="fa fa-circle-o"></i>Revenue System</a></li-->
    			<!-- <li class="<?php if($active == 'payment'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/manage"><i class="fa fa-circle-o"></i>Subscription Payments</a></li>
    			<li class="<?php if($active == 'ppvpayment'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/ppvpayment"><i class="fa fa-circle-o"></i>PPV Payments</a></li> -->
          <li class="<?php if($active == 'addSubadminCoins'){ echo "active"; }?>"><a href="<?php echo site_url()?>/SubAdmin/sendCoinsSubadmin"><i class="fa fa-circle-o"></i>Send Coins</a></li>

          <li class="<?php if($active == 'subAdminCoinsHistory'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Payment/subAdminCoinsHistory"><i class="fa fa-circle-o"></i>Recharge History</a></li>

              </ul>
            </li>



<?php } ?>


<li class="header">Admin Account</li>
 <li class="<?php if($active == 'edit_profile'){ echo "active"; }?>"><a href="<?php echo site_url()?>/admin/edit_profile"><i class="fa fa-diamond"></i>Account</a></li>

   <?php if($admin['role'] == 0){?>
 <li class="<?php if($active == 'settings' || $active == 'logo' || $active == 'length' || $active == 'splash'){ echo "active"; }?> treeview">
      <a href="#">
        <i class="fa fa-cog" aria-hidden="true"></i> <span>Settings</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php if($active == 'logo'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Settings/logo"><i class="fa fa-circle-o"></i>Logo</a></li>
        <li class="<?php if($active == 'length'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Settings/length"><i class="fa fa-circle-o"></i>Description Length</a></li>
        <li class="<?php if($active == 'splash'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Settings/splash"><i class="fa fa-circle-o"></i>Splash Image</a></li>
      </ul>
    </li>
<?php } ?>
 <li class=""><a href="<?php echo site_url()?>/admin/logout"><i class="fa fa-sign-out"></i>Sign Out</a></li>
  </ul>
</section>
<!-- /.sidebar -->
</aside>
