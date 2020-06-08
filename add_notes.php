<?php 
//database connection file
include 'db_connect.php';

$course_name = $_POST['course_name'];
echo $course_name;
// select all the data of the given course name row/rows
$query = "select * from courses where name = '$course_name'";
$result = mysqli_query($con, $query);
$row = $result -> fetch_assoc(); //fecth the result

//fetch data from the table
$course_id = $row['id'];

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

	<?php } else {
		//move the uploaded file to the destination folder i.e. upload
		if(move_uploaded_file($file, $destination)) {		
			//insert query to insert into the database into the courses table
			$insert_query = "INSERT INTO `course_attachments` (`course_id`, `notes`) values ('$course_id', '$filename')";
			if(mysqli_query($con, $insert_query)) {
				/*header("Location : add_delete_files.php");*/
				echo "Notes added successfully";
				?>
				
			<?php } else {
				echo("Notes are not added. Try again..."); ?>
				
			<?php }
		
		} else {
			echo "Failed to upload file."; ?>
			
		<?php }
	}
}	


?>