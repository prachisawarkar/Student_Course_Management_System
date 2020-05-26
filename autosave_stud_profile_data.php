<?php 
session_start();
include 'db_connect.php';
if(!isset($_SESSION['valid'])) {
	header('Location : login.html');
}

if(isset($_POST['email']) && isset($_POST['phone_no'])) {
	$id = $_SESSION['id'];
	$email = $_POST['email'];
	$phone_no = $_POST['phone_no'];
	
	$update_query = "update student_registration set email = '$email' , phone_no = '$phone_no' where id = '$id'"; 
	mysqli_query($con,$update_query);
	echo "data saved";
}

?>