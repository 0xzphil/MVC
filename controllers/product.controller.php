<?php
namespace controllers;
use models\Category_Model;
use models\Product_Model;
use models\Base_Model;
use library\Validate;
//
class Product extends Base
{
	
	function __construct()
	{	
		parent::__construct();
		$this->rules =  [
			'product_name' => ['required', 'min'   , 'max'  , 'not_metachars', 'unique'],
			'price'	       => ['required', 'number'],
			'details'	   => ['required'],
			'activate'     => ['activate'],
			'avatar'       => ['uploaded', 'max_size', 'image', 'not_fake']
		];
	}
	public function insert_product(){
		// Get errors
			$validate = new Validate($this->rules);
			$valid = $validate->execute();
			$this->error = $validate->getErrors();
		//
		if(isset($_POST['Creat']) && empty($this->error)){
			$this->model = new Product_Model($_POST['category_id'], $_POST['product_name'], $_POST['price'], $_POST['details'], $_POST['activate']);
			if($this->model->insert_product()){
				header("Location: ".PATH."/index.php?controller=product&action=add_product&result=ok");
			};
		} else{
			self::add_product();
		}
	}
	public function add_product(){
		$this->model = new Category_Model();
		$contain = array('data' => $this->model->get_list_category());
		self::view('add-product', $contain, $this->error);
	}

	public function edit_starting(){
		if(!isset($_POST['product_name']))
			$_POST['product_name'] = $this->model->get_an_element("product_name");
		if(!isset($_POST['price']))
			$_POST['price']        = $this->model->get_an_element("price");
		if(!isset($_POST['details']))
			$_POST['details']      = $this->model->get_an_element("details");
		//
		self::view('edit-product',  $this->error);
	}

	public function show(){
		$name_fields= $this->model->get_name_element("id|product_name|category_id|price|activate|time_created|time_updated");
		$data = $this->model->get_a_page();
		$max_pages= $this->model->get_num_rows();
		//
		$contain = array("data"=> $data, "name_fields"=> $name_fields, "max_pages"=> $max_pages);
		self::view('list-products', $contain);
	}

	public function edited_product(){
		// Get errors
			$validate = new Validate($this->rules);
			$valid = $validate->execute();
			$this->error = $validate->getErrors();
		//
		if(isset($_POST['update']) && empty($this->error)){
			$this->model = new Product_Model(NULL, $_POST['product_name'], $_POST['price'], $_POST['details'], $_POST['activate']);
			if($this->model->edited_product()){
				header("Location: ".PATH."/index.php?controller=product&action=add_product&result=ok");
			};
		} else{
			self::edit_starting();
		}
	}

}

?>