<?php
require_once("../../config.php");
if(isset($_REQUEST['forget_pass'])){
	
	$email_id =mysqli_real_escape_string($con,$_REQUEST['username']);
	$date=date("Y-m-d H:i:s");
	$select="select * from `admin` where `email`='$email_id'";
		$que=mysqli_query($con,$select);
		if(mysqli_num_rows($que)==1){
			
			$res=mysqli_fetch_array($que);
			$id=$res['id'];
			$hash=base64_encode($id);
			$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
			$reset_key=substr(str_shuffle($data), 0, 20);
			
			$insert_e="insert into `u_email_verification`(`user_id`,`reset_key`,`hash`,`datetime`,`status`,`link_type`) values('$id','$reset_key','$hash','$date','A','pass')";
			$sql4=mysqli_query($con,$insert_e);
			
			
			$e_link="http://5ivetechnology.com/projects/true-translator/translator-admin/forget_reset.php?reset=".$reset_key."&hash=".$hash."";
			$to=$email_id;
			$subject='Forget password ';
			$message='Your password link: '.$e_link; 
			$headers='From:translator@5ivetechnology.com';
			$m=mail($to,$subject,$message,$headers);
			if($m){
				
				echo"<script>alert('Forget password link send on your email_id ,Please check ypour mail'); window.location='../extra-login.php';</script>";
				
			}
			else{
				echo"<script>alert('Error'); window.location='../forget_password.php';</script>";
			}
			
			
		}
} 
?>