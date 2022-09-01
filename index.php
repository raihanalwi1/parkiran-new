
<?php
	if(!isset($_SESSION['isLogin'])==True){
	header('location:index1.php?page=dashboard');
}
?>