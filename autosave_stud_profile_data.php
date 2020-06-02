<?php 
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location : login.html');
}
//database connection file
include 'db_connect.php';
/* to save the changed phone number */
if(isset($_POST['updated_phone_no'])) {
	$id = $_POST['current_id']; //fetch the current id
	$phone_no = $_POST['updated_phone_no']; //fetch the updated phone number
	
	// update query to update data in database
	$update_query = "update student_registration set phone_no = '$phone_no' where id = '$id'"; 
	mysqli_query($con, $update_query);
	echo "Data Updated Successfully";
	/* to save the changed email id */
} else if(isset($_POST['updated_email_id'])) {
	$id = $_POST['current_id']; //fetch the current id
	$email = $_POST['updated_email_id']; //fetch the updated email id
	
	// update query to update data in database
	$update_query = "update student_registration set email = '$email' where id = '$id'"; 
	mysqli_query($con, $update_query);
	echo "Data Updated Successfully";
} else {
	echo "Data not updated. Please Try again...";
}

?>