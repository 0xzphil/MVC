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
		public $search;
		public $sortBy, $sortType;

		// Constructor
		public function __construct(){
			$this->error = array();
		}

		// Resolve $_GET['action'] at HTTP Type
		public function resolve_action(){
			if($_GET['action'] == "login" ){
				User::login();
				return self::view('login', $this->error);
			}
			if(!isset($_SESSION['username']) 
				|| !isset($_SESSION['id'])){
				return self::view('login');
			}
			$this->$_GET['action']();
		}

		/*
		* Creat $_GET['link_show'] to contain a part of link at page.php file ;
		* $this->sortType => this var 's the kind of sorting, ASC or DESC 
		* $this->sortBy   => 
		*/
		public function resolve_link(){
			// Creat link_show var
			if(!isset($_GET['page'])) return 0;
			$_GET['link_show'] = "index.php?controller=".$_GET['controller']."&action=show&page=".$_GET['page'];
			if(isset($_GET['search'])) $_GET['link_show'].="&search=".$_GET['search'];
			
			// Check $_GET search var
		    if(!empty($_GET['search'])) $_GET['link']= "&search=".$_GET['search'];
		        else $_GET['link']="";

		    // If not have $_GET['order_type'], it's created
		    if(!isset($_GET['order_type'])){ 
		    	$_GET['order_type']="DESC";
		    }
		    // Resolve for $this->sortType, $this->sortBy
			if(isset($_GET['order_by']) && isset($_GET['order_type'])){
				if(!isset($_GET['sort'])){
					$_GET['sort'] = $_GET['order_type'];
				}
				$_GET['order']="&sort=".$_GET['sort'];
				$this->sortType= $_GET['sort'];
				$this->sortBy  = $_GET['order_by'];
		        $_GET['order'].="&order_by=".$_GET['order_by']; 
			} else $_GET['order']="";
		    
		    // Exchange value of $_GET['order_type'] var
		    if($_GET['order_type']== "DESC") $_GET['order_type']="ASC";
		    	else $_GET['order_type']="DESC";
		    // Some exception change for $_GET['order_type']
		    if(isset($_GET['sort']) && $_GET['sort']=='ASC') 
		    	$_GET['order_type']="DESC";
		}

		// Resolve and check, validate $_GET['search']
		public function resolve_search(){
			if(isset($_GET['search'])){
				$rules =[
				'search'=> ['not_metachars', 'max:25']
				];
				$validate = new Validate($rules);
				$validate->execute();
				$validate->getErrors();
				if(!$validate->isValidate()){
					$_GET['search']='';
				};
				$this->search= $_GET['search'];
			}
		}
		// Change Action Status
		public function act(){
			if($_POST['act']){
				foreach ($_POST['checkbox'] as $value) {
					$this->model->changeActiveStatus($_POST['act'], $value);
				}
			}
			header("Location: ".PATH."/index.php?controller=".$_GET['controller']."&action=show&page=1"); 
		}

		// View function
		public function view($file, $data = null, $contain = null) {
			if(isset($data) && is_array($data))
				extract($data);
			if(isset($contain) && is_array($contain))
				extract($contain);
			return require_once('view/'.$file.'.php');
		}

		// Printing result function
		public function result(){
			if(isset($_GET['result']) && $_GET['result']== "ok"){
				echo "OK";
			}
		}
	}