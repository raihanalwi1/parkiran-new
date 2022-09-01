
<?php
ob_start();
session_start();
if(!isset($_SESSION['isLogin'])==True){
	header('location:template/login.php');
}

include 'template/core/header.php';
include 'template/core/sidebar.php';
include 'template/core/body.php';
include 'template/core/footer.php';
?>