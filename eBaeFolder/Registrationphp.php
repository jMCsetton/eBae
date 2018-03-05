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
    
  $userID = $_SESSION['userID'];


  $sql = "INSERT INTO user (userID, username, firstName, lastName, DOB, gender, email_ID, postCode, role, password)
  VALUES ('".$_POST["userID"]."', '".$_POST["username"]."', '".$_POST["firstName"]."', 'lastName', '".$_POST["DOB"]."',
  '".$_POST["gender"]."', '$userID', '".$_POST["quantity"]."', '".$_POST["condition"]."')";

  /*$sql = "INSERT INTO product (category, productName, productInfo, productImage, endDate, reservePrice, userID, quantity, conditions)
  VALUES ('".$_POST["category"]."', '".$_POST["productName"]."', '".$_POST["productInfo"]."', LOAD_FILE('".$_POST["productImage"]."'), '".$_POST["endDate"]."',
  '".$_POST["reservePrice"]."', '$userID', '".$_POST["quantity"]."', '".$_POST["condition"]."')";*/

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

  //}
  }
  else{
    echo "Please select an image file to upload.";
  }
}


 ?>