<?php 
	//database connection file
	include 'db_connect.php';
	$role = $_POST['role'];
	$role_query = "select * from roles where name  = '$role'";
	$role_result = mysqli_query($con, $role_query);
	$role_row = $role_result -> fetch_assoc();
	$role_id = $role_row['id']; 

	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$phone_no = $_POST['phone_no'];
	$address = $_POST['address'];

	$filename = $_FILES['image']['name'];
	
	//destination of the file on the server
	$destination = 'uploads/' . $filename;
	
	//get file extension
	$extension = pathinfo($filename, PATHINFO_EXTENSION);
	
	//physical file on a temporary folder directory on the server
	$file = $_FILES['image']['tmp_name'];
	$size = $_FILES['image']['size'];
	
	$query = "select * from users where email = '$email' and username = '$username'";
	$result = mysqli_query($con, $query);
	if($result->num_rows > 0) {
		echo "Already Registered";
		/*header("Location : addStudent.html");*/

	} else {
		if(!empty($filename)) {
			//specific extensions allowed
			if(!in_array($extension, ['jpeg', 'jpg', 'png', 'JPG', 'JPEG', 'PNG'])) {
				echo "File extension must be .jpeg, .jpg or .png"; 
				/*header("Location : addStudent.html");*/ ?>
			<?php } else {
				//move the uploaded file to the destination folder i.e. upload
				if(move_uploaded_file($file, $destination)) {
					
					//insert query to insert into the database into the student_registration table
					$insert_query = "INSERT INTO `users` (`role_id`, `name`, `email`, `username`, `password`, `confirm_password`, `phone_no`, `address`, `image`, `created`) values ('$role_id', '$name', '$email', '$username', '$password', '$confirm_password', '$phone_no', '$address', '$filename', now())";
					if(mysqli_query($con, $insert_query)) {
						echo("1"); 
						/*header("Location : login.html");*/ ?>
						
					<?php } else {
						echo("Student not registered. Please try again..."); 
						/*header("Location : addStudent.html");*/ ?>
						
					<?php }
				
				} else {
					echo "Failed to upload file.";
					/*header("Location : addStudent.html");*/
					 ?>
				<?php }
			}
		} else {
			//insert query to insert into the database into the users table
			$insert_query1 = "INSERT INTO `users` (`role_id`, `name`, `email`, `username`, `password`, `confirm_password`, `phone_no`, `address`, `created`) values ('$role_id', '$name', '$email', '$username', '$password', '$confirm_password', '$phone_no', '$address', now())";
			if(mysqli_query($con, $insert_query1)) {
			echo("1");
			/*header("Location : login.html");*/ ?>
			
			<?php } else {
				echo("Student not registered. Please try again...");
				/*header("Location : addStudent.html");*/ ?>
			<?php }
		}
	}
		
?>
