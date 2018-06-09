<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$u_id = isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "";
	$otp = isset($_REQUEST['otp']) ? mysqli_real_escape_string($con,$_REQUEST['otp']) : "";
	if($u_id=='' && $otp==''){
		$json = array("result" => "Error", "response" =>"All parameters are compulsary");
		echo json_encode($json);
	}
	else{
		$select="select * from `email_otp` where `user_id`='$u_id' AND `status`='A'";
		$que=mysqli_query($con,$select);
		$res=mysqli_fetch_array($que);
		$otp1=$res['otp'];
		if($otp==$otp1){
			
			$update1="update `u_details` SET `email_verification`='1' where `login_id`='$u_id'";
			$sql=mysqli_query($con,$update1);
			
			$update="update `email_otp` SET `status`='U' where `user_id`='$u_id' ";
			$sql1=mysqli_query($con,$update);
			
			$array[]=array("login_id"=>$u_id);
				
			$json = array("result" => "success", "response" =>$array);
			echo json_encode($json);
		}
		else{
			$json = array("result" => "Error", "response" =>" Error !!");
			echo json_encode($json);
			
		}
	}
	
	
}
?>