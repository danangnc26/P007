<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'route.php';

Class Lib{

	public static function redirect($loc)
	{
		header('Location:'.app_base.$loc);
	}

	public static function redirectjs($src = '', $msg = '')
	{
		$r 	= '<script>';
		$r .= (!empty($msg)) ? 'alert("'.$msg.'");' : '';
		$r .= 'location.replace("'.$src.'")';
		$r .= '</script>';
		return $r;
	}

	public static function listProduk()
	{
		$d = new JenisProduk();
		return $d->findAll('order by nama');
	}

	public static function listJenisProduk($opt = '')
	{
		$s[] = '<option value="">-- Pilih Jenis Produk --</option>';
		$j = new JenisProduk();
		$result = $j->findAll('order by nama');
		foreach($result as $value){
			$s[] = ($value['id_jenisproduk'] == $opt) ? '<option selected value="'.$value['id_jenisproduk'].'">'.$value['nama'].'</option>' : '<option value="'.$value['id_jenisproduk'].'">'.$value['nama'].'</option>';
		}
		return implode('', $s);
	}

	public static function listUkuran($opt = '')
	{
		$s[] = '<option value="" class="0">-- Pilih Ukuran --</option>';
		$j = new UkuranProduk();
		$result = $j->findAll('order by ukuran');
		foreach($result as $value){
			$s[] = ($value['id_ukuranproduk'] == $opt) ? '<option class="'.$value['harga'].'" selected value="'.$value['id_ukuranproduk'].'">'.$value['ukuran'].'</option>' : '<option class="'.$value['harga'].'" value="'.$value['id_ukuranproduk'].'">'.$value['ukuran'].'</option>';
		}
		return implode('', $s);
	}

	public static function listKerangka($opt = '')
	{
		$s[] = '<option value="" class="0">-- Pilih Kerangka Bahan --</option>';
		$j = new KerangkaBahan();
		$result = $j->findAll('order by nama');
		foreach($result as $value){
			$s[] = ($value['id_kerangkabahan'] == $opt) ? '<option class="'.$value['harga'].'" selected value="'.$value['id_kerangkabahan'].'">'.$value['nama'].'</option>' : '<option class="'.$value['harga'].'" value="'.$value['id_kerangkabahan'].'">'.$value['nama'].'</option>';
		}
		return implode('', $s);
	}

	public static function ind($str = '')
	{
		return number_format($str, 0, ',', '.');
	}

	public static function uploadImg($post)
	{
		if(isset($post) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['gambar']['name'];
			$size = $_FILES['gambar']['size'];
			$tmp = $_FILES['gambar']['tmp_name'];
			$path = "public/images/";
			move_uploaded_file($tmp, $path.$name); //Stores the image in the uploads folder
		}
		return $name;
	}

	public static function status($v)
	{
		switch ($v) {
			case '-':
				$vf = 'Dibatalkan';
				break;
			case '0':
				$vf = 'Pemesanan Belum Selesai';
				break;
			case '1':
				$vf = 'Pending';
				break;
			case '2':
				$vf = 'Proses Produksi';
				break;
			case '3':
				$vf = 'Proses Pengiriman';
				break;
			case '4':
				$vf = 'Selesai';
				break;
			
			default:
				$vf = '';
				break;
		}
		return $vf;
	}

	public static function dateInd($str) {
        setlocale (LC_TIME, 'id_ID');
        $date = strftime( "%d - %m - %Y", strtotime($str));

        return $date;
    }

    public static function autoCancel($id)
    {
    	$pesan = new Pesan();
    	$pesan->raw_write("UPDATE tbl_pesan SET status='-' where id_pesan='".$id."'");
    }

    public static function updStep($id, $stp)
    {
    	$pesan = new Pesan();
    	$pesan->raw_write("UPDATE tbl_pesan SET step_notif='".$stp."' where id_pesan='".$id."'");
    }

    public static function getUnpaidDate()
    {
    	$pesan = new Pesan();
    	$r = $pesan->findAll('where kurang_bayar>=0 and status != "-"');
    	return $r;
    	// foreach($r as $v){
    	// 	$d[] = Lib::dateRange($v['tanggal']);
    	// }
    	// return $d;
    }

    public static function dateRange($dt = '')
    {
    	$startTimeStamp = strtotime($dt);
		$endTimeStamp = strtotime(date("Y-m-d"));

		$timeDiff = abs($endTimeStamp - $startTimeStamp);

		$numberDays = $timeDiff/86400;  // 86400 seconds in one day

		// and you might want to convert to integer
		$numberDays = intval($numberDays);
		return $numberDays;
    }

    public static function chkTagihan($tl)
    {
    	if($tl <= 3){
    		if($tl == 2){
    			$txt = true;
    		}else{
    			$txt = false;
    		}
    	}elseif($tl <= 5){
    		if($tl == 4){
    			$txt = true;
    		}else{
    			$txt = false;
    		}
    	}elseif($tl <= 7){
    		if($tl == 6){
    			$txt = true;
    		}else{
    			$txt = false;
    		}
    	}else{
    		// if($tl >= 7){
    		// 	$txt = '[update]';
    		// }else{
    		// 	$txt = false;
    		// }
    		$txt = false;
    	}
    	return $txt;
    }

    public static function sendNotif()
    {
    	$usr = new Users();
    	if(Lib::getUnpaidDate() != null){
    		foreach (Lib::getUnpaidDate() as $key => $value) {
	    		if(Lib::chkTagihan(Lib::dateRange($value['tanggal']))){
	    			// $d[] = 'dikirim';



	    			$msg = 'Kpd Yth. '.$usr->getUserName($value['id_user']).'. ';
	    			if($value['grand_total'] == $value['kurang_bayar']){
	    				$msg .= 'Tagihan anda adalah Rp.'.$value['grand_total'].', Lakukan pembayaran agar kami dapat segera memproses pesanan anda';
	    			}else{
	    				$msg .= 'Kekurangan anda adalah Rp.'.$value['kurang_bayar'].', Lakukan pelunasan agar kami dapat segera mengirim pesanan anda';
	    			}
	    			if (Lib::sendSMS($value['no_hp'], $msg)) {
	    				if(Lib::dateRange($value['tanggal']) == '2'){
	    					$stp = '1';
	    				}elseif(Lib::dateRange($value['tanggal']) == '4'){
	    					$stp = '2';
	    				}elseif(Lib::dateRange($value['tanggal']) == '6'){
	    					$stp = '3';
	    				}else{
	    					$stp = $value['step_notif'];
	    				}
	    				Lib::updStep($value['id_pesan'], $stp);
	    			}
	    		}else{
	    			if(Lib::dateRange($value['tanggal']) >= 7){
	    				Lib::autoCancel($value['id_pesan']);
	    			}else{
	    				// $d[] = 'tidak';	
	    				return false;
	    			}
	    			
	    		}
	    	}	
    	}
    	
    	
    }

    public static function sendSMS($notelepon,$message)
    {
    	// Script http API SMS Reguler Zenziva

    	// $telepon = '085712834903';

		$userkey="6w4fqi"; // userkey lihat di zenziva

		$passkey="qwerty123"; // set passkey di zenziva

		$isi=urlencode($message);
		$hp=str_replace('+62', '0', $notelepon);
		$hp=str_replace(' ', '', $hp);
		$hp=str_replace('.', '', $hp);
		$hp=str_replace(',', '', $hp);
		$ho=trim($hp);
		$url="https://reguler.zenziva.net/apps/smsapi.php?userkey=$userkey&passkey=$passkey&nohp=$hp&pesan=$isi";
		$data=file_get_contents($url);
		if(eregi('success', $data)){
			$hasil='1';
		}else{
			$hasil='0';
		}
			// return $hasil;
			if($hasil=='1'){
			   return true;
			}else{
			   return false;
			}

		// $message="Terima Kasih, pendaftaran atas nama $nama telah berhasil di websiteAnda.com. Silahkan baca dan download petunjuk selanjutnya. Harap Maklum";

		// $url = "https://reguler.zenziva.net/apps/smsapi.php";$curlHandle = curl_init();

		// curl_setopt($curlHandle, CURLOPT_URL, $url);

		// curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));

		// curl_setopt($curlHandle, CURLOPT_HEADER, 0);

		// curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);

		// curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);

		// curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);

		// curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);

		// curl_setopt($curlHandle, CURLOPT_POST, 1);

		// $results = curl_exec($curlHandle);

		// curl_close($curlHandle);
    }

    public static function laporanItem($id_pesan)
    {
    	$cr = new pivot_pesan();
    	return $cr->raw("SELECT tbl_pivot_pesan.qty as qty,
								  tbl_produk.harga_satuan as harga,
								  tbl_ukuran.ukuran as ukuran,
  								  tbl_jenisproduk.nama as jenis,
								  tbl_kerangka.nama as kerangka,
								  tbl_pivot_pesan.id_pv_pesan as id_pv_pesan 
								  FROM 
								  tbl_pivot_pesan 
								  INNER JOIN tbl_produk ON tbl_pivot_pesan.id_produk=tbl_produk.id_produk 
								  INNER JOIN tbl_ukuran ON tbl_produk.id_ukuranproduk = tbl_ukuran.id_ukuranproduk
								  INNER JOIN tbl_jenisproduk ON tbl_produk.id_jenisproduk = tbl_jenisproduk.id_jenisproduk
								  INNER JOIN tbl_kerangka ON tbl_produk.id_kerangkabahan = tbl_kerangka.id_kerangkabahan
								  where tbl_pivot_pesan.id_pesan='".$id_pesan."'");
    }

}