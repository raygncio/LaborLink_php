<?php

//session start at the very top of each logged in page
session_start();


//check if user is logged in
if(isset($_SESSION['user_id'])) {
    //code
} else {
    //code
}

?>