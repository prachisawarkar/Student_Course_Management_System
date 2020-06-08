<?php 
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location : login.html');
}
//database connection file
include 'db_connect.php';
/* to save the updated name */
if(isset($_POST['updated_name'])) {
	$id = $_POST['current_id']; //fetch the current id
	$name = $_POST['updated_name']; //fetch the updated name
	
	// update query to update data in database
	$update_query = "update users set name = '$name' where id = '$id'"; 
	mysqli_query($con, $update_query);
	echo "Data Updated Successfully";
	/* to save the updated username */
} else if(isset($_POST['updated_username'])) {
	$id = $_POST['current_id']; //fetch the current id
	$username = $_POST['updated_username']; //fetch the updated username
	
	// update query to update data in database
	$update_query = "update users set username = '$username' where id = '$id'"; 
	mysqli_query($con, $update_query);
	echo "Data Updated Successfully";
	/* to save the updated address */
} else if(isset($_POST['updated_address'])){
	$id = $_POST['current_id']; //fetch the current id
	$address = $_POST['updated_address']; //fetch the updated address

	// update query to update data in database
	$update_query = "update users set address = '$address' where id = '$id'";
	mysqli_query($con, $update_query);
	echo "Data Updated Successfully";
} else {
	echo "Data not updated. Please Try again...";
}

?>