<div class="col-md-12">
	<h3>Admin Panel</h3>
	<hr>
	<ul class="nav nav-tabs">
	  <?php include "view/admin/menu-admin.php"; ?>
	</ul>
	<div class="tab-bot">
		<div class="row">
			<div class="col-md-12">
				<h4>Data Pesanan</h4>
			</div>
			<div class="col-md-12">
				<table class="admin" border="1">
					<thead>
						<tr>
							<th>No. Pesanan</th>
							<th>Tanggal</th>
							<th>Total</th>
							<th>Kekurangan Pembayaran</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($data == null){
							echo '<tr><td colspan="6" align="center">-- Data tidak ditemukan. -- </td></tr>';
						}else{
						foreach ($data as $key => $value) {
						?>
						<tr>
							<td width="100"><?php echo '#'.$value['id_pesan'] ?></td>
							<td width="100"><?php echo Lib::dateInd($value['tanggal']) ?></td>
							<td><?php echo 'Rp. '.Lib::ind($value['grand_total']) ?></td>
							<td><?php echo ($value['kurang_bayar'] < 0 ) ? '( Kelebihan Pembayaran : Rp. '.abs(Lib::ind($value['kurang_bayar'])).' )' : 'Rp. '.Lib::ind($value['kurang_bayar']) ?></td>
							<td width="300"><?php echo Lib::status($value['status']) ?></td>
							<td width="170" align="center">
								<a href="<?php echo app_base.'detail_pesanan&main=pesanan&nomor_pesan='.$value['id_pesan'].'&id_user='.$value['id_user'] ?>">
									<button class="button button-inline button-small">
										<i class="fa fa-eye"></i> Detail
									</button>
								</a>
								<a onclick="return confirm('Hapus data ini?')" href="<?php echo app_base.'delete_pesanan&main=pesanan&nomor_pesan='.$value['id_pesan'] ?>">
									<button class="button button-inline button-small">
										<i class="fa fa-trash"></i> Hapus
									</button>
								</a>
							</td>
						</tr>
						<?php }} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>