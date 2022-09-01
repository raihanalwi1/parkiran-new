<?php 
  include 'config/koneksi.php';
  
  if (!isset($_SESSION['isLogin'])==True) {
    # code...
    header("location:template/login.php");
  }

  $kats = isset($_GET['kat']) ? $_GET['kat'] : '';  

  if(isset($_POST['btn_cari'])) {
    # code...
    $kat = $_POST['pinjam'];
    if ($kat=='0') {
      $awal = $_POST['awal'];
      $akhir = $_POST['akhir'];
      header('location:?page=laporan&kat='.$kat.'&awal='.$awal.'&akhir='.$akhir);
    }else{
      
      header('location:?page=laporan');
    }

  }
  if(isset($_GET['kat'])){
    $awal = $_GET['awal'];
    $akhir = $_GET['akhir'];

     if ($_GET['kat']=='0') {
      # code...
    $data = mysqli_query($conn, "SELECT parkir.*, user.*, transaksi_parkir.*, jenis_kendaraan.* FROM parkir INNER JOIN user ON parkir.id_user=user.id_user INNER JOIN transaksi_parkir ON parkir.id_transaksi_parkir=transaksi_parkir.id_transaksi_parkir INNER JOIN jenis_kendaraan ON parkir.id_jenis_kendaraan = jenis_kendaraan.id_jenis_kendaraan where transaksi_parkir.waktu_masuk BETWEEN '$awal' and '$akhir' order by id_parkir DESC");
     }elseif ($_GET['kat']=='1') {
      # code...
      $data = mysqli_query($conn, "SELECT parkir.*, user.*, transaksi_parkir.*, jenis_kendaraan.* FROM parkir INNER JOIN user ON parkir.id_user=user.id_user INNER JOIN transaksi_parkir ON parkir.id_transaksi_parkir=transaksi_parkir.id_transaksi_parkir INNER JOIN jenis_kendaraan ON parkir.id_jenis_kendaraan = jenis_kendaraan.id_jenis_kendaraan where transaksi_parkir.waktu_keluar BETWEEN '$awal' and '$akhir' order by id_transaksi_parkir DESC");
     }
  }else{
    $data = mysqli_query($conn, "SELECT parkir.*, user.*, transaksi_parkir.*, jenis_kendaraan.* FROM parkir INNER JOIN user ON parkir.id_user=user.id_user INNER JOIN transaksi_parkir ON parkir.id_transaksi_parkir=transaksi_parkir.id_transaksi_parkir INNER JOIN jenis_kendaraan ON parkir.id_jenis_kendaraan = jenis_kendaraan.id_jenis_kendaraan");
  }
 
?>
<div class="page-header">
  <h3 class="page-title">
    Laporan
  </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Laporan</li>
    </ol>
  </nav>
</div>
<div class="grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      
      <div class="table-responsive">
        <table id="example" class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Parkir</th>
              <th>Tanggal / Jam Masuk</th>
              <th>Tanggal / Jam Keluar</th>
              <th>Jenis Kendaraan</th>
              <th>No Polisi</th>
              <th>Total Bayar</th>
              <th>Status</th>
              <th>Nama User</th>
              <th colspan="2"></th>
              
            </tr>
          </thead>
          <tbody>
            <?php 
           
              $no = 1;
          while ($rs=mysqli_fetch_array($data)) {
                echo '
                  <tr>
                    <td>'.$no.'</td>
                    <td>'.$rs['id_transaksi_parkir'].'</td>
                    <td>'.$rs['waktu_masuk'].'</td>
                    <td>'.$rs['waktu_keluar'].'</td>
                    <td>'.$rs['nama_kendaraan'].'</td>
                    <td>'.$rs['no_plat'].'</td>
                    <td> Rp.'.$rs['total_bayar'].'</td>

                    <td>';
                    if($rs['status_parkir']=='1'){
                      echo '<label class="badge badge-gradient-danger">Masih </label>';
                    }else{
                      echo '<label class="badge badge-gradient-success">Keluar</label>';
                    }echo'
                  </td>
                    <td>'.$rs['nama_user'].'</td>
                   
                  </tr>
                ';
                $no++;
              }
             ?>
             <b>Keterangan : 
         <br>1. Total Bayar akan di kalkumulasikan dari jam perjam
         <br>2. Ditambahkan sesuai tarif jenis kendaraan setelah 1 jam pertama
         <br>3. Jika Pengguna tidak sampai 1 jam maka harga berlaku sesuai tarif jenis kendaraan <hr>
          </tbody>
        </table>
        
      </div>
    </div>
  </div>
</div>