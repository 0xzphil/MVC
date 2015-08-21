<?php
	namespace controllers;
	/**
	* 
	*/
	use models\User_Model;
	use models\Base_Model;
	use \library\Func;
	class User extends Base
	{
		public $user;
		private $username, $password, $email, $activate;
		function __construct()
		{
			parent::__construct();
		}

		public function insert_user() {
			$this->model = new User_Model($_POST['username'], $_POST['password'], $_POST['email'], $_POST['activate']);
			if($this->model->insert_user()){
			header("Location: ".PATH."/index.php?controller=user&action=add_user&result=ok");
			};
		}
		public function edited_user(){
			$this->model = new User_Model($_POST['username'], $_POST['password'], $_POST['email'], $_POST['activate']);
			if($this->model->edited_user()){
			header("Location: ".PATH."/index.php?controller=user&action=edit_starting&id=".$_GET['id']."&result=ok");
			}
		}
		public function edit_starting(){
			$username = $this->model->get_an_element("users", "username", $_GET['id']);
			$email = $this->model->get_an_element("users", "email", $_GET['id']);
			//
			$contain = array('username'=> $username, 'email' => $email);
			self::view('edit-user', $contain);
		}
		public function show(){
			$limit = 10;
			$max_pages = $this->model->get_num_rows("users", $limit);
			$name_fields= $this->model->get_name_element("id|username|activate|time_created|time_updated");
			$data = $this->model->get_a_page("users", $_GET['page'], $limit);
			//
			$contain = array("data"=> $data, "name_fields"=> $name_fields, "max_pages"=> $max_pages);
			self::view('list-users', $contain);
				
		}
		/*
		*
		*/
		public function add_user(){
			self::view('add-user');
		}

		public function logout(){
			$check = new Func();
			$check->logout();
		}
		
	}



?>