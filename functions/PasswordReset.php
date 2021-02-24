<?php
include_once 'connect.php';

class PasswordReset{
    private $email;
    private $token;
    private $selector;
    private $expiry;

    public function __construct($email,$token,$selector,$expiry)
    {
        $this->email = $email;
        $this->token = $token;
        $this->selector = $selector;
        $this->expiry = $expiry;

    }
    public function __get($name){
        return $this->$name;
    }
    
      public function __set($name,$value){
        $this->$name = $value;
    }
     public function __destruct() 
    {  
    }

    public static function UrlLink($selector,$token){
        $url = "www.localhost/password_edit.php?selector=".$selector."&validator=".bin2hex($token); 
    }

    public static function setExp(){
        date_default_timezone_set("Canada/Atlantic");
        $exp=strtotime(date("h:i:sa"))+900; //900 = 15 min
        $exp=date("h:i:sa",$exp); 

        return $exp;
    }
    //Erace any exising details where this email has been used before
    public static function GrabResetDetails($email)
    {
        $con = $GLOBALS["con"];
        $sql = "select email,token,selector,expiry from password_reset where email = '$email' ";
        $result = mysqli_query($con, $sql);
        return $result;
        if(mysqli_num_rows($result)>0){ //if data already exists
            while($row=mysqli_fetch_array($result)){
                $sqlDelete = "Delete from password_reset where email = '$email'"; 
                mysqli_query($con, $sqlDelete);
            }
            Self::InsertResetDetails($email);
        }else{
            Self::InsertResetDetails($email);
        }
    }
    
   public static function InsertResetDetails($email){
        $token=""; $selector=""; $expiry="";
        $con = $GLOBALS["con"];    
        $sql = "Insert into password_reset (email, token, selector, expiry) values ('$email','$token', '$selector','$expiry')";
        if(mysqli_query($con,$sql)){
            echo "Reset details inserted into database <BR>"; 
            //Self::SendEmail();      
        }

    }
    
    public static function SendEmail(){
        $emailContent="";
        $url="";
        //Email contents:
        $subject = "Reset your password for NBCC Staff Wellness";
        $message = "Please use the link below to reset your password for NBCC Wellness</BR>";
        $message .= '<a href="'.$url.'">'.$url.'</a>'; 
        
        return $emailContent;
    }

}//END PasswordReset 