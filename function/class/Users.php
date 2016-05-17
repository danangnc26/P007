<?php
class Users extends Core{

	protected $table 		= 'tbl_users'; 	// Ganti dengan nama tabel yang di inginkan.
	protected $primaryKey	= 'id_user';		// Primary key suatu tabel.
	protected $back			= "location:javascript://history.go(-1)";

	public function __construct()
	{
		parent::__construct($this->table);
	}

	public function authenticate($post)
	{
		$username = mysql_real_escape_string($post['username']);
		$password = mysql_real_escape_string($post['password']);

		$result = $this->findAll("where username='".$username."' and password='".md5($password)."'");
		if(!empty($result) or $result != false){
			foreach ($result as $key => $value) {
				$_SESSION['username'] = $value['username'];
				$_SESSION['id_user'] = $value['id_user'];
				$_SESSION['nama_lengkap']	= $value['nama_lengkap'];
				$_SESSION['jk']	= $value['jk'];
				$_SESSION['level_user']		= $value['level_user'];
			}
			if($_SESSION['level_user'] == 'admin'){
				Lib::redirect('show_welcome&main=awal');
			}elseif($_SESSION['level_user'] == 'customer'){
				header('location:'.app_base.'home');
			}else{
				echo "default";
			}
		}else{
			echo Lib::redirectjs(app_base.'login', 'Akun tidak ditemukan.');
		}
	}

	public function logCheck()
	{
		$logged_in = false;
		//jika session username belum dibuat, atau session username kosong
		if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {	
			//redirect ke halaman login
			Lib::redirect('login');
		} else {
			$logged_in = true;
		}
		
	}

	public function checkLevel()
	{

		if(isset($_SESSION)){
			if($_SESSION['level_user'] != 'admin'){
				Lib::redirect('home');
			}
		}

	}

	public function doLogout()
	{
		session_destroy();
		Lib::redirect('home');
	} 

	public function saveUser($post)
	{
		try{
			if($post['password'] == $post['password2']){
				$data = [
					'username' 		=> $post['username'],
					'password' 		=> md5($post['password']),
					'nama_lengkap'	=> $post['nama_lengkap'],
					'no_hp'			=> $post['no_hp'],
					'alamat_lengkap'=> $post['alamat_lengkap'],
					'jk'			=> $post['jk'],
					'level_user'	=> 'customer'
					];
				if($this->save($data)){
					echo Lib::redirectjs(app_base.'login', 'Akun anda berhasil dibuat, silahkan login untuk melanjutkan.');
				}
			}else{
				header($this->back);
			}

		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function updateUser($post)
	{
		try{
				$data = [
					'nama_lengkap'	=> $post['nama_lengkap'],
					'no_hp'			=> $post['no_hp'],
					'alamat_lengkap'=> $post['alamat_lengkap'],
					'jk'			=> $post['jk']
					];
				if($this->update($data, $this->primaryKey, $_SESSION['id_user'])){
					Lib::redirect('home');
				}else{
				header($this->back);
			}

		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	public function updatePassword($post)
	{
		try {
			if($post['password'] == $post['password2']){
				$data = ['password' => md5($post['password'])];
				if($this->update($data, $this->primaryKey, $_SESSION['id_user'])){
					Lib::redirect('home');
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


	public function listCustomer()
	{
		return $this->findAll("where level_user='customer' order by nama_lengkap");
	}

	public function getUser()
	{
		return $this->findBy($this->primaryKey, $_SESSION['id_user']);
	}

	public function getSelectedUser($id)
	{
		return $this->findBy($this->primaryKey, $id);
	}

	public function getUserName($id)
	{
		$r = $this->getSelectedUser($id);
		foreach ($r as $key => $value) {
			$d[] = $value['nama_lengkap'];
		}
		return implode('', $d);
	}

}