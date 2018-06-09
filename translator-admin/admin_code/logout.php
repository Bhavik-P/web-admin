<?php
session_start();
//session_destroy();
unset($_SESSION['login_id']);
header('Location:../extra-login.php');
exit();
?>