<!DOCTYPE html>
<html>
<head>
	<title>test up file</title>
</head>
<body>
<form action="up_avatar_test.php" method="POST" enctype="multipart/form-data">
	

	<input type="file" name="avatar">
	<input type="submit" name="submit" value="submit">
</form>

</body>
</html>

<?php
	$upload_dir= "uploads/";

	

	$file_dir = $upload_dir.basename($_FILES['avatar']['name']);

	$imgfileType = pathinfo($file_dir, PATHINFO_EXTENSION);

	$_FILES['avatar']['name'] = "1".".".$imgfileType;

	$file_dir = $upload_dir.basename($_FILES['avatar']['name']);

	move_uploaded_file($_FILES['avatar']['tmp_name'], $file_dir);

	
?>