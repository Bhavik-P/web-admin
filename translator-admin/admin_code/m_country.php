<?php
require_once "../../config.php";
if(isset($_REQUEST['submit']))
{
	$status="1";
	$insert_query="insert into `country` (`country_name`,`status`) values ('".$_REQUEST['country_name']."',".$status.")";
	$exe_insert_query= mysqli_query($con,$insert_query);
	$insert_id=mysqli_insert_id($con);

	header('Location:../m_country.php');
 
}
?>