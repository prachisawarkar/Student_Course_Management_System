<?php

session_start();
if(!isset($_SESSION['valid'])) {
    header('Location : login.php');
}
//database connection file
include 'db_connect.php';

//select the data of the id whose session is active
$query = "select * from teacher_info where id = " . $_SESSION['id'] ;
$result = mysqli_query($con, $query);
$row = $result -> fetch_assoc(); //fetch data

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile</title>
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
                        <a class="navbar-link" href="teacher_profile.php">
                            <button type="button" class='btn-outline-primary rounded active'>Profile</button>
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
    </div>
    <!-- profile page -->
    <div class="container">
        <div class="row border border-primary">
            <div class="col-5 text-center">
                <img src="<?php echo 'uploads/'.$row['image'] ?>" alt="" class="rounded-circle" width="248px" height="268px">
            </div>
            <div class="col">
                <div class="row border"> <!-- name of the student -->
                    <div class="col-md-3">
                        <label class="text-primary"><h4>Name: </h4></label>
                    </div>
                    <div class="col-md-8"> 
                        <!-- <input type="text" name="name" id="name" value = "<?php echo $row['name'] ?>" class="border-0"> -->
                        <p class="info"><?php echo $row['name'] ?></p> 
                    </div>
                </div>
                <div class="row border"> <!-- email id of the student -->
                    <div class="col-md-3">
                        <label class="text-primary"><h4>Email Id: </h4></label>
                    </div>
                    <div class="col-md-8">
                        <p class="info"><?php echo $row['email'] ?></p>
                    </div>
                </div>
                <div class="row border"> <!-- username of the student -->
                    <div class="col-md-3">
                        <label class="text-primary"><h4>Username: </h4></label>
                    </div>
                    <div class="col-md-8">
                        <!-- <input type="text" name="username" id="username" value = "<?php echo $row['username'] ?>" class="border-0"> -->
                        <p class="info"><?php echo $row['username'] ?></p>
                    </div>
                </div>
                <div class="row border"> <!-- phone number of the student -->
                    <div class="col-md-3">
                        <label class="text-primary"><h4>Phone Number: </h4></label>
                    </div>
                    <div class="col-md-8">
                        <p class="info"><?php echo $row['phone_no'] ?></p>
                    </div>
                </div>
                <div class="row border"> <!-- address of the student -->
                    <div class="col-md-3">
                        <label class="text-primary"><h4>Address: </h4></label>
                    </div>
                    <div class="col-md-8">
                        <!-- <input type="text" name="address" id="address" value = "<?php echo $row['address'] ?>" class="border-0"> -->
                        <p class="info"><?php echo $row['address'] ?></p>
                    </div>
                </div>
                <div class="row border"> <!-- registration date and time -->
                    <div class="col-md-3">
                        <label class="text-primary"><h4>Joining Date & Time: </h4></label>
                    </div>
                    <div class="col-md-8">
                        <p class="info"><?php echo $row['created'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <br>

    </div>

    <!-- <script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#save').click(function() {
                /*function autosave() {*/
                    //fetch the values of the input field
                    var name = $('#name').val(); 
                    var username = $('#username').val();
                    var address = $('#address').val();
                    /*console.log(name);
                    console.log(username);
                    console.log(address);*/
                    $.ajax({
                        url : "edit_student_profile.php",
                        method : "POST",
                        data : {
                            name: name,
                            username : username,
                            address : address
                        },
                        success : function(data) {
                            alert(data);
                        }
                    });
                /*);*/
                /*setInterval(function() {
                autosave();
            }, 5000);*/
            });   
            
        });
    </script> -->
</body>
</html>