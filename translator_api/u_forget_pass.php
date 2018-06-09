<?php
require_once("../config.php");
if($_SERVER['REQUEST_METHOD'] == "GET"){
	
	$email_id = isset($_REQUEST['email']) ? mysqli_real_escape_string($con,$_REQUEST['email']) : "";
	if($email_id=='' ){
		$json = array("result" => "Error", "response" =>"All parameters are compulsary");
		echo json_encode($json);
	}
	else{
		$select="select * from `u_login` where `email_id`='$email_id'";
		$que=mysqli_query($con,$select);
		if(mysqli_num_rows($que)==1){
			$res=mysqli_fetch_array($que);
			$pass=$res['password'];
			$id=$res['id'];
			$data[]=array("login_id"=>$id);
			
			$to=$email_id;
			$subject='Forget password ';
			$message='Your password : '.$pass; 
			$headers='From:translator@root2leafinfotech.com';
			$m=mail($to,$subject,$message,$headers);
			if($m){
				//echo"Password send on your email_id";
			}
			else{
				//echo"error!!!";
			}
			$json = array("result" => "success", "response" =>$data);
			echo json_encode($json);
		}
		else{
			$json = array("result" => "Error", "response" =>"Invalid email_id !!");
			echo json_encode($json);
		}
	}
}
?>