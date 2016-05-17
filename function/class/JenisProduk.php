<?php
class JenisProduk extends Core{

	protected $table 		= 'tbl_jenisproduk'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'id_jenisproduk';		// Primary key suatu tabel.
	protected $back			= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function index()
	{
		return $this->findAll('order by nama');
	}

	public function store($input)
	{
		try{
			$data = [
				'nama' 				=> $input['nama'],
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
				'nama' 				=> $input['nama'],
				];
			if($this->update($data, $this->primaryKey, $input['id_jenisproduk'])){
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