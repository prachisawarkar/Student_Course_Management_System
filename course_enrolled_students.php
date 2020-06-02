<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header("LOcation : login.html");
}
//database connection file
include "db_connect.php";
//get the course id
$course_id = $_GET['id'];

//select data to display the enrolled students in the selected course
$query = "select sc.id as id, sr.name as name, sr.email as email, sr.username as username, sr.phone_no as phone_no, sc.status as status from student_registration sr join student_my_courses sc on sr.id = sc.student_id where course_id = '$course_id'";
$result = mysqli_query($con, $query); 

?>
<!-- enrolled students -->
<div class="container" id="course_enrolled">
	<?php
	if(mysqli_num_rows($result) > 0) { ?>
		<h2 class="text-primary" id="heading">Enrolled Students : </h2>
		<form method="post" action="course_enrolled_students.php" id="course_enrolled_students">
			<table>
				<thead>
					<tr>
						<td>
							Id
						</td>
						<td>
							Name 
						</td>
						<td>
							Email
						</td>
						<td>
							Username
						</td>
						<td>
							Phone Number
						</td>
						<td>
							Status
						</td>
					</tr>
				</thead>
				<tbody>
			<?php while($row = $result -> fetch_assoc()) { ?>
					<tr> <!-- student information -->
						<td>
							<?php echo $row['id']; ?>
						</td>
						<td>
							<?php echo $row['name']; ?>
						</td>
						<td>
							<?php echo $row['email']; ?>
						</td>
						<td>
							<?php echo $row['username']; ?>
						</td>
						<td>
							<?php echo $row['phone_no']; ?>
						</td>

						<?php $status = $row['status']; ?> 

						<td> <!-- status of the course for the student -->
							<button type="button" onclick = "return statusChange(this.id)" id="<?php echo $row['id'] ?>">
								<?php 
								if($status == 1) { ?>
									<img src="status_green.png" alt="" width="25px" height="25px">
								<?php } else { ?>
									<img src="status_red.png" alt="" width="25px" height="25px">
								<?php } ?>
							</button>
						</td>
					</tr>
			<?php } ?>
				</tbody>
			</table>
		</form>
	<?php } else {
		echo "No students have enrolled yet in this course";
	} ?>
</div> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<style>
		body {
			background-color: black;
			color: white;
		}
		tr {
			border: 1px solid white;
		}
	</style>
</head>
<body>
	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script type="text/javascript">
		// update status - active or inactive
		function statusChange(id) {
			var status_id = id; 
			console.log(id);
			$.ajax({
				url : "student_course_status.php",
				type : "POST",
				data : {
					status_id : status_id
				},
				success : function(data) {
					alert(data);
					/*window.location.reload();*/
					$("#heading").hide();
					$('#course_enrolled_students').load('#course_enrolled_students');
				}
			});
		}		
	</script>
</body>
</html>