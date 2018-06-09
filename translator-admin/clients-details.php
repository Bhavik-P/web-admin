<?php
	require_once('include/admin_header.php');
	require_once('admin_code/admin_session.php'); 
	require_once('../config.php');
?>

  <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">

  

  <link rel="stylesheet" href="demo/css/style.css">

  <link rel="stylesheet" href="demo/css/custom.css">



  <script src="assets/js/modernizr.min.js"></script>

  <!--[if lt IE 9]>

  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

  <![endif]-->

  




    <div class="content-wrapper">

      <div class="content">

        <div class="container">

          <div id="content-header" class="clearfix">

            <div class="pull-left">

              <ol class="breadcrumb">

                <li><a href="index.php">Home</a></li>

                <li><a href="#">Tables</a></li>

                <li class="active"><span>Client</span></li>

              </ol>

              <h1>Client Details</h1>

            </div>

          </div>

        </div>

		

		<div class="compny-profile"> 
		
	<?php
	
	$cus_id=$_REQUEST['cus_id'];
	$select="select * from `u_details` RIGHT OUTER JOIN `u_login`  ON  `u_details`.`login_id` = `u_login`.`id` RIGHT JOIN `country` ON `u_details`.`country_id` = `country`.`id` RIGHT JOIN `state` ON `u_details`.`state_id` = `state`.`id` RIGHT JOIN `city` ON `u_details`.`city_id` = `city`.`id` where `u_details`.`login_id`='$cus_id'";
	$que=mysqli_query($con,$select);
	$res=mysqli_fetch_array($que);
	?>	

    <!-- SUB Banner -->

    <div class="profile-bnr user-profile-bnr">

      <div class="container">

        <div class="pull-left">

          <?php echo  "<h2> ".$res['f_name']." ".$res['l_name']."</h2>";?>

        </div>
		<div class="media-left">

		  <div class="img-profile"> <img style="width:150px;" class="media-object" src="<?php echo '../upload/'.$res['pic']; ?>" alt=""> </div>

		</div>

      </div>

      

      <!-- Modal POPUP -->

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

          <div class="modal-content">

            <div class="container">

              <h6><a class="close" href="#." data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a> Send Message</h6>

              

              <!-- Forms -->

              <form action="#">

                <ul class="row">

                  <li class="col-xs-6">

                    <input type="text" placeholder="First Name ">

                  </li>

                  <li class="col-xs-6">

                    <input type="text" placeholder="Last Name">

                  </li>

                  <li class="col-xs-6">

                    <input type="text" placeholder="Country">

                  </li>

                  <li class="col-xs-6">

                    <input type="text" placeholder="Email">

                  </li>

                  <li class="col-xs-12">

                    <textarea placeholder="Your Message"></textarea>

                  </li>

                  <li class="col-xs-12">

                    <button class="btn btn-primary">Send message</button>

                  </li>

                </ul>

              </form>

            </div>

          </div>

        </div>

      </div>

    </div>

    

    <!-- Profile Company Content -->

    <div class="profile-company-content user-profile main-user" data-bg-color="f5f5f5">

      <div class="container">

        <div class="row"> 

          

          <!-- Nav Tabs -->

          <div class="col-md-12">

            <ul class="nav nav-tabs">

              <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>

              <li><a data-toggle="tab" href="#jobs">Jobs</a></li>

            </ul>

          </div>

          

          <!-- Tab Content -->

          <div class="col-md-12">

            <div class="tab-content"> 

              

              <!-- PROFILE -->

              <div id="profile" class="tab-pane fade in active">

                <div class="row">

                  <div class="col-md-8">

                    <div class="profile-main">

                      <h3>About</h3>

                      <div class="profile-in">

                        <div class="media-body">

                          <p><?php echo $res['about_us'];?></p>

                        </div>

                      </div>

                    </div>

                  </div>

                <!--  <div class="col-md-8"> 

                    

                    <!-- Skills -->

                    <!--<div class="sidebar">

                      <h5 class="main-title">Skills</h5>

                      <div class="job-skills"> 

                        

                        <!-- Logo Design -->

                       <!-- <ul class="row">

                          <li class="col-sm-3">

                            <h6><i class="fa fa-plus"></i> HTML5 and Css3</h6>

                          </li>

                          <li class="col-sm-9">

                            <div class="progress">

                              <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"> </div>

                            </div>

                          </li>

                        </ul>

                        

                        <!-- Logo Design -->

                        <!--<ul class="row">

                          <li class="col-sm-3">

                            <h6><i class="fa fa-plus"></i> Logo Design</h6>

                          </li>

                          <li class="col-sm-9">

                            <div class="progress">

                              <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"> </div>

                            </div>

                          </li>

                        </ul>

                        

                        <!-- Logo Design -->

                       <!-- <ul class="row">

                          <li class="col-sm-3">

                            <h6><i class="fa fa-plus"></i> Web Design</h6>

                          </li>

                          <li class="col-sm-9">

                            <div class="progress">

                              <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"> </div>

                            </div>

                          </li>

                        </ul>

                        

                        <!-- UI / UX -->

                       <!-- <ul class="row">

                          <li class="col-sm-3">

                            <h6><i class="fa fa-plus"></i> UI/UX</h6>

                          </li>

                          <li class="col-sm-9">

                            <div class="progress">

                              <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"> </div>

                            </div>

                            <p>Preferred languages are Arabic, French & Italian. Proin nibh augue, suscipit asce lerisque sed, lacinia in, mi.</p>

                          </li>

                        </ul>

                      </div>

                    </div>

                  </div>-->

                  

                  <!-- Col -->

                  <div class="col-md-4"> 

                    

                    <!-- Professional Details -->

                    <div class="sidebar">

                      <h5 class="main-title">Professional Details</h5>

                      <div class="sidebar-information">

                        <ul class="single-category">

                          <li class="row">

                            <h6 class="title col-xs-6">Name</h6>

                            <span class="subtitle col-xs-6"><?php echo $res['f_name']." ".$res['l_name']; ?></span></li>

                        <!--  <li class="row">

                            <h6 class="title col-xs-6">Age</h6>

                            <span class="subtitle col-xs-6">38 Years Old</span></li>-->

                          <li class="row">

                            <h6 class="title col-xs-6">Location</h6>

                            <span class="subtitle col-xs-6"><?php echo $res['address'].",".$res['city_name'].",".$res['state_name'].",".$res['country_name'] ;?></span></li>

                        <!--  <li class="row">

                            <h6 class="title col-xs-6">Experiance</h6>

                            <span class="subtitle col-xs-6">15 Years</span></li>-->

                          <li class="row">

                            <h6 class="title col-xs-6">Degree</h6>

                            <span class="subtitle col-xs-6"><?php echo $res['education'];?></span></li>

                        <!--  <li class="row">

                            <h6 class="title col-xs-6">Career Level</h6>

                            <span class="subtitle col-xs-6">Mid-Level</span></li>

                          <li class="row">

                            <h6 class="title col-xs-6">Phone</h6>

                            <span class="subtitle col-xs-6">(800) 123-4567</span></li>

                          <li class="row">

                            <h6 class="title col-xs-6">Fax </h6>

                            <span class="subtitle col-xs-6">(800) 123-4568</span></li>-->

                          <li class="row">

                            <h6 class="title col-xs-6">E-mail</h6>

                            <span class="subtitle col-xs-6"><a href="#."><?php echo $res['email_id'];?></a></span></li>

                        <!--  <li class="row">

                            <h6 class="title col-xs-6">Website</h6>

                            <span class="subtitle col-xs-6"><a href="#.">example.com </a></span></li>-->

                        </ul>

                      </div>

                    </div>

					

                  </div>

                </div>

              </div>

              

              <!-- Jobs -->

            <div id="jobs" class="tab-pane fade">

           

                <div class="listing listing-1">

                  <div class="listing-section">
				  <?php  
					
					$select_pro="select *,`project`.`id` AS `pro_id` from `u_details` RIGHT JOIN `project` ON `u_details`.`login_id`=`project`.`cus_id` RIGHT JOIN `pro_review_rating` ON `project`.`id`=`pro_review_rating`.`pro_id` where `u_details`.`login_id`='$cus_id' AND `project`.`running_status`='CM' OR 'CL'";
					$query=mysqli_query($con,$select_pro);
					while($res3=mysqli_fetch_array($query)){
						$project_id=$res3['pro_id'];
						$rating=$res3['rating'];
						$number = number_format ( $rating,1);
						$intpart = floor ( $number );
						$fraction = $number - $intpart;
						$unrated = 5 - round ( $number );
						$pro_type=$res3['project_type'];
					if($pro_type=='DOC'){
						
						$p_type="Documentary Conversion";
					}
					elseif($pro_type=='LIV'){
						$p_type="Call Conversion";
					}
					
					if($res3['running_status']=='CM'){
						
						$status="Completed";
					}
					elseif($res3['running_status']=='CL'){
						$status="Cancelled";
						
					}
						$main_lang=$res3['main_lang'];
						$con_lang=$res3['conversion_lang'];
						
						$select_l1=mysqli_query($con,"select * from `m_language` where `id`='$main_lang'");
						$res_l1=mysqli_fetch_array($select_l1);
						
						$select_l2=mysqli_query($con,"select * from `m_language` where `id`='$con_lang'");
						$res_l2=mysqli_fetch_array($select_l2);
						
						$coun_id=$res3['country_id'];
						$state_id=$res3['state_id'];
						$city_id=$res3['city_id'];
						
												
						$que1="Select * from `city` where id='$city_id'";
						$sql1=mysqli_query($con,$que1);
						$res4=mysqli_fetch_array($sql1);
						$city_name=$res4['city_name'];
													
						$que2="Select * from `state` where `id`='$state_id'";
						$sql2 = mysqli_query($con,$que2);
						$res1=mysqli_fetch_array($sql2);
						$s_name=$res1['state_name'];

						$que3="Select * from `country` where `id`='$coun_id'";
						$sql3 = mysqli_query($con,$que3);
						$res2=mysqli_fetch_array($sql3);
						$c_name=$res2['country_name'];
						
				  ?>

                    <div class="listing-ver-3">

                      <div class="listing-heading">

                        <h5><?php echo $res3['project_name']; ?></h5>

                        <ul class="bookmark list-inline">

                          <li><a href="project-detail.php?pro_id=<?php echo $project_id; ?>"><b>View</b><i class="fa fa-eye"></i></a></li>

                        </ul>

                      </div>

                      <div class="listing-inner">

                        <div class="listing-content">

						<div class="row">

							<div class="col-sm-9 col-md-9">

							  <h6 class="title-company"></h6>

							  <span class="location"> <i class="fa fa-map-marker"></i> <?php echo $city_name.",".$s_name.",".$c_name ?></span> <span class="type-work full-time"><?php echo $p_type; ?> </span><br/><span class="location"><?php $res3['complete_time']; ?></span>

							</div> 

							<div class="col-sm-3 col-md-3"> <h5> <?php echo $status; ?></h5> <!--<button data-toggle="modal" data-target="#myModal2" class="btn btn-primary rate_btn"> Rate </button>--> </div>

						</div> 

                           <?php
							if (strlen($res3['project_desc']) > 300) {
							?>
							<p id="read_less"> <?php echo  substr($res3['project_desc'], 0, 300); ?> 
							<a id="<?php echo $project_id; ?>" class="read_more">...Read More</a> </p>
							<p id="read_full"></p>
							<?php }else{ ?>
								<p> <?php echo $res3['project_desc'];?> </p>
							<?php } ?>

						  <div class="stars"> <?php 
							if ( $intpart <= 5 ) {
								for ( $i=0; $i<$intpart; $i++ )
								echo '<img src="assets/images/icon/star1.png" height="20px" width="20px"/>';
							}
							if ( $fraction >= 0.8 ) {
								echo '<img src="assets/images/icon/star1.png" height="20px" width="20px" />';
							}
							if ( $fraction >= 0.5 && $fraction<=0.7 ) {
								echo '<img src="assets/images/icon/half_star.png" height="20px" width="20px" />';
							}
							if ( $unrated > 0 ) {
								for ( $j=0; $j<$unrated; $j++ )
								echo '<img src="assets/images/icon/blank_star.png" height="20px" width="20px" />';
							}
							?><span> <b id='<?php echo $project_id; ?>' onclick='review(this.id)'><?php echo $rating; ?></b> </span> </div>

                          <h6 class="title-tags">Language required:</h6>

                          <ul class="tags list-inline">

                           <li><a href="#"><?php echo $res_l1['language']; ?></a></li>
                            <li><a href="#"><?php echo $res_l2['language']; ?></a></li>

                          </ul>

                        </div>

                      </div>

                    </div>

                   
					<?php } ?>

                  </div>

                </div>

            </div>

            </div><!---->

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

          <h4 class="modal-title">Add Country</h4>

        </div>

        <div class="modal-body">

			<input type="text" placeholder="Country Name">

			<button type="submit" class="btn btn-default" data-dismiss="modal"> Submit </button>

        </div>

      </div>

      

    </div>

  </div>

  

  

  <div class="modal fade" id="myModal1" role="dialog">

    <div class="modal-dialog">

    

      <!-- Modal content-->

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal">&times;</button>

				<h4 class="modal-title">Reviews </h4>

				<span></span>

			</div>

			<div class="modal-body">

				
				<div class="rating_box">
					<p id="review"></p>
				</div>
				
			</div>

			<!--<div class="modal-footer">

				<button type="submit" class="btn btn-primary" data-dismiss="modal"> Submit </button>

			</div>-->

		</div>

      

    </div>

