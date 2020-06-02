<?php 
session_start();
include 'db_connect.php';
$username = $_POST['tusername']; //fetch username
$password = $_POST['tpassword']; //fetch password

//select the data from where the username and password matches 
$query = "select * from teacher_info where username = '$username' and password = '$password' ";

$result = mysqli_query($con, $query);
$userdata = $result -> fetch_assoc();
//check whether userdata contains anything or empty
if(is_array($userdata) && !empty($userdata)) {
	$validuser = $userdata['username']; //username
	$_SESSION['valid'] = $validuser; //session username
	$_SESSION['name'] = $userdata['name']; //session name
	$_SESSION['id'] = $userdata['id']; //session id
	if($validuser === $username and $userdata['password'] === $password) {
		echo ($validuser . " logged in successfully");
	}
} else {
	echo json_encode('Invalid Username or Password. Please do Sign Up!');
}

?>