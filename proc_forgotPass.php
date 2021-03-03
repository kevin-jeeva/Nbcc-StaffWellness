<?php
session_start();
require_once 'includes/Mailer/PHPMailer/PHPMailerAutoload.php';
require_once 'functions/staff.php';
require_once 'functions/connect.php';

if(isset($_POST["email"]))
{
    $code =  rand(10000,20000);
    //get the email
    $email = $_POST["email"];
    // echo $email;
    if(staff::CheckEmailPassword($email))
    {
        $mail = new PHPMailer();
        $mail->isSMTP();  
        // $mail->SMTPDebug = 4;  
        $mail->Host = 'smtp.gmail.com';                     
        $mail->SMTPAuth = true;                              
        $mail->Username = 'nbccstaffwellness@gmail.com';              
        $mail->Password = 'StaffNbcc001';                          
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                                  // TCP port to connect to

        $mail->setFrom('nbccstaffwellness@gmail.com');
        $mail->addAddress(''.$email.'');    
        // $mail->isHTML(true);                            
        $mail->Subject = 'Password Reset';
        $mail->Body    = 'This email is intend to reset the password for the NBCC StaffWellness application Please find the code and <a href="http://localhost/nbcc_staffwellness/ResetPassword">Reset Password</a><BR> <h3>'.$code.'</h3>';
        $mail->AltBody = 'This email is intend to reset the password for the NBCC StaffWellness application Please find the code 50321';
    
        if(!$mail->send()) {
            // echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
           header("location:login.php");
        } else {
            $_SESSION["resetMessage"] = "Reset Email Sent";
            // echo 'Message has been sent';
            $result = staff::CheckAndInsertCode($email, $code);
             header("location:login.php");
            // echo $result;
        }
    }
    else{
        $_SESSION["alert_message"] = "Not a valid email";
        header("location:forgot_password.php");
    }
   
}
else{
    header("location:login.php");
}
?>
