<?php
session_start();
include_once("functions/connect.php");
//PHPMailer : https://github.com/PHPMailer/PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once("includes/PHPMailer/src/Exception.php");
include_once("includes/PHPMailer/src/PHPMailer.php");

if(isset($_POST['submit'])){
    $selector = bin2hex(random_bytes(8));
    $token = md5(random_bytes(32)); 
  
    $url = "www.localhost/forgot_password.php?selector=".$selector."&validator=".bin2hex($token); 
    $expires = date("U")+1800;
    
    $con =$GLOBALS["con"];
    $email = $_POST["email"];
    // SQL TO delete where email is not empty??  

    $sql = "Insert into tablename () values ();";
    if(mysqli_query($con,$sql)){
        //insert into db $ send email to user for reset

        //phpMailer
        $mail->isSMTP();
        $mail->Host = gethostname();
        $mail->SMTPAuth = true;
        $mail->Username = 'sender@example.com';
        $mail->Password = 'password';
        $mail->setFrom('sender@example.com');
        $mail->addAddress('recipient@example.com');
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the body.';
        $mail->send();
        
        //Email contents:
        $to = $email; //email user entered on form
        $subject = "Reset your password";
        $message = "...SOMETHING..</BR>";
        $message .= '<a href="'.$url.'">'.$url.'</a>'; 
        $headers = "FROM: NBCCWellnessStaff <email.com>\r\n";
        //send email:

        mail($to, $subject, $message, $headers);

        header("location:password_edit.php?reset=success");
    }else{
        die; 
    }

} else{
    header ("location: login.php");
}
?>