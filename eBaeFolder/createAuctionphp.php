<?php
session_start();
//$user = $_SESSION['userID'];
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
  
 
  
  $username1 = $_SESSION['username'];
  $sql = "SELECT userID INTO a FROM user WHERE username = 'sameen'";
  //echo $_SESSION['username'];
  $result = $conn->query($sql);
  echo $result;
  //print "$username1";

  
  //$result = $conn->query($sql);
  //echo $result;
  //print "$result";
  
  //$count = mysqli_num_rows($result);
  //$userID = $result;
  
  // If result matched $myusername and $mypassword, table row must be 1 row
    
  /*if($count >= 1) {
    
        
  $sql = "INSERT INTO product (productName, userID) VALUES ('".$_POST["productName"]."','$userID')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

  }*/


}


 ?> 