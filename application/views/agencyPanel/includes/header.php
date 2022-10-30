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
    <a href="<?= site_url();?>/AgencyPanel/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>NL</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>NicoLive</b></span>

    </a>
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
                  <a href="<?php echo site_url()?>/agencyPanel/edit_profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url();?>/agencyPanel/logout" class="btn btn-default btn-flat">Sign out</a>
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

        <li class="<?php if($active == 'dashboard'){ echo "active"; }?>"><a href="<?php echo site_url()?>/AgencyPanel/dashboard"><i class="fa fa-dashboard"></i>Agency Portal</a></li>
        
        <li class="header">ACCOUNTS MANAGEMENT</li>
        
        <li class="<?php if($active == 'managePendingHostRequest' || $active == 'approvedHostRequest' || $active == 'rejectedHostRequest'){ echo "active"; }?> treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Host</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($active == 'managePendingHostRequest'){ echo "active"; }?>"><a href="<?php echo site_url()?>/AgencyPanel/manageHosts/1"><i class="fa fa-circle-o"></i>Pending Host Request</a></li>
                <li class="<?php if($active == 'approvedHostRequest'){ echo "active"; }?>"><a href="<?php echo site_url()?>/AgencyPanel/manageHosts/2"><i class="fa fa-circle-o"></i>Approved Host Request</a></li>
                <li class="<?php if($active == 'rejectedHostRequest'){ echo "active"; }?>"><a href="<?php echo site_url()?>/AgencyPanel/manageHosts/3"><i class="fa fa-circle-o"></i>Rejected Host Request</a></li>
              </ul>
            </li>


        <!--<li class="<?php if($active == 'talentList'){ echo "active"; }?>"><a href="<?php echo site_url()?>/Talent/manage"><i class="fa fa-users"></i>Talent List</a></li>-->


	       <!--<li class="<?php if($active == 'agencyReport'){ echo "active"; }?>"><a href="<?php echo site_url()?>/AgencyPanel/report"><i class="fa fa-users"></i>Agency Report</a></li>-->


		<!--li class="header">ACCOUNTS MANAGEMENT</li>
        <li class="<?php if($active == 'addUser' || $active == 'user' || $active == 'verifyUser' || $active == 'userreport' || $active == 'userMessage' || $active == 'liveuser' || $active == 'hotlist'){ echo "active"; }?> treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($active == 'addUser'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/addUser"><i class="fa fa-circle-o"></i>Add User</a></li>
			      <li class="<?php if($active == 'user'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/manage"><i class="fa fa-circle-o"></i>View Users</a></li>

           <li class="<?php if($active == 'hotlist'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/hotListUser"><i class="fa fa-circle-o"></i>Hotlist User</a></li>

            <li class="<?php if($active == 'liveuser'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/liveUser"><i class="fa fa-circle-o"></i>Live User</a></li>
            	<li class="<?php if($active == 'verifyUser'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/verifyAccount"><i class="fa fa-circle-o"></i>Verify Form Request</a></li>
            <li class="<?php if($active == 'userreport'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/userReport"><i class="fa fa-circle-o"></i>User Report</a></li>
				    <li class="<?php if($active == 'userMessage'){ echo "active"; }?>"><a href="<?php echo site_url()?>/User/message"><i class="fa fa-circle-o"></i>Push Message</a></li>
          </ul>
        </li>
         <li class="header">Admin Account</li>
         <li class="<?php if($active == 'edit_profile'){ echo "active"; }?>"><a href="<?php echo site_url()?>/admin/edit_profile"><i class="fa fa-diamond"></i>Account</a></li>
         <li class=""><a href="<?php echo site_url()?>/admin/logout"><i class="fa fa-sign-out"></i>Sign Out</a></li>
  </ul-->
</section>
<!-- /.sidebar -->
</aside>
