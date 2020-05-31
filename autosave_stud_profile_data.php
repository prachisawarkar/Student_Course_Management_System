<?php 
session_start();
include 'db_connect.php';
if(!isset($_SESSION['valid'])) {
	header('Location : login.html');
}
if(isset($_POST['updated_phone_no'])) {
	$id = $_POST['current_id'];
	$phone_no = $_POST['updated_phone_no'];
	
	$update_query = "update student_registration set phone_no = '$phone_no' where id = '$id'"; 
	mysqli_query($con, $update_query);
	echo "Data Updated Successfully";
} else if(isset($_POST['updated_email_id'])) {
	$id = $_POST['current_id'];
	$email = $_POST['updated_email_id'];
	
	$update_query = "update student_registration set email = '$email' where id = '$id'"; 
	mysqli_query($con, $update_query);
	echo "Data Updated Successfully";
} else {
	echo "Data not updated. Please Try again...";
}

?>