<?php
	namespace models;
	/**
	* 
	*/
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
					'{$this->password}',
					'{$this->email}',
					'{$this->activate}',
					'5555-11-11',
					'5555-11-11')";
			$this->conn->query($sql);
			return 1;

		}
		public function edited_user(){
					$sql= " UPDATE users SET
					username = '{$this->username}',
					password = '{$this->password}',
					email = '{$this->email}',
					activate = '{$this->activate}'
					WHERE id='{$_GET['id']}'
			";
			$this->conn->query($sql); 
			return 1;
		}
		
	}



?>