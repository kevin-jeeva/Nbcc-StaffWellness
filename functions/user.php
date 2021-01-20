<?php
include_once 'connect.php';

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

    static function staffLogin($password, $email) {
        $sql = "SELECT staff_id FROM user WHERE email = '" . $email . "'";
        $result = mysqli_query($con, $sql);
        //check if username was valid and something was found
        if (mysqli_num_rows($result) === 1) {
            //get the results as an array and creates a User object
            $row = mysqli_fetch_array($result);
            $user = user::getUserByUserID($row['staff_id']);
            //verify the entered password and the encrypted one in the database
            if (password_verify($password, $user->password)) {
                //set session variables
                $_SESSION['SESS_MEMBER_ID'] = $user->staffId;
                $_SESSION['SESS_MEMBER_EMAIL'] = $user->email;
                //redirect to index page
                header('Location:index.php');
            }
            else { //passwords don't match, redirect back to login
                $msg = "Invalid username or password. Please try again.";
                header("Location:login.php?msg=$msg");
            }
        }
        else { //username isn't found, redirect back to login
            $msg = "Invalid username or password. Please try again.";
            header("Location:login.php?msg=$msg");
        }
    }

    static function getUserByUserID($userEmail) {
        $sql = "SELECT * FROM users WHERE user_id = '" . $userEmail . "' AND user_id IS NOT NULL";
        $result = mysqli_query($GLOBALS['con'], $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_array($result);
            //Constructor: $staffId, $email, $password, $username, $admin, $dateCreated
            $user = new User($staffId, $row['user_name'], $row['email'], $row['password'], $row['admin'], $row['date_created'],);
            return $user;
        }
    }
}