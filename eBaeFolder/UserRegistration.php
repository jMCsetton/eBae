<?php
session_start();
//echo "this is php"
ob_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="bootstrap.min.css" rel="stylesheet" />
    <link href="paper-kit.css?v=2.1.0" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="nucleo-icons.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-md fixed-top navbar-transparent">
        <div class="container">
            <div class="navbar-translate">
                <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar"></span>
                    <span class="navbar-toggler-bar"></span>
                    <span class="navbar-toggler-bar"></span>
                </button>
                <a class="navbar-brand" href="https://www.creative-tim.com">Back to Log in page</a>
            </div>
    </nav>




    <div class="wrapper">
        <div class="page-header" style="background-image: url('../assets/img/login-image.jpg');">
            <div class="filter"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 ml-auto mr-auto">
                            <div class="card card-register">
                                <h3 class="title">Please fill out the form below to register AMELLLIIUUUHHHHHHH:</h3>
                               <form action=“” method=“post” enctype=“multipart/form-data” >
                               <div class="register-form">
                                    
                                    <label>First Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" name="firstName">

                                    <label>Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" name="lastName">

                                    <label>Date of Birth</label>
                                    <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="DOB">

                                    <label>Address:</label>
                                    <input type="text" class="form-control" placeholder="House Number" name="doorNumber">
                                    <input type="text" class="form-control" placeholder="Street" name="street">
                                    <input type="text" class="form-control" placeholder="Town/City" name="city">
                                    <input type="text" class="form-control" placeholder="County" name="county">
                                    <input type="text" class="form-control" placeholder="Post Code" name="postCode">

                                    <label>Gender</label>
                                    <input type="text" class="form-control" placeholder="Gender" name="gender">

                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email_ID">

                                    <label>Username</label>
                                    <input type="Username" class="form-control" placeholder="Username" name="username">

                                    <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password">

                                     <label>Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password">
                                     
                                   
                                    <button type="submit" name="submit" class="btn btn-danger btn-block btn-round"><a href="index.php">Register</a></button>

                                  
                                </form>
                               
                            </div>
                        </div>
                    </div>
                   
                </div>
        </div>
    </div>
</body>

<?php

if (isset($_POST['submit']))
{
  require "config.php";
  $conn =  new mysqli($host, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }

  $sql = "INSERT INTO address (postCode, street, city, country, doorNumber, username) VALUES ('".$POST["postCode"]."',
  '".$POST["street"]."', '".$POST["city"]."', '".$POST["country"]."', '".$POST["doorNumber"]."', '".$POST["username"]."')";

  //$sql2 = "INSERT INTO user (username, firstName, lastName, DOB, gender, email_ID, postCode, role, password)
  //VALUES ('".$_POST["username"]."', '".$_POST["firstName"]."', '".$_POST["lastName"]."', '".$_POST["DOB"]."',
  //'".$_POST["gender"]."', '".$_POST["email_ID"]."', '".$_POST["postCode"]."', '".$_POST["role"]."', '".$_POST["password"]."')";

  if ($conn->query($sql) === TRUE) {
    echo "New user created created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

  //}

}


 ?>
<!-- Core JS Files -->
<script src="../assets/js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="../assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
<script src="../assets/js/tether.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Paper Kit Initialization snd functons -->
<script src="../assets/js/paper-kit.js?v=2.0.1"></script>

</html>
