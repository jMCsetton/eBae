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



  /*$sql = "INSERT INTO address (postCode, street, city, county, doorNumber, username) VALUES ('E1 7JS',
  '".$POST["street"]."', '".$POST["city"]."', '".$POST["country"]."', '".$POST["doorNumber"]."', '".$POST["username"]."')";*/

  $sql2 = "INSERT INTO user (username, firstName, lastName, DOB, gender, email_ID, postCode, roles, passw)
  VALUES ('".$_POST["username"]."', '".$_POST["firstName"]."', '".$_POST["lastName"]."', '".$_POST["DOB"]."',
  '".$_POST["gender"]."', '".$_POST["email_ID"]."', 'E1 7HS', 'buyer_seller', '".$_POST["password"]."')";

  //".$_POST["postCode"]."
  /*if ($conn->query($sql) === TRUE ) {
    echo "New user address created created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}*/
if ($conn->query($sql2) === TRUE ) {
  echo "New user table row created created successfully";
} else {
  echo "Error: " . $sql2 . "<br>" . $conn->error;
}

  //}

}


 ?>

 <div>
 <a href="index.php"><button class="button button-block"/>Home</button></a>
 </div>
