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
    
    public function __destruct() {
        //this is destruct the object one the object is completed it process :)
    }
    
    function __construct($staffId, $email, $password, $username, $admin, $dateCreated) {
        $this->staffId = $staffId;
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->admin = $admin;
        $this->dateCreated = $dateCreated;
    }
    public static function  GetStaffInfoByEmail($email)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT staff_id,user_name,email, password, admin, date_created FROM user WHERE email = UPPER('$email')";
        $result = mysqli_query($con, $sql);       
        return $result;
    }
    public static function CheckStaffEmail($email) //this function will check for staff password
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT staff_id FROM user WHERE email = UPPER('$email')";
        $result = mysqli_query($con, $sql);       
        return $result;
    }
    public static function CheckStaffPassword($password)//this function will check for staff email
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT staff_id FROM user WHERE password = UPPER('$password')";
        $result = mysqli_query($con, $sql);       
        return $result;
    }
    public static function AddHash($staff_id, $password)
    {
        //this function will hash the password and update the record in the table
        $con = $GLOBALS["con"];
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "update user set password = '$hash_password' where staff_id = $staff_id";
        echo $sql;
        mysqli_query($con, $sql);
        if(mysqli_affected_rows($con) == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public static function CheckHashAndRedirect($email,$password)
    {
        //this function will decrypt the hashed password and verify with the password
        //if the password is correct then enter into index
        //password is wrong then go to login 
        $con = $GLOBALS["con"];
        $result = self::GetStaffInfoByEmail($email);
        if($val = mysqli_fetch_array($result))
        {
            
            if(password_verify($password, $val["password"]))
            {
                  $staff_id = self::SetStaffSession(self::GetStaffInfoByEmail($email));
                  $msg ="Sucess";                  
                  header("location:index.php");
            }
            else
            {
               
                $msg = "Incorrect Password. Please Try again!" ;
                header("location:login.php?loginError=$msg");
            }
        }
    }
    static function staffLogin($staff) {
        $con = $GLOBALS["con"];        
        $email = self::CheckStaffEmail($staff->email);//execute the function 
        $password = self::CheckStaffPassword($staff->password);//execute the function    
        
        if(mysqli_num_rows($email) > 0) //check the email is correct and proceed
        {
            if(mysqli_num_rows($password) > 0)//check the password is correct and proceed
            { 
                //set the session and get the staff id to save time
                $staff_id = self::SetStaffSession(self::GetStaffInfoByEmail($staff->email));
                 if(self::AddHash($staff_id,$staff->password)) //add the hash password and update the table
                 {      
                    header("location:index.php");
                 }
                 else
                 {
                     echo "failure";
                 }                
            }
            else
            {
                self::CheckHashAndRedirect($staff->email, $staff->password);//check for the hashed password or wrong password
            }           
        }//end of first if
        else
        {
            $msg = "Email not found. Please Try again!" ;
            header("location:login.php?loginError=$msg");
        }        
    }
    static function SetStaffSession($staff)
    {
        if(mysqli_num_rows($staff) != null)
        {
            if($val = mysqli_fetch_array($staff))
            {
                $_SESSION["admin"] = $val["admin"];
                $_SESSION["staff_name"] =$val["user_name"];
                $_SESSION["staff_id"] = $val["staff_id"];
                $_SESSION["message"] = "Welcome, ".$val["user_name"];
                return $val["staff_id"];
            }
        }
    }
    
    static function getStaffByUserID($userEmail) {
        
    }

    public static function GetStaffAdminNumber($staffId)
    {
        $con = $GLOBALS["con"];
        $sql = "SELECT admin FROM user WHERE staff_id = $staffId";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        return $row[0];
    }
}