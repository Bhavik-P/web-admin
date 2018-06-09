<?php
require_once "../../config.php";
if(isset($_REQUEST['submit']))
{
	$status="1";
	$insert_query="insert into `m_language` (`language`,`status`) values ('".$_REQUEST['language']."',".$status.")";
	$exe_insert_query= mysqli_query($con,$insert_query);
	$insert_id=mysqli_insert_id($con);

	header('Location:../m_language.php');
 
}
?>