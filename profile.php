<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header('Location : login.php');
}

include 'db_connect.php';

$query = "select * from student_registration where id = " . $_SESSION['id'] ;
$result = mysqli_query($con, $query);
$row = $result -> fetch_assoc();

/*echo $row['name']."<br>";
echo $row['email']."<br>";
echo $row['username']."<br>";
echo $row['address']."<br>";*/

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
        .info {
            font-size: 20px;
        }
    </style>
</head>
<body>
	<div class="container top_section">
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
                        <a class="navbar-link" href="student_courses.php">
                            <button type="button" class='btn-outline-primary rounded'>Courses</button>
                        </a>
                    </li>
                    <li class="navbar-item mr-4 mb-1">
                        <a class="navbar-link" href="student_my_courses.php">
                            <button type="button" class='btn-outline-primary rounded'>My Courses</button>
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
        <!-- profile page -->
    <div class="container">
        <div class="row border">
            <div class="col-md-3">
                <label class="text-primary"><h4>Name: </h4></label>
            </div>
            <div class="col-md-8">
                <!-- <input type="text" name="name" id="name" value = "<?php echo $row['name'] ?>" class="border-0"> -->
                <p class="info"><?php echo $row['name'] ?></p>
            </div>
        </div>
        <div class="row border">
            <div class="col-md-3">
                <label class="text-primary"><h4>Email Id: </h4></label>
            </div>
            <div class="col-md-8">
                <p class="info"><?php echo $row['email'] ?></p>
            </div>
        </div>
        <div class="row border">
            <div class="col-md-3">
                <label class="text-primary"><h4>Username: </h4></label>
            </div>
            <div class="col-md-8">
                <!-- <input type="text" name="username" id="username" value = "<?php echo $row['username'] ?>" class="border-0"> -->
                <p class="info"><?php echo $row['username'] ?></p>
            </div>
        </div>
        <div class="row border">
            <div class="col-md-3">
                <label class="text-primary"><h4>Phone Number: </h4></label>
            </div>
            <div class="col-md-8">
                <p class="info"><?php echo $row['phone_no'] ?></p>
            </div>
        </div>
        <div class="row border">
            <div class="col-md-3">
                <label class="text-primary"><h4>Address: </h4></label>
            </div>
            <div class="col-md-8">
                <!-- <input type="text" name="address" id="address" value = "<?php echo $row['address'] ?>" class="border-0"> -->
                <p class="info"><?php echo $row['address'] ?></p>
            </div>
        </div>
        <div class="row border">
            <div class="col-md-3">
                <label class="text-primary"><h4>Joining Date & Time: </h4></label>
            </div>
            <div class="col-md-8">
                <p class="info"><?php echo $row['created'] ?></p>
            </div>
        </div>
        <br>
        <!-- <input type="button" name="save" class="btn btn-outline-primary" id="save" value="SAVE"> -->

	</div>

    <script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#save').click(function() {
                /*function autosave() {*//*
                    var id = $('#id').val();*/
                    var name = $('#name').val();
                    var username = $('#username').val();
                    var address = $('#address').val();
                    console.log(name);
                    console.log(username);
                    console.log(address);
                    $.ajax({
                        url : "edit_student_profile.php",
                        method : "POST",
                        data : {
                            name: name,
                            username : username,
                            address : address
                        },
                        success : function(data) {
                            /*if(data != '') {
                                $('#id').val(data);
                            }*/
                            alert(data);

                            /*document.location.href = 'login.html';*/

                        }
                    });
                /*);*/
                /*setInterval(function() {
                autosave();
            }, 5000);*/
            });   
            
        });
    </script>
</body>
</html>