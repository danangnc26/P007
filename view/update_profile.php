<div class="row">
	<div class="col-md-6">
	<h3>Ubah Password</h3>
	<hr>
	<?php
	if($data == null){

	}else{
	foreach ($data as $key => $value) {
	?>
	<form method="post" action="<?php echo app_base.'update_user' ?>">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="sizing-addon1">
				<i class="fa fa-user"></i>
			</span>
			<input type="text" name="nama_lengkap" class="form-control cst" placeholder="Nama Lengkap" value="<?php echo $value['nama_lengkap'] ?>" required>
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="sizing-addon1">
				<i class="fa fa-phone"></i>
			</span>
			<input type="text" name="no_hp" class="form-control cst" placeholder="No. Handphone ( Nomor yang Aktif dan Valid )" value="<?php echo $value['no_hp'] ?>" required>
		</div>
	</div>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon" id="sizing-addon1">
				<i class="fa fa-home"></i>
			</span>
			<input type="text" name="alamat_lengkap" class="form-control cst" placeholder="Alamat Lengkap" value="<?php echo $value['alamat_lengkap'] ?>" required>
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
								<input <?php echo ($value['jk'] == 'L') ? 'checked' : '' ?> type="radio" name="jk" value="L" required> Laki Laki
							</label>
						</div>
						<div class="col-md-4">
							<label>
								<input <?php echo ($value['jk'] == 'P') ? 'checked' : '' ?> type="radio" name="jk" value="P" required> Perempuan
							</label>
						</div>
					</div>
	</div>
	<div class="form-group">
		<button class="button button-inline button-small button-primary">Simpan</button>
		<a href="<?php echo app_base.'home' ?>">
			<button type="button" class="button button-inline button-small button-danger"><i class="fa fa-arrow-left"></i> Kembali</button>
		</a>
	</div>
	</form>
	<?php }} ?>
	</div>
</div>