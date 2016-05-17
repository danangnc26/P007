<div class="col-md-12">
	<h3>Panel Admin</h3>
	<hr>
	<ul class="nav nav-tabs">
	  <?php include "view/admin/menu-admin.php"; ?>
	</ul>
	<div class="tab-bot">
		<div class="row">
			<div class="col-md-12">
				<h4>Data Pembayaran</h4>
			</div>
			<div class="col-md-12">
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
						if($data == null){

						}else{
						foreach ($data as $key => $value) {
						?>
						<tr>
							<td><?php echo '#'.$value['id_pesan'] ?></td>
							<td><?php echo $value['bank_tujuan'] ?></td>
							<td><?php echo $value['bank_asal'] ?></td>
							<td><?php echo $value['no_rekening'] ?></td>
							<td><?php echo $value['nama_pemilik'] ?></td>
							<td><?php echo 'Rp. '.Lib::ind($value['nominal_bayar']) ?></td>
							<td align="center">
								<?php
								if($value['is_approved'] == '0'){
								?>
								<a onclick="return confirm('Pembayaran Valid?')" href="<?php echo app_base.'approve_pembayaran&stats=true&nomor_pesan='.$value['id_pesan'].'&id_konfirmasi='.$value['id_konfirmasi_pembayaran'] ?>">
									<button style="border:none;background:none;" title="Approve">
										<i class="fa fa-check" style="color:#1caf9a"></i>
									</button>
								</a>
								<?php
								}else{
								?>
								<a onclick="return confirm('Pembayaran Tidak Valid?')" href="<?php echo app_base.'approve_pembayaran&stats=false&nomor_pesan='.$value['id_pesan'].'&id_konfirmasi='.$value['id_konfirmasi_pembayaran'] ?>">
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
</div>