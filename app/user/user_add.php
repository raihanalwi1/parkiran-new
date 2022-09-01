<?php 
include 'config/koneksi.php';
if(!isset($_SESSION['isLogin'])==True){header('location:login');}

if(isset($_POST['submit'])){

	$un = $_POST['username'];
	$pw = md5($_POST['password']);
	$nm = $_POST['nama'];
	$il = $_POST['id_level'];

	//upload image
	$lokasi_file = $_FILES['image']['tmp_name'];
  $tipe_file   = $_FILES['image']['type'];
  $nama_file   = $_FILES['image']['name'];
  $direktori   = "assets/images/upload/user/$nama_file";
	
	if(!empty($lokasi_file)){
		move_uploaded_file($lokasi_file,$direktori); 
		
		mysqli_query($conn, "INSERT INTO user (username, password, nama_user, id_level, image) VALUES ('$un', '$pw', '$nm', '$il', '$nama_file')");

		header('location:?page=user');
	}else{
		mysqli_error();
	}

	
}

?>
<div class="page-header">
	<h3 class="page-title">Tambah Data Petugas</h3>
	<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="?page=petugas">Data Petugas</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tambah Data Petugas</li>
    </ol>
  </nav>
</div>
<div class="grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Form tambah data petugas</h4>
			<p class="card-description">Untuk menambahkan petugas</p>
			<form class="forms-sample" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" class="form-control" name="nama" placeholder="Nama anda..">
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="username" placeholder="Username anda..">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" placeholder="Masukkan password..">
				</div>
				<div class="form-group">
					<label>Konfirmasi Password</label>
					<input type="password" class="form-control" placeholder="Konfirmasi password..">
				</div>
				<div class="form-group">
					<label>Level User</label>
					<select name="id_level" class="form-control">
						<?php 
							$sql = mysqli_query($conn, "SELECT * FROM tingkat order by id_level");
							while($rs = mysqli_fetch_array($sql)){
								echo '
									<option value="'.$rs['id_level'].'">
										'.$rs['nama_level'].'
									</option>
								';
							}
						?>
					</select>
				</div>
				<div class="form-group">
	        <label>File upload</label>
	        <input type="file" name="image" class="file-upload-default">
	        <div class="input-group">
	          <input type="text" name="image" class="form-control file-upload-info" disabled placeholder="Upload Image">
	          <span class="input-group-pageend">
	            <button class="file-upload-browse btn btn-sm btn-gradient-info" type="button">Upload</button>
	          </span>
	        </div>
	      </div>
	      <input type="submit" class="btn btn-gradient-primary" name="submit" value="Simpan">
				<a class="btn btn-light" href="?page=petugas">Kembali</a>		
			</form>
		</div>
	</div>
</div>