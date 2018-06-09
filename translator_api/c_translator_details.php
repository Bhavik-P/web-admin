<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	$tra_id=isset($_REQUEST['tra_id']) ? mysqli_real_escape_string($con,$_REQUEST['tra_id']) : "";
	if($tra_id==''){
			$json = array("result" => "Error", "response" =>"All parameters are compulsary");
			echo json_encode($json);
	}
	else{
		$select="select * from `u_login` where `id`='$tra_id'";
		$que=mysqli_query($con,$select);
		$res=mysqli_fetch_array($que);
		$t_email_id=$res['email_id'];
		
		$select_d="select * from `u_details` where `login_id`='$tra_id'";
		$que1=mysqli_query($con,$select_d);
		$res1=mysqli_fetch_array($que1);
		
		$fname=$res1['f_name'];
		$lname=$res1['l_name'];
		$pic=$res1['pic'];
		$about=$res1['about_us'];
		$avg_rating=$res1['avg_rating'];
		$data1[]=($avg_rating);
		
		$select_p="select AVG(pro_id) from `pro_u_awarded` where tra_id='$tra_id' AND `running_status`='CM'";
		$sql=mysqli_query($con,$select_p); 
		$res4=mysqli_fetch_array($sql);	
		$com_pro=$res4['pro_id'];
		$data[]=array("completed_projects"=>$com_pro);
		
		$select_l="select * from `t_languages` where `tra_id`='$tra_id'";
		$que2=mysqli_query($con,$select_l);
		while($res2=mysqli_fetch_array($que2)){
			$lang_id=$res2['lang_id'];
			
			$select_ln="select * from `m_language` where `id`='$lang_id'";
			$que3=mysqli_query($con,$select_ln);
			while($res3=mysqli_fetch_array($que3)){
				$lang=$res3['language'];
				$array1[]=($lang);
			}
			
		}
		
		$array[]=array("translator fname"=>$fname,"translator lname"=>$lname,"translator_email_id"=>$t_email_id,"pic"=>$pic,"about_us"=>$about);
		$json = array("result" => "Success", "response" =>$array,"Skills"=>$array1,"Experience"=>$data,"Rating"=>$data1);
		echo json_encode($json);
	}
}
?>