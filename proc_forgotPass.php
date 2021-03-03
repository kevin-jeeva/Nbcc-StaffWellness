<?php
session_start();
include_once("functions/connect.php");
include_once("functions/PasswordReset.php");


if (isset($_POST['submit'])) {
    $email = $_POST["email"];
    $token = md5(random_bytes(32));
    $selector = bin2hex(random_bytes(8));
    $expiry = PasswordReset::setExp();
    $url = PasswordReset::UrlLink($selector, $token);

    $ps = new PasswordReset($email, $token, $selector, $expiry); //new object

    //Call method to insert reset details into DB; if this email was prev used to do a password reset then old data will be eraced and new data entered:
    PasswordReset::GrabResetDetails($email);

    //USE MAIL function to send email to user to reset password:
    //Email contents:
    ini_set("SMTP", "ssl://smtp.gmail.com");
    ini_set("smtp_port", "25");
    ini_set("quot", "ssl://smtp.gmail.com");
    error_reporting(E_ALL);
    //$from = "odessahartjes@gmail.com";
    $to = $email; //email user entered on form
    $subject = "Reset your password";
    $message = "Please use the link below to reset your password for NBCC Wellness</BR>" . '<a href="' . $url . '">' . $url . '</a>';
    //  $headers = "FROM: " . $from;
    //send email:
    //  echo "<BR><BR>" . $to . "<BR>" . $subject . "<BR>" . $message . "<BR>" . $headers;
    //phpinfo(); //prints out php settings on your page
    if (mail($to, $subject, $message)) {
        echo "Email sent";
    } else {
        echo "Email not sent";
    }
}//end ISSET
