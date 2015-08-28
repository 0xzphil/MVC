<?php
	namespace models;
	use controllers\Base;
	use library\Func;

	class Base_Model extends \mysqli
	{	
		public $conn; // connect data
		public $element; // fields of data
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
		public function get_a_page(){
			$this->page   = $_GET['page'];
			$this->fields = implode(", ", $this->element);
			$this->offset = ($this->page-1)*LIMIT;
			//
			$sql = "";
			$select = "SELECT $this->fields 
				FROM {$_GET['table']}
				";
			//
			$search= self::find_something();
			$sort = self::sort_something();
			//$order = "ORDER BY id DESC";
			$limit = " LIMIT ".LIMIT." 
				OFFSET $this->offset";
			//
			$sql.=$select.=$search.=$sort.=$limit;
			// query
			$query = $this->conn->query($sql);
			if($query->num_rows!=0){
				$iter=0;
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

		
		public function get_num_rows(){
			$sql = "SELECT id FROM {$_GET['table']} ";
			$order = " ORDER BY id DESC";
			$search= self::find_something();
			$sql.=$search.=$order;

			// query
			$query = $this->conn->query($sql);
			$cout1 = (int)(($query->num_rows)/LIMIT);
			$cout2 = (($query->num_rows)/LIMIT);
			return $cout1==$cout2?$cout1:($cout1+1);
		} 
		//
		public function find_something(){
			if(isset($_GET['search'])){
				return " WHERE {$this->element['1']} 
		        LIKE '%{$_GET['search']}%'";  
			} else return ""; 
		}

		public function sort_something(){

			if(!isset($_GET['sort'])){
				return " ORDER BY id DESC";
			} else return " ORDER BY {$_GET['order_by']} {$_GET['sort']}";
		}


		public function get_an_element($element){
			$sql ="SELECT {$element} FROM {$_GET['table']} WHERE id= '{$_GET['id']}'";
			$query = $this->conn->query($sql);
			$row= $query->fetch_array(MYSQLI_NUM);
			return $row['0'];
		}
		public function check_an_element($string, $column){
			$sql ="SELECT {$column} FROM {$_GET['table']} WHERE {$column}= '{$string}'";
			$query = $this->conn->query($sql);
			if($query->num_rows!= 0) return 1;
		}

		//
		public function delete_an_element($id, $value=null){
			$sql = "DELETE FROM {$_POST['table']} WHERE id = {$id}";
			$this->conn->query($sql);
		}

		public function activate_an_element($id, $value){
			$sql = "UPDATE {$_POST['table']} SET activate= '{$value}', time_updated = '{$this->time}' WHERE id='{$id}'";
			$this->conn->query($sql);
		}

		public function deactivate_an_element($id, $value){
			$sql = "UPDATE {$_POST['table']} SET activate= '{$value}', time_updated = '{$this->time}' WHERE id='{$id}'";
			$this->conn->query($sql);
		}

		public function delete_all($value= null){
			$sql = "DELETE FROM {$_POST['table']}";
			$this->conn->query($sql);
		}

		public function activate_all($value){
			$sql = "UPDATE {$_POST['table']} SET activate= '{$value}', time_updated = '{$this->time}'";
			$this->conn->query($sql);
		}

		public function deactivate_all($value){
			$sql = "UPDATE {$_POST['table']} SET activate= '{$value}', time_updated = '{$this->time}'";
			$this->conn->query($sql);
		}

	}

?>