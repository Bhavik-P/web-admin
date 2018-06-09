<?php
require_once "../config.php";
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$co_id=isset($_REQUEST['co_id']) ? mysqli_real_escape_string($con,$_REQUEST['co_id']) : "";
	if($co_id==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{
		$select="select * from `state` where `country_id`='$co_id'";
		$que= mysqli_query($con,$select);
		while($result=mysqli_fetch_array($que)){
			$s_id=$result['id'];
			$s_name=$result['state_name'];
			$data[]=array('state_id'=>$s_id,'state_name'=>$s_name);
		
		}
		$json = array("result" => "Success", "response" =>$data);
		echo json_encode($json);
	}

}
?>