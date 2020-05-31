<?php

/*session_start();
if(!isset($_SESSION['valid'])) {
	header("LOcation : login.html");
}*/

include "db_connect.php";
/*$course_id = $_POST['course_id'];*/
$course_id = $_GET['id'];

/*$query = "select * from student_my_courses where course_id = '$course_id'";*/
$query = "select sc.id as id, sr.name as name, sr.email as email, sr.username as username, sr.phone_no as phone_no, sc.status as status from student_registration sr join student_my_courses sc on sr.id = sc.student_id where course_id = '$course_id'";
$result = mysqli_query($con, $query); 

?>
<div class="container" id="course_enrolled">
	<?php
	if(mysqli_num_rows($result) > 0) { ?>
		<h2 class="text-primary">Enrolled Students : </h2>
		<form method="post" action="course_enrolled_students.php" id="course_enrolled_students">
			<table>
				<thead>
					<tr>
						<td class="border border-primary">
							Id
						</td>
						<td class="border border-primary">
							Name 
						</td>
						<td class="border border-primary">
							Email
						</td>
						<td class="border border-primary">
							Username
						</td>
						<td class="border border-primary">
							Phone Number
						</td>
						<td class="border border-primary">
							Status
						</td>
					</tr>
				</thead>
				<tbody>
			<?php while($row = $result -> fetch_assoc()) { ?>
					<tr>
						<td class="border border-primary">
							<?php echo $row['id']; ?>
						</td>
						<td class="border border-primary">
							<?php echo $row['name']; ?>
						</td>
						<td class="border border-primary">
							<?php echo $row['email']; ?>
						</td>
						<td class="border border-primary">
							<?php echo $row['username']; ?>
						</td>
						<td class="border border-primary">
							<?php echo $row['phone_no']; ?>
						</td>

						<?php $status = $row['status']; ?> 

						<td class="border border-primary">
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
	<!-- Bootstrap CSS
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    // Optional JavaScript
    // jQuery first, then Popper.js, then Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
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
					alert(status_id + data);
					window.location.reload();
				}
			});
		}		
	</script>
</body>
</html>