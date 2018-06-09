<?php
require_once('../../config.php');
if(isset($_REQUEST['submit']))
{

$status="1";
	$city_insert="insert into `city` (`city_name`,`state_id`,status) values ('".$_REQUEST['city_name']."','".$_REQUEST['state']."',".$status.")";
	echo $city_insert;
	$exe_city_query= mysqli_query($con,$city_insert);
   $insert_id=mysqli_insert_id($con);
  header('Location:../m_city.php');
}

?>