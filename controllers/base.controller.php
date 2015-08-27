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
		public $error;
		public $rules;
		function __construct()
		{
			$this->error = array();
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
		public function act(){
			if($_POST['act']){
				$name_func= strtolower($_POST['act'])."_an_element";
				foreach ($_POST['checkbox'] as $value) {
					if(is_numeric($value)){
						$this->model->$name_func($value, $_POST['act']);	
					}
				}
			}
			header("Location: ".PATH."/index.php?controller=".$_GET['controller']."&action=show&page=1");
		}

		//
		public function resolve_action(){
			$check = new Func();
			// Check action = login  || didn't exist COOKIE variable
			if($_GET['action'] == "login" ){
				self::view('login');
				$check->login();
			}
			if (!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['id'])){
				return 0;
			}
			self::resolve_name_table();
			$this->$_GET['action']();
		}
		public function resolve_name_table(){
			// Get table
			$table = $_GET['controller'];
			$pos = strlen($table)-1;
			($table[$pos]=='y')
				? $_GET['table']= substr_replace($table, 'ies', $pos)
				: $_GET['table']= substr_replace($table, 's', $pos+1);
		}
		//
		public function resolve_sort(){
			if(isset($_GET['sort']) &&($_GET['sort'] == "DESC" || $_GET['sort'] == "ASC")){
				$_SESSION['sort'] = $_GET['sort'];
			} else $_SESSION['sort']="DESC";
			
		}

		//
		public function view($file, $data = null, $contain = null) {
			if(isset($data) && is_array($data))
				extract($data);
			if(isset($contain) && is_array($contain))
				extract($contain);
			return require_once('view/'.$file.'.php');
		}
	}