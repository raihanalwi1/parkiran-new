<?php 
include 'config/koneksi.php';
if(!isset($_SESSION['isLogin'])==True){header('location:login');}

$id = $_GET['id'];
$sql 	= mysqli_query($conn, "SELECT * FROM user WHERE id_user='$id'");
$row  = mysqli_fetch_array($sql);

if(isset($_POST['submit'])){
	$lokasi_file = $_FILES['image']['tmp_name'];
  $tipe_file   = $_FILES['image']['type'];
  $nama_file   = $_FILES['image']['name'];
  $direktori   = "assets/images/upload/user/$nama_file";
	
	if(!empty($lokasi_file)){
		move_uploaded_file($lokasi_file,$direktori); 
		
		mysqli_query($conn, "UPDATE user SET image='$nama_file' WHERE id_user='$id'");

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
      <li class="breadcrumb-item active" aria-current="page">Profile edit</li>
    </ol>
  </nav>
</div>
<div class="grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Form edit foto profile</h4>
			<p class="card-description">mengubah foto profile</p>
			<form class="forms-sample" method="post" enctype="multipart/form-data">
				<div class="form-group">
          <label>Foto</label>
          <a href="#" title="Ubah foto profile" class="form-control"><img class="img-thumbnail" src="assets/images/upload/user/<?php echo $row['image']; ?>" height="200px" width="200px"></a>
        </div>
        <div class="form-group">
	        <label>File upload</label>
	        <input type="file" name="image" class="file-upload-default">
	        <div class="input-group">
	          <input type="text" name="image" class="form-control file-upload-info" disabled placeholder="Upload Image">
	          <span class="input-group-append">
	            <button class="file-upload-browse btn btn-sm btn-gradient-info" type="button">Upload</button>
	          </span>
	        </div>
	      </div>
	      <input type="submit" class="btn btn-gradient-primary" name="submit" value="Simpan">
				&nbsp;&nbsp;<a class="btn btn-light" href="?page=user&aksi=edit&id=<?=$row['id_user'] ?>">Kembali</a>		
			</form>
		</div>
	</div>
</div>