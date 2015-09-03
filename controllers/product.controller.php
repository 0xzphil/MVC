<?php
namespace controllers;
use models\Category_Model;
use models\Product_Model;
use models\Base_Model;
use library\Validate;
//
class Product extends Base
{
	public $model;
	function __construct()
	{	
		parent::__construct();
		$this->model = new Product_Model();
		$this->rules =  [
			'product_name' => ['required' , 'min:5'   , 'max:25'  , 'not_metachars', 'unique'],
			'price'	       => ['required' , 'min:1'   , 'max:25'  , 'number'],
			'details'	   => ['required' , 'min:5'   , 'max:255' ],
			'avatar'       => ['uploaded' , 'max_size', 'image'   , 'not_fake'],
			'activate'     => ['activate']
		];
	}
	public function insert_product(){
		// Get errors
		$validate = new Validate($this->rules);
		$valid = $validate->execute();
		$this->error = $validate->getErrors();
		if (!$validate->isValidate()) {
			return self::view('add-user', $this->error);
		}
		$this->model = new Product_Model($_POST['category_id'], $_POST['product_name'], $_POST['price'], $_POST['details'], $_POST['activate']);
		if($this->model->insert_product()){
			header("Location: ".PATH."/index.php?controller=product&action=add_product&result=ok");
		} else{
			return self::view('common-errors', ['message' => 'Can not insert!']);
		}
	}
	public function add_product(){
		$contain = array('data' => $this->model->get_list_category());
		self::view('add-product', $contain, $this->error);
	}

	public function edited_product(){
		if (!isset($_POST['update'])) {
			return self::view('common-errors', ['message' => 'Not accept this method']);
		}
		// Get errors
		$validate = new Validate($this->rules);
		$valid = $validate->execute();
		$this->error = $validate->getErrors();
		// If get some error
		if (!$validate->isValidate()) {
			$id = $_GET['id'];
			$product = $this->model->findById($id);
			return self::view('edit-product', $this->error, ['product' => $product]);
		}
		// 
		$this->model = new Product_Model(NULL, $_POST['product_name'], $_POST['price'], $_POST['details'], $_POST['activate']);
		$this->model->edited_product();
		header("Location: ".PATH."/index.php?controller=product&action=add_product&result=ok");
	}
	public function edit_starting(){
		$id = $_GET['id'];
		$product = $this->model->findById($id);
		// Not found user
		if (!$product) {
			return self::view('common-errors', ['message' => 'Product not found!']);
		}
		return self::view('edit-product', ['product' => $product]);
	}

	public function show(){
		$name_fields= $this->model->get_name_element("id|product_name|category_id|price|activate|time_created|time_updated");
		$data = $this->model->get_a_page($_GET['page']);
		$max_pages= $this->model->get_num_rows();
		//
		$contain = array("data"=> $data, "name_fields"=> $name_fields, "max_pages"=> $max_pages);
		self::view('list-products', $contain);
	}

}

?>