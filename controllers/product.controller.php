<?php
namespace controllers;
use models\Category_Model;
use models\Product_Model;
use models\Base_Model;

//
class Product extends Base
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function insert_product(){
		$this->model = new Product_Model($_POST['category_id'], $_POST['product_name'], $_POST['price'], $_POST['details'], $_POST['activate']);
		if($this->model->insert_product()){
			header("Location: ".PATH."/index.php?controller=product&action=add_product&result=ok");

		};
	}
	public function add_product(){
		$this->model = new Category_Model();
		$contain = array('data' => $this->model->get_list_category());
		self::view('add-product', $contain);
	}

	public function edit_starting(){
		
		$contain = array(
		'product_name' => $this->model->get_an_element("products", "product_name", $_GET['id']),
		'price'=> $this->model->get_an_element("products", "price", $_GET['id']) ,
		'details'=> $this->model->get_an_element("products", "details", $_GET['id']));
		//
		self::view('edit-product', $contain);
	}

	public function show(){
		$limit = 10;
		$max_pages= $this->model->get_num_rows("products", $limit);
		$name_fields= $this->model->get_name_element("id|product_name|category_id|price|activate|time_created|time_updated");
		$data = $this->model->get_a_page("products", $_GET['page'], $limit);
		//
		$contain = array("data"=> $data, "name_fields"=> $name_fields, "max_pages"=> $max_pages);
		self::view('list-products', $contain);
	}

}

?>