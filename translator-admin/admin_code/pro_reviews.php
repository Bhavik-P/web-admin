<?php

require_once('../../config.php');

if(isset($_REQUEST['pro_id'])){

	$project_id=$_REQUEST['pro_id'];
	$select="select * from `pro_review_rating` where `pro_id`='$project_id'  AND `status`='A'";
	$que=mysqli_query($con,$select);
	$query=mysqli_fetch_array($que);
	$review=$query['review'];
	if($review=="" OR $review==NULL){
		echo"No review given";
	}
	else{
		echo $review;
	}
}
?>