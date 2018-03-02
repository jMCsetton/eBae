<?php
/* 
This function implements log out process by 
unsetting and destroying session variables 
*/
session_start();
session_unset();
session_destroy(); 
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Logout</title>
</head>

<body>
    <div class="form">
          <h1>Thank you for visiting eBae</h1>
              
          <p><?= 'You have successfully logged out!'; ?></p>
          
          <a href="index.php"><button class="button button-block"/>Home</button></a>

    </div>
</body>
</html>