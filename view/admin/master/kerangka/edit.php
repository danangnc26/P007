				<?php
				if($edit == null){

				}else{
				foreach ($edit as $e) {
				?>
				<form method="post" action="<?php echo app_base.'update_kerangka' ?>">
					<input name="id_kerangkabahan" type="hidden" value="<?php echo $e['id_kerangkabahan'] ?>">
					<div class="form-group">
						<label>Nama Bahan : </label>
						<input name="nama" type="text" class="form-control cst" value="<?php echo $e['nama'] ?>">
					</div>
					<div class="form-group">
						<label>Harga : </label>
						<input name="harga" type="text" pattern="[0-9].{0,}" title="Gunakan Format Angka" required class="form-control cst" value="<?php echo $e['harga'] ?>">
					</div>
					<div class="form-group">
						<button class="button button-inline button-small button-primary">
							<i class="fa fa-save"></i>
							Perbarui
						</button>
						<a href="<?php echo app_base.'data_master&main=master' ?>">
							<button type="button" class="button button-inline button-small button-danger">
								<i class="fa fa-save"></i>
								Batal
							</button>
						</a>
					</div>
				</form>
				<?php }} ?>