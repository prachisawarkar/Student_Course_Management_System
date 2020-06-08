<?php
session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
//database connection file
include 'db_connect.php';
$id = $_SESSION['id'];
echo $id;

$profile = $_FILES['profile']['name'];
echo $profile;
//destination of the file on the server
$destination = 'uploads/'.$profile;
//get file extension
$extension = pathinfo($profile, PATHINFO_EXTENSION);
//physical file on temporary folder directory on the server
$file = $_FILES['profile']['tmp_name'];
$size = $_FILES['profile']['size'];

if($size > 500000) {
	echo "Sorry, Your file is too large.";
}

if(!empty($profile)) {
	//move the uploaded file to the destination folder
	if(move_uploaded_file($file, $destination)) {
		$update_query = "update users set image = '$profile' where id = '$id'";
		if(mysqli_query($con, $update_query)) {
			echo "1";
		} else {
			echo "Profile image not updated";
		}
	}
	else {
		echo "upload failed";
	}	
} else {
	echo "Please select profile image.";
}

/*$name = $_POST['name'];
if(!empty($name)) {
	$update_qu = "update users set name = '$name' where id = '$id'";
	if(mysqli_query($con, $update_qu)) {
		echo "Data updated succefully";
	} else {
		echo "data not updated";
	}
}*/

?>