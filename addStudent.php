<?php 
	//database connection file
	include 'db_connect.php';
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$phone_no = $_POST['phone_no'];
	$address = $_POST['address'];

	//fetch the data of the matched email id
	$query = "select * from student_registration where email = '$email' ";
	$result = mysqli_query($con, $query);
	//check the rows of result
	if(mysqli_num_rows($result) > 0) { 
		echo json_encode("Student already exists");
	} else {
		//insert the data into the database table name student_registration
		$insert_query = "INSERT INTO `student_registration` (`name`, `email`, `username`, `password`, `confirm_password`, `phone_no`, `address`, `created`) values ('$name', '$email', '$username', '$password', '$confirm_password', '$phone_no', '$address', now())";
		if(mysqli_query($con, $insert_query)) {
			echo json_encode("Student registered successfully");
		} else {
			echo json_encode("Student not registered. Please try again...");
		}
	}
?>