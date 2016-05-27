<h3>Konfirmasi Pembayaran</h3>
<hr>
<?php
	if(empty($data1)){

	}else{
		foreach ($data1 as $key1 => $value1) {
	?>
<h4>NO. PEMESANAN : #<?php echo $value1['id_pesan'] ?></h4>
<hr>
<div class="row">
		<form method="post" action="<?php echo app_base.'save_konfirmasi' ?>">
			<input type="hidden" name="nomor_pesan" value="<?php echo $value1['id_pesan'] ?>">
			<div class="col-md-6">
				<div class="form-group">
					<label>Bank tujuan : </label>
					<select class="form-control cst" name="bank_tujuan" required>
						<option value="">-- Pilih Bank --</option>
						<option value="Bank Central Asia ( BCA )">CV. Sembilan Sembilan - Bank Central Asia ( BCA )</option>
						<option value="Bank Mandiri">CV. Sembilan Sembilan - Bank Mandiri</option>
						<option value="Bank Nasional Indonesia ( BNI )">CV. Sembilan Sembilan - Bank Nasional Indonesia ( BNI )</option>
						<option value="Bank Rakyat Indonesia ( BRI )">CV. Sembilan Sembilan - Bank Rakyat Indonesia ( BRI )</option>
					</select>
				</div>
				<div class="form-group">
					<label>Metode pembayaran : </label>
					<select class="form-control cst" name="metode_pembayaran" readonly required>
						<option value="Transfer">Transfer</option>
					</select>
				</div>
				<div class="form-group">
					<label>Bank yang digunakan : </label>
					<select class="form-control cst" name="bank_asal" required>
						<option value="">-- Pilih Bank --</option>
						<option value="Bank Central Asia ( BCA )">Bank Central Asia ( BCA )</option>
						<option value="Bank Mandiri">Bank Mandiri</option>
						<option value="Bank Nasional Indonesia ( BNI )">Bank Nasional Indonesia ( BNI )</option>
						<option value="Bank Rakyat Indonesia ( BRI )">Bank Rakyat Indonesia ( BRI )</option>
					</select>
					<small>
						Pastikan nomor rekening yang anda masukkan valid.
					</small>
				</div>
				<div class="form-group">
					<label>Nomor rekening saya : </label>
					<input type="text" pattern="[0-9].{0,}" title="Gunakan Format Angka" class="form-control cst" name="no_rekening" required>
				</div>
				<div class="form-group">
					<label>Nama pemilik rekening : </label>
					<input class="form-control cst" name="nama_pemilik" required>
				</div>
				<hr>
				<!-- <div class="form-group">
					<label>Keterangan Pembayaran : </label>
					<div class="row">
						<div class="col-md-3">
							<label>
								<input type="radio" value="Uang Muka" name="ket_pembayaran" required> Uang Muk requireda
							</label>
						</div>
						<div class="col-md-3">
							<label>
								<input type="radio"  value="Pelunasan" name="ket_pembayaran" required> Pelunasa requiredn
							</label>
						</div>
					</div>
				</div> -->
				<div class="form-group">
					<label>Total yang harus dibayar / Kekurangan pembayaran : </label>
					<input type="text" pattern="[0-9].{0,}" title="Gunakan Format Angka" class="form-control cst" name="kekurangan_pembayaran" value="<?php echo 'Rp. '.Lib::ind($value1['kurang_bayar']) ?>" readonly required>
				</div>
				<div class="form-group">
					<label>Nominal yang akan dibayarkan : </label>
					<input type="text" pattern="[0-9].{0,}" title="Gunakan Format Angka" class="form-control cst" name="nominal_bayar" required>
				</div>
				<div class="form-group">
					<button class="button button-inline button-small button-primary">
						<i class="fa fa-save"></i>
						 Simpan
					</button>
				</div>
			</div>
		</form>
</div>
<?php }} ?>