<div class="col-md-12">
	<h3>Form Daftar</h3>
	<hr>
	<form method="post" action="<?php echo app_base.'save_user' ?>">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="sizing-addon1">
				<i class="fa fa-user"></i>
			</span>
			<input type="text" name="username" class="form-control cst" placeholder="Username" required>
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="sizing-addon1">
				<i class="fa fa-lock"></i>
			</span>
			<input type="password" name="password" class="form-control cst" placeholder="Password" required>
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="sizing-addon1">
				<i class="fa fa-lock"></i>
			</span>
			<input type="password" name="password2" class="form-control cst" placeholder="Konfirmasi Password" required>
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="sizing-addon1">
				<i class="fa fa-user"></i>
			</span>
			<input type="text" name="nama_lengkap" class="form-control cst" placeholder="Nama Lengkap" required>
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="sizing-addon1">
				<i class="fa fa-phone"></i>
			</span>
			<input type="text" name="no_hp" class="form-control cst" placeholder="No. Handphone ( Nomor yang Aktif dan Valid )" required>
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="sizing-addon1">
				<i class="fa fa-home"></i>
			</span>
			<input type="text" name="alamat_lengkap" class="form-control cst" placeholder="Alamat Lengkap" required>
		</div>
	</div>
	<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label>
								Jenis Kelamin : 
							</label>
						</div>
						<div class="col-md-4">
							<label>
								<input type="radio" name="jk" value="L" required> Laki Laki
							</label>
						</div>
						<div class="col-md-4">
							<label>
								<input type="radio" name="jk" value="P" required> Perempuan
							</label>
						</div>
					</div>
	</div>
	<div class="form-group">
		<button class="button button-inline button-small button-primary full">Simpan</button>
		<a href="<?php echo app_base.'home' ?>">
			<button type="button" class="button button-inline button-small button-danger full"><i class="fa fa-arrow-left"></i> Kembali</button>
		</a>
	</div>
	</form>
</div>
