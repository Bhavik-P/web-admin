<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$tra_id=isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "";	
	if($tra_id==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{
	
		$select_a="select * from `pro_u_awarded` where tra_id='$tra_id' AND `running_status`='W'";
		$que1=mysqli_query($con,$select_a);
		while($res1=mysqli_fetch_array($que1)){
			$pro_id=$res1['pro_id'];
			
			$select_pro="select * from `project` where `id`='$pro_id' AND `status`='A' AND `running_status`='W'";
			$que=mysqli_query($con,$select_pro);
			while($result=mysqli_fetch_array($que)){
				$pro_id=$result['id'];
				$pro_type=$result['project_type'];
				$pro_name=$result['project_name'];
				$r_status=$result['running_status'];
				$datetime=$result['datetime'];
				$cus_id=$result['cus_id'];
				
				$select_c="select * from `u_details` where `login_id`='$cus_id'";
				$sql=mysqli_query($con,$select_c);
				$res=mysqli_fetch_array($sql);
				$c_fname=$res['f_name'];
				$c_lname=$res['l_name'];
				
				$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"client fname"=>$c_fname,"client lname"=>$c_lname,"running_status"=>$r_status,"date&time"=>$datetime,"project_type"=>$pro_type);
				
			}
		}
		$json = array("result" => "Success", "response" =>$array);
		echo json_encode($json);
	}
}

?>