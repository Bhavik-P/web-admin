<?php
require_once ("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$pro_id=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
	$tra_id=isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "";
	if(isset($_REQUEST['accept'])){
		
		$update="update `pro_u_invite` SET `accepted_status`='AC' where `pro_id`='$pro_id' AND `tra_id`='$tra_id'";
		$que=mysqli_query($con,$update);
		
		$array[]=array("project_id"=>$pro_id);
		$json = array("result" => "Success", "response" =>$array);
		echo json_encode($json);
	
	}
	elseif(isset($_REQUEST['decline'])){
		
		$update1="update `pro_u_invite` SET `accepted_status`='DE' where `pro_id`='$pro_id' AND `tra_id`='$tra_id'";
		$que1=mysqli_query($con,$update1);
		
		$array1[]=array("project_id"=>$pro_id);
		$json = array("result" => "Success", "response" =>$array1);
		echo json_encode($json);
	}
}

?>