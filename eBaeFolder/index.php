<?php 
//echo "This is PHP"
include("config.php");
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
    <!--link href="demo.css" rel="stylesheet" /-->

    <!--     Fonts and icons     -->
    <!--link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="nucleo-icons.css" rel="stylesheet"-->

</head>

<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    
    $conn = new mysqli($host, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        echo "failed connection";
    }

    echo "entering if, connection not failed";

    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
    
    $sql = "SELECT userID FROM user WHERE username = '$myusername' AND password = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    
    $count = mysqli_num_rows($result);
    
    // If result matched $myusername and $mypassword, table row must be 1 row
      
    if($count == 1) {
       session_register("myusername");
       $_SESSION['login_user'] = $myusername;
       
       header("location: homepage.php");
    }else {
       echo "Your Login Name or Password is invalid";
    }
 }
/*if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    //User log in page
    if (isset($_POST['login'])) {

        require 'index_php.php';
        
    }*/
    
   //  Register page
   // elseif (isset($_POST['register'])) {
        
      //  require 'login.php';
        
   //} 
//}
?>
<body>
    <div class="wrapper">
        <div class="page-header" style="background-color: #FFFFFF">
            <div class="filter"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 ml-auto mr-auto" style="float-right: 50%">
                            <div class="card card-register">
                                <h2 class="title" style="font-size: 48px; font-weight: bold; color: #000197">eBae</h2>



                 
                                <!--<form method="post"  class = "register-form">-->
                                <form action  = "" method="post"  >
                                    <label style="color: #B33C12">Username</label>
                                    <input type="text" name = "username"  class="form-control" style="background-color: #e5e5e5" placeholder="Username"/>

                                    <label style="color: #B33C12">Password</label>
                                    <input name="password" type="password" class="form-control" style="background-color: #e5e5e5" placeholder="Password"/>
                                    <!--button class="btn btn-danger btn-block btn-round" />Login</button--><input type = "submit" value = " Submit "/><br />
                
                               </form>
                                    <button class="btn btn-danger btn-block btn-round" name = "register"><a href="https://gc06team37db.azurewebsites.net/UserRegistration.php#">Register User New Account</a></button>
                                    <button class="btn btn-danger btn-block btn-round" name = "register"><a href="https://gc06team37db.azurewebsites.net/AdminRegistration.php#">Register Admin New Account</a></button>
                                    </div>
                        </div>
                    </div>
                                                                                                                                            
                </div>
        </div>
    </div>
</body>

<!-- Core JS Files >
<script src="../assets/js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="../assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
<script src="../assets/js/tether.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>-->

<!--  Paper Kit Initialization snd functons >
<script src="../assets/js/paper-kit.js?v=2.0.1"></script> -->

</html>
