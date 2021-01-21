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
        
    static function staffLogin($staff) {
        $con = $GLOBALS["con"];        
        $email = self::CheckStaffEmail($staff->email);//execute the function 
        $password = self::CheckStaffPassword($staff->password);//execute the function    
        
        if(mysqli_num_rows($email) > 0) //check the email is correct and proceed
        {
            if(mysqli_num_rows($password) > 0)//check the password is correct and proceed
            {
                 self::SetStaffSession(self::GetStaffInfoByEmail($staff->email));
                 $msg ="Sucess";
                 header("location:index.php?user=$msg");
            }
            else
            {
                 $msg = "Incorrect Password. Please Try again!" ;
                 header("location:Login.php?loginError=$msg");
            }           
        }//end of first if
        else
        {
            $msg = "Email not found. Please Try again!" ;
            header("location:Login.php?loginError=$msg");
        }        
    }
    static function SetStaffSession($staff)
    {
        if(mysqli_num_rows($staff) != null)
        {
            if($val = mysqli_fetch_array($staff))
            {
                $_SESSION["admin"] = $val["admin"];
                $_SESSION["staff_name"] =$val["staff_name"];
                $_SESSION["staff_id"] = $val["staff_id"];
            }
        }
    }
    
    static function getStaffByUserID($userEmail) {
        
    }
}