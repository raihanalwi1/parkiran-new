<?php
	include 'config/koneksi.php';
	if(!isset($_SESSION['isLogin'])==True){
		header("location:template/login.php");
	}

$id = $_GET['id'];
$sql = mysqli_query($conn,"SELECT * FROM user WHERE id_user='$id'");
$row = mysqli_fetch_array($sql);

if (isset($_POST['edit'])) {
	# code...
	$user 	= $_POST['username'];
	$pass	= $_POST['password'];
	$nm 	= $_POST['nama'];
	$lvl    = $_POST['id_level'];
	$id 	= $_POST['id'];


	$update = "UPDATE user set username='$user', password='$pass', nama_user='$nm', id_level='$lvl' WHERE id_user='$id'";
	$query = mysqli_query($conn,$update);

	if($query){
		header('location:?page=user');

	}else{
		mysqli_error();
	}
}
?>

<div class="page-header">
	<h3 class="page-title">Edit Data User</h3>
	<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="?page=user">Data User</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Data User</li>
    </ol>
  </nav>
</div>
<div class="grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">Form edit data user</h4>
			<p class="card-description">Untuk mengubah user</p>
			<form class="forms-sample" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" class="form-control" name="nama" placeholder="Nama anda.." value="<?=$row['nama_user']?>">
					<input type="hidden" name="id" value="<?=$row['id_user']?>">
				</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="username" placeholder="Username anda.." value="<?=$row['username']?>">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" value="<?=$row['password']?>" readonly>
				</div>
				<div class="form-group">
					<label>Level User</label>
					<select name="id_level" class="form-control">
						<?php 
							$sql = mysqli_query($conn, "SELECT * FROM tingkat order by id_level");
							while($rs = mysqli_fetch_array($sql)){
								if($row['id_level']==$rs['id_level']){
									echo '
										<option value="'.$rs['id_level'].'" selected>
											'.$rs['nama_level'].'
										</option>
									';
								}else{
									echo '
										<option value="'.$rs['id_level'].'">
											'.$rs['nama_level'].'
										</option>
									';
								}
							}
						?>
					</select>
				</div>
				<div class="form-group">
          <label for="ProfilePhoto">Foto</label>
          <a href="?page=user&aksi=changeprofile&id=<?=$row['id_user'] ?>" title="Ubah foto profile"><img class="img-thumbnail" src="assets/images/upload/user/<?php echo $row['image']; ?>" height="200px" width="200px"></a>
        </div>
	      <input type="submit" class="btn btn-gradient-primary" name="edit" value="Simpan">
				&nbsp;&nbsp;<a class="btn btn-light" href="?page=user">Kembali</a>		
				<a style="float:right;" class="btn btn-info" href="?page=user&aksi=changepass&id=<?=$row['id_user'] ?>">Ubah Password</a>
			</form>
		</div>
	</div>
</div>