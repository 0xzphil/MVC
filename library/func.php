<?php
namespace library;
/**
* 
*/
use models\Base_Model;
class Func
{
	public $conn;
	public $model;
	//
	function check_admin(){
		if(isset($_POST['login'])){
			$this->model = new Base_Model();
			$this->conn = $this->model->connect_db();
			$sql = "SELECT id, username, password FROM users WHERE rank= 9";
			$query = $this->conn->query($sql);
			while ($row = $query->fetch_array(MYSQLI_NUM)) {
				if($_POST['username'] == $row['1'] && md5($_POST['password'])== $row['2']){
					return $row['0'];
				} 
			}
		} 
	}

	function login(){
		self::check_cookie();
		// Check login and check_admin
		if($id = self::check_admin()){
			$_SESSION['username']= $_POST['username'];
			$_SESSION['password']= $_POST['password'];
			$_SESSION['id']= $id;
			if(isset($_POST['remember_me'])){
				setcookie("username", $_POST['username'], time()+1000, "/");
				setcookie("password", $_POST['password'], time()+1000, "/");
				setcookie("id", $id, time()+1000, "/");
			}
			
			header("Location: ".PATH."/index.php?controller=category&action=show&page=1");
		}

	}

	function logout(){
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['id']);
		setcookie("username", "", time()-1000, "/");
		setcookie("password", "", time()-1000, "/");
		setcookie("id", "", time()-1000, "/");
		header("Location: ".PATH);
	}


	function check_cookie(){
		if(isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['id'])){
			$_SESSION['username']= $_COOKIE['username'];
			$_SESSION['password']= $_COOKIE['password'];
			$_SESSION['id'] = $_COOKIE['id'];
			header("Location: ".PATH."/index.php?controller=user&action=home_viewing");
		}
	}


}


?>