<?php

session_start();

include 'db_connect.php';
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}

if(isset($_POST['name']) && isset($_POST['username']) /*|| isset($_POST['address'])*/) {
	$id = $_SESSION['id'];
	$name = $_POST['name'];
	$username = $_POST['username'];
	$address = $_POST['address'];

	$update_query = "update student_registration set name = '$name', username = '$username', address = '$address' where id  = '$id'";
	mysqli_query($con, $update_query);
	echo "$name data updated successfully";
}
else {
	 echo "data not updated";
}

?>