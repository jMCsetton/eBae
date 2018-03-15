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

  $pword = $_POST["password"];
  $enc_pword = md5($pword);
  


  $sql = "INSERT INTO address (postCode, street, city, county, doorNumber, username) VALUES ('".$_POST["postCode"]."','".$_POST["street"]."', '".$_POST["city"]."', '".$_POST["county"]."', '".$_POST["doorNumber"]."', '".$_POST["username"]."')";
  mysqli_query($sql, $conn);
  $sql2 = "INSERT INTO user (username, firstName, lastName, DOB, gender, email_ID, postCode, role, password)
  VALUES ('".$_POST["username"]."', '".$_POST["firstName"]."', '".$_POST["lastName"]."', '".$_POST["DOB"]."',
  '".$_POST["gender"]."', '".$_POST["email_ID"]."', '".$_POST["postCode"]."', 'buyer_seller','$enc_pword')";
  mysqli_query($sql2, $conn);

  if (($conn->query($sql) === TRUE) && ($conn->query($sql2) === TRUE)) {
    echo "New user created created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

  //}

}


 ?>

 <div>
 <a href="index.php"><button class="button button-block"/>Home</button></a>
 </div>