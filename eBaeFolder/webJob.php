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
?>