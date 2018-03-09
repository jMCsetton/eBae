<?php
//echo "this is php"
?>
<?php
// define variables and set to empty values
$firstnameErr = $lastnameErr = $DOBErr = $doorNumberErr = $streetErr = $cityErr = $countyErr = $postCodeErr = $genderErr = $emailIDErr = $usernameErr = $passwordErr = $psw2Err = "";
$firstName = $lastName = $DOB = $doorNumber = $street = $city = $county = $postCode = $gender = $email_ID  = $username = $password  = $psw2"";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["firstName"])) {
    $firstnameErr = "First name is required";
  } else {
    $firstname = test_input($_POST["firstName"]);
  }

  if (empty($_POST["lastName"])) {
    $lastnameErr = "Last name is required";
  } else {
    $lastName = test_input($_POST["lastName"]);
  }

    if (empty($_POST["DOB"])) {
    $DOBErr = "DOB is required";
  } else {
    $DOB = test_input($_POST["DOB"]);
  }

  if (empty($_POST["doorNumber"])) {
    $comment = "Door number is required";
  } else {
    $doorNumber = test_input($_POST["doorNumber"]);
  }

  if (empty($_POST["street"])) {
    $streetErr = "Street is required";
  } else {
    $street = test_input($_POST["street"]);
  }

    if (empty($_POST["city"])) {
    $cityErr = "City is required";
  } else {
    $city = test_input($_POST["city"]);
  }

    if (empty($_POST["county"])) {
    $countyErr = "County is required";
  } else {
    $county = test_input($_POST["county"]);
  }

    if (empty($_POST["postCode"])) {
    $postCodeErr = "Post Code is required";
  } else {
    $postCode = test_input($_POST["postCode"]);
  }

    if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

    if (empty($_POST["email_ID"])) {
    $emailIDErr = "Email is required";
  } else {
    $email_ID = test_input($_POST["email_ID"]);
  }

    if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } else {
    $username = test_input($_POST["username"]);
  }

    if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }

    if (empty($_POST["psw2"])) {
    $psw2Err = "Please confirm your password!";
  } else {
    $psw2 = test_input($_POST["psw2"]);
  }
}
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
                                    <span class="error">* <?php echo $firstnameErr;?></span>
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" name="lastName">
                                    <span class="error">* <?php echo $lastnameErr;?></span>
                                    <label>Date of Birth</label>
                                    <input type="text" class="form-control" placeholder="dd/mm/yyyy" name="DOB">
                                    <span class="error">* <?php echo $DOBErr;?></span>
                                    <label>Address:</label>
                                    <input type="text" class="form-control" placeholder="House Number" name="doorNumber">
                                    <span class="error">* <?php echo $doorNumberErr;?></span>
                                    <input type="text" class="form-control" placeholder="Street" name="street">
                                    <span class="error">* <?php echo $streetErr;?></span>
                                    <input type="text" class="form-control" placeholder="Town/City" name="city">
                                    <span class="error">* <?php echo $cityErr;?></span>
                                    <input type="text" class="form-control" placeholder="County" name="county">
                                    <span class="error">* <?php echo $countyErr;?></span>
                                    <input type="text" class="form-control" placeholder="Post Code" name="postCode">
                                    <span class="error">* <?php echo $postCodeErr;?></span>

                                    <label>Gender</label>
                                    <input type="text" class="form-control" placeholder="Gender" name="gender">
                                    <span class="error">* <?php echo $genderErr;?></span>

                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email_ID">
                                    <span class="error">* <?php echo $emailErr;?></span>
                                    <label>Username</label>
                                    <input type="Username" class="form-control" placeholder="Username" name="username">
                                    <span class="error">* <?php echo $usernameErr;?></span>
                                     <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password" id="psw" name="password" onkeyup='check();'>
                                    <span class="error">* <?php echo $passwordErr;?></span>
                                     <label>Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="psw2" id="psw2" onkeyup='check();'/>
                                    <span class="error">* <?php echo $psw2Err;?></span>
                                    <span id='message'></span>
                                     
                                    <script>

                                    var check = function() {
                                    if(document.getElementById("psw").value == document.getElementById("psw2").value) {
                                        document.getElementById('message').style.color = 'green';
                                         document.getElementById('message').innerHTML = 'Passwords match';
                                    }  else {
                                        document.getElementById('message').style.color = 'red';
                                        document.getElementById('message').innerHTML = 'Passwords do not match';
                                  }
                                }
                            </script>
                                    <button type="submit" name="submit" class="btn btn-danger btn-block btn-round"><a href="https://gc06team37db.azurewebsites.net">Register</a></button>

                                  
                                </form>

                                </div>

                            

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
