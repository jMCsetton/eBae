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
VALUES (curdate()-1)";

if ($conn->query($sql) === TRUE) {
    echo "date added successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // checking end dates of auctions

    /*$sql2 = "SELECT endDate, productID
    FROM product
    WHERE endDate = CURDATE()";
    $result2 = $conn->query($sql2);*/

    /*$sql3 = "SELECT p.endDate, p.productID, b.userID, b.bidID, bidPriceHighest as bidPrice , p.reservePrice
    FROM (SELECT productID, MAX(bidPrice) AS bidPriceHighest, date_format(bidDate, '%d-%m-%Y') bidDate
   FROM bid
   GROUP BY productID
  ) r, product p, bid b
    WHERE p.productID = b.productID
    AND r.productID = b.productID
    AND endDate = CURDATE()-1
    GROUP BY productID;"; */

    $sql3="SELECT p.endDate, p.productID, p.userID, b.bidID, bidPriceHighest as bidPrice , p.reservePrice, u.email_ID, p.productName, b.userID as buyerID
    from product p
   LEFT OUTER JOIN bid b ON p.productID = b.productID
  LEFT OUTER JOIN (SELECT productID, MAX(bidPrice) AS bidPriceHighest, date_format(bidDate, '%d-%m-%Y') bidDate
   FROM bid
   GROUP BY productID
  ) r ON r.productID = p.productID
  LEFT JOIN user u ON p.userID = u.userID
  WHERE endDate = CURDATE()-1
GROUP BY p.productID";

    $result3 = $conn->query($sql3);

    if ($conn->query($sql3) === TRUE) {
        //echo "date added successfully!";
      } else {
        echo "Error: " . $sql3 . "<br>" . $conn->error;
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

    while( $row3 = mysqli_fetch_array($result3)) { 
    if ( ($row3['reservePrice']) <= ($row3['bidPrice']) ){

        $sql4 = "INSERT INTO auction (productID, userID, auctionDate, auctionPrice, bidID)
        VALUES ('" .$row3["productID"]."', '" .$row3["buyerID"]."', '" .$row3["endDate"]."','" .$row3["bidPrice"]."','" .$row3["bidID"]."')";    

    if ($conn->query($sql4) === TRUE) {
    //echo "date added successfully!";
      $sql5 = "UPDATE system SET system.auctionStatus=TRUE WHERE system.date = curdate()-1";
      if ($conn->query($sql5) === TRUE) {
        //echo "date added successfully!";
        } else {
            echo "Error: " . $sql5 . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql4 . "<br>" . $conn->error;
    }
    }
    else {
      $productName = $row3["productName"];
      $mail->ClearAllRecipients();
      $mail->Subject = 'UCL Databases';
      $mail->Debugoutput = 'html';
      $mail->setFrom('ebaeauction@gmail.com', 'eBae Auction');
      $mail->addAddress($row3['email_ID'], 'Sellers');
      $mail->Subject = 'Auction Successful';
      $mail->Debugoutput = 'html';
      $mail->Body = 'Hi, 
                    Sorry, you have not sold product: '.$productName.' 
                    Come back soon!';
    
      if ($mail->send()){
          echo 'Message sent';
      }
    
        echo json_encode($mail);
      
      }    

    }




  
  
?>