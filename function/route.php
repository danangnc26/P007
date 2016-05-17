<?php
session_start();
ob_start();
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'bootstrap.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'lib.php';

function route($page)
{
	$p = $_POST;

	$jenis = new JenisProduk();
	$ukuran = new UkuranProduk();
	$kerangka = new KerangkaBahan();
	$produk= new Produk();
	$pesan = new Pesan();
	$pivot = new pivot_pesan();
	$pembayaran = new KonfirmasiPembayaran();

	$user = new Users();
	switch ($page) {
		case 'login':
				include "view/login.php";
			break;
		case 'authenticate':
				$user->authenticate($p);
			break;
		case 'daftar':
				include "view/register.php";
			break;
		case 'save_user':
			 	$user->saveUser($p);
			break;
		case 'ubah_data_pribadi':
				$data = $user->getUser();
				include "view/update_profile.php";
			break;
		case 'update_user':
			 	$user->updateUser($p);
			break;
		case 'ubah_password':
				include "view/ubah_password.php";
			break;
		case 'update_password':
				$user->updatePassword($p);
			break;
		case 'logout':
				$user->doLogout();
				// $user->doLogout();
			break;
		// // // // // // // // ADMIN // // // // // // // // 
		case 'show_welcome':
				include "view/admin/show_welcome.php";
			break;

		#KONFIGURASI
		case 'data_master':
				$data = $jenis->index();
				$data2 = $ukuran->index();
				$data3 = $kerangka->index();
				include "view/admin/master/konfigurasi.php";
			break;
		#JENIS PRODUK
		case 'create_jenis':
			# code...
			break;
		case 'save_jenis':
				$jenis->store($p);
			break;
		case 'edit_jenis':
				// $data = $jenis->index();
				// $edit = $jenis->edit($_GET['id']);
				// include "view/admin/master/jenis_produk/index.php";
			break;
		case 'update_jenis':
				$jenis->updateData($p);
			break;
		case 'delete_jenis':
				$jenis->deleteData($_GET['id_jenisproduk']);
			break;

		#UKURAN
		case 'save_ukuran':
				$ukuran->store($p);
			break;
		case 'update_ukuran':
				$ukuran->updateData($p);
			break;
		case 'delete_ukuran':
				$ukuran->deleteData($_GET['id_ukuranproduk']);
			break;
		#KERANGKA
		case 'save_kerangka':
				$kerangka->store($p);
			break;
		case 'update_kerangka':
				$kerangka->updateData($p);
			break;
		case 'delete_kerangka':
				$kerangka->deleteData($_GET['id_kerangkabahan']);
			break;

		#PRODUK
		case 'index_produk':
				$data = $produk->index();
				include "view/admin/produk/index.php";
			break;
		case 'create_produk':
				include "view/admin/produk/create.php";
			break;
		case 'save_produk':
				$produk->store($p);
			break;
		case 'edit_produk':
				$data = $produk->edit($_GET['id_produk']);
				include "view/admin/produk/edit.php";
			break;
		case 'update_produk':
				$produk->updateData($p);
			break;
		case 'delete_produk':
				$produk->deleteData($_GET['id_produk']);
			break;

		case 'index_customer':
				$data = $user->listCustomer();
				include "view/admin/customer/index.php";
			break;

		#PESANAN
		case 'index_pesanan':
				$data = $pesan->index();
				include "view/admin/pesanan/index.php";
			break;
		case 'detail_pesanan':
				$data1 = $pesan->getDetailPesan($_GET['nomor_pesan']);
				$data2 = $pivot->getCurrentItem($_GET['nomor_pesan']);
				$data3 = $user->getSelectedUser($_GET['id_user']);
				$data4 = $pembayaran->findByNoPesan($_GET['nomor_pesan']);
				$data5 = $pembayaran->getTotalPembayaran($_GET['nomor_pesan']);
				include "view/admin/pesanan/detail.php";
			break;

		#PEMBAYARAN
		case 'index_pembayaran':
				$data = $pembayaran->index();
				include "view/admin/pembayaran/index.php";
			break;
		case 'approve_pembayaran':
				$pembayaran->approvePembayaran();
			break;

		case 'update_status':
				$pesan->updateStatus($p);
			break;

		case 'index_laporan':
				if(isset($_GET['bulan']) && isset($_GET['tahun'])){
					$dt = $_GET['tahun'].'-'.$_GET['bulan'];
				}else{
					$dt = date('Y-m');
				}
				$data = $pesan->getLaporan($dt);
				include "view/admin/laporan.php";
			break;
		// // // // // // // // ADMIN // // // // // // // // 

		case 'home':
				include "view/pembeli/home.php";
			break;
		case 'pesanan_sekarang':
			$no = $pesan->getCurrentIdPesan();
			if($no == null){
				echo Lib::redirectjs(app_base.'home', 'Anda belum melakukan pemesanan.');
				// echo '<script>alert("Anda belum melakukan pemesanan."); location.replace</script>'
			}else{
				Lib::redirect('pesan_overview&nomor_pesan='.$no);	
			}
			break;
		case 'view_produk':
				if(isset($_GET['jenis'])){
					$data = $produk->findProduk4Customer($_GET['jenis']);
				}else{
					$data = $produk->index();
				}
				include "view/pembeli/produk.php";
			break;
		case 'save_pesan_produk':
				if(empty($_SESSION)){
					echo Lib::redirectjs(app_base.'login', 'Silahkan Login Untuk Melakukan Pemesanan.');
				}else{
					$pesan->savePesan($p);
				}
			break;
		case 'pesan_overview':
				$data1 = $pesan->getDetailPesan($pesan->getCurrentIdPesan());
				$data2 = $pivot->getCurrentItem($pesan->getCurrentIdPesan());
				$data3 = $user->getUser();
				include "view/pembeli/detail_pesan.php";
			break;
		case 'remove_item':
				$pivot->removeItem($_GET['id_item']);
			break;
		case 'custom_order':
				include "view/pembeli/custom_order.php";
			break;
		case 'save_custom_order':
				$produk->saveCustomOrder($p);
			break;
		case 'hapus_pesanan_all':
				$pivot->removeAllItem($_GET['nomor_pesan']);
			break;
		case 'save_to_konfirmasi':
				$pesan->saveBKonfirmasi($p);
			break;
		case 'konfirmasi_pemesanan':
				$data1 = $pesan->konfirmasiDataPemesanan($_GET['nomor_pesan']);
				$data2 = $pivot->dataPesananKonfirmasi($_GET['nomor_pesan']);
				include "view/pembeli/konfirmasi_pemesanan.php";
			break;
		case 'kirim_pesanan':
				$pesan->kirimPesanan($_GET['nomor_pesan']);
			break;
		case 'daftar_pesananku':
				$data = $pesan->listPesanan();
				include "view/pembeli/current_pesan.php";
			break;
		case 'konfirmasi_pembayaran':
				$data1 = $pesan->konfirmPembayaran1st($_GET['nomor_pesan']);
				include "view/pembeli/konfirmasi_pembayaran.php";
			break;
		case 'save_konfirmasi':
				$pembayaran->saveKonfirmasi($p);
			break;
		case 'batal_pemesanan':
				$pesan->cancelPemesanan($_GET['nomor_pesan']);
			break;
		case 'detail_order':
				$data1 = $pesan->getDetailPesan($_GET['nomor_pesan']);
				$data2 = $pivot->getCurrentItem($_GET['nomor_pesan']);
				$data3 = $user->getSelectedUser($_SESSION['id_user']);
				$data4 = $pembayaran->findByNoPesan($_GET['nomor_pesan']);
				$data5 = $pembayaran->getTotalPembayaran($_GET['nomor_pesan']);
				include "view/pembeli/current_pesan_detail.php";
			break;
		case 'send_sms':
				Lib::sendSMS();
			break;
		case 'send_tagihan':
		Lib::sendNotif();
				// var_dump(Lib::sendNotif());
		// var_dump(Lib::getUnpaidDate());
			break;
		
		case 'main' :
				default : 
				// header("location:index.php");
			break;
	}
}

define("index", "index.php");
define("base_url", server_name()."/p5-joni/");
define("app_base", index."?page=");

function server_name()
{
	  $serverport = (isset($_SERVER['SERVER_PORT'])) ? ':'.$_SERVER['SERVER_PORT'] : '';
	  return sprintf(
	    "%s://%s".$serverport,
	    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
	    $_SERVER['SERVER_NAME'],
	    $_SERVER['REQUEST_URI']
	  );
}