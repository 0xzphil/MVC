<?php
	namespace models;
	/**
	* 
	*/
	class Product_Model extends Base_Model
	{
		public $category_id;
		public $product_name;
		public $price;
		public $details;
		public $activate;
		public $time_created;
		public $time_updated;
		public $table;

		function __construct($category_id=NULL, $product_name=NULL, $price=NULL, $details=NULL, $activate=NULL){
			parent::__construct();
			$this->table = 'products';
			$this->category_id = $category_id;
			$this->product_name= $product_name;
			$this->price = $price;
			$this->details = $details;
			$this->activate = $activate;
		}
		public function insert_product(){
			$sql ="INSERT INTO 
				products(
					category_id,
					product_name,
					price,
					details,
					activate,
					time_created,
					time_updated
					) 
				VALUES(
					'{$this->category_id}',
					'{$this->product_name}',
					'{$this->price}',
					'{$this->details}',
					'{$this->activate}',
					'{$this->time}',
					'{$this->time}'
					)";
			$this->conn->query($sql);
			return 1;
		}
		
		public function edited_product(){
			$sql= "UPDATE products
				SET product_name = '{$this->product_name}',
					price ='{$this->price}',
					details ='{$this->details}',
					activate = '{$this->activate}',
					time_updated = '{$this->time}'
				WHERE id = '{$_GET['id']}'";
			$this->conn->query($sql);
			return 1;
		}

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