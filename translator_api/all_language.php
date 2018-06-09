<?php
require_once "../config.php";
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$select="select * from `m_language`";
	$que= mysqli_query($con,$select);
	while($result=mysqli_fetch_array($que)){
		$l_id=$result['id'];
		$l_name=$result['language'];
		$data[]=array('language_id'=>$l_id,'language_name'=>$l_name);
	
	}
	$json = array("result" => "Success", "response" => $data);
	echo json_encode($json);

}
?>