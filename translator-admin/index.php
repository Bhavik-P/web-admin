<?php
	require_once('include/admin_header.php');
	require_once('admin_code/admin_session.php');
	
?>

    <div class="content-wrapper">
      <div class="content">
        <div class="container">
          <div id="content-header" class="clearfix">
            <div class="pull-left">
              <ol class="breadcrumb">
                <li>Welcome !</li>
              </ol>
              <h1>Dashboard</h1>
            </div>
          </div>

        </div>
      </div>

      <footer class="footer">
        <div class="row">
          <div class="col-sm-6 col-lg-6 text-left">
            Copyright &copy; 2016
          </div>
          <div class="col-sm-6 col-lg-6 text-right">
            60GB of <strong>1TB</strong> Free.
          </div>
        </div>
      </footer>
    </div>

    <div class="side-bar right-bar nicescroll">
      <ul class="nav nav-tabs tabs">
        <li class="tab"><a href="#sidebar-userlist" data-toggle="tab" aria-expanded="false"><i class="fa fa-home"></i></a></li>
        <li class="tab"><a href="#sidebar-activity" data-toggle="tab" aria-expanded="false"><i class="fa fa-pencil"></i></a></li>
        <li class="tab"><a href="#sidebar-setting" data-toggle="tab" aria-expanded="true"><i class="fa fa-cogs"></i></a></li>
      </ul>
      <div class="contact-list nicescroll">
        <div class="tab-pane active" id="sidebar-userlist">
          <div class="contact-list nicescroll">
            <h3 class="m-l-15">Friends</h3>
            <ul class="list-group contacts-list">
              <h5 class="m-l-15 text-dark"><strong>Online</strong></h5>
              <li class="list-group-item">
                <a href="#">
                  <div class="avatar">
                    <img src="assets/images/users/avatar-1.jpg" alt="">
                  </div>
                  <span class="name">Chadengle</span>
                  <i class="fa fa-circle online"></i>
                  <span class="clearfix"></span>
                </a>
              </li>
              <li class="list-group-item">
                <a href="#">
                  <div class="avatar">
                    <img src="assets/images/users/avatar-2.jpg" alt="">
                  </div>
                  <span class="name">Tomaslau</span>
                  <i class="fa fa-circle online"></i>
                </a>
                <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                <a href="#">
                  <div class="avatar">
                    <img src="assets/images/users/avatar-3.jpg" alt="">
                  </div>
                  <span class="name">Stillnotdavid</span>
                  <i class="fa fa-circle online"></i>
                </a>
                <span class="clearfix"></span>
              </li>

              <li class="list-group-item">
                <a href="#">
                  <div class="avatar">
                    <img src="assets/images/users/avatar-6.jpg" alt="">
                  </div>
                  <span class="name">Adhamdannaway</span>
                  <i class="fa fa-circle away"></i>
                </a>
                <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                <a href="#">
                  <div class="avatar">
                    <img src="assets/images/users/avatar-7.jpg" alt="">
                  </div>
                  <span class="name">Ok</span>
                  <i class="fa fa-circle away"></i>
                </a>
                <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                <a href="#">
                  <div class="avatar">
                    <img src="assets/images/users/avatar-8.jpg" alt="">
                  </div>
                  <span class="name">Arashasghari</span>
                  <i class="fa fa-circle busy"></i>
                </a>
                <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                <a href="#">
                  <div class="avatar">
                    <img src="assets/images/users/avatar-9.jpg" alt="">
                  </div>
                  <span class="name">Joshaustin</span>
                  <i class="fa fa-circle busy"></i>
                </a>
                <span class="clearfix"></span>
              </li>

              <h5 class="m-l-15 text-dark"><strong>Offline</strong></h5>
              <li class="list-group-item">
                <a href="#">
                  <div class="avatar">
                    <img src="assets/images/users/avatar-4.jpg" alt="">
                  </div>
                  <span class="name">Kurafire</span>
                  <i class="fa fa-circle offline"></i>
                </a>
                <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                <a href="#">
                  <div class="avatar">
                    <img src="assets/images/users/avatar-5.jpg" alt="">
                  </div>
                  <span class="name">Shahedk</span>
                  <i class="fa fa-circle offline"></i>
                </a>
                <span class="clearfix"></span>
              </li>
              <li class="list-group-item">
                <a href="#">
                  <div class="avatar">
                    <img src="assets/images/users/avatar-10.jpg" alt="">
                  </div>
                  <span class="name">Sortino</span>
                  <i class="fa fa-circle offline"></i>
                </a>
                <span class="clearfix"></span>
              </li>
            </ul>
          </div>
        </div>

        <div class="tab-pane" id="sidebar-activity">
          <h3 class="m-l-15">Activity</h3>
          <div class="panel panel-default panel-fill" style="border: none;height: 100%;">
            <div class="panel-body">
              <div class="time-line-2">
                <div class="time-item">
                  <div class="item-info">
                    <div class="text-muted">5 minutes ago</div>
                    <p><strong><a href="#" class="text-info">Tomny </a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong></p>
                  </div>
                </div>
                <div class="time-item">
                  <div class="item-info">
                    <div class="text-muted">30 minutes ago</div>
                    <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit."</em></p>
                  </div>
                </div>
                <div class="time-item">
                  <div class="item-info">
                    <div class="text-muted">59 minutes ago</div>
                    <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">Tomny </a>.</p>
                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit."</em></p>
                  </div>
                </div>
                <div class="time-item">
                  <div class="item-info">
                    <div class="text-muted">5 minutes ago</div>
                    <p><strong><a href="#" class="text-info">Tomny </a></strong>Uploaded 2 new photos</p>
                  </div>
                </div>
                <div class="time-item">
                  <div class="item-info">
                    <div class="text-muted">30 minutes ago</div>
                    <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit."</em></p>
                  </div>
                </div>
                <div class="time-item">
                  <div class="item-info">
                    <div class="text-muted">59 minutes ago</div>
                    <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">Tomny </a>.</p>
                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit."</em></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="tab-pane" id="sidebar-setting">
          <h3 class="m-l-15">Settings</h3>
          <table class="table">
            <tbody><tr>
              <td>
                <h5>Alerts</h5>
                <p>Sets alerts to get notified when changes occur to get new alerming items</p>
              </td>
              <td><div class="toggle toggle-primary"></div></td>
            </tr>
            <tr>
              <td>
                <h5>Notifications</h5>
                <p>You will receive notification email for any notifications if you set notification</p>
              </td>
              <td><div class="toggle toggle-warning"></div></td>
            </tr>
            <tr>
              <td>
                <h5>Messages</h5>
                <p>You will receive notification on email after setting messages notifications</p>
              </td>
              <td><div class="toggle toggle-success"></div></td>
            </tr>
            <tr>
              <td>
                <h5>Warnings</h5>
                <p>You will get warnning only some specific setttings or alert system</p>
              </td>
              <td>
                <div class="toggle toggle-danger"></div>
              </td>
            </tr>
            <tr>
              <td>
                <h5>Sidebar</h5>
                <p>You can hide/show use with sidebar collapsw settings</p>
              </td>
              <td><div class="toggle toggle-default"></div></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
	
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="assets/js/detect.js"></script>
  <script src="assets/js/fastclick.js"></script>
  <script src="assets/js/jquery.slimscroll.min.js"></script>
  <script src="assets/js/jquery.blockUI.js"></script>
  <script src="assets/js/waves.js"></script>
  <script src="assets/js/wow.min.js"></script>
  <script src="assets/js/jquery.nicescroll.min.js"></script>
  <script src="assets/js/jquery.scrollTo.min.js"></script>
  <script src="assets/js/hope.js"></script>
  <script src="assets/js/jquery.check-toggle.js"></script>
  <script src="assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
  <script src="assets/plugins/toggles/toggles.min.js"></script>
  <script src="assets/plugins/moment/moment.js"></script>
  <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
  <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>
  <script src="assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
  <script src="assets/plugins/flot-chart/jquery.flot.js"></script>
  <script src="assets/plugins/flot-chart/jquery.flot.time.js"></script>
  <script src="assets/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
  <script src="assets/plugins/flot-chart/jquery.flot.resize.js"></script>
  <script src="assets/plugins/flot-chart/jquery.flot.pie.js"></script>
  <script src="assets/plugins/flot-chart/jquery.flot.selection.js"></script>
  <script src="assets/plugins/flot-chart/jquery.flot.stack.js"></script>
  <script src="assets/plugins/flot-chart/jquery.flot.crosshair.js"></script>
  <script src="assets/js/jquery.todo.init.js"></script>
  <script src="assets/js/jquery.chat.init.js"></script>
  <script src="assets/js/jquery.dashboard.init.js"></script>
  <script>
    jQuery(document).ready(function($) {
      $('.counter').counterUp({
        delay: 200,
        time: 2000
      });
    });
  </script>
</body>

</html>