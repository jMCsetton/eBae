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

  $_SESSION['productID_page'] = $_GET['id'];
  $productID_page = $_SESSION['productID_page'];
  $userID = $_SESSION['userID'];
  
  $date = date("Y/m/d");

  $sql = "INSERT INTO bid (bidPrice, userID, productID, bidDate)
  VALUES ('".$_POST["bidPrice"]."', '$userID', '$productID_page', '$date')";


  

 
    //echo "Bid added successfully!";
    


 



         echo "<a href='auctionDetails.php?id= $productID_page ' class='w3-third w3-container' style='background-color:black; width:9%; color:white'><b> Go back to Auction Details<b></a> 
              ";




 

  //}
  
  
}



 ?> 

 