<?php
	include 'config/koneksi.php';
	if(!isset($_SESSION['isLogin'])==True){header("location:template/login.php");}

		//table user
	$ss = "SELECT * FROM user";
	$kk = mysqli_query($conn, $ss);
	$ll = mysqli_num_rows($kk);

	//jenis kendaraan
	$jn = "SELECT * FROM jenis_kendaraan";
	$kn = mysqli_query($conn, $jn);
	$jk = mysqli_num_rows($kn);

	//parkir masuk
	$pr = "SELECT status_parkir FROM transaksi_parkir WHERE status_parkir='1'";
	$ms = mysqli_query($conn, $pr);
	$pm = mysqli_num_rows($ms);

	//parkir masuk
	$pk = "SELECT status_parkir FROM transaksi_parkir WHERE status_parkir='0'";
	$kl = mysqli_query($conn, $pk);
	$pk = mysqli_num_rows($kl);
	
?>
<?php if ($_SESSION['tingkat']==1 OR $_SESSION['tingkat']==2 ){?>
<div class="row">
	<div class="col-md-4 stretch-card grid-margin">
	  <div class="card bg-gradient-danger card-img-holder text-white">
	    <div class="card-body">
	      <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
	      <h4 class="font-weight-normal mb-3">Total Parkir Masuk
	        <i class="mdi mdi-chart-line mdi-24px float-right"></i>
	      </h4>
	      <h2 class="mb-5"><?=$pm?> Parkir Masuk</h2>
	      <h6 class="card-text"><a href="?page=transaksi-masuk">Lihat Selanjutnya... </a></h6>
	    </div>
	  </div>
	</div><div class="col-md-4 stretch-card grid-margin">
	  <div class="card bg-gradient-danger card-img-holder text-white">
	    <div class="card-body">
	      <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
	      <h4 class="font-weight-normal mb-3">Total Parkir Keluar
	        <i class="mdi mdi-chart-line mdi-24px float-right"></i>
	      </h4>
	      <h2 class="mb-5"><?=$pk?> Parkir Keluar</h2>
	      <h6 class="card-text"><a href="?page=transaksi-keluar">Lihat Selanjutnya... </a></h6>
	    </div>
	  </div>
	</div>
	<?php } if ($_SESSION['tingkat']==1) {?>
	<div class="col-md-4 stretch-card grid-margin">
	  <div class="card bg-gradient-info card-img-holder text-white">
	    <div class="card-body">
	      <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
	      <h4 class="font-weight-normal mb-3">Total Jenis Kendaraan
	        <i class="fa fa-car"></i>
	      </h4>
	      <h2 class="mb-5"><?=$jk?> Jenis Kendaraan</h2>
	      <h6 class="card-text"><a href="?page=kendaraan">Lihat Selanjutnya... </a></h6>
	    </div>
	  </div>
	</div>
	<div class="col-md-4 stretch-card grid-margin">
	  <div class="card bg-gradient-success card-img-holder text-white">
	    <div class="card-body">
	      <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
	      <h4 class="font-weight-normal mb-3">Total User
	        <i class="mdi mdi-account mdi-24px float-right"></i>
	      </h4>
	      <h2 class="mb-5"><?=$ll?> User</h2>
	      <h6 class="card-text"><a href="?page=user">Lihat Selanjutnya... </a></h6>
	    </div>
	  </div>
	</div>
		<?php }?>

</div>