<?php
class pivot_pesan extends Core{

	protected $table 		= 'tbl_pivot_pesan'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'id_pv_pesan';		// Primary key suatu tabel.
	protected $back			= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function getCurrentItem($id_pesan)
	{
		return $this->raw("SELECT tbl_pivot_pesan.qty as qty,
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

	public function addToPesan($input)
	{
		try {
		
		$data = [
				'id_pesan'	=> $input['id_pesan'],
				'id_produk' => $input['id_produk'],
				'qty'		=> $input['qty'],
				];
			if($this->save($data)){
				return true;
			}else{
				return false;
			}
		} catch (Exception $e) {
			
		}
	}

	public function updateGrandTotal($id_pesan)
	{
		$data = $this->raw("SELECT tbl_pivot_pesan.qty as qty, tbl_produk.harga_satuan as harga FROM tbl_pivot_pesan INNER JOIN tbl_produk ON tbl_pivot_pesan.id_produk=tbl_produk.id_produk where tbl_pivot_pesan.id_pesan='".$id_pesan."'");
		foreach ($data as $key => $value) {
			$jml_t[] = $value['qty'] * $value['harga'];
		}
		$jumlah = array_sum($jml_t);

		$updatetotal = $this->raw_write("UPDATE tbl_pesan SET grand_total='".$jumlah."' where id_pesan='".$id_pesan."'");
		if($updatetotal){
			return true;
		}else{
			return false;
		}
	}

	public function removeItem($id)
	{
		$delete = $this->delete($this->primaryKey, $id);
		if($delete){
			$this->updateGrandTotal($_GET['nomor_pesan']);
			Lib::redirect('pesan_overview&nomor_pesan='.$_GET['nomor_pesan']);
		}else{
			echo "error";
		}
	}

	public function removeAllItem($id)
	{
		$delete = $this->delete('id_pesan', $id);
		if($delete){
			$this->updateGrandTotal($id);
			Lib::redirect('pesan_overview&nomor_pesan='.$id);
		}else{
			echo "error";
		}
	}

	public function dataPesananKonfirmasi($id)
	{
		return $this->raw("SELECT
						tbl_jenisproduk.nama as jenis,
						tbl_ukuran.ukuran as ukuran,
						tbl_kerangka.nama as kerangka,
						tbl_produk.id_produk,
						tbl_produk.warna,
						tbl_produk.running_text,
						tbl_produk.harga_satuan as harga,
						tbl_produk.is_customorder,
						tbl_pivot_pesan.qty,
						tbl_pivot_pesan.id_pesan,
						tbl_pivot_pesan.id_produk
						FROM
						tbl_pivot_pesan
						INNER JOIN tbl_produk ON tbl_pivot_pesan.id_produk = tbl_produk.id_produk
						INNER JOIN tbl_ukuran ON tbl_produk.id_ukuranproduk = tbl_ukuran.id_ukuranproduk
						INNER JOIN tbl_kerangka ON tbl_produk.id_kerangkabahan = tbl_kerangka.id_kerangkabahan
						INNER JOIN tbl_jenisproduk ON tbl_produk.id_jenisproduk = tbl_jenisproduk.id_jenisproduk where tbl_pivot_pesan.id_pesan= '".$id."'
");
	}

}