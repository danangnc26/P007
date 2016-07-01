		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a style="color:#fff" class="navbar-brand" href="<?php echo app_base.'home' ?>">CV.Sembilan Sembilan</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li><a class="nv" href="<?php echo app_base.'home' ?>">Home</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle nv" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Product <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <?php
		            if(empty(Lib::listProduk())){

		            }else{
		            foreach (Lib::listProduk() as $key => $value) {
		            ?>
		            <li><a href="<?php echo app_base.'view_produk&jenis='.$value['id_jenisproduk'] ?>"><?php echo $value['nama'] ?></a></li>
		            <?php
		        	}
		        	?>
		        	<li role="separator" class="divider"></li>
		            <li><a href="<?php echo app_base.'view_produk' ?>">All Product</a></li>
		        	<?php
		        	}
		            ?>	
		          </ul>
		        </li>
		        <?php if(!empty($_SESSION)){ 
		        			if($_SESSION['level_user'] == 'customer'){
		        ?>
		        <li><a class="nv" href="<?php echo app_base.'custom_order' ?>">Custom Order</a></li>
		        <li><a class="nv" href="<?php echo app_base.'daftar_pesananku' ?>">Order History</a></li>	     
		        <li><a class="nv" href="<?php echo app_base.'pesanan_sekarang' ?>">Order Cart</a></li>
		        <?php }} ?>
		      </ul>	
		      <ul class="nav navbar-nav navbar-right">
		      	<?php
		      	if(!empty($_SESSION)){
		      	if($_SESSION['level_user'] == 'admin'){
		      	?>
		      	<li><a class="nv" href="<?php echo app_base.'send_tagihan2' ?>"><i class="fa fa-send"></i> Send Notification</a></li>
		      	<li><a class="nv" href="<?php echo app_base.'show_welcome&main=awal' ?>">Panel Admin</a></li>
		      	<?php
		      	}}
		      	?>
		      	<?php
		      	if(empty($_SESSION)){
		      	?>
		      	<li><a class="nv" href="<?php echo app_base.'daftar' ?>">Register</a></li>
		        <li><a class="nv" href="<?php echo app_base.'login' ?>">Log In</a></li>
		        <?php
		    	}else{
		    	if($_SESSION['level_user'] == 'customer'){
		        ?>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle nv" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo ($_SESSION['jk'] == 'L') ? 'Mr. '. $_SESSION['nama_lengkap'] : 'Mrs. '. $_SESSION['nama_lengkap'] ?><span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="<?php echo app_base.'ubah_data_pribadi' ?>">Change Profile</a></li>
		            <li><a href="<?php echo app_base.'ubah_password' ?>">Change Password</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="<?php echo app_base.'logout' ?>">Log Out</a></li>
		          </ul>
		        </li>
		        <?php }} ?>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>