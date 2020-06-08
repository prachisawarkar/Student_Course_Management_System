<?php 
session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
//database connection file
include 'db_connect.php';
$id = $_POST['status_id']; //get the status id
//select data
$query = "select * from my_courses where id = '$id' ";

$result = mysqli_query($con, $query);
$row = $result -> fetch_assoc();
$status = $row['status']; //status of the course for the student

if($status == 1) {//green
	//update the course status in table my_courses
	mysqli_query($con, "update my_courses set status = '0' where id = '$id'");
	echo ("Status Updated to inactive");

} else if($status == 0) { //red
	//update the course status in table my_courses
	mysqli_query($con, "update my_courses set status = '1' where id = '$id'");
	echo ("Status Updated to active");
} else {
	echo "status not updated";
}

//select data
$sel_query = "select * from my_courses where id = '$id' ";
$result1 = mysqli_query($con, $sel_query);
$row1 = $result1 -> fetch_assoc(); ?>

<!-- <form method="post" id="course">
	<table class="students_enrolled">
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
			<tr> //student information 
				<td>
					<?php echo $row1['id']; ?>
				</td>
				<td>
					<?php echo $row1['name']; ?>
				</td>
				<td>
					<?php echo $row1['email']; ?>
				</td>
				<td>
					<?php echo $row1['username']; ?>
				</td>
				<td>
					<?php echo $row1['phone_no']; ?>
				</td>

				<?php $status = $row1['status']; ?> 

				<td> // status of the course for the student 
					<button type="button" onclick = "return statusChange(this.id)" id="<?php echo $row1['id'] ?>" class = 'status_button'>
						<?php 
						if($status == 1) { ?>
							<img src="status_green.png" alt="" width="15px" height="15px">
						<?php } else { ?>
							<img src="status_red.png" alt="" width="18px" height="18px">
						<?php } ?>
					</button>
				</td>
			</tr>
	<?php } ?>
		</tbody>
	</table>
</form> -->


