<?php
// This script is used to establish connection with database

// Define database connection parameters
$host       = "gc06team37db.mysql.database.azure.com";
$username   = "team37@gc06team37db";
$password   = "Databases37!";
$dbname     = "auction37gc06";

// Establish connection
$conn = mysqli_connect($host, $username, $password, $dbname) or die($conn->connect_error);
?>
