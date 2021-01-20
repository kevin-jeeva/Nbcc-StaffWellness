<?php

class staff {
    private $staffId;
    private $email;
    private $password;
    private $username;
    private $admin;
    private $dateCreated;
    
    function __get($email) {
        return $this->$email;
    }
    
    function __set($email, $value) {
        $this->$email = $value;
    }
    
    function __construct($staffId, $email, $password, $username, $admin, $dateCreated) {
        $this->staffId = $staffId;
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->admin = $admin;
        $this->dateCreated = $dateCreated;
    }

    static function staffLogin($staff, $connection) {
        $db_staff_id = "";
        $db_user_name = "";
        $db_email = "";
        $db_password = "";
        $db_admin = "";

        $sql = "SELECT staff_id, user_name, email, password, admin FROM user WHERE email = '$staff->email'";
        if ($result = mysqli_query($connection, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                //Associative Array: Array that indexes with a string instead of a number.
                $db_staff_id = $row["staff_id"];
                $db_user_name = $row["user_name"];
                $db_email = $row["email"];
                $db_password = $row["password"];
                $db_admin = $row["password"];
            }
        }

        //Checking the username
        if ($staff->email === $db_email) {
            //Checking the password
            if ($staff->password === $db_password) {
                $_SESSION["SESS_MEMBER_ID"] = $db_staff_id;
                $_SESSION["SESS_MEMBER_EMAIL"] = $db_email;
                $_SESSION["SESS_MEMBER_NAME"] = $db_user_name;
                return $db_staff_id;
            } else {
                return -1;
            }
        } else {
                return -2;
        }
        
    }

    static function getStaffByUserID($userEmail) {
        
    }
}