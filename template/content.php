<?php
	$page = isset($_GET['page']) ? $_GET['page'] : '';
	$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';
		if($page=="dashboard"){
			include 'app/home.php';

		}elseif($page=="user"){
			if ($aksi=="add") {
				# code...
				include 'app/user/user_add.php';
			}elseif($aksi=="hapus"){
				include 'app/user/user_hapus.php';
			}elseif($aksi=="edit"){
				include 'app/user/user_edit.php';
			}elseif ($aksi=="changeprofile") {
				include 'app/user/profile.php';
			}elseif($aksi=="changepass"){
				include 'app/user/password.php';
			}
			else{
				include 'app/user/user.php';
			}
		}elseif ($page=="laporan") {
			# code...
			include 'app/laporan/laporan.php';
		
		}elseif ($page=="kendaraan"){
			if ($aksi=="add") {
				# code...
				include 'app/kendaraan/kendaraan_add.php';
			}elseif($aksi=="edit"){
				include 'app/kendaraan/kendaraan_edit.php';
			}elseif ($aksi=="hapus") {
				# code...
				include 'app/kendaraan/kendaraan_hapus.php';
			}else{
				include 'app/kendaraan/kendaraan.php';
			}
		}elseif ($page=="transaksi-masuk") {
			# code...
			if ($aksi=="hapus") {
				# code...
				include 'app/transaksi/transaksi_hapus.php';
			
			}else{
			include 'app/transaksi/transaksi_masuk.php';
			}
		}elseif ($page=="transaksi-keluar") {
			# code...
			include 'app/transaksi/transaksi_keluar.php';
		}elseif ($page=="level-user") {
			# code...
			if ($aksi=="add") {
				# code...
				include 'app/user/level/tingkat_add.php';
			}elseif($aksi=="hapus"){
				include 'app/user/level/tingkat_hapus.php';
			}elseif($aksi=="edit"){
				include 'app/user/level/tingkat_edit.php';
			}else{
			include 'app/user/level/tingkat.php';
			}
		}elseif ($page=="logout") {
			include 'template/logout.php';
			# code...
		}else{
		echo '
			<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center text-center error-page">
        <div class="row flex-grow">
          <div class="col-lg-7 mx-auto text-white">
            <div class="row align-items-center d-flex flex-row">
              <div class="col-lg-6 text-lg-right pr-lg-4">
                <h1 class="display-1 mb-0 text-danger">404</h1>
              </div>
              <div class="col-lg-6 error-page-divider text-lg-left mb-5 pl-lg-4">
                <h2 class="text-info"><span class="text-white">M</span>AAF!</h2>
                <h3 class="text-info font-weight-light"><span class="text-white">L</span>ink tidak tersedia!</h3>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 text-center mt-xl-2">
                <a class="text-white font-weight-medium text-success" href="?page=dashboard">Back to safe</a>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 mt-xl-2">
                <p class="text-white font-weight-medium text-center">Copyright &copy; 2018  All rights reserved.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
		';
	}

?>
