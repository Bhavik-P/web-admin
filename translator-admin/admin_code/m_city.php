<?php
require_once "../../config.php";
if($_REQUEST['id'])
{
	$c_id=$_REQUEST['id'];
		
	$select_query="select * from `state` where `country_id`='$c_id' AND `status`='1'";
	$exe_select_query=mysqli_query($con,$select_query);

	while($fetch_row=mysqli_fetch_array($exe_select_query))
	{
	?>
	   <option value="<?php  echo $fetch_row['id']; ?>">
		 <?php echo $fetch_row['state_name']; ?>
		</option>
	<?php
	}
}
?>        



