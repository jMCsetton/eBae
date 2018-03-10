<?php
include("config.php");

$url = 'https://api.sendgrid.com/';
$user = 'azure_911e61c4d7c718fae2cab0d0ab2f45cf@azure.com';
$pass = 'Databases37!';

$params = array(
     'api_user' => $user,
     'api_key' => $pass,
     'to' => 'zceesas@ucl.ac.uk',
     'subject' => 'testing from curl',
     'html' => 'testing body',
     'text' => 'testing body',
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
?>