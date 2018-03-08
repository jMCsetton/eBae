<?php

  require "config.php";
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