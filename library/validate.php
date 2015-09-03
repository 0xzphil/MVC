<?php 
	namespace library;
	use models\User_Model;
	use models\Product_Model;
	use models\Category_Model;

	class Validate
	{
		private $errors;
		public $model;
		/**
		* $rules is Array $key is param | $value will be rule of this param
		* Ex: ['email' => ['required', 'email']]
		* ==> Mean param $username must not empty & must be email
		*/
		private $rules;
		public function __construct($rules){
			$model = 'models\\'.ucfirst($_GET['controller']).'_Model';
			$this->model = new $model();
			$this->rules = $rules;
		}

		public function getErrors(){
			return $this->errors;
		}
		
		public function execute(){
			foreach ($this->rules as $params => $rules) {
				foreach($rules as $key => $rule) {
					$this->extraValue= $method = explode(':', $rule);
					if (method_exists($this, $method['0']) && isset($_REQUEST[$params])) {
						$this->$method['0']($params, $_REQUEST[$params]);
					}
				}
			}
			
		}

		public function isValidate() {
			return empty($this->errors);
		}

		public function required($param, $value){
			if (empty($value)) {
				$this->errors['error'][$param] = 'This field can not empty';
			}
		}
		//
		public function unique($param, $value){
			//check form if it's true
			if(isset($_GET['id']) && $_POST[$param] == $this->model->get_an_element($param))
				return 0;
			if($this->model->check_an_element($value, $param)) 
				$this->errors['error'][$param] = "This $param was existed";
		}


		public function email($param, $value){
			if (!preg_match('/(\w+)@(\w+).(\w+)/', $value)) {
				$this->errors['error'][$param] = 'This field must be email';
			}
		}

		public function min($param, $value){
			if(strlen($value)< $this->extraValue['1']){
				$this->errors['error'][$param] = "Minium ".$this->extraValue['1']." chars";
			}
		}

		public function max($param, $value){
			if(strlen($value)> $this->extraValue['1']){
				$this->errors['error'][$param] = "Maximum ".$this->extraValue['1']." chars";
			}
		}

		public function not_metachars($param, $value){
			if(preg_match('/[^a-zA-Z0-9_]/', $value)){
				$this->errors['error'][$param] = "This field has meta-characters";
			}
		}

		public function activate($param, $value){
			if($value!="0" && $value!="Deactivate" && $value!="Activate"){
				$this->errors['error'][$param] = "This field's not match!";
			}
		}

		public function uploaded($param){
			if(!is_uploaded_file($_FILES[$param]['tmp_name'])){
				$this->errors['error'][$param] = "Must be uploaded";
			}
		}

		public function max_size($param, $value = null){
			if($_FILES[$param]['size']> 500000){
				$this->errors['error'][$param] = "Too large to uploaded";
			}
		}

		public function image($param, $value = null){
			define("targetFolder", "uploads/".$_GET['controller']."/");
			$targetFile = targetFolder.$_FILES[$param]['name'];
			$imgfileType =pathinfo($targetFile, PATHINFO_EXTENSION);
			if($imgfileType!= 'png' && $imgfileType!= 'jpg' && $imgfileType!= 'jpeg' && $imgfileType!= 'gif' ){
				$this->errors['error'][$param] = "This file's not image";
			}
		}

		public function number($param, $value){
			if(!is_numeric($value)){
				$this->errors['error'][$param] = "This filed's not number!";
			}
		}

		public function not_fake($param, $value= null){
			if(!getimagesize($_FILES[$param]['tmp_name'])){
				$this->errors['error'][$param] = "This filed's fake image!";
			}
		}
	}

?>