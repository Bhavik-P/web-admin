<?php
require_once('../../config.php');
if(isset($_REQUEST['doc_id'])){
$doc_id=$_REQUEST['doc_id'];
$update=mysqli_query($con,"update `u_document` SET `admin_veri_status`='1' where `login_id`='$doc_id' ");
if($update){
	
	$update1=mysqli_query($con,"update `u_details` SET `admin_doc_veri_status`='2' where `login_id`='$doc_id' ");
	if($update1){
		header("Location:../translator-details.php?id='$doc_id'");
	}
}
}
?>