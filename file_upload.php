<?php

include 'db_connect.php';
if(isset($_POST['add'])) {
	//name of the uploaded file
	$filename = $_FILES['notes']['name'];
	//destination of the file on the server
	$destination = 'uploads/' . $filename;
	//get file extension
	$extension = pathinfo($filename, PATHINFO_EXTENSION);
	//physicl file on a temporary folder directory on the server
	$file = $_FILES['notes']['tmp_name'];
	$size = $_FILES['notes']['size'];

	if(!in_array($extension, ['docx', 'pdf', 'jpeg', 'jpg', 'png'])) {
		echo "File extension must be .pdf, .docx, .jpeg, .jpg or .png";
	} /*else if($_FILES['notes']['size'] > 1000000) { // file should be at most of 1MegaByte
		echo "File too large.";
	}*/ else {
		if(move_uploaded_file($file, $destination)) {
			$sql = "INSERT INTO add_course(`notes`, `downloads`) values ($filename, 0)";
			if(mysqli_query($con, $sql)) {
				echo "File uploaded successfully.";
			}
		} else {
			echo "Failed to upload file.";
		}
	}
}

 ?>