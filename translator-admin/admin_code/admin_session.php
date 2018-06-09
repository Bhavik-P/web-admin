<?php
session_start();
if($_SESSION['login_id']=="")
{
	header('Location:../translator-admin/extra-login.php');
	exit();
}
?>