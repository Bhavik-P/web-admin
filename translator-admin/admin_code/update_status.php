<?php
require_once('../../config.php');
if(isset($_REQUEST['id'])){
	$c_id=$_REQUEST['id'];
	$select="select * from `country` where `id`='$c_id'";
	$que=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($que))
	{
		$status=$row['status'];
		if($status == '1')
		{
			$status1='0';
		}
		else
		{
			$status1='1';
		}
		$update=mysqli_query($con,"update `country` SET `status`='$status1' where `id`='$c_id' ");
		
		if($update)
		{
			header("Location:../m_country.php");
		}
		else
		{
			echo mysql_error();
		}
	}

}
if(isset($_REQUEST['state_id'])){
	$s_id=$_REQUEST['state_id'];
	$select="select * from `state` where `id`='$s_id'";
	$que=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($que))
	{
		$status=$row['status'];
		if($status == '1')
		{
			$status1='0';
		}
		else
		{
			$status1='1';
		}
		$update=mysqli_query($con,"update `state` SET `status`='$status1' where `id`='$s_id' ");
		
		if($update)
		{
			header("Location:../m_state.php");
		}
		else
		{
			echo mysql_error();
		}
	}

}
if(isset($_REQUEST['city_id'])){
	$city_id=$_REQUEST['city_id'];
	$select="select * from `city` where `id`='$city_id'";
	$que=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($que))
	{
		$status=$row['status'];
		if($status == '1')
		{
			$status1='0';
		}
		else
		{
			$status1='1';
		}
		$update=mysqli_query($con,"update `city` SET `status`='$status1' where `id`='$city_id' ");
		
		if($update)
		{
			header("Location:../m_city.php");
		}
		else
		{
			echo mysql_error();
		}
	}

}
if(isset($_REQUEST['lang_id'])){
	$lang_id=$_REQUEST['lang_id'];
	$select="select * from `m_language` where `id`='$lang_id'";
	$que=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($que))
	{
		$status=$row['status'];
		if($status == 'A')
		{
			$status1='D';
		}
		else
		{
			$status1='A';
		}
		$update=mysqli_query($con,"update `m_language` SET `status`='$status1' where `id`='$lang_id' ");
		
		if($update)
		{
			header("Location:../m_language.php");
		}
		else
		{
			echo mysql_error();
		}
	}

}
if(isset($_REQUEST['rate_id'])){
	$rate_id=$_REQUEST['rate_id'];
	$select="select * from `m_rate` where `id`='$rate_id'";
	$que=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($que))
	{	$type=$row['type'];
		
		$update1="update `m_rate` SET `status`='D' where type='$type' AND `id`!='$rate_id'";
		$qu=mysqli_query($con,$update1);
		echo $update1;
		$status=$row['status'];
		if($status == 'A')
		{
			$status1='D';
		}
		else
		{
			$status1='A';
		}
		$update=mysqli_query($con,"update `m_rate` SET `status`='$status1' where `id`='$rate_id' ");
		echo $update;
		if($update)
		{
			header("Location:../m_rate.php");
		}
		else
		{
			echo mysql_error();
		}
	}

}
if(isset($_REQUEST['tra_id'])){
	$tra_id=$_REQUEST['tra_id'];
	$select="select * from `u_login` where `id`='$tra_id'";
	$que=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($que))
	{
		$status=$row['admin_status'];
		if($status == 'A')
		{
			$status1='D';
		}
		else
		{
			$status1='A';
		}
		$update=mysqli_query($con,"update `u_login` SET `admin_status`='$status1' where `id`='$tra_id' ");
		
		if($update)
		{
			header("Location:../translators.php");
		}
		else
		{
			echo mysql_error();
		}
	}

}
if(isset($_REQUEST['cus_id'])){
	$cus_id=$_REQUEST['cus_id'];
	$select="select * from `u_login` where `id`='$cus_id'";
	$que=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($que))
	{
		$status=$row['admin_status'];
		if($status == 'A')
		{
			$status1='D';
		}
		else
		{
			$status1='A';
		}
		$update=mysqli_query($con,"update `u_login` SET `admin_status`='$status1' where `id`='$cus_id' ");
		
		if($update)
		{
			header("Location:../clients.php");
		}
		else
		{
			echo mysql_error();
		}
	}

}
if(isset($_REQUEST['pro_id'])){
	$pro_id=$_REQUEST['pro_id'];
	$select="select * from `project` where `id`='$pro_id'";
	$que=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($que))
	{
		$status=$row['status'];
		if($status == 'A')
		{
			$status1='D';
		}
		else
		{
			$status1='A';
		}
		$update=mysqli_query($con,"update `project` SET `status`='$status1' where `id`='$pro_id' ");
		if($update)
		{
			header("Location:../new-projects.php");
		}
		else
		{
			echo mysql_error();
		}
	}

}
if(isset($_REQUEST['up_id'])){
	$up_id=$_REQUEST['up_id'];
	$select="select * from `project` where `id`='$up_id'";
	$que=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($que))
	{
		$status=$row['status'];
		if($status == 'A')
		{
			$status1='D';
		}
		else
		{
			$status1='A';
		}
		$update=mysqli_query($con,"update `project` SET `status`='$status1' where `id`='$up_id' ");
		if($update)
		{
			header("Location:../upcoming-schedule.php");
		}
		else
		{
			echo mysql_error();
		}
	}

}
if(isset($_REQUEST['his_id'])){
	$his_id=$_REQUEST['his_id'];
	$select="select * from `project` where `id`='$his_id'";
	$que=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($que))
	{
		$status=$row['status'];
		if($status == 'A')
		{
			$status1='D';
		}
		else
		{
			$status1='A';
		}
		$update=mysqli_query($con,"update `project` SET `status`='$status1' where `id`='$his_id' ");
		if($update)
		{
			header("Location:../history.php");
		}
		else
		{
			echo mysql_error();
		}
	}

}
if(isset($_REQUEST['rat_id'])){
	$rat_id=$_REQUEST['rat_id'];
	$select="select * from `pro_review_rating` where `pro_id`='$rat_id'";
	$que=mysqli_query($con,$select);
	while($row=mysqli_fetch_array($que))
	{
		$status=$row['status'];
		if($status == 'A')
		{
			$status1='D';
		}
		else
		{
			$status1='A';
		}
		$update=mysqli_query($con,"update `pro_review_rating` SET `status`='$status1' where `pro_id`='$rat_id' ");
		if($update)
		{
			header("Location:../all-review-rating.php");
		}
		else
		{
			echo mysql_error();
		}
	}

}
?>