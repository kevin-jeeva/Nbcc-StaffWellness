<?php
session_start();
include_once("functions/connect.php");
include_once("functions/PasswordReset.php");


if(isset($_POST['submit'])){
    $email = $_POST["email"];
    $token = md5(random_bytes(32)); 
    $selector =bin2hex(random_bytes(8));
    $expiry = PasswordReset::setExp();
    $url = PasswordReset::UrlLink($selector,$token);

    $ps = new PasswordReset($email,$token,$selector,$expiry); //new object

        //Call method to insert reset details into DB; if this email was prev used to do a password reset then old data will be eraced and new data entered:
    PasswordReset::GrabResetDetails($email); 
    
    //USE MAIL function to send email to user to reset password:
        //Email contents:
        $to = $email; //email user entered on form
        $subject = "Reset your password";
        $message = "Please use the link below to reset your password for NBCC Wellness</BR>".'<a href="'.$url.'">'.$url.'</a>'; 
        $headers = "FROM: NBCCWellnessStaff <email.com>\r\n";
        //send email:
        echo "<BR><BR>".$to."<BR>".$subject."<BR>".$message."<BR>".$headers;

        mail($to, $subject, $message, $headers);
        
 
       
}//end ISSET




?>