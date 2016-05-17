<h3>Daftar Produk
<?php
if(isset($_GET['jenis'])){
  if($_GET['jenis'] == '1'){
    echo ': Papan Suku Bunga';
  }elseif($_GET['jenis'] == '2'){
    echo ': Mesin Antrian';
  }else{
    echo '';
  }
}else{
  echo '';
}
?>
</h3>
<hr>
<div class="row">
	<style type="text/css">
	h5{
		margin: 0px;
	}
	hr{
		margin: 10px;
	}
	</style>
  <?php
  if(empty($data)){
    echo '<div class="col-sm-6 col-md-3"><h4>Data Tidak Ditemukan.</h4></div>';
  }else{
  foreach ($data as $key => $value) {
  ?>
  <div class="col-sm-6 col-md-3">
    <div class="thumbnail">
      <img class="dis-produk" src="<?php echo base_url.'public/images/'.$value['gambar'] ?>" width="100%" style="min-height:210px;">
      <hr>
      <div class="caption">
        <h4><?php echo $value['jenis'] ?></h4>
        <table>
        	<tr>
        		<td>Ukuran</td>
        		<td>:</td>
        		<td><?php echo $value['ukuran'] ?></td>
        	</tr>
        	<tr>
        		<td>Kerangka Bahan</td>
        		<td>:</td>
        		<td><?php echo $value['kerangka'] ?></td>
        	</tr>
        	<tr>
        		<td>Warna</td>
        		<td>:</td>
        		<td><?php echo $value['warna'] ?></td>
        	</tr>
        	<tr>
        		<td>Running Text</td>
        		<td>:</td>
        		<td><?php echo ($value['running_text'] == '1') ? 'Ya' : 'Tidak' ?></td>
        	</tr>
        </table>
        <hr>
        <center><h4>Rp. <?php echo Lib::ind($value['harga_satuan']) ?></h4></center>
        <hr>
        <form method="post" action="<?php echo app_base.'save_pesan_produk' ?>">
        	<div class="input-group">
        	  <input type="hidden" name="id_produk" value="<?php echo $value['id_produk'] ?>">
			  <input type="number" name="qty" class="form-control" value="1" min="1">
			  <div class="input-group-btn">
			    <button class="btn btn-primary">Pesan</button>
			  </div>
			</div>
        </form>
      </div>
    </div>
  </div>
  <?php }} ?>
</div>