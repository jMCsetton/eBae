<?php
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
                <a class="navbar-brand" href="adminHomepage.php">Back to Admin Homepage</a>
            </div>
    </nav>



    <div class="wrapper">
        <div class="page-header" style="background-image: url('../assets/img/login-image.jpg');">
            <div class="filter"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 ml-auto mr-auto">
                            <div class="card card-register">
                                <h3 class="title">Admin Registration form:</h3>
                              <form action="adminRegistrationphp.php" method="post" name="cruciform" onsubmit="return validationform()"> 
                                   
                                    <label>First Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" name="firstName"/>
                                    
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" name="lastName">
                                  
                                    <label>Date of Birth</label>
                                    <input type="text" class="form-control" placeholder="yyyy/mm/dd" name="DOB">
                                
                                    <label>Gender</label>
                                    <input type="text" class="form-control" placeholder="Gender" name="gender">
                                   
                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email_ID">
                                   
                                    <label>Username</label>
                                    <input type="Username" class="form-control" placeholder="Username" name="username" id="username1">
                                   
                                     <label>Password</label>
                                    <input type="password" class="form-control" placeholder="Password" id="psw" name="password" onkeyup='check();'>
                                    
                                     <label>Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm Password" id="psw2" onkeyup='check();'/>
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

<script>
function isValidDate(date)
{
    var matches = /^(\d{1,2})[-\/](\d{1,2})[-\/](\d{4})$/.exec(date);
    if (matches == null) return false;
    var d = matches[2];
    var m = matches[1] - 1;
    var y = matches[3];
    var composedDate = new Date(y, m, d);
    return composedDate.getDate() == d &&
            composedDate.getMonth() == m &&
            composedDate.getFullYear() == y;
}
function inpast(input){
  var a = new Date();
  var b = new Date(input);
  if(a <= b) {
    return false;
  }
}

function validationform() {
  var fname = document.forms["cruciform"]["firstName"].value;
  if (fname == "") {
    alert("Please enter a first name you fool!");
    return false;
  }
  var lname = document.forms["cruciform"]["lastName"].value;
  if (lname == "") {
    alert("Please enter your last name!")
    return false;
  }
  var dbirth = document.forms["cruciform"]["DOB"].value;
  if (dbirth == "") {
    alert("Please enter your date of birth!")
    return false;
  }
  if (isValidDate(dbirth) == false) {
    alert("Please enter a valid date of birth! (mm/dd/yyyy)");
    return false;
  }
  if (inpast(dbirth) == false) {
    alert("Hello time traveller! Tell us how you did it or you're not allowed to use our site. Or please enter a valid date of birth! (mm/dd/yyyy)");
    return false;
  }

  var gen = document.forms["cruciform"]["gender"].value;
  if (gen == "") {
    alert("Please enter your gender!")
    return false;
  }
  var eml = document.forms["cruciform"]["email_ID"].value;
  if (eml == "") {
    alert("Please enter your email address!")
    return false;
  }
  
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(eml) == false) {
    alert("You have entered an invalid email address!")
    return (false)
  }

  var usnm = document.forms["cruciform"]["username"].value;
  if (usnm == "") {
    alert("Please enter a username!")
    return false;
  }
  var pass = document.forms["cruciform"]["password"].value;
  if (usnm == "") {
    alert("Please enter a password!")
    return false;
  }
  var ps2 = document.forms["cruciform"]["psw2"].value;
  if (ps2 == "") {
    alert("Please confirm your password!")
    return false;
  }
}
</script>

<!-- Core JS Files -->
<script src="../assets/js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="../assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
<script src="../assets/js/tether.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Paper Kit Initialization snd functons -->
<script src="../assets/js/paper-kit.js?v=2.0.1"></script>

</html>
