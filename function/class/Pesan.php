<?php
class Pesan extends Core{

	protected $table 		= 'tbl_pesan'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'id_pesan';		// Primary key suatu tabel.
	protected $back			= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function index()
	{
		return $this->findAll('where status != 0 order by tanggal');
		// return $this->findAll('where status = 1 order by tanggal');
	}

	public function listPesanan()
	{
		return $this->findAll('where id_user="'.$_SESSION['id_user'].'" and status != 0 order by tanggal');
	}

	public function konfirmPembayaran1st($id)
	{
		return $this->findBy($this->primaryKey, $id);
	}

	public function getCurrentIdPesan()
	{
		$data = $this->findBy('status', '0', 'and id_user='.$_SESSION['id_user']);
		if($data != null){
			foreach ($data as $key => $value) {
				$d[] = $value['id_pesan'];
			}
			return implode('', $d);
		}else{
			return null;
		}
	}

	public function getDetailPesan($id_pesan)
	{
		return $this->findBy('id_pesan', $id_pesan);
	}

	public function savePesan($input)
	{
		$piv = new pivot_pesan();
		$f = $this->findBy('status', '0', 'and id_user='.$_SESSION['id_user']);
		if($f == null){

			try {
			$id_pesan = mt_rand(100000,999999);
			$data = [
					'id_pesan'	=> $id_pesan,
					'id_user'	=> $_SESSION['id_user'],
					'status'	=> 0,
					'tanggal'	=> date("Y-m-d")
					];
				$input['id_pesan'] = $id_pesan;
				if($this->save($data)){
					if($piv->addToPesan($input)){
						if($piv->updateGrandTotal($id_pesan)){
							Lib::redirect('pesan_overview&nomor_pesan='.$id_pesan);	
						}else{
							header($this->back);
						}
					}else{
						header($this->back);
					}
				}else{
					header($this->back);
				}
			} catch (Exception $e) {
				
			}

		}else{
			foreach ($f as $key => $value) {
				$id_p[] = $value['id_pesan'];
			}
			$id_pesan = implode('', $id_p);
			$input['id_pesan'] = $id_pesan;
			if($piv->addToPesan($input)){
				if($piv->updateGrandTotal($id_pesan)){
					Lib::redirect('pesan_overview&nomor_pesan='.$id_pesan);	
				}else{
					header($this->back);
				}
			}else{
				header($this->back);
			}
		}
	}

	public function deletePesanan($id)
	{
		if($this->delete($this->primaryKey, $id)){
			Lib::redirect('index_pesanan&main=pesanan');
		}else{
			header($this->back);
		}
	}

	public function saveBKonfirmasi($input)
	{
		try {
			$data = [
					'alamat_pengiriman' => $input['alamat_pengiriman'],
					'no_hp'				=> $input['no_hp']
					];
			if($this->update($data, $this->primaryKey, $input['nomor_pesan'])){
				Lib::redirect('konfirmasi_pemesanan&nomor_pesan='.$input['nomor_pesan']);
			}else{
				header($this->back);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function konfirmasiDataPemesanan($id)
	{
		return $this->raw("SELECT
							tbl_pesan.id_pesan,
							tbl_pesan.grand_total,
							tbl_pesan.id_user,
							tbl_pesan.`status`,
							tbl_pesan.alamat_pengiriman,
							tbl_pesan.no_hp,
							tbl_pesan.tanggal,
							tbl_users.nama_lengkap as nama_customer
							FROM
							tbl_pesan
							INNER JOIN tbl_users ON tbl_pesan.id_user = tbl_users.id_user where tbl_pesan.id_pesan = '".$id."'
							");
	}

	public function kirimPesanan($id)
	{
		try {
			$data = [
				'status' => 1,
				'kurang_bayar'	=> $this->grandTotal($id)
				];
				$update = $this->update($data, $this->primaryKey, $id);
				if($update)
				{
					if(isset($_GET['no_hp']) && $_GET['no_hp'] != ''){
						Lib::sendTerimaKasih($_GET['no_hp']);
					}
					Lib::redirect('home');
				}else{
					header($this->back);
				}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}

	public function grandTotal($id)
	{
		$d = $this->raw("SELECT grand_total FROM tbl_pesan where id_pesan='".$id."'");
		return $d[0]['grand_total'];
	}

	public function cancelPemesanan($id)
	{

		if($this->delete($this->primaryKey, $id)){
			Lib::redirect('daftar_pesananku');
		}else{
			header($this->back);
		}

	}

	public function updateStatus($input)
	{
		try {
			$data = ['status' => $input['status']];
			if($this->update($data, $this->primaryKey, $input['id_pesan'])){
				Lib::sendStatus($input['no_hp'], $input['status'], $input['id_pesan']);
				Lib::redirect('detail_pesanan&main=pesanan&nomor_pesan='.$input['id_pesan'].'&id_user='.$input['id_user']);
			}else{
				header($this->back);
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function getLaporan($dt)
	{
		return $this->findAll("where status='4' and tanggal like '".$dt."%' order by tanggal asc");
	}


}