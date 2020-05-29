<?php 
session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
include 'db_connect.php';

$query = 'select * from student_registration';
$result = mysqli_query($con, $query);
/*$row = $result -> fetch_assoc();*/



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Student Information</title>
	<link rel="stylesheet" href="">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> -->
 
</head>
<body>
	<table>
		<tr class="border-bottom">
			<th>Sr.No</th>
			<th class="border-right">Name</th>
			<th>Email</th>
			<th>Username</th>
			<th>Phone No.</th>
			<th>Address</th>
			<th>Status</th>
			<th>Delete</th>
		</tr>

		<?php 
		while($row = mysqli_fetch_array($result)) { ?>
			<tr class="border-bottom">
				<form method="post"> 
					<td>
						<input type="text" name="id" id="id" value="<?php echo $row['id'] ?>">
					</td>
					<td class="border-right mr-5 border-primary">
						<?php echo $row['name']?>
					</td>
					<td class="border-right mr-5 border-primary">
						<input type="email" class="border-0 text-center" name="email" id="email" value="
						<?php echo $row['email']?>" >
					</td>
					<td class="border-right mr-5 border-primary">
						<?php echo $row['username']?>
					</td>
					<td class="border-right mr-5 border-primary">
						<input type="text" class="border-0 text-center" name="phone_no" id="phone_no" value="
						<?php echo $row['phone_no']?> " >
					</td>
					<td class="border-right mr-5 border-primary"><?php echo $row['address']?>
					</td>
					
					<!-- <a href="student_info3.php">
						<td class="border-right mr-5 border-primary" id="status"><?php echo $row['status']?>
						</td>
					</a> --> 
					<!-- <td>
					<?php
					echo "<a href='student_info3.php?id=$row[id]'>" . $row['status'] . "</a>";

					?>
					</td> -->

					<td>
						<button type="button" onclick="statusToggle(this)" class="<?php echo 'mybtn' ?>" id="<?php echo $row['id'] ?>"><?php echo $row['status'] ?></button>
					</td>

					<?php

					function statusToggle() {
						if($status == 1) {//green
							/*header("Location : student_info3.php");*/
							echo "<img src = 'status_red.png' alt = '0'>";
							mysqli_query($con, "update student_registration set status = '0' where id = '$sid'");
							echo ("inactive");

						} else if($status == 0) {
								echo "<img src = 'status_green.png' alt = '1'>";
								mysqli_query($con, "update student_registration set status = '1' where id = '$sid'");
								echo ("active");
						}
					}
					?>

					<!-- <?php
					$status = $row['status']; 
					print_r($status);
					?>
					<td>
						<input type="image" id="status" src="status_<?php if($status == '1') {echo 'green';} else {echo 'red';}?>.png" name = "status" value="<?php echo $status;?>" />
					</td> --> 

					<!-- <td>
						<input type="checkbox"  name="status" id="status" checked>
		    		</td>		
		    		<input type="hidden" name="hidden_status" id="hidden_status" checked data-toggle="toggle" value="1"/>	 -->	
					<?php
					echo "<td>
						<a href = 'student_info.php?id=$row[id]' onClick = \"return confirm('Are you sure you want to delete?')\" class = 'btn btn-danger' id = 'deletebtn' >Delete</a>	
					</td>"; ?>
				</form>
			<?php echo "</tr>";
		}		
		?>
		</table>

	
</body>
</html>