<h3>Detail Pemesanan</h3>
<hr>
<div class="row" >
		<div class="col-md-12">
			<?php
			if($data1 == null){

			}else{
			foreach ($data1 as $key1 => $value1) {
				if($data3 == null){

				}else{
				foreach ($data3 as $key3 => $value3) {
			?>
			<div class="col-md-12">
				<h4>Detail Pesanan</h4>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
				  <div class="panel-heading"><h4>Detail Customer</h4></div>
				  <div class="panel-body">
				    	<table>
				    		<tr>
				  				<td valign="top" width="150">Tanggal Pesan</td>
				  				<td valign="top">:</td>
				  				<td valign="top"><?php echo Lib::dateInd($value1['tanggal']) ?></td>
				  			</tr>
				    		<tr>
				  				<td valign="top">Nama Customer</td>
				  				<td valign="top">:</td>
				  				<td valign="top"><?php echo $value3['nama_lengkap'] ?></td>
				  			</tr>
				    		<tr>
				  				<td valign="top">No. HP</td>
				  				<td valign="top">:</td>
				  				<td valign="top"><?php echo $value1['no_hp'] ?></td>
				  			</tr>
				  			<tr>
				  				<td valign="top">Alamat Pengiriman</td>
				  				<td valign="top">:</td>
				  				<td valign="top"><?php echo $value1['alamat_pengiriman'] ?></td>
				  			</tr>
				    	</table>
				  </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
				  <div class="panel-heading"><h4>Status</h4></div>
				  <div class="panel-body">
				    	<table>
				    		<tr>
				    			<td>No. Pesanan</td>
					    		<td>:</td>
					    		<td><?php echo '#'.$value1['id_pesan'] ?></td>
				    		</tr>
				    		<tr>
				    			<td>Tagihan</td>
					    		<td>:</td>
					    		<td><?php echo 'Rp. '.Lib::ind($value1['grand_total']) ?></td>
				    		</tr>
				    		<tr>
				    			<td>Sudah Dibayar</td>
				    			<td>:</td>
				    			<td><?php echo 'Rp. '.Lib::ind($data5) ?></td>
				    		</tr>
				    		<tr>
				    			<td>Status Tagihan</td>
				    			<td>:</td>
				    			<td>
				    				<?php echo (($data5 == $value1['grand_total']) or ($data5 >= $value1['grand_total'])) ? 'Lunas' : 'Sudah Dibayar ( Belum Lunas )' ?>
				    			</td>
				    		</tr>
				    	</table>				    	
				  </div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel panel-default">
				  <div class="panel-heading"><h4>Pembayaran</h4></div>
				  <div class="panel-body">
				    	<table class="resp" border="1">
							<thead>
								<tr>
									<th>Nomor Pesan</th>
									<th>Bank Tujuan</th>
									<th>Bank Pengirim</th>
									<th>No. Rekening</th>
									<th>Pemilik Rekening</th>
									<th>Nominal Bayar</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if($data4 == null){

								}else{
								foreach ($data4 as $key4 => $value4) {
								?>
								<tr>
									<td data-label="Nomor Pesan"><?php echo '#'.$value4['id_pesan'] ?></td>
									<td data-label="Bank Tujuan"><?php echo $value4['bank_tujuan'] ?></td>
									<td data-label="Bank Pengirim"><?php echo $value4['bank_asal'] ?></td>
									<td data-label="No. Rekening"><?php echo $value4['no_rekening'] ?></td>
									<td data-label="Pemilik Rekening"><?php echo $value4['nama_pemilik'] ?></td>
									<td data-label="Nominal Bayar"><?php echo 'Rp. '.Lib::ind($value4['nominal_bayar']) ?></td>
								</tr>
								<?php }} ?>
							</tbody>
						</table>
				  </div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel panel-default">
				  <div class="panel-heading"><h4>Daftar Pesanan</h4></div>
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
					    	<?php
					    	if($data2 == null){
					    		echo '<tr><td colspan="4" align="center">-- Data tidak ditemukan. -- </td></tr>';
					    	}else{
					    	$jml = [];
					    	foreach ($data2 as $key2 => $value2) {
					    	?>
					    	<tbody>
					    		<tr>
						    		<td><?php echo $value2['jenis'].' - '.$value2['ukuran'].' - '.$value2['kerangka'] ?></td>
						    		<td><?php echo $value2['qty'] ?></td>
						    		<td><?php echo 'Rp. '.Lib::ind($value2['harga']) ?></td>
						    		<td><?php echo 'Rp. '.Lib::ind($value2['harga'] * $value2['qty']);
						    				  $jml[] = $value2['harga'] * $value2['qty'] ?></td>
						    	</tr>
					    	</tbody>
					    	<?php
					    	}
					    	?>
					    	<tfoot>
					    		<tr>
					    			<th colspan="3">Sub Total</th>
					    			<td><?php echo 'Rp. '.Lib::ind(array_sum($jml)) ?></td>
					    		</tr>
					    	</tfoot>
					    	<?php } ?>
					    </table>
				  </div>
				</div>
				 		<a href="<?php echo app_base.'daftar_pesananku' ?>">
							<button type="button" class="button button-inline button-small button-danger"><i class="fa fa-arrow-left"></i> Kembali</button>
						</a>
						<a href="<?php echo app_base.'konfirmasi_pembayaran&nomor_pesan='.$value1['id_pesan'] ?>">
							<button class="button button-inline button-small button-primary">
								<i class="fa  fa-send"></i> Konfirmasi Pembayaran
							</button>
						</a>
			</div>
			<?php }}}} ?>
		</div>
</div>