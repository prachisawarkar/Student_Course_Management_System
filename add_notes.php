<?php 
//database connection file
include 'db_connect.php';
// all will get execute after clicking on the button named add
if(isset($_POST['add'])) { 

	$course_name = $_POST['course_name'];
	echo $course_name;
	// select all the data of the given course name row/rows
	$query = "select * from add_course where name = '$course_name'";
	$result = mysqli_query($con, $query);
	$row = $result -> fetch_assoc(); //fecth the result
	//fetch data from the table
	$summary = $row['summary']; 
	$start_date = $row['start_date'];
	$end_date = $row['end_date']; 

	//name of the uploaded file => $_FILES['notes']['name'];
	$totalfiles = count($_FILES['notes']['name']);
	//for loop for uploading multiple files
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
			<a href="add_delete_files.php?course_name=<?php echo $course_name ?>" style="color : red;">ADD NOTES</a>
		<?php } else {
			//move the uploaded file to the destination folder i.e. upload
			if(move_uploaded_file($file, $destination)) {		
				//insert query to insert into the database into the add_course table
				$insert_query = "INSERT INTO `add_course` (`name`, `summary`, `start_date`, `end_date`, `notes`, `status`) values ('$course_name', '$summary', '$start_date', '$end_date', '$filename', 0)";
				if(mysqli_query($con, $insert_query)) {
					echo("Notes added successfully"); ?>
					<a href="add_delete_files.php?course_name=<?php echo $course_name ?>" style="color : red;">ADD NOTES</a>
				<?php } else {
					echo("Notes are not added. Try again..."); ?>
					<a href="add_delete_files.php?course_name=<?php echo $course_name ?>" style="color : red;">ADD NOTES</a>
				<?php }
			
			} else {
				echo "Failed to upload file."; ?>
				<a href="add_delete_files.php?course_name=<?php echo $course_name ?>" style="color : red;">ADD NOTES</a>
			<?php }
		}
	}	
}

/*
$course_name = $_POST['course_name'];
echo $course_name;
$query = "select * from add_course where name = '$course_name'";
$result = mysqli_query($con, $query);
$row = $result -> fetch_assoc();
$summary = $row['summary'];
$start_date = $row['start_date'];
$end_date = $row['end_date']; 

//name of the uploaded file => $_FILES['notes']['name'];
echo $_FILES['notes']['name'];
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

	if(!in_array($extension, ['docx', 'pdf', 'jpeg', 'jpg', 'png', 'xlsx'])) {
		echo "File extension must be .pdf, .docx, .jpeg, .jpg or .png";
	} else {
		if(move_uploaded_file($file, $destination)) {		
			$insert_query = "INSERT INTO `add_course` (`name`, `summary`, `start_date`, `end_date`, `notes`, `status`) values ('$course_name', '$summary', '$start_date', '$end_date', '$filename', 0)";
			if(mysqli_query($con, $insert_query)) {
				echo("Notes added successfully");
			} else {
				echo("Notes are not added. Try again...");
			}
		
		} else {
			echo "Failed to upload file.";
		}
	}
}*/

?>