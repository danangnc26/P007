<h3>Daftar Pesanan</h3>
<hr>
<div class="row">
	<div class="col-md-12">
		<table class="resp">
			<thead>
				<tr>
					<th>No.</th>
					<th>Tanggal</th>
					<th>Total</th>
					<th>Status</th>
					<th width="380">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if($data == null){
					echo '<tr><td colspan="5" align="center">-- Data tidak ditemukan. -- </td></tr>';
				}else{
				foreach ($data as $key => $value) {
				?>
				<tr>
					<td data-label="No."><?php echo $key+1 ?></td>
					<td data-label="Tanggal"><?php echo Lib::dateInd($value['tanggal']) ?></td>
					<td data-label="Total"><?php echo 'Rp. '.Lib::ind($value['grand_total']) ?></td>
					<td data-label="Status"><?php echo Lib::status($value['status']) ?></td>
					<td data-label="Action">
						<?php
						if($value['status'] == '-' || $value['status'] == '4'){
						?>
						<a onclick="return alert('Fungsi tombol dinonaktifkan.')" href="#">
							<button class="button button-inline button-small">
								<i class="fa  fa-send"></i> Konfirmasi Pembayaran
							</button>
						</a>						
						<?php
						}else{
						?>
						<a href="<?php echo app_base.'konfirmasi_pembayaran&nomor_pesan='.$value['id_pesan'] ?>">
							<button class="button button-inline button-small button-primary">
								<i class="fa  fa-send"></i> Konfirmasi Pembayaran
							</button>
						</a>						
						<?php
						}
						?>
						<a href="<?php echo app_base.'detail_order&nomor_pesan='.$value['id_pesan'] ?>">
							<button class="button button-inline button-small button-success">
								<i class="fa fa-eye"></i> Detail
							</button>
						</a>
						<?php
						if($value['status'] == '-' || $value['status'] == '4'){
						?>
						<a onclick="return alert('Fungsi tombol dinonaktifkan.')" href="#">
							<button class="button button-inline button-small">
								<i class="fa fa-close"></i> Batalkan
							</button>
						</a>							
						<?php
						}else{
						?>
						<a onclick="return confirm('Batalkan Pemesanan?')" href="<?php echo app_base.'batal_pemesanan&nomor_pesan='.$value['id_pesan'] ?>">
							<button class="button button-inline button-small button-danger">
								<i class="fa fa-close"></i> Batalkan
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