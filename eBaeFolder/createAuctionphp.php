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

    
  $userID = $_SESSION['userID'];



  $check = getimagesize($_FILES["productImage"]["tmp_name"]);

  if($check !== false){
      $image = $_FILES['productImage']['tmp_name'];
      $imgContent = addslashes(file_get_contents($image));


  $image = $_FILES['productImage']['tmp_name'];
  $imgContent = addslashes(file_get_contents($image));

  $sql = "INSERT INTO product (category, productName, productInfo, productImage, endDate, reservePrice, userID, quantity, conditions)
  VALUES ('".$_POST["category"]."', '".$_POST["productName"]."', '".$_POST["productInfo"]."', '$imgContent', '".$_POST["endDate"]."',
  '".$_POST["reservePrice"]."', '$userID', '".$_POST["quantity"]."', '".$_POST["condition"]."')";


  if ($conn->query($sql) === TRUE) {
    echo "Auction created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

  //}
  }
  else{
    echo "Please select an image file to upload.";
  }
}


 ?> 

 <div>
 <a href="homepage.php"><button class="button button-block"/>Home</button></a>
 </div>