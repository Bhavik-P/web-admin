<?php
require_once ("../config.php");
if(isset($_REQUEST['method'])=='method'){
	$method=$_REQUEST['method'];
	
	if($method=='all_country'){
		
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
	
			$select="select * from `country` where `status`='1'";
			$que= mysqli_query($con,$select);
			if(mysqli_num_rows($que)>0){
				while($result=mysqli_fetch_array($que)){
					$co_id=$result['id'];
					$co_name=$result['country_name'];
					$data[]=array('country_id'=>$co_id,'country_name'=>$co_name);
				
				}
				$json = array("result" => "success", "response" => $data ,"message"=>"");
				echo json_encode($json);
			}
			else{
				$json = array("result" => "error", "response" =>"","message"=>"no data available");
				echo json_encode($json);
			}

		
	}
	if($method=='all_state'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
	
			$co_id1=isset($_REQUEST['co_id']) ? mysqli_real_escape_string($con,$_REQUEST['co_id']) : "";
			$co_id=str_replace('%20', ' ',$co_id1);
			if($co_id==''){
				$json = array("result" => "error", "response" =>"All parameters are compulsary" , "message"=>"");
				echo json_encode($json);
			}
			else{
				$select="select * from `state` where `country_id`='$co_id' AND `status`='1'";
				$que= mysqli_query($con,$select);
				if(mysqli_num_rows($que)>0){
					while($result=mysqli_fetch_array($que)){
						$s_id=$result['id'];
						$s_name=$result['state_name'];
						$data[]=array('state_id'=>$s_id,'state_name'=>$s_name);
					
					}
					$json = array("result" => "success", "response" =>$data,"message"=>"");
					echo json_encode($json);
				}
				else{
					$json = array("result" => "error", "response" =>"" , "message"=>"no data available");
					echo json_encode($json);
				}
			}
		
		
	}
	if($method=='all_city'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
	
			$state_id1=isset($_REQUEST['s_id']) ? mysqli_real_escape_string($con,$_REQUEST['s_id']) : "";
			$state_id=str_replace('%20', ' ',$state_id1);

			if($state_id==''){
				$json = array("result" => "error", "response" =>"All parameters are compulsary" , "message"=>"");
				echo json_encode($json);
			}
			else{
				$select="select * from `city` where `state_id`='$state_id' AND `status`='1'";
				$que= mysqli_query($con,$select);
				if(mysqli_num_rows($que)>0){
					while($result=mysqli_fetch_array($que)){
						$city_id=$result['id'];
						$city_name=$result['city_name'];
						$data[]=array('city_id'=>$city_id,'city_name'=>$city_name);
					
					}
					$json = array("result" => "success", "response" => $data , "message"=>"");
					echo json_encode($json);
				}
				else{
					$json = array("result" => "error", "response" =>"" , "message"=>"no data available");
					echo json_encode($json);
				}
			}

		
		
	}
	if($method=='all_language'){
			
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
			
			$select="select * from `m_language` where `status`='A'";
			$que= mysqli_query($con,$select);
			if(mysqli_num_rows($que)>0){
				while($result=mysqli_fetch_array($que)){
					$l_id=$result['id'];
					$l_name=$result['language'];
					$data[]=array('language_id'=>$l_id,'language_name'=>$l_name);
				
				}
				$json = array("result" => "success", "response" => $data , "message"=>"");
				echo json_encode($json);
			}
			else{
				$json = array("result" => "error", "response" =>"" , "message"=>"no data available");
				echo json_encode($json);
			}

		
	}
	if($method=='all_rate'){
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
		
		$select="select * from `m_rate` where `status`='A'";
		$que= mysqli_query($con,$select);
		if(mysqli_num_rows($que)>0){
			while($result=mysqli_fetch_array($que)){
				$r_id=$result['id'];
				$rate=$result['rate'];
				$type=$result['type'];
				$data[]=array('rate_id'=>$r_id,'rate'=>$rate,"type"=>$type);
			
			}
			$json = array("result" => "success", "response" => $data , "message"=>"");
			echo json_encode($json);
		}
		else{
			$json = array("result" => "error", "response" =>"" , "message"=>"no data available");
			echo json_encode($json);
		}
		
	}
	if($method=='c_history_pro'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
	
			$cus_id1=isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "";	
			$cus_id= str_replace('%20', ' ',$cus_id1);
			if($cus_id==''){
				$json = array("result" => "error", "response" =>"All parameters are compulsary" , "message"=>"");
				echo json_encode($json);
			}
			else{	
			
				$select1="select * from `u_login` where `id`='$cus_id'";
				$que1=mysqli_query($con,$select1);
				if(mysqli_num_rows($que1)>0){
				
					$select_c="select * from `u_details` where `login_id`='$cus_id'";
					$sql=mysqli_query($con,$select_c);
					$res=mysqli_fetch_array($sql);
					$cus_fname=$res['f_name'];
					$cus_lname=$res['l_name'];
					$arr[]=array("cus_fname"=>$cus_fname,"cus_lname"=>$cus_lname);
					
					$select_pro="select * from `project` where `cus_id`='$cus_id'  AND `running_status` IN ('CL','CM') ORDER BY `id` DESC";
					$que=mysqli_query($con,$select_pro);
					if(mysqli_num_rows($que)>0){
						while($result=mysqli_fetch_array($que)){
							$pro_id=$result['id'];
							$pro_type=$result['project_type'];
							$pro_name=$result['project_name'];
							$r_status=$result['running_status'];
							$datetime=$result['datetime'];
							
							$select_pro1="select * from `pro_u_awarded` where `pro_id`='$pro_id'";
							$que1=mysqli_query($con,$select_pro1);
							$result1=mysqli_fetch_array($que1);
							$tra_id=$result1['tra_id'];
							
							$select_t="select * from `u_details` where `login_id`='$tra_id'";
							$sql1=mysqli_query($con,$select_t);
							$res1=mysqli_fetch_array($sql1);
							$t_fname=$res1['f_name'];
							$t_lname=$res1['l_name'];
							
							$select="select * from `pro_review_rating` where `pro_id`='$pro_id' AND `cus_id`='$cus_id' AND `status`='A'";
							$sql=mysqli_query($con,$select);
							if(mysqli_num_rows($sql)>0){
								$res5=mysqli_fetch_array($sql);
								$rating=$res5['rating'];
								$review=$res5['review'];
							}
							else{
								$rating="no rating available";
								$review="no review available";
							} 
							
							$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"running_status"=>$r_status,"date&time"=>$datetime,"project_type"=>$pro_type,"rating"=>$rating,"review"=>$review,"t_fname"=>$t_fname,"t_lname"=>$t_lname,"client_details"=>$arr);
							
						}
						$json = array("result" => "success", "response" =>$array , "message"=>"");
						echo json_encode($json);
					}
					else{
						$json = array("result" => "error", "response"=>array("client_details" =>$arr),"message"=>"no data available");
						echo json_encode($json);
					}
				}
				else{
					$json = array("result" => "error", "response" =>"" , "message"=>"no data available");
					echo json_encode($json);
				}
			}
		
				
	}
	if($method=='c_invite_translator'){
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
			
			$date=date("Y-m-d H:i:s");
			$pro_id1=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
			$pro_id= str_replace('%20', ' ',$pro_id1);
			$tra_id1=isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "";
			$tra_id= str_replace('%20', ' ',$tra_id1);
			
			if(!isset($_REQUEST['pro_id'],$_REQUEST['tra_id'])){
				$json = array("result" => "error", "response" =>"All parameters are compulsary" , "message"=>"");
				echo json_encode($json);
			}
			else{
				$select="select * from `pro_u_invite` where `pro_id`='$pro_id' AND `tra_id`='$tra_id'";
				$que=mysqli_query($con,$select);
				if(mysqli_num_rows($que)>0){
					
					$json = array("result" => "error", "response" =>"" ,"message"=>"already exist!");
					echo json_encode($json);

				}
				else{
					$insert="insert into `pro_u_invite` (`pro_id`,`tra_id`,`invite_status`,`ping_status`,`accepted_status`,`datetime`)values('$pro_id','$tra_id','1','0','','$date')";
					$sql=mysqli_query($con,$insert);
					if($sql){
						
						$array[]=array("translator_id"=>$tra_id);
						$json = array("result" => "success", "response" =>$array ,"message"=>"translator invited successfully");
						echo json_encode($json);
						
					}
					else{
						$json = array("result" => "error", "response" =>"" ,"message"=>"error");
						echo json_encode($json);
					}
					
				}
			}
		
	}
	if($method=='c_invite_translator_list'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
		
			$pro_id1=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
			$pro_id= str_replace('%20', ' ',$pro_id1);
			if($pro_id==''){
				$json = array("result" => "error", "response" =>"All parameters are compulsary" ,"message"=>"");
				echo json_encode($json);
			}
			else{
			
				$select_t="SELECT * FROM  `pro_u_invite` RIGHT JOIN  `u_details` ON  `pro_u_invite`.`tra_id` =  `u_details`.`login_id` AND  `pro_u_invite`.`pro_id` = '$pro_id' RIGHT JOIN  `u_login` ON  `u_login`.`id` =  `u_details`.`login_id` WHERE `u_login`.`type` ='TR' AND `u_login`.`admin_status`='A' AND `pro_u_invite`.`tra_id` IS NULL";
				$sql=mysqli_query($con,$select_t);
				if(mysqli_num_rows($sql)>0){
					while($res1=mysqli_fetch_array($sql)){
						$fname=$res1['f_name'];
						$lname=$res1['l_name'];
						$log_id=$res1['login_id'];
						$pic=$res1['pic'];
						$avg_rating=$res1['avg_rating'];
						
						$array[]=array("translator_fname"=>$fname,"translator_lname"=>$lname,"translator_id"=>$log_id,"pic"=>"http://5ivetechnology.com/projects/true-translator/upload/".$pic,"avg_rating"=>$avg_rating);
					}
					
					$json = array("result" => "success", "response" =>$array ,"message"=>"");
					echo json_encode($json);
				}
				else{
					$json = array("result" => "error", "response" =>"" ,"message"=>"no data available");
					echo json_encode($json);
				}
			}
		
		
	}
	if($method=='c_invited_translator_list'){
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
		
			$pro_id1=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
			$pro_id= str_replace('%20', ' ',$pro_id1);
			if($pro_id==''){
				$json = array("result" => "error", "response" =>"All parameters are compulsary" ,"message"=>"");
				echo json_encode($json);
			}else{
				$select="select * from `pro_u_invite` where `pro_id`='$pro_id' AND `invite_status`='1'";
				$que=mysqli_query($con,$select);
				if(mysqli_num_rows($que)>0){
					while($res=mysqli_fetch_array($que)){
						$tra_id=$res['tra_id'];
						$a_status=$res['accepted_status'];
						
						$select_p="select * from `project` where `id`='$pro_id'";
						$que1=mysqli_query($con,$select_p);
						$res2=mysqli_fetch_array($que1);
						$r_status=$res2['running_status'];
						
						$select_t="select * from `u_details` where `login_id`='$tra_id'";
						$sql=mysqli_query($con,$select_t);
						$res1=mysqli_fetch_array($sql);
						$fname=$res1['f_name'];
						$lname=$res1['l_name'];
						$pic=$res1['pic'];
						$avg_rating=$res1['avg_rating'];
						
						if($a_status==''){
							$a1_status='no response';
						}
						else{
							$a1_status=$a_status;
						}
						
						
						$array[]=array("translator_id"=>$tra_id,"translator_fname"=>$fname,"translator_lname"=>$lname,"pic"=>"http://5ivetechnology.com/projects/true-translator/upload/".$pic,"avg_rating"=>$avg_rating,"accept_status"=>$a1_status,"running_status"=>$r_status);
					}
					$json = array("result" => "success", "response" =>$array ,"message"=>"");
					echo json_encode($json);
				}
				else{
					
					$json = array("result" => "error","response"=>" ","message" =>"no data available");
					echo json_encode($json);
					
				}
				
			}
		
		
	}
	if($method=='c_pinged_translator_list'){
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
		
			$pro_id1=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
			$pro_id= str_replace('%20', ' ',$pro_id1);
			if($pro_id==''){
				$json = array("result" => "error", "response" =>"All parameters are compulsary" ,"message"=>"");
				echo json_encode($json);
			}else{
				$select="select * from `pro_u_invite` where `pro_id`='$pro_id' AND `ping_status`='1'";
				$que=mysqli_query($con,$select);
				if(mysqli_num_rows($que)>0){
					while($res=mysqli_fetch_array($que)){
						$tra_id=$res['tra_id'];
						
						$select_p="select * from `project` where `id`='$pro_id'";
						$que1=mysqli_query($con,$select_p);
						$res2=mysqli_fetch_array($que1);
						$r_status=$res2['running_status'];
						
						$select_t="select * from `u_details` where `login_id`='$tra_id'";
						$sql=mysqli_query($con,$select_t);
						$res1=mysqli_fetch_array($sql);
						$fname=$res1['f_name'];
						$lname=$res1['l_name'];
						$pic=$res1['pic'];
						$avg_rating=$res1['avg_rating'];
						
						
						$array[]=array("translator_id"=>$tra_id,"translator_fname"=>$fname,"translator_lname"=>$lname,"pic"=>"http://5ivetechnology.com/projects/true-translator/upload/".$pic,"avg_rating"=>$avg_rating,"running_status"=>$r_status);
					}
					$json = array("result" => "success", "response" =>$array ,"message"=>"");
					echo json_encode($json);
				}
				else{
					$json = array("result" => "error", "response" =>"" ,"message"=>"no data available");
					echo json_encode($json);
				}
			}
		
	}
	if($method=='c_review_rating'){
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
			
			$pro_id=str_replace('%20', ' ',isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "");
			
			$review=str_replace('%20', ' ',isset($_REQUEST['review']) ? mysqli_real_escape_string($con,$_REQUEST['review']) : "");
			
			$rating=str_replace('%20', ' ', isset($_REQUEST['rating']) ? mysqli_real_escape_string($con,$_REQUEST['rating']) : "");
			
			if(!isset($_REQUEST['pro_id'],$_REQUEST['review'],$_REQUEST['rating'])){
				$json = array("result" => "error", "response" =>"All parameters are compulsary" ,"message"=>"");
				echo json_encode($json);
			}
			else{
				$select="select * from `project` where `id`='$pro_id' AND `status`='A'";
				$que=mysqli_query($con,$select);
				$result=mysqli_fetch_array($que);
				$cus_id=$result['cus_id'];
				
				
				$select_t="select * from `pro_u_awarded` where `pro_id`='$pro_id'";
				$que1=mysqli_query($con,$select_t);
				$res=mysqli_fetch_array($que1);
				$tra_id=$res['tra_id'];
				$r_status=$res['running_status'];
				if($r_status=='CM' or $r_status=='CL'){
					
					$insert="insert into `pro_review_rating` (`pro_id`,`tra_id`,`cus_id`,`review`,`rating`,`status`) values ('$pro_id','$tra_id','$cus_id','$review','$rating','A')";
					$sql=mysqli_query($con,$insert);
					if($sql){
						 $select_r="select AVG(rating) from `pro_review_rating` where `tra_id`='$tra_id'";
						 $sql1=mysqli_query($con,$select_r);
						 $res1=mysqli_fetch_array($sql1);
						 $avg_rating=$res1['AVG(rating)'];
						 
						 //echo $avg_rating;
						 
						 $update="update `u_details` SET `avg_rating`='$avg_rating' where `login_id`='$tra_id'";
						 $sql3=mysqli_query($con,$update);
						 
						
						$json = array("result" => "success", "response" =>"" ,"message"=>"success");
						echo json_encode($json);
					}
					else{
						$json = array("result" => "error", "response" =>"" ,"message"=>"error");
						echo json_encode($json);
					}
				}
				else{
					$json = array("result" => "error", "response" =>"" ,"message"=>"project not completed or close");
					echo json_encode($json);
				}
			
			
			
			}
			
	}
	if($method=='c_translator_details'){
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
		
			$tra_id=str_replace('%20', ' ',isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "");
			
			if($tra_id==''){
				$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
				echo json_encode($json);
			}
			else{
				$select="select * from `u_login` where `id`='$tra_id'";
				$que=mysqli_query($con,$select);
				$res=mysqli_fetch_array($que);
				$t_email_id=$res['email_id'];
				
				$select_d="select * from `u_details` LEFT JOIN `country` ON `u_details`.`country_id`=`country`.`id` LEFT JOIN `state` ON `u_details`.`state_id`=`state`.`id` LEFT JOIN `city` ON `u_details`.`city_id`=`city`.`id` where `login_id`='$tra_id'";
				$que1=mysqli_query($con,$select_d);
				$res1=mysqli_fetch_array($que1);
				
				$fname=$res1['f_name'];
				$lname=$res1['l_name'];
				$pic=$res1['pic'];
				$about=$res1['about_us'];
				$education=$res1['education'];
				$ind=$res1['industry_spe'];
				$address=$res1['address'];
				$coun_id=$res1['country_id'];
				$state_id=$res1['state_id'];
				$city_id=$res1['city_id'];
				$c_name=$res1['country_name'];
				$s_name=$res1['state_name'];
				$city_name=$res1['city_name'];
				$avg_rating=$res1['avg_rating'];
				//$data1=($avg_rating);
				$pic_path="http://5ivetechnology.com/projects/true-translator/upload/".$pic;
				
				$select_p="select COUNT(pro_id) from `pro_u_awarded` where tra_id='$tra_id' AND `running_status`='CM'";
				$sql=mysqli_query($con,$select_p); 
				$res4=mysqli_fetch_array($sql);	
				$com_pro=$res4['COUNT(pro_id)'];
				//$data[]=array("completed_projects"=>$com_pro);
				
				$select_l="select * from `t_languages` where `tra_id`='$tra_id'";
				$que2=mysqli_query($con,$select_l);
				if(mysqli_num_rows($que2)>0){
					while($res2=mysqli_fetch_array($que2)){
						$lang_id=$res2['lang_id'];
						
						$select_ln="select GROUP_CONCAT(language) from `m_language` where `id`='$lang_id'";
						$que3=mysqli_query($con,$select_ln);
						//$array1=array();
						
						while($res3=mysqli_fetch_array($que3)){
							$lang=$res3['GROUP_CONCAT(language)'];
							$array1[]=array("lang_skill"=>$lang);
						}	
					}
				}
				else{
					$array1[]=array("lang_skill"=>"-");
				}
				
				$array[]=array("translator_fname"=>$fname,"translator_lname"=>$lname,"translator_email_id"=>$t_email_id,"pic"=>$pic,"about_us"=>$about,"pic_url"=>$pic_path,"education"=>$education,"address"=>$address,"country"=>$c_name,"state"=>$s_name,"city"=>$city_name,"coun_id"=>$coun_id,"state_id"=>$state_id,"city_id"=>$city_id,"industry"=>$ind,"complete_project"=>$com_pro,"rating"=>$avg_rating);
				
				$json = array("result" => "success", "response" =>array("translator_detail"=>$array,"Skills"=>$array1),"message"=>"");
				echo json_encode($json);
			}
		
	}
	if($method=='c_upcoming_pro'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
			
			$cus_id=str_replace('%20', ' ',isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "");	
			
			if($cus_id==''){
				$json = array("result" => "error", "response" =>"All parameters are compulsary" ,"message"=>"");
				echo json_encode($json);
			}
			else{
				
				$select="select * from `u_login` where `id`='$cus_id'";
				$que1=mysqli_query($con,$select);
				if(mysqli_num_rows($que1)>0){
					
					$select_c="select * from `u_details` where `login_id`='$cus_id'";
					$sql=mysqli_query($con,$select_c);
					$res=mysqli_fetch_array($sql);
					$cus_fname=$res['f_name'];
					$cus_lname=$res['l_name'];
					$arr[]=array("cus_fname"=>$cus_fname,"cus_lname"=>$cus_lname);
					
					$select_pro="select * from `project` where `cus_id`='$cus_id' AND `status`='A' AND `running_status` NOT IN('CM','CL') ORDER BY `id` DESC";
					$que=mysqli_query($con,$select_pro);
					if(mysqli_num_rows($que)>0){
						while($result=mysqli_fetch_array($que)){
							$pro_id=$result['id'];
							$pro_type=$result['project_type'];
							$pro_name=$result['project_name'];
							$r_status=$result['running_status'];
							$datetime=$result['datetime'];
							
							$select1="select * from `pro_u_awarded` where `pro_id`='$pro_id' AND `running_status` NOT IN('CM','CL')";
							$que1=mysqli_query($con,$select1);
							if(mysqli_num_rows($que1)>0){
								$res1=mysqli_fetch_array($que1);
								$tra_id=$res1['tra_id'];
								$pay_status=$res1['pay_status'];
								
								$select_t="select * from `u_details` where `login_id`='$tra_id'";
								$sql1=mysqli_query($con,$select_t);
								$val=mysqli_fetch_array($sql1);
								$t_name=$val['f_name']." ".$val['l_name'];
							}
							else{
								$t_name="-";
							}
							
							$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"tra_name"=>$t_name,"running_status"=>$r_status,"date&time"=>$datetime,"project_type"=>$pro_type,"pay_status"=>$pay_status,"client_details"=>$arr);
							
						}
						$json = array("result" => "success", "response" =>$array,"message"=>"");
						echo json_encode($json);
					}
					else{
						$json = array("result" => "error", "response"=>array("client_details"=>$arr),"message"=>"no data available");
						echo json_encode($json);
					}
				}
				else{
					$json = array("result" => "error", "response" =>"","message"=>"no data available");
					echo json_encode($json);
				}
			}
		
		
	}
	if($method=='pro_live'){
		
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
	
		$date=date("Y-m-d H:i:s");
		$cus_id=str_replace('%20', ' ', isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "");	
		
		$project_name=str_replace('%20', ' ',isset($_REQUEST['project_name']) ? mysqli_real_escape_string($con,$_REQUEST['project_name']) : "");	
		
		$project_desc=str_replace('%20', ' ',isset($_REQUEST['project_desc']) ? mysqli_real_escape_string($con,$_REQUEST['project_desc']) : "");
		
		$main_lang=str_replace('%20', ' ',isset($_REQUEST['main_lang']) ? mysqli_real_escape_string($con,$_REQUEST['main_lang']) : "");	
		
		$con_lang=str_replace('%20', ' ',isset($_REQUEST['con_lang']) ? mysqli_real_escape_string($con,$_REQUEST['con_lang']) : "");	
		
		$from_time=str_replace('%20', ' ',isset($_REQUEST['from_time']) ? mysqli_real_escape_string($con,$_REQUEST['from_time']) : "");
		
		$to_time=str_replace('%20', ' ',isset($_REQUEST['to_time']) ? mysqli_real_escape_string($con,$_REQUEST['to_time']) : "");
		
		$pro_type=str_replace('%20', ' ',isset($_REQUEST['pro_type']) ? mysqli_real_escape_string($con,$_REQUEST['pro_type']) : "");
		
		$for_type=str_replace('%20', ' ',isset($_REQUEST['for_type']) ? mysqli_real_escape_string($con,$_REQUEST['for_type']) : "");
		
		$budget=str_replace('%20', ' ', isset($_REQUEST['budget']) ? mysqli_real_escape_string($con,$_REQUEST['budget']) : "");
		
		$date1=str_replace('%20', ' ', isset($_REQUEST['date']) ? mysqli_real_escape_string($con,$_REQUEST['date']) : "");	
		
		if(!isset($_REQUEST['cus_id'],$_REQUEST['project_name'],$_REQUEST['main_lang'],$_REQUEST['con_lang'],$_REQUEST['from_time'],$_REQUEST['to_time'],$_REQUEST['pro_type'],$_REQUEST['for_type'],$_REQUEST['date'])){
			$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
			echo json_encode($json);
		}
		else{
			$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
			$random=substr(str_shuffle($data), 0, 6);
			
			$insert="insert into `project` (`cus_id`,`project_name`,`main_lang`,`conversion_lang`,`project_type`,`project_desc`,`status`,`running_status`,`for_project`,`datetime`,`rand_no`)values('$cus_id','$project_name','$main_lang','$con_lang','$pro_type','$project_desc','A','O','$for_type','$date','$random')";

			$que=mysqli_query($con,$insert);
			
			if($que){
				$select="select * from `project` where `cus_id`='$cus_id' AND `rand_no`='$random' order by `cus_id` DESC LIMIT 1";
				$que7=mysqli_query($con,$select);
				$res7=mysqli_fetch_array($que7);
				$pro_id=$res7['id'];
				
				//echo $pro_id;
				
				if($pro_type=='LIV'){
					
					
					$timeFirst  = strtotime($from_time);
					$timeSecond = strtotime($to_time);
					$differenceInSeconds = $timeSecond - $timeFirst;
			
					//$total_time_in_sec = $differenceInSeconds;
					$total_time_in_hour = $differenceInSeconds/3600;
					
					//echo $total_time;
					//$total_time = round(abs($to_time - $from_time) / 60,2);;
			
					//Finding per hour rate
					$select1="select * from `m_rate` where `type`='PH' and `status`='A'";
					$que1=mysqli_query($con,$select1);
					$res1=mysqli_fetch_array($que1);
					$rate=$res1['rate'];
			
					$budget= $rate * $total_time_in_hour;
					
					
					$insert_liv="INSERT INTO `pro_live_details` (`id`, `pro_id`, `date`, `from_time`, `to_time`, `total_time`, `budget`, `for_pro`) VALUES ('null','$pro_id','$date1','$from_time','$to_time','$differenceInSeconds','$budget','$for_type')";
					//echo $insert_liv;
					$sql1=mysqli_query($con,$insert_liv);
					if($sql1){
						$json = array("result" => "success", "response" =>"","message"=>"project inserted");
						echo json_encode($json);
						
					}else{
						$json = array("result" => "error", "response" =>"","message"=>"error!");
						echo json_encode($json);
					}
					
					
				}
				else{
					$json = array("result" => "error", "response" =>"","message"=>"your projecttype in not LIVE project!!");
					echo json_encode($json);
					
				}
				
			}else{
				
				$json = array("result" => "error", "response" =>"","message"=>"error!");
				echo json_encode($json);
			}
		}
	}
	
	if($method=='pro_doc'){
			
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
			
			$date=date("Y-m-d H:i:s");
			$cus_id=str_replace('%20', ' ',isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "");
			
			$project_name=str_replace('%20', ' ',isset($_REQUEST['project_name']) ? mysqli_real_escape_string($con,$_REQUEST['project_name']) : "");
			
			$project_desc=str_replace('%20', ' ',isset($_REQUEST['project_desc']) ? mysqli_real_escape_string($con,$_REQUEST['project_desc']) : "");
			
			$ind_type=str_replace('%20', ' ',isset($_REQUEST['ind_type']) ? mysqli_real_escape_string($con,$_REQUEST['ind_type']) : "");
			
			$main_lang=str_replace('%20', ' ',isset($_REQUEST['main_lang']) ? mysqli_real_escape_string($con,$_REQUEST['main_lang']) : "");	
			
			$con_lang=str_replace('%20', ' ',isset($_REQUEST['con_lang']) ? mysqli_real_escape_string($con,$_REQUEST['con_lang']) : "");	
			
			$time=str_replace('%20', ' ',isset($_REQUEST['time']) ? mysqli_real_escape_string($con,$_REQUEST['time']) : "");
			
			$no_page=str_replace('%20', ' ', isset($_REQUEST['no_page']) ? mysqli_real_escape_string($con,$_REQUEST['no_page']) : "");
			
			//$document=isset($_REQUEST['document']) ? mysqli_real_escape_string($con,$_REQUEST['document']) : "";	
			
			$pro_type=str_replace('%20', ' ', isset($_REQUEST['pro_type']) ? mysqli_real_escape_string($con,$_REQUEST['pro_type']) : "");	
			
			$for_type=str_replace('%20', ' ',isset($_REQUEST['for_type']) ? mysqli_real_escape_string($con,$_REQUEST['for_type']) : "");
			
			$budget=str_replace('%20', ' ',isset($_REQUEST['budget']) ? mysqli_real_escape_string($con,$_REQUEST['budget']) : "");
			
			$exe="pdf";

			$doc = $_REQUEST['document'];
			//$file = str_replace(' ', '+', $doc);
			$decoded = base64_decode($doc);
			$file_name = md5(rand()).'_'.$pro_type.".".$exe;
			file_put_contents('../doc_file/'.$file_name, $decoded);
			$path='http://5ivetechnology.com/projects/true-translator/doc_file/'.$file_name;
			
			if(!isset($_REQUEST['cus_id'],$_REQUEST['project_name'],$_REQUEST['ind_type'],$_REQUEST['main_lang'],$_REQUEST['con_lang'],$_REQUEST['time'],$_REQUEST['no_page'],$_REQUEST['document'],$_REQUEST['pro_type'],$_REQUEST['for_type'])){
				$json = array("result" => "error", "response" =>"All parameters are compulsary" ,"message"=>"");
				echo json_encode($json);
			}
			else{
				$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
				$random=substr(str_shuffle($data), 0, 6);
				
				$insert="insert into `project` (`cus_id`,`project_name`,`main_lang`,`conversion_lang`,`project_type`,`project_desc`,`status`,`running_status`,`for_project`,`datetime`,`rand_no`)values('$cus_id','$project_name','$main_lang','$con_lang','$pro_type','$project_desc','A','O','$for_type','$date','$random')";

				$que=mysqli_query($con,$insert);
				
				if($que){
					
					$select="select * from `project` where `cus_id`='$cus_id' AND `rand_no`='$random' order by `cus_id` DESC LIMIT 1";
					$que7=mysqli_query($con,$select);
					$res7=mysqli_fetch_array($que7);
					$pro_id=$res7['id'];
					
					
					if($pro_type=='DOC'){
						$insert_doc="insert into `pro_doc_details` (`pro_id`,`industry_type`,`document`,`no_of_pages`,`budget`,`datetime`,`for_project`)values('$pro_id','$ind_type','$file_name','$no_page','$budget','$time','$for_type')";
						$sql1=mysqli_query($con,$insert_doc);
						if($sql1){
							$json = array("result" => "success", "response" =>"","message"=>"project inserted");
							echo json_encode($json);
							
						}else{
							$json = array("result" => "error", "response" =>"" ,"message"=>"error");
							echo json_encode($json);
						}
						
						
					}
					else{
						$json = array("result" => "error", "response" =>"","message"=>"your projecttype in not DOC project!!");
						echo json_encode($json);
						
					}
					
				}else{
					
					$json = array("result" => "error", "response" =>"" ,"message"=>"error");
					echo json_encode($json);
				}
			}
			
		

	}
	if($method=='t_history_pro'){
		
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);

		$tra_id=str_replace('%20', ' ', isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "");
		
		if($tra_id==''){
			$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
			echo json_encode($json);
		}
		else{
		
			$select_a="select * from `pro_u_awarded` where tra_id='$tra_id'  AND `running_status` IN ('CM','CL') order by `pro_id` DESC";
			$que1=mysqli_query($con,$select_a);
			if(mysqli_num_rows($que1)>0){
				while($res1=mysqli_fetch_array($que1)){
					$pro_id=$res1['pro_id'];
					
					$select_pro="select * from `project` where `id`='$pro_id' AND `running_status` IN ('CM','CL') order by `id` DESC";
					$que=mysqli_query($con,$select_pro);
					while($result=mysqli_fetch_array($que)){
						$pro_id=$result['id'];
						$pro_type=$result['project_type'];
						$pro_name=$result['project_name'];
						$r_status=$result['running_status'];
						$datetime=$result['datetime'];
						$cus_id=$result['cus_id'];
						
						$select_c="select * from `u_details` where `login_id`='$cus_id'";
						$sql=mysqli_query($con,$select_c);
						$res=mysqli_fetch_array($sql);
						$c_fname=$res['f_name'];
						$c_lname=$res['l_name'];
						
						$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"client_fname"=>$c_fname,"client_lname"=>$c_lname,"running_status"=>$r_status,"date&time"=>$datetime,"project_type"=>$pro_type);
						
					}
				}
				$json = array("result" => "success", "response" =>$array ,"message"=>"");
				echo json_encode($json);
			}
			else{
				$json = array("result" => "error", "response" =>"","message"=>"no data available");
				echo json_encode($json);
			}
		}
	

	}
	if($method=='t_browse_pro'){
		
		/* ping= 1 = not ping no invite 
			ping=2= pinged 
			ping=3= invited */
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
		
		$tra_id=str_replace('%20', ' ', isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "");
		
		if($tra_id==''){
			$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
			echo json_encode($json);
		}
		else{
			$select_p="select * from `project` where `status`='A' AND `for_project`='PU' AND `running_status`='O' order by `id` DESC";
			$sql=mysqli_query($con,$select_p);
			if(mysqli_num_rows($sql)>0){
				while($res1=mysqli_fetch_array($sql)){
					$pro_id=$res1['id'];
					$pro_type=$res1['project_type'];
					$pro_name=$res1['project_name'];
					$datetime=$res1['datetime'];
					$cus_id=$res1['cus_id'];
					$for_type=$res1['for_project'];
					$r_status=$res1['running_status'];
					
					
					$select_c="select * from `u_details` where `login_id`='$cus_id'";
					$sql2=mysqli_query($con,$select_c);
					$res3=mysqli_fetch_array($sql2);
						$c_fname=$res3['f_name'];
						$c_lname=$res3['l_name'];
						
						if($r_status=='O'){
							$invite="select * from `pro_u_invite` where `pro_id`='$pro_id' AND `tra_id`='$tra_id' OR `ping_status`='1' AND `invite_status`='1'";
							$qu=mysqli_query($con,$invite);
							if(mysqli_num_rows($qu)==0){
								$ping=1;
							}
							else{
								$row=mysqli_fetch_array($qu);
								if($row['ping_status']==1){
									$ping=2;
								}
								elseif($row['invite_status']==1){
									$ping=3;
								}
							}
						
							$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"client_fname"=>$c_fname,"client_lname"=>$c_lname,"running_status"=>$r_status,"project_type"=>$pro_type,"date&time"=>$datetime,"ping_status"=>$ping);
						}
						else{
							$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"client_fname"=>$c_fname,"client_lname"=>$c_lname,"running_status"=>$r_status,"project_type"=>$pro_type,"date&time"=>$datetime,"ping_status"=>"-");
						}					
					
				}
				$json = array("result" => "success", "response" =>$array,"message"=>"");
				echo json_encode($json);
			}
			else{
				$json = array("result" => "error", "response" =>"","message"=>"no data available");
				echo json_encode($json);
			}
	
		}
	}
	if($method=='t_invites_pro'){
			/*  
			0=no response
			1=accepted
			2=declined
			
			*/
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
	
			$tra_id=str_replace('%20', ' ', isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "");
			
			if($tra_id==''){
				$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
				echo json_encode($json);
			}
			else{
				$select="select * from `pro_u_invite` where `tra_id`='$tra_id' AND `invite_status`='1' order by `pro_id` DESC";
				$que1=mysqli_query($con,$select);
				if(mysqli_num_rows($que1)>0){
					$match=0;
					while($res=mysqli_fetch_array($que1)){
						$ac_status=$res['accepted_status']; 
						$pro_id=$res['pro_id'];
						$select_pro="select * from `project` where `id`='$pro_id' AND `status`='A' AND `running_status`='O' order by `id` DESC";
						
						$que=mysqli_query($con,$select_pro);
						
							$result=mysqli_fetch_array($que);
							$pro_id=$result['id'];
							$pro_type=$result['project_type'];
							$pro_name=$result['project_name'];
							$r_status=$result['running_status'];
							$datetime=$result['datetime'];
							
							$cus_id=$result['cus_id'];
							if($result['for_project']=='PR'){
								
								$select_c="select * from `u_details` where `login_id`='$cus_id'";
								$sql=mysqli_query($con,$select_c);
								while($res1=mysqli_fetch_array($sql)){
									$c_fname=$res1['f_name'];
									$c_lname=$res1['l_name'];
									
									if($ac_status==""){
										$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"client_fname"=>$c_fname,"client_lname"=>$c_lname,"running_status"=>$r_status,"date&time"=>$datetime,"project_type"=>$pro_type,"accept_status"=>"0","for_pro"=>$result['for_project']);
									}
									elseif($ac_status=="AC"){
										$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"client_fname"=>$c_fname,"client_lname"=>$c_lname,"running_status"=>$r_status,"date&time"=>$datetime,"project_type"=>$pro_type,"accept_status"=>"1","for_pro"=>$result['for_project']);
									}
									elseif($ac_status=="DE"){
										$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"client_fname"=>$c_fname,"client_lname"=>$c_lname,"running_status"=>$r_status,"date&time"=>$datetime,"project_type"=>$pro_type,"accept_status"=>"2","for_pro"=>$result['for_project']);
									}
								}
							}
							elseif($result['for_project']=='PU' AND ($ac_status=='' OR $ac_status==NULL)){
								$select_c="select * from `u_details` where `login_id`='$cus_id'";
								$sql=mysqli_query($con,$select_c);
								
								while($res1=mysqli_fetch_array($sql)){
									$c_fname=$res1['f_name'];
									$c_lname=$res1['l_name'];
									
									
										$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"client_fname"=>$c_fname,"client_lname"=>$c_lname,"running_status"=>$r_status,"date&time"=>$datetime,"project_type"=>$pro_type,"accept_status"=>"0","for_pro"=>$result['for_project']);
									
								}
							}
							else{
								$match++;
							}
						
					}
					$n_row=mysqli_num_rows($que1);
					if($n_row==$match){
						$json = array("result" => "error", "response" =>"" ,"message"=>"no data available");
						echo json_encode($json);
					}
					else{
						$json = array("result" => "success", "response" =>$array ,"message"=>"");
						echo json_encode($json);
					}
				}
				else{
					$json = array("result" => "error", "response" =>"" ,"message"=>"no data available");
					echo json_encode($json);
				}
			}
		
	}
	if($method=='t_ping_pro'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
	
			$date=date("Y-m-d H:i:s");
			$tra_id=str_replace('%20', ' ', isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "");	
			
			$pro_id=str_replace('%20', ' ',isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "");
			
			if(!isset($_REQUEST['tra_id'],$_REQUEST['pro_id'])){
				$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
				echo json_encode($json);
			}
			else{
				$select="select * from `pro_u_invite` where `pro_id`='$pro_id' AND `tra_id`='$tra_id'";
				$que=mysqli_query($con,$select);
				if(mysqli_num_rows($que)>0){
					
					$json = array("result" => "success", "response" =>"","message"=>"already pinged!");
					echo json_encode($json);

				}
				else{
					$insert="insert into `pro_u_invite` (`pro_id`,`tra_id`,`invite_status`,`ping_status`,`accepted_status`,`datetime`)values('$pro_id','$tra_id','0','1','','$date')";
					$sql=mysqli_query($con,$insert);
					if($sql){
						
						$array[]=array("translator_id"=>$tra_id);
						$json = array("result" => "success", "response" =>$array,"message"=>"pinged successfully");
						echo json_encode($json);
						
					}
					else{
						$json = array("result" => "error", "response" =>"","message"=>"error");
						echo json_encode($json);
					}
					
				}
			}
			
		
		
	}
	if($method=='t_upcoming_pro'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
	
			$tra_id=str_replace('%20', ' ',isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "");	
			
			if($tra_id==''){
				$json = array("result" => "error", "response" =>"","message"=>"All parameters are compulsary");
				echo json_encode($json);
			}
			else{
				$select_a="select * from `pro_u_awarded` where tra_id='$tra_id' AND `running_status`='W' ORDER BY `pro_id` DESC";
				$que1=mysqli_query($con,$select_a);
				if(mysqli_num_rows($que1)>0){
					while($res1=mysqli_fetch_array($que1)){
						$pro_id=$res1['pro_id'];
						
						$select_pro="select * from `project` where `id`='$pro_id' AND `status`='A' AND `running_status`='W' ORDER BY `id` DESC";
						$que=mysqli_query($con,$select_pro);
						while($result=mysqli_fetch_array($que)){
							$pro_id=$result['id'];
							$pro_type=$result['project_type'];
							$pro_name=$result['project_name'];
							$r_status=$result['running_status'];
							$datetime=$result['datetime'];
							$cus_id=$result['cus_id'];
							
							$select_c="select * from `u_details` where `login_id`='$cus_id'";
							$sql=mysqli_query($con,$select_c);
							$res=mysqli_fetch_array($sql);
							$c_fname=$res['f_name'];
							$c_lname=$res['l_name'];
							
							$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"client_fname"=>$c_fname,"client_lname"=>$c_lname,"running_status"=>$r_status,"date&time"=>$datetime,"project_type"=>$pro_type);
							
						}
					}
					$json = array("result" => "success", "response" =>$array,"message"=>"");
					echo json_encode($json);
				}
				else{
					$json = array("result" => "error", "response" =>"","message"=>"no data available");
					echo json_encode($json);
				}
			}
		

		
	}
	if($method=='u_change_pass'){
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
		
			$u_id = str_replace('%20', ' ',isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "");
			
			$password=str_replace('%20', ' ',isset($_REQUEST['old_pass']) ? mysqli_real_escape_string($con,$_REQUEST['old_pass']) : "");
			
			$new_password=str_replace('%20', ' ',isset($_REQUEST['new_pass']) ? mysqli_real_escape_string($con,$_REQUEST['new_pass']) : "");
			
			if(!isset($_REQUEST['u_id'],$_REQUEST['old_pass'],$_REQUEST['new_pass'])){
				$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
				echo json_encode($json);
			}
			else{
				$select="select * from `u_login` where `id`='$u_id'";
				$sql=mysqli_query($con,$select);
				$res=mysqli_fetch_array($sql);
				$pass=$res['password'];
				
				if($pass==$password){
					
					$update="update `u_login` SET `password`='$new_password' where `id`='$u_id'";
					$que=mysqli_query($con,$update);
					if($que){
						$json = array("result" => "success", "response" =>"" ,"message"=>"password change successfully");
						echo json_encode($json);
					}
					else{
						$json = array("result" => "error", "response" =>"" ,"message"=>"error!!");
						echo json_encode($json);
					}
					
				}
				else{
					$json = array("result" => "error", "response" =>"","message"=>"password does not matched!");
					echo json_encode($json);
				}
			}

		
	}
	if($method=='u_document'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
			
			$date=date("Y-m-d H:i:s");

			$u_id = str_replace('%20', ' ',isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "");
			
			$eng_doc=str_replace('%20', ' ',isset($_REQUEST['eng_doc']) ? mysqli_real_escape_string($con,$_REQUEST['eng_doc']) : "");
			
			$spn_doc=str_replace('%20', ' ',isset($_REQUEST['spn_doc']) ? mysqli_real_escape_string($con,$_REQUEST['spn_doc']) : "");
			
			$form=str_replace('%20', ' ',isset($_REQUEST['form']) ? mysqli_real_escape_string($con,$_REQUEST['form']) : "");
			
			
			
			
			if(!isset($_REQUEST['u_id'], $_REQUEST['eng_doc'], $_REQUEST['spn_doc'], $_REQUEST['form'])) {
					$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
					echo json_encode($json);
			}
			else{
				//echo $eng_doc;
				$exe="pdf";
				//$file = str_replace(' ', '+', $eng_doc);
				$decoded = base64_decode($eng_doc);
				$doc_name = md5(microtime()).'_'.$u_id.'_'."eng_doc".'_'.".".$exe;
				$f1=file_put_contents('../doc_file/'.$doc_name, $decoded);
				
				//$file1 = str_replace(' ', '+', $spn_doc);
				$decoded1 = base64_decode($spn_doc);
				$doc_name1 = md5(microtime()).'_'.$u_id.'_'."spn_doc".'_'.".".$exe;
				$f2=file_put_contents('../doc_file/'.$doc_name1, $decoded1);
				
				//$file2 = str_replace(' ', '+', $form);
				$decoded2 = base64_decode($form);
				$doc_name2 = md5(microtime()).'_'.$u_id.'_'."form".'_'.".".$exe;
				$f3=file_put_contents('../doc_file/'.$doc_name2, $decoded2);
				
				if($f1 AND $f2 AND $f3){
					$insert="insert into `u_document` (`login_id`,`certificate`,`admin_veri_status`,`datetime`,`type`,`document_name`) values('$u_id','1','0','$date','L','$doc_name'),('$u_id','2','0','$date','L','$doc_name1'),('$u_id','1099','0','$date','D','$doc_name2')";
					$que=mysqli_query($con,$insert);
					if($que){
						
						$update="update `u_details` SET `admin_doc_veri_status`='1' where `login_id`='$u_id'";
						
						$que1=mysqli_query($con,$update);
						if($que1){
							$select="select * from `u_details` where `login_id`='$u_id'";
							$sql=mysqli_query($con,$select);
							$res=mysqli_fetch_array($sql);
							$admin_status=$res['admin_doc_veri_status'];
							$data[]=array("login_id"=>$u_id,"admin_verification_status"=>$admin_status);
							$json = array("result" => "success", "response" =>$data ,"message"=>"documents submitted");
							echo json_encode($json);
						}
					}
					else{
						$json = array("result" => "error", "response" =>"","message"=>"error");
						echo json_encode($json);
					}
				}
				else{
					$json = array("result" => "error", "response" =>"","message"=>"error");
					echo json_encode($json);
				}
			}

		
	}
	if($method=='u_email_verification'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);

			$u_id = str_replace('%20', ' ',isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "");
			
			$otp = str_replace('%20', ' ',isset($_REQUEST['otp']) ? mysqli_real_escape_string($con,$_REQUEST['otp']) : "");
			
			if(!isset($_REQUEST['u_id'],$_REQUEST['otp'])){
				$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
				echo json_encode($json);
			}
			else{
				$select11=mysqli_query($con,"select * from `u_login` where `id`='$u_id'");
				if(mysqli_num_rows($select11)>0){
					$res11=mysqli_fetch_array($select11);
					$type=$res11['type'];
					
					$select="select * from `email_otp` where `user_id`='$u_id' AND `otp`='$otp'";
					$que=mysqli_query($con,$select);
					if(mysqli_num_rows($que)>0){
						$res=mysqli_fetch_array($que);
						$status=$res['status'];
						$otp_id=$res['id'];
						if($status=='A'){
							$otp1=$res['otp'];
							if($otp==$otp1){
								
								$update1="update `u_details` SET `email_verification`='1' where `login_id`='$u_id'";
								$sql=mysqli_query($con,$update1);
								
								$update="update `email_otp` SET `status`='U' where `user_id`='$u_id'  AND `id`='$otp_id'";
								$sql1=mysqli_query($con,$update);
								
								$array[]=array("login_id"=>$u_id);
								if($type=='TR'){	
									$json = array("result" => "success", "response" =>$array ,"message"=>"email verification successfully , please login from website for document verification process");
									echo json_encode($json);
								}
								elseif($type=='CU'){
									$json = array("result" => "success", "response" =>$array ,"message"=>"email verification successfully");
									echo json_encode($json);
								}
							}
							else{
								$json = array("result" => "error", "response" =>"","message"=>"otp does not matched");
								echo json_encode($json);
								
							}
						}
						elseif($status=='U'){
							$array[]=array("user_id"=>$u_id);
							$json = array("result" => "success", "response" =>$array,"message"=>"email verification already done, click here for login in True Translator");
							echo json_encode($json);
						}
						elseif($status=='E'){
							$array[]=array("user_id"=>$u_id);
							$json = array("result" => "error", "response" =>$array,"message"=>"your email verification link is expired due to time, please click here for again verification mail");
							echo json_encode($json);
						}
					}
					else{
						$json = array("result" => "error", "response" =>"","message"=>"otp does not matched");
						echo json_encode($json);
					}
				}
				else{
					$array[]=array("user_id"=>$u_id);
					$json = array("result" => "error", "response" =>$array,"message"=>"please check your registered email id and complete the email verification process If your verification link is expired or you didn't get mail then please ‘click here’ for again verification mail");
					echo json_encode($json);
				}
			}
			
			
		
		
	}
	
	if($method=='u_forget_password'){
			
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
			
			$date = date('Y-m-d H:i:s');
			$email_id = str_replace('%20', ' ',isset($_REQUEST['email']) ? mysqli_real_escape_string($con,$_REQUEST['email']) : "");
			
			if($email_id=='' ){
				$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
				echo json_encode($json);
			}
			else{
				$select="select * from `u_login` where `email_id`='$email_id'";
				$que=mysqli_query($con,$select);
				if(mysqli_num_rows($que)==1){
					$res=mysqli_fetch_array($que);
					//$pass=$res['password'];
					$id=$res['id'];
					//$data[]=array("login_id"=>$id);
					$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
					$otp=substr(str_shuffle($data), 0, 6);
					$update=mysqli_query($con,"update `email_otp` SET `status`='E' where `user_id`='$id' AND `status`='A'");
					
					$insert="insert into `email_otp` (`user_id`,`otp`,`datetime`,`status`,`type`) values('$id','$otp','$date','A','pass')";
					$sql=mysqli_query($con,$insert);
					if($sql){
						$select_otp="select * from `email_otp` where `user_id`='$id' order by `datetime` DESC LIMIT 1";
						$sql1=mysqli_query($con,$select_otp);
						$res=mysqli_fetch_array($sql1);
						$otp=$res['otp'];
						$otp_id=$res['id'];
						
							$to=$email_id;
							$subject='Forget password otp';
							$message='Your OTP : '.$otp; 
							$headers='From:translator@5ivetechnology.com';
							$m=mail($to,$subject,$message,$headers);
							if($m){
								//echo"otp send on your email_id";
							}
							else{
								//echo"error!!!";
							}
						
						$array[]=array("otp_id"=>$otp_id);
						$json = array("result" => "success", "response" => $array,"message"=>"please check your mail");
						echo json_encode($json);
					}
					else{
						$json = array("result" => "error", "response" => "","message"=>"error");
						echo json_encode($json);
					}
				}
				else{
					$json = array("result" => "error", "response" =>"","message"=>"invalid email_id !");
					echo json_encode($json);
				}
				
			}
		
		
	}
	if($method=='u_check_otp'){
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
			
		$otp_id = str_replace('%20', ' ', isset($_REQUEST['otp_id']) ? mysqli_real_escape_string($con,$_REQUEST['otp_id']) : "");
		
		$otp = str_replace('%20', ' ', isset($_REQUEST['otp']) ? mysqli_real_escape_string($con,$_REQUEST['otp']) : "");
		
		if(!isset($_REQUEST['otp_id'],$_REQUEST['otp'])){
			$json=array("result"=>"Error","response"=>'All parameters are compulsary!!',"message"=>"");
			echo json_encode($json);
		}else{
			$select="select * from `email_otp` where `id`='$otp_id '";
			$que=mysqli_query($con,$select);
			$result=mysqli_fetch_array($que);
			$otp1=$result['otp'];
			$user_id=$result['user_id'];
			$data[]=array('user_id'=>$user_id,"otp_id"=>$otp_id);
			if($otp1==$otp){
				$update=mysqli_query($con,"update `email_otp` SET `status`='U' where `id`='$otp_id' AND `status`='A'");
				
				$json = array("result" => "success", "response" => $data,"message"=>"otp matched");
				//echo"otp matched !"."<br>";
				echo json_encode($json);
			}
			else{
				$json=array("result"=>"error","response"=>"","message"=>"otp doesn't match!");
				echo json_encode($json);
			}
		}
		
	}
	
	if($method=='u_reset_password'){
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
		
		$user_id = str_replace('%20', ' ', isset($_REQUEST['user_id']) ? mysqli_real_escape_string($con,$_REQUEST['user_id']) : "");
		$password =str_replace('%20', ' ', isset($_REQUEST['password']) ? mysqli_real_escape_string($con,$_REQUEST['password']) : "");
		
		if(!isset($_REQUEST['user_id'],$_REQUEST['password'])){
			$json=array("result"=>"Error","response"=>'All parameters are compulsary!!',"message"=>"");
			echo json_encode($json);
		}
		else{
			$update="UPDATE `u_login` SET `password`='$password' where `id`='$user_id'";
			$que=mysqli_query($con,$update);
			if($que){
				$json=array("result"=>"success","response"=>"","message"=>"password reset successfully");
				echo json_encode($json);
			}
			else{
				$json=array("result"=>"error","response"=>"","message"=>"error");
				echo json_encode($json);
			}
		}
	}
	
	if($method=='u_project_details'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);

			$pro_id=str_replace('%20', ' ',isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "" );
			
			if($pro_id==''){
				$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
				echo json_encode($json);
			}
			else{
				$select="select * from `project` where `id`='$pro_id'";
				$sql=mysqli_query($con,$select);
				if(mysqli_num_rows($sql)>0){
					$result=mysqli_fetch_array($sql);
					$pro_type=$result['project_type'];
					$pro_name=$result['project_name'];
					$date=$result['datetime'];
					$r_status=$result['running_status'];
					$main_lang=$result['main_lang'];
					$con_lang=$result['conversion_lang'];
					$cus_id=$result['cus_id'];
					$project_desc=$result['project_desc'];
					
					$select_l=mysqli_query($con,"select * from `m_language` where `id`='$main_lang'");
					$res_l=mysqli_fetch_array($select_l);
					$main_l=$res_l['language'];
					
					$select_l1=mysqli_query($con,"select * from `m_language` where `id`='$con_lang'");
					$res_l1=mysqli_fetch_array($select_l1);
					$con_l=$res_l1['language'];
					
					$select_c="SELECT * FROM  `u_details` LEFT OUTER JOIN  `country` ON  `u_details`.`country_id` =  `country`.`id` LEFT OUTER JOIN `state` ON `u_details`.`state_id`=`state`.`id` LEFT OUTER JOIN  `city` ON  `u_details`.`city_id` =  `city`.`id` WHERE  `u_details`.`login_id` ='$cus_id'";
					
						$que_c=mysqli_query($con,$select_c);
						$res_c=mysqli_fetch_array($que_c);
						$cus_fname=$res_c['f_name'];
						$cus_lname=$res_c['l_name'];
						$coun_name=$res_c['country_name'];
						$state_name1=$res_c['state_name'];
						$city_name=$res_c['city_name'];
						
						$cus_detail[]=array("client_fname"=>$cus_fname,"client_lname"=>$cus_lname,"client_country"=>$coun_name ,"client_state"=>$state_name1 ,"client_city"=>$city_name ,"cus_id"=>$cus_id); 
					
						if($pro_type=='DOC'){
							$select_doc="select * from `pro_doc_details` where `pro_id`='$pro_id'";
							
							$que=mysqli_query($con,$select_doc);
							if(mysqli_num_rows($que)>0){
								$res=mysqli_fetch_array($que);
								
								$budget=$res['budget'];
								$time=$res['time'];
								$doc=$res['document'];
								$path='http://5ivetechnology.com/projects/true-translator/doc_file/'.$doc;
							}
							else{
								$budget="";
								$time="";
								$doc="";
								$path="";
							}
							$array[]=array("project name"=>$pro_name,"project_type"=>$pro_type,"running_status"=>$r_status,"main_lang"=>$main_l,"conversion_lang"=>$con_l,"budget"=>$budget,"time"=>$time,"document"=>$path,"project_desc"=>$project_desc,"doc_name"=>$doc,"date&time"=>$date);
							
						}
						elseif($pro_type=='LIV'){
							$select_liv="select * from `pro_live_details` where pro_id='$pro_id'";
							
							$que1=mysqli_query($con,$select_liv);
							$res1=mysqli_fetch_array($que1);
							
							$budget=$res1['budget'];
							$from_time=$res1['from_time'];
							$to_time=$res1['to_time'];
							$date=$res1['date'];
							
							$array[]=array("project name"=>$pro_name,"project_type"=>$pro_type,"running_status"=>$r_status,"main_lang"=>$main_l,"conversion_lang"=>$con_l,"budget"=>$budget,"from_time"=>$from_time,"to_time"=>$to_time,"date"=>$date,"date&time"=>$date,"project_desc"=>$project_desc);
							
							
						}
					if($r_status=='O'){
						$json = array("result" => "success", "response"=>array("project_details" =>$array,"client_details"=>$cus_detail),"message"=>"");
						echo json_encode($json);
					}
					elseif($r_status !='O'){
						
						$project="SELECT * FROM  `pro_u_awarded` RIGHT OUTER JOIN  `u_details` ON  `pro_u_awarded`.`tra_id` =  `u_details`.`login_id` WHERE  `pro_u_awarded`.`pro_id` ='$pro_id'";
						$que_a=mysqli_query($con,$project);
						$res_a=mysqli_fetch_array($que_a);
						$tra_id=$res_a['tra_id'];
						$tra_fname=$res_a['f_name'];
						$tra_lname=$res_a['l_name'];
						$datetime=$res_a['datetime'];
						$pro_type=$res_a['pro_type'];
						$pay_status=$res_a['pay_status'];
						$running_status=$res_a['running_status'];
						$cus_id=$res_a['cus_id'];
						$pic=$res_a['pic'];
						$pic_path='http://5ivetechnology.com/projects/true-translator/upload/'.$pic;
							
						
						$select_r="select * from `pro_review_rating` where `cus_id`='$cus_id' AND `pro_id`='$pro_id' AND `tra_id`='$tra_id'";
						$sql2=mysqli_query($con,$select_r);
						if(mysqli_num_rows($sql2)>0){
							$res_r=mysqli_fetch_array($sql2);
							$review=$res_r['review'];
							$rating=$res_r['rating'];
						}
						else{
							$rating="no rating available";
							$review="no review available";
						}
						
						$select_c="SELECT * FROM  `u_details` LEFT OUTER JOIN  `country` ON  `u_details`.`country_id` =  `country`.`id` LEFT JOIN `state` ON `u_details`.`state_id`=`state`.`id` LEFT OUTER JOIN  `city` ON  `u_details`.`city_id` =  `city`.`id` WHERE  `u_details`.`login_id` ='$cus_id'";
						$que_c=mysqli_query($con,$select_c);
						$res_c=mysqli_fetch_array($que_c);
						$cus_fname=$res_c['f_name'];
						$cus_lname=$res_c['l_name'];
						$coun_name=$res_c['country_name'];
						$state_name1=$res_c['state_name'];
						$city_name=$res_c['city_name'];
						
						$cus_detail1[]=array("client_fname"=>$cus_fname,"client_lname"=>$cus_lname,"client_country"=>$coun_name,"client_state"=>$state_name1,"client_city"=>$city_name,"cus_id"=>$cus_id);
						
						$detail[]=array("tra_id"=>$tra_id,"translator_fname"=>$tra_fname,"translator_lname"=>$tra_lname,"translator_pic"=>$pic_path,"rating"=>$rating,"review"=>$review,"award_datetime"=>$datetime,"pay_status"=>$pay_status);
						
						$json= array("result" => "success", "response"=>array("project_details" =>$array,"translator_details"=>$detail,"client_details"=>$cus_detail1),"message"=>"");
						echo json_encode($json);
						
					}
				}
				else{
					$json= array("result" => "error", "response" =>"","message"=>"no data availabel");
					echo json_encode($json);
				}
			}
			
		
		
	}
	if($method=='u_login'){
		/** 
		0=email verification not done 
		1= document not submitted by translator
		2= Your documents not verified by admin
		3= Invalid email_id and password!!
		4="Your profile is deactive please contact to the admin"
		5="Type not matched"
		6="interview time not taken by translator"
		**/
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
 
			$email = str_replace('%20', ' ', isset($_REQUEST['email']) ? mysqli_real_escape_string($con,$_REQUEST['email']) : "");
			
			$password = str_replace('%20', ' ', isset($_REQUEST['password']) ? mysqli_real_escape_string($con,$_REQUEST['password']) : "");
			
			$type1 = str_replace('%20', ' ', isset($_REQUEST['type']) ? mysqli_real_escape_string($con,$_REQUEST['type']) : "");
			
			if(!isset($_REQUEST['email'],$_REQUEST['password'],$_REQUEST['type'])){
				$res=array("result"=>"error","response"=>"Unknown Error","message"=>"");
				echo json_encode($res);
			}else{
				$query= "select * from `u_login` where `email_id`='$email' AND `password`='$password'";
				$sql=mysqli_query($con,$query);
				if(mysqli_num_rows($sql)==1){
					$result = mysqli_fetch_array($sql);
					$id=$result['id'];
					$type=$result["type"];
					if($type==$type1){
						if($result['admin_status']=='A'){
							
							//$type=$result['type'];
							
							$select_d="select * from `u_details` where `login_id`='$id'";
							$sql3=mysqli_query($con,$select_d);
							$val=mysqli_fetch_array($sql3);
							$tnc_status=$val['t&c_status'];
							$email_status=$val['email_verification'];
							$admin_status=$val['admin_doc_veri_status'];
							$fname=$val['f_name'];
							$lname=$val['l_name'];
							$int_date=$val['interview_date_time'];
							
							if($type =='TR'){
								if($email_status=='1'){
									if($admin_status=='1'){
										if($int_date=="0000-00-00 00:00:00" OR $int_date==null){
											$json = array("result" => "error","response"=>array(array("t_status"=>"6","user_id"=>$id)),"message"=>"please login on website to complete translator application process");
											echo json_encode($json);
										}
										else{
											$json = array("result" => "error","response"=>array(array("t_status"=>"2","user_id"=>$id)),"message"=>"your documents not verified by admin");
											echo json_encode($json);
										}
									}
									elseif($admin_status=='2'){
										$array[] = array("id"=>$id,"user_type"=>$type,"email_id"=>$email,"t&c_status"=>$tnc_status,"email_verification_status"=>$email_status,"admin_doc_verification_status"=>$admin_status,"tra_fname"=>$fname,"tra_lname"=>$lname);
										$json = array("result" => "success", "response" => $array,"message"=>"login successfully");
										echo json_encode($json);
									
									}
									else{
										$json = array("result" => "error","response"=>array(array("t_status"=>"1","user_id"=>$id)),"message"=>"please login on website to complete translator application process");
										echo json_encode($json);
									}
								}	
							
								else{
									$json = array("result" => "error","response"=>array(array("t_status"=>"0","user_id"=>$id)),"message"=>"please verify your email_id");
									echo json_encode($json);
								}
							}
							elseif($type =='CU'){
								if($email_status=='1'){
									$array[] = array("id"=>$id,"user_type"=>$type,"email_id"=>$email,"t&c_status"=>$tnc_status,"email_verification_status"=>$email_status,"admin_doc_verification_status"=>$admin_status,"cus_fname"=>$fname,"cus_lname"=>$lname);
									$json = array("result" => "success", "response" => $array,"message"=>"login successfully");
									echo json_encode($json);
									
								}
								else{
									
									$json = array("result" => "error","response"=>array(array("t_status"=>"0","user_id"=>$id)),"message"=>"please verify your email_id");
									echo json_encode($json);
								}
							}
							
						}else{
							$json = array("result" => "error","response"=>array(array("t_status"=>"4","user_id"=>$id)),"message"=>"your profile is deactive please contact to the admin");
							echo json_encode($json);
						}
					}
					else{
						$json = array("result" => "error","response"=>array(array("t_status"=>"5","user_id"=>$id)),"message"=>"type not matched");
						echo json_encode($json);
					}
		
				}
				else{
					$json = array("result" => "error","response"=>array(array("t_status"=>"3","user_id"=>$id)),"message"=>"invalid email_id and password!!");
					echo json_encode($json);
				}
				
			}
		
		
	}
	if($method=='u_resend_otp'){
		
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
		
		$user_id = str_replace('%20', ' ',isset($_REQUEST['user_id']) ? mysqli_real_escape_string($con,$_REQUEST['user_id']) : "");
		$date=date("Y-m-d H:i:s");
		
		
		$select="select * from `u_login` where `id`='$user_id'";
		$que=mysqli_query($con,$select);
		$res=mysqli_fetch_array($que);
		$email=$res['email_id'];
		
		$select1="select * from `email_otp` where `user_id`='$user_id'";
		$sql=mysqli_query($con,$select1);
		if(mysqli_num_rows($sql)>0){
			$update="update `email_otp` SET `status`='E' where `user_id`='$user_id'";
			$que1=mysqli_query($con,$update);
			
			$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
			$otp=substr(str_shuffle($data), 0, 6);
			$to=$email;
			$subject='Email Verification';
			$message='Your otp for email-verification : '.$otp; 
			$headers='From:translator@5ivetechnology.com';
			$mail=mail($to,$subject,$message,$headers);
			if($mail){
				$insert="insert into `email_otp` (`user_id`,`otp`,`datetime`,`status`,`type`) values('$user_id','$otp','$date','A','email')";
				$que2=mysqli_query($con,$insert);
				$json = array("result" => "success", "response"=>array(array("user_id" =>$user_id ,"otp"=>$otp)),"message"=>"please verify your email_id otp send on email_id");
				echo json_encode($json);
			}
			else{
				$json = array("result" => "error", "response" =>"","message"=>"mail not send");
				echo json_encode($json);
			}
			
		}
		else{
			$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
			$otp=substr(str_shuffle($data), 0, 6);
			$to=$email;
			$subject='Email Verification';
			$message='Your otp for email-verification : '.$otp; 
			$headers='From:translator@5ivetechnology.com';
			$mail=mail($to,$subject,$message,$headers);
			if($mail){
				$insert="insert into `email_otp` (`user_id`,`otp`,`datetime`,`status`,`type`) values('$user_id','$otp','$date','A','email')";
				$que2=mysqli_query($con,$insert);
				
				$json = array("result" => "success", "response"=>array(array("user_id" =>$user_id ,"otp"=>$otp)),"message"=>"please verify your email_id otp send on email_id");
				echo json_encode($json);
			}
			else{
				$json = array("result" => "error", "response" =>"","message"=>"mail not send");
				echo json_encode($json);
			}
			
		}		
	}
	if($method=='u_signup'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
			
			//$u_id = isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "";
			$email = str_replace('%20', ' ', isset($_REQUEST['email']) ? mysqli_real_escape_string($con,$_REQUEST['email']) : "");
			
			$password = str_replace('%20', ' ', isset($_REQUEST['password']) ? mysqli_real_escape_string($con,$_REQUEST['password']) : "");
			
			$type = str_replace('%20', ' ', isset($_REQUEST['type']) ? mysqli_real_escape_string($con,$_REQUEST['type']) : "");
			
			$fname = str_replace('%20', ' ', isset($_REQUEST['fname']) ? mysqli_real_escape_string($con,$_REQUEST['fname']) : "");
			
			$lname =str_replace('%20', ' ', isset($_REQUEST['lname']) ? mysqli_real_escape_string($con,$_REQUEST['lname']) : "");
			
			$address = str_replace('%20', ' ',isset($_REQUEST['address']) ? mysqli_real_escape_string($con,$_REQUEST['address']) : "");
			
			$co_id = str_replace('%20', ' ', isset($_REQUEST['co_id']) ? mysqli_real_escape_string($con,$_REQUEST['co_id']) : "");
			
			$s_id =str_replace('%20', ' ', isset($_REQUEST['s_id']) ? mysqli_real_escape_string($con,$_REQUEST['s_id']) : "");
			
			$city_id = str_replace('%20', ' ',isset($_REQUEST['city_id']) ? mysqli_real_escape_string($con,$_REQUEST['city_id']) : "");
			
			//$about = isset($_REQUEST['about']) ? mysqli_real_escape_string($con,$_REQUEST['about']) : "";
			
			//$email_status= isset($_REQUEST['email_status']) ? mysqli_real_escape_string($con,$_REQUEST['email_status']) : "";
			//$admin_status= isset($_REQUEST['admin_status']) ? mysqli_real_escape_string($con,$_REQUEST['admin_status']) : "";
			
			$education= str_replace('%20', ' ', isset($_REQUEST['education']) ? mysqli_real_escape_string($con,$_REQUEST['education']) : "");
			
			//$avg_rating= isset($_REQUEST['avg_rating']) ? mysqli_real_escape_string($con,$_REQUEST['avg_rating']) : "";
			
			//$certificate= isset($_REQUEST['certificate']) ? mysqli_real_escape_string($con,$_REQUEST['certificate']) : "";
			//$doc_name= isset($_REQUEST['doc_name']) ? mysqli_real_escape_string($con,$_REQUEST['doc_name']) : "";
			
			$pic = isset($_REQUEST['pic']) ? mysqli_real_escape_string($con,$_REQUEST['pic']) : "";
			
			$img = $_REQUEST['pic'];
			$image = str_replace(' ', '+', $img);
			$decoded = base64_decode($image);
			$file_name = md5(rand()).'_'.$type.'.jpg';
			file_put_contents('../upload/'.$file_name, $decoded);
			
			if($email=='' && $password=='' && $type=='' && $fname=='' && $lname=='' && $address=='' && $co_id=='' && $s_id=='' && $city_id=='' && $education=='' && $pic==''){
				$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
				echo json_encode($json);
			}
			else{
			
				$query= "select * from `u_login` where `email_id`='$email'";
				$sql=mysqli_query($con,$query);
				if(mysqli_num_rows($sql)==1){
					
					$json = array("result" => "error", "response" =>"","message"=>"already exist!!");
					echo json_encode($json);
				}
				else{
					$date=date("Y-m-d H:i:s");
					$u_insert="insert into `u_login` (`email_id`,`password`,`type`,`datetime`,`admin_status`)VALUES('$email','$password','$type','$date','A')";
					
					$que=mysqli_query($con,$u_insert);
					if($que){
						$select="select * from `u_login` where `email_id`='$email' AND `password`='$password'";
						$sql1=mysqli_query($con,$select);
						$res=mysqli_fetch_array($sql1);
						$user_id=$res['id'];
						
						if($type=='TR'){
							$insert_l="insert into `t_languages` (`tra_id`,`lang_id`,`status`)values('$user_id','1','A'),('$user_id','2','A')";
							$que3=mysqli_query($con,$insert_l);
						}
							
						$insert="insert into `u_details` (`login_id`,`f_name`,`l_name`,`pic`,`address`,`country_id`,`state_id`,`city_id`,`about_us`,`t&c_status`,`email_verification`,`datetime`,`update_datetime`,`admin_doc_veri_status`,`education`,`avg_rating`) values ('$user_id','$fname','$lname','$file_name','$address','$co_id','$s_id','$city_id','$about','1','0','$date','','0','$education','')";
						$sql2=mysqli_query($con,$insert);
						
						$select_d="select * from `u_details` where `login_id`='$user_id'";
						$sql3=mysqli_query($con,$select_d);
						$val=mysqli_fetch_array($sql3);
						$tnc_status=$val['t&c_status'];
						$email_status=$val['email_verification'];
						$admin_status=$val['admin_doc_veri_status'];
						
						$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
						$otp=substr(str_shuffle($data), 0, 6);
						$to=$email;
						$subject='Email Verification';
						$message='Your otp for email-verification : '.$otp; 
						$headers='From:translator@5ivetechnology.com';
						$mail=mail($to,$subject,$message,$headers);
						if ($mail) {
							
							$insert="insert into `email_otp` (`user_id`,`otp`,`datetime`,`status`,`type`) values('$user_id','$otp','$date','A','email')";
							$que2=mysqli_query($con,$insert);
							
							$array[]=array("user_type"=>$type,"login_id"=>$user_id,"t&c_status"=>$tnc_status,"email_verification_status"=>$email_status,"admin_doc_verification_status"=>$admin_status,"otp"=>$otp);
						
							$json = array("result" => "success", "response" =>$array ,"message"=>"signup successfully");
							echo json_encode($json);
						}
						else{
							$json = array("result" => "error", "response" =>"","message"=>"mail not send");
							echo json_encode($json);
						}
						
						
							
					}
					else{
						$json = array("result" => "error", "response" =>"","message"=>"error!!");
						echo json_encode($json);
								
						
					}
				}
			
			}	
		
		
	}
	if($method=='u_update_profile'){
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
		
		
		$date=date("Y-m-d H:i:s");
		$u_id = str_replace('%20', ' ',isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "");
		
		$fname = str_replace('%20', ' ',isset($_REQUEST['fname']) ? mysqli_real_escape_string($con,$_REQUEST['fname']) : "");
		
		$lname = str_replace('%20', ' ',isset($_REQUEST['lname']) ? mysqli_real_escape_string($con,$_REQUEST['lname']) : "");
		
		$address = str_replace('%20', ' ',isset($_REQUEST['address']) ? mysqli_real_escape_string($con,$_REQUEST['address']) : "");
		
		$co_id = str_replace('%20', ' ',isset($_REQUEST['co_id']) ? mysqli_real_escape_string($con,$_REQUEST['co_id']) : "");
		
		$s_id = str_replace('%20', ' ',isset($_REQUEST['s_id']) ? mysqli_real_escape_string($con,$_REQUEST['s_id']) : "");
		
		$city_id = str_replace('%20', ' ',isset($_REQUEST['city_id']) ? mysqli_real_escape_string($con,$_REQUEST['city_id']) : "");
		
		$about = str_replace('%20', ' ', isset($_REQUEST['about']) ? mysqli_real_escape_string($con,$_REQUEST['about']) : "");
		
		$education= str_replace('%20', ' ',isset($_REQUEST['education']) ? mysqli_real_escape_string($con,$_REQUEST['education']) : "");
		
		$ind= str_replace('%20', ' ',isset($_REQUEST['industry']) ? mysqli_real_escape_string($con,$_REQUEST['industry']) : "");
		
		//$avg_rating= isset($_REQUEST['avg_rating']) ? mysqli_real_escape_string($con,$_REQUEST['avg_rating']) : "";
		//$pic = isset($_REQUEST['pic']) ? mysqli_real_escape_string($con,$_REQUEST['pic']) : "";
	
		
		
		$select="select * from `u_login` where `id`='$u_id'";
		$que=mysqli_query($con,$select);
		if(mysqli_num_rows($que)>0){
			$res=mysqli_fetch_array($que);
			$type=$res['type'];
			
			
			
			
			$update="update `u_details` SET `f_name`='$fname',`l_name`='$lname',`address`='$address',`country_id`='$co_id',`state_id`='$s_id',`city_id`='$city_id',`about_us`='$about',`update_datetime`='$date',`education`='$education',`industry_spe`='$ind' where `login_id`='$u_id'";
			
			$sql=mysqli_query($con,$update);
			if($sql){
					$array[]=array("user_type"=>$type,"login_id"=>$u_id);
					$json = array("result" => "success", "response" =>$array,"message"=>"profile has been updated successfully");
					echo json_encode($json);
			}
			else{
				$json = array("result" => "error", "response" =>"","message"=>"error!!");
				echo json_encode($json);
			}
			
		}
		else{
			$json = array("result" => "error", "response" =>"","message"=>"you are not registered user!!");
			echo json_encode($json);
		
		}


	}
	if($method=='u_change_pic'){
		
		
		$date=date("Y-m-d H:i:s");
		$u_id = isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "";
		$pic = isset($_REQUEST['pic']) ? mysqli_real_escape_string($con,$_REQUEST['pic']) : "";
		
		$select="select * from `u_login` where `id`='$u_id'";
		$que=mysqli_query($con,$select);
		if(mysqli_num_rows($que)>0){
			$res=mysqli_fetch_array($que);
			$type=$res['type'];
			
			$img = $_REQUEST['pic'];
			$image = str_replace(' ', '+', $img);
			$decoded = base64_decode($image);
			$file_name = md5(rand()).'_'.$type.'.jpg';
			file_put_contents('../upload/'.$file_name, $decoded);
			
			
			$update="update `u_details` SET `pic`='$file_name',`update_datetime`='$date' where `login_id`='$u_id'";
			
			$sql=mysqli_query($con,$update);
			if($sql){
					$array[]=array("user_type"=>$type,"login_id"=>$u_id);
					$json = array("result" => "success", "response" =>$array,"message"=>"profile pic has been updated successfully");
					echo json_encode($json);
			}
			else{
				$json = array("result" => "error", "response" =>"","message"=>"error!");
				echo json_encode($json);
			}
			
		}
		else{
			$json = array("result" => "error", "response" =>"","message"=>"you are not registered user!");
			echo json_encode($json);
		
		}

	}
	
	if($method=='t_show_payment_mode')
	{		
			$tran_id=str_replace('%20', ' ',isset($_REQUEST['tran_id']) ? mysqli_real_escape_string($con,$_REQUEST['tran_id']) : "");			
			
			if(!isset($_REQUEST['tran_id'])){
				$json = array("result" => "error", "response" =>"" ,"message"=>"translator id is compulsory");
				echo json_encode($json);
			}
			else{
				$select="select * from `account_details` where `user_id`='$tran_id'";
				$que=mysqli_query($con,$select);
				
				if(mysqli_num_rows($que)>0){
					
					$result=mysqli_fetch_array($que);
					$mer_id=$result['mer_id'];
					$public_key=$result['public_key'];
					$pri_key=$result['pri_key'];
					
					$array[] = array("mer_id"=>$mer_id,"pri_key"=>$pri_key,"pub_key"=>$public_key,);
					$json = array("result" => "success", "response" => $array,"message"=>"");
					echo json_encode($json);
				
				}
				else
				{
					
						$json = array("result" => "error", "response" =>"" ,"message"=>"no data available");
						echo json_encode($json);
				
				}
			}
	}
	
	if($method=='t_update_payment_mode')
	{		
			$tran_id=str_replace('%20', ' ',isset($_REQUEST['tran_id']) ? mysqli_real_escape_string($con,$_REQUEST['tran_id']) : "");			
			$mer_id=str_replace('%20', ' ',isset($_REQUEST['mer_id']) ? mysqli_real_escape_string($con,$_REQUEST['mer_id']) : "");
			$pri_key=str_replace('%20', ' ', isset($_REQUEST['pri_key']) ? mysqli_real_escape_string($con,$_REQUEST['pri_key']) : "");
			$pub_key=str_replace('%20', ' ',isset($_REQUEST['pub_key']) ? mysqli_real_escape_string($con,$_REQUEST['pub_key']) : "");
			$user_type=str_replace('%20', ' ',isset($_REQUEST['user_type']) ? mysqli_real_escape_string($con,$_REQUEST['user_type']) : "");
			$pay_mode=str_replace('%20', ' ',isset($_REQUEST['pay_mode']) ? mysqli_real_escape_string($con,$_REQUEST['pay_mode']) : "");
			$date=date("Y-m-d H:i:s");
			
			if(!isset($_REQUEST['tran_id'],$_REQUEST['mer_id'],$_REQUEST['pri_key'],$_REQUEST['pub_key'])){
				$json = array("result" => "error", "response" =>"" ,"message"=>"All parameters are compulsary");
				echo json_encode($json);
			}
			else{
				$select="select * from `account_details` where `user_id`='$tran_id'";
				$que=mysqli_query($con,$select);
				$result=mysqli_fetch_array($que);
				
				if(mysqli_num_rows($que)>0){
					
					$update="update `account_details` SET `pay_mode`='$pay_mode',`mer_id`='$mer_id',`public_key`='$pub_key',`pri_key`='$pri_key' where `user_id`='$tran_id'";
					$que1=mysqli_query($con,$update);
					
					if($que1){

						$json = array("result" => "success", "response" =>"" ,"message"=>"successfully updated payment mode");
						echo json_encode($json);
					}
					else{
						$json = array("result" => "error", "response" =>"" ,"message"=>"error");
						echo json_encode($json);
					}
					
				}
				else{
					
					$insert="insert into `account_details` (`user_id`,`user_type`,`pay_mode`,`mer_id`,`public_key`,`pri_key`,`payment_verified`,`datetime`) values ('$tran_id','$user_type','$pay_mode','$mer_id','$pub_key','$pri_key','1','$date')";
					$sql=mysqli_query($con,$insert);
					if($sql)
					{
						$json = array("result" => "success", "response" =>"" ,"message"=>"successfully added payment mode");
						echo json_encode($json);
					}
					else
					{
						$json = array("result" => "error", "response" =>"" ,"message"=>"error");
						echo json_encode($json);
					}	
				}
			}
	}

	if($method=='c_payment_confirmation')
	{		
			$pro_id=str_replace('%20', ' ',isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "");			
			
			if(!isset($_REQUEST['pro_id'])){
				$json = array("result" => "error", "response" =>"" ,"message"=>"Award id is compulsory");
				echo json_encode($json);
			}
			else{
				$select="select * from `pro_u_awarded` where `pro_id`='$pro_id'";
				$que=mysqli_query($con,$select);
				
				
				if(mysqli_num_rows($que)>0){
					
					$result=mysqli_fetch_array($que);
					$award_id=$result['id'];
					$tra_id=$result['tra_id'];
					$pro_type=$result['pro_type'];
					$cus_id=$result['cus_id'];
					
					$select1="select * from `project` where `id`='$pro_id' AND `project_type`='$pro_type'";
					$que1=mysqli_query($con,$select1);
					$result1=mysqli_fetch_array($que1);
					$pro_name=$result1['project_name'];
					
					$select4="select * from `u_details` where `login_id`='$tra_id'";
					$que4=mysqli_query($con,$select4);
					$result4=mysqli_fetch_array($que4);
					$f_name=$result4['f_name'];
					$l_name=$result4['l_name'];
					
					$select5="select * from `account_details` where `user_id`='$tra_id'";
					$que5=mysqli_query($con,$select5);
					$result5=mysqli_fetch_array($que5);
					$mer_id=$result5['mer_id'];
					$public_key=$result5['public_key'];
					$pri_key=$result5['pri_key'];
					
					//we will find the token id by the use of BT payment gateway keys
					
					$token_id='eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJhYTllNDE3YjI5ZjAyNDNjM2Q0MjAzMTM3ZmQ1YTVjN2RkMmQyZWU5ZGVmYzY5YWNjMzIwZDFiYjRlNjgwZDNlfGNyZWF0ZWRfYXQ9MjAxNy0wNi0xMlQwNDoyNjo0OS4xNjU1OTI5NTUrMDAwMFx1MDAyNm1lcmNoYW50X2lkPTM0OHBrOWNnZjNiZ3l3MmJcdTAwMjZwdWJsaWNfa2V5PTJuMjQ3ZHY4OWJxOXZtcHIiLCJjb25maWdVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvMzQ4cGs5Y2dmM2JneXcyYi9jbGllbnRfYXBpL3YxL2NvbmZpZ3VyYXRpb24iLCJjaGFsbGVuZ2VzIjpbXSwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwiY2xpZW50QXBpVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzLzM0OHBrOWNnZjNiZ3l3MmIvY2xpZW50X2FwaSIsImFzc2V0c1VybCI6Imh0dHBzOi8vYXNzZXRzLmJyYWludHJlZWdhdGV3YXkuY29tIiwiYXV0aFVybCI6Imh0dHBzOi8vYXV0aC52ZW5tby5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIiwiYW5hbHl0aWNzIjp7InVybCI6Imh0dHBzOi8vY2xpZW50LWFuYWx5dGljcy5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tLzM0OHBrOWNnZjNiZ3l3MmIifSwidGhyZWVEU2VjdXJlRW5hYmxlZCI6dHJ1ZSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImRpc3BsYXlOYW1lIjoiQWNtZSBXaWRnZXRzLCBMdGQuIChTYW5kYm94KSIsImNsaWVudElkIjpudWxsLCJwcml2YWN5VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3BwIiwidXNlckFncmVlbWVudFVybCI6Imh0dHA6Ly9leGFtcGxlLmNvbS90b3MiLCJiYXNlVXJsIjoiaHR0cHM6Ly9hc3NldHMuYnJhaW50cmVlZ2F0ZXdheS5jb20iLCJhc3NldHNVcmwiOiJodHRwczovL2NoZWNrb3V0LnBheXBhbC5jb20iLCJkaXJlY3RCYXNlVXJsIjpudWxsLCJhbGxvd0h0dHAiOnRydWUsImVudmlyb25tZW50Tm9OZXR3b3JrIjp0cnVlLCJlbnZpcm9ubWVudCI6Im9mZmxpbmUiLCJ1bnZldHRlZE1lcmNoYW50IjpmYWxzZSwiYnJhaW50cmVlQ2xpZW50SWQiOiJtYXN0ZXJjbGllbnQzIiwiYmlsbGluZ0FncmVlbWVudHNFbmFibGVkIjp0cnVlLCJtZXJjaGFudEFjY291bnRJZCI6ImFjbWV3aWRnZXRzbHRkc2FuZGJveCIsImN1cnJlbmN5SXNvQ29kZSI6IlVTRCJ9LCJjb2luYmFzZUVuYWJsZWQiOmZhbHNlLCJtZXJjaGFudElkIjoiMzQ4cGs5Y2dmM2JneXcyYiIsInZlbm1vIjoib2ZmIn0="';
					
					$array3[] = array("f_name"=>$f_name,"l_name"=>$l_name,"token_id"=>$token_id,);
					
					if($pro_type=="DOC")
					{
					
						$select2="select * from `pro_doc_details` where `pro_id`='$pro_id'";
						$que2=mysqli_query($con,$select2);
						$result2=mysqli_fetch_array($que2);
						$no_of_pages=$result2['no_of_pages'];
						$total_budget=$result2['budget'];
					
						$array2[] = array("pro_name"=>$pro_name,"no_of_pages"=>$no_of_pages,"total_budget"=>$total_budget,);
						$json = array("result" => "success", "response" => ['project_details'=> $array2,'translator_detail'=> $array3] ,"message"=>"");
						echo json_encode($json);
						
					}
					else
					{
						$select_a="select * from `pro_u_awarded` where `pro_id`='$pro_id'";
						$que_a=mysqli_query($con,$select_a);
						$res_a=mysqli_fetch_array($que_a);
						$award_id=$res_a['id'];
						
						$select_pro="select * from `pro_calling_details` where `awarded_id`='$award_id'";
						//echo $select_pro;
						$query=mysqli_query($con,$select_pro);
						if(mysqli_num_rows($query)>0){
							while($res_pro=mysqli_fetch_array($query)){
								$time=$res_pro['total_time'];
								$budget=$res_pro['budget'];
								
								$time1 = $time1+$time;
								$budget1 = $budget1+$budget;
							}
							
							//here we will calculate total time & behalf of it total budget and process will do when we will create calling api
							$total_time=$time1; 
							$total_budget=$budget1;

							$array[] = array("pro_name"=>$pro_name,"total_time"=>$total_time,"total_budget"=>$total_budget,);
							$json = array("result" => "success", "response" => ['project_details'=> $array,'translator_detail'=> $array3] ,"message"=>"");
							echo json_encode($json);
						}
						else{
						
							$total_time="0"; 
							$total_budget="0";

							$array[] = array("pro_name"=>$pro_name,"total_time"=>$total_time,"total_budget"=>$total_budget,);
							$json = array("result" => "success", "response" => ['project_details'=> $array,'translator_detail'=> $array3] ,"message"=>"");
							
							//$json = array("result" => "error", "response" =>"","message"=>"no data available");
							echo json_encode($json);
						}
												
					}					
				}
				else
				{
					
						$json = array("result" => "error", "response" =>"" ,"message"=>"project id is not correct");
						echo json_encode($json);
					
				}
			}
	}	
	
	
	if($method=='c_payment_successfully')
	{		
			$pro_id=str_replace('%20', ' ',isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "");			
			$total_amount=str_replace('%20', ' ',isset($_REQUEST['total_amount']) ? mysqli_real_escape_string($con,$_REQUEST['total_amount']) : "");
			$paid_amount=str_replace('%20', ' ',isset($_REQUEST['paid_amount']) ? mysqli_real_escape_string($con,$_REQUEST['paid_amount']) : "");
			$remaining_amount=str_replace('%20', ' ',isset($_REQUEST['remaining_amount']) ? mysqli_real_escape_string($con,$_REQUEST['remaining_amount']) : "");
			$pay_via=str_replace('%20', ' ',isset($_REQUEST['pay_via']) ? mysqli_real_escape_string($con,$_REQUEST['pay_via']) : "");
			$pay_status=str_replace('%20', ' ',isset($_REQUEST['pay_status']) ? mysqli_real_escape_string($con,$_REQUEST['pay_status']) : "");
			$date=date("Y-m-d H:i:s");
			
			if(!isset($_REQUEST['pro_id'])){
				$json = array("result" => "error", "response" =>"" ,"message"=>"project id is compulsory");
				echo json_encode($json);
			}
			else{
				$select="select * from `pro_u_awarded` where `pro_id`='$pro_id'";
				$que=mysqli_query($con,$select);
				
				if(mysqli_num_rows($que)>0){
					
					$result=mysqli_fetch_array($que);
					$award_id=$result['id'];
					$cus_id=$result['cus_id'];
					$tra_id=$result['tra_id'];
					$pro_type=$result['pro_type'];
					
					$select_acc="select * from `account_details` where `user_id`='$tra_id'";
					$que_acc=mysqli_query($con,$select_acc);
					$result_acc=mysqli_fetch_array($que_acc);
					$to_accc_id=$result_acc['id'];
					
					$select2="select * from `pro_u_transaction` where `awarded_id`='$award_id'";
					$que2=mysqli_query($con,$select2);
					$result2=mysqli_fetch_array($que2);
					
					if(mysqli_fetch_array($que2))
					{
					
						$update="update `pro_u_transaction` SET `total_amount`='$total_amount',`paid_amount`='$paid_amount',`remaining_amount`='$remaining_amount',`pay_via`='$pay_via',`pay_status`='$pay_status',`cus_id`='$cus_id',`to_acc_id`='$to_accc_id',`datetime`='$date' where `awarded_id`='$award_id'";

						$que4=mysqli_query($con,$update);
						
					}
					else
					{
												
						$insert="insert into `pro_u_transaction` (`awarded_id`,`total_amount`,`paid_amount`,`remaining_amount`,`pay_via`,`pay_status`,`cus_id`,`to_acc_id`,`datetime`)values('$award_id','$total_amount','$paid_amount','$remaining_amount','$pay_via','$pay_status','$cus_id','$to_acc_id','$date')";

						$que3=mysqli_query($con,$insert);
												
					}	

					if($pay_status=="P")
						{
							$update1="update `pro_u_awarded` SET `pay_status`='$pay_status' where `id`='$award_id'";
						
							$que5=mysqli_query($con,$update1);
						}
						
						$json = array("result" => "success", "response" => "" ,"message"=>"payment done successfully");
						echo json_encode($json);
					
				}
				else
				{
					
						$json = array("result" => "error", "response" =>"" ,"message"=>"project id is not correct");
						echo json_encode($json);
					
				}
			}
	}
	
	
	if($method=='t_pro_accept'){
		
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
			
			$pro_id=str_replace('%20', ' ', isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "");
			
			$tra_id=str_replace('%20', ' ',isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "");
			
			$action=str_replace('%20', ' ', isset($_REQUEST['action']) ? mysqli_real_escape_string($con,$_REQUEST['action']) : "");
			
			if($action=='accept'){
				
				$update="update `pro_u_invite` SET `accepted_status`='AC' where `pro_id`='$pro_id' AND `tra_id`='$tra_id'";
				$que=mysqli_query($con,$update);
				
				$array[]=array("project_id"=>$pro_id);
				$json = array("result" => "success", "response" =>$array,"message"=>"project accepted");
				echo json_encode($json);
			
			}
			elseif($action=='decline'){
				
				$update1="update `pro_u_invite` SET `accepted_status`='DE' where `pro_id`='$pro_id' AND `tra_id`='$tra_id'";
				$que1=mysqli_query($con,$update1);
				
				$array1[]=array("project_id"=>$pro_id);
				$json = array("result" => "success", "response" =>$array1,"message"=>"project declined");
				echo json_encode($json);
			}
			
	}
	if($method=='t_pro_upload_doc'){
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
	
		$date=date("Y-m-d H:i:s");
		$pro_id=str_replace('%20', ' ',isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "");
		
		$doc_name=str_replace('%20', ' ',isset($_REQUEST['doc_name']) ? mysqli_real_escape_string($con,$_REQUEST['doc_name']) : "");
		
		$exe='pdf';	
		if(!isset($_REQUEST['pro_id'],$_REQUEST['doc_name'])){
			$json = array("result" => "error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
		}
		else{
			$doc = $_REQUEST['document'];
			//$file = str_replace(' ', '+', $doc);
			$decoded = base64_decode($doc);
			$file_name = md5(rand()).'_'.'.'.$exe;
			file_put_contents('../doc_file/'.$file_name, $decoded);
			
			$select="select * from `pro_u_awarded` where `pro_id`='$pro_id'";
			$que=mysqli_query($con,$select);
			$res=mysqli_fetch_array($que);
			$award_id=$res['id'];
			
			$insert="insert into `pro_doc_submitted` (`awarded_id`,`document`,`doc_name`,`datetime`,`status`) values ('$award_id','$file_name','$doc_name','$date','1')";
			$que1=mysqli_query($con,$insert);
			if($que1){
				$array[]=array("project_id"=>$pro_id);
				$json = array("result" => "success", "response" =>$array,"message"=>"document uploaded successfully");
				echo json_encode($json);
				
			}
			else{
				
				$json = array("result" => "error", "response" =>"","message"=>"error!");
				echo json_encode($json);
			}
			
		}
	}

	if($method=='c_calling'){
		$date=date("Y-m-d H:i:s");
		$pro_id=str_replace('%20', ' ',isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "");
		$start_time=str_replace('%20', ' ',isset($_REQUEST['start_time']) ? mysqli_real_escape_string($con,$_REQUEST['start_time']) : "");
		$end_time=str_replace('%20', ' ',isset($_REQUEST['end_time']) ? mysqli_real_escape_string($con,$_REQUEST['end_time']) : "");
		$progress_time=str_replace('%20', ' ',isset($_REQUEST['progress_time']) ? mysqli_real_escape_string($con,$_REQUEST['progress_time']) : "");
		$establish_time=str_replace('%20', ' ',isset($_REQUEST['establish_time']) ? mysqli_real_escape_string($con,$_REQUEST['establish_time']) : "");
		
			
		if(!isset($_REQUEST['pro_id'])){
			$json = array("result" => "error", "response" =>"All parameters are compulsory");
			echo json_encode($json);
		}
		else{
			
			//Time Converting
			$from_time = date('Y-m-d H:i:s', $start_time);
			$to_time = date('Y-m-d H:i:s', $end_time);
			
			$timeFirst  = strtotime($from_time);
			$timeSecond = strtotime($to_time);
			$differenceInSeconds = $timeSecond - $timeFirst;
			
			$total_time = $differenceInSeconds/3600 ;
			//$total_time = round(abs($to_time - $from_time) / 60,2);;
			
			//Finding per hour rate
			$select1="select * from `m_rate` where `type`='PH' and `status`='A'";
			$que1=mysqli_query($con,$select1);
			$res1=mysqli_fetch_array($que1);
			$rate=$res1['rate'];
			
			$budget= $rate * $total_time;
			
			//Finding awarded_id
			$select="select * from `pro_u_awarded` where `pro_id`='$pro_id'";
			$que=mysqli_query($con,$select);
			$res=mysqli_fetch_array($que);
			$award_id=$res['id'];
			
			//Inserting the call time duration with budget
			$insert="insert into `pro_calling_details` (`awarded_id`,`from_time`,`to_time`,`total_time`,`budget`,`current_datetime`) values ('$award_id','$from_time','$to_time','$differenceInSeconds','$budget','$date')";
			$que2=mysqli_query($con,$insert);
			if($que2){
				$array[]=array("project_id"=>$pro_id);
				$json = array("result" => "success", "response" =>$array,"message"=>"call ended");
				echo json_encode($json);
				
			}
			else{	
				$json = array("result" => "error", "response" =>"","message"=>"value not inserting");
				echo json_encode($json);
			}
		}
	}
	
	if($method=='c_change_working_status'){
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
		
			$date=date("Y-m-d H:i:s");
			$pro_id=str_replace('%20', ' ',isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "");
			
			$cus_id=str_replace('%20', ' ',isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "");
			
			$action=str_replace('%20', ' ',isset($_REQUEST['action']) ? mysqli_real_escape_string($con,$_REQUEST['action']) : "");
			
			if($action=='complete'){
				$update_a="update `pro_u_awarded` SET `running_status`='CM'  where `pro_id`='$pro_id' AND `cus_id`='$cus_id'";
				$que=mysqli_query($con,$update_a);
				if($que){
					$update="update `project` SET `running_status`='CM' ,`complete_datetime`='$date' where `id`='$pro_id' AND `cus_id`='$cus_id'";
					$sql=mysqli_query($con,$update);
					
					$array[]=array("project_id"=>$pro_id);
					$json = array("result" => "success", "response" =>$array,"message"=>"successfully changed");
					echo json_encode($json);
				}
				else{
				
					$json = array("result" => "error", "response" =>"","message"=>"error!");
					echo json_encode($json);
				}
			}
			elseif($action=='cancel'){
				$update_a="update `pro_u_awarded` SET `running_status`='CL'  where `pro_id`='$pro_id' AND `cus_id`='$cus_id'";
				$que=mysqli_query($con,$update_a);
				if($que){
					$update="update `project` SET `running_status`='CL' ,`complete_datetime`='$date' where `id`='$pro_id' AND `cus_id`='$cus_id'";
					$sql=mysqli_query($con,$update);
					
					$array[]=array("project_id"=>$pro_id);
					$json = array("result" => "success", "response" =>$array,"message"=>"successfully changed");
					echo json_encode($json);
				}
				else{
				
					$json = array("result" => "error", "response" =>"","message"=>"error!");
					echo json_encode($json);
				}
			}
			
		

	}
	if($method=='c_award_ping_pro'){
			$path =$_SERVER["REQUEST_URI"];
			$url= str_replace('%20', ' ',$path);
			
			$date=date("Y-m-d H:i:s");
			$pro_id=str_replace('%20', ' ',isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "");
			
			$tra_id=str_replace('%20', ' ',isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "");
			
			$cus_id=str_replace('%20', ' ',isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "");
			
			$select="select * from `pro_u_awarded` where `pro_id`='$pro_id'";
			$que=mysqli_query($con,$select);
			if(mysqli_num_rows($que)==1){
				
				$json = array("result" => "error", "response" =>"","message"=>"already awarded");
				echo json_encode($json);
				
			}
			else{
				$select_pro="select * from `project` where `id`='$pro_id'";
				$sql=mysqli_query($con,$select_pro);
				$res=mysqli_fetch_array($sql);
				$pro_type=$res['project_type'];
				
				$insert="insert into `pro_u_awarded` (`pro_id`,`tra_id`,`pro_type`,`datetime`,`pay_status`,`running_status`,`cus_id`)values('$pro_id','$tra_id','$pro_type','$date','NP','W','$cus_id')";
				$sql1=mysqli_query($con,$insert);
				if($sql1){
					
					$select_a="select * from `pro_u_awarded` where  `pro_id`='$pro_id'";
					$query=mysqli_query($con,$select_a);
					$result=mysqli_fetch_array($con,$query);
					$award_id=$result['id'];
					
					$update="update `project` SET `running_status`='W' where `id`='$pro_id'";
					$que2=mysqli_query($con,$update);
					if($que2){
						
						$array[]=array("awarded_id"=>$award_id);
						
					}
					
					
					
				}
				$json = array("result" => "success", "response" =>$array,"message"=>"successfully awarded");
				echo json_encode($json);
				
			}
			
		

		
	}
	if($method=='t_client_detail'){
		
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
		
		$cus_id=str_replace('%20', ' ', isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "");
		
		if($cus_id==''){
			$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
			echo json_encode($json);
		}
		else{
			$select="select * from `u_details` LEFT OUTER JOIN `country` ON `u_details`.`country_id`=`country`.`id` LEFT OUTER JOIN `state` ON `u_details`.`state_id`=`state`.`id` LEFT OUTER JOIN `city` ON `u_details`.`city_id`=`city`.`id` LEFT OUTER JOIN `u_login` ON `u_details`.`login_id`=`u_login`.`id`  where `u_details`.`login_id`='$cus_id' ";
			$que=mysqli_query($con,$select);
			$res=mysqli_fetch_array($que);
			
			$array=array("cus_fname"=>$res['f_name'],"cus_lname"=>$res['l_name'],"pic"=>"http://5ivetechnology.com/projects/true-translator/upload/".$res['pic'],"coun_id"=>$res['country_id'],"state_id"=>$res['state_id'],"city_id"=>$res['city_id'],"country_name"=>$res['country_name'],"state_name"=>$res['state_name'],"city_name"=>$res['city_name'],"address"=>$res['address'],"email_id"=>$res['email_id'],"about_us"=>$res['about_us'],"education"=>$res['education']);
			$json = array("result" => "success", "response" =>$array,"message"=>"");
			echo json_encode($json);
		}
		
		
	}
	if($method=='t_client_job'){
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
		
		$cus_id= str_replace('%20', ' ',isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "");
		
		if($cus_id==''){
			$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
			echo json_encode($json);
		}
		else{
		
			$select_pro="select *,`project`.`id` AS `pro_id` from `u_details` RIGHT JOIN `project` ON `u_details`.`login_id`=`project`.`cus_id`  LEFT JOIN `country` ON `u_details`.`country_id`=`country`.`id` LEFT JOIN `state` ON `u_details`.`state_id`=`state`.`id` LEFT JOIN `city` ON `u_details`.`city_id`=`city`.`id` where `u_details`.`login_id`='$cus_id' AND `project`.`running_status` IN ('CM','CL')";
			//echo $select_pro;
			$query=mysqli_query($con,$select_pro);
			if(mysqli_num_rows($query)>0){
				while($res1=mysqli_fetch_array($query)){
					$project_id=$res1['pro_id'];
					
					$select_rat="select * from `pro_review_rating` where `pro_id`='$project_id' AND `status`='A'";
					//echo $select_rat;
					$sql_rat=mysqli_query($con,$select_rat);
					$res_rat=mysqli_fetch_array($sql_rat);
					
					$rating=$res_rat['rating'];
					$review=$res_rat['review'];
					if($rating==''){
						$rat="not given";
					}
					else{
						$rat=$rating;
					}
					if($review==''){
						$rev="not given";
					}
					else{
						$rev=$review;
					}
					
					$array1[]=array("pro_name"=>$res1['project_name'],"country_name"=>$res1['country_name'],"state_name"=>$res1['state_name'],"city_name"=>$res1['city_name'],"running_status"=>$res1['running_status'],"rating"=>$rat,"review"=>$rev);
					
					
				}
				$json = array("result" => "success", "response" =>$array1,"message"=>"");
				echo json_encode($json);
			}
			else{
				$json = array("result" => "error", "response" =>"","message"=>"no data available");
				echo json_encode($json);
			}
		}
	}
	if($method=='project_working_detail'){
		
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
		
		$pro_id=str_replace('%20', ' ', isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "");
		
		if($pro_id==''){
			$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
			echo json_encode($json);
		}
		else{
			$select="SELECT * FROM  `pro_u_awarded` WHERE  `pro_u_awarded`.`pro_id` = '$pro_id'";
			$sql=mysqli_query($con,$select);
			if(mysqli_num_rows($sql)>0){
				$res=mysqli_fetch_array($sql);
				$pro_type=$res['pro_type'];
				$aw_id=$res['id'];
				if($pro_type=='DOC'){
					$select_doc="select * from `pro_doc_submitted` where `awarded_id`='$aw_id'";
					$sql5=mysqli_query($con,$select_doc);
					if(mysqli_num_rows($sql5)>0){
						while($res6=mysqli_fetch_array($sql5)){
							 
							$array[]=array("pro_id"=>$pro_id,"doc_name"=>$res6['doc_name'],"datetime"=>$res6['datetime'],"document"=>"http://5ivetechnology.com/projects/true-translator/doc_file/".$res6['document']);
						}
						$json = array("result" => "success", "response" =>$array,"message"=>"");
						echo json_encode($json);
					}
					else{
						$json = array("result" => "error", "response" =>"","message"=>"no data available");
						echo json_encode($json);
					}
				}
				elseif($pro_type=='LIV'){
					
					$select_cl="select * from `pro_calling_details` where `awarded_id`='$aw_id'";
					$sql1=mysqli_query($con,$select_cl);
					if(mysqli_num_rows($sql1)>0){
						while($res1=mysqli_fetch_array($sql1)){
							 
							$array1[]=array("pro_id"=>$pro_id,"date"=>$res1['date'],"from_time"=>$res1['from_time'],"to_time"=>$res1['to_time'],"total_time"=>$res1['total_time'],"budget"=>$res1['budget']);
						}
						$json = array("result" => "success", "response" =>$array1,"message"=>"");
						echo json_encode($json);
					}
					else{
						$json = array("result" => "error", "response" =>"","message"=>"no data available");
						echo json_encode($json);
					}
				}
				
			}
			else{
				$json = array("result" => "error", "response" =>"","message"=>"no data available");
				echo json_encode($json);
			}
		}
	
	}
	if($method=='c_translator_list'){
		
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
		
		$select="SELECT * FROM  `u_details` RIGHT OUTER JOIN  `u_login` ON  `u_details`.`login_id` =  `u_login`.`id` WHERE  `u_login`.`type` =  'TR' AND `u_login`.`admin_status`='A'";
		$que=mysqli_query($con,$select);
		if(mysqli_num_rows($que)>0){
			while($res=mysqli_fetch_array($que)){
				$id=$res['login_id'];
				$fname=$res['f_name'];
				$lname=$res['l_name'];
				$pic=$res['pic'];
				$city_id=$res['city_id'];
				$s_id=$res['state_id'];
				$coun_id=$res['country_id'];
				$main_l=$res['main_lang'];
				$con_l=$res['conversion_lang'];
				$address=$res['address'];
				
						
				$que1="Select * from `city` where id='$city_id'";
				$sql1=mysqli_query($con,$que1);
				$res=mysqli_fetch_array($sql1);
				$city_name=$res['city_name'];
								
				$que2="Select * from `state` where `id`='$s_id'";
				$sql2 = mysqli_query($con,$que2);
				$res1=mysqli_fetch_array($sql2);
				$s_name=$res1['state_name'];

				$que3="Select * from `country` where `id`='$coun_id'";
				$sql3 = mysqli_query($con,$que3);
				$res2=mysqli_fetch_array($sql3);
				$c_name=$res2['country_name'];
				
				$select_l="SELECT GROUP_CONCAT(language) FROM `t_languages` LEFT JOIN  `m_language` ON  `t_languages`.`lang_id` =  `m_language`.`id` WHERE tra_id ='$id'";
				//echo $select_l;
				$que5=mysqli_query($con,$select_l);
				$res7=mysqli_fetch_array($que5);
					$lang=$res7['GROUP_CONCAT(language)'];
					
				
					$array[]=array("tra_id"=>$id,"tra_fname"=>$fname,"tra_lname"=>$lname,"pic"=>"http://5ivetechnology.com/projects/true-translator/upload/".$pic,"city"=>$city_name,"state"=>$s_name,"country"=>$c_name,"address"=>$address,"lang_skill"=>$lang);
				
			}
			$json = array("result" => "success", "response" =>$array,"message"=>"");
			echo json_encode($json);
		}
		else{	
			$json = array("result" => "error", "response" =>"","message"=>"no data available");
			echo json_encode($json);
		}
	}
	if($method=='hire_pro_doc'){
		
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
		
		$date=date("Y-m-d H:i:s");
		$tra_id= str_replace('%20', ' ', isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "");
		
		$cus_id=str_replace('%20', ' ',isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "");
		
		$project_name=str_replace('%20', ' ',isset($_REQUEST['project_name']) ? mysqli_real_escape_string($con,$_REQUEST['project_name']) : "");
		
		$project_desc=str_replace('%20', ' ',isset($_REQUEST['project_desc']) ? mysqli_real_escape_string($con,$_REQUEST['project_desc']) : "");
		
		$ind_type=str_replace('%20', ' ',isset($_REQUEST['ind_type']) ? mysqli_real_escape_string($con,$_REQUEST['ind_type']) : "");
		
		$main_lang=str_replace('%20', ' ',isset($_REQUEST['main_lang']) ? mysqli_real_escape_string($con,$_REQUEST['main_lang']) : "");
		
		$con_lang=str_replace('%20', ' ',isset($_REQUEST['con_lang']) ? mysqli_real_escape_string($con,$_REQUEST['con_lang']) : "");
		
		$time=str_replace('%20', ' ', isset($_REQUEST['time']) ? mysqli_real_escape_string($con,$_REQUEST['time']) : "");
		
		$no_page=str_replace('%20', ' ',isset($_REQUEST['no_page']) ? mysqli_real_escape_string($con,$_REQUEST['no_page']) : "");
		
		//$document=isset($_REQUEST['document']) ? mysqli_real_escape_string($con,$_REQUEST['document']) : "";	
		$pro_type=str_replace('%20', ' ',isset($_REQUEST['pro_type']) ? mysqli_real_escape_string($con,$_REQUEST['pro_type']) : "");
		
		$for_type=str_replace('%20', ' ', isset($_REQUEST['for_type']) ? mysqli_real_escape_string($con,$_REQUEST['for_type']) : "");
		
		$budget=str_replace('%20', ' ',isset($_REQUEST['budget']) ? mysqli_real_escape_string($con,$_REQUEST['budget']) : "");
		
		$exe="pdf";

		$doc = $_REQUEST['document'];
		//$file = str_replace(' ', '+', $doc);
		$decoded = base64_decode($doc);
		$file_name = md5(rand()).'_'.$pro_type.".".$exe;
		file_put_contents('../doc_file/'.$file_name, $decoded);
		$path='http://5ivetechnology.com/projects/true-translator/doc_file/'.$file_name;
		
		if(!isset($_REQUEST['cus_id'],$_REQUEST['project_name'],$_REQUEST['ind_type'],$_REQUEST['main_lang'],$_REQUEST['con_lang'],$_REQUEST['time'],$_REQUEST['no_page'],$_REQUEST['document'],$_REQUEST['pro_type'],$_REQUEST['for_type'])){
			$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
			echo json_encode($json);
		}
		else{
			$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
			$random=substr(str_shuffle($data), 0, 6);
			
			$insert="insert into `project` (`cus_id`,`project_name`,`main_lang`,`conversion_lang`,`project_type`,`project_desc`,`status`,`running_status`,`for_project`,`datetime`,`rand_no`)values('$cus_id','$project_name','$main_lang','$con_lang','$pro_type','$project_desc','A','O','$for_type','$date','$random')";

			$que=mysqli_query($con,$insert);
			
			if($que){
				
				$select="select * from `project` where `cus_id`='$cus_id' AND `rand_no`='$random' order by `cus_id` DESC LIMIT 1";
				$que7=mysqli_query($con,$select);
				$res7=mysqli_fetch_array($que7);
				$pro_id=$res7['id'];
				
				
				if($pro_type=='DOC'){
					$insert_doc="insert into `pro_doc_details` (`pro_id`,`industry_type`,`document`,`no_of_pages`,`budget`,`datetime`,`for_project`)values('$pro_id','$ind_type','$file_name','$no_page','$budget','$time','$for_type')";
					$sql1=mysqli_query($con,$insert_doc);
					if($sql1){
						
						$insert_i="insert into `pro_u_invite` (`pro_id`,`tra_id`,`invite_status`,`ping_status`,`accepted_status`,`datetime`)values('$pro_id','$tra_id','1','0','','$date')";
						$que2=mysqli_query($con,$insert_i);
						if($que2){
							$json = array("result" => "success", "response" =>"","message"=>"success!");
							echo json_encode($json);
						}
						else{
							$json = array("result" => "error", "response" =>"","message"=>"error!");
							echo json_encode($json);
						}
						
					}
					
					
				}
				else{
					$json = array("result" => "error", "response" =>"","message"=>"your projecttype is not DOC project!");
					echo json_encode($json);
					
				}
				
			}else{
				
				$json = array("result" => "error", "response" =>"","message"=>"error!");
				echo json_encode($json);
			}
		}
			
	}
	if($method=='hire_pro_live'){
		
				
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
	
		$date=date("Y-m-d H:i:s");
		$tra_id=str_replace('%20', ' ',isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "");
		
		$cus_id=str_replace('%20', ' ', isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "");
		
		$project_name=str_replace('%20', ' ',isset($_REQUEST['project_name']) ? mysqli_real_escape_string($con,$_REQUEST['project_name']) : "");
		
		$project_desc=str_replace('%20', ' ',isset($_REQUEST['project_desc']) ? mysqli_real_escape_string($con,$_REQUEST['project_desc']) : "");
		
		$main_lang=str_replace('%20', ' ',isset($_REQUEST['main_lang']) ? mysqli_real_escape_string($con,$_REQUEST['main_lang']) : "");
		
		$con_lang=str_replace('%20', ' ',isset($_REQUEST['con_lang']) ? mysqli_real_escape_string($con,$_REQUEST['con_lang']) : "");
		
		$from_time=str_replace('%20', ' ', isset($_REQUEST['from_time']) ? mysqli_real_escape_string($con,$_REQUEST['from_time']) : "");
		
		$to_time=str_replace('%20', ' ', isset($_REQUEST['to_time']) ? mysqli_real_escape_string($con,$_REQUEST['to_time']) : "");
		
		$pro_type=str_replace('%20', ' ', isset($_REQUEST['pro_type']) ? mysqli_real_escape_string($con,$_REQUEST['pro_type']) : "");
		
		$budget=str_replace('%20', ' ',isset($_REQUEST['budget']) ? mysqli_real_escape_string($con,$_REQUEST['budget']) : "");
		
		$for_type=str_replace('%20', ' ',isset($_REQUEST['for_type']) ? mysqli_real_escape_string($con,$_REQUEST['for_type']) : "");
		
		$date1=str_replace('%20', ' ',isset($_REQUEST['date']) ? mysqli_real_escape_string($con,$_REQUEST['date']) : "");
		
		
		if(!isset($_REQUEST['tra_id'],$_REQUEST['cus_id'],$_REQUEST['project_name'],$_REQUEST['main_lang'],$_REQUEST['con_lang'],$_REQUEST['from_time'],$_REQUEST['to_time'],$_REQUEST['pro_type'],$_REQUEST['for_type'],$_REQUEST['date'])){
			$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
			echo json_encode($json);
		}
		else{
			$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
			$random=substr(str_shuffle($data), 0, 6);
			
			$insert="insert into `project` (`cus_id`,`project_name`,`main_lang`,`conversion_lang`,`project_type`,`project_desc`,`status`,`running_status`,`for_project`,`datetime`,`rand_no`)values('$cus_id','$project_name','$main_lang','$con_lang','$pro_type','$project_desc','A','O','$for_type','$date','$random')";

			$que=mysqli_query($con,$insert);
			
			if($que){
				$select="select * from `project` where `cus_id`='$cus_id' AND `rand_no`='$random' order by `cus_id` DESC LIMIT 1";
				$que7=mysqli_query($con,$select);
				$res7=mysqli_fetch_array($que7);
				$pro_id=$res7['id'];
				
				
				if($pro_type=='LIV'){
					
					//Time Converting
					//$start_time = date('H:iA', $from_time);
					//$end_time = date('H:iA', $to_time);
					
					
			
					$timeFirst  = strtotime($from_time);
					$timeSecond = strtotime($to_time);
					$differenceInSeconds = $timeSecond - $timeFirst;
			
					//$total_time_in_sec = $differenceInSeconds;
					$total_time_in_hour = $differenceInSeconds/3600;
					
					//echo $total_time;
					//$total_time = round(abs($to_time - $from_time) / 60,2);;
			
					//Finding per hour rate
					$select1="select * from `m_rate` where `type`='PH' and `status`='A'";
					$que1=mysqli_query($con,$select1);
					$res1=mysqli_fetch_array($que1);
					$rate=$res1['rate'];
			
					$budget= $rate * $total_time_in_hour;
					
					$insert_liv="INSERT INTO `pro_live_details` (`id`, `pro_id`, `date`, `from_time`, `to_time`, `total_time`, `budget`, `for_pro`) VALUES ('null','$pro_id','$date1','$from_time','$to_time','$differenceInSeconds','$budget','$for_type')";
					//echo $insert_liv;
					$sql1=mysqli_query($con,$insert_liv);
					if($sql1){
						$insert_i="insert into `pro_u_invite` (`pro_id`,`tra_id`,`invite_status`,`ping_status`,`accepted_status`,`datetime`)values('$pro_id','$tra_id','1','0','','$date')";
						$que2=mysqli_query($con,$insert_i);
						if($que2){
							$json = array("result" => "success", "response" =>"","message"=>"success!");
							echo json_encode($json);
						}
						else{
							$json = array("result" => "error", "response" =>"","message"=>"error!");
							echo json_encode($json);
						}
						
					}
					
					
				}
				else{
					$json = array("result" => "error", "response" =>"","message"=>"your projecttype is not LIVE project!");
					echo json_encode($json);
					
				}
				
			}else{
				
				$json = array("result" => "error", "response" =>"","message"=>"error!");
				echo json_encode($json);
			}
		}
			

	}
	if($method=='c_translator_job'){
		$path =$_SERVER["REQUEST_URI"];
		$url= str_replace('%20', ' ',$path);
		
		$tra_id= str_replace('%20', ' ',isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "");
		
		if($tra_id==''){
			$json = array("result" => "error", "response" =>"All parameters are compulsary","message"=>"");
			echo json_encode($json);
		}
		else{
		
			$select_pro="select * from `u_details` RIGHT JOIN `pro_u_awarded` ON `u_details`.`login_id`=`pro_u_awarded`.`tra_id` RIGHT JOIN `project` ON `pro_u_awarded`.`pro_id`=`project`.`id`  LEFT JOIN `country` ON `u_details`.`country_id`=`country`.`id` LEFT JOIN `state` ON `u_details`.`state_id`=`state`.`id` LEFT JOIN `city` ON `u_details`.`city_id`=`city`.`id`where `pro_u_awarded`.`tra_id`='$tra_id' AND `pro_u_awarded`.`running_status` IN ('CM','CL')";
			//echo $select_pro;
			$query=mysqli_query($con,$select_pro);
			if(mysqli_num_rows($query)>0){
				while($res1=mysqli_fetch_array($query)){
					$project_id=$res1['pro_id'];
					$pro_type=$res1['project_type'];
					$select_rat="select * from `pro_review_rating` where `pro_id`='$project_id' AND `status`='A'";
					//echo $select_rat;
					$sql_rat=mysqli_query($con,$select_rat);
					$res_rat=mysqli_fetch_array($sql_rat);
					
					$rating=$res_rat['rating'];
					$review=$res_rat['review'];
					if($rating==''){
						$rat="not given";
					}
					else{
						$rat=$rating;
					}
					if($review==''){
						$rev="not given";
					}
					else{
						$rev=$review;
					}
					
					$array1[]=array("pro_id"=>$project_id,"pro_name"=>$res1['project_name'],"pro_type"=>$pro_type,"country_name"=>$res1['country_name'],"state_name"=>$res1['state_name'],"city_name"=>$res1['city_name'],"running_status"=>$res1['running_status'],"rating"=>$rat,"review"=>$rev);
					
					
				}
				$json = array("result" => "success", "response" =>$array1,"message"=>"");
				echo json_encode($json);
			}
			else{
				$json = array("result" => "error", "response" =>"","message"=>"no data available");
				echo json_encode($json);
			}
		}
	}
	
}


?>