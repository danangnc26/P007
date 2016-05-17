<h3>Custom Order</h3>
<hr>
<div class="row">
		<form method="post" action="<?php echo app_base.'save_custom_order'; ?>">
			<div class="col-md-6">
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
					<input type="text" class="form-control cst" name="harga_satuan" readonly>
				</div>
				<div class="form-group">
					<label>Qty : </label>
					<input type="number" class="form-control cst" name="qty" min="1">
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