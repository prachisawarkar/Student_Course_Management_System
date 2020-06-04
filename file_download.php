<?php
//database connection file
include "db_connect.php";
//check whether it has got the file id or not if yes then execute
if(isset($_GET['file_id'])) {
	$id = $_GET['file_id']; //store the file id

	//fetch the file from database
	$query = "select * from courses where id = '$id'";
	$result = mysqli_query($con, $query);
	
	//check the number of rows of query result
	if($result->num_rows > 0) {
		while($file = $result->fetch_assoc()) {
			$url = 'uploads/'.$file['notes']; //url of the file
			$filename = $file['notes'];  //filename
			$filepath = 'uploads/' . $file['notes']; //file path
			/*$fileroute = $filepath.'jpg';*/
			$extension = pathinfo($filename, PATHINFO_EXTENSION); //extension of the file
			echo $extension;
	?>

	<?php }
	} else { ?>
		<p>No documents found...</p>
	<?php } ?>
	<?php
	if(file_exists($filepath)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream'); //octet-stream
		header('Content-Disposition: attachment; filename=' . basename($filepath));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		ob_clean();
	    flush();
	    readfile($filepath); //showing the path to the server where the file is to be download
	} else {
		echo "File does not exists";
	}
}

?>
