<?php
	include 'config/koneksi.php';
	if(!isset($_SESSION['isLogin'])==True){header("location:template/login.php");}

?>
	<div class="page-header">
  <h3 class="page-title">
    User - <a href="?page=user&aksi=add">Tambah User</a>
  </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">User</li>
    </ol>
  </nav>
</div>
<div class="grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>IMAGE</th>
              <th>USER NAME</th>
              <th>NAMA USER</th>
              <th>LEVEL</th>
              <th>AKSI</th>
              <th colspan="2"></th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no = 1;
              $sql = mysqli_query($conn, "SELECT user.*, tingkat.nama_level FROM user INNER JOIN tingkat ON user.id_level = tingkat.id_level ORDER BY user.id_user ASC");
          while ($rs=mysqli_fetch_array($sql)) {
                echo '
                  <tr>
                    <td>'.$no.'</td>
                    <td><img src="assets/images/upload/user/'.$rs['image'].'"></td>
                    <td>'.$rs['username'].'</td>
                    <td>'.$rs['nama_user'].'</td>
                    <td>'.$rs['nama_level'].'</td>
                   	<td>
                   		<a href="?page=user&aksi=edit&id='.$rs['id_user'].'">
                   			<i class="mdi mdi-table-edit"></i>
                   		</a>
                   		 <a href="?page=user&aksi=hapus&id='.$rs['id_user'].'">
                   			<i class="mdi mdi-delete text-danger"></i>
                   		</a>	
                   	</td>
                   
                  </tr>
                ';
                $no++;
              }
             ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
