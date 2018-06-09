<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	//$u_id = isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "";
	$email = isset($_REQUEST['email']) ? mysqli_real_escape_string($con,$_REQUEST['email']) : "";
	$password = isset($_REQUEST['password']) ? mysqli_real_escape_string($con,$_REQUEST['password']) : "";
	$type = isset($_REQUEST['type']) ? mysqli_real_escape_string($con,$_REQUEST['type']) : "";
	$fname = isset($_REQUEST['fname']) ? mysqli_real_escape_string($con,$_REQUEST['fname']) : "";
	$lname = isset($_REQUEST['lname']) ? mysqli_real_escape_string($con,$_REQUEST['lname']) : "";
	$address = isset($_REQUEST['address']) ? mysqli_real_escape_string($con,$_REQUEST['address']) : "";
	$co_id = isset($_REQUEST['co_id']) ? mysqli_real_escape_string($con,$_REQUEST['co_id']) : "";
	$s_id = isset($_REQUEST['s_id']) ? mysqli_real_escape_string($con,$_REQUEST['s_id']) : "";
	$city_id = isset($_REQUEST['city_id']) ? mysqli_real_escape_string($con,$_REQUEST['city_id']) : "";
	//$about = isset($_REQUEST['about']) ? mysqli_real_escape_string($con,$_REQUEST['about']) : "";
	
	//$email_status= isset($_REQUEST['email_status']) ? mysqli_real_escape_string($con,$_REQUEST['email_status']) : "";
	//$admin_status= isset($_REQUEST['admin_status']) ? mysqli_real_escape_string($con,$_REQUEST['admin_status']) : "";
	$education= isset($_REQUEST['education']) ? mysqli_real_escape_string($con,$_REQUEST['education']) : "";
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
		$json = array("result" => "Error", "response" =>"All parameters are compulsary");
		echo json_encode($json);
	}
	else{
	
		$query= "select * from `u_login` where `email_id`='$email'";
		$sql=mysqli_query($con,$query);
		if(mysqli_num_rows($sql)==1){
			
			$json = array("result" => "Error", "response" =>"Already exist!!");
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
				$headers='From:translator@root2leafinfotech.com';
				$mail=mail($to,$subject,$message,$headers);
				if ($mail) {
					
					$insert="insert into `email_otp` (`user_id`,`otp`,`datetime`,`status`) values('$user_id','$otp','$date','A')";
					$que2=mysqli_query($con,$insert);
					
					$array[]=array("user_type"=>$type,"login_id"=>$user_id,"t&c_status"=>$tnc_status,"email_verification_status"=>$email_status,"admin_doc_verification_status"=>$admin_status);
				
					$json = array("result" => "success", "response" =>$array);
					echo json_encode($json);
				}
				else{
					$json = array("result" => "Error", "response" =>"mail not send");
					echo json_encode($json);
				}
				
				
					
			}
			else{
				$json = array("result" => "Error", "response" =>"Error!!");
				echo json_encode($json);
						
				
			}
		}
	}
	
		
}
?>