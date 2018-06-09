<?php
require_once("../config.php");
	if($_SERVER['REQUEST_METHOD'] == "GET"){
 
		$email = isset($_REQUEST['email']) ? mysqli_real_escape_string($con,$_REQUEST['email']) : "";
		$password = isset($_REQUEST['password']) ? mysqli_real_escape_string($con,$_REQUEST['password']) : "";
		
		if($email=="" && $password==""){
			$res=array("result"=>"error","response"=>"Unknown Error");
			echo json_encode($res);
		}else{
			$query= "select * from `u_login` where `email_id`='$email' AND `password`='$password'";
			$sql=mysqli_query($con,$query);
			if(mysqli_num_rows($sql)==1){
				$result = mysqli_fetch_array($sql);
				if($result['admin_status']=='A'){
					$id=$result['id'];
					$type=$result['type'];
					
					$select_d="select * from `u_details` where `login_id`='$id'";
					$sql3=mysqli_query($con,$select_d);
					$val=mysqli_fetch_array($sql3);
					$tnc_status=$val['t&c_status'];
					$email_status=$val['email_verification'];
					$admin_status=$val['admin_doc_veri_status'];
					
					if($type =='TR'){
						if($email_status=='1'){
							if($admin_status=='1'){
								
								$array[] = array("id"=>$id,"email_id"=>$email,"t&c_status"=>$tnc_status,"email_verification_status"=>$email_status,"admin_doc_verification_status"=>$admin_status);
								$json = array("result" => "Success", "response" => $array);
								echo json_encode($json);
							}
							else{
								$json = array("result" => "Error", "response" => "Please submit your documents");
								echo json_encode($json);
							}
						}	
					
						else{
							$json = array("result" => "Error", "response" => "Please verify your email id");
							echo json_encode($json);
						}
					}
					elseif($type =='CU'){
						if($email_status=='1'){
							$array[] = array("id"=>$id,"email_id"=>$email,"t&c_status"=>$tnc_status,"email_verification_status"=>$email_status,"admin_doc_verification_status"=>$admin_status);
							$json = array("result" => "Success", "response" => $array);
							echo json_encode($json);
							
						}
						else{
							
							$json = array("result" => "Error", "response" => "Please verify your email id");
							echo json_encode($json);
						}
					}
					
				}else{
					$json = array("result" => "Error", "response" =>"Your profile is deactive please contact to the admin");
					echo json_encode($json);
				}
	
			}
			else{
				$json = array("result" => "Error", "response" =>"Invalid email_id and password!!");
				echo json_encode($json);
			}
			
		}
	}
mysqli_close($con);
?>