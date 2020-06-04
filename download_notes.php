<?php
//database connection file
include 'db_connect.php';
//get the course name
$course_name = $_GET['course_name'];
//fetch the data of the given course name
$query = "select * from courses where name = '$course_name'";
$result = mysqli_query($con, $query); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Download Notes</title>
</head>
<style>
	td {
		border: 1px solid black;
	}
</style>
<body>
	<table>
		<thead>
			<tr>
				<th>Notes</th>
				<th>Download</th>
			</tr>
		</thead>
		<tbody>
		<?php
		//checking the number of rows
		if($result->num_rows > 0) { 
			while($row = mysqli_fetch_array($result)) { ?>
				<tr>
					<td>
						<p class="text-white"><?php echo $row['notes'] ?></p>
					</td>
					<td>
						<a href="file_download.php?file_id=<?php echo $row['id'] ?>">Download</a> 
					</td>
				</tr>
			<?php }
		} else { ?>
			<h3>No notes are available for this course.</h3>
		<?php } ?>
	</tbody>
</body>
</html>

