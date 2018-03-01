<?php
/* 
    This function implements user login process by 
    checking if user exists and password is correct 
*/



// Escape email to protect against SQL injections
//$email = $conn->escape_string($_POST['email']);
$result = $conn->query("SELECT * FROM users WHERE username='$username'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that username does not exist!";
   //header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();
    echo "user exists";
    if ( password_verify($_POST['password'], $user['password']) ) {
        
        // Setting up session variables
       // $_SESSION['doctor_id'] = $user['doctor_id'];
        //$_SESSION['email'] = $user['email'];
        //$_SESSION['first_name'] = $user['first_name'];
        //$_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];
        
        // Set logged_in variable to true to allow going to next page without loggin in again
        $_SESSION['logged_in'] = true;

        if ($_SESSION['active'] == 0){
            mysqli_close($conn);
            header("location: index.php");
        } else {
            mysqli_close($conn);
            header("location: homepage.php");
        }
        
    }
    else {
        // Prompt to error page in case of wrong password
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}
?>