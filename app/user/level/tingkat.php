<?php
	include 'config/koneksi.php';
	if(!isset($_SESSION['isLogin'])==True){header("location:template/login.php");}

?>

<div class="page-header">
  <h3 class="page-title">
    Laporan
  </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="?app=dashboard">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Laporan</li>
    </ol>
  </nav>
</div>
<div class="grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        <form class="input-group" role="search" action="" method="POST">
          <input type="text" class="form-control" placeholder="..." name="cari">
          <div class="input-group-append">
            <button class="btn-sm btn-gradient-light" type="submit" name="btn_cari" id="btn_cari">
            <i class="mdi mdi-magnify"></i>  
              Search
            </button>
            
          </div>
        </form> 
      </div>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Tingkat</th>
              <th>Aski</th>
              <th colspan="2"></th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $no = 1;
              $sql = mysqli_query($conn, "SELECT * FROM tingkat ");
          while ($rs=mysqli_fetch_array($sql)) {
                echo '
                  <tr>
                    <td>'.$no.'</td>
                    <td>'.$rs['nama_level'].'</td>
                    <td>
                    	<a href="?page=level-user&aksi=edit&id='.$rs['id_level'].'">
                    		<i class="mdi mdi-table-edit"></i>
                    	</a>
                    	<a href="?page=level-user&aksi=delete&id='.$rs['id_level'].'">
                    		<i class="mdi mdi-delete text-danger"></i>	
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
