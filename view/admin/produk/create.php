<div class="col-md-12">
	<h3>Admin Panel</h3>
	<hr>
	<ul class="nav nav-tabs">
	  <?php include "view/admin/menu-admin.php"; ?>
	</ul>
	<div class="tab-bot">
		<div class="row">
			<div class="col-md-12">
				<h4>Tambah Produk Baru</h4>
			</div>
			<form method="post" action="<?php echo app_base.'save_produk'; ?>" enctype="multipart/form-data">
			<div class="col-md-6">
				<div class="form-group">
					<label>Gambar Produk : </label>
					<input type="file" class="form-control cst" name="gambar">
				</div>
				<div class="form-group">
					<label>Jenis Produk : </label>
					<select name="jenis_produk" class="form-control cst" required>
						<?php echo Lib::listJenisProduk() ?>
					</select>
				</div>
				<div class="form-group">
					<label>Ukuran : </label>
					<select name="ukuran" class="form-control cst" required>
						<?php echo Lib::listUkuran() ?>
					</select>
				</div>
				<div class="form-group">
					<label>Kerangka Bahan : </label>
					<select name="kerangka" class="form-control cst" required>
						<?php echo Lib::listKerangka() ?>
					</select>
				</div>
				<div class="form-group">
					<label>Warna : </label>
					<input type="text" class="form-control cst" name="warna">
				</div>
				<div class="form-group">
					<label>Running Text : </label><br>
					<div class="row">
						<div class="col-md-2">
							<label>
								<input type="radio" value="1" name="running_text" required> Ya
							</label>
						</div>
						<div class="col-md-2">
							<label>
								<input type="radio"  value="0" name="running_text" required> Tidak
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Harga Satuan : </label>
					<input type="text" pattern="[0-9].{0,}" title="Gunakan Format Angka" required class="form-control cst" name="harga_satuan">
				</div>
				<div class="form-group">
					<label>Publikasi : </label><br>
					<div class="row">
						<div class="col-md-2">
							<label>
								<input checked type="radio" value="1" name="publikasi" required> Ya
							</label>
						</div>
						<div class="col-md-2">
							<label>
								<input type="radio"  value="0" name="publikasi" required> Tidak
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<button class="button button-inline button-small button-primary">
						<i class="fa fa-save"></i>
						 Simpan
					</button>
					<a href="<?php echo app_base.'index_produk&main=produk' ?>">
						<button type="button" class="button button-inline button-small button-danger">
							<i class="fa fa-save"></i>
							Batal
						</button>
					</a>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var u;
	$('select[name=ukuran]').change(function(){
		
		
		$('input[name=harga_satuan]').val(parseInt($('select[name=ukuran] option:selected').attr('class')) + parseInt($('select[name=kerangka] option:selected').attr('class')));
	});

	var k;
	$('select[name=kerangka]').change(function(){
		$('input[name=harga_satuan]').val(parseInt($('select[name=ukuran] option:selected').attr('class')) + parseInt($('select[name=kerangka] option:selected').attr('class')));
	});

	function hrg(u, k)
	{
		$('input[name=harga_satuan]').val(u + k);
	}
</script>
