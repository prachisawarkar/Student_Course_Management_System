<?php 
	include 'db_connect.php';
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$phone_no = $_POST['phone_no'];
	$address = $_POST['address'];

	/*$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES['image']['name']);
	$uploadOk = 1;
	$imageFileType = strToLower(pathinfo($target_file, PATHINFO_EXTENSION));
	$extension = array('gif', 'png', 'jpg', 'jpeg');
	if(!in_array($imageFileType, $extension)) {
		echo "Image file type is not supported.";
		header("Location : addStudent.html");
		$uploadOk = 0;
	}
	$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
	echo $file;*/

	/*if($password !== $confirm_password) {
		array_push($errors, "Password does not match");
	}*/

	$query = "select * from student_registration where email = '$email' ";
	$result = mysqli_query($con, $query);
	if(mysqli_num_rows($result) > 0) {
		echo json_encode("Student already exists");
	} else {
		$insert_query = "INSERT INTO `student_registration` (`name`, `email`, `username`, `password`, `confirm_password`, `phone_no`, `address`, `created`) values ('$name', '$email', '$username', '$password', '$confirm_password', '$phone_no', '$address', now())";
		/*if($con -> query($insert_query)) {
			$last_inserted_id = $con -> insert_id;
		}
		if(empty($last_inserted_id)) {
			echo json_encode("Try again... You are not Registered");
		} else {
			echo json_encode("Employee registered successfully");
		}*/
		if(mysqli_query($con, $insert_query)) {
			echo json_encode("Student registered successfully");
		} else {
			echo json_encode("Student not registered. Please try again...");
		}
	}
?>