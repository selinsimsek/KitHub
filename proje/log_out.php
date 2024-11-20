<?php 
session_start();
$_SESSION['islogin']=0;
header('Location: login_page.php');
?>