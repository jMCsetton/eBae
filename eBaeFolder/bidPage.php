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

  $userID = $_SESSION['userID'];

  $sql = "select
  p2.productName, p2.productid, a.bidid, p2.reservePrice, a.bidPrice as userPrice,maxbid.maxprice winningprice, a.userID ,  date_format(a.bidDate, '%d-%m-%Y') bidDate, date_format(p2.enddate, '%d-%m-%Y') enddate,
  (select case when r.productid is not NULL and p2.endDate < curdate() then 'Yes'
           when r.productid is NULL and p2.endDate < curdate() then 'No'
           when p2.enddate >= curdate() then 'Auction Still Open'
   end) YorN
from
  bid a
left outer join
  (select auctionPrice, c.userID, c.productID  from auction c) r
on r.productID = a.productID
and  r.auctionPrice = a.bidPrice
join product p2 ON a.productID = p2.productID
join (SELECT MAX(bidPrice) AS maxprice, productID
  FROM bid
  GROUP BY productID) maxbid on maxbid.productID = a.productID
where a.userID = $userID 
order by a.bidDate, p2.productName, userPrice";

  
    $result = $conn->query($sql);


   /*$sql2 = "SELECT productID, MAX(bidPrice) AS bidPriceHighest, date_format(bidDate, '%d-%m-%Y') bidDate
   FROM bid
   WHERE userID = $userID
   GROUP BY productID
  ORDER BY bidDate ASC";

$result2 = $conn->query($sql2);*/

if ($conn->query($sql) === TRUE) {
    //echo "date added successfully!";
  } else {
    //echo "Error for sql: " . $sql . "<br>" . $conn->error;
  }
  /*if ($conn->query($sql2) === TRUE) {
    //echo "date added successfully!";
  } else {
    echo "Error for sql2: " . $sql2 . "<br>" . $conn->error;
  }*/

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
    <a href="watchlist.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>WATCHLIST</a>
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
    <h2><b>Showing all your bids</b></h2>
    <div class="w3-section w3-bottombar w3-padding-16">

      </div>
    </div>
  </header>
  
  <!-- My Bids -->
  <div class="table-responsive" style="width: 100%">
			<table id="bid_data" class="table table-striped table-bordered">
				<thead>
					<tr>
            <th>Product Name</th>
            <th>Bid Date</th>
            <th>Reserve Price</th>
						<th>My Bid&nbsp&nbsp</th>
            <th> Highest/Winning Bid</th>
            <th> End Date </th>
            <th> Winning Bid? </th>
            <th> Rate User </th>

				</tr>
				</thead>
				<?php
        // Fetching data from database
        
       //$row2 = mysqli_fetch_array($result2);
		while( $row = mysqli_fetch_array($result)) { 

      $productIDfromRow = $row["productid"];

  $sql3 = "SELECT raterID, productID FROM feedback WHERE raterID = $userID  AND productID = $productIDfromRow";
  $result3 = $conn->query($sql3);
  $row3 = mysqli_fetch_array($result3);
  $count3 = mysqli_num_rows($result3); 

  if ($conn->query($sql3) === TRUE) {
    //echo "date added successfully!";
  } else {
    //echo "Error for sql3: " . $sql3. "<br>" . $conn->error;
  }

					echo '
          <tr>
             <td>'.$row["productName"].'</td>
             <td>'.$row["bidDate"].'</td>
             <td>&nbsp&nbsp&nbsp£'.$row["reservePrice"].'</td>
             <td>£'.$row["userPrice"].'</td> 
             <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp£'.$row["winningprice"].'</td> 
             <td>'.$row["enddate"].'</td> 
             <td>'.$row["YorN"].'</td> 
             '; 
             if($row["YorN"] == 'No') {
              echo '<td>Not Applicable</td> </tr>';
            }else if($count3>0){
              echo '<td>Already rated</td> </tr>';
             } else if ($row["YorN"] == 'Yes') {
              echo "<td><a href='giveSellerFeedback.php?id=".$row['productid']."' class='w3-third w3-container' style='background-color:black; width:50%; color:white'><b>Rate User<b></a> 
              </td> </tr>";

             } else{
              echo '<td>Not Applicable</td> </tr>';
             }
    
          
					//echo '</tr>';
          
        
				}
				?>
				<tbody>
				</tbody>
				<!-- Include footer repeating column headers -->

			</table>
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
</script>

</body>
</html>


