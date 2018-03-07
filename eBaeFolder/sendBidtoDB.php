<?php
session_start();
ob_start();
//$user = $_SESSION['userID'];
if (isset($_POST['Bid']))
{
  require "config.php";
  $conn =  new mysqli($host, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }

  /*$sql = "INSERT INTO product (category, productName, productInfo, productImage, endDate, reservePrice, userID, quantity, condition')
  VALUES ('".$_POST["category"]."', '".$_POST["productName"]."', '".$_POST["productInfo"]."', '".$_POST["productImage"]."', '".$_POST["endDate"]."',
  '".$_POST["reservePrice"]."', '".$_POST["$user"]."', '".$_POST["quantity"]."', '".$_POST["condition"]."')";*/
  
 
  
  //$username1 = $_SESSION['username'];
  //$sql = "SELECT userID INTO a FROM user WHERE username = 'sameen'";
  //echo $_SESSION['username'];

  //$result = $conn->query($sql);
  //$row = mysqli_fetch_array($result);
  //echo $_SESSION['userID'];
  //print "$username1";

  
  //$result = $conn->query($sql);
  //echo $result;
  //print "$result";
  
  //$count = mysqli_num_rows($result);
  //$userID = $result;
  
  // If result matched $myusername and $mypassword, table row must be 1 row
    
  //if($count >= 1) {
    
  $userID = $_SESSION['userID'];
  $productID_page = $_GET['id'];
  $date = date("Y/m/d");
  $productID_page = $_SESSION['productID_page'];
  //$sql = "INSERT INTO product (productName, userID) VALUES ('".$_POST["productName"]."','$userID')";
  /*$sql = "INSERT INTO product (category, productName, productInfo, reservePrice, userID, quantity, conditions)
  SET '".$_POST["category"]."', '".$_POST["productName"]."', '".$_POST["productInfo"]."',
  ".$_POST["reservePrice"].", '$userID', ".$_POST["quantity"].", '".$_POST["condition"]."'";*/


  $sql = "INSERT INTO bid (bidPrice, userID, productID, bidDate)
  VALUES ('".$_POST["bidPrice"]."', '$userID', '$productID_page', '$date')";

$sql2 = "SELECT userID, bidPrice, date_format(bidDate, '%d-%m-%Y') bidDate FROM bid ORDER BY YEAR(enddate) ASC, MONTH(enddate) ASC, DAY(enddate) ASC";

   $result = $conn->query($sql2);

  /*$sql = "INSERT INTO product (category, productName, productInfo, productImage, endDate, reservePrice, userID, quantity, conditions)
  VALUES ('".$_POST["category"]."', '".$_POST["productName"]."', '".$_POST["productInfo"]."', LOAD_FILE('".$_POST["productImage"]."'), '".$_POST["endDate"]."',
  '".$_POST["reservePrice"]."', '$userID', '".$_POST["quantity"]."', '".$_POST["condition"]."')";*/

  if ($conn->query($sql2) === TRUE) {
    //echo "Bid added successfully!";
    


    while ($row = mysqli_fetch_assoc($result)) {          
        //echo "<img src='picture/".$row2["productImage"]."' width='300' height='300'/>";
        //echo "<img src = '".base64_encode($row2["productImage"])."' width='300' height='300'/>";
        
        //$_SESSION['productID'] = $row['productID'];
        //$productID = $_SESSION['productID'];
        
        echo '
       
          
            <tr>
            <td>'.$row["bidPrice"].'</tb> 
            <td>'.$row["userID"].'</td>
            <td>'.$row["bidDate"].'</td>
            <br>
            <br>
            <br>
            <br>
          </tr>
          
            ';
       
            //$_SESSION['productID'] = $row['productID'];
            //$productID = $_SESSION['productID'];
            //echo $productID ;



              }



         echo "<a href='auctionDetails.php?id= $productID_page ' class='w3-third w3-container' style='background-color:black; width:9%; color:white'><b> Go back to Auction Details<b></a> 
              ";




} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}

  //}
  
  
}



 ?> 

 