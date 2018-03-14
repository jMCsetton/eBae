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

  $sql = "SELECT date_format(date, '%d-%m-%Y') date,
  (SELECT CASE WHEN auctionStatus = 1 then 'Done'
  ELSE 'Not Done'
  END) auctionDone,
  (SELECT CASE WHEN buyerNotificationsSent = 1 then 'Done'
  ELSE 'Not Done'
  END) bNotiDone,
  (SELECT CASE WHEN sellerNotificationsSent = 1 then 'Done'
  ELSE 'Not Done'
  END) sNotiDone
FROM system;";

  
    $result = $conn->query($sql);


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
    <!--img src="/w3images/avatar_g2.jpg" style="width:45%;" class="w3-round"><br><br-->
    <h4><b>eBae</b></h4>
    <p class="w3-text-grey">Template by W3.CSS</p>
  </div>
  <div class="w3-bar-block">
    
  <a href="adminRegistration.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>CREATE NEW ADMIN ACCOUNT</a> 
    <a href="adminHomepage.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>LIVE AUCTIONS</a> 
    <a href="adminAllAuctions.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>ALL AUCTIONS</a> 
     <a href="users.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>VIEW ALL USERS</a> 
     <a href="adminViewSystem.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>VIEW SYSTEM</a> 
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
            <th>Date</th>
            <th>Auction's Closed?</th>
            <th>Buyer Notifications Sent?</th>
			<th>Seller Notifications Sent?</th>

				</tr>
				</thead>
				<?php
        // Fetching data from database
        
       //$row2 = mysqli_fetch_array($result2);
		while( $row = mysqli_fetch_array($result)) { 

					echo '
          <tr>
            <td>'.$row["date"].'</td> 
            <td>'.$row["auctionDone"].'</td>
            <td>'.$row["bNotiDone"].'</td>
            <td>'.$row["sNotiDone"].'</td>

             </tr>
             '; 
          
        
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


