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

  /*$sql = "INSERT INTO product (category, productName, productInfo, productImage, endDate, reservePrice, userID, quantity, condition')
  VALUES ('".$_POST["category"]."', '".$_POST["productName"]."', '".$_POST["productInfo"]."', '".$_POST["productImage"]."', '".$_POST["endDate"]."',
  '".$_POST["reservePrice"]."', '".$_POST["$user"]."', '".$_POST["quantity"]."', '".$_POST["condition"]."')";*/
  
 
  
  //$username1 = $_SESSION['username'];
  //$sql = "SELECT userID INTO a FROM user WHERE username = 'sameen'";
  //echo $_SESSION['username'];

  //$result = $conn->query($sql);
  //$row = mysqli_fetch_array($result);
  //echo $_SESSION['userID'];
  //print "$username1";

  
  //$result = $conn->query($sql);
  //echo $result;
  //print "$result";
  
  //$count = mysqli_num_rows($result);
  //$userID = $result;
  
  // If result matched $myusername and $mypassword, table row must be 1 row
    
  //if($count >= 1) {
    
  $userID = $_SESSION['userID'];
  //$sql = "INSERT INTO product (productName, userID) VALUES ('".$_POST["productName"]."','$userID')";
  /*$sql = "INSERT INTO product (category, productName, productInfo, reservePrice, userID, quantity, conditions)
  SET '".$_POST["category"]."', '".$_POST["productName"]."', '".$_POST["productInfo"]."',
  ".$_POST["reservePrice"].", '$userID', ".$_POST["quantity"].", '".$_POST["condition"]."'";*/

  $image = $_FILES['productImage']['tmp_name'];
  $imgContent = addslashes(file_get_contents($image));

  $sql = "INSERT INTO product (category, productName, productInfo, productImage, endDate, reservePrice, userID, quantity, conditions)
  VALUES ('".$_POST["category"]."', '".$_POST["productName"]."', '".$_POST["productInfo"]."', '$imgContent', '".$_POST["endDate"]."',
  '".$_POST["reservePrice"]."', '$userID', '".$_POST["quantity"]."', '".$_POST["condition"]."')";

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


 ?> 