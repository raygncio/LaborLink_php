<?php

function emptyInputSignup($first_name, $last_name, $dob, $sex, $street_add,
    $state, $city, $zipcode, $specialization, $employment_type, $employer,
    $valid_id, $cert, $email_add, $user_name, $phone_number, $pw) {
       
        if(empty($first_name) || empty($last_name) || empty($dob) || empty($sex) ||
        empty($street_add) || empty($state) || empty($city) || empty($zipcode) ||
        empty($specialization) || empty($employment_type) || empty($employer) ||
        empty($valid_id) || empty($cert) || empty($email_add) || empty($user_name) ||
        empty($phone_number) || empty($pw) ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

function invalidUid($user_name) {       
        //preg_match is a search algo
        if(!preg_match("/^[a-zA-Z0-9]*$/", $user_name)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

function pwdMatch($pw, $password_confirm) {       
        
        if($pw !== $password_confirm) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

function uidExists($conn, $user_name, $email_add) {   

        $sql = "SELECT * FROM users WHERE username = ? OR email_add = ?; ";
        $stmt = mysqli_stmt_init($conn); //initialize prep stmt

        //catch sql error
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: choose-roles.php?error=stmtfailed");
            exit();
        }

        //to avoid sql injections!
        //ss means 2strings (e.g. sss means 3)
        //bind the data from the user to the statement (?, ?)
        mysqli_stmt_bind_param($stmt, "ss", $user_name, $email_add);
        mysqli_stmt_execute($stmt);

        //result set
        $resultData = mysqli_stmt_get_result($stmt);


        if(mysqli_num_rows($resultData) > 0) {
            $result = true;
            return $result;

        } else {
            $result = false;
            return $result;
        }
        
        mysqli_stmt_close($stmt);
    }

function getUserId($conn, $user_name) {

    //oop
    $sql = "SELECT username, user_id FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        if ($row['username'] == $user_name) {
          return $row['user_id'];
        } 
      }
    }

}

function createUser($conn, $user_role, $first_name, $last_name, $middle_name, $suffix_name, $dob, 
    $sex, $street_add, $state, $city, $zipcode, $email_add, $user_name, $phone_number, $pw, $status) {   

        $sql = "INSERT INTO users (
                    user_role,
                    first_name,
                    last_name,
                    middle_name,
                    suffix,
                    dob,
                    sex,
                    street_address,
                    state,
                    city,
                    zip_code,
                    email_add,
                    username,
                    phone_number,
                    password,
                    status
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                    ;";

        $stmt = mysqli_stmt_init($conn); //initialize prep stmt

        //catch sql error
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: choose-roles.php?error=stmtfailed");
            exit();
        }

        //encrypting or hashing
        $hashed_password = password_hash($pw, PASSWORD_DEFAULT);

        //to avoid sql injection!
        //bind the data from the user to the statement (?, ?)
        mysqli_stmt_bind_param($stmt, "ssssssssssssssss", 
        $user_role,
        $first_name,
        $last_name,
        $middle_name,
        $suffix_name,
        $dob,
        $sex,
        $street_add,
        $state,
        $city,
        $zipcode,
        $email_add,
        $user_name,
        $phone_number,
        $hashed_password,
        $status);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }


    function createLaborer($conn, $application_status, $specialization, $employment_type,
    $employer, $valid_id, $valid_id_proof, $cert, $cert_proof, $user_id) {   

        $sql = "INSERT INTO applications (
            application_status,
            specialization,
            employment_type,
            employer,
            valid_id,
            valid_id_proof,
            certification,
            certification_proof,
            user_id
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?); ";

        $stmt = mysqli_stmt_init($conn); //initialize prep stmt

        //catch sql error
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: choose-roles.php?error=stmtfailed");
            exit();
        }

        //to avoid sql injection!
        //bind the data from the user to the statement (?, ?)
        mysqli_stmt_bind_param($stmt, "sssssssss", 
        $application_status,
        $specialization,
        $employment_type,
        $employer,
        $valid_id,
        $valid_id_proof,
        $cert,
        $cert_proof,
        $user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
    }

    //login
    function emptyInputLogin($email_add, $pw) {
       
        if(empty($email_add) || empty($pw) ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    function loginUser($conn, $email_add, $pw) {

        $sql = "SELECT * FROM users WHERE email_add = ?; ";
        $stmt = mysqli_stmt_init($conn); //initialize prep stmt

        //catch sql error
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=stmtfailed");
            exit();
        }

        //to avoid sql injections!
        //ss means 2strings (e.g. sss means 3)
        //bind the data from the user to the statement (?, ?)
        mysqli_stmt_bind_param($stmt, "s", $email_add);
        mysqli_stmt_execute($stmt);

        //result set
        $resultData = mysqli_stmt_get_result($stmt);


        if($row = mysqli_fetch_assoc($resultData)) {
            $hashed_password = $row['password'];

        } else {
            header("Location: ../login.php?error=accountdoesntexist");
            exit();
        }

        $checked_password = password_verify($pw, $hashed_password);

        if($checked_password === false) {
            header("Location: ../login.php?error=wronglogin");
            exit();
        } else if ($checked_password === true) {
       
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_role'] = $row['user_role'];

            switch($_SESSION['user_role']) {
                case "admin";
                    header("Location: ../admin/user-management.php");
                    exit();
                    break;
                case "customer";
                    header("Location: ../admin/user-management.php"); //to change
                    exit();
                    break;
                case "laborer";
                    header("Location: ../admin/user-management.php"); //to change
                    exit();
                    break;
            }
        }

    }

    // READ

    // access control ---------------------------------------------------------
    function invalidAccess() {
        session_unset();
        session_destroy();
        header("Location: ../index.php?error=invalidaccess");
        exit();
    }

    // admin ------------------------------------------------------------------

    function checkAdmin($user_role) {
        if($user_role !== "admin") {
            invalidAccess();
        } 
    }

    //laborer ----------------------------------------------------------------
    
    function checkLaborer($user_role) {
        if($user_role !== "admin") {
            invalidAccess();
        }
    }

    //customer ---------------------------------------------------------------

    function checkCustomer($user_role) {
        if($user_role !== "customer") {
            invalidAccess();
        }
    }
?>