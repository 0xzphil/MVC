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

		function __construct(){
			parent::__construct();	
		}

		public function insert_user() {
			$this->rules =  [
				'username' => ['required', 'min'   , 'max'  , 'not_metachars', 'unique'],
				'password' => ['required', 'min'   , 'max'  , 'not_metachars'],
				'email'	   => ['required', 'unique', 'email'],
				'activate' => ['activate'],
				'avatar'   => ['uploaded', 'max_size', 'image', 'not_fake']
			];
			// Get errors
			$validate = new Validate($this->rules);
			$valid = $validate->execute();
			$this->error = $validate->getErrors();
			//
			if(isset($_POST['username']) && empty($this->error)) {
				$this->model = new User_Model($_POST['username'], $_POST['password'], $_POST['email'], $_POST['activate']);
				//
				if($this->model->insert_user()){
					header("Location: ".PATH."/index.php?controller=user&action=add_user&result=ok");
				};
			} else {
				self::view('add-user', $this->error);
			}

		}


		public function edited_user(){
			$this->rules =  [
				'username' => ['required', 'min'   , 'max'  , 'not_metachars', 'unique'],
				'password' => ['required', 'min'   , 'max'  , 'not_metachars'],
				'email'	   => ['required', 'unique', 'email'],
				'activate' => ['activate'],
				'avatar'   => ['uploaded', 'max_size', 'image', 'not_fake']
			];
			// Get errors
			$validate = new Validate($this->rules);
			$valid = $validate->execute();
			$this->error = $validate->getErrors();
			//
			if(isset($_POST['update']) && empty($this->error)){
				$this->model = new User_Model($_POST['username'], $_POST['password'], $_POST['email'], $_POST['activate']);
				if($this->model->edited_user()){
					header("Location: ".PATH."/index.php?controller=user&action=edit_starting&id=".$_GET['id']."&result=ok");
				}
			} else if(isset($_POST['update'])){
				self::edit_starting();
			}
		}
		public function edit_starting(){
			if(!isset($_POST['username']))
				$_POST['username'] = $this->model->get_an_element("username");
			
			if(!isset($_POST['email']))
				$_POST['email'] = $this->model->get_an_element("email");

			self::view('edit-user', $this->error );
		}
		public function show(){
			//
			$max_pages = $this->model->get_num_rows();
			$name_fields= $this->model->get_name_element("id|username|activate|time_created|time_updated");
			$data = $this->model->get_a_page();
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