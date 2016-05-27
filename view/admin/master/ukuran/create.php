				<form method="post" action="<?php echo app_base.'save_ukuran' ?>">
					<div class="form-group">
						<label>Ukuran : </label>
						<input name="ukuran" type="text" class="form-control cst">
					</div>
					<div class="form-group">
						<label>Harga : </label>
						<input name="harga" type="text" pattern="[0-9].{0,}" title="Gunakan Format Angka" required class="form-control cst">
					</div>
					<div class="form-group">
						<button class="button button-inline button-small button-primary">
							<i class="fa fa-save"></i>
							Tambahkan
						</button>
					</div>
				</form>