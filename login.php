<?php 
session_start();
include 'db_connect.php';
$username = $_POST['username'];
$password = $_POST['password'];

$query = "select * from student_registration where username = '$username' and password = '$password' ";

$result = mysqli_query($con, $query);
$userdata = $result -> fetch_assoc();
if(is_array($userdata) && !empty($userdata)) {
	$validuser = $userdata['username'];
	$_SESSION['valid'] = $validuser;
	$_SESSION['name'] = $userdata['name'];
	$_SESSION['id'] = $userdata['id'];
	if($userdata['username'] === $username and $userdata['password'] === $password) {
		echo ($validuser . " logged in successfully");
	}
} else {
	echo ('Invalid Username or Password. Please do Sign Up!');
}
/*if(isset($_SESSION['valid'])) {
	header("Location : view.php");
}*/
/*if($userdata['username'] === $username and $userdata['password'] === $password) {
	echo json_encode("Login Successfull");
} else if($userdata['username'] !== $username and $userdata['password'] === $password) {
	echo json_encode("Username is incorrect");
} else if($userdata['username'] === $username and $userdata['password'] !== $password) {
	echo json_encode("Password is incorrect");
} else {
	echo json_encode("Username does not exists... Please Do Sign Up!");
}*/

?>