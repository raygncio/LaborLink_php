<?php

function emptyInputSignup($first_name, $last_name, $dob, $sex, $street_add,
    $state, $city, $zipcode, $specialization, $employment_type, $employer,
    $valid_id, $cert, $email_add, $username, $phone_number, $password) {
       
        if(empty($first_name) || empty($last_name) || empty($dob) || empty($sex) ||
        empty($street_add) || empty($state) || empty($city) || empty($zipcode) ||
        empty($specialization) || empty($employment_type) || empty($employer) ||
        empty($valid_id) || empty($cert) || empty($email_add) || empty($username) ||
        empty($phone_number) || empty($password) ) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

function invalidUid($username) {       
        //preg_match is a search algo
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

function pwdMatch($password, $passwordConfirm) {       
        
        if($password !== $passwordConfirm) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

function uidExists($conn, $username, $email_add) {   

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
        mysqli_stmt_bind_param($stmt, "ss", $username, $email_add);
        mysqli_stmt_execute($stmt);

        //result set
        $resultData = mysqli_stmt_get_result($stmt);

        //fetch data as an associative array
        //returns true if it gets any data
        //if true or username/email exists, 
        //it'll grab these data and redirect to login
        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;

        } else {
            $result = false;
            return $result;
        }
        
        mysqli_stmt_close($stmt);
    }

function getUserId($conn, $username) {

    //oop
    $sql = "SELECT username, user_id FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        if ($row['username'] == $username) {
          return $row['user_id'];
        } 
      }
    }

}

function createUser($conn, $user_role, $first_name, $last_name, $middle_name, $suffix_name, $dob, 
    $sex, $street_add, $state, $city, $zipcode, $email_add, $username, $phone_number, $password, $status) {   

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
                    );";

        $stmt = mysqli_stmt_init($conn); //initialize prep stmt

        //catch sql error
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: choose-roles.php?error=stmtfailed");
            exit();
        }

        //encrypting or hashing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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
        $username,
        $phone_number,
        $hashedPassword,
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
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

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
?>