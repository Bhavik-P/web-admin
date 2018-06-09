<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$date=date("Y-m-d H:i:s");

	$u_id = isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "";
	$eng_doc=isset($_REQUEST['eng_doc']) ? mysqli_real_escape_string($con,$_REQUEST['eng_doc']) : "";
	$spn_doc=isset($_REQUEST['spn_doc']) ? mysqli_real_escape_string($con,$_REQUEST['spn_doc']) : "";
	$form=isset($_REQUEST['form']) ? mysqli_real_escape_string($con,$_REQUEST['form']) : "";

	if($u_id=='' && $eng_doc=='' && $spn_doc=='' && $fprm==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{

		$doc_name=$u_id.'_'.$eng_doc.'_'.$date;
		$doc_name1=$u_id.'_'.$spn_doc.'_'.$date;
		$doc_name2=$u_id.'_'.$form.'_'.$date;

		$insert="insert into `u_document` (`login_id`,`certificate`,`admin_veri_status`,`datetime`,`type`,`document_name`) values('$u_id','$eng_doc','0','$date','L','$doc_name'),('$u_id','$spn_doc','0','$date','L','$doc_name1'),('$u_id','$form','0','$date','D','$doc_name2')";
		$que=mysqli_query($con,$insert);
		if($que){
			
			$select="select * from `u_document` where `login_id`='$u_id'";
			$sql=mysqli_query($con,$select);
			$res=mysqli_fetch_array($sql);
			$admin_status=$res['admin_veri_status'];
			$data[]=array("login_id"=>$u_id,"admin_varification_status"=>$admin_status);
			$json = array("result" => "success", "response" =>$data);
			echo json_encode($json);
		}
		else{
			$json = array("result" => "Error", "response" =>" Error !!");
			echo json_encode($json);
		}
	}

}
?>

