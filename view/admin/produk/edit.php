<div class="col-md-12">
	<h3>Panel Admin</h3>
	<hr>
	<ul class="nav nav-tabs">
	  <?php include "view/admin/menu-admin.php"; ?>
	</ul>
	<div class="tab-bot">
		<div class="row">
			<?php
			if($data == null){

			}else{
			foreach ($data as $key => $value) {
			?>
			<div class="col-md-12">
				<h4>Edit Produk</h4>
			</div>
			<form method="post" action="<?php echo app_base.'update_produk'; ?>" enctype="multipart/form-data">
			<input type="hidden" name="id_produk" value="<?php echo $value['id_produk'] ?>">
			<div class="col-md-6">
				<div class="form-group">
					<label>Gambar Produk : </label>
					<input type="file" class="form-control cst" name="gambar">
				</div>
				<div class="form-group">
					<label>Jenis Produk : </label>
					<select name="jenis_produk" class="form-control cst" required>
						<?php echo Lib::listJenisProduk($value['id_jenisproduk']) ?>
					</select>
				</div>
				<div class="form-group">
					<label>Ukuran : </label>
					<select name="ukuran" class="form-control cst" required>
						<?php echo Lib::listUkuran($value['id_ukuranproduk']) ?>
					</select>
				</div>
				<div class="form-group">
					<label>Kerangka Bahan : </label>
					<select name="kerangka" class="form-control cst" required>
						<?php echo Lib::listKerangka($value['id_kerangkabahan']) ?>
					</select>
				</div>
				<div class="form-group">
					<label>Warna : </label>
					<input type="text" class="form-control cst" name="warna" value="<?php echo $value['warna'] ?>">
				</div>
				<div class="form-group">
					<label>Running Text : </label><br>
					<div class="row">
						<div class="col-md-2">
							<label>
								<input <?php echo ($value['running_text'] == 1) ? 'checked' : '' ?> type="radio" value="1" name="running_text" required> Ya
							</label>
						</div>
						<div class="col-md-2">
							<label>
								<input <?php echo ($value['running_text'] == 0) ? 'checked' : '' ?> type="radio"  value="0" name="running_text" required> Tidak
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Harga Satuan : </label>
					<input type="text" class="form-control cst" name="harga_satuan" value="<?php echo $value['harga_satuan'] ?>">
				</div>
				<div class="form-group">
					<label>Publikasi : </label><br>
					<div class="row">
						<div class="col-md-2">
							<label>
								<input <?php echo ($value['is_published'] == 1) ? 'checked' : '' ?> type="radio" value="1" name="publikasi" required> Ya
							</label>
						</div>
						<div class="col-md-2">
							<label>
								<input <?php echo ($value['is_published'] == 0) ? 'checked' : '' ?> type="radio"  value="0" name="publikasi" required> Tidak
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
			<?php }} ?>
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
