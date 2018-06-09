<?php	
	require_once('include/admin_header.php');
	require_once('../config.php');	
	require_once('admin_code/admin_session.php');
?>

    <div class="content-wrapper">
      <div class="content">
        <div class="container">
          <div id="content-header" class="clearfix">
            <div class="pull-left">
              <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active"><span>History</span></li>
              </ol>
              <h1>History</h1>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title"><!--<button class="btn btn-default add_btn" data-toggle="modal" data-target="#myModal">Add <i class="fa fa-plus"></i></button>--></h3></div>
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
					<div class="table_out">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
							<th>S/N</th>
                            <th>Project Id</th>
                            <th>Project Name</th>
                            <th>Type</th>
                            <th>Client</th>
                            <th>Translator</th>
                            <th>Date/Time</th>
                            <th>Runing Status</th>
                            <th>Paid Status</th>
                            <th>Rating</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php
						$select="select * from `pro_u_awarded` RIGHT OUTER JOIN `project` ON `pro_u_awarded`.`pro_id`=`project`.`id` where `pro_u_awarded`.`running_status` IN ('CM','CL')";
						$que=mysqli_query($con,$select);
						$count=0;
						while($res=mysqli_fetch_array($que)){
							$count++;
							$tra_id=$res['tra_id'];
							$cus_id=$res['cus_id'];
							
							$select_d="select * from `u_details` where `login_id`='$tra_id'";
							$que1=mysqli_query($con,$select_d);
							$res1=mysqli_fetch_array($que1);
							
							$select_c="select * from `u_details` where `login_id`='$cus_id'";
							$que2=mysqli_query($con,$select_c);
							$res2=mysqli_fetch_array($que2);
							
							echo"<tr>
							<td>$count</td>
                            <td>{$res['pro_id']}</td>
                            <td><a href='project-detail.php?pro_id={$res['pro_id']}'>{$res['project_name']}</a></td>
                            <td>{$res['pro_type']}</td>
                            <td><a href='clients-details.php?cus_id={$res2['login_id']}'>{$res2['f_name']}  {$res2['l_name']}</a></td>
                            <td><a href='translator-details.php?id={$res1['login_id']}'>{$res1['f_name']}  {$res1['l_name']}</a></td>
                            <td>{$res['complete_datetime']}</td>";
                            if($res['running_status']=='CL'){
								echo" <td>Cancelled</td>";
							}
							else{
								echo" <td>Completed</td>";
							}
                           if($res['pay_status']=='P'){
								echo" <td>Paid</td>";
							}
							else{
								echo" <td>Not Paid</td>";
							}
							$select_r="select * from `pro_review_rating` where `pro_id`={$res['pro_id']}";
							$sql=mysqli_query($con,$select_r);
							$result=mysqli_fetch_array($sql);
							$rating=$result['rating'];
							$review=$result['review'];
							$number = number_format ( $rating,1);
							$intpart = floor ( $number );
							$fraction = $number - $intpart;
							$unrated = 5 - round ( $number );
							echo "<td>";
							if ( $intpart <= 5 ) {
							for ( $i=0; $i<$intpart; $i++ )
								echo"<img id='".$res['pro_id']."' onclick='review(this.id)' src='assets/images/icon/star1.png' height='20px' width='20px'>";
							}
							if ( $fraction >= 0.8 ) {
								echo "<img id='".$res['pro_id']."' onclick='review(this.id)'  src='assets/images/icon/star1.png' height='20px' width='20px'>";
							}
							if ( $fraction >= 0.5 && $fraction<=0.7 ) {
								echo "<img id='".$res['pro_id']."' onclick='review(this.id)' src='assets/images/icon/half_star.png' height='20px' width='20px'>";
							}
							if ( $unrated > 0 ) {
								for ( $j=0; $j<$unrated; $j++ )
								echo "<img id='".$res['pro_id']."' onclick='review(this.id)' src='assets/images/icon/blank_star.png' height='20px' width='20px'>";
							}
							echo "($rating)";
							echo"</td>";
							if($res['status']=='A'){								  						
								echo" <td><a href='admin_code/update_status.php?his_id={$res['pro_id']}'><button style='background-color:red; color:white'>Deactive</button></a></td>";				  						
							} 							
							else							
							{								
								echo" <td><a href='admin_code/update_status.php?his_id={$res['pro_id']}'><button style='background-color:green; color:white'>Active</button></a></td>";
							} 
							
                       echo" </tr>";
						
						}
						?>
                      
                        </tbody>
                      </table>
					</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer">
        <div class="row">
          <div class="col-lg-6 text-left">
            Copyright &copy; 2016
          </div>
          <div class="col-lg-6 text-right">
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
  
  <style>
  .modal-body{text-align:center;}
  .modal-title{text-align: center; font-size: 20px;}
  .modal-body select{padding: 10px 15px; width: 100%; margin: 25px 0px; height:auto;}
  .modal-body input{padding: 10px 15px; width: 100%;}
  .modal-body button{margin: 25px 0px;}
  </style>
  
  <!--Modal_box-->

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reviews</h4>
        </div>
        <div class="modal-body">
			<p id="review"></p>
			
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
  <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
  <script>
    $(document).ready(function() {
      $('#datatable').dataTable();
    });
  </script>
  <script src="assets/js/jquery.check-toggle.js"></script>
  <script src="assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
  <script src="assets/plugins/toggles/toggles.min.js"></script>
  
  
    <script>
  
	function review(pro_id) {
	var pro_id=pro_id;
		$.ajax({
			url:'admin_code/pro_reviews.php',
			type: 'POST',
			data: 'pro_id='+pro_id,
			success: function(response){
				
				$('#review').html(response);
				 $('#myModal').modal('show');
			}
		});
		
	}
	
  </script>
</body>

</html>