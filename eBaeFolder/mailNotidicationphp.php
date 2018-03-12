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

  // gets buyer emails
$sql = "SELECT u.email_ID, a.userID, a.auctionDate, p.productName
FROM user u, auction a, product p
WHERE a.auctionDate = curdate()-1
AND u.userID = a.userID
AND p.productID = a.productID";

$result = $conn->query($sql);

// gets seller emails
$sql2 = "SELECT u.email_ID, a.productID, p.userID, a.auctionDate, p.productName, a.auctionPrice
FROM user u, auction a, product p
WHERE a.auctionDate = curdate()-1
AND u.userID = p.userID
AND p.productID = a.productID";

$result2 = $conn->query($sql2);

if ($conn->query($sql) === TRUE) {
  echo "date added successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "date added successfully!";
} else {
  echo "Error: " . $sql2 . "<br>" . $conn->error;
}

  
$url = 'https://api.sendgrid.com/';
$user = 'azure_7a58e4661c900d03ae9e0a5a4b1cf0a2@azure.com';
$pass = 'Databases37!';

while( $row = mysqli_fetch_array($result)) { 
$params = array(
     'api_user' => $user,
     'api_key' => $pass,
     'to' => $row['email_ID'],
     'subject' => 'Confirming your bought item!',
     'html' => 'Hi! Thank you for your purchase of product: '.$row['productName'].'',
     'text' => 'Hi! Thank you for your purchase of product: '.$row['productName'].'',
     'from' => 'noreply@eBae.com',
  );

$request = $url.'api/mail.send.json';

// Generate curl request
$session = curl_init($request);

// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);

// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);

// print everything out
print_r($response);
}

while( $row2 = mysqli_fetch_array($result2)) { 
  $params = array(
       'api_user' => $user,
       'api_key' => $pass,
       'to' => $row2['email_ID'],
       'subject' => 'Confirming your bought item!',
       'html' => 'Hi! Thank you for your selling of product: '.$row2['productName'].' for '.$row2['auctionPrice'].'',
       'text' => 'Hi! Thank you for your selling of product: '.$row2['productName'].' for '.$row2['auctionPrice'].'',
       'from' => 'noreply@eBae.com',
    );
  
  $request = $url.'api/mail.send.json';
  
  // Generate curl request
  $session = curl_init($request);
  
  // Tell curl to use HTTP POST
  curl_setopt ($session, CURLOPT_POST, true);
  
  // Tell curl that this is the body of the POST
  curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
  
  // Tell curl not to return headers, but do return the response
  curl_setopt($session, CURLOPT_HEADER, false);
  curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
  
  // obtain response
  $response = curl_exec($session);
  curl_close($session);
  
  // print everything out
  print_r($response);
  }
  
?>