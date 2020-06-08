<?php 
session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
// database connection file
include 'db_connect.php';

//select and fetch the data of students from users table
$query = 'select * from users where role_id = 2';
$result = mysqli_query($con, $query);

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
        th, td {
        	border: 1px solid #293946;
        }
    </style>

</head>
<body>
	<div class="container top_section">
		<!-- navigation bar -->
		<nav class="navbar navbar-expand-lg navbar-light text-center" id="navbar">
	        <a class="navbar-brand mr-4 text-" href="#"> <h1 class="text-primary"><?php echo $_SESSION['name'] ?></h1> </a>
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
	                        <button type="button" class='btn-outline-primary rounded active'>Students</button>
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
    <!-- display the student data -->
		<form method="post" accept-charset="utf-8" id="student_info">
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
						while($row = $result->fetch_assoc()) { ?> <!-- fetch all the data of all the student -->
							<tr>
								<td> <!-- id of the student -->
									<input type="text" class="form-control bg-transparent text-dark overflow-auto" name="id" value="<?php echo $row['id']; ?>">
								</td>
								<td> <!-- name of the student -->
									<input type="text" class="form-control bg-transparent text-dark overflow-auto" name="name" value="<?php echo $row['name']; ?>" >
								</td>
								<td> <!-- email of the student -->
									<span class="error_message" id="email_error" style="color : red;"></span>
									<!-- function called will save the data on getting change -->
									<input type="text" name="email" class="email form-control bg-transparent text-dark" id="<?php echo $row['id'] ?>" value="<?php echo $row['email'] ?>" onchange="return autosave_email(this.id, this.value)" >
								</td>
								<p id="msg"></p>
								<td>
									<!-- phone number of the student -->
									<span class="error_message" id="phone_error" style="color : red;"></span>
									<!-- function called will save the data on getting change -->
									<input type="text" name="phone_no" class="phone_no form-control bg-transparent text-dark overflow-auto" id="<?php echo $row['id'] ?>" value="<?php echo $row['phone_no'] ?>" onchange="return autosave_phoneno(this.id, this.value)" >							
								</td>
								<td> <!-- address of the student -->
									<input type="text" class="form-control bg-transparent text-dark overflow-auto" name="address" value="<?php echo $row['address'] ?>" >
								</td>
								<!-- store the status in variable -->
								<?php $status = $row['status']; ?> 

								<td class="text-center"> <!-- status toggle on 1 - green and 0 - red -->
									<button type="button" onclick = "return statusChange(this.id)" id="<?php echo $row['id'] ?>">
										<?php 
										if($status == 1) { ?>
											<img src="status_green.png" alt="" width="15px" height="15px">
										<?php } else { ?>
											<img src="status_red.png" alt="" width="18px" height="18px">
										<?php } ?>
									</button>
								</td>

								<td> 
									<!-- <p id="msg"></p> -->
									<!-- delete button to delete the student -->
									<input type="button" class="form-control btn btn-outline-primary text-dark overflow-auto" name="delete_id" id="<?php echo $row['id'] ?>" value = "DELETE" onclick = "return on_click(this.id)">
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
		<p id="err"></p>
	</div>

	<!-- <script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
	<script type="text/javascript"> 
		//function to save the phone number
		function autosave_phoneno(id,phone_no) {
			var current_id = id;
			var updated_phone_no = phone_no;
			console.log(id);
			console.log(phone_no);

			// validate the phone number
			var phone_pattern = /^[0-9]{10,13}$/i;
			if($.trim(updated_phone_no) == "") {
				$('#phone_error').fadeIn().html('Please Enter Phone number');
				setTimeout(function() {
					$('#phone_error').fadeOut();
				}, 3000);
				$('#phone_no').focus();
				return false;
			} else if(!phone_pattern.test(updated_phone_no)) {
				$('#phone_error').fadeIn().html('Please enter valid phone number');
				setTimeout(function() {
					$('#phone_error').fadeOut();
				}, 3000);
				$('#phone_no').focus();
				return false;
			}

			if('.phone_no' != '') {
				$.ajax({
					url : "autosave_stud_profile_data.php",
					method : "POST",
					data : {
						current_id : current_id,
						updated_phone_no : updated_phone_no
					},
					success : function(data) {
						$("#msg").html("<div class='alert alert-success'>" + data + "</div>");
						$("#msg").fadeOut(1500);
					},
					error : function(xhr, status, message) {
						$("#err").html("<div class='alert alert-danger'>" + message + "</div>");
						$("#msg").fadeOut(2000);
					}
				});
			}
		}

		//function to save the email id
		function autosave_email(id, email) {
			//assign variables to parameter values
			var current_id = id;
			var updated_email_id = email;
			console.log(id);
			console.log(email);

			// validate the email id
			var email_pattern = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

			if($.trim(updated_email_id) == "") {
				$('#email_error').fadeIn().html('Please Enter Email');
				setTimeout(function() {
					$('#email_error').fadeOut();
				}, 3000);
				$('#email').focus();
				return false;
			} else if(!email_pattern.test(updated_email_id)) {
				$('#email_error').fadeIn().html('Please enter valid email');
				setTimeout(function() {
					$('#email_error').fadeOut();
				}, 3000);
				$('#email').focus();
				return false;
			}

			if('.email' != '') {
				$.ajax({
					url : "autosave_stud_profile_data.php",
					method : "POST",
					data : {
						current_id : current_id,
						updated_email_id : updated_email_id
					},
					success : function(data) {
						$("#msg").html("<div class='alert alert-success'>" + data + "</div>");
						$("#msg").fadeOut(1500);					
					},
					error : function(xhr, status, message) {
						$("#err").html("<div class='alert alert-danger'>" + message + "</div>");
						$("#err").fadeOut(2000);
					}
				});
			}
		}

		// delete student record
		function on_click(id) {
			$id = id;
			var delete_id = id;
			//confirm before deleting
			if(confirm("Are you sure want to delete?")) {
				//AJAX request
				$.ajax({
					type : "POST",
					url : "student_delete.php",
					data : {delete_id : delete_id},
					success : function(data) {
						if(data == 1) {
							$("#msg").html("<div class='alert alert-danger'>" + data + "</div>");
							/*alert(data);*/
						} else {
							//to display the updated list without refreshing the page
							$("#navbar").hide();
							$('#student_info').load('student_info.php');
						}
					}
				});
			}
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
					/*alert(data);*/
					$("#navbar").hide();
					$('#student_info').load('student_info.php');
				}
			});
		}		
	</script>
</body>
</html>