<h3>Konfirmasi Pemesanan</h3>
<hr>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
		  <div class="panel-heading"><h4>Detail Customer</h4></div>
		  <div class="panel-body">
		  		<?php
		  		if($data1 == null){

		  		}else{
		  			foreach ($data1 as $key1 => $value1) {
		  		?>
		  		<table>
		  			<tr>
		  				<td>Nama</td>
		  				<td>:</td>
		  				<td><?php echo ($_SESSION['jk'] == 'L') ? 'Tn. '. $value1['nama_customer'] : 'Ny. '. $value1['nama_customer'] ?></td>
		  			</tr>
		  			<tr>
		  				<td>No. HP</td>
		  				<td>:</td>
		  				<td><?php echo $value1['no_hp'] ?></td>
		  			</tr>
		  			<tr>
		  				<td>Alamat Pengiriman</td>
		  				<td>:</td>
		  				<td><?php echo $value1['alamat_pengiriman'] ?></td>
		  			</tr>
		  		</table>
		  		<!-- <br>
		  		<small>* Barang akan dikirim via ekspedisi JNE Semarang.</small> -->
		  </div>
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading"><h4>Metode Pembayaran</h4></div>
		  <div class="panel-body">
		  		<table>
		  			<tr>
		  				<td>Metode Pembayaran</td>
		  				<td>:</td>
		  				<td>Transfer</td>
		  			</tr>
		  			<tr>
		  				<td>Jumlah Yang Harus Dibayarkan</td>
		  				<td>:</td>
		  				<td><?php echo 'Rp. '.Lib::ind($value1['grand_total']) ?></td>
		  			</tr>
		  		</table>
		  </div>
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading"><h4>Detail Pengiriman</h4></div>
		  <div class="panel-body">
		  		<table>
		  			<tr>
		  				<td>Kurir</td>
		  				<td>:</td>
		  				<td>JNE</td>
		  			</tr>
		  			<tr>
		  				<td>Biaya Pengiriman</td>
		  				<td>:</td>
		  				<td>Rp. 50.000, -</td>
		  			</tr>
		  			<tr>
		  				<td>Dari</td>
		  				<td>:</td>
		  				<td>Semarang</td>
		  			</tr>
		  			<tr>
		  				<td>Tujuan</td>
		  				<td>:</td>
		  				<td><?php echo $value1['alamat_pengiriman'] ?></td>
		  			</tr>
		  		</table>
		  </div>
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading"><h4>Detail Pemesanan</h4></div>
		  <div class="panel-body">
		  		<table class="table">
		  			<thead>
			    		<tr>
				    		<th>Produk</th>
				    		<th>Qty</th>
				    		<th>Harga</th>
				    		<th>Total</th>
				    	</tr>
			    	</thead>
			    	<tbody>
			    		<?php
			    		if($data2 == null){
			    			echo '<tr><td colspan="4" align="center">-- Data tidak ditemukan. -- </td></tr>';
			    		}else{
			    		foreach ($data2 as $key2 => $value2) {
			    		?>
			    		<tr>
			    			<td><?php echo $value2['jenis'].' - '.$value2['ukuran'].' - '.$value2['kerangka'] ?></td>
				    		<td><?php echo $value2['qty'] ?></td>
				    		<td><?php echo 'Rp. '.Lib::ind($value2['harga']) ?></td>
				    		<td><?php echo 'Rp. '.Lib::ind($value2['harga'] * $value2['qty']);
				    				  $jml[] = $value2['harga'] * $value2['qty'] ?></td>
			    		</tr>
			    		<?php
			    		}}
			    		?>
			    	</tbody>
			    	<tfoot>
			    		<tr>
			    			<th colspan="3">Sub Total</th>
			    			<td><?php echo 'Rp. '.Lib::ind($value1['grand_total']) ?></td>
			    		</tr>
			    	</tfoot>
		  		</table>
		  </div>
		</div>
					<a onclick="return confirm('Pesanan yang dikirim tidak akan dapat diubah lagi, lanjutkan?')" href="<?php echo app_base.'kirim_pesanan&nomor_pesan='.$_GET['nomor_pesan'] ?>&no_hp=<?php echo $value1['no_hp'] ?>">
					<button class="button button-inline button-small button-primary">
							<i class="fa fa-save"></i>
							Kirim Pesanan
					</button>
					</a>
					<a href="<?php echo app_base.'pesan_overview&nomor_pesan='.$_GET['nomor_pesan'] ?>">
						<button type="button" class="button button-inline button-small button-danger">
							<i class="fa fa-save"></i>
							Kembali
						</button>
					</a>
		<?php
		  			}
		  		}
		  		?>
	</div>
</div>