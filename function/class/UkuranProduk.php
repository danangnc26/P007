<?php
class UkuranProduk extends Core{

	protected $table 		= 'tbl_ukuran'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'id_ukuranproduk';		// Primary key suatu tabel.
	protected $back			= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function index()
	{
		return $this->findAll('order by ukuran');
	}

	public function store($input)
	{
		try{
			$data = [
				'ukuran' 				=> $input['ukuran'],
				'harga' 				=> $input['harga']
				];
			if($this->save($data)){
				Lib::redirect('data_master&main=master');
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
				'ukuran' 				=> $input['ukuran'],
				'harga' 				=> $input['harga']
				];
			if($this->update($data, $this->primaryKey, $input['id_ukuranproduk'])){
				Lib::redirect('data_master&main=master');
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
			Lib::redirect('data_master&main=master');
		}else{
			header($this->back);
		}
	}

}