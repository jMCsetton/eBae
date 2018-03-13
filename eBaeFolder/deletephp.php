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
  

 
  $sql = "DELETE product FROM product INNER JOIN auction ON product.productID = auction.productID WHERE product.productID = auction.productID = "$productID"";
       
      
  mysqli_query($sql, $conn);

  if (($conn->query($sql) === TRUE)) {
    echo "Product deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

  //}

}


 ?>

 <div>
 <a href="index.php"><button class="button button-block"/>Home</button></a>
 </div>