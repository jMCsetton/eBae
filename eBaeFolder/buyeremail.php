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
/*$sql2 = "SELECT u.email_ID, a.productID, p.userID, a.auctionDate, p.productName, a.auctionPrice
FROM user u, auction a, product p
WHERE a.auctionDate = curdate()-1
AND u.userID = p.userID
AND p.productID = a.productID";

$result2 = $conn->query($sql2);*/

if ($conn->query($sql) === TRUE) {
  echo "date added successfully!";
} else {
  //echo "Error: " . $sql . "<br>" . $conn->error;
}

/*if ($conn->query($sql2) === TRUE) {
  echo "date added successfully!";
} else {
  echo "Error: " . $sql2 . "<br>" . $conn->error;
}*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('./vendor/autoload.php');

$mail2 = new phpmailer(true);


//Server settings
$mail2->isSMTP();
$mail2->SMTPDebug = 2;
$mail2->Host = 'smtp.gmail.com';
$mail2->Port = 587;
$mail2->SMTPSecure = 'tls'; // enable 'tls'  to prevent security issues
$mail2->SMTPAuth = true;
$mail2->Username = 'ebaeauction@gmail.com';
$mail2->Password = 'Databases37!';
// walkaround to bypass server errors
$mail2->SMTPOptions = array(
'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
);

while( $row = mysqli_fetch_array($result)) { 
  $productName = $row["productName"];
  $mail2->ClearAllRecipients();
  $mail2->Subject = 'UCL Buyer Databases';
  $mail2->Debugoutput = 'html';
  $mail2->setFrom('ebaeauction@gmail.com', 'eBae Auction');
  $mail2->addAddress($row['email_ID'], 'Buyer');
  $mail2->Subject = 'Auction Successful!';
  $mail2->Debugoutput = 'html';
  $mail2->Body = 'Hi, 
                You have successfuly bought product: '.$productName.' 
                Come back soon!';

  if ($mail2->send()){
      echo 'Message sent';
  }

    echo json_encode($mail2);

}

/*while( $row2 = mysqli_fetch_array($result2)) { 
  $productName = $row2["productName"];
  $mail2
->Subject = 'UCL Databases';
  $mail2
->Debugoutput = 'html';
  $mail2
->setFrom('ebaeauction@gmail.com', 'eBae Auction');
  $mail2
->addAddress($row2['email_ID'], 'Sellers');
  $mail2
->Subject = 'Auction Successful';
  $mail2
->Debugoutput = 'html';
  $mail2
->Body = 'Hi, 
                You have successfuly sold product: '.$productName.' 
                Come back soon!';

  if ($mail2
->send()){
      echo 'Message sent';
  }

    echo json_encode($mail2
);
  
  }*/
  
?>