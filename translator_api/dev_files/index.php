<?php
if($method=='u_document'){
		
			$date=date("Y-m-d H:i:s");

			$u_id = isset($_REQUEST['u_id']) ? mysqli_real_escape_string($con,$_REQUEST['u_id']) : "";
			$eng_doc=isset($_REQUEST['eng_doc']) ? mysqli_real_escape_string($con,$_REQUEST['eng_doc']) : "";
			$spn_doc=isset($_REQUEST['spn_doc']) ? mysqli_real_escape_string($con,$_REQUEST['spn_doc']) : "";
			$form=isset($_REQUEST['form']) ? mysqli_real_escape_string($con,$_REQUEST['form']) : "";
			
			
			
			
			if($u_id=="" && $eng_doc=="" && $spn_doc=="" && $form==""){
					$json = array("result" => "error", "response" =>"All parameters are compulsary");
					echo json_encode($json);
			}
			else{
				//echo $eng_doc;
				$exe="pdf";
				$file = str_replace(' ', '+', $eng_doc);
				$decoded = base64_decode($file);
				$doc_name = md5(microtime()).'_'.$u_id.'_'."eng_doc".'_'.$date.".".$exe;
				file_put_contents('../doc_file/'.$doc_name, $decoded);
				
				$file1 = str_replace(' ', '+', $spn_doc);
				$decoded1 = base64_decode($file1);
				$doc_name1 = md5(microtime()).'_'.$u_id.'_'."spn_doc".'_'.$date.".".$exe;
				file_put_contents('../doc_file/'.$doc_name1, $decoded1);
				
				$file2 = str_replace(' ', '+', $form);
				$decoded2 = base64_decode($file2);
				$doc_name2 = md5(microtime()).'_'.$u_id.'_'."form".'_'.$date.".".$exe;
				file_put_contents('../doc_file/'.$doc_name2, $decoded2);
				
				
				$insert="insert into `u_document` (`login_id`,`certificate`,`admin_veri_status`,`datetime`,`type`,`document_name`) values('$u_id','1','0','$date','L','$doc_name'),('$u_id','2','0','$date','L','$doc_name1'),('$u_id','1099','0','$date','D','$doc_name2')";
				$que=mysqli_query($con,$insert);
				if($que){
					
					$update="update `u_details` SET `admin_doc_veri_status`='1' where `login_id`='$u_id'";
					echo $update;
					$que1=mysqli_query($con,$update);
					if($que1){
						$select="select * from `u_details` where `login_id`='$u_id'";
						$sql=mysqli_query($con,$select);
						$res=mysqli_fetch_array($sql);
						$admin_status=$res['admin_doc_veri_status'];
						$data[]=array("login_id"=>$u_id,"admin_verification_status"=>$admin_status);
						$json = array("result" => "success", "response" =>$data);
						echo json_encode($json);
					}
				}
				else{
					$json = array("result" => "error", "response" =>" Error !!");
					echo json_encode($json);
				}
			}

		
	}
	?>