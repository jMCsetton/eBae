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

// gets seller emails
$sql2 = "SELECT u.email_ID, a.productID, p.userID, a.auctionDate, p.productName, a.auctionPrice
FROM user u, auction a, product p
WHERE a.auctionDate = curdate()-1
AND u.userID = p.userID
AND p.productID = a.productID";

$result2 = $conn->query($sql2);

if ($conn->query($sql2) === TRUE) {
  echo "date added successfully!";
} else {
  echo "Error: " . $sql2 . "<br>" . $conn->error;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('./vendor/autoload.php');

$mail = new phpmailer(true);


//Server settings
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls'; // enable 'tls'  to prevent security issues
$mail->SMTPAuth = true;
$mail->Username = 'ebaeauction@gmail.com';
$mail->Password = 'Databases37!';
// walkaround to bypass server errors
$mail->SMTPOptions = array(
'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
);

while( $row2 = mysqli_fetch_array($result2)) { 
  $productName = $row2["productName"];
  $mail->ClearAllRecipients();
  $mail->Subject = 'UCL Databases';
  $mail->Debugoutput = 'html';
  $mail->setFrom('ebaeauction@gmail.com', 'eBae Auction');
  $mail->addAddress($row2['email_ID'], 'Sellers');
  $mail->Subject = 'Auction Successful';
  $mail->Debugoutput = 'html';
  $mail->Body = 'Hi, 
                You have successfuly sold product: '.$productName.' 
                Come back soon!';

  if ($mail->send()){
      echo 'Message sent';
  }

    echo json_encode($mail);
  
  }

  $sql5 = "UPDATE system SET system.sellerNotificationsSent=TRUE WHERE system.date = curdate()-1";
  if ($conn->query($sql5) === TRUE) {
    //echo "date added successfully!";
    } else {
        echo "Error: " . $sql5 . "<br>" . $conn->error;
    }
  
?>