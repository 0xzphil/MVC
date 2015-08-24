<?php
	namespace models;
	/**
	* 
	*/
	class Category_Model extends Base_Model
	{
		public $category_name, $activate;
		//
		function __construct($category_name = NULL, $activate = NULL)
		{
			parent::__construct();
			$this->category_name = $category_name;
			$this->activate= $activate;
		}
		//
		public function insert_category(){
			$sql = "INSERT INTO 
					categories( category_name,
			 					activate, 
			 					time_created, 
			 					time_updated) 
					VALUES(     '{$this->category_name}', 
						 		'{$this->activate}', 
						 		'{$this->time}', 
						 		'{$this->time}')";
			$this->conn->query($sql);
			return 1;
		}
		//
		public function edited_category(){
			$sql = "UPDATE 
					categories
					SET category_name = '{$this->category_name}',
						activate ='{$this->activate}',
						time_updated = '{$this->time}'
					WHERE id='{$_GET['id']}'
					";
			echo "$sql";
			$this->conn->query($sql);
			return 1;
		}
		//
		public function get_list_category(){
			$sql = "SELECT id, category_name FROM categories";
			$query= $this->conn->query($sql);
			$data = array();
			$iter =0;
			while ($row = $query->fetch_array(MYSQLI_NUM)) {
				$data[$iter]['id'] = $row['0'];
				$data[$iter]['category_name'] = $row['1'];
				$iter++; 
			}
			return $data;
		}
	
	}



?>
