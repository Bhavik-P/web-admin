<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$cus_id=isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "";	
	if($cus_id==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{
		$select_c="select * from `u_details` where `login_id`='$cus_id'";
		$sql=mysqli_query($con,$select_c);
		$res=mysqli_fetch_array($sql);
		$cus_fname=$res['f_name'];
		$cus_lname=$res['l_name'];
		
		$select_pro="select * from `project` where `cus_id`='$cus_id' AND `status`='A' AND `running_status`='O' OR 'A' OR 'W'";
		$que=mysqli_query($con,$select_pro);
		while($result=mysqli_fetch_array($que)){
			$pro_id=$result['id'];
			$pro_type=$result['project_type'];
			$pro_name=$result['project_name'];
			$r_status=$result['running_status'];
			$datetime=$result['datetime'];
			
			$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"client fname"=>$cus_fname,"client lname"=>$cus_lname,"running_status"=>$r_status,"date&time"=>$datetime,"project_type"=>$pro_type);
			
		}
		$json = array("result" => "Success", "response" =>$array);
		echo json_encode($json);
	}
}

?>