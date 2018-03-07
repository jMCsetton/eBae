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



  $sql = "INSERT INTO bid (bidPrice, userID, productID, bidDate)
  VALUES ('".$_POST["bidPrice"]."', '$userID', '$productID_page', '$date')";

$sql2 = "SELECT userID, bidPrice, bidDate FROM bid WHERE productID = $productID_page";

   $result = $conn->query($sql2);
  

 
    //echo "Bid added successfully!";
    


    while ($row = mysqli_fetch_assoc($result)) {          
     
        
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




 

  //}
  
  
}



 ?> 

 