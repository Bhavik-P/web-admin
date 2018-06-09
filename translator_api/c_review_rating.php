<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$pro_id=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
	$review=isset($_REQUEST['review']) ? mysqli_real_escape_string($con,$_REQUEST['review']) : "";
	$rating=isset($_REQUEST['rating']) ? mysqli_real_escape_string($con,$_REQUEST['rating']) : "";
	
	if($pro_id=='' && $review=='' && $rating==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{
		$select="select * from `project` where `id`='$pro_id' AND `status`='A'";
		$que=mysqli_query($con,$select);
		$result=mysqli_fetch_array($que);
		$cus_id=$result['cus_id'];
		
		
		$select_t="select * from `pro_u_awarded` where `pro_id`='$pro_id'";
		$que1=mysqli_query($con,$select_t);
		$res=mysqli_fetch_array($que1);
		$tra_id=$res['tra_id'];
		$r_status=$res['running_status'];
		if($r_status=='CM'){
			
			$insert="insert into `pro_review_rating` (`pro_id`,`tra_id`,`cus_id`,`review`,`rating`,`status`) values ('$pro_id','$tra_id','$cus_id','$review','$rating','A')";
			$sql=mysqli_query($con,$insert);
			if($sql){
				 $select_r="select AVG(rating) from `pro_review_rating` where `tra_id`='$tra_id'";
				 $sql1=mysqli_query($con,$select_r);
				 $res1=mysqli_fetch_array($sql1);
				 $avg_rating=$res1['AVG(rating)'];
				 
				 $update="update `u_details` SET `avg_rating`='$avg_rating' where `login_id`=`$tra_id`";
				 $sql3=mysqli_query($con,$update);
				 
				
				$json = array("result" => "Success", "response" =>"success");
				echo json_encode($json);
			}
			else{
				$json = array("result" => "Error", "response" =>'Error');
				echo json_encode($json);
			}
		}
		else{
			$json = array("result" => "Error", "response" =>'project not completed');
			echo json_encode($json);
		}
	
	
	
	}
	
}
?>