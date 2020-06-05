<?php 
//database connection file
include 'db_connect.php';
	$name = $_POST['name'];
	$summary = $_POST['summary'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];

	$query = "select * from courses where name = '$name'";
	$result = mysqli_query($con, $query);
	if($result->num_rows > 0) {
		echo "Course already enrolled!";
	} else {
		$insert_query = "INSERT INTO `courses` (`name`, `summary`, `start_date`, `end_date`, `status`) values ('$name', '$summary', '$start_date', '$end_date', 0)";
		if(mysqli_query($con, $insert_query)) {	
			echo "Course added successfully";

		} else {
			echo("Course is not added. Try again..."); 
		}	
	}
	$sel_query = "select * from courses where name = '$name'";
	$result1 = mysqli_query($con, $sel_query);
	$row1 = $result1 -> fetch_assoc();
	$course_id = $row1['id'];
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
				$insert_query1 = "INSERT INTO `course_attachments` (`course_id`, `notes`, `status`) values ('$course_id', '$filename', 1)";
				if(mysqli_query($con, $insert_query1)) {
					echo(""); 	
				} else {
					echo("Course is not added. Try again..."); 
				}
			} else {
				echo "Failed to upload file."; 
			}
		}
	}

?>