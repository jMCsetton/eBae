<?php
session_start();
ob_start();
//$user = $_SESSION['userID'];
if (isset($_POST['submit']))
{
  require "config.php";
  $conn =  new mysqli($host, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }
  
  $firstnameErr = $lastnameErr = $DOBErr = $doorNumberErr = $streetErr = $cityErr = $countyErr = $postCodeErr = $genderErr = $emailIDErr = $usernameErr = $passwordErr = $psw2Err = "";


    if (empty($_POST["firstName"])) {
      $firstnameErr = "First name is required";
    }
  
    if (empty($_POST["lastName"])) {
      $lastnameErr = "Last name is required";
    } 
  
      if (empty($_POST["DOB"])) {
      $DOBErr = "DOB is required";
    } 
  
    if (empty($_POST["doorNumber"])) {
      $doorNumberErr = "Door number is required";
    } 
  
    if (empty($_POST["street"])) {
      $streetErr = "Street is required";
    } 
  
      if (empty($_POST["city"])) {
      $cityErr = "City is required";
    } 
  
      if (empty($_POST["county"])) {
      $countyErr = "County is required";
    } 
  
      if (empty($_POST["postCode"])) {
      $postCodeErr = "Post Code is required";
    }
  
      if (empty($_POST["gender"])) {
      $genderErr = "Gender is required";
    } 
  
      if (empty($_POST["email_ID"])) {
      $emailIDErr = "Email is required";
      } /*else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format"; 
        }*/
  
      if (empty($_POST["username"])) {
      $usernameErr = "Username is required";
    } 
  
      if (empty($_POST["password"])) {
      $passwordErr = "Password is required";
    }
  
      if (empty($_POST["psw2"])) {
      $psw2Err = "Please confirm your password!";
    }

  $sql = "INSERT INTO address (postCode, street, city, county, doorNumber, username) VALUES ('".$_POST["postCode"]."','".$_POST["street"]."', '".$_POST["city"]."', '".$_POST["county"]."', '".$_POST["doorNumber"]."', '".$_POST["username"]."')";
  mysql_query($sql);
  $sql1 = "INSERT INTO user (username, firstName, lastName, DOB, gender, email_ID, postCode, role, password)
  VALUES ('".$_POST["username"]."', '".$_POST["firstName"]."', '".$_POST["lastName"]."', '".$_POST["DOB"]."',
  '".$_POST["gender"]."', '".$_POST["email_ID"]."', '".$_POST["postCode"]."', 'buyer_seller', '".$_POST["password"]."')";
  mysql_query($sql1);

  if ($conn->query($sql) === TRUE) {
    echo "New user created created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

  //}

}


 ?>

 <div>
 <a href="index.php"><button class="button button-block"/>Home</button></a>
 </div>