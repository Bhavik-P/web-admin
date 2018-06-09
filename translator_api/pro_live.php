<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$date=date("Y-m-d H:i:s");
	$cus_id=isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "";	
	$project_name=isset($_REQUEST['project_name']) ? mysqli_real_escape_string($con,$_REQUEST['project_name']) : "";	
	$main_lang=isset($_REQUEST['main_lang']) ? mysqli_real_escape_string($con,$_REQUEST['main_lang']) : "";	
	$con_lang=isset($_REQUEST['con_lang']) ? mysqli_real_escape_string($con,$_REQUEST['con_lang']) : "";	
	$from_time=isset($_REQUEST['from_time']) ? mysqli_real_escape_string($con,$_REQUEST['from_time']) : "";	
	$to_time=isset($_REQUEST['to_time']) ? mysqli_real_escape_string($con,$_REQUEST['to_time']) : "";	
	$pro_type=isset($_REQUEST['pro_type']) ? mysqli_real_escape_string($con,$_REQUEST['pro_type']) : "";	
	$for_type=isset($_REQUEST['for_type']) ? mysqli_real_escape_string($con,$_REQUEST['for_type']) : "";	
	$date1=isset($_REQUEST['date']) ? mysqli_real_escape_string($con,$_REQUEST['date']) : "";	

	if($cus_id=='' && $project_name=='' && $main_lang=='' && $con_lang=='' && $from_time=='' && $to_time=='' && $date1=='' && $pro_type=='' && $for_type==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{

		$insert="insert into `project` (`cus_id`,`project_name`,`main_lang`,`conversion_lang`,`project_type`,`status`,`running_status`,`for_project`,`datetime`)values('$cus_id','$project_name','$main_lang','$con_lang','$pro_type','A','O','$for_type','$date')";

		$que=mysqli_query($con,$insert);
		$pro_id=mysqli_insert_id($con);
		if($que){
			$diff = (strtotime($to_time) - strtotime($from_time));
			$total = $diff/60;
			$total_time=floor($total/60);
			$b_select="select * from `m_rate` where `type`='PH'";
			$que1=mysqli_query($con,$b_select);
			$res1=mysqli_fetch_array($que1);
			$rate=$res1['rate'];
			$budget=$total_time*$rate;
			
			if($pro_type=='LIV'){
				$insert_liv="INSERT INTO `pro_live_details` (`id`, `pro_id`, `date`, `from_time`, `to_time`, `total_time`, `budget`, `for_pro`) VALUES ('null','$pro_id','$date1','$from_time','$to_time','$total_time','$budget','$for_type')";
				//echo $insert_liv;
				$sql1=mysqli_query($con,$insert_liv);
				if($sql1){
					$json = array("result" => "Success", "response" =>"Success!!");
					echo json_encode($json);
					
				}else{
					$json = array("result" => "Error", "response" =>"Error1!!");
					echo json_encode($json);
				}
				
				
			}
			else{
				$json = array("result" => "Error", "response" =>"Your projecttype in not LIVE project!!");
				echo json_encode($json);
				
			}
			
		}else{
			
			$json = array("result" => "Error", "response" =>"Error!!");
			echo json_encode($json);
		}

	}		
}

?>