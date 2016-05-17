<div class="col-md-12">
	<h3>Panel Admin</h3>
	<hr>
	<ul class="nav nav-tabs">
	  <?php include "view/admin/menu-admin.php"; ?>
	</ul>
	<div class="tab-bot">
		<div class="row">
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
				    	<br>
				    	<form method="post" action="<?php echo app_base.'update_status' ?>">
				    	<div class="input-group">
				    	  	  <input type="hidden" name="id_pesan" value="<?php echo $value1['id_pesan'] ?>">
				    	  	  <input type="hidden" name="id_user" value="<?php echo $value1['id_user'] ?>">
							  <select name="status" class="form-control cst">
							  		<option <?php echo ($value1['status'] == '1') ? 'selected' : '' ?> value="1">Pending</option>
							  		<option <?php echo ($value1['status'] == '2') ? 'selected' : '' ?> value="2">Proses Produksi</option>
							  		<option <?php echo ($value1['status'] == '3') ? 'selected' : '' ?> value="3">Proses Pengiriman</option>
							  		<option <?php echo ($value1['status'] == '4') ? 'selected' : '' ?> value="4">Selesai</option>
					    	  </select>
						  <div class="input-group-btn">
						    <button class="btn btn-primary">Update Status</button>
						  </div>
						</div>
						</form>
				    	
				  </div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel panel-default">
				  <div class="panel-heading"><h4>Pembayaran</h4></div>
				  <div class="panel-body">
				    	<table class="admin" border="1">
							<thead>
								<tr>
									<th>Nomor Pesan</th>
									<th>Bank Tujuan</th>
									<th>Bank Pengirim</th>
									<th>No. Rekening</th>
									<th>Pemilik Rekening</th>
									<th>Nominal Bayar</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if($data4 == null){

								}else{
								foreach ($data4 as $key4 => $value4) {
								?>
								<tr>
									<td><?php echo '#'.$value4['id_pesan'] ?></td>
									<td><?php echo $value4['bank_tujuan'] ?></td>
									<td><?php echo $value4['bank_asal'] ?></td>
									<td><?php echo $value4['no_rekening'] ?></td>
									<td><?php echo $value4['nama_pemilik'] ?></td>
									<td><?php echo 'Rp. '.Lib::ind($value4['nominal_bayar']) ?></td>
									<td align="center">
										<?php
										if($value4['is_approved'] == '0'){
										?>
										<a onclick="return confirm('Pembayaran Valid?')" href="<?php echo app_base.'approve_pembayaran&stats=true&nomor_pesan='.$value4['id_pesan'].'&id_konfirmasi='.$value4['id_konfirmasi_pembayaran'].'&id_user='.$value1['id_user'] ?>">
											<button style="border:none;background:none;" title="Approve">
												<i class="fa fa-check" style="color:#1caf9a"></i>
											</button>
										</a>
										<?php
										}else{
										?>
										<a onclick="return confirm('Pembayaran Tidak Valid?')" href="<?php echo app_base.'approve_pembayaran&stats=false&nomor_pesan='.$value4['id_pesan'].'&id_konfirmasi='.$value4['id_konfirmasi_pembayaran'].'&id_user='.$value1['id_user'] ?>">
											<button  style="border:none;background:none;" title="Cancel">
												<i class="fa fa-close" style="color:#da4f49"></i>
											</button>
										</a>
										<?php
										}
										?>
									</td>
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
				 		<a href="<?php echo app_base.'index_pesanan&main=pesanan' ?>">
							<button type="button" class="button button-inline button-small button-danger"><i class="fa fa-arrow-left"></i> Kembali</button>
						</a>
			</div>
			<?php }}}} ?>
		</div>
	</div>
</div>