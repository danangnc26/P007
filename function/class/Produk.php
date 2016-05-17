<?php
class Produk extends Core{

	protected $table 		= 'tbl_produk'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'id_produk';		// Primary key suatu tabel.
	protected $back			= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function index()
	{
		return $this->raw("SELECT
				tbl_produk.warna,
				tbl_produk.running_text,
				tbl_produk.gambar,
				tbl_produk.harga_satuan,
				tbl_produk.is_published,
				tbl_produk.id_produk,
				tbl_ukuran.ukuran,
				tbl_jenisproduk.nama as jenis,
				tbl_kerangka.nama as kerangka
				FROM
				tbl_produk
				INNER JOIN tbl_ukuran ON tbl_produk.id_ukuranproduk = tbl_ukuran.id_ukuranproduk
				INNER JOIN tbl_jenisproduk ON tbl_produk.id_jenisproduk = tbl_jenisproduk.id_jenisproduk
				INNER JOIN tbl_kerangka ON tbl_produk.id_kerangkabahan = tbl_kerangka.id_kerangkabahan where is_customorder = 0");
	}

	public function store($input)
	{
		try{
			$data = [
				'id_jenisproduk'		=> $input['jenis_produk'],
				'id_ukuranproduk'		=> $input['ukuran'],
				'id_kerangkabahan'		=> $input['kerangka'],
				'warna'					=> $input['warna'],
				'running_text'			=> $input['running_text'],
				'gambar'				=> Lib::uploadImg($input),
				'harga_satuan'			=> $input['harga_satuan'],
				'is_published'			=> $input['publikasi'],
				'is_customorder'		=> '0'
				
				];
			if($this->save($data)){
				Lib::redirect('index_produk&main=produk');
			}else{
				header($this->back);
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function edit($id)
	{
		return $this->findBy($this->primaryKey, $id);
	}

	public function updateData($input)
	{
		try{
			$data = [
				'id_jenisproduk'		=> $input['jenis_produk'],
				'id_ukuranproduk'		=> $input['ukuran'],
				'id_kerangkabahan'		=> $input['kerangka'],
				'warna'					=> $input['warna'],
				'running_text'			=> $input['running_text'],
				'harga_satuan'			=> $input['harga_satuan'],
				'is_published'			=> $input['publikasi'],
				'is_customorder'		=> '0'
				
				];
				if(isset($_FILES) && strlen($_FILES['gambar']['name']) != 0){
					$data['gambar'] = Lib::uploadImg($input);
				}
				
			if($this->update($data, $this->primaryKey, $input['id_produk'])){
				Lib::redirect('index_produk&main=produk');
			}else{
				header($this->back);
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function deleteData($id)
	{
		if($this->delete($this->primaryKey, $id)){
			Lib::redirect('index_produk&main=produk');
		}else{
			header($this->back);
		}
	}

	// 

	public function findProduk4Customer($id_jenisproduk)
	{
		return $this->raw("SELECT
				tbl_produk.warna,
				tbl_produk.running_text,
				tbl_produk.gambar,
				tbl_produk.harga_satuan,
				tbl_produk.is_published,
				tbl_produk.id_produk,
				tbl_ukuran.ukuran,
				tbl_jenisproduk.nama as jenis,
				tbl_kerangka.nama as kerangka
				FROM
				tbl_produk
				INNER JOIN tbl_ukuran ON tbl_produk.id_ukuranproduk = tbl_ukuran.id_ukuranproduk
				INNER JOIN tbl_jenisproduk ON tbl_produk.id_jenisproduk = tbl_jenisproduk.id_jenisproduk
				INNER JOIN tbl_kerangka ON tbl_produk.id_kerangkabahan = tbl_kerangka.id_kerangkabahan where tbl_produk.id_jenisproduk = '".$id_jenisproduk."' and tbl_produk.is_published='1' and tbl_produk.is_customorder='0'");
	}

	public function saveCustomOrder($input)
	{
		try{
			$data = [
				'id_jenisproduk'		=> $input['jenis_produk'],
				'id_ukuranproduk'		=> $input['ukuran'],
				'id_kerangkabahan'		=> $input['kerangka'],
				'warna'					=> $input['warna'],
				'running_text'			=> $input['running_text'],
				'harga_satuan'			=> $input['harga_satuan'],
				'is_published'			=> '0',
				'is_customorder'		=> '1'
				
				];
			if($this->save($data)){
				$input['id_produk'] = $this->con()->insert_id;
				$pesan = new Pesan();
				$pesan->savePesan($input);

				// Lib::redirect('index_produk&main=produk');
				// var_dump($this->con()->insert_id);
			}else{
				header($this->back);
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	

}