<?php 
//database connection file
include 'db_connect.php';
	$name = $_POST['name'];
	$summary = $_POST['summary'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];

	/*$errors = array(); //array to store the errors
	if(empty($name)) {
		array_push($errors, "Name of the course is required.");
	}
	if(empty($summary)) {
		array_push($errors, "Summary of the course is required.");
	}
	if(empty($start_date)) {
		array_push($errors, "Start date of the course is required.");
	}
	if(empty($end_date)) {
		array_push($errors, "End date of the course is required.");
	}*/
	//name of the uploaded file
	/*$filename = $_FILES['notes']['name'];
	echo $filename;*/
	
	//count of total fiels uploaded
	$totalfiles = count($_FILES['notes']['name']);
	for($i = 0; $i < $totalfiles; $i++) {
		$filename = $_FILES['notes']['name'][$i];
		//destination of the file on the server
		$destination = 'uploads/' . $filename;
		
		//get file extension
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		
		//physical file on a temporary folder directory on the server
		$file = $_FILES['notes']['tmp_name'][$i];
		$size = $_FILES['notes']['size'];

		//specific extensions allowed
		if(!in_array($extension, ['docx', 'pdf', 'jpeg', 'jpg', 'png', 'xlsx'])) {
			echo "File extension must be .pdf, .docx, .jpeg, .jpg or .png"; ?>
		<?php } else {
			//move the uploaded file to the destination folder i.e. upload
			if(move_uploaded_file($file, $destination)) {
			
				//insert query to insert into the database into the courses table
				$insert_query = "INSERT INTO `courses` (`name`, `summary`, `start_date`, `end_date`, `notes`, `status`) values ('$name', '$summary', '$start_date', '$end_date', '$filename', 0)";
				if(mysqli_query($con, $insert_query)) {
					echo("1"); 	
				} else {
					echo("Course is not added. Try again..."); 
				}
			} else {
				echo "Failed to upload file."; 
			}
		}
	}

?>