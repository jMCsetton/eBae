<?php 
echo "This is PHP"
require 'config.php';
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Paper Kit 2 by Creative Tim</title>

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
    <div class="wrapper">
        <div class="page-header" style="background-color: #FFFFFF">
            <div class="filter"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 ml-auto mr-auto" style="float-right: 50%">
                            <div class="card card-register">
                                <h2 class="title" style="font-size: 48px; font-weight: bold; color: #000197">eBae</h2>
                                                                                                                                                                                                                                
                                <!--<form method="post" action="/login" class="register-form">-->
                                    <label style="color: #B33C12">Username</label>
                                    <input name="uname" type="text" class="form-control" style="background-color: #e5e5e5" placeholder="Username">

                                    <label style="color: #B33C12">Password</label>
                                    <input name="password" type="password" class="form-control" style="background-color: #e5e5e5" placeholder="Password">
                                    <button class="btn btn-danger btn-block btn-round">Login</button>
                                <!--</form>-->
                                    <button class="btn btn-danger btn-block btn-round">Register New User Account</button>
                                    
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
