<?php

session_start();
// after login only you can enter inside if not then it will redirect to login
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
//database connection file
include 'db_connect.php';
$course_name = $_GET['course_name']; // get the course name 
//query will fetch the data of the course name given
$query = "select * from courses where name = '$course_name'";
$result = mysqli_query($con, $query); 
?>


<!DOCTYPE html>
<html>
<head>
	<title>Notes</title>
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<style>
        .top_section {
            background-color: #293946 ;
            z-index: 1;
            background-repeat: no-repeat;
            margin-top :  100px;
            margin-bottom: 100px;
        }
        body {
            background: linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.7)), url("bgimage.jpg");
            background-size: cover;
            z-index: 1;
            background-repeat: no-repeat;
            margin-top :  100px;
            margin-bottom: 100px; 
        }
        th, td{
        	border: 1px solid black;
        }
    </style>
</head>
<body>
	<div class="container top_section">
		<!-- navigation bar -->
		<nav class="navbar navbar-expand-lg navbar-light text-center" id="navbar">
	        <a class="navbar-brand mr-4 text-" href="#"> <h1 class="text-primary">
	        	<?php echo $_SESSION['name'] ?></h1> </a>
	        <button class="navbar-toggler alert-light" type="button" data-toggle = 'collapse' data-target = '#navbarTogglerDemo1' aria-controls = 'navbarTogglerDemo1'aria-expanded = 'false' aria-label = 'Toggle navigation'>
	            <span class="navbar-toggler-icon"></span>
	        </button>

	        <div class="collapse navbar-collapse mb-4" id="navbarTogglerDemo1">
	            <ul class="navbar-nav ml-auto mt-2 mt-lg-0 ">
	                <li class="navbar-item active mr-4 mb-1">
	                    <a class="navbar-link" href="teacher_profile.php">
	                        <button type="button" class='btn-outline-primary rounded'>Profile</button>
	                    </a>
	                </li>
	                <li class="navbar-item mr-4 mb-1">
	                    <a class="navbar-link" href="student_info.php">
	                        <button type="button" class='btn-outline-primary rounded'>Students</button>
	                    </a>
	                </li>
	                <li class="navbar-item mr-4 mb-1">
	                    <a class="navbar-link" href="created_courses.php">
	                        <button type="button" class='btn-outline-primary rounded'>Courses</button>
	                    </a>
	                </li>
	                <li class="navbar-item mr-4 mb-1">
	                    <a class="navbar-link" href="logout.php">
	                        <button type="button" class='btn-outline-primary rounded'>Logout</button>    
	                    </a>
	                </li>
	            </ul>
	            
	        </div>
	    </nav>
	</div>
	<div class="container">
		<!-- button to add notes -->
		<a href="#addNotes">
			<button type="button" class="mb-5 btn btn-primary add_notes_btn"> ADD NOTES </button>
		</a>

		<!-- form to display the data on the screen -->
		<form method="post" id="view">
			<table id="notes" class="text-center">
				<thead>
					<tr>
						<th class="border-0">
							<input type="text" class="h2 border-0 bg-transparent" name="course_nm" value="<?php echo $course_name ?>">
						</th>
					</tr>
					<tr><!-- table headings -->
						<th>File Name</th>
						<th>Download</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
					// check the number of rows of sql query result 
					if($result->num_rows > 0) { 
						// fetch the rows
						while($row = mysqli_fetch_array($result)) { ?>
							<tr>
								<td> <!-- file name -->
									<input type="text" name="notes" class="border-0 bg-transparent form-control text-dark" value="<?php echo $row['notes'] ?>">
								</td>
								<td> <!-- download link -->
									<a href="file_download.php?file_id=<?php echo $row['id'] ?>">Download</a>
								</td>
								<td> <!-- button to delete the files -->
									<input type="button" name="delete" value="DELETE" class="btn btn-outline-danger" id="<?php echo $row['notes'] ?>" onclick="return delete_note(this.id)">
								</td>
							</tr>
						<?php }
					} else { ?>
						<h3>No notes are available for this course.</h3>
					<?php } ?>	
				</tbody>
			</table>
		</form>

		<!-- form to add/upload the notes -->
		<form method="post" class="rounded add_notes_form mt-5" enctype="multipart/form-data" id="addNotes" style="border: 1px solid black;">
			<div class="form-group">
				<label for="notes" class="ml-3">Upload Notes</label>
				<p  class="text-danger mt-0 ml-3">Note: File extension must be .pdf, .docx, .jpeg, .jpg or .png</p>
				<input type="text" class="text-white h4" name="course_name" style="background-color: black; display: none;" value="<?php echo $course_name ?>"> <!-- give the course name in add_notes.php file -->
				<input type="file" required name="notes[]" id="notes" class="form-control" multiple>
			</div>
			<br>
			<!-- <input type="button" onclick="return add_note(this.id)" name="add" value="ADD" id="<?php echo $course_name ?>" class="btn btn-primary"> -->
			<!-- button to submit the files -->
			<input type="submit" name="submit" value="ADD" id="submit" class="btn btn-primary ml-3">
		</form>
	</div>

	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script type="text/javascript">
		// delete student record
		function delete_note(id) {
			$id = id;
			var delete_id = id; //parameter id is stored in variable delete_id
			//ask for confirmation before delete
			if(confirm("Are you sure want to delete?")) {
				//AJAX request
				$.ajax({
					type : "POST",
					url : "notes_delete.php",
					data : {delete_id : delete_id},
					success : function(data) {
						if(data == 1) {
							alert("File not deleted");
						} else {
							//to display the updated list without refreshing the page
							$("#navbar").hide();
							$(".add_notes_btn").hide();
							$(".add_notes_form").hide();
							$('#notes').load('#notes');
						}
					}
				});
			}
		}

		$('#addNotes').submit(function(e) {
				e.preventDefault();
				var file = $('#notes').val();
				var formdata = new FormData(this);
				console.log(formdata);
				$('#submit').attr('disabled', 'disabled');
				$.ajax({
					url : 'add_notes.php',
					type : "POST",
					data : formdata,
					contentType : false,
					processData : false,
					cache : false,
					beforeSend : function() {
						$("#err").fadeOut();
					},
					success : function(data) {
						if(data == 1) {
							/*$('#addNotes').load('#view');*/
							/*document.location.href = 'add_delete_files.php';*/

						} else {
							$("#msg").html("<div class='alert alert-danger'>" + data + "</div>");
						}
					},
					error : function(e) {
						$("#err").html(e).fadeIn();
					}
				});
			});
	</script>
</body>
</html>