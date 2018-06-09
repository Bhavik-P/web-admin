<?php  require_once('admin_code/admin_session.php'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>True Translate</title>

  <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/plugins/toggles/toggles.css" rel="stylesheet">
  <link href="assets/plugins/sweetalert/dist/sweetalert.css" rel="stylesheet">

  <script src="assets/js/modernizr.min.js"></script>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>

<body class="fixed-left widescreen">
  <div id="wrapper">
    <div class="top-bar">
      <div class="top-bar-left">
        <div class="pull-left">
          <button class="button-menu-mobile open-left"><i class="fa fa-bars"></i></button>
        </div>
        <div class="text-center"><a href="index.php" class="logo"><span>True Translate</span></a></div>
      </div>
      <div class="navbar navbar-default" role="navigation">
        <div class="container">
          <!--<form class="navbar-form pull-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control search-bar" placeholder="Search...">
            </div>
            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
          </form>-->
        <ul class="nav navbar-nav navbar-right pull-right">
            <!--  <li class="dropdown hidden-xs"><a title="Notification" href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-bell"></i> <span class="badge badge-xs badge-danger">5</span></a>
            <ul class="dropdown-menu dropdown-menu-lg">
                <li class="notifi-title p-l-20">Notification</li>
                <li class="list-group">
                  <a href="javascript:void(0);" class="list-group-item">
                    <div class="media">
                      <div class="pull-left">
                        <div class="notifi-box bg-danger">
                          <i class="fa fa-check text-white" style="padding-top: 8px; padding-left: 8px;"></i>
                        </div>
                      </div>
                      <div class="media-body clearfix">
                        <p class="m-0">Update 1.0.4 successfully pushed</p>
                        <p class="m-0" style="margin-top: -5px !important;"><small>20 mins go</small></p>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0);" class="list-group-item">
                    <div class="media">
                      <div class="pull-left">
                        <div class="notifi-box bg-primary">
                          <i class="fa fa-check text-primary text-white" style="padding-top: 8px; padding-left: 8px;"></i>
                        </div>
                      </div>
                      <div class="media-body clearfix">
                        <p class="m-0">Update 1.0.3 successfully pushed</p>
                        <p class="m-0" style="margin-top: -5px !important;"><small>32 mins go</small></p>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0);" class="list-group-item">
                    <div class="media">
                      <div class="pull-left">
                        <div class="notifi-box bg-info">
                          <i class="fa fa-check text-primary text-white" style="padding-top: 8px; padding-left: 8px;"></i>
                        </div>
                      </div>
                      <div class="media-body clearfix">
                        <p class="m-0">Update 1.0.2 successfully pushed</p>
                        <p class="m-0" style="margin-top: -5px !important;"><small>47 mins go</small></p>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0);" class="list-group-item">
                    <div class="media">
                      <div class="pull-left">
                        <div class="notifi-box bg-success">
                          <i class="fa fa-check text-primary text-white" style="padding-top: 8px; padding-left: 8px;"></i>
                        </div>
                      </div>
                      <div class="media-body clearfix">
                        <p class="m-0">Update 1.0.1 successfully pushed</p>
                        <p class="m-0" style="margin-top: -5px !important;"><small>58 mins go</small></p>
                      </div>
                    </div>
                  </a>
                  <a href="javascript:void(0);" class="list-group-item"><small>See all notifications</small></a></li>
              </ul>
            </li>-->
            <li class="hidden-xs"><a title="Minimize" href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="fa fa-arrows-alt"></i></a></li>
            <li class="hidden-xs"><a title="Log Out" href="admin_code/logout.php"><i class="fa fa-sign-out"></i></a></li>
        </ul>
        </div>
      </div>
    </div>

    <div class="left side-menu">
      <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
          <!--<div class="pull-left"><img src="assets/images/users/avatar-1.jpg" alt="" class="thumb-md img-circle"></div>
          <div class="user-info">
            <div class="dropdown"><a href="#" class="dropdown-toggle text-white p-l-10" data-toggle="dropdown" aria-expanded="false">Tomny  <span class="caret text-white"></span></a>
              <ul class="dropdown-menu">
                <li><a href="extra-profile.html"><i class="fa fa-user"></i><span class="pull-right">Profile</span><div class="ripple-wrapper"></div></a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-cogs"></i><span class="pull-right">Settings</span></a></li>
             <li><a href="extra-lock-screen.html"><i class="fa fa-lock"></i><span class="pull-right">Lock screen</span></a></li>
              </ul>
            </div>
            <p class="text-white m-0 p-l-10">Backend</p>
          </div>-->
        </div>
        <div id="sidebar-menu">
          <ul>
            <li><a href="index.php" class="waves-effect active"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
			<li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-folder-open-o"></i><span>Master</span><span class="pull-right"><i class="arrow-angle-right fa fa-angle-right"></i></span></a>
              <ul>
                <li><a href="m_country.php"><i class="fa fa-circle"></i>country</a></li>
                <li><a href="m_state.php"><i class="fa fa-circle"></i>State</a></li>
                <li><a href="m_city.php"><i class="fa fa-circle"></i>City</a></li>
                <li><a href="m_language.php"><i class="fa fa-circle"></i>Language</a></li>
                <li><a href="m_rate.php"><i class="fa fa-circle"></i>Rate</a></li>
              </ul>
            </li>
			<li><a href="clients.php" class="waves-effect"><i class="fa fa-user"></i><span>Clients</span></a></li>
			<li><a href="translators.php" class="waves-effect"><i class="fa fa-comments-o"></i><span>Translators</span></a></li>
			<li><a href="new-projects.php" class="waves-effect"><i class="fa fa-tasks"></i><span>New Projects</span></a></li>
			<li><a href="upcoming-schedule.php" class="waves-effect"><i class="fa fa-calendar"></i><span>Upcoming Schedule</span></a></li>
			<li><a href="history.php" class="waves-effect"><i class="fa fa-history"></i><span>History</span></a></li>
			<li><a href="all-review-rating.php" class="waves-effect"><i class="fa fa-star"></i><span>All Reviews & Rating</span></a></li>
          </ul>
        </div>
      </div>
    </div>