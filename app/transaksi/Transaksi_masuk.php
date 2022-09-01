
<?php 
	include 'config/koneksi.php';
	ini_set('date.timezone', 'Asia/Jakarta');
	if (!isset($_SESSION['isLogin'])==True) {
		# code...
		header("location:template/login.php");
	}
	
	$query = "SELECT max(id_transaksi_parkir) as maxKode FROM transaksi_parkir";
	$hasil = mysqli_query($conn,$query);
  $data  = mysqli_fetch_array($hasil);
  $kd = $data['maxKode'];
  $noUrut = (int) substr($kd, 2, 3);
  $noUrut++;
  $char = "T";
  $newID = $char . sprintf("%03s", $noUrut);

	if (isset($_POST['simpan'])) {
		# code...
		$nama = $_POST['nama'];
		$nopol = $_POST['pol'];
		$msk = date('Y-m-d H:i:s');
		$id  = $_POST['id'];
    $ids = $_POST['ids'];
		mysqli_query($conn, "INSERT INTO parkir (no_plat,id_jenis_kendaraan,id_transaksi_parkir,id_user) VALUES ('$nopol','$nama','$id','$ids')");
		mysqli_query($conn, "INSERT INTO transaksi_parkir (waktu_masuk,status_parkir,id_transaksi_parkir,id_jenis_kendaraan) VALUES ('$msk','1','$id','$nama')");
    
		header('location:?page=transaksi-masuk');
	}

  $search = "";

  if (isset($_POST['btn_cari'])) {
    # code...
    if (empty($_POST['cari'])) {
      # code...
      $search = null;
      header('location:?page=transaksi-masuk');
    }else{
      $search = $_POST['cari'];
      header('location:?page=transaksi-masuk&search='.$search);
    }
  }
  if (isset($_GET['search'])) {
    # code...
    $search = $_GET['search'];
  }

?>


<form method="post">
	<table style="width: 100%;border-collapse: 0px;border">
			<tr>
				<td colspan="3"><span style="font-size: 24px;"> Tambah Kendaraan Parkir Masuk</span></td>
			</tr>
			<tr>
				<td colspan="3"><hr></td>
			</tr>
			<tr>
				<td style="width: 200px;">Jenis Kendaraan</td>
				<td style="width: 1px;">:</td>
				<td>
					<select name="nama" id="nama" class="form-control">
						<?php
							$sql=mysqli_query($conn,"SELECT * FROM jenis_kendaraan ORDER BY id_jenis_kendaraan");
							while ($rs=mysqli_fetch_array($sql)) {
								# code...
								echo '<option value="'.$rs['id_jenis_kendaraan'].'">'.$rs['nama_kendaraan'].'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			&nbsp;
			<tr>
				<td style="width: 200px;">No Polisi</td>
				<td style="width: 1px;">:</td>
				<td>
					<input type="text" name="pol" id="pol" class="form-control">
					<input type="hidden" name="id" id="id" value="<?=$newID?>">
          <input type="hidden" name="ids" value="<?=$_SESSION['id_user']?>">
				</td>
			</tr>
			<tr>
        <td style="width: 200px;">&nbsp;</td>
        <td style="width: 1px;">&nbsp;</td>
        <td>
          <input type="submit" name="simpan" id="simpan" value="Selesai">
        </td>
      </tr>
  </table>
  </form>
  
<?php 
	include 'config/koneksi.php';
	if (!isset($_SESSION['isLogin'])==True) {
		# code...
		header("location:template/login.php");
	}
?>

  <td><hr></td>
&nbsp;
<div class="page-header">
  <h3 class="page-title">
    Data Parkir Masuk
  </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Parkir Masuk</li>
    </ol>
  </nav>
</div>
<div class="grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        <form class="input-group" role="search" action="" method="POST">
          <input type="text" class="form-control" placeholder="Berdasarkan Kode Parkir Atau Plat Nomor.." name="cari">
          <div class="input-group-append">
            <button class="btn-sm btn-gradient-light" type="submit" name="btn_cari" id="btn_cari">
            <i class="mdi mdi-magnify"></i>  
              Search
            </button>
            
          </div>
        </form> 
      </div>
      <div id="datatable" class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Parkir</th>
              <th>Tanggal / Jam Masuk</th>
              <th>Jenis Kendaraan</th>
              <th>No Polisi</th>
              <th>Status</th>
              <th colspan="2"></th>
            </tr>
          </thead>
          <tbody>
            <?php 
            // ini query 
              $sql = mysqli_query($conn, "SELECT parkir.*, transaksi_parkir.*, jenis_kendaraan.* FROM parkir INNER JOIN transaksi_parkir ON parkir.id_transaksi_parkir=transaksi_parkir.id_transaksi_parkir INNER JOIN jenis_kendaraan ON parkir.id_jenis_kendaraan = jenis_kendaraan.id_jenis_kendaraan WHERE parkir.id_transaksi_parkir LIKE '%$search%' OR parkir.no_plat LIKE '%$search%' ORDER BY parkir.id_parkir DESC");
              $no =  1;
          while ($rs=mysqli_fetch_array($sql)) {
            
                echo '
                  <tr>
                    <td>'.$no.'</td>
                    <td>'.$rs['id_transaksi_parkir'].'</td>
                    <td>'.$rs['waktu_masuk'].'</td>
                    <td>'.$rs['nama_kendaraan'].'</td>
                    <td>'.$rs['no_plat'].'</td>
                    <td>';
                    if($rs['status_parkir']=='1'){
                      echo '<label class="badge badge-gradient-danger">Masih </label>';
                    }else{
                      echo '<label class="badge badge-gradient-success">Keluar</label>';
                    }echo'
                  </td>
                  <td> <a href="hasil.php?id='.$rs['id_transaksi_parkir'].'" target="_blank"> Tiket </td>
                   
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
		