</div>



<div class="modal fade" id="myModal2" role="dialog">

    <div class="modal-dialog">

    

      <!-- Modal content-->

		<div class="modal-content">

			<div class="modal-header">

				<button type="button" class="close" data-dismiss="modal">&times;</button>

				<h4 class="modal-title">Review & Rating</h4>

				<span></span>

			</div>

			<div class="modal-body">

				<div class="rating_box">

					<h2> Ratings : </h2>

					<div class="stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i><input type="number"> </div>

					<h2> Reviews : </h2>

					<input type="text">

				</div>

			</div>

			<div class="modal-footer">

				<button type="submit" class="btn btn-primary" data-dismiss="modal"> Submit </button>

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
	$('.read_more').click(function(){
	
		var pro_id =$(this).attr('id');
		
		$.ajax({
			type: "POST",
			url: "admin_code/read_more.php",
			data:"pro_id="+pro_id,
			cache: false,
			success: function(html)
			{	
				
				
				$('#read_full').html(html);
				$('#read_full').show();
				$('#read_less').hide();
				
			} 
		});
	});
  </script>
  
   <script>
  
	function review(pro_id) {
	var pro_id=pro_id;
		$.ajax({
			url:'admin_code/pro_reviews.php',
			type: 'POST',
			data: 'pro_id='+pro_id,
			success: function(response){
				
				$('#review').html(response);
				 $('#myModal1').modal('show');
			}
		});
		
	}
	
  </script>

</body>



</html>