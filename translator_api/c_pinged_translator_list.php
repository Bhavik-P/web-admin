<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$pro_id=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
	if($pro_id==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{
		$select="select * from `pro_u_invite` where `pro_id`='$pro_id' AND `ping_status`='1'";
		$que=mysqli_query($con,$select);
		while($res=mysqli_fetch_array($que)){
			$tra_id=$res['tra_id'];
			$array[]=array("translator_id"=>$tra_id);
		}
		$json = array("result" => "Success", "response" =>$array);
		echo json_encode($json);
	}
}
?>