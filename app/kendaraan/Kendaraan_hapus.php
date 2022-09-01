<?php 
	include 'config/koneksi.php';
	if (!isset($_SESSION['isLogin'])==True) {
		# code...
		header("location:template/login.php");
	}
	$id = $_GET['id'];
	$delete = "DELETE FROM jenis_kendaraan WHERE id_jenis_kendaraan='$id'";
	$query = mysqli_query($conn,$delete);
	if ($query) {
		# code...
		header('location:?page=kendaraan');
	}else{
	 	mysqli_error();
	}
?>