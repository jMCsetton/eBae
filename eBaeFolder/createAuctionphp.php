<?php
session_start();
$user = $_SESSION['userID'];
if (isset($_POST['submit']))
{
  require "config.php";
  $conn =  new mysqli($host, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }

  /*$sql = "INSERT INTO product (category, productName, productInfo, productImage, endDate, reservePrice, userID, quantity, condition')
  VALUES ('".$_POST["category"]."', '".$_POST["productName"]."', '".$_POST["productInfo"]."', '".$_POST["productImage"]."', '".$_POST["endDate"]."',
  '".$_POST["reservePrice"]."', '".$_POST["$user"]."', '".$_POST["quantity"]."', '".$_POST["condition"]."')";*/
  
  
  $sql = "INSERT INTO product (productName, userID) VALUES ('".$_POST["productName"]."','".$_POST["$user"]."')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}


 ?> 