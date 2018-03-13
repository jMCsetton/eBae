<?php
session_start();
ob_start();
//$user = $_SESSION['userID'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['Bid']))
{
  require "config.php";
  $conn =  new mysqli($host, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }
    
  $userID = $_SESSION['userID'];
  $productID_page = $_GET['id'];
  $date = date("Y/m/d");
  $productID_page = $_SESSION['productID_page'];

  // send notification to people who are outbid
  $sql2 = "SELECT u.email_ID, p.productName, b.userID,
(select MAX(bidPrice) AS bidPriceHighest
FROM bid
WHERE productID = $productID_page) r
  FROM user u, bid b, product p
  WHERE p.productID = $productID_page
  AND u.userID = b.userID
  AND b.productID = p.productID
  GROUP BY email_ID";

  $result2 = $conn->query($sql2);
  if ($conn->query($sql2) === TRUE) {
    //echo "emails sent successfully!";
  } else {
    //echo "Error: " . $sql2 . "<br>" . $conn->error;
  }
  
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
  
  while( $row2 = mysqli_fetch_array($result2)) { 
    if ($row2['userID'] != $userID){
    
    $productName = $row2["productName"];
    $mail2->ClearAllRecipients();
    $mail2->Subject = 'UCL Buyer Databases';
    $mail2->Debugoutput = 'html';
    $mail2->setFrom('ebaeauction@gmail.com', 'eBae Auction');
    $mail2->addAddress($row2['email_ID'], 'Buyer');
    $mail2->Subject = 'You have been outbid suckaaa!';
    $mail2->Debugoutput = 'html';
    $mail2->Body = 'Hi, 
                  You have been unfortunately outbid on: '.$productName.' 
                  The highest bid is now: £'.$_POST["bidPrice"].'
                  Come back soon!';
  
    if ($mail2->send()){
        //echo 'Message sent';
    }
  
      //echo json_encode($mail2);
    }
  }

  $sql = "INSERT INTO bid (bidPrice, userID, productID, bidDate)
  VALUES ('".$_POST["bidPrice"]."', '$userID', '$productID_page', '$date')";

  if ($conn->query($sql) === TRUE) {
   // echo "Bid added successfully!";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}
  
}


 ?> 

<div>
 <a href="homepage.php"><button class="button button-block"/>Home</button></a>
 </div>