<?php
session_start();
ob_start();
if (isset($_POST['submit']))
{
  require "config.php";
  $conn =  new mysqli($host, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }
  
  $product_id_page = $_GET['id'];
  $userID = $_SESSION['userID'];

  $sql2 = "SELECT userID, productID
  FROM product
  WHERE productID = '$product_id_page'";

$result2 = $conn->query($sql2);
$row2 = mysqli_fetch_array($result2);

  $sql = "INSERT INTO feedback (raterID, userRatedID, rating, productID)
  VALUES ('$userID', '".$row2['userID']."', '".$_POST["Rating"]."', '$product_id_page')";

  if ($conn->query($sql) === TRUE) {
    echo "Feedback submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

 
}


 ?> 

 <div>
 <a href="homepage.php"><button class="button button-block"/>Home</button></a>
 </div>