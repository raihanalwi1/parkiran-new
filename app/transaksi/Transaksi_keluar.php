<?php 
	include 'config/koneksi.php';
	ini_set('date.timezone', 'Asia/Jakarta');
	if (!isset($_SESSION['isLogin'])==True) {
		# code...
		header("location:template/login.php");
	}

	
	if (isset($_POST['simpan'])) {
		# code...
		$klr = date('Y-m-d H:i:s');
		$id  = $_POST['id'];
		$sql = mysqli_query($conn,"SELECT * FROM transaksi_parkir WHERE id_transaksi_parkir='$id'");
		while($rs=mysqli_fetch_array($sql)){
			$awal = date_create($rs['waktu_masuk']);
			$akhir = date_create($klr);
			$id_jenis = $rs['id_jenis_kendaraan'];
      $diff  = date_diff( $awal, $akhir );
      // $diff = $akhir - $awal;
      // $jam = floor($diff / (60 * 60));
      // $menit = $diff - $jam * (60 * 60);
		 // $hasil = round(($akhir - $awal)/3600, 1);
			$query = mysqli_query($conn,"SELECT jenis_kendaraan.*, transaksi_parkir.* FROM jenis_kendaraan INNER JOIN transaksi_parkir ON transaksi_parkir.id_jenis_kendaraan=jenis_kendaraan.id_jenis_kendaraan");
			while($rs = mysqli_fetch_array($query)){
				$tarif = $rs['tarif'];
        if ($awal->format('d M Y h') == $akhir->format('d M Y h')) {
          $total = $tarif;  
        }else{
          $total = $diff->h * $tarif ;
        }
			}

		}
		mysqli_query($conn, "UPDATE transaksi_parkir SET status_parkir='0', waktu_keluar='$klr', total_bayar='$total' WHERE id_transaksi_parkir='$id'");
		header('location:?page=transaksi-keluar');
	}

// $awal  = strtotime('2019-04-17 11:46:22');
// $akhir = strtotime('2019-04-17 11:46:30');
// $diff  = $akhir - $awal;

// $jam   = floor($diff / (60 * 60));
// $menit = $diff - $jam * (60 * 60);
// echo 'Waktu tinggal: ' . $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit';

  $search = "";

  if (isset($_POST['btn_cari'])) {
    # code...
    if (empty($_POST['cari'])) {
      # code...
      $search = null;
      header('location:?page=transaksi-keluar');
    }else{
      $search = $_POST['cari'];
      header('location:?page=transaksi-keluar&search='.$search);
    }
  }
  if (isset($_GET['search'])) {
    # code...
    $search = $_GET['search'];
  }
 
?>
<form method="post">
<table style="width: 100%;border-collapse: 0px;border-spacing: 0px;">
	<tr>
		<td colspan="3">
			<span style="font-size: 24px;">Bayar Kendaraan Parkir Keluar</span>
		</td>
		<tr>
			<td colspan="3"><hr></td>
		</tr>
				<td style="width: 200px"> Id Parkir</td>
				<td style="width: 1px"> :</td>
				<td>
					<input list="id" name="id" class="form-control" autocomplete="off">
				</td>
		 <tr>
        <td style="width: 200px;">&nbsp;</td>
        <td style="width: 1px;">&nbsp;</td>
        <td>
          <input type="submit" name="simpan" id="simpan" value="Simpan">
        </td>
      </tr>
	</tr>
</table>
</form>
<datalist id="id">
	<?php
		$sql = mysqli_query($conn,"SELECT parkir.*, transaksi_parkir.* FROM parkir INNER JOIN transaksi_parkir ON parkir.id_transaksi_parkir=transaksi_parkir.id_transaksi_parkir  WHERE status_parkir='1'");
		while ($rs=mysqli_fetch_array($sql)) {
			echo '<option value="'.$rs['id_transaksi_parkir'].'">'.$rs['no_plat'].'</option>';
		}
	?>
	
</datalist>
<td><hr></td>
<div class="page-header">
   <h3 class="page-title">	
	 Data Parkir Keluar
	</h3>
	<nav arial-label="breadcrumb">
	 <ol class="breadcrumb">
	 	<li class="breadcrumb-item"><a href="?page=dasboard">Dashboard</a></li>
	 	<li class="breadcrumb-item active" aria-current="page">Parkir Keluar</li>
	 </ol>
	</nav>
</div> 	
<div class="grid-margin stretch-card">
  <div class="card">
   <div class="card-body">
    <div class="form-group">
     <form class="input-group" role="search" action="" method="POST">
      <input type="text" class="form-control" placeholder="Berdasarkan Kode Parkir dan Plat nomor..." name="cari">
      <div class="input-group-append">
        <button class="btn-dm btn-gradient-light" type="submit" name="btn_cari" id="btn_cari">	
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
      		<th>NO</th>
      		<th>KODE PARKIR</th>
      		<th>TANGGAL PARKIR</th>
      		<th>TANGGAL/ JAM MASUK</th>
      		<th>JENIS KENDARAAN</th>
      		<th>NO POLISI</th>
          <th>TOTAL BAYAR</th>
      		<th>STATUS</th>
      		<th colspan="2"></th>
      	</th>
      </tr>
      <tbody>
      <?php
       $no = 1;
       $sql = mysqli_query($conn, "SELECT parkir.*, transaksi_parkir.*, jenis_kendaraan.* FROM parkir INNER JOIN transaksi_parkir ON parkir.id_transaksi_parkir=transaksi_parkir.id_transaksi_parkir INNER JOIN jenis_kendaraan ON parkir.id_jenis_kendaraan = jenis_kendaraan.id_jenis_kendaraan WHERE parkir.id_transaksi_parkir LIKE '%$search%' OR parkir.no_plat LIKE '%$search%' ORDER BY parkir.id_parkir DESC");
     while ($rs=mysqli_fetch_array($sql)) {
     	 echo '
     	  <tr>
     	    <td>'.$no.'</td>
            <td>'.$rs['id_transaksi_parkir'].'</td>
            <td>'.$rs['waktu_masuk'].'</td>
            <td>'.$rs['waktu_keluar'].'</td>
            <td>'.$rs['nama_kendaraan'].'</td>
            <td>'.$rs['no_plat'].'</td>
            <td>'.$rs['total_bayar'].'</td>
            <td>';
            if($rs['status_parkir']=='1'){
            	echo '<label class="badge badge-gradient-danger">Masih </label>';
            }else{
            	echo '<label class="badge badge-gradient-success">Keluar </label>';
            }echo'
            </td>

            </tr>
            ';
            $no++;
          }
          ?>
         </tbody>
        </thead>
        <b>Keterangan : 
         <br>1. Total Bayar akan di kalkumulasikan dari jam perjam
         <br>2. Ditambahkan sesuai tarif jenis kendaraan setelah 1 jam pertama
         <br>3. Jika Pengguna tidak sampai 1 jam maka harga/jam <hr>
       </table>
      </div>
    </div>
  </div>
</div>



            	



