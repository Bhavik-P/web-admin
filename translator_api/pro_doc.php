<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$date=date("Y-m-d H:i:s");
	$cus_id=isset($_REQUEST['cus_id']) ? mysqli_real_escape_string($con,$_REQUEST['cus_id']) : "";	
	$project_name=isset($_REQUEST['project_name']) ? mysqli_real_escape_string($con,$_REQUEST['project_name']) : "";	
	$ind_type=isset($_REQUEST['ind_type']) ? mysqli_real_escape_string($con,$_REQUEST['ind_type']) : "";	
	$main_lang=isset($_REQUEST['main_lang']) ? mysqli_real_escape_string($con,$_REQUEST['main_lang']) : "";	
	$con_lang=isset($_REQUEST['con_lang']) ? mysqli_real_escape_string($con,$_REQUEST['con_lang']) : "";	
	$time=isset($_REQUEST['time']) ? mysqli_real_escape_string($con,$_REQUEST['time']) : "";	
	$no_page=isset($_REQUEST['no_page']) ? mysqli_real_escape_string($con,$_REQUEST['no_page']) : "";	
	$document=isset($_REQUEST['document']) ? mysqli_real_escape_string($con,$_REQUEST['document']) : "";	
	$pro_type=isset($_REQUEST['pro_type']) ? mysqli_real_escape_string($con,$_REQUEST['pro_type']) : "";	
	$for_type=isset($_REQUEST['for_type']) ? mysqli_real_escape_string($con,$_REQUEST['for_type']) : "";	
	$exe=isset($_REQUEST['exe']) ? mysqli_real_escape_string($con,$_REQUEST['exe']) : "";	

	$doc = $_REQUEST['document'];
	$file = str_replace(' ', '+', $doc);
	$decoded = base64_decode($file);
	$file_name = md5(rand()).'_'.$pro_type.$exe;
	file_put_contents('../doc_file/'.$file_name, $decoded);
	
	if($cus_id=='' && $project_name=='' && $ind_type=='' && $main_lang=='' && $con_lang=='' && $time=='' && $no_page=='' && $document=='' && $pro_type=='' && $for_type=='' && $exe=='' && $doc==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{
		$insert="insert into `project` (`cus_id`,`project_name`,`main_lang`,`conversion_lang`,`project_type`,`status`,`running_status`,`for_project`,`datetime`)values('$cus_id','$project_name','$main_lang','$con_lang','$pro_type','A','O','$for_type','$date')";

		$que=mysqli_query($con,$insert);
		$pro_id=mysqli_insert_id($con);
		if($que){
			
			$b_select="select * from `m_rate` where `type`='PP'";
			$que1=mysqli_query($con,$b_select);
			$res1=mysqli_fetch_array($que1);
			$rate=$res1['rate'];
			$budget=$no_page*$rate;
			
			if($pro_type=='DOC'){
				$insert_doc="insert into `pro_doc_details` (`pro_id`,`industry_type`,`document`,`no_of_pages`,`budget`,`time`,`for_project`)values('$pro_id','$ind_type','$file_name','$no_page','$budget','$time','$for_type')";
				$sql1=mysqli_query($con,$insert_doc);
				if($sql1){
					$json = array("result" => "Success", "response" =>"Success!!");
					echo json_encode($json);
					
				}else{
					$json = array("result" => "Error", "response" =>"Error!!");
					echo json_encode($json);
				}
				
				
			}
			else{
				$json = array("result" => "Error", "response" =>"Your projecttype in not DOC project!!");
				echo json_encode($json);
				
			}
			
		}else{
			
			$json = array("result" => "Error", "response" =>"Error!!");
			echo json_encode($json);
		}
	}

	
}

?>