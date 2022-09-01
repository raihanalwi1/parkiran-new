<?php 
error_reporting(0);
session_start();
include "config/koneksi.php";

if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo '<meta http-equiv="refresh" content="0; url=index.php">';

}else{

include 'lib/function.php';
ob_start(); ?>

<html>
<head>
  <title> Laporan</title>

    <style type="text/css">
    body{
        font-family: sans-serif;
    }
    table {
    border-collapse: collapse;
     font-family: sans-serif;
        }
    th {
        height: 30px;
        font-size: 12px;
        font-family: sans-serif;
    }
    table, th, td {
        border: 1px solid black;
        font-size: 11px;
        padding: 5px;
    }

    h3{
        padding-bottom: -15px;
        font-family: sans-serif;
        text-align: center; text-transform: uppercase;
       
    }
    p{
        font-size: 12px;
        text-align: center;
        padding-bottom: -8px;
    }
    .divider-dashed {
    border-top: 1px dashed #ccc;
    background-color: #fff;
    height: 1px;
    margin: 10px 0;
    }

    #kiri
    {
    width:50%;
    height:100px;
    background-color:#FF0;
    float:left;
    }
    #kanan
    {
    width:50%;
    height:100px;
    background-color:#0C0;
    float:right;
    }
    </style>
</head>
<body>
  
<h3 >PDF Transaksi  <br>
<div class="divider-dashed"></div><br><br><!-- 
<p>Tanggal : <?php echo $id1;?> s.d <?php echo $id2;?></p><br> -->
<!-- laporan transaksi -->
<table width="100%">
<tr>
          <th>NO</th>
          <th>KODE PARKIR</th>
          <th>TANGGAL PARKIR</th>
          <th>TANGGAL/ JAM MASUK</th>
          <th>JENIS KENDARAAN</th>
          <th>NO POLISI</th>
          <th>TOTAL BAYAR</th>
          <th>STATUS</th>
          <th>NAMA USER</th>
         
        </th>
      </tr>
      <tbody>
      <?php
       $no = 1;
       $sql = mysqli_query($conn, "SELECT parkir.*, user.*, transaksi_parkir.*, jenis_kendaraan.* FROM parkir INNER JOIN user ON parkir.id_user=user.id_user INNER JOIN transaksi_parkir ON parkir.id_transaksi_parkir=transaksi_parkir.id_transaksi_parkir INNER JOIN jenis_kendaraan ON parkir.id_jenis_kendaraan = jenis_kendaraan.id_jenis_kendaraan WHERE parkir.id_transaksi_parkir LIKE '%$search%' OR parkir.no_plat LIKE '%$search%' ORDER BY parkir.id_parkir ASC");
     while ($rs=mysqli_fetch_array($sql)) {
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
              echo '<label class="badge badge-gradient-success">Keluar </label>';
            }echo'
            </td>
            <td>'.$rs['nama_user'].'</td>

            </tr>
            ';
            $no++;
          }
          ?>
         </tbody>
        <b>Keterangan : 
         <br>1. Total Bayar akan di kalkumulasikan dari jam perjam
         <br>2. Ditambahkan sesuai tarif jenis kendaraan setelah 1 jam pertama
         <br>3. Jika Pengguna tidak sampai 1 jam maka harga berlaku sesuai tarif jenis kendaraan <hr>
          </table>

</body>
</html>


<?php
$html = ob_get_contents();
ob_end_clean();
require_once 'dompdf/dompdf_config.inc.php';
  $dompdf = new dompdf();
  $dompdf->set_paper('A4', 'potrait');
  $dompdf->load_html($html);
  $dompdf->render();
  $dompdf->stream("$nama_file.pdf",array('Attachment'=>0))?>

<?php 
  }
?>

