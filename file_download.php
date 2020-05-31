<?php

include "db_connect.php";
if(isset($_GET['file_id'])) {
	$id = $_GET['file_id'];

	//fetch the file from database
	$query = "select * from add_course where id = '$id'";
	$result = mysqli_query($con, $query);
	$file = mysqli_fetch_assoc($result);
	$filename = $file['name']; 
	$filepath = 'uploads/' . $file['name']; 
	/*$fileroute = $filepath.'jpg';*/
	$extension = pathinfo($filename, PATHINFO_EXTENSION);
	echo $filepath . "<br>"; 
	echo $extension . "<br>";
	echo $filename . "<br>"; 
	?>

	<!-- <img src = "<?php $fileroute ?>" alt="image" > -->

	<div class="content flex ">
    	<a href="" download>
  			<button type="button" class="btn btn-dark rounded">DOWNLOAD RESUME</button>
		</a>
    </div>

	<?php
	if(file_exists($filepath)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . basename($filepath));
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize('uploads/' . $file['name']));
		readfile('uploads/' . $file['name']);
	}
}

?>