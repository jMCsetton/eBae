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

  // send notification to people who are outbid
  $sql2 = "SELECT u.email_ID, p.productName, b.userID,
(select MAX(bidPrice) AS bidPriceHighest
FROM bid
WHERE productID = $productID_page) r
  FROM user u, bid b, product p
  WHERE p.productID = $productID_page
  AND u.userID = b.userID
  AND b.productID = p.productID
  GROUP BY email_ID";

  $result2 = $conn->query($sql2);
  if ($conn->query($sql2) === TRUE) {
    //echo "emails sent successfully!";
  } else {
    //echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
  

  $sql = "INSERT INTO bid (bidPrice, userID, productID, bidDate)
  VALUES ('".$_POST["bidPrice"]."', '$userID', '$productID_page', '$date')";

  if ($conn->query($sql) === TRUE) {
    echo "Bid added successfully!";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
  
}


 ?> 

<div>
 <a href="homepage.php"><button class="button button-block"/>Home</button></a>
 </div>