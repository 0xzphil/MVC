<?php
	namespace controllers;
	/**
	* Base controller
	*/
	use models\Base_Model;
	use library\Validate;
	class Base
	{
		public $model;
		public $error;
		public $rules;
		function __construct()
		{
			$this->error = array();
			$this->model = new Base_Model();
		}

		//
		public function resolve_action(){
			//
			if($_GET['action'] == "login" ){
				User::login();
				self::view('login', $this->error);
				return 0;
			}
			if (!isset($_SESSION['username']) || !isset($_SESSION['password']) || !isset($_SESSION['id'])){
				self::view('login');
				return 0;
			}
			self::resolve_name_table();
			self::resolve_search();
			self::resolve_link();
			//
			$this->$_GET['action']();
		}

		//
		public function resolve_name_table(){
			// Get table
			$table = $_GET['controller'];
			$pos = strlen($table)-1;
			($table[$pos]=='y')
				? $_GET['table']= substr_replace($table, 'ies', $pos)
				: $_GET['table']= substr_replace($table, 's', $pos+1);
		}
		

		public function resolve_link(){
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
				$this->error = $validate->getErrors();
				if(!empty($this->error)){
					$_GET['search']='';
				};
			}
		}

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



		function resolve_result($result){
			if($result== "ok"){
				echo "OK";
			}
			
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