<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header('Location : login.php');
}

include 'db_connect.php';

$query = "select * from student_registration where id = " . $_SESSION['id'] ;
$result = mysqli_query($con, $query);
$row = $result -> fetch_assoc(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Profile</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light text-center">
            <a class="navbar-brand mr-4 text-" href="#"> <h1 class="text-primary"><?php echo $_SESSION['name'] ?></h1> </a>
            <button class="navbar-toggler" type="button" data-toggle = 'collapse' data-target = '#navbarTogglerDemo1' aria-controls = 'navbarTogglerDemo1'aria-expanded = 'false' aria-label = 'Toggle navigation'>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mb-4" id="navbarTogglerDemo1">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0 ">
                    <li class="navbar-item active mr-4 mb-1">
                        <a class="navbar-link" href="profile.php">
                            <button type="button" class='btn-outline-primary rounded'>Profile</button>
                        </a>
                    </li>
                    <li class="navbar-item mr-4 mb-1">
                        <a class="navbar-link" href="resume.html#aboutme">
                            <button type="button" class='btn-outline-primary rounded'>Courses</button>
                        </a>
                    </li>
                    <li class="navbar-item mr-4 mb-1">
                        <a class="navbar-link" href="resume.html#education">
                            <button type="button" class='btn-outline-primary rounded'>My Courses</button>
                        </a>
                    </li>
                    <li class="navbar-item mr-4 mb-1">
                        <a class="navbar-link" href="thankyou.jpg">
                            <button type="button" class='btn-outline-primary rounded'>Logout</button>    
                        </a>
                    </li>
                </ul>
                
            </div>
        </nav>

        <!-- profile page -->

        <div class="mt-5">
            <form>
                <!-- <label>Id : </label>
                <input type="text" name="id" id="id" value = "<?php echo $row['id'] ?>"> -->

                <br>

                <label>Name : </label>
                <input type="text" name="name" id="name" value = "<?php echo $row['name'] ?>">

                <br>

                <label>Email Id : </label>
                <input type="email" name="email" id="email" value = "<?php echo $row['email'] ?>">

                <br>

                <label>Username : </label>
                <input type="text" name="username" id="username" value = "<?php echo $row['username'] ?>">

                <br>

                <label>Phone Number: : </label>
                <input type="text" name="phone_no" id="phone_no" value = "<?php echo $row['phone_no'] ?>">

                <br>

                <label>Address : </label>
                <input type="text" name="address" id="address" value = "<?php echo $row['address'] ?>">

                <br>

                <label>Joining Date & Time : </label>
                <input type="text" name="created"  value = "<?php echo $row['created'] ?>">

                <div class="form-group">  
                    <input type="hidden" name="id" id="id" />  
                    <div id="autoSave"></div>  
                </div>  
            </form>
        </div>

	</div>

    <script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('input').change(function() {
                function autosave() {
                    var id = $('#id').val();
                    var email = $('#email').val();
                    var phone_no = $('#phone_no').val();
                    console.log(id);
                    console.log(email);
                    console.log(phone_no);
                    $.ajax({
                        url : "autosave_stud_profile_data.php",
                        method : "POST",
                        data : {
                            email : email,
                            phone_no : phone_no
                        },
                        success : function(data) {
                            /*if(data != '') {
                                $('#id').val(data);
                            }*/
                            alert(data);
                        }
                    });
                }/*);*/
                setInterval(function() {
                autosave();
            }, 5000);
            });   
            
        });
    </script>
</body>
</html>