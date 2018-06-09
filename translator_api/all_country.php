<?php
require_once "../config.php";
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
		$select="select * from `country`";
		$que= mysqli_query($con,$select);
		while($result=mysqli_fetch_array($que)){
			$co_id=$result['id'];
			$co_name=$result['country_name'];
			$data[]=array('country_id'=>$co_id,'country_name'=>$co_name);
		
		}
		$json = array("result" => "Success", "response" => $data);
		echo json_encode($json);
	

}
?>