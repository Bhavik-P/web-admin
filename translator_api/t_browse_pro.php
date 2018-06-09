<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$tra_id=isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "";	
	if($tra_id=='' && $pro_id==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{
		$select_p="select * from `project` where `status`='A' AND `running_status`='O'";
		$sql=mysqli_query($con,$select_p);
		
		while($res1=mysqli_fetch_array($sql)){
			$pro_id=$res1['id'];
			$pro_type=$res1['project_type'];
			$pro_name=$res1['project_name'];
			$datetime=$res1['datetime'];
			$cus_id=$res1['cus_id'];
			$for_type=$res1['for_project'];
			
			
			$select="select * from `pro_u_invite` where `pro_id`='$pro_id' AND `tra_id`='$tra_id'";
			$que=mysqli_query($con,$select);
			$already_avl=0;
			if(mysqli_num_rows($que)==1){
				$already_avl++;
				
			}
			else{
			
				$select_c="select * from `u_details` where `login_id`='$cus_id'";
				$sql2=mysqli_query($con,$select_c);
				$not_aval_proj=0;
				while($res3=mysqli_fetch_array($sql2)){
					$c_fname=$res3['f_name'];
					$c_lname=$res3['l_name'];
					
				
					if($for_type=='PU'){
						$array[]=array("project_id"=>$pro_id,"project_name"=>$pro_name,"client_fname"=>$c_fname,"client_lname"=>$c_lname,"project_type"=>$pro_type,"date&time"=>$datetime);
						
						
					}
					else{
						$not_aval_proj++;
					}
					
				}
				
				
			}
		}
				
			if(mysqli_num_rows($sql)==$not_aval_proj){
				$array=array("projects not available");
			}
		$json = array("result" => "Success", "response" =>$array);
		echo json_encode($json);
		
	}
}
?>