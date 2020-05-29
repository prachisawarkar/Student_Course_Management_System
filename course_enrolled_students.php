<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header("LOcation : login.html");
}

$query = "select * from my_courses"

?>