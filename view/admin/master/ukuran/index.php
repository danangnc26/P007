			<div class="row">
				<div class="col-md-4">
					<?php 
						if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id_ukuranproduk'])){
							$edit = $ukuran->edit($_GET['id_ukuranproduk']);
							include "view/admin/master/ukuran/edit.php";
						}else{
							include "view/admin/master/ukuran/create.php";
						}
					?>
				</div>
				<div class="col-md-8">
					<table class="admin" width="100%" border="1">
						<tr>
							<th width="20">No.</th>
							<th>Ukuran</th>
							<th>Harga</th>
							<th width="160">Action</th>
						</tr>
						<?php
						if($data2 == null){
							echo '<tr><td colspan="5" align="center">-- Data tidak ditemukan.</td></tr>';
						}else{
						foreach($data2 as $key => $value){
						?>
						<tr>
							<td><?php echo $key+1 ?></td>
							<td><?php echo $value['ukuran'] ?></td>
							<td><?php echo Lib::ind($value['harga']) ?></td>
							<td>
								<a href="<?php echo app_base.'data_master&main=master&action=edit&id_ukuranproduk='.$value['id_ukuranproduk'] ?>">
									<button class="button button-inline button-small">
										<i class="fa fa-edit"></i> Edit
									</button>
								</a>
								<a onclick="return confirm('Hapus data ini?')" href="<?php echo app_base.'delete_ukuran&main=master&action=delete&id_ukuranproduk='.$value['id_ukuranproduk'] ?>">
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