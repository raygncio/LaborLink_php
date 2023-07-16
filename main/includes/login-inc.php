<?php

if(isset($_POST['submit'])) {
    $email_add = $_POST['email'];
    $pw = $_POST['password'];

    require_once "../includes/config.php";
    require_once "../includes/functions.php";

    if(emptyInputLogin($user_name, $pw) !== false ) {
      header("Location: ../login.php?error=missinginputs");
      exit();
    }

    loginUser($conn, $email_add, $pw);
} else {
    header("Location: ../login.php");
    exit();
}

?>