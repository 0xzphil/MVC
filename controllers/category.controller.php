<?php
namespace controllers;
/**
* 
*/
use models\Category_Model;
use models\Base_Model;

class Category extends Base
{
	public $model;
	function __construct(){
		$this->model = new Category_Model();
		parent::__construct();
	}
	//
	public function insert_category(){
		$this->model = new Category_Model($_POST['category_name'], $_POST['activate']);
		$this->model->insert_category();
		header("Location: ".PATH."/index.php?controller=category&action=add_category&result=ok");
	}
	//
	public function add_category(){
		self::view('add-category');
	}
	//
	public function edited_category(){
		$this->model = new Category_Model($_POST['category_name'], $_POST['activate']);
		$this->model->edited_category();
		header("Location: ".PATH."/index.php?controller=category&action=show&page=1");
	}
	//
	public function edit_starting(){
		$contain = array('category_name'=> $this->model->get_an_element("category_name"));
		self::view('edit-category', $contain);
	}
	//
	public function show(){
		$name_fields =$this->model->get_name_element("id|category_name|activate|time_created|time_updated");
		$data =$this->model->get_a_page($_GET['page']);
		$max_pages= $this->model->get_num_rows();
		//
		$contain = array('data'=>$data, 'name_fields'=> $name_fields, 'max_pages'=>$max_pages);
		self::view('list-categories', $contain);
	}
}


?>