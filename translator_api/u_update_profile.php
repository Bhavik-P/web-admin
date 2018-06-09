<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$date=date("Y-m-d H:i:s");
	$u_id = isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "";
	$fname = isset($_REQUEST['fname']) ? mysqli_real_escape_string($con,$_REQUEST['fname']) : "";
	$lname = isset($_REQUEST['lname']) ? mysqli_real_escape_string($con,$_REQUEST['lname']) : "";
	$address = isset($_REQUEST['address']) ? mysqli_real_escape_string($con,$_REQUEST['address']) : "";
	$co_id = isset($_REQUEST['co_id']) ? mysqli_real_escape_string($con,$_REQUEST['co_id']) : "";
	$s_id = isset($_REQUEST['s_id']) ? mysqli_real_escape_string($con,$_REQUEST['s_id']) : "";
	$city_id = isset($_REQUEST['city_id']) ? mysqli_real_escape_string($con,$_REQUEST['city_id']) : "";
	$about = isset($_REQUEST['about']) ? mysqli_real_escape_string($con,$_REQUEST['about']) : "";
	$education= isset($_REQUEST['education']) ? mysqli_real_escape_string($con,$_REQUEST['education']) : "";
	//$avg_rating= isset($_REQUEST['avg_rating']) ? mysqli_real_escape_string($con,$_REQUEST['avg_rating']) : "";
	$pic = isset($_REQUEST['pic']) ? mysqli_real_escape_string($con,$_REQUEST['pic']) : "";
	
	if($u_id=='' && $fname=='' && $lname=='' && $address=='' && $co_id=='' && $s_id=='' && $city_id=='' && $about=='' && $education=='' && $pic==''){
		$json = array("result" => "Error", "response" =>"All parameters are compulsary");
		echo json_encode($json);
	}
	else{
	
		$select="select * from `u_login` where `id`='$u_id'";
		$que=mysqli_query($con,$select);
		if(mysqli_num_rows($que)>0){
			$res=mysqli_fetch_array($que);
			$type=$res['type'];
			
			$img = $_REQUEST['pic'];
			$image = str_replace(' ', '+', $img);
			$decoded = base64_decode($image);
			$file_name = md5(rand()).'_'.$type.'.jpg';
			file_put_contents('../upload/'.$file_name, $decoded);
			
			
			$update="update `u_details` SET `f_name`='$fname',`l_name`='$lname',`pic`='$file_name',`address`='$address',`country_id`='$co_id',`state_id`='$s_id',`city_id`='$city_id',`about_us`='$about',`update_datetime`='$date',`admin_doc_veri_status`='',`education`='$education' where `login_id`='$u_id'";
			
			$sql=mysqli_query($con,$update);
			if($sql){
					$array[]=array("user_type"=>$type,"login_id"=>$u_id);
					$json = array("result" => "success", "response" =>$array);
					echo json_encode($json);
			}
			else{
				$json = array("result" => "Error", "response" =>"Error!!");
				echo json_encode($json);
			}
			
		}
		else{
			$json = array("result" => "Error", "response" =>"You are not registered user!!");
			echo json_encode($json);
		}
	}
}

?>