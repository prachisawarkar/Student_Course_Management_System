<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header('Location : login.php');
}
//database connection file
include 'db_connect.php';

//select the data of the id whose session is active
$query = "select * from users where id = " . $_SESSION['id'] ;
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
                        <a class="navbar-link" href="profile.php">
                            <button type="button" class='btn-outline-primary rounded active'>Profile</button>
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
        <div class="row border border-primary">
             
            <div class="col-5 text-center">
                <img src="<?php echo 'uploads/' . $row['image'] ?>" alt="" class="rounded-circle" width="248px" height="268px">
                <div class="mt-2">
                    <button class="btn btn-outline-primary" id="update_profile_image_btn">Change Profile Picture</button>
                    <form method="post" enctype="multipart/form-data" class="border border-primary rounded mt-2" id="update_profile_image" name="update_profile_image" style="display: none;">
                            <p style="font-size: 11px" class="mb-0 mt-2 text-danger">File extension must be .jpeg, .jpg or .png</p>
                            <input type="file" name="profile" id="profile" class="form-control profile" required>
                            <input type="submit" name="submit" id="submit" class="btn btn-outline-primary" value="Submit">
                    </form>
                </div>
            </div>
            <div class="col">
                <div class="row border"> <!-- name of the student -->
                    <div class="col-md-3">
                        <label class="text-primary"><h4>Name: </h4></label>
                    </div>
                    <div class="col-md-8"> 
                        <span id="name_error"></span>
                        <input type="text" name="name" id="<?php echo $_SESSION['id'] ?>" onchange="return edit_name(this.id, this.value)" value = "<?php echo $row['name'] ?>" class="border-0 bg-transparent name info" required>
                        <!-- <p class="info"><?php echo $row['name'] ?></p> --> 
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
                        <span id="username_error"></span>
                        <input type="text" name="username" id="<?php echo $_SESSION['id'] ?>" onchange="return edit_username(this.id, this.value)" value = "<?php echo $row['username'] ?>" class="border-0 bg-transparent username info" required>
                        <!-- <p class="info"><?php echo $row['username'] ?></p> -->
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
                        <span id="address_error"></span>
                        <input type="text" name="address" id="<?php echo $_SESSION['id'] ?>" onchange="return edit_address(this.id, this.value)" value = "<?php echo $row['address'] ?>" class="border-0 bg-transparent address info" required> 
                </div>
                        <!-- <p class="info"><?php echo $row['address'] ?></p> -->
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
        <p id="msg"></p>

	</div>

    <script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $("#update_profile_image_btn").click(function(){
                $("#update_profile_image").fadeIn();
                $("#update_profile_image").submit(function() {
                                   
                    var profile = $("#profile").val();
                    console.log(profile);

                    // to validate extension
                    var ext = profile.split('.').pop().toLowerCase();
                    if($.inArray(ext, ['png', 'jpeg', 'jpg']) == -1) {
                        $("#msg").html("<div class='alert alert-danger'>" + "Invalid file extension" + "</div>");
                    } else if('.profile' != '') {
                        var formdata = new FormData(this);
                        console.log(formdata);

                        $.post({
                            url : 'update_profile_image.php',
                            type : "POST",
                            data : formdata,
                            contentType : false,
                            processData : false,
                            cache : false
                            /*beforeSend : function() {
                                $("#msg").fadeIn();
                            }*/
                        }).done(function(data) {
                            $("#msg").html("<div class='alert alert-danger'>" + data + "</div>");
                            $("update_profile_image").load(profile.php);
                        }).fail(function(data) {
                            $("#msg").html("<div class='alert alert-danger'>" + "Fail" + "</div>");
                        });
                    }
                });
            });
        });

        //function to save the name
        function edit_name(id,name) {
            var current_id = id;
            var updated_name = name;

            // validate the name
            var name_pattern = /^[A-Za-z ]{0,70}$/i;
            if(!name_pattern.test(updated_name)) {
                $('#name_error').fadeIn().html('Please enter valid name');
                setTimeout(function() {
                    $('#name_error').fadeOut();
                }, 3000);
                $('#name').focus();
                return false;
            }

            if('.name' != '') {
                $.ajax({
                    url : "profile_edit.php",
                    method : "POST",
                    data : {
                        current_id : current_id,
                        updated_name : updated_name
                    },
                    success : function(data) {
                        $("#msg").html("<div class='alert alert-success'>" + data + "</div>");
                    }
                });
            }
        }

        //function to save the username
        function edit_username(id, username) {
            var current_id = id;
            var updated_username = username;
            var username_pattern = /^\S*$/;
            if(!username_pattern.test(updated_username)) {
                $("#username_error").fadeIn().html("Please enter valid username with no space");
                setTimeOut(function(){
                    $("#username_error").fadeOut();
                }, 3000);
                $("#username").focus();
                return false;
            }
            if('.username' != '') {
                $.ajax({
                    url : 'profile_edit.php',
                    type : "POST",
                    data : {
                        current_id : current_id,
                        updated_username : updated_username
                    },
                    success : function(data) {
                        $("#msg").html("<div class='alert alert-success'>" + data + "</div>");
                    }
                });
            }
        }

        //function to save the address
        function edit_address(id, address) {
            var current_id = id;
            var updated_address = address;
            
            if('.address' != '') {
                $.ajax({
                    url : 'profile_edit.php',
                    type : "POST",
                    data : {
                        current_id : current_id,
                        updated_address : updated_address
                    },
                    success : function(data) {
                        $("#msg").html("<div class='alert alert-success'>" + data + "</div>");
                    }
                });
            }
        }
    </script>
</body>
</html>