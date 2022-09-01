<?php
	include 'config/koneksi.php';
	if (!isset($_SESSION['isLogin'])==True) {
		# code...
		header("location:template/login.php");
	}

	$query = "SELECT max(id_jenis_kendaraan) as maxKode FROM jenis_kendaraan";
	$hasil = mysqli_query($conn,$query);
	$data  = mysqli_fetch_array($hasil);
	$kd    = $data['maxKode'];
	$noUrut = (int) substr($kd, 2, 3);
	$noUrut++;
	$char  = "J";
	$newID = $char . sprintf("%03s", $noUrut);

	if (isset($_POST['simpan'])) {
		# code...
		$nama  = $_POST['nama'];
		$tarif = $_POST['tarif'];
		$id    = $_POST['id'];

		mysqli_query($conn, "INSERT INTO jenis_kendaraan (nama_kendaraan,tarif,id_jenis_kendaraan) VALUES ('$nama','$tarif','$id')");

		header('location:?page=kendaraan');
	}
?>
<div class="page-header">
	<h3 class="page-title">Tambah Jenis Kendaraan</h3>
	<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="?page=kendaraan">Jenis Kendaraan</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tambah Jenis Kendaraan</li>
    </ol>
  </nav>
</div>
<div class="grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Form tambah jenis kendaraan</h4>
			<p class="card-description">Untuk menambahkan kendaraan</p>
			<form class="forms-sample" method="post">
				<div class="form-group">
					<label>NAMA</label>
					<input type="text" class="form-control" name="nama" placeholder="Nama Kendaran..">
					<input type="hidden" class="form-control" name="id" value="<?= $newID?>">

				</div>
				<div class="form-group">
					<label>TARIF</label>
					<input type="number" class="form-control" name="tarif" placeholder="Tarif Kendaraan..">
				</div>
				
				<input type="submit" class="btn btn-gradient-primary" name="simpan" value="Simpan">
				<a class="btn btn-light" href="?page=kendaraan">Kembali</a>
			</form>
		</div>
	</div>
</div>



