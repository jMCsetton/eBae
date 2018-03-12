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

  $sql = "SELECT p.userID AS seller, b.userID as bidder, b.bidPrice,  date_format(b.bidDate, '%d-%m-%Y') bidDate, date_format(p.endDate, '%d-%m-%Y') endDate, p.productName, u.username as bidderUsername, p.reservePrice
  FROM product p, user u, bid b
  WHERE p.userID = $userID
  AND p.productID = b.productID
  AND b.userID = u.userID
  ORDER BY b.productID ASC";
  
     $result = $conn->query($sql);

/*$sql2 = "SELECT p.productName, p.userid as sellerid, u.username  sellername, date_format(p.endDate, '%d-%m-%Y') endDate, p.reservePrice,
  (select case when a.userID is not NULL then a.userid
          else 'Auction Still Open'
   end) buyerid,
  (select case when a.auctionPrice is not NULL then a.auctionPrice
          else 'Auction Still Open'
   end) auctionprice,
    (select case when u2.userID is not NULL then u2.username
          else 'Auction Still Open'
   end) buyername
FROM product p
left join user u on p.userID = u.userID
left outer join auction a on p.productID = a.productID
  left join user u2 on a.userID = u2.userID
WHERE p.userID = $userID";*/


$sql2 = "SELECT p.productName, p.productid, p.userid as sellerid, u.username  sellername, date_format(p.endDate, '%d-%m-%Y') endDate, p.reservePrice,
(select case when a.userID is not NULL and p.endDate < curdate() then a.userid
         when a.userID is NULL and p.endDate < curdate() then 'Not sold'
        else 'Auction Still Open'
 end) buyerid,
(select case when a.auctionPrice is not NULL and p.endDate < curdate() then a.auctionPrice
         when a.auctionPrice is NULL and p.endDate < curdate() then 'Not sold'
        else 'Auction Still Open'
 end) auctionprice,
  (select case when u2.userID is not NULL  and p.endDate < curdate()then u2.username
        when u2.userID is NULL and p.endDate < curdate() then 'Not sold'
        else 'Auction Still Open'
 end) buyername,
 (select case when v.traffic_count is not NULL then v.traffic_count
        else '0'
    end) traffic_count
FROM product p
left join user u on p.userID = u.userID
left outer join auction a on p.productID = a.productID
left join user u2 on a.userID = u2.userID
left outer join (SELECT productID, count(traffic_counter) as traffic_count
FROM viewingtraffic GROUP BY productID) v on p.productID = v.productID
WHERE p.userID = $userID
ORDER BY YEAR(enddate) ASC, MONTH(enddate) ASC, DAY(enddate) ASC";

$result2 = $conn->query($sql2);

if ($conn->query($sql) === TRUE) {
    //echo "date added successfully!";
  } else {
    //echo "Error for sql: " . $sql . "<br>" . $conn->error;
  }
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
    <img src="/w3images/avatar_g2.jpg" style="width:45%;" class="w3-round"><br><br>
    <h4><b>eBae</b></h4>
    <p class="w3-text-grey">Template by W3.CSS</p>
  </div>
  <div class="w3-bar-block">
    
    <a href="#portfolio" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>MY AUCTIONS</a> 
    <a href="homepage.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>LIVE AUCTIONS</a> 
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>MY BIDS</a>
    <a href="createAuction.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>CREATE AUCTION</a>
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>WATCHLIST</a>
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
    <h2><b>Showing all your auctions</b></h2>
    <div class="w3-section w3-bottombar w3-padding-16">

      </div>
    </div>
  </header>
  
  <!-- Auction Progress -->
