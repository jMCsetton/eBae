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

$sql = "";

  
$url = 'https://api.sendgrid.com/';
$user = 'azure_911e61c4d7c718fae2cab0d0ab2f45cf@azure.com';
$pass = 'Databases37!';

$params = array(
     'api_user' => $user,
     'api_key' => $pass,
     'to' => 'zceesas@ucl.ac.uk',
     'subject' => 'Urgent: Attendance below 70%',
     'html' => 'Dear Sameen \n Your attendance has been noted to be below 70%, as is the requirement from the college. \nPlease contact your course administrator for further action. \n\n Best Regards, \nCS Admin Team',
     'text' => 'Dear Sameen \n Your attendance has been noted to be below 70%, as is the requirement from the college. \nPlease contact your course administrator for further action. \n\n Best Regards, \nCS Admin Team',
     'from' => 'cs.admin@ucl.ac.uk',
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
?>