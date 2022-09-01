
<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a href="?page=dashboard">
          <h2 class="navbar-brand brand-logo text-primary">
            <strong class="text-info">
            Smart Parking 
            </strong>
          </h2>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
                <img src="assets/images/upload/user/<?=$_SESSION['image']?>" alt="image">
                <span class="availability-status online"></span>             
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black"><?=ucwords($_SESSION['nama'])?></p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="?page=user&aksi=edit&id=<?= $_SESSION['id_user'] ?>">
                <i class="mdi mdi mdi-settings mr-2 text-primary"></i>
                Ubah profile
              </a>
              <a class="dropdown-item" href="?page=logout">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Signout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar nav">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <img src="assets/images/upload/user/<?=$_SESSION['image']?>" alt="profile">
                <span class="login-status online"></span> <!--change to offline or busy as needed-->              
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2"><?=ucwords($_SESSION['username'])?></span>
                <span class="text-secondary text-small">
                  <?= 
                  $lvl = ($_SESSION['tingkat']);
                   
                  switch ($lvl) {
                  case "1":
                    echo "Admin";
                    break;
                  case "2":
                    echo "Penjaga";
                    break;
                }?>        
               </span>
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <h5>HOME</h5>
            <a class="nav-link" href="?page=dashboard">
              <span class="menu-title">Dashboard</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-home"></i>
            </a>
          </li><?php  if ($_SESSION['tingkat']==1) {?>
          <li class="nav-item">
            <h5>DATA MASTER</h5>
            <a class="nav-link" data-toggle="collapse" href="#akun" aria-expanded="false" aria-controls="akun">
              <span class="menu-title">Data Master</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-envelope"></i>
            </a>
            <div class="collapse" id="akun">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="?page=kendaraan">
                    <span class="menu-title">Jenis Kendaraan</span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-car"></i>
                    
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?page=user">
                    <span class="menu-title">Data User </span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-user"></i>
                    
                  </a>
                </li>
              </ul>
            </div>
          </li> 
         <?php }if ($_SESSION['tingkat']==1 OR $_SESSION['tingkat']==2 ){?>
          <li class="nav-item">
             <h5>DATA TRANSAKSI</h5>
            <a class="nav-link" data-toggle="collapse" href="#data_transaksi" aria-expanded="false" aria-controls="data transaksi">
              <span class="menu-title">Data Transaksi</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-suitcase"></i>
            </a>
            <div class="collapse" id="data_transaksi">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="?page=transaksi-masuk">
                    <span class="menu-title">Parkir Masuk</span>
                    
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?page=transaksi-keluar">
                    <span class="menu-title">Parkir Keluar</span>
                    
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <?php }if ($_SESSION['tingkat']==1 OR $_SESSION['tingkat']==2 ){?>
           <li class="nav-item">
             <h5>LAPORAN</h5>
            <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="data transaksi">
              <span class="menu-title">Laporan</span>
              <i class="menu-arrow"></i>
              <i class="fa fa-book"></i>
            </a>
            <div class="collapse" id="laporan">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="?page=laporan">
                    <span class="menu-title">Laporan</span>
                    <i class="menu-arrow"></i>
                    <i class="fa fa-book"></i>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <?php }?>
        </ul>
      </nav>
