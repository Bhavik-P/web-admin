<?php
require_once "../config.php";
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$state_id=isset($_REQUEST['s_id']) ? mysqli_real_escape_string($con,$_REQUEST['s_id']) : "";
	if($state_id==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{
		$select="select * from `city` where `state_id`='$state_id'";
		$que= mysqli_query($con,$select);
		while($result=mysqli_fetch_array($que)){
			$city_id=$result['id'];
			$city_name=$result['city_name'];
			$data[]=array('city_id'=>$city_id,'city_name'=>$city_name);
		
		}
		$json = array("result" => "Success", "response" => $data);
		echo json_encode($json);
	}

}
?>