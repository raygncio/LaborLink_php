<?php

    function accDetailsTaken() {
    
    include "../config.php";

    $sql = "SELECT email_add, username FROM users";

    $verify_result = $conn->query($sql);

        if ($verify_result->num_rows > 0) {
            while ($row = $verify_result->fetch_assoc()) {
                if ($row['email_add'] == $_POST['emailAdd'] || $row['username'] == $_POST['userName']) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

?>