<div class="table-responsive" style="width: 80%">
<h2> Progress of Auctions: </h2>
			<table id="auction_progress" class="table table-striped table-bordered">
				<thead>
					<tr>
            <th>Product Name</th>
            <th>Reserve Price</th>
            <th>Bidder Username</th>
            <th>Bid Price</th>
            <th>Bid Date</th>
            <th>End Date</th>


				</tr>
				</thead>
				<?php
        // Fetching data from database
        
       //$row2 = mysqli_fetch_array($result2);
       while ($row = mysqli_fetch_assoc($result)) {          
        
           
                   echo '
                  
                     
                       <tr>
                       <td>'.$row["productName"].'</td> 
                       <td>'.$row["reservePrice"].'</td>
                       <td>'.$row["bidderUsername"].'</td>
                       <td>'.$row["bidPrice"].'</td>
                       <td>'.$row["bidDate"].'</td>
                       <td>'.$row["endDate"].'</td>
                     </tr>
                     
                       ';
   
           
           
           
                         }

				?>
        <tbody>
				</tbody>

			</table>
 
  </div>

  <div class="w3-section w3-bottombar w3-padding-16">

      </div>

      <div class="table-responsive" style="width: 80%">
    <h2> Selling Activity: </h2>
			<table id="selling_activity" class="table table-striped table-bordered">
				<thead>
					<tr>
            <th>Product Name</th>
            <th>End Date</th>
            <th>Viewing Traffic</th>  
            <th>Reserve Price</th>
            <th>Auction Price</th>
            <th>Bidder Username</th> 
            <th> Rate User </th>     


				</tr>
				</thead>
				<?php
        // Fetching data from database
        
       //$row2 = mysqli_fetch_array($result2);
       while ($row2 = mysqli_fetch_assoc($result2)) {          
        
           
                   echo '
                  
                     
                       <tr>
                       <td>'.$row2["productName"].'</td> 
                       <td>'.$row2["endDate"].'</td>
                       <td>'.$row2["traffic_count"].'</td>
                       <td>'.$row2["reservePrice"].'</td>
                       <td>'.$row2["auctionprice"].'</td>
                       <td>'.$row2["buyername"].'</td>
                     
                       ';
                       if ($row2["buyername"] == 'Auction Still Open') {
                        echo '<td>Not Applicable</td> </tr>';
          
                       } else if ($row2["buyername"] == 'Not sold') {
                        echo '<td>Not Applicable</td> </tr>';
                       } 
                       else {
                         
                         echo "<td><a href='giveSellerFeedback.php?id=".$row2['productid']."' onclick='afterClick(this);' class='w3-third w3-container' style='background-color:black; width:50%; color:white'><b>Rate User<b></a> 
                        </td> </tr>";
                       }
           
           
           
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
			$('#auction_progress').DataTable();
		});

	 </script>

     <!-- This script is to get data from mysql -->
	<script class = "notfirst" type="text/javascript" language="javascript">
		$(document).ready(function() {

			// Activate DataTable plugin to enable datatable features
			$('#selling_activity').DataTable();
		});

   function afterClick(link) {
     // disable subsequent clicks
     link.onclick = function(event) {
        event.preventDefault();
     }
   }   

	 </script>

  <!-- Footer -->
  <footer class="w3-container w3-padding-32 w3-dark-grey">
  <div class="w3-row-padding">
    <div class="w3-third">
      <h3>FOOTER</h3>
      <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
    </div>
  
    <div class="w3-third">
      <h3>BLOG POSTS</h3>
      <ul class="w3-ul w3-hoverable">
        <li class="w3-padding-16">
          <img src="/w3images/workshop.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Lorem</span><br>
          <span>Sed mattis nunc</span>
        </li>
        <li class="w3-padding-16">
          <img src="/w3images/gondol.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Ipsum</span><br>
          <span>Praes tinci sed</span>
        </li> 
      </ul>
    </div>

    <div class="w3-third">
      <h3>POPULAR TAGS</h3>
      <p>
        <span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">London</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">DIY</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Family</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Shopping</span>
        <span class="w3-tag w3-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Games</span>
      </p>
    </div>

  </div>
  </footer>
  
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


