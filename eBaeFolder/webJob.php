<?php

$host       = "gc06team37db.mysql.database.azure.com";
$username   = "team37@gc06team37db";
$password   = "Databases37!";
$dbname     = "auction37gc06";

  $conn =  new mysqli($host, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }
  

$date = date("Y/m/d");
$sql = "INSERT INTO system (date)
VALUES ('$date')";

if ($conn->query($sql) === TRUE) {
    echo "date added successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // checking end dates of auctions

    $sql2 = "SELECT endDate, productID
    FROM product
    WHERE endDate = CURDATE()";
    $result2 = $conn->query($sql2);

    $sql3 = "SELECT p.endDate, p.productID, p.userID, b.bidID, MAX(b.bidPrice) as bidPrice , p.reservePrice
    FROM product p, bid b
    WHERE p.productID = b.productID
    AND endDate = CURDATE();";
    $result3 = $conn->query($sql3);

    if ($conn->query($sql3) === TRUE) {
        //echo "date added successfully!";
      } else {
        echo "Error: " . $sql3 . "<br>" . $conn->error;
      }

    while( $row3 = mysqli_fetch_array($result3)) { 
    if ( ($row3['reservePrice']) <= ($row3['bidPrice']) ){

        $sql4 = "INSERT INTO auction (productID, userID, auctionDate, auctionPrice, bidID)
        VALUES ('" .$row3["productID"]."', '" .$row3["userID"]."', '" .$row3["endDate"]."','" .$row3["bidPrice"]."','" .$row3["bidID"]."')";    

    if ($conn->query($sql4) === TRUE) {
    //echo "date added successfully!";
    } else {
        echo "Error: " . $sql4 . "<br>" . $conn->error;
    }

    }
}
  
  
?>