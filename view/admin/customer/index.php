<div class="col-md-12">
	<h3>Admin Panel</h3>
	<hr>
	<ul class="nav nav-tabs">
	  <?php include "view/admin/menu-admin.php"; ?>
	</ul>
	<div class="tab-bot">
		<div class="row">
			<div class="col-md-12">
					<h4>Customer</h4>

					<table class="admin" width="100%" border="1">
						<tr>
							<th width="20">No.</th>
							<th>Nama Lengkap</th>
							<th>No. Handphone</th>
							<th>Alamat</th>
							<th width="160">Action</th>
						</tr>
						<?php
						if($data == null){
							echo '<tr><td colspan="5" align="center">-- Data tidak ditemukan.</td></tr>';
						}else{
						foreach($data as $key => $value){
						?>
						<tr>
							<td><?php echo $key+1 ?></td>
							<td><?php echo $value['nama_lengkap'] ?></td>
							<td><?php echo $value['no_hp'] ?></td>
							<td><?php echo $value['alamat_lengkap'] ?></td>
							<td align="center">
								<a onclick="return confirm('Hapus data ini?')" href="<?php echo app_base.'delete_customer&main=customer&id_user='.$value['id_user'] ?>">
									<button class="button button-inline button-small">
										<i class="fa fa-trash"></i> Hapus
									</button>
								</a>
							</td>
						</tr>
						<?php }} ?>
					</table>
			</div>
		</div>
	</div>
</div>