<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$date=date("Y-m-d H:i:s");
	$tra_id=isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "";	
	$pro_id=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";	
	
	if($tra_id=='' && $pro_id==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{
		$select="select * from `pro_u_invite` where `pro_id`='$pro_id' AND `tra_id`='$tra_id'";
		$que=mysqli_query($con,$select);
		if(mysqli_num_rows($que)>0){
			
			$json = array("result" => "Success", "response" =>"Already pinged!");
			echo json_encode($json);

		}
		else{
			$insert="insert into `pro_u_invite` (`pro_id`,`tra_id`,`invite_status`,`ping_status`,`datetime`)values('$pro_id','$tra_id','0','1','$date')";
			$sql=mysqli_query($con,$insert);
			if($sql){
				
				$array[]=array("translator_id"=>$tra_id);
				$json = array("result" => "Success", "response" =>$array);
				echo json_encode($json);
				
			}
			else{
				$json = array("result" => "Error", "response" =>"Error");
				echo json_encode($json);
			}
			
		}
	}
		
}
?>