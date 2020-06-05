<?php 
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location : login.html');
}
//database connection file
include 'db_connect.php';
/* to save the updated file name */
if(isset($_POST['updated_name'])) {
	$id = $_POST['current_id']; //fetch the current id
	$name = $_POST['updated_name']; //fetch the updated name

	//select query to get the original name
	$query = "select * from course_attachments where id = '$id'";
	$result = mysqli_query($con, $query);
	$row = $result -> fetch_assoc();
	$original_name = $row['notes']; //original name

	$original = 'uploads/' . $original_name; //original destination address
	$updated = 'uploads/' . $name; //updated destination address
	//rename the original file name with updated name
	rename($original, $updated);
	// update query to update data in database
	$update_query = "update course_attachments set notes = '$name' where id = '$id'"; 
	mysqli_query($con, $update_query);
	echo "File renamed Successfully";
} else {
	echo "File name not updated. Please Try again...";
}

?>