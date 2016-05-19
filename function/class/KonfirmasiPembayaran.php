<?php
class KonfirmasiPembayaran extends Core{

	protected $table 		= 'tbl_konfirmasi_pembayaran'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'id_konfirmasi_pembayaran';		// Primary key suatu tabel.
	protected $back			= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function index()
	{
		return $this->findAll('order by id_konfirmasi_pembayaran desc');
	}

	public function findByNoPesan($id)
	{
		return $this->findBy('id_pesan', $id);
	}

	public function saveKonfirmasi($input)
	{
		try {
			$data = [
					'bank_tujuan'			=> $input['bank_tujuan'],
					'bank_asal'				=> $input['bank_asal'],
					'no_rekening'			=> $input['no_rekening'],
					'nama_pemilik'			=> $input['nama_pemilik'],
					'id_pesan'				=> $input['nomor_pesan'],
					'nominal_bayar'			=> $input['nominal_bayar'],
					// 'keterangan'			=> $input['ket_pembayaran'],
					'is_approved'			=> '0'
					];
			if($this->save($data)){
				echo Lib::redirectjs(app_base.'daftar_pesananku', 'Pembayaran sukses, dan akan segera kami validasi. ');
			}else{
				header($this->back);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function approvePembayaran()
	{
		try {
			$s = ($_GET['stats'] == 'true') ? '1' : '0';
			$data = [
					'is_approved'		=> $s
					];
			if($this->update($data, 'id_konfirmasi_pembayaran', $_GET['id_konfirmasi'])){
				if($this->updKurangBayar($_GET['nomor_pesan'])){
					if(isset($_GET['id_user'])){
						Lib::redirect('detail_pesanan&main=pesanan&nomor_pesan='.$_GET['nomor_pesan'].'&id_user='.$_GET['id_user']);	
					}else{
						Lib::redirect('index_pembayaran&main=pembayaran');
					}
				}else{
					header($this->back);	
				}
			}else{
				header($this->back);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getTotalPembayaran($id)
	{
		$d = $this->raw("SELECT sum(nominal_bayar) as total_sudah_bayar FROM tbl_konfirmasi_pembayaran where id_pesan='".$id."' and is_approved=1");
		return $d[0]['total_sudah_bayar'];
	}

	public function updKurangBayar($id)
	{
		try {
			$pes = new Pesan();
			$data = [
					'kurang_bayar'		=> $pes->grandTotal($id) - $this->getTotalPembayaran($id)
					];
			// if($this->raw("UPDATE tbl_pesan SET kurang_bayar='".$this->getTotalPembayaran($id)."' where id_pesan='".$id."'"))
			if($pes->update($data, 'id_pesan', $id)){
				return true;
			}else{
				return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	
}