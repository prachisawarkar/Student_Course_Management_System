<?php 

include 'db_connect.php';
if(isset($_POST['add'])) {
	$name = $_POST['name'];
	$summary = $_POST['summary'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];

	//name of the uploaded file
	$filename = $_FILES['notes']['name'];

	echo $filename;
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
			$query = "select * from add_course where name = '$name'";
			$result = mysqli_query($con, $query);
			if(mysqli_num_rows($result) > 0) {
				echo ("Course already exists");
			} else {
				$insert_query = "INSERT INTO `add_course` (`name`, `summary`, `start_date`, `end_date`, `notes`, `status`) values ('$name', '$summary', '$start_date', '$end_date', '$filename', 0)";
				if(mysqli_query($con, $insert_query)) {
					echo ("Course added successfully");
				} else {
					echo ("Course is not added. Try again...");
				}
			}
		} else {
			echo "Failed to upload file.";
		}
	}
}


/*$query = "select * from add_course where name = '$name'";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result) > 0) {
	echo ("Course already exists");
} else {
	$insert_query = "INSERT INTO `add_course` (`name`, `summary`, `start_date`, `end_date`,`status`) values ('$name', '$summary', '$start_date', '$end_date','0')";
	if(mysqli_query($con, $insert_query)) {
		echo ("Course added successfully");
	} else {
		echo ("Course is not added. Try again...");
	}
}*/

?>