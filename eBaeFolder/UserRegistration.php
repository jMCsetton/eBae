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

<?php
// define variables and set to empty values
$firstnameErr = $lastnameErr = $firstnameErr = $DOBErr = $genderErr = $passwordErr = "";
$firstname = $lastname = $dob = $address = $email = $gender = $password "";

// error messages if not filled in
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstname"])) {
    $firstnameErr = "First name is required";
  } else {
    $firstname = test_input($_POST["firstname"]);
  }

   if (empty($_POST["lastname"])) {
    $lastnameErr = "Last name is required";
  } else {
    $lastnamename = test_input($_POST["lastname"]);
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }
    
  if (empty($_POST["address"])) {
    $address = "";
  } else {
    $address = test_input($_POST["website"]);
  }

  if (empty($_POST["dob"])) {
    $DOBErr = "";
  } else {
    $dob = test_input($_POST["dob"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
 
 if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["Password"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

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
                                <form class="register-form"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <label>First Name</label>
                                    <input type="text" firstname="firstname" class="form-control" placeholder="First Name"><span class="error">* <?php echo $firstnameErr;?></span>

                                    <label>Last Name</label>
                                    <input type="text" lastname = "lastname" class="form-control" placeholder="Last Name"><span class="error">* <?php echo $lastnameErr;?></span>

                                    <label>Date of Birth</label>
                                    <input type="text" class="form-control" dob="dob" placeholder="dd/mm/yyyy"><span class="error">* <?php echo $DOBErr;?></span>

                                    <label>Address:</label>
                                    <input type="text" class="form-control" placeholder="First Line of Address">
                                     <input type="text" class="form-control" placeholder="Town">
                                    <input type="text" class="form-control" placeholder="City">
                                    <input type="text" class="form-control" placeholder="Country">
                                    <input type="text" class="form-control" placeholder="Post Code">

                                    <label>Gender</label>
                                    <input type="text" class="form-control" gender="gender" placeholder="Gender"><span class="error">* <?php echo $genderErr;?></span>

                                    <label>Email</label>
                                    <input type="text" class="form-control" email = "email" placeholder="Email"><span class="error">* <?php echo $emailErr;?></span>

                                    <label>Password</label>
                                    <input type="password" class="form-control" password="password" placeholder="Password"><span class="error">* <?php echo $passwordErr;?></span>

                                     <label>Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password">
                                    
                                    <button class="btn btn-danger btn-block btn-round">Register</button>

                                  
                                </form>
                               
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
