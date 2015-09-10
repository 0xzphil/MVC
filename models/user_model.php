<?php
	namespace models;
	/**
	* 
	*/
	use library\Func;
	class User_Model extends Base_Model
	{		
		public $username, $password, $email, $activate;
		public function __construct($_username = NULL, $_password = NULL, $_email = NULL, $_activate = NULL){
			parent::__construct();
			$this->table   = 'users';
			$this->username= $_username;
			$this->password= $_password;
			$this->email   = $_email;
			$this->activate= $_activate;
		}
		public function insert_user(){
			$this->avatar = $this->func->upload_image();
			$sql= "	INSERT INTO users(
					username,
					password,
					email,
					avatar,
					activate,
					time_created,
					time_updated)
					VALUES(
					'{$this->username}',
					MD5('{$this->password}'),
					'{$this->email}',
					'{$this->avatar}',
					'{$this->activate}',
					'{$this->time}',
					'{$this->time}')";
			$this->conn->query($sql);
			return 1;
		}
		public function edited_user(){
			$this->avatar = $this->func->upload_image();
			$sql= "UPDATE users SET
					username = '{$this->username}',
					password = MD5('{$this->password}'),
					email = '{$this->email}',
					avatar = '{$this->avatar}',
					activate = '{$this->activate}',	
					time_updated ='{$this->time}'
					WHERE id='{$_GET['id']}'
			";
			$this->conn->query($sql); 
			return 1;
		}
		
		function check_user(){
			if(isset($_POST['login'])){
				$sql = "SELECT id, username, password FROM users";
				$query = $this->conn->query($sql);
				while ($row = $query->fetch_array(MYSQLI_NUM)) {
					if($_POST['username'] == $row['1'] && md5($_POST['password'])== $row['2']){
						return $row['0'];
					} 
				}
			} 
		}
	}
?>