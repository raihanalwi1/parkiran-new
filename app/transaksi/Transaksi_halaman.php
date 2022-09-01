
<?php 
	include 'config/koneksi.php';
	if (!isset($_SESSION['isLogin'])==True) {
		# code...
		header("location:template/login.php");
	}
?>
<script>
  	function reloadpage(){
  		location.reload()

  	}
	  $(document).ready(function() {
    $('#datatable').DataTable();
} ); 
  </script>
  
  
&nbsp;
<input type="submit" value="Refresh Page" onclick="document.location.reload(true)">
  <table style="width: 100%;border-collapse: 0px;border-spacing: 0px;">
  		<tr>
		<td>
	
			<table id="datatable" class="table1" style="width: 100%;border-collapse: 0px;border-spacing: 0px;">
				<thead>
					<tr>
						<th style="width: 3%;border: 1px solid #000;padding:3px;text-align: center;font-size: 12px;">NO</th>
						<th style="width: 5%;border: 1px solid #000;padding:3px;text-align: center;font-size: 12px;">Kode Parkir</th>
						<th style="width: 10%;border: 1px solid #000;padding:3px;text-align: center;font-size: 12px;">Tanggal / Jam Masuk</th>
						<th style="width: 10%;border: 1px solid #000;padding:3px;text-align: center;font-size: 12px;">Jenis Kendaraan</th>
						<th style="width: 10%;border: 1px solid #000;padding:3px;text-align: center;font-size: 12px;">No Polisi</th>
						<th style="width: 10%;border: 1px solid #000;padding:3px;text-align: center;font-size: 12px;">Status</th>
						<th style="width: 10%;border: 1px solid #000;padding:3px;text-align: center;font-size: 12px;">AKSI</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$no=1;
					$sql = mysqli_query($conn, "SELECT parkir.*, transaksi_parkir.* FROM parkir INNER JOIN transaksi_parkir ON parkir.id_transaksi_parkir=transaksi_parkir.id_transaksi_parkir ORDER BY parkir.id_parkir ASC");
					while ($rs=mysqli_fetch_array($sql)) {
						# code...
						echo '
							<tr>
								<td style="border: 1px solid #000;padding: 3px;font-size: 12px;text-align: center;">'.$no.'</td>
								<td style="border: 1px solid #000;padding: 3px;font-size: 12px;text-align: center;">'.$rs['id_transaksi_parkir'].'</td>
								<td style="border: 1px solid #000;padding: 3px;font-size: 12px;text-align: center;">'.$rs['waktu_masuk'].'</td>

								<td style="border: 1px solid #000;padding: 3px;font-size: 12px;text-align: center;">'.$rs['id_jenis_kendaraan'].'</td>
								<td style="border: 1px solid #000;padding: 3px;font-size: 12px;text-align: center;">'.$rs['no_plat'].'</td>
								<td style="border: 1px solid #000;padding: 3px;font-size: 12px;">';
								if($rs['status_parkir']=='1')
									{
										echo '<b style="color:red"><center>Masih</b>';
									}else{
										echo '<b>Selesai</b>';
									}
								echo '</td>
								
								<td style="border: 1px solid #000;padding: 3px;font-size: 12px;text-align: center;">
									<a href="?modul=user&aksi=edit&id='.$rs['id_user'].'" style="padding: 5px;"> Edit </a>
									<a href="?modul=user&aksi=hapus&id='.$rs['id_user'].'" style="padding: 5px;"> hapus </a>
									
								</td>
							</tr>
						    ';
						    $no++;
					}
				?>
			</tbody>
			<tfoot>
				<tr colspan="7" style="text-align: left">
					<hr>
				</tr>
			</tfoot>
			</table>
		</td>
	</tr>
  </table>