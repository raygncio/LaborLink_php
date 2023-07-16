<?php

//session start at the very top of each logged in page
session_start();

//check if user is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {

    $url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

    if($_SESSION['user_role']=="admin") {

        if (strpos($url,'admin') !== false) {
            header("Location: ../login.php?error=wronglogin");
            exit();
        } 
        
    } else if ($_SESSION['user_role']=="customer") {
        
    } else if ($_SESSION['user_role']=="laborer") {
        
    } else {

    }
} else {
    //code
}

?>