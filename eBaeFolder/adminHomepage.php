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

//$sql = "SELECT productImage, productName, reservePrice, date_format(enddate, '%d-%m-%Y') enddate, category, quantity, conditions, productInfo, productID FROM product ORDER BY YEAR(enddate) ASC, MONTH(enddate) ASC, DAY(enddate) ASC";

$sql = "SELECT productImage, productName, reservePrice, date_format(enddate, '%d-%m-%Y') enddate, category, quantity, conditions, productInfo, productID
FROM product
WHERE enddate >= CURDATE()
ORDER BY YEAR(enddate) ASC, MONTH(enddate) ASC, DAY(enddate) ASC";

$sqlJA = "SELECT viewingtraffic.productID, COUNT(viewingtraffic.productID) AS trafficFrequencyPerItem, product.productImage, product.productName
FROM product, viewingtraffic
WHERE viewingtraffic.productID = product.productID
GROUP BY viewingtraffic.productID
ORDER BY trafficFrequencyPerItem desc
LIMIT 5 ";


$result = $conn->query($sql);
$resultJA = $conn->query($sqlJA);


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
   
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1><b>Welcome to eBae Admin!</b></h1>
    <h2><b>Showing all live auctions</b></h2>
    <div class="w3-section w3-bottombar w3-padding-16">
      <!--span class="w3-margin-right">Filter:</span> 
      <a href = "adminHomepage.php" class="w3-button w3-black">All</a>
      <a href = "AappsGames.php" class="w3-button w3-white"><i class="fa fa-gamepad w3-margin-right"></i>Apps and Games</a>
      <a href = "Abeauty.php" class="w3-button w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Beauty</a>
      <a href = "Abooks.php" class="w3-button w3-white w3-hide-small"><i class="fa fa-book w3-margin-right"></i>Books</a>
      <a href = "Aclothing.php" class="w3-button w3-white w3-hide-small"><i class="fa fa-users w3-margin-right"></i>Clothing</a>
      <a href = "Aelectronics.php" class="w3-button w3-white w3-hide-small"><i class="fa fa-laptop w3-margin-right"></i>Electronics</a>
      <a href = "Ahome.php" class="w3-button w3-white w3-hide-small"><i class="fa fa-home w3-margin-right"></i>Home</a>
      <a href = "Amusic.php" class="w3-button w3-white w3-hide-small"><i class="fa fa-music w3-margin-right"></i>Music</a>
      <a href = "Amiscellaneous.php" class="w3-button w3-white w3-hide-small"><i class="fa fa-diamond w3-margin-right"></i>Miscellaneous</a-->
    </div>
    </div>
  </header>

  <!-- search function -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myDIV #div2").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
  
  <!-- Live Auctions -->
  <input id="myInput" type="text" placeholder="Search for items.." class="w3-third w3-container" style = "position: relative;
    left:20px;"><br><br>
  <div class="topPicks" style="font-size: 25px; font-weight: bold; padding-left: 30px;">
  <h1>Live Auctions:</h1>
 </div>
  <div class="w3-container" id="myDIV">
 <form action="deletephp.php" method="post"> 
  <?php
        ob_start();
        // Fetching data from database
        //header("Content-type: image/png"); 
       
        while ($row = mysqli_fetch_assoc($result)) {          
          //echo "<img src='picture/".$row2["productImage"]."' width='300' height='300'/>";
          //echo "<img src = '".base64_encode($row2["productImage"])."' width='300' height='300'/>";
          //echo '<img src="data:image/jpeg;base64,'.base64_encode( $row["productImage"] ).'" style="width:30%; height:30%" class="w3-third w3-container"/>';
          $_SESSION['productID'] = $row['productID'];
          $productID = $_SESSION['productID'];
          
          //   echo "<a id=".$row['productID']."' class='w3-third w3-container' style='background-color:black; width:9%; color:white name='delete'><b>Delete<b></a> 
          // ";
          echo '
          <div id = "div2">
          <img src="data:image/jpeg;base64,'.base64_encode( $row["productImage"] ).'" style="width:30%; height:30%" class="w3-third w3-container" />
            <div style= "bg-colour:white" class="w3-twothird w3-container">
            <td><a href="deletephp.php?id='.$row["productID"].'" type="submit" name="submit" class="btn btn-danger btn-block btn-round" onClick="return confirm(\'You are about to delete this product, press OK to continue:\')";>Delete</a>

              <h1>'.$row["productName"].'</h1>
              <label>Reserve Price: £'.$row["reservePrice"].'</label> 
              <br><label>End Date: '.$row["enddate"].'</label>
              <br><label>Category: '.$row["category"].'</label>
              <br><label>Quantity: '.$row["quantity"].'</label>
              <br><label>Condition: '.$row["conditions"].'</label>
              <br><label>Description: '.$row["productInfo"].'</label>
              <br>
              <br>
              <br>
              <br>
            </div>
            </div>
            
              ';
         
              //$_SESSION['productID'] = $row['productID'];
              //$productID = $_SESSION['productID'];
              //echo $productID ;



        }


        ?>
        </form>
  <!--form action="" method="post" enctype="multipart/form-data" >
      <div class="w3-section">
        <label>Item Name</label>
        <input class="w3-input w3-border" type="text" name="productName" required/>
      </div>
      <div class="w3-section">
        <label>Quantity</label>
        <input class="w3-input w3-border" type="text" name="quantity" required/>
      </div>
      <div class="w3-section">
        <label>Item Category</label>
        <input class="w3-input w3-border" type="text" name="categories" required/>
      </div>
  </form-->
  </div>
  <div> 
  </div>
  
<div class="topPicks" style="font-size: 25px; font-weight: bold; padding-left: 30px;">
 <h1>Our current top picks:</h1>
 </div>
 <div style="overflow-x: scroll; overflow: auto; overflow-y: hidden; white-space: nowrap;">

 <?php
        ob_start();

        while ($row = mysqli_fetch_assoc($resultJA)) {
        ?>

         <div style="display: inline-block; white-space: nowrap;">
           <figure>
           <div class="image" style="display: inline; float:left;">
             <?php
           echo '<img src="data:image/jpeg;base64,'.base64_encode( $row["productImage"] ).'" style=" width:150px; height:22%; vertical-align: top; class="w3-container"/>';
           ?>
           </div>
           <figcaption style="font-weight:bold; width:100px; word-wrap:break-word; text-align: center;">
             <?php
          $_SESSION['productID'] = $row['productID'];
          $productID = $_SESSION['productID'];
          echo "<a' class=' w3-container'><b>".$row["productName"]."</b> </a> 
          ";
          echo '<div>
              <label>Number of views: '.$row["trafficFrequencyPerItem"].'</label>         
              <br>
            </div>
              ';
              //$_SESSION['productID'] = $row['productID'];
              //$productID = $_SESSION['productID'];
              //echo $productID ;
              ?>
            </figcaption>
        </figure>
        </div>
       

<?php
}
?>

</div>


       

  
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


