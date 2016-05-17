<?php $user->logCheck() ?>
<?php $user->checkLevel() ?>
<li role="presentation"  <?php echo ($_GET['main'] == 'awal') ? 'class="active"' : '' ?>>
	  	<a style="border-top-left-radius:1px; border-top-right-radius:1px;" href="<?php echo app_base.'show_welcome&main=awal' ?>">
	  		Halaman Awal
	  	</a>
	  </li>
	  <li role="presentation" <?php echo ($_GET['main'] == 'master') ? 'class="active"' : '' ?>>
	  	<a style="border-top-left-radius:1px; border-top-right-radius:1px;" href="<?php echo app_base.'data_master&main=master' ?>">
	  		Data Master
	  	</a>
	  </li>
	  <li role="presentation" <?php echo ($_GET['main'] == 'produk') ? 'class="active"' : '' ?>>
	  	<a style="border-top-left-radius:1px; border-top-right-radius:1px;" href="<?php echo app_base.'index_produk&main=produk' ?>">
	  		Data Produk
	  	</a>
	  </li>
	   <li role="presentation"  <?php echo ($_GET['main'] == 'customer') ? 'class="active"' : '' ?>>
	  	<a style="border-top-left-radius:1px; border-top-right-radius:1px;" href="<?php echo app_base.'index_customer&main=customer' ?>">
	  		Data Pelanggan
	  	</a>
	  </li>
	   <li role="presentation" <?php echo ($_GET['main'] == 'pesanan') ? 'class="active"' : '' ?>>
	  	<a style="border-top-left-radius:1px; border-top-right-radius:1px;" href="<?php echo app_base.'index_pesanan&main=pesanan' ?>">
	  		Data Pesanan
	  	</a>
	  </li>
	   <li role="presentation" <?php echo ($_GET['main'] == 'pembayaran') ? 'class="active"' : '' ?>>
	  	<a style="border-top-left-radius:1px; border-top-right-radius:1px;" href="<?php echo app_base.'index_pembayaran&main=pembayaran' ?>">
	  		Data Pembayaran
	  	</a>
	  </li>
	   <li role="presentation" <?php echo ($_GET['main'] == 'laporan') ? 'class="active"' : '' ?>>
	  	<a style="border-top-left-radius:1px; border-top-right-radius:1px;" href="<?php echo app_base.'index_laporan&main=laporan' ?>">
	  		Laporan
	  	</a>
	  </li>
	   <li role="presentation">
	  	<a style="border-top-left-radius:1px; border-top-right-radius:1px;" href="<?php echo app_base.'logout' ?>">
	  		Logout
	  	</a>
	  </li>