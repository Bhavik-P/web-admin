<?php
require_once ("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$date=date("Y-m-d H:i:s");
	$pro_id=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
	$cus_id=isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "";
	if(isset($_REQUEST['complete'])){
		$update_a="update `pro_u_awarded` SET `running_status`='CM'  where `pro_id`='$pro_id' AND `cus_id`='$cus_id'";
		$que=mysqli_query($con,$update_a);
		if($que){
			$update="update `project` SET `running_status`='CM' ,`complete_datetime`='$date' where `id`='$pro_id' AND `cus_id`='$cus_id'";
			$sql=mysqli_query($con,$update);
			
			$array[]=array("project_id"=>$pro_id);
			$json = array("result" => "Success", "response" =>$array);
			echo json_encode($json);
		}
	}
	elseif(isset($_REQUEST['cancel'])){
		$update_a="update `pro_u_awarded` SET `running_status`='CL'  where `pro_id`='$pro_id' AND `cus_id`='$cus_id'";
		$que=mysqli_query($con,$update_a);
		if($que){
			$update="update `project` SET `running_status`='CL' ,`complete_datetime`='$date' where `id`='$pro_id' AND `cus_id`='$cus_id'";
			$sql=mysqli_query($con,$update);
			
			$array[]=array("project_id"=>$pro_id);
			$json = array("result" => "Success", "response" =>$array);
			echo json_encode($json);
		}
	}
	
}


?>