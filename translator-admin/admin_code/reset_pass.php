<?php
require_once("../../config.php");
if(isset($_REQUEST['reset'])){
	$id =mysqli_real_escape_string($con,$_REQUEST['id']);
	$password =mysqli_real_escape_string($con,$_REQUEST['pass']);
	$con_password =mysqli_real_escape_string($con,$_REQUEST['con_pass']);
	if($password==$con_password){
		
		$update="update `admin` SET `password`='$password' where `id`='$id'";
		$que=mysqli_query($con,$update);
		if($que){
			echo "<script>alert('password reset successfully')</script>";  
			echo "<script>window.location='../extra-login.php'</script>";
		}
	}
	else{
		echo "<script>alert('password not matched')</script>";  
		echo "<script>window.location='../../forget_reset.php</script>";
	}
}
?>