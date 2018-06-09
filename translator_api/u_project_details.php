<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$pro_id=isset($_REQUEST['pro_id']) ? mysqli_real_escape_string($con,$_REQUEST['pro_id']) : "";
	if($pro_id=='' ){
		$json = array("result" => "Error", "response" =>"All parameters are compulsary");
		echo json_encode($json);
	}
	else{
		$select="select * from `project` where `id`='$pro_id'";
		$sql=mysqli_query($con,$select);
		$result=mysqli_fetch_array($sql);
		$pro_type=$result['project_type'];
		$pro_name=$result['project_name'];
		$date=$result['datetime'];
		
		
		if($pro_type=='DOC'){
			$select_doc="select * from `pro_doc_details` where pro_id='$pro_id'";
			$que=mysqli_query($con,$select_doc);
			$res=mysqli_fetch_array($que);
			
			$budget=$res['budget'];
			$time=$res['time'];
			$doc=$res['document'];
			
			$array[]=array("project name"=>$pro_name,"project_type"=>$pro_type,"budget"=>$budget,"time"=>$time,"document"=>$doc,"date&time"=>$date);
			
		}
		elseif($pro_type=='LIV'){
			$select_liv="select * from `pro_live_details` where pro_id='$pro_id'";
			
			$que1=mysqli_query($con,$select_liv);
			$res1=mysqli_fetch_array($que1);
			
			$budget=$res1['budget'];
			$from_time=$res1['from_time'];
			$to_time=$res1['to_time'];
			
			$array[]=array("project name"=>$pro_name,"project_type"=>$pro_type,"budget"=>$budget,"from_time"=>$from_time,"to_time"=>$to_time,"date&time"=>$date);
			
			
		}
		$json = array("result" => "Success", "response" =>$array);
		echo json_encode($json);
	}
	
	
}
?>