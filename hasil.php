<?php
include 'config/koneksi.php';
$id = $_GET['id'];
$query = "SELECT * FROM transaksi_parkir WHERE id_transaksi_parkir = '$id'";


?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Parkir Receipt</title>
  
  <style type="text/css" media="all">
  
  *{
  margin: 0;
  padding: 0;
}
  /*  Code39Azalea Copyright 2012 Jerry Whiting (CC BY-ND 3.0) azalea.com/web-fonts/  */
  @font-face {
                font-family: code39;
                src: url('Code39Azalea/Code39Azalea.ttf');
            }
            div{text-align: center}
  body {
  background-color: #d7d6d3;
  }
  
  #invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding: 2mm;
  margin: 0 auto;
  width: 45mm;
  background: #FFF;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: .9em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 30px;
}
#invoice-POS #mid {
  text-align: center;
}
#invoice-POS #bot {
  min-height: 50px;
}


#invoice-POS .info {
  display: block;
  margin-left: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: .5em;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: .5em;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}

#invoice-POS .text-right {
  text-align: right;
}

.barcode {
  font-family: Code39AzaleaFont;
  font-size:48px;
  text-align: center;
  }
  .scan-barcode{
  font-family: Code39AzaleaFont;
  text-align: center;
  height: 30px;
  width: 100%;
  border: 0;
  padding: 0;
  margin: 0;
  }
  .line-space {
  margin: 10px 0;
  }

  </style>

 
<style type="text/css">
* : (input, textarea) {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
 
}
</style>
<style type="text/css">
img {
     -webkit-touch-callout: none;
     -webkit-user-select: none;
    }
</style>
 

</head>

<body>
  <div id="invoice-POS">
  
  <center id="top">
  <div class="info"> 
  <h2>PARKING RECEIPT</h2><br/>
  <?php
 
  $data = mysqli_query($conn, $query);
while ($rs = mysqli_fetch_array($data)){
  $jn = $rs['id_jenis_kendaraan'];
  switch ($jn) {
    case 'J001':
      echo "<b>Motor</b>";
      break;
    case 'J002':
      echo "<b>Mobil</b>";
      break;
    case 'J003':
      echo "<b>Truk</b>";
      break;
    default:
      echo "Ganemu kendaraan";
  }
  echo'
  <div name="id"><font face="code39" size="6em">*'.$rs['id_transaksi_parkir'].'*</font></div>
  </div><!--End Info-->
  
  </center><!--End InvoiceTop-->
  <br/>
  <div id="mid">
  <h1>'.$rs['waktu_masuk'].'</h1>
    
  </div><!--End Invoice Mid-->';
}
  ?>
  <div id="bot">

   

  <div id="legalcopy"><center>
  <p class="legal"><strong>Terima kasih. atas kunjungan anda!</strong>  Jika ada keluhan masalah sistem, hubungi support di 085714150449.
  </p></center>
  </div>

  </div><!--End InvoiceBot-->
  </div><!--End Invoice-->
  
</body>
</html>
<!-- <!doctype html>
<html>
    <head>

       
        <style>
            @font-face {
                font-family: code39;
                src: url('Code39Azalea/Code39Azalea.ttf');
            }
            div{text-align: center}
        </style>
    </head>
    <body>
        <div><font face="code39" size="6em">*198507262006021003*</font></div>
        <div><font size="0.5em">198507262006021003</font></div>
        ddd
    </body>
</html> -->