<?php
	namespace models;
	/**
	* 
	*/
	use controllers\Base;
	use library\Func;

	class Base_Model extends \mysqli
	{	
		public $conn; // connect data
		public $element; // fields of data
		public $sort; // using to sort
		public $trend; // using to sort
		public $controller;
		public $func;
		public $time;

		function __construct(){
			//
			$this->conn=new \mysqli(LOCALHOST, USERNAME, PASSWORD, DATABASE);
			if($this->conn->connect_error){
				die("Connection failed". $this->conn->connect_error);
			}
			$this->func= new Func();
			$this->time= $this->func->get_time_zone("+7");
		}
		/*
		* Function to connect database
		*/
		function connect_db(){

			$this->conn=new \mysqli(LOCALHOST, USERNAME, PASSWORD, DATABASE);

			if($this->conn->connect_error){
				die("Connection failed". $this->conn->connect_error);
			}
			return $this->conn;
			
		}
		/*
		* Details of this two funtions get_name_element using to get name of element in database
		* Below, $this->element[$pos] use to (get name of element) at $pos position, example, it returns "username" or "password"
		* $element[$this->element[$pos]][$iter], example: it returns(  $element['username']['0'] , $ $element['username']['1'], ... )
		*/
		public function get_name_element($string){
			return $this->element = explode("|", $string);
		}
		//
		public function get_a_page($table, $page, $limit){
			self::sort_data();
			$fields = implode(", ", $this->element);
			$offset = ($page-1)*$limit;
			//
			//self::join_table
			$sql = "SELECT $fields FROM $table ORDER BY id {$_SESSION['sort']} LIMIT $limit OFFSET $offset";
			//
			self::find_something($sql, $fields, $table, $limit, $offset);
			// query
			$query = $this->conn->query($sql);
			if($query->num_rows!=0){
				//
				$iter=0;
				//
				while ($row=$query->fetch_array(MYSQLI_NUM)) {
					// $pos is position of index
					for($pos=0; $pos<count($this->element); $pos++){
						$element[$this->element[$pos]][$iter]= $row[$pos];
					} 	
					$iter++;
				} 
				return $element;
			} else return 0;
		}

		
		public function get_num_rows($table, $limit){
			$sql = "SELECT id FROM $table ORDER BY id ";
			// query
			$query = $this->conn->query($sql);
			$cout1 = (int)(($query->num_rows)/$limit);
			$cout2 = (($query->num_rows)/$limit);
			return $cout1==$cout2?$cout1:($cout1+1);
		} 

		public function delete_an_element($id){
			$sql = "DELETE FROM {$_POST['table']} WHERE id = {$id}";
			$this->conn->query($sql);
		}

		public function activate_an_element($id, $value){
			$sql = "UPDATE {$_POST['table']} SET activate= '{$value}' WHERE id='{$id}'";
			$this->conn->query($sql);
		}


		public function get_an_element($table, $element, $id){
			$sql ="SELECT {$element} FROM {$table} WHERE id= '{$id}'";
			$query = $this->conn->query($sql);
			$row= $query->fetch_array(MYSQLI_NUM);
			return $row['0'];
		}

		public function delete_all(){

		}

		public function activate_all(){

		}
		
		public function deactivate_all(){

		}


		public function find_something(&$sql, $fields, $table, $limit, $offset){
			if(isset($_GET['search'])){
				$sql = "SELECT $fields FROM  $table WHERE {$this->element['1']} LIKE '%{$_GET['search']}%' ORDER BY id DESC LIMIT $limit OFFSET $offset";
			}	
		}

		public function sort_data(){
			$this->controller = new Base();
			$this->controller->resolve_sort();		
		}

	}

?>