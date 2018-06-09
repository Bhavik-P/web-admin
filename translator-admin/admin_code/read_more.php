<?php
require_once('../../config.php');
if(isset($_REQUEST['pro_id'])){
	$pro_id=$_REQUEST['pro_id'];	 
	$select="select * from `project` where `id`='$pro_id'";	  
	$que=mysqli_query($con,$select);	  
	$result=mysqli_fetch_array($que);
	echo $result['project_desc']."<a id='".$pro_id."' class='read_short'>...Read Less</a>";	
}
?>
  <script>
  $('.read_short').click(function(){
		var pro_id =$(this).attr('id');
		
		$('#read_less').show();
		$('#read_full').hide();
		
	});
  </script>