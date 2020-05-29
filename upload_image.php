<?php

include 'db_connect.php';
if(isset($_POST['submit'])) {
	$name = $_FILES['file']['name'];
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);

	//select file type
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	//valid file extension
	$extensions_arr = array("jpg", "jpeg", "png" , "gif");

	//check extension
	if(in_array($imageFileType, $extensions_arr)) {
		//insert record
		$query = "insert into student_registration(image) values ('" . $name . "')";
		mysqli_query($con, $query);

		//upload file
		move_uploaded_file($_FILES['file']['tmp_name'], $target_dir . $name);
	} 
}

?>