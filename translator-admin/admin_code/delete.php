<?php
	require_once('../../config.php');
	if(isset($_REQUEST['tra_id'])){
		$tra_id=$_REQUEST['tra_id'];
		$select=mysqli_query($con,"select * from `u_details` where `login_id`='$tra_id'");
		$res=mysqli_fetch_array($select);
		$t_id=$res['login_id'];
		$delete=mysqli_query($con,"DELETE FROM `u_details` WHERE `login_id`='$tra_id'");
		if($delete){
			$delete1=mysqli_query($con,"DELETE FROM `u_login` WHERE `id`='$t_id'");
			echo"<script> alert('Translator delete successfully'); window.location='../translators.php'</script>";
		}
		else{
			echo"<script> alert('Error'); window.location='../translators.php'</script>";
		}
		
	}
	
	if(isset($_REQUEST['c_id'])){
		$c_id=$_REQUEST['c_id'];
		$select=mysqli_query($con,"select * from `u_details` where `login_id`='$c_id'");
		$res=mysqli_fetch_array($select);
		$cu_id=$res['login_id'];
		$delete=mysqli_query($con,"DELETE FROM `u_details` WHERE `login_id`='$c_id'");
		if($delete){
			$delete1=mysqli_query($con,"DELETE FROM `u_login` WHERE `id`='$cu_id'");
			echo"<script> alert('Client delete successfully'); window.location='../clients.php'</script>";
		}
		else{
			echo"<script> alert('Error'); window.location='../clients.php'</script>";
		}
		
	}
?>