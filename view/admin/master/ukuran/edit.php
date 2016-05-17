				<?php
				if($edit == null){

				}else{
				foreach ($edit as $e) {
				?>
				<form method="post" action="<?php echo app_base.'update_ukuran' ?>">
					<input name="id_ukuranproduk" type="hidden" value="<?php echo $e['id_ukuranproduk'] ?>">
					<div class="form-group">
						<label>Ukuran : </label>
						<input name="ukuran" type="text" class="form-control cst" value="<?php echo $e['ukuran'] ?>">
					</div>
					<div class="form-group">
						<label>Harga : </label>
						<input name="harga" type="text" class="form-control cst" value="<?php echo $e['harga'] ?>">
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