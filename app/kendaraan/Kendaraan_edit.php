<?php
	include 'config/koneksi.php';
	if (!isset($_SESSION['isLogin'])==True) {
		# code...
		header("location:template/login.php");
	}

	$id = $_GET['id'];
	$sql  = mysqli_query($conn, "SELECT * FROM jenis_kendaraan WHERE id_jenis_kendaraan='$id'");
	$row  = mysqli_fetch_array($sql);

	if (isset($_POST['edit'])) {
		# code...
		$nama = $_POST['nama'];
		$tarif = $_POST['tarif'];
		$id = $_POST['id'];

		$update = "UPDATE jenis_kendaraan set nama_kendaraan='$nama', tarif='$tarif' WHERE id_jenis_kendaraan='$id'";
		$query = mysqli_query($conn,$update);

		if($query) {
			# code...
			header('location:?page=kendaraan');

		}else{
			mysqli_error();
		}
	}

?>
<div class="page-header">
	<h3 class="page-title">Edit Jenis Kendaran</h3>
	<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="?page=kendaraan">Jenis Kendaraan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Jenis Kendaraan</li>
    </ol>
  </nav>
</div>
<div class="grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Form edit jenis kendaraan</h4>
			<p class="card-description">Untuk mengubah data kendaraan</p>
			<form class="forms-sample" method="post">
				<div class="form-group">
					<label>NAMA</label>
					<input type="text" class="form-control" name="nama" value="<?=$row['nama_kendaraan']?>">
					<input type="hidden" class="form-control" name="id" value="<?=$row['id_jenis_kendaraan']?>">
				</div>
				<div class="form-group">
					<label>TARIF</label>
					<input type="text" class="form-control" name="tarif" value="<?=$row['tarif']?>">
				</div>

				<input type="submit" class="btn btn-gradient-primary" name="edit" value="Simpan">
				<a class="btn btn-light" href="?page=kendaraan">Kembali</a>
			</form>
		</div>
	</div>
</div>