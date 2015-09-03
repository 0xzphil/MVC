<?php
	namespace controllers;
	/**
	* Base controller
	*/
	use models\Base_Model;
	use library\Validate;
	class Base
	{
		public $error;
		public $rules;
		public $model;
		function __construct()
		{
			//$this->model = new Base_Model();
			$this->error = array();
		}

		//
		public function resolve_action(){
			if($_GET['action'] == "login" ){
				User::login();
				return self::view('login', $this->error);
			}
			if(!isset($_SESSION['username']) 
				|| !isset($_SESSION['password']) 
				|| !isset($_SESSION['id'])){
				return self::view('login');
			}
			$this->$_GET['action']();
		}

		public function resolve_link(){
			//
			if(!isset($_GET['page'])) return 0;
			// Creat link_show var
			$_GET['link_show'] = "index.php?controller=".$_GET['controller']."&action=show&page=".$_GET['page'];
			if(isset($_GET['search'])) $_GET['link_show'].="&search=".$_GET['search'];
			
			// Check $_GET search var
		    if(!empty($_GET['search'])) $_GET['link']= "&search=".$_GET['search'];
		        else $_GET['link']="";

		    // If not have $_GET['order_type'], it's created
		    if(!isset($_GET['order_type'])){ 
		    	$_GET['order_type']="DESC";
		    }
		    
			if(isset($_GET['order_by']) && isset($_GET['order_type'])){
				//
				if(!isset($_GET['sort'])){
					$_GET['sort'] = $_GET['order_type'];
		        	$_GET['order']="&sort=".$_GET['sort'];
				}
		        else $_GET['order']="&sort=".$_GET['sort'];
		        //
		        $_GET['order'].="&order_by=".$_GET['order_by']; 
			} else $_GET['order']="";
		    
		    // Exchange value of order var
		    if($_GET['order_type']== "DESC") $_GET['order_type']="ASC";
		    	else $_GET['order_type']="DESC";
		    // Some exception change
		    if(isset($_GET['sort']) && $_GET['sort']=='ASC') $_GET['order_type']="DESC";
		}

		public function resolve_search(){
			if(isset($_GET['search'])){
				$rules =[
				'search'=> ['not_metachars', 'max']
				];
				$validate = new Validate($rules);
				$validate->execute();
					$validate->getErrors();
				if(!$validate->isValidate()){
					$_GET['search']='';
				};
			}

		}
		// Three action for index data
		public function act(){
			if($_POST['act']){
				$name_func= strtolower($_POST['act'])."_an_element";
				if($_POST['checkbox']== "all"){
					$name_func= strtolower($_POST['act'])."_all";
					$this->model->$name_func($_POST['act']);
				}
				foreach ($_POST['checkbox'] as $value) {
					if(is_numeric($value)){
						$this->model->$name_func($value, $_POST['act']);	
					}
				}
			}
			header("Location: ".PATH."/index.php?controller=".$_GET['controller']."&action=show&page=1"); 
		}

		// view function
		public function view($file, $data = null, $contain = null) {
			if(isset($data) && is_array($data))
				extract($data);
			if(isset($contain) && is_array($contain))
				extract($contain);
			return require_once('view/'.$file.'.php');
		}

		public function result(){
			if(isset($_GET['result']) && $_GET['result']== "ok"){
				echo "OK";
			}
		}
	}