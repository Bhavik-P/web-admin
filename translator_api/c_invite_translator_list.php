<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$pro_id=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
	if($pro_id==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{

		$select_t="SELECT * FROM  `pro_u_invite` RIGHT JOIN  `u_details` ON  `pro_u_invite`.`tra_id` =  `u_details`.`login_id` AND  `pro_u_invite`.`pro_id` = '$pro_id' RIGHT JOIN  `u_login` ON  `u_login`.`id` =  `u_details`.`login_id` WHERE `u_login`.`type` ='TR' AND `u_login`.`admin_status`='A' AND `pro_u_invite`.`tra_id` IS NULL";
		$sql=mysqli_query($con,$select_t);
		while($res1=mysqli_fetch_array($sql)){
			$fname=$res1['f_name'];
			$lname=$res1['l_name'];
			$log_id=$res1['login_id'];
			
			$array[]=array("translator fname"=>$fname,"translator lname"=>$lname,"translator_id"=>$log_id);
		}
		$json = array("result" => "Success", "response" =>$array);
		echo json_encode($json);
	}

}
?>