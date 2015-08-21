<?php
	namespace controllers;
	/**
	* 
	*/
	use models\Base_Model;
	use \library\Func;
	class Base
	{
		public $model;
		function __construct()
		{
			$this->model = new Base_Model();
			# code...
		}
		function resolve_result($result){
			if($result== "ok"){
				echo "OK";
			}
			
		}

		// $cout's number of $_GET variables
		/**
		* Xu li  toan bo action 
		* Dua ra cac view tuong ung
		*/
		//
		public function box(){
			if($_POST['delete'] == "Delete"){
				foreach ($_POST['checkbox'] as $value) {
					if(is_numeric($value)){
						$this->model->delete_an_element($value);	
					}
				}
			} else if($_POST['activate'] == "Activate"){
				foreach ($_POST['checkbox'] as $value) {
					if(is_numeric($value)){
						$this->model->activate_an_element($value, "Activate");
					}
				}
			} else if($_POST['deactivate'] == "Deactivate"){
				foreach ($_POST['checkbox'] as $value) {
					if(is_numeric($value)){
						$this->model->activate_an_element($value, "Deactivate");
					}
				}
			}
			header("Location: ".PATH."/index.php?controller=".$_GET['controller']."&action=show&page=1");
		}

		//
		public function resolve_action($action){
			$check = new Func();
			// Check action = login  || didn't exist COOKIE variable
			if($action == "login" ){
				self::view('login');
				$check->login();
			}
			if (!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['id'])){
				return 0;
			}
			$this->$action();
		}

		//
		public function resolve_sort(){
			if(isset($_GET['sort']) &&($_GET['sort'] == "DESC" || $_GET['sort'] == "ASC")){
				$_SESSION['sort'] = $_GET['sort'];
			} else $_SESSION['sort']="DESC";
			
		}

		//
		public function view($file, $data = null) {
			if(isset($data))
				extract($data);
			return require_once('view/'.$file.'.php');
		}


	}