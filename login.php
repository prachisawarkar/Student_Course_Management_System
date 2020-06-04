<?php 
session_start();
include 'db_connect.php';
$username = $_POST['username']; //fetch username
$password = $_POST['password']; //fetch password

//select the data from where the username and password matches 
$query = "select * from student_registration where username = '$username' and password = '$password' ";

$result = mysqli_query($con, $query);
$userdata = $result -> fetch_assoc();
//check whether userdata contains anything or empty
if(is_array($userdata) && !empty($userdata)) {
	$validuser = $userdata['username']; //username
	$_SESSION['valid'] = $validuser; //session username
	$_SESSION['name'] = $userdata['name']; //session name
	$_SESSION['id'] = $userdata['id']; //session id

	$encrypted_password = md5($password);
	if($userdata['username'] === $username and $userdata['encrypted_password'] === $encrypted_password) {
		echo ($validuser . " logged in successfully");
	}
} else {
	echo ('Invalid Username or Password. Please do Sign Up!');
}


?>