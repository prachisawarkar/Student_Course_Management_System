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
	$update_query = "update courses set name = '$name' where id = '$id'"; 
	mysqli_query($con, $update_query);
	echo "Data Updated Successfully";
	
	/* to save the updated summary */
} else if(isset($_POST['updated_summary'])) {
	$id = $_POST['current_id']; //fetch the current id
	$summary = $_POST['updated_summary']; //fetch the updated summary
	
	// update query to update data in database
	$update_query = "update courses set summary = '$summary' where id = '$id'"; 
	mysqli_query($con, $update_query);
	echo "Data Updated Successfully";

	/* to save the updated start date */
} else if(isset($_POST['updated_start_date'])) {
	$id = $_POST['current_id']; //fetch the current id
	$start_date = $_POST['updated_start_date']; //fetch the updated start date
	
	// update query to update data in database
	$update_query = "update courses set start_date = '$start_date' where id = '$id'"; 
	mysqli_query($con, $update_query);
	echo "Data Updated Successfully";

	/* to save the updated end date*/
} else if(isset($_POST['updated_end_date'])) {
	$id = $_POST['current_id']; //fetch the current id
	$end_date = $_POST['updated_end_date']; //fetch the updated end date
	
	// update query to update data in database
	$update_query = "update users set end_date = '$end_date' where id = '$id'"; 
	mysqli_query($con, $update_query);
	echo "Data Updated Successfully";
} else {
	echo "Data not updated. Please Try again...";
}

?>