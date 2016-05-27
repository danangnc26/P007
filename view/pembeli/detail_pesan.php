<h3>Detail Pesanan</h3>
<hr>
<?php
if($data1 == null){

}else{
foreach($data1 as $key1 => $value1){
?>
<h4>NO. PEMESANAN : #<?php echo $value1['id_pesan'] ?></h4>
<?php
}}
?>
<hr>
<div class="row">
	<div class="col-md-8" style="height:100%">
		<div class="panel panel-default">
	  <div class="panel-heading"><h4>Produk yang dipesan</h4></div>
	  <div class="panel-body">
	    <table class="table">
	    	<thead>
	    		<tr>
		    		<th>Produk</th>
		    		<th>Qty</th>
		    		<th>Harga</th>
		    		<th>Total</th>
		    		<th></th>
		    	</tr>
	    	</thead>
	    	<?php
	    	if($data2 == null){
	    		echo '<tr><td colspan="4" align="center">-- Data tidak ditemukan. -- </td></tr>';
	    	}else{
	    	$jml = [];
	    	foreach ($data2 as $key2 => $value2) {
	    	?>
	    	<tbody>
	    		<tr>
		    		<td><?php echo $value2['jenis'].' - '.$value2['ukuran'].' - '.$value2['kerangka'] ?></td>
		    		<td><?php echo $value2['qty'] ?></td>
		    		<td><?php echo 'Rp. '.Lib::ind($value2['harga']) ?></td>
		    		<td><?php echo 'Rp. '.Lib::ind($value2['harga'] * $value2['qty']);
		    				  $jml[] = $value2['harga'] * $value2['qty'] ?></td>
		    		<td width="5">
		    			<a onclick="return confirm('Remove item?')" href="<?php echo app_base.'remove_item&id_item='.$value2['id_pv_pesan'].'&nomor_pesan='.$_GET['nomor_pesan'] ?>">
		    				<button style="border:none;background:none">
			    				<i class="fa fa-trash"></i>
			    			</button>
		    			</a>
		    		</td>
		    	</tr>
	    	</tbody>
	    	<?php
	    	}
	    	?>
	    	<tfoot>
	    		<tr>
	    			<th colspan="3">Sub Total</th>
	    			<td><?php echo 'Rp. '.Lib::ind(array_sum($jml)) ?></td>
	    		</tr>
	    	</tfoot>
	    	<?php } ?>
	    </table>
	    <a href="<?php echo app_base.'view_produk' ?>">
		    <button type="button" class="button button-inline button-small button-success">
				<i class="fa fa-plus"></i>
				Tambahkan Pesanan Lain
			</button>
		</a>
		<a href="<?php echo app_base.'custom_order' ?>">
			<button type="button" class="button button-inline button-small button-warning">
				<i class="fa fa-plus"></i>
				Tambahkan Custom Order
			</button>
		</a>
		<a onclick="return confirm('Remove all item?')" href="<?php echo app_base.'hapus_pesanan_all&nomor_pesan='.$_GET['nomor_pesan'] ?>">
			<button type="button" class="button button-inline button-small button-danger">
				<i class="fa fa-trash"></i>
				Hapus Semua Pesanan
			</button>
		</a>
	  </div>
	</div>
	</div>
	<div class="col-md-4">
		<form method="post" action="<?php echo app_base.'save_to_konfirmasi' ?>">
		<div class="panel panel-default">
		  <div class="panel-heading"><h4>Customer</h4></div>
		  <div class="panel-body">
		  	<?php
		  	if($data3 == null)
		  	{

		  	}else{
		  	foreach ($data3 as $key3 => $value3) {
		  	?>
		  	<input type="hidden" name="nomor_pesan" value="<?php echo $_GET['nomor_pesan'] ?>">
		    <div class="form-group">
		    	<label>Nama Pemesan : </label>
		    	<input type="text" disabled readonly name="" value="<?php echo $value3['nama_lengkap'] ?>" class="form-control cst">
		    </div>
		    <div class="form-group">
		    	<label>No. HP : </label>
		    	<input type="text" pattern="[0-9].{0,}" title="Gunakan Format Angka" name="no_hp" value="<?php echo $value3['no_hp'] ?>" class="form-control cst">
		    </div>
		    <div class="form-group">
		    	<label>Alamat Pengiriman : </label>
		    	<textarea type="text" name="alamat_pengiriman" rows="3" class="form-control cst"><?php echo $value3['alamat_lengkap'] ?></textarea>
		    </div>
		    <?php
			}}
		    ?>
		  </div>
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading"><h4>Metode Pembayaran</h4></div>
		  <div class="panel-body">
		  	<label>
		  		<input checked type="radio" name="metopem"> Transfer
		  	</label>
		  	<p><small>
		  		Silahkan lakukan pembayaran melalui rekening berikut :
		  		<li> BCA 0191092121  - a.n CV. Sembilan Sembilan</li>
		  		<li> BNI 4021390131  - a.n CV. Sembilan Sembilan</li>
		  		<li> Mandiri 3824719223  - a.n CV. Sembilan Sembilan</li>
		  		<li> BRI 1938183102  - a.n CV. Sembilan Sembilan</li>
		  	</small></p>
		  </div>
		</div>
	</div>
	<div class="col-md-12">
						<button class="button button-inline button-small button-primary">
							<i class="fa fa-save"></i>
							Proses Pesanan
						</button>
					<a href="<?php echo app_base.'home' ?>">
						<button type="button" class="button button-inline button-small button-danger">
							<i class="fa fa-save"></i>
							Kembali Ke Halaman Awal
						</button>
					</a>
					</form>
	</div>
</div>