<?php
namespace controllers;
/**
* 
*/
use models\Category_Model;
use models\Base_Model;

class Category extends Base
{
	
	function __construct()
	{
		parent::__construct();
	}
	//
	public function insert_category(){
		if(isset($_POST['Creat'])){
			$this->model = new Category_Model($_POST['category_name'], $_POST['activate']);
			if($this->model->insert_category()){
				header("Location: ".PATH."/index.php?controller=category&action=add_category&result=ok");
			}
		}
	}
	//
	public function edited_category(){
		if(isset($_POST['Update'])){
			$this->model = new Category_Model($_POST['category_name'], $_POST['activate']);
			$this->model->edited_category();
			echo "OK";
			header("Location: ".PATH."/index.php?controller=category&action=show&page=1");
		}
	}
	//
	public function edit_starting(){
		$contain = array('category_name'=> $this->model->get_an_element("category_name"));
		self::view('edit-category', $contain);
	}
	//
	public function show(){
		$name_fields =$this->model->get_name_element("id|category_name|activate|time_created|time_updated");
		$data =$this->model->get_a_page();
		$max_pages= $this->model->get_num_rows();
		//
		$contain = array('data'=>$data, 'name_fields'=> $name_fields, 'max_pages'=>$max_pages);
		self::view('list-categories', $contain);


	}
	//
	public function add_category(){
		self::view('add-category');
	}

	
}


?>