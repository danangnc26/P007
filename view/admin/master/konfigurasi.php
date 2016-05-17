<div class="col-md-12">
	<h3>Panel Admin</h3>
	<hr>
	<ul class="nav nav-tabs">
	  <?php include "view/admin/menu-admin.php"; ?>
	</ul>
	<div class="tab-bot">
		<div class="panel panel-default">
		  <div class="panel-heading"><h4>Jenis Produk</h4></div>
		  <div class="panel-body">
		    	<?php include "view/admin/master/jenis_produk/index.php" ?>
		  </div>
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading"><h4>Ukuran Produk</h4></div>
		  <div class="panel-body">
		    	<?php include "view/admin/master/ukuran/index.php" ?>
		  </div>
		</div>
		<div class="panel panel-default">
		  <div class="panel-heading"><h4>Kerangka Bahan</h4></div>
		  <div class="panel-body">
		    	<?php include "view/admin/master/kerangka/index.php" ?>
		  </div>
		</div>
	</div>
</div>