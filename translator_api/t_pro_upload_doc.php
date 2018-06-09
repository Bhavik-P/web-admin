<?php
require_once ("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$date=date("Y-m-d H:i:s");
	$pro_id=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
	$doc_name=isset($_REQUEST['doc_name']) ? mysqli_real_escape_string($con,$_REQUEST['doc_name']) : "";	
	$exe=isset($_REQUEST['exe']) ? mysqli_real_escape_string($con,$_REQUEST['exe']) : "";	
	
	$doc = $_REQUEST['document'];
	$file = str_replace(' ', '+', $doc);
	$decoded = base64_decode($file);
	$file_name = md5(rand()).'_'.'.'.$exe;
	file_put_contents('../doc_file/'.$file_name, $decoded);
	
	$select="select * from `pro_u_awarded` where `pro_id`='$pro_id'";
	$que=mysqli_query($con,$select);
	$res=mysqli_fetch_array($que);
	$award_id=$res['id'];
	
	$insert="insert into `pro_doc_submitted` (`awarded_id`,`document`,`doc_name`,`datetime`,`status`) values ('$award_id','$file_name','$doc_name','$date','1')";
	$que1=mysqli_query($con,$insert);
	if($que1){
		$array[]=array("project_id"=>$pro_id);
		$json = array("result" => "success", "response" =>$array);
		echo json_encode($json);
		
	}
	else{
		
		$json = array("result" => "error", "response" =>"Error!!");
		echo json_encode($json);
	}
	
}


?>