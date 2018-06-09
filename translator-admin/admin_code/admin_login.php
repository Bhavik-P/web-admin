<?php
session_start();
require_once("../../config.php");
if(isset($_REQUEST["submit"])){
    $email=$_REQUEST["username"];
    $password=$_REQUEST["password"];
    
	$query= "select * from `admin` where email='$email' AND `password`='$password'";
	$sql=mysqli_query($con,$query);
	if(mysqli_num_rows($sql)>0)
	{
		$result=mysqli_fetch_array($sql); 
		$pass_res=$result['password'];
		$email_res=$result['email'];
		if(($email_res==$email)&&($pass_res==$password))
		{
			$admin_id=$result['id'];
			$_SESSION['login_id']=$admin_id;
			echo"<script>window.location='../index.php'</script>";
		}
		else{
			echo "<script>alert('Invalid email and password  ')</script>"; 
			echo"<script>window.location='../extra-login.php'</script>";
			//header('Location:index.html');
		}
		
	}else{
		 
		// "incorrect email_id and password";
		echo "<script>alert('Email does not exist! ')</script>";
		echo"<script>window.location='../extra-login.php'</script>";
	}
	 
}

?>
