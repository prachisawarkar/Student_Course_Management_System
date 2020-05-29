<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}

include "db_connect.php";
$query = "select * from add_course";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Courses</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
</head>
<body>
	<button class="btn btn-lg btn-primary fixed-top mb-5">ADD COURSES</button>

	<form action="created_course.php" method="post" id="created_courses" class="mt-5">
		<table style="border : 1px solid black">
			<thead>
				<th>Sr.No.</th>
				<th>Name</th>
				<th>Summary</th>
				<th>Start date</th>
				<th>End date</th>
				<th>Status</th>
				<th>Action</th>
				<th>Notes</th>
			</thead>
			<tbody>
				<?php
				if(mysqli_num_rows($result) > 0) {
					while($row = $result -> fetch_assoc()) { ?>
						<tr>
							<td>
								<input type="text" name="id" value="<?php echo $row['id'] ?>">
							</td>
							<td>
								<input type="text" name="name" value="<?php echo $row['name'] ?>">
							</td>
							<td>
								<input type="text" name="summary" value="<?php echo $row['summary'] ?>">
							</td>
							<td>
								<input type="date" name="start_date" value="<?php echo $row['start_date'] ?>">
							</td>
							<td>
								<input type="date" name="end_date" value="<?php echo $row['end_date'] ?>">
							</td>
							<td>
								<input type="text" name="status" value="<?php echo $row['status'] ?>">
							</td>
							<td>
								<button>
									<img src="bag.png" alt="bag" width="25px" height="25px">
								</button>	
								<input type="button" name="delete_id" class="btn btn-sm btn-primary" value="DELETE">
							</td>

						</tr>
					<?php }
				}
				?>
			</tbody>
		</table>
	</form>
</body>
</html>