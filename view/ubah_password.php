<div class="row">
	<div class="col-md-6">
	<h3>Ubah Password</h3>
	<hr>
	<form method="post" action="<?php echo app_base.'update_password' ?>">
	<div class="form-group">
		<label>Password Baru : </label>
		<input type="password" name="password" class="form-control cst" required placeholder="Tulis Password Baru">
	</div>
	<div class="form-group">
		<label>Konfirmasi Password Baru : </label>
		<input type="password" name="password2" class="form-control cst" required placeholder="Tulis Konfirmasi Password Baru">
	</div>
	<div class="form-group">
		<button class="button button-inline button-small button-primary">Simpan</button>
		<a href="<?php echo app_base.'home' ?>">
			<button type="button" class="button button-inline button-small button-danger"><i class="fa fa-arrow-left"></i> Kembali</button>
		</a>
	</div>
	</form>
	</div>
</div>