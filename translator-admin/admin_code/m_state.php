<?php
require_once "../../config.php";
if(isset($_REQUEST['submit']))
{

	$status="1";
	$state_insert="insert into `state` (`country_id`,`state_name`,`status`) values ('".$_POST['m_country']."','".$_POST['state_name']."',".$status.")";
	$exe_state_query= mysqli_query($con,$state_insert);
	$insert_id=mysqli_insert_id($con);
	header('Location:../m_state.php');
}


?>