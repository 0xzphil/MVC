<?php
	namespace models;
	/**
	* 
	*/
	use library\Func;
	class User_Model extends Base_Model
	{		
		public $username, $password, $email, $activate;
		public $user;
		public function __construct($_username = NULL, $_password = NULL, $_email = NULL, $_activate = NULL){
			parent::__construct();
			$this->username= $_username;
			$this->password= $_password;
			$this->email= $_email;
			$this->activate= $_activate;
		}
		
		
		public function insert_user(){
			$sql= "	INSERT INTO users(
					username,
					password,
					email,
					activate,
					time_created,
					time_updated)
					VALUES(
					'{$this->username}',
					MD5('{$this->password}'),
					'{$this->email}',
					'{$this->activate}',
					'{$this->time}',
					'{$this->time}')";
			$this->func->upload_image();
			$this->conn->query($sql);
			return 1;

		}
		public function edited_user(){
			$sql= "UPDATE users SET
					username = '{$this->username}',
					password = MD5('{$this->password}'),
					email = '{$this->email}',
					activate = '{$this->activate}',	
					time_updated ='{$this->time}'
					WHERE id='{$_GET['id']}'
			";
			
			//
			$this->func->upload_image();
			$this->conn->query($sql); 
			return 1;
		}
		
	}



?>