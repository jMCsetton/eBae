<?php 
session_start();
ob_start();
if (!isset($_SESSION['logged_in'])) {
	header ('Location: index.php');
}

require 'config.php';
$conn =  new mysqli($host, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }

$_SESSION['productID_page'] = $_GET['id'];
$userID = $_SESSION['userID'];
$traffic_date = date("Y/m/d");

$productID_page = $_SESSION['productID_page'];

$sql3 = "INSERT INTO viewingtraffic (userID, productID, dateVisited) VALUES ( '$userID', '$productID_page','$traffic_date')";
if ($conn->query($sql3) === TRUE) {
  //echo "date added successfully!";
} else {
  echo "Error: " . $sql3 . "<br>" . $conn->error;
}

$sql = "SELECT p.productImage, p.userID, p.productName, p.reservePrice, date_format(p.enddate, '%d-%m-%Y') enddate, p.category, p.quantity, p.conditions, p.productInfo,
  (select case when rating is not NULL then rating
  ELSE 'User not rated yet'
  END) rating2
FROM product p
  left outer join
    (SELECT ROUND(avg(rating),2) as rating, userRatedID
    FROM feedback
    GROUP BY userRatedID) f on p.userID = f.userRatedID
where p.productID = $productID_page";

$result = $conn->query($sql);

if ($conn->query($sql2) === TRUE) {
  //echo "date added successfully!";
} else {
  //echo "Error: " . $sql2 . "<br>" . $conn->error;
}

$sql2 = "SELECT b.userID, b.bidPrice, date_format(b.bidDate, '%d-%m-%Y') bidDate, u.username,
 rt.rating,
  (select case when rating is not NULL then rating
  ELSE 'User not rated yet'
  END) rating2
FROM bid b
  left join user u on b.userID = u.userID
  left outer join
    (SELECT ROUND(avg(rating),2) as rating, userRatedID
    FROM feedback
    GROUP BY userRatedID) rt
    on rt.userRatedID = b.userID
where productID = $productID_page
ORDER BY bidPrice DESC";

$result2 = $conn->query($sql2);

if ($conn->query($sql2) === TRUE) {
  //echo "date added successfully!";
} else {
  //echo "Error: " . $sql2 . "<br>" . $conn->error;
}

$sql4 = "SELECT productID, MAX(bidPrice) AS bidPriceHighest, date_format(bidDate, '%d-%m-%Y') bidDate
FROM bid
WHERE productID = $productID_page";

if ($conn->query($sql4) === TRUE) {
  echo "bid found successfully!";
} else {
  //echo "Error: " . $sql4 . "<br>" . $conn->error;
}

$result4 = $conn->query($sql4);
$row4 = mysqli_fetch_assoc($result4);
//echo $row4['bidPriceHighest'];

$sql5 = "SELECT productID, userID
FROM watchlist
WHERE productID = $productID_page
and userID = $userID;";

if ($conn->query($sql5) === TRUE) {
  echo "bid found successfully!";
} else {
 // echo "Error: " . $sql5 . "<br>" . $conn->error;
}

$result5 = $conn->query($sql5);
$row5 = mysqli_fetch_assoc($result5);
$count5 = mysqli_num_rows($result5);

?>

<html>
<title>eBae</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <!--img src="/w3images/avatar_g2.jpg" style="width:45%;" class="w3-round"><br><br-->
    <h4><b>eBae</b></h4>
  </div>
  <div class="w3-bar-block">
    
  <a href="myAuctionsPage.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>MY AUCTIONS</a> 
  <a href="homepage.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>LIVE AUCTIONS</a> 
  <a href="bidPage.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>MY BIDS</a>
  <a href="createAuction.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>CREATE AUCTION</a>
  <a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding" style="color: #ff0000"><i class="fa fa-close fa-fw w3-margin-right"></i>Log Out</a>
