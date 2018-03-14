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
  
  $_SESSION['productID_page'] = $_GET['id'];
  $productID_page = $_SESSION['productID_page'];


  $sql1 = "DELETE from auction WHERE productID = '$productID_page'";
  $sql2 = "DELETE from viewingtraffic WHERE productID = '$productID_page'";
  $sql3 = "DELETE from bid WHERE productID = '$productID_page'";
  $sql4 = "DELETE from feedback WHERE productID = '$productID_page'";
  $sql5 = "DELETE from product WHERE productID = '$productID_page'";
       
      
  mysqli_query($sql, $conn);

  if (($conn->query($sql1) === TRUE) && ($conn->query($sql2) === TRUE) && ($conn->query($sql3) === TRUE) && ($conn->query($sql4) === TRUE) && ($conn->query($sql5) === TRUE)) {
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