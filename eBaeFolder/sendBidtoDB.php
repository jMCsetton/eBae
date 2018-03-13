<?php
session_start();
ob_start();
//$user = $_SESSION['userID'];
if (isset($_POST['Bid']))
{
  require "config.php";
  $conn =  new mysqli($host, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }
    
  $userID = $_SESSION['userID'];
  $productID_page = $_GET['id'];
  $date = date("Y/m/d");
  $productID_page = $_SESSION['productID_page'];


  $sql = "INSERT INTO bid (bidPrice, userID, productID, bidDate)
  VALUES ('".$_POST["bidPrice"]."', '$userID', '$productID_page', '$date')";

  if ($conn->query($sql) === TRUE) {
    echo "Bid added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
  
}


 ?> 

<div>
 <a href="homepage.php"><button class="button button-block"/>Home</button></a>
 </div>