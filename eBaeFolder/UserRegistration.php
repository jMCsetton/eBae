<?php
//echo "this is php"
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
                                <h3 class="title">Please fill out the form below to register:</h3>
                              <form action="Registrationphp.php" method="post">
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
                                    <input type="password" class="form-control" placeholder="Password" id="psw" name="password"">

                                     <label>Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password" id="psw2"/>
                                    <span id='message'></span>
                                     
                                   
                                    <button type="submit" name="submit" class="btn btn-danger btn-block btn-round"><a href="https://gc06team37db.azurewebsites.net">Register</a></button>

                                  
                                </form>

                                </div>

                                <script>
var myPass = document.getElementById("psw");
var myConfirmPass = document.getElementById("psw2");

var check = function() {
    if(document.getElementById("psw").value == document.getElementById("psw2").value) {
        document.getElementById('message').style.color = 'green';
         document.getElementById('message').innerHTML = 'matching';
    }  else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'not matching';
  }
}
</script>

                                </div>

                               
                            </div>


                        </div>
                    </div>
                   
                </div>
        </div>
    </div>
</body>

<!-- Core JS Files -->
<script src="../assets/js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="../assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
<script src="../assets/js/tether.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Paper Kit Initialization snd functons -->
<script src="../assets/js/paper-kit.js?v=2.0.1"></script>

</html>
