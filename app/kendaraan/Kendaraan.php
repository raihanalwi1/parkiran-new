<?php 
   include 'config/koneksi.php';
   if(!isset($_SESSION['isLogin'])==True){header("location:template/login.php");}
?>
    <div class="page-header">
   <h3 class="page-title">  
     Data Jenis Kendaraan - <a href="?page=kendaraan&aksi=add">Tambah Jenis</a>
 </h3>
    <nav arial-label="breadcrumb">
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?page=dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Jenis Kendaraan</li>
     </ol>
    </nav>
</div>  
<div class="grid-margin stretch-card">
  <div class="card">
   <div class="card-body">
    <div class="form-group">
   </div>
   <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
            <th>NO</th>
            <th>ID JENIS KENDARAAN</th>
            <th>NAMA JENIS KENDARAAN</th>
            <th>TARIF</th>
            <th>AKSI</th>
            <th colspan="2"></th>
        </th>
      </tr>
      <tbody>
      <?php
       $no = 1;
       $sql = mysqli_query($conn, "SELECT * FROM jenis_kendaraan");
        while ($rs=mysqli_fetch_array($sql)) {
         echo '
          <tr>
            <td>'.$no.'</td>
            <td>'.$rs['id_jenis_kendaraan'].'</td>
            <td>'.$rs['nama_kendaraan'].'</td>
            <td> Rp.'.$rs['tarif'].'/jam</td>
            <td>
            <a href="?page=kendaraan&aksi=edit&id='.$rs['id_jenis_kendaraan'].'">
            <i class="mdi mdi-table-edit"></i>
            </a>
            <a href="?page=kendaraan&aksi=hapus&id='.$rs['id_jenis_kendaraan'].'">
            <i class="mdi mdi-delete text-danger"></i>
            </td>

            </tr>
            ';
            $no++;
          }
          ?>
         </tbody>
        </thead>
       </table>
      </div>
    </div>
  </div>
</div>