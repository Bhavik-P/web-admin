<?php
require_once "../../config.php";
if(isset($_REQUEST['submit']))
{
	$m_type=$_REQUEST['type'];
	if($m_type=='per_page'){
		$type='PP';
	}
	elseif($m_type=='per_hour'){
		$type='PH';
	}
	$status="1";
	$insert_query="insert into `m_rate` (`rate`,`type`,`status`) values ('".$_REQUEST['rate']."','$type',".$status.")";
	$exe_insert_query= mysqli_query($con,$insert_query);
	

	header('Location:../m_rate.php');
 
}
?>