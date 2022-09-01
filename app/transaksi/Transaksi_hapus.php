<?php
	include 'config/koneksi.php';
	if(!isset($_SESSION['isLogin'])==True) {
		header("location:template/login.php");
	}
		$id = $_GET['id'];
		$delete = "DELETE FROM transaksi_parkir WHERE id_transaksi_parkir='$id'";
		mysqli_query($conn,"DELETE FROM parkir WHERE id_transaksi_parkir='$id'");
		$query = mysqli_query($conn,$delete);
		if($query)
		{
			header('location:?page=transaksi-masuk');
		}else{
			mysqli_error();
		}
	


?>