</div>
  <div class="w3-panel w3-large">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">
    <a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1><b>Welcome to eBae!</b></h1>
    <h2><b>Showing all live auctions</b></h2>
    <div class="w3-section w3-bottombar w3-padding-16">
      
    </div>
    </div>
  </header>
  
  <!-- Live Auctions -->
  <div class="w3-container">
  <form action  = "sendBidtoDB.php" method="post" name="bidForm" onsubmit="return validateForm()">
                                    <label style="color: #B33C12"></label>
                                    <input type="text" name = "bidPrice"  class="form-control" style="background-color: #e5e5e5" placeholder="Enter bid here"/>

                
                                    <button class="btn btn-danger btn-block btn-round" name = "Bid"/>Bid</button>
                                    <!--input type = "submit" value = " Submit "/><br /-->
                                   
                               </form>
  <?php
        ob_start();
        // Fetching data from database
        //header("Content-type: image/png"); 
      $row = mysqli_fetch_assoc($result);   
    
          //echo "<img src='picture/".$row2["productImage"]."' width='300' height='300'/>";
          //echo "<img src = '".base64_encode($row2["productImage"])."' width='300' height='300'/>";
          echo '<br><img src="data:image/jpeg;base64,'.base64_encode( $row["productImage"] ).'" style="width:30%; height:30%" class="w3-third w3-container"/>';
          echo '
            <div style= "bg-colour:white" class="w3-twothird w3-container">
              <h1>'.$row["productName"].'</h1>
              <label>Reserve Price: £'.$row["reservePrice"].'</label> 
              <br><label>End Date: '.$row["enddate"].'</label>
              <br><label>Category: '.$row["category"].'</label>
              <br><label>Quantity: '.$row["quantity"].'</label>
              <br><label>Condition: '.$row["conditions"].'</label>
              <br><label>Description: '.$row["productInfo"].'</label>
              <br><label>Seller Rating: '.$row["rating2"].'/5</label>
              <br>
              <br>
            </div>
            
              ';

              if ($count5 < 1 ){
                echo "<a href='addToWatchlist.php?id=".$row['productID']."' class='w3-third w3-container' style='background-color:black; width:9%; color:white'><b>Add to Watchlist<b></a> 
                ";
                }
				
				?>
        </div>


<!-- Submitted bids -->
<div class="table-responsive" style="width: 80%">
			<table id="bid_data" class="table table-striped table-bordered">
				<thead>
					<tr>
            <th>Bid Price</th>
            <th>Username</th>
            <th>Bidder Rating</th>
            <th>Bid Date</th>


				</tr>
				</thead>
				<?php
        // Fetching data from database
        
       //$row2 = mysqli_fetch_array($result2);
       while ($row2 = mysqli_fetch_assoc($result2)) {          
        
           
                   echo '
                  
                     
                       <tr>
                       <td>£'.$row2["bidPrice"].'</td>  
                       <td>'.$row2["username"].'</td>
                       <td>'.$row2["rating2"].'</td>
                       <td>'.$row2["bidDate"].'</td>
                     </tr>
                     
                       ';
   
           
           
           
                         }

				?>
        <tbody>
				</tbody>

			</table>
 
  </div>
  </div>

  <!-- This script is to get data from mysql -->
	<script class = "notfirst" type="text/javascript" language="javascript">
		$(document).ready(function() {

			// Activate DataTable plugin to enable datatable features
			$('#bid_data').DataTable();
		});

	 </script>
  
  <div class="w3-black w3-center w3-padding-24">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></div>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}


function validateForm() {
    var x = document.forms["bidForm"]["bidPrice"].value;
    var y = "<?php echo $row4['bidPriceHighest'] ?>"; 
    var current_userID=  "<?php echo $userID?>"; 
    var product_userID = "<?php echo $row['userID'] ?>"; 
    x = parseFloat(x)
    
    if (current_userID==product_userID ){
      alert("You cannot bid on your own auction!");
      return false;
    }
    else if(isNaN(x))
    {
      alert("Please choose a valid bid price");
      return false;
        
    } else if(x<=0.00) {
      alert("Please choose a valid bid price greater than 0");
      return false;
    } else if(x<=y) {
      alert("Please choose a valid bid price greater than the current highest bid");
      return false;
    }
    } 
</script>

</body>
</html>


