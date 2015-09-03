<?php
	namespace controllers;
	/**
	* 
	*/
	use models\User_Model;
	use models\Base_Model;
	use library\Func;
	use library\Validate;
	class User extends Base
	{
		public $model;

		function __construct(){
			$this->model = new User_Model();
			parent::__construct();	
			$this->rules =  [
				'username' => ['required', 'min:5'   , 'max:20'  , 'not_metachars', 'unique'],
				'password' => ['required', 'min:5'   , 'max:20'  , 'not_metachars'],
				'email'	   => ['required', 'unique', 'email'],
				'activate' => ['activate'],
				'avatar'   => ['uploaded', 'max_size', 'image', 'not_fake']
			];
		}

		public function insert_user() {
			// Get errors
			$validate = new Validate($this->rules);
			$valid = $validate->execute();
			$this->error = $validate->getErrors();
			// Check validate or not
			if (!$validate->isValidate()) {
				return self::view('add-user', $this->error);
			}
			$this->model = new User_Model($_POST['username'], $_POST['password'], $_POST['email'], $_POST['activate']);
			if($this->model->insert_user()){
				header("Location: ".PATH."/index.php?controller=user&action=add_user&result=ok");
			}; 
			return self::view('common-errors', ['message' => 'Can not insert!']);
		}


		public function edited_user(){
			if (!isset($_POST['update'])) {
				return self::view('common-errors', ['message' => 'Not accept this method']);
			}
 			// Get errors
			$validate = new Validate($this->rules);
			$valid = $validate->execute();
			$this->error = $validate->getErrors();
			// Check validate or not
			if (!$validate->isValidate()) {
				$id = $_GET['id'];
				$user = $this->model->findById($id);
				return self::view('edit-user', $this->error, ['user' => $user]);
			}

			$this->model = new User_Model($_POST['username'], $_POST['password'], $_POST['email'], $_POST['activate']);
			$this->model->edited_user();
			header("Location: ".PATH."/index.php?controller=user&action=edit_starting&id=".$_GET['id']."&result=ok");
		}

		public function edit_starting(){
			$id = $_GET['id'];
			$user = $this->model->findById($id);
			// Not found user
			if (!$user) {
				return self::view('common-errors', ['message' => 'User not found!']);
			}
			return self::view('edit-user', ['user' => $user]);
		}

		public function show(){
			//
			$name_fields= $this->model->get_name_element("id|username|activate|time_created|time_updated");
			$data = $this->model->get_a_page($_GET['page']);
			$max_pages = $this->model->get_num_rows();
			//
			$contain = array("data"=> $data, "name_fields"=> $name_fields, "max_pages"=> $max_pages);
			self::view('list-users', $contain);
				
		}
		//
		public function add_user(){
			self::view('add-user');
		}

		// CHECK LOGIN
		
		function login(){
			self::check_cookie();
			$rules = 
			[
				'username' => ['empty', 'not_metachars', 'min:5', 'max:20'],
 				'password' => ['empty', 'not_metachars', 'min:5', 'max:20']
			];

			$validate = new Validate($rules);
			$validate->execute();
			$this->error = $validate->getErrors();
			// Check login and check_admin
			if(empty($this->error)){
				if($id = self::check_user()){
					$_SESSION['username']= $_POST['username'];
					$_SESSION['password']= $_POST['password'];
					$_SESSION['id']= $id;
					if(isset($_POST['remember_me'])){
						setcookie("username", $_POST['username'], time()+1000, "/");
						setcookie("password", $_POST['password'], time()+1000, "/");
						setcookie("id", $id, time()+1000, "/");
					}
					header("Location: ".PATH."/index.php?controller=category&action=show&page=1");
				}
			}
		}

		function check_cookie(){
			if(isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['id'])){
				$_SESSION['username']= $_COOKIE['username'];
				$_SESSION['password']= $_COOKIE['password'];
				$_SESSION['id']      = $_COOKIE['id'];
				header("Location: ".PATH."/index.php?controller=category&action=show&page=1");
			}
		}

		function check_user(){
			if(isset($_POST['login'])){
				$this->conn = $this->model->connect_db();
				$sql = "SELECT id, username, password FROM users";
				$query = $this->conn->query($sql);
				while ($row = $query->fetch_array(MYSQLI_NUM)) {
					if($_POST['username'] == $row['1'] && md5($_POST['password'])== $row['2']){
						return $row['0'];
					} 
				}
			} 
		}
		public function logout(){
			unset($_SESSION['username']);
			unset($_SESSION['password']);
			unset($_SESSION['id']);
			setcookie("username", "", time()-1000, "/");
			setcookie("password", "", time()-1000, "/");
			setcookie("id", "", time()-1000, "/");
			header("Location: ".PATH);
		}
		
	}

?>