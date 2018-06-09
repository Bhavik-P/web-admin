<?php	require_once('include/admin_header.php');	require_once('admin_code/admin_session.php'); 	require_once('../config.php');?>
  <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">
  
	<link rel="stylesheet" href="assets/css/custom.css">
	<link rel="stylesheet" href="demo/css/custom.css">

  <script src="assets/js/modernizr.min.js"></script>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
	<?php	 
	$pro_id=$_REQUEST['pro_id'];	 
	$select="select * from `project` where `id`='$pro_id'";	  
	$que=mysqli_query($con,$select);	  
	$result=mysqli_fetch_array($que);	 
	$cus_id=$result['cus_id'];	
	if($result['running_status']=='O'){		
	$status='Open';	
	}	 
	elseif($result['running_status']=='A'){	
	$status='Awarded';	  
	}	  
	elseif($result['running_status']=='W'){		
	$status='Working';	
	}	   
	elseif($result['running_status']=='CM'){	
	$status='Completed';	
	}	  
	else{	
	$status='Cancelled';	
	}	  	
	?>
    <div class="content-wrapper">
      <div class="content">
        <div class="container">
          <div id="content-header" class="clearfix">
            <div class="pull-left">
              <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active"><span>Projects</span></li>
              </ol>
              <h1>Projects Detail</h1>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="profile-bnr sub-bnr user-profile-bnr">
				<div class="position-center-center">
				  <div class="container">
					<section class="section">
						<h2><?php echo $result['project_name'];?></h2>					
						<p><?php echo $result['datetime'];?> </p>
					</section>
					<section class="sec_right">
						<h5> <?php echo $status;?> </h5>
					</section>
				  </div>
				</div>
			  </div></br>
			  <section class="demo-section">
				  <div class="container less_pad">
					<div class="project_detail">
						<div class="row">
							<div class="col-md-9">
								<div class="detail_left">
									<h2> Project Description </h2>
									<?php
									if (strlen($result['project_desc']) > 300) {
									?>
									<p id="read_less"> <?php echo  substr($result['project_desc'], 0, 300); ?> 
									<a id="<?php echo $pro_id; ?>" class="read_more">...Read More</a> </p>
									<p id="read_full"></p>
									<?php }else{ ?>
										<p> <?php echo $result['project_desc'];?> </p>
									<?php } ?>
									<br/>									
									<?php										
									$select_a="select * from `u_details` where `login_id`='$cus_id'";										
									$que_a=mysqli_query($con,$select_a);							
									$res4=mysqli_fetch_array($que_a);								
									$coun_id=$res4['country_id'];								
									$state_id=$res4['state_id'];									
									$city_id=$res4['city_id'];
									$main_lang=$result['main_lang'];
									$con_lang=$result['conversion_lang'];																														$select_l1=mysqli_query($con,"select * from `m_language` where `id`='$main_lang'");
									$res_l1=mysqli_fetch_array($select_l1);
									
									$select_l2=mysqli_query($con,"select * from `m_language` where `id`='$con_lang'");
									$res_l2=mysqli_fetch_array($select_l2);		
									//echo $res_l1['language'];
									
									$que1="Select * from `city` where id='$city_id'";										$sql1=mysqli_query($con,$que1);									
									$res=mysqli_fetch_array($sql1);									
									$city_name=$res['city_name'];																						$que2="Select * from `state` where `id`='$state_id'";										
									$sql2 = mysqli_query($con,$que2);						
									$res1=mysqli_fetch_array($sql2);						
									$s_name=$res1['state_name'];								
									$que3="Select * from `country` where `id`='$coun_id'";								$sql3 = mysqli_query($con,$que3);										
									$res2=mysqli_fetch_array($sql3);									
									$c_name=$res2['country_name'];										
									?>			
									<h2> About the Employer </h2>
									<h4><?php echo $res4['f_name']." ".$res4['l_name']; ?></h4>
									<h5><?php echo $res4['address'] .",".$city_name.",".$s_name.",".$c_name; ?></h5>
									<div class="varified_area">									
									<?php if($res4['email_verification']=='1'){ ?>					
									<ul>										
									<li> <span> Verified </span> </li>							
									<li> <i class="fa fa-envelope-o" aria-hidden="true"></i> </li>															
									</ul>								
									<?php }else{ ?>									
									<ul>										
									<li> <span style="background-color:grey"> Not Verified </span> </li>					<li> <i style="background-color:grey" class="fa fa-envelope-o" aria-hidden="true"></i> </li>															
									</ul>								
									<?php } ?>
									</div>
									<br/>
									<div class="skills">
										<h2> Languages required: </h2>
										  <ul class="tags list-inline">
											<li><a href="#"><?php echo $res_l1['language']; ?></a></li><li><a href="#"><?php echo  $res_l2['language']; ?></a></li>
										  </ul>
									</div>								
									<?php if($result['project_type']=='DOC'){ 										$select_t=mysqli_query($con,"select * from `pro_doc_details` where `pro_id`='$pro_id'");										
									$res5=mysqli_fetch_array($select_t);				
									?>									
									<h4> Download Document <br/> <a href="download_doc.php?doc=<?php echo $res5['document'];?>"><button class="btn btn-primary"> Download </button></a> </h4>
									<?php }elseif($result['project_type']=='LIV'){ } ?>
								</div>
							</div>
							<div class="col-md-3">							
							<?php														
							$select_pro="select * from `project` where `id`='$pro_id'";			
							$query=mysqli_query($con,$select_pro);							
							if(mysqli_num_rows($query)==1){																			
							?>
								<div class="invited_translator">
									<h2> Invited Translator </h2>
									<section class="sec_div">
									<?php								
									$select_t="SELECT * FROM  `pro_u_invite` RIGHT JOIN  `u_details` ON  `pro_u_invite`.`tra_id` =  `u_details`.`login_id` AND  `pro_u_invite`.`pro_id` = '$pro_id' RIGHT JOIN  `u_login` ON  `u_login`.`id` =  `u_details`.`login_id` WHERE `u_login`.`type` ='TR' AND `u_login`.`admin_status`='A' AND `pro_u_invite`.`tra_id` IS NOT NULL";									
									$que=mysqli_query($con,$select_t);	
									if(mysqli_num_rows($que)>0){									
										while($res=mysqli_fetch_array($que)){																	
										if($res['accepted_status']=='AC'){										
										$status='Accepted';									
										}									
										elseif($res['accepted_status']=='DE'){				
										$status='Declined';							
										}										
										elseif($res['accepted_status']==''){	
										$status='Invited';							
										}	
										?>									
										<div class='row bottom_border'>								
										<div class='col-sm-2 col-md-2 pad_box step1'> <img src='<?php echo '../upload/'.$res['pic'];?>'> </div>										
										<div class='col-sm-6 col-md-6 pad_box step2'> <p><?php echo"{$res['f_name']}  {$res['l_name']}"; ?></p> </div>											
										<div class='col-sm-4 col-md-4 pad_box step3'> <h5><?php echo "$status"; ?> </h5> </div>										
										</div>
										<?php
										}
									}
									else{
										echo "No invited translator";
									}									
									?>
									</section>
									<ul>
										<li> <button data-toggle="modal" data-target="#myModal1">View Pings</button> </li>
									</ul>								
									<?php 								
									}									
									?>
								</div>
							</div>
						</div>
					</div>					
					<?php if($result['running_status']=='O'){
			
					}
		
		
					else{ 					
					$select_p="SELECT * FROM  `pro_u_awarded` RIGHT OUTER JOIN  `u_details` ON  `pro_u_awarded`.`tra_id` =  `u_details`.`login_id` WHERE  `pro_u_awarded`.`pro_id` ='$pro_id'";				
					$sql=mysqli_query($con,$select_p);					
					$res7=mysqli_fetch_array($sql);					
					$a_id=$res7['id'];									
					if($res7['pay_status']=='P'){						
						$p_status='Paid';									
					}					
					else{					
						$p_status='Not Paid';				
					}						
					?>
				  <div class="trans_name">
					  <div class="container">
						  <div class="row">
							  <div class="col-sm-6 col-md-6">
								  <div class="row">
									  <div class="col-sm-3 col-md-3 img_tt"> <img src="<?php echo '../upload/'.$res7['pic'];?>"> </div>
									  <div class="col-sm-9 col-md-9">
										<h2> <?php echo $res7['f_name']." ".$res['l_name']; ?> <br/> <span><?php echo $res['datetime']; ?></span> </h2>
									  </div>
								  </div>
							  </div>
							  <div class="col-sm-6 col-md-6 pay_box"> <h3> Pay Status <span><?php echo $p_status; ?></span> </h3> </div>
						  </div>
					  </div>
					  <div class="heading_div"> 
						  <h2> Working Details: </h2> 
						  <?php if($res7['pro_type']=='DOC'){ 										?>			  							  <table class="table table-inverse">							  <thead>								<tr>								  <th>Document Name</th>								  <th>Download Document</th>								  <th>Date / Time</th>								</tr>							  </thead>							  <tbody>							  <?php								$select_doc="SELECT * FROM  `pro_u_awarded` RIGHT OUTER JOIN  `pro_doc_submitted` ON  `pro_u_awarded`.`id` =  `pro_doc_submitted`.`awarded_id` WHERE  `pro_u_awarded`.`pro_id` = '$pro_id'";								$sql5=mysqli_query($con,$select_doc);								while($res6=mysqli_fetch_array($sql5)){							  ?>								<tr>								  <td><?php echo $res6['doc_name']; ?></td>								  <td><a href="download_doc.php?doc=<?php echo $res6['document'];?>"><?php echo $res6['document']; ?></a></td>								  <td><?php echo $res6['datetime']; ?></td>								</tr>								<?php } ?>							  </tbody>							</table>							<?php }else{ ?>
						
						  <table class="table table-inverse">
						  <thead>
							<tr>
							  <th>From Time</th>
							  <th>To Time</th>
							  <th>Calling Time Duration</th>
							  <th>Date / Time</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td>2:15 pm</td>
							  <td>2:25 pm</td>
							  <td>10 min</td>
							  <td>5 Mar 2017, 2:00 pm</td>
							</tr>
							<tr>
							  <td>1:35 pm</td>
							  <td>1:37 pm</td>
							  <td>2 min</td>
							  <td>5 Mar 2017, 2:00 pm</td>
							</tr>
						  </tbody>
						</table>						<?php } ?>
					   </div>
				  </div>
				  <?php } ?>
				  </div>
			  </section>
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
				<h4 class="modal-title">Pings</h4>			
				<span></span>			
			  </div>			
			  <div class="modal-body">				
				  <div class="invite_div">									
					  <?php					
					  $select_p="select * from `pro_u_invite` where `pro_id`='$pro_id' AND `ping_status`='1'";				
					  $que=mysqli_query($con,$select_p);	
					if(mysqli_num_rows($que)>0){
					  while($res=mysqli_fetch_array($que)){				
					  $tra_id=$res['tra_id'];						
					  $select_que="select * from `u_details` where `login_id`='$tra_id'";					
					  $sql=mysqli_query($con,$select_que);	
					
					  $val=mysqli_fetch_array($sql);						
					  ?>						
					  <div class='row'>				
						  <div class='col-xs-2 col-sm-2 col-md-2 pad_box'>
							<div class="pic_outer"><img src='<?php echo '../upload/'.$val['pic'];?>'></div> 
						  </div>						
						  <div class='col-xs-10 col-sm-4 col-md-4 pad_box'>
							<p> <?php echo $val['f_name']." ".$val['l_name']; ?></p> 
						  </div>									
					  </div>											
					  <?php }	
						}
						else{
							echo "No pings by any translator";
						}
					  ?>									
				  </div>			
			  </div>			
			  <!--<div class="modal-footer">			
			  <button type="submit" class="btn-primary" data-dismiss="modal"> Submit </button>		
			  </div>-->		
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
				$('#read_full').show();
				$('#read_full').html(html);
				$('#read_less').hide();
				
			} 
		});
	});
  </script>
</body>

</html>