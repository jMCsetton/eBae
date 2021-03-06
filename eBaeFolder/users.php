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

  $sql = "SELECT username, firstName, lastName, email_ID, role
          FROM user
          ORDER BY role";

  $result = $conn->query($sql);


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

 
  
 <div class="topPicks" style="font-size: 25px; font-weight: bold; padding-left: 30px;">
  <h1>List of accounts registered with eBae:</h1>
 </div>
  
  <div class="w3-container">
 <div class="table-responsive" style="width: 80%">
      <table id="bid_data" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>


        </tr>
        </thead>
        <?php
        // Fetching data from database
        
       //$row2 = mysqli_fetch_array($result2);
       while ($row = mysqli_fetch_assoc($result)) {          
        
           
                   echo '
                  
                     
                       <tr>
                       <td>'.$row["username"].'</td>  
                       <td>'.$row["firstName"].'</td>
                       <td>'.$row["lastName"].'</td>
                       <td>'.$row["email_ID"].'</td>
                       <td>'.$row["role"].'</td>
                     </tr>
                     
                       ';
   
           
           
           
                         }

        ?>
        

      </table>
 
  
  </div>
  
  




      

  
  <div class="w3-black w3-center w3-padding-24">Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-opacity">w3.css</a></div>

<!-- End page content -->
</div>


</body>
</html>


