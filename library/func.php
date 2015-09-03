<?php
	namespace library;
	class Func
	{
		function get_time_zone($gmt){
			date_default_timezone_set("America/Thule");
			$gmtime = gmdate("y/m/d h:i:s", time() + $gmt*3600);
			return $gmtime;
			//
		}

		function upload_image(){
			$upload_dir= "uploads/".$_GET['controller']."/";
			$file_dir = $upload_dir.basename($_FILES['avatar']['name']);
			$imgfileType = pathinfo($file_dir, PATHINFO_EXTENSION);
			$_FILES['avatar']['name'] = $_POST['username'].".".$imgfileType;
			$file_dir = $upload_dir.basename($_FILES['avatar']['name']);
			move_uploaded_file($_FILES['avatar']['tmp_name'], $file_dir);
		}
	}
?>