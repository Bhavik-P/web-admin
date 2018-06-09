<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$u_id = isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "";
	$password=isset($_REQUEST['old_pass']) ? mysqli_real_escape_string($con,$_REQUEST['old_pass']) : "";
	$new_password=isset($_REQUEST['new_pass']) ? mysqli_real_escape_string($con,$_REQUEST['new_pass']) : "";
	if($u_id=='' && $password=='' && $new_password==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
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
				$json = array("result" => "success", "response" =>"Password change successfully");
				echo json_encode($json);
			}
			else{
				$json = array("result" => "Error", "response" =>"Error!!");
				echo json_encode($json);
			}
			
		}
		else{
			$json = array("result" => "Error", "response" =>"password does not matched!");
			echo json_encode($json);
		}
	}

}
?>