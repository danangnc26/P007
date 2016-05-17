<?php
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'function\route.php';
?>
<!doctype html>
<html lang=''>
<head>
	<title>Sistem Pemesanan Papan Suku Bunga & Mesin Antrian</title>
	<meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="<?php echo base_url; ?>assets/js/jquery-1.11.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets/css/bootstrap/bootstrap-theme.min.css">
    <script type="text/javascript" src="<?php echo base_url; ?>assets/css/bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>assets/plugin/font-awesome/css/font-awesome.min.css">
    
</head>
<body>
<header>
		<?php include "view/menu.php"; ?>
</header>
<section id="main">
	<div class="content-container<?php echo ($_GET['page'] == 'login' or $_GET['page'] == 'daftar') ? ' small-content-container' : '' ?>">
		<div class="row">
				<?php
				// var_dump($_SESSION);
					$page = (isset($_GET['page']))? $_GET['page'] : "main";
					route($page);
				?>			
		</div>
	</div>
</section>
<footer>
	Copyright &copy; 2016 - CV. Sembilan Sembilan
</footer>
</body>
</html>

 <!-- <li>
		            	<div class="input-group">
						  <span class="input-group-addon" id="sizing-addon1">@</span>
						  <input type="text" class="form-control cst" placeholder="Username">
						</div>
		            </li>
		             <li>
		            	<div class="input-group">
						  <span class="input-group-addon" id="sizing-addon1">@</span>
						  <input type="password" class="form-control cst" placeholder="Password">
						</div>
		            </li>
		             <li>
		            	<button class="button button-inline button-small button-primary">Login</button>
		            </li> -->