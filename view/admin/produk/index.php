<div class="col-md-12">
	<h3>Admin Panel</h3>
	<hr>
	<ul class="nav nav-tabs">
	  <?php include "view/admin/menu-admin.php"; ?>
	</ul>
	<div class="tab-bot">
		<div class="row">
			<div class="col-md-12">
				<h4>Produk</h4>
			</div>
			<div class="col-md-12">
				<a href="<?php echo app_base.'create_produk&main=produk&action=create' ?>">
					<button class="button button-inline button-small button-primary">
						<i class="fa fa-plus"></i>
						Tambahkan Produk Baru
					</button>
				</a>
				<table class="table">
					<thead>
						<tr>
							<th>No. </th>
							<th>Nama Produk</th>
							<th>Ukuran</th>
							<th>Kerangka Bahan</th>
							<th>Warna</th>
							<th>Harga</th>
							<th>Publikasi</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(empty($data)){
							echo '<tr><td colspan="8" align="center">-- Data tidak ditemukan.</td></tr>';
						}else{
						foreach ($data as $key => $value) {
						?>
						<tr>
							<td><?php echo $key+1 ?></td>
							<td><?php echo $value['jenis'] ?></td>
							<td><?php echo $value['ukuran'] ?> cm</td>
							<td><?php echo $value['kerangka'] ?></td>
							<td><?php echo $value['warna'] ?></td>
							<td><?php echo 'Rp. '.Lib::ind($value['harga_satuan']) ?></td>
							<td>
								<?php echo ($value['is_published'] == '1') ? '<i class="fa fa-check" style="color:#1caf9a"></i>' : '<i class="fa fa-check"></i>' ?>
							</td>
							<td width="160">
								<a href="<?php echo app_base.'edit_produk&main=produk&action=edit&id_produk='.$value['id_produk'] ?>">
									<button class="button button-inline button-small">
										<i class="fa fa-edit"></i> Edit
									</button>
								</a>
								<a onclick="return confirm('Hapus data ini?')" href="<?php echo app_base.'delete_produk&main=produk&id_produk='.$value['id_produk'] ?>">
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