<?php
require_once ("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$date=date("Y-m-d H:i:s");
	$pro_id=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
	$tra_id=isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "";
	$cus_id=isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "";
	
	$select="select * from `pro_u_awarded` where `pro_id`='$pro_id'";
	$que=mysqli_query($con,$select);
	if(mysqli_num_rows($que)==1){
		
		$json = array("result" => "success", "response" =>"Already Awarded");
		echo json_encode($json);
		
	}
	else{
		$select_pro="select * from `project` where `id`='$pro_id'";
		$sql=mysqli_query($con,$select_pro);
		$res=mysqli_fetch_array($sql);
		$pro_type=$res['project_type'];
		
		$insert="insert into `pro_u_awarded` (`pro_id`,`tra_id`,`pro_type`,`datetime`,`pay_status`,`running_status`,`cus_id`)values('$pro_id','$tra_id','$pro_type','$date','NP','W','$cus_id')";
		$sql1=mysqli_query($con,$insert);
		if($sql1){
			
			$select_a="select * from `pro_u_awarded` where  `pro_id`='$pro_id'";
			$query=mysqli_query($con,$select_a);
			$result=mysqli_fetch_array($con,$query);
			$award_id=$result['id'];
			
			$update="update `project` SET `running_status`='W' where `id`='$pro_id'";
			$que2=mysqli_query($con,$update);
			if($que2){
				
				$array[]=array("awarded_id"=>$award_id);
				
			}
			
			
		}
		$json = array("result" => "success", "response" =>$array);
		echo json_encode($json);
		
	}
	
}


?>