<?php 
include 'config/koneksi.php';
if(!isset($_SESSION['isLogin'])==True){header('location:login');}

$id = $_GET['id'];
$sql 	= mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id'");
$row  = mysqli_fetch_array($sql);

if(isset($_POST['submit'])){
	$pw = $_POST['password'];

  $update = "UPDATE user SET password='$pw' WHERE id_user='$id'";
  $query = mysqli_query($conn, $update);
	if($query){
		header('location:?page=user');
	}else{
  	mysqli_error();
  }
}

?>
<div class="page-header">
	<h3 class="page-title">Ubah foto profile</h3>
	<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="?page=user&aksi=edit&id=<?=$row['id_user'] ?>">Data Edit Petugas</a></li>
      <li class="breadcrumb-item active" aria-current="page">Ganti password</li>
    </ol>
  </nav>
</div>
<div class="grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Form ganti password</h4>
			<p class="card-description">ubah password lama</p>
			<form class="forms-sample" method="post" enctype="multipart/form-data">
				<div class="form-group">
          <label for="ProfilePhoto">Ganti password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password baru..">
        </div>
        <div class="form-group">
          <label for="ProfilePhoto">Konfirmasi password baru</label>
          <input type="password" class="form-control" placeholder="Konfirmasi password baru..">
        </div>
	      <input type="submit" class="btn btn-gradient-primary" name="submit" value="Simpan">
				&nbsp;&nbsp;<a class="btn btn-light" href="?page=user&aksi=edit&id=<?=$row['id_user'] ?>">Kembali</a>		
			</form>
		</div>
	</div>
</div>