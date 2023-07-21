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

            if ($row['status']=="pending"){
                header("Location: ../login.php?error=applicationpending");
                exit();
            } else if ($row['status']=="rejected") {
                header("Location: ../login.php?error=applicationrejected");
                exit();
            }
       
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_role'] = $row['user_role'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['server_url'] = "http://".$_SERVER['HTTP_HOST']."/LaborLink_php/main/";

            switch($_SESSION['user_role']) {
                case "admin";
                    header("Location: ../admin/user-management.php");
                    exit();
                    break;
                case "customer";
                    header("Location: ../client/dashboard/find-laborer.php"); 
                    exit();
                    break;
                case "laborer";
                    header("Location: ../laborer/dashboard/find-labor.php"); 
                    exit();
                    break;
            }
        }

    }

    // ALL

    function getProfile($conn, $user_id, $user_role) {
        if($user_role == "customer") {
            $sql = "SELECT first_name, concat(first_name, ' ' , middle_name, ' ' , last_name, ' ', suffix) AS fullName,
            username, phone_number, email_add
            FROM users 
            WHERE user_id = ?";
            
            $stmt = mysqli_stmt_init($conn); //initialize prep stmt

            //catch sql error
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../profile/laborer-profile.php?error=stmtfailed");
                exit();
            }            
            //to avoid sql injections!
            //ss means 2strings (e.g. sss means 3)
            //bind the data from the user to the statement (?, ?)
            mysqli_stmt_bind_param($stmt, "s", $user_id);
            mysqli_stmt_execute($stmt);

            //result set
            $resultData = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($resultData)) {
                return $row;
    
            } else {
                header("Location: ../login.php?error=accountdoesntexist");
                exit();
            }
            
        } else if($user_role =="laborer") {
            $sql = "SELECT U.first_name, concat(U.first_name, ' ' , U.middle_name, ' ' , U.last_name, ' ', U.suffix) AS fullName,
            U.username, U.phone_number, U.email_add, A.specialization 
            FROM users AS U INNER JOIN applications AS A  ON U.user_id = A.user_id
            WHERE U.user_id = ?";
            
            $stmt = mysqli_stmt_init($conn); //initialize prep stmt

            //catch sql error
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../profile/laborer-profile.php?error=stmtfailed");
                exit();
            }            
            //to avoid sql injections!
            //ss means 2strings (e.g. sss means 3)
            //bind the data from the user to the statement (?, ?)
            mysqli_stmt_bind_param($stmt, "s", $user_id);
            mysqli_stmt_execute($stmt);

            //result set
            $resultData = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($resultData)) {
                return $row;
    
            } else {
                header("Location: ../login.php?error=accountdoesntexist");
                exit();
            }
            
        } 
    }

    function printWelcomeMessage($first_name, $envelope) {
        date_default_timezone_set('Asia/Manila');
        $current_date = date("m-d-Y");
        $current_day = date("l");
        $time = date("H");

        
        if ($time < "12") {
            $current_time = "morning";
        } else if ($time >= "12" && $time < "17") {
            $current_time = "afternoon";
        } else {
            $current_time = "evening";
        } 

        if($envelope == "white") {
            echo "
            <header class='col-12 rounded-4 p-3 oranges white-font'>
                <h2><span>" . $current_date . "</span>&nbsp;&nbsp;<span>". $current_day ."</span></h2>
                <h1 class='display-1 header text-normal'>
                Good <span>". $current_time ."</span>, <span>" . $first_name . "</span>
                </h1>
            </header>
            ";
        } else {
            echo "
            <header class='col-12 rounded-4 p-3 whites orange-font'>
                <h2><span>" . $current_date . "</span>&nbsp;&nbsp;<span>". $current_day ."</span></h2>
                <h1 class='display-1 header text-normal'>
                Good <span>". $current_time ."</span>, <span>" . $first_name . "</span>
                </h1>
            </header>
            ";
        }
    }

    function getRequestProgress($conn, $request_id){
        $sql = "SELECT progress FROM requests
        WHERE request_id = '$request_id'
        ";
        $query_run = mysqli_query($conn, $sql);
        foreach($query_run as $row){
            $progress = $row['progress'];
        }
        return $progress;
    }


    function getHistory($conn, $user_id, $user_role){
        if($user_role == "customer") { 
            $query = "SELECT R.request_id, R.category, R.created_at, 
            R.title, concat(U.first_name, ' ' , U.middle_name, 
            ' ' , U.last_name, ' ', U.suffix) AS fullName, O.suggested_fee 
            FROM requests AS R
            INNER JOIN offers AS O 
            ON R.request_id = O.request_id
            INNER JOIN approved_requests AS AR
            ON AR.request_id = R.request_id
            INNER JOIN laborers AS L
            ON AR.laborer_id = L.laborer_id
            INNER JOIN applications AS A
            ON A.applicant_id = L.applicant_id
            INNER JOIN users AS U
            ON A.user_id = U.user_id                          
            WHERE R.progress = 'completed' AND
            R.user_id = '$user_id';";
            $query_run = mysqli_query($conn, $query); 

        } else if ($user_role == "laborer") {
            $query = "SELECT R.request_id, R.category, R.created_at, 
            R.title, concat(U.first_name, ' ' , U.middle_name, 
            ' ' , U.last_name, ' ', U.suffix) AS fullName, O.suggested_fee 
            FROM requests AS R
            INNER JOIN users AS U
            ON R.user_id = U.user_id
            INNER JOIN offers AS O 
            ON R.request_id = O.request_id
            INNER JOIN approved_requests AS AR
            ON R.request_id = AR.request_id
            INNER JOIN laborers AS L
            ON AR.laborer_id = L.laborer_id                        
            WHERE R.progress = 'completed' 
            AND AR.laborer_id = 
                (SELECT L.laborer_id FROM laborers AS L
                INNER JOIN applications AS A
                ON L.applicant_id = A.applicant_id
                INNER JOIN users AS U
                ON A.user_id = U.user_id
                WHERE U.user_id = '$user_id')
            ";
            $query_run = mysqli_query($conn, $query); 
        }

        return $query_run;

    }

    function checkUserStatus($conn, $user_id) {
        $sql = "SELECT status FROM users WHERE user_id = '$user_id'";
        $query_run = mysqli_query($conn, $sql);
        foreach($query_run as $row) {
            $user_status = $row['status'];
        }
        if($user_status == 'blocked') {
            header("Location: ../../login.php?error=accountblocked");
            session_unset();
            session_destroy();
            exit();
        }
        
    }



    // access control ---------------------------------------------------------
    function invalidAccess() {
        session_unset();
        session_destroy();
        header("Location: http://".$_SERVER['HTTP_HOST']."/LaborLink_php/main/index.php?error=invalidaccess");
        exit();
    }

    // admin ------------------------------------------------------------------

    function checkAdmin($user_role) {
        if($user_role !== "admin") {
            invalidAccess();
        } 
    }

    function registerLaborer($conn, $applicant_id) {
        $credit_balance = 0.00;
        $addQuery = "INSERT INTO laborers (credit_balance, applicant_Id) VALUES ('$credit_balance', '$applicant_id');";
        mysqli_query($conn, $addQuery);
        $updateQuery = "UPDATE users AS U INNER JOIN applications AS A ON U.user_id = A.user_id SET U.status = 'active' WHERE A.applicant_id = '$applicant_id'";
        mysqli_query($conn, $updateQuery);
    }

    //laborer ----------------------------------------------------------------
    
    function checkLaborer($user_role) {
        if($user_role !== "laborer") {
            invalidAccess();
        }
    }

    function getLaborerDetails($conn, $user_id) {
        $sql = "SELECT A.specialization, L.laborer_id FROM applications AS A
        INNER JOIN users AS U
        ON A.user_id = U.user_id
        INNER JOIN laborers AS L
        ON A.applicant_id = L.applicant_id
        WHERE A.user_id = '$user_id'";
        $query_run = mysqli_query($conn, $sql);

        return $query_run;
    }

    function checkPendingApprovals($conn, $laborer_id){
        $sql = "SELECT status FROM approved_requests
        WHERE laborer_id = '$laborer_id'
        AND (status = 'pending' OR status = 'accepted')";
        $query_run = mysqli_query($conn, $sql);
        $query_result = mysqli_num_rows($query_run);
        if($query_result > 0) {
            foreach($query_run as $row) {
                $status = $row['status'];
            }
            if($status == 'pending') {
                header("Location: ../services/on-going-services.php?error=existingapproval");
                exit();
            } else if ($status == 'accepted') {
                header("Location: ../services/on-going-services.php?message=requestinprogress");
                exit();
            }       
        }
        
    }

    function getRequests($conn, $specialization) {
        
        $sql = "SELECT R.progress, R.category, R.title, R.request_id, concat(U.first_name, ' ', U.middle_name, ' ', 
        U.last_name, ' ', U.suffix) AS full_name, R.description,
        R.address, R.date_time, O.suggested_fee
        FROM requests AS R
        INNER JOIN users AS U
        ON R.user_id = U.user_id
        INNER JOIN offers AS O
        ON R.request_id = O.request_id
        WHERE (R.progress = 'pending' AND R.category = '$specialization')
        ";

        $result = mysqli_query($conn, $sql);
        $query_result = mysqli_num_rows($result);
        
        if($query_result > 0){
            return $result;  
        } 
 
    }

    function getDirectRequests($conn, $laborer_id) {
        
        $sql = "SELECT AR.approval_id, R.progress, R.category, R.title, R.request_id, 
        concat(U.first_name, ' ', U.middle_name, ' ', 
        U.last_name, ' ', U.suffix) AS full_name, R.description,
        R.address, R.date_time, O.suggested_fee
        FROM requests AS R
        INNER JOIN users AS U
        ON R.user_id = U.user_id
        INNER JOIN offers AS O
        ON R.request_id = O.request_id
        INNER JOIN approved_requests AS AR
        ON R.request_id = AR.request_id
        WHERE R.progress = 'pending'
        AND AR.laborer_id = '$laborer_id'
        AND AR.status = 'direct req'
        ";

        $result = mysqli_query($conn, $sql);
        $query_result = mysqli_num_rows($result);
        
        if($query_result > 0){
            return $result;  
        } 
 
    }

    function hasAcceptedRequest($conn, $user_id, $user_role)  {
        if($user_role == 'customer') {
            $sql = "SELECT * FROM requests AS R
            INNER JOIN users AS U
            ON U.user_id = R.user_id
            INNER JOIN approved_requests AS AR
            ON AR.request_id = R.request_id
            WHERE R.user_id = '$user_id'
            AND AR.status = 'accepted'
            AND (R.progress = 'in progress' OR R.progress = 'partial-cr' OR R.progress = 'partial-lr')
            ";
            $query_run = mysqli_query($conn, $sql);
            $query_result = mysqli_num_rows($query_run);
            if ($query_result > 0) {
                return $query_run;
            } else {
                return false;
            }
        } else if($user_role == 'laborer') {
            $sql = "SELECT L.laborer_id, R.request_id, R.progress FROM requests AS R
            INNER JOIN approved_requests AS AR
            ON R.request_id = AR.request_id
            INNER JOIN laborers AS L
            ON AR.laborer_id = L.laborer_id
            INNER JOIN applications AS A
            ON L.applicant_id = A.applicant_id
            INNER JOIN users AS U
            ON A.user_id = U.user_id
            WHERE U.user_id = '$user_id'
            AND (AR.status = 'accepted' OR AR.status = 'pending')
            AND (R.progress = 'pending' OR R.progress = 'in progress' 
                OR R.progress = 'partial-cr' OR R.progress = 'partial-lr')
            ";
            $query_run = mysqli_query($conn, $sql);
            $query_result = mysqli_num_rows($query_run);
            if ($query_result > 0) {
                return $query_run;
            } else {
                return false;
            }
            
        }
        
    }

    function addCreditBalance($conn, $user_id, $suggested_fee) {
        $rate = 0.10;
        $new_credit_balance = $suggested_fee - ($suggested_fee/(1+$rate));
        $total_credit_balance = 0;

        $getBalance = "SELECT L.laborer_id, L.credit_balance
        FROM laborers AS L
        INNER JOIN applications AS A
        ON L.applicant_id = A.applicant_id
        INNER JOIN users AS U
        ON A.user_id = U.user_id
        WHERE U.user_id = '$user_id'";

        $query_run = mysqli_query($conn, $getBalance);
        foreach($query_run as $row) {
            $laborer_id = $row['laborer_id'];
            $credit_balance = $row['credit_balance'];
        }
        
        $total_credit_balance = $credit_balance + $new_credit_balance;

        $sql = "UPDATE laborers
        SET credit_balance = '$total_credit_balance'
        WHERE laborer_id = '$laborer_id';
        ";
        mysqli_query($conn, $sql);
        
    }

    function settleCreditBalance($conn, $user_id){
        
    }

    function checkIfOnHold($conn, $user_id){
        $sql = "SELECT L.credit_balance FROM laborers AS L
        INNER JOIN applications AS A
        ON L.applicant_id = A.applicant_id
        INNER JOIN users AS U
        ON A.user_id = U.user_id
        WHERE U.user_id = '$user_id'
        ";
        $query_run = mysqli_query($conn, $sql);
        foreach($query_run as $row) {
            $credit_balance = $row['credit_balance'];
        }

        if($credit_balance >= 500) {
            $sql = "UPDATE users
            SET status = 'onhold'
            WHERE user_id = '$user_id'
            ";
            mysqli_query($conn, $sql);
        }

        $sql = "SELECT status FROM users
        WHERE user_id = '$user_id'
        ";

        $query_run = mysqli_query($conn, $sql);
        $query_result = mysqli_num_rows($query_run);
        if($query_result > 0) {
            foreach($query_run as $row) {
                $status = $row['status'];
            }
            if($status == 'onhold') {
                header("Location: ../credit-balance.php?message=accountonhold");
                exit();
            }  
        }

        /* to all pages except credit-balance.php
        if(isOnHold === true) {
            header("Location: credit-balance.php?message=accountonhold");
            exit();
        }
        */
        
    }




    //customer ---------------------------------------------------------------

    function checkCustomer($user_role) {
        if($user_role !== "customer") {
            invalidAccess();
        }
    }

    function searchGet($conn, $specialization) {
        $query = "SELECT U.username, concat(U.first_name, ' ' , U.middle_name, ' ' , U.last_name, ' ', U.suffix) AS full_name, 
        A.specialization, A.employment_type, A.employer, 
        A.certification, U.email_add, U.sex, U.phone_number, 
        U.city FROM users AS U INNER JOIN applications AS A 
        ON U.user_id = A.user_id 
        WHERE U.user_role = 'laborer' AND 
        A.specialization = '$specialization';";

        $query_run = mysqli_query($conn, $query); 
        return $query_run;
    }

    function getBreakdown($fee) {
        $convenience_fee = $fee*0.10;
        $total = $convenience_fee + $fee;
        $breakdown_array = array($convenience_fee, $total);
        return $breakdown_array;
    }

    function hasPendingRequest($conn, $user_id)  {
        $sql = "SELECT * FROM requests AS R
        INNER JOIN users AS U
        ON U.user_id = R.user_id
        WHERE U.user_id = '$user_id'
        AND R.progress = 'pending'
        ";
        $query_run = mysqli_query($conn, $sql);
        $query_result = mysqli_num_rows($query_run);
        if ($query_result > 0) {
            return $query_run;
        } else {
            return false;
        }
    }

    function getSuggestedFee($conn, $request_id) {
        $sql = "SELECT * FROM offers
        WHERE request_id = '$request_id'";
        $query_run = mysqli_query($conn, $sql);
        $query_result = mysqli_num_rows($query_run);
        if ($query_result > 0) {
            return $query_run;
        } 
    }


?>