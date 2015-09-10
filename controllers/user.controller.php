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
				'email'	   => ['required', 'unique'  , 'email'],
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
			// Not have any errors
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
			// Not have any errors
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
			// Not have any errors
			return self::view('edit-user', ['user' => $user]);
		}

		public function show(){
			$name_fields= $this->model->get_name_element("id|username|activate|time_created|time_updated");
			$this->model->searchInfo($this->search);
			$this->model->sortData($this->sortBy, $this->sortType);
			$data = $this->model->get_a_page($_GET['page']);
			$max_pages = $this->model->get_num_pages();
			//
			$contain = array("data"=> $data, "name_fields"=> $name_fields, "max_pages"=> $max_pages);
			self::view('list-users', $contain);
				
		}
		//
		public function add_user(){
			self::view('add-user');
		}

		// checking login method
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
				if($id = $this->model->check_user()){
					$user = $this->model->findById($id);
					$_SESSION['username']= $_POST['username'];
					$_SESSION['avatar']  = $user['avatar'];
					$_SESSION['id']      = $id;
					if(isset($_POST['remember_me'])){
						setcookie("username", $_POST['username'], time()+1000, "/");
						setcookie("avatar"  , $user['avatar']   , time()+1000, "/");
						setcookie("id"      , $id               , time()+1000, "/");
					}
					header("Location: ".PATH."/index.php?controller=category&action=show&page=1");
				}
			}
		}

		function check_cookie(){
			if(isset($_COOKIE['username']) && isset($_COOKIE['id'])){
				$_SESSION['username']= $_COOKIE['username'];
				$_SESSION['avatar']= $_COOKIE['avatar'];
				$_SESSION['id']      = $_COOKIE['id'];
				header("Location: ".PATH."/index.php?controller=category&action=show&page=1");
			}
		}

		public function logout(){
			unset($_SESSION['username']);
			unset($_SESSION['avatar']);
			unset($_SESSION['id']);
			setcookie("username", "", time()-1000, "/");
			setcookie("avatar", "", time()-1000, "/");
			setcookie("id", "", time()-1000, "/");
			header("Location: ".PATH);
		}
		
	}

?>