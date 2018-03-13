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
  
  
  $sql2 = "INSERT INTO user (username, firstName, lastName, DOB, gender, email_ID, postCode, role, password)
  VALUES ('".$_POST["username"]."', '".$_POST["firstName"]."', '".$_POST["lastName"]."', '".$_POST["DOB"]."',
  '".$_POST["gender"]."', '".$_POST["email_ID"]."', 'null', 'admin', '".$_POST["password"]."')";
  mysqli_query($sql2, $conn);

  if ($conn->query($sql2) === TRUE) {
    echo "New admin created created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

  //}

}


 ?>

 <div>
 <a href="adminHomepage.php"><button class="button button-block"/>Home</button></a>
 </div>