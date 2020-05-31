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
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light text-center">
        <a class="navbar-brand mr-4 text-" href="#"> <h1 class="text-primary"><?php echo $_SESSION['name'] ?></h1> </a>
        <button class="navbar-toggler" type="button" data-toggle = 'collapse' data-target = '#navbarTogglerDemo1' aria-controls = 'navbarTogglerDemo1'aria-expanded = 'false' aria-label = 'Toggle navigation'>
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
	<form action="student_info.php" method="post" accept-charset="utf-8" id="student_info">
		<table style="border:1px solid:red">
			<thead>
				<th>Id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone No.</th>
				<th>Address</th>
				<th>Status</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php 
				$count = 0;
				if($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) { ?>
						<tr class="">
							<td>
								<input type="text" name="id" value="<?php echo $row['id']; ?>" >
							</td>
							<td>
								<input type="text" name="name" value="<?php echo $row['name']; ?>" >
							</td>
							<td>
								<input type="text" name="email" class="email" id="<?php echo $row['id'] ?>" value="<?php echo $row['email'] ?>" onchange="return autosave_email(this.id, this.value)" >
							</td>
							<td>
								<input type="text" name="phone_no" class="phone_no" id="<?php echo $row['id'] ?>" value="<?php echo $row['phone_no'] ?>" onchange="return autosave_phoneno(this.id, this.value)" >	
								
								
							</td>
							<td>
								<input type="text" name="address" value="<?php echo $row['address'] ?>" >
							</td>
				
							<?php $status = $row['status']; ?> 

							<td>
								<button type="button" onclick = "return statusChange(this.id)" id="<?php echo $row['id'] ?>">
									<?php 
									if($status == 1) { ?>
										<img src="status_green.png" alt="" width="25px" height="25px">
									<?php } else { ?>
										<img src="status_red.png" alt="" width="25px" height="25px">
									<?php } ?>
								</button>
							</td>

							<td>
								<input type="button" name="delete_id" id="<?php echo $row['id'] ?>" value = "DELETE" onclick = "return on_click(this.id)">
							</td>
						</tr>
						<?php
					}
				} else {
					echo "No students have registered yet!";
				}
				?>
			</tbody>
		</table>
	</form>

	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script type="text/javascript">
		function autosave_phoneno(id,phone_no) {
			var current_id = id;
			var updated_phone_no = phone_no;
			console.log(id);
			console.log(phone_no);
			if('.phone_no' != '') {
				$.ajax({
					url : "autosave_stud_profile_data.php",
					method : "POST",
					data : {
						current_id : current_id,
						updated_phone_no : updated_phone_no
					},
					success : function(data) {
						alert(data);
					},
					error : function(xhr, status, message) {
						alert(xhr + " " + status + " " + message);
					}
				});
			}
		}

		function autosave_email(id, email) {
			var current_id = id;
			var updated_email_id = email;
			console.log(id);
			console.log(email);
			if('.email' != '') {
				$.ajax({
					url : "autosave_stud_profile_data.php",
					method : "POST",
					data : {
						current_id : current_id,
						updated_email_id : updated_email_id
					},
					success : function(data) {
						alert(data);
					},
					error : function(xhr, status, message) {
						alert("Error Message : " + error);
					}
				});
			}
		}

		// delete student record
		function on_click(id) {
			$id = id;
			var delete_id = id;
			$.ajax({
				type : "POST",
				url : "student_delete.php",
				data : {delete_id : delete_id},
				success : function(data) {
					if(data == 1) {
						alert("Student record not deleted");
					} else {
						confirm("Are you sure you want to delete ?");
						//remove from the table
						$('#student_info').load('student_info.php');
					}
				}
			});
		}

		// update status - active or inactive
		function statusChange(id) {
			$id = id;
			var status_id = id; 
			console.log($id);
			$.ajax({
				url : "toggleStatus.php",
				type : "POST",
				data : {
					status_id : status_id
				},
				success : function(data) {
					alert(data);
					$('#student_info').load('student_info.php');
				}
			});
		}		
	</script>
</body>
</html>