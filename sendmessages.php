<?php
require 'includes/Mailer/PHPMailer/PHPMailerAutoload.php';
if(isset($_GET["email"]))
{
    $mail = new PHPMailer;
    $mail->isSMTP();                                    
    $mail->Host = 'smtp.gmail.com';                     
    $mail->SMTPAuth = true;                              
    $mail->Username = 'nbccstaffwellness@gmail.com';              
    $mail->Password = 'StaffNbcc001';                          
    $mail->SMTPSecure = 'ssl';                           
    $mail->Port = 465;                                   

    $mail->setFrom('nbccstaffwellness@gmail.com');
    $phones = json_decode($_GET["email"]);  
    $resource = $_GET["resource"];
    $text = $_GET["text"];
    $title = $_GET["title"];
    $count  = count($phones);
    for($x = 0; $x < $count ; $x++)
    {
        // echo $phones[$x]->email;
        $mail->addAddress(''.$phones[$x]->email.''); 
    }
                            
    $mail->Subject = $resource."\t".'update staffwellness';
    $mail->Body    = $resource."\r\n".$title."\r\n";
    $mail->AltBody = $title."\r\n".$text.'Please visit nbccstaffwellness.epziy.com';

    if(!$mail->send()) {
        // echo 'Message could not be sent.';
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        header("location:administrator.php");       
        // echo 'Message has been sent';
    }
}
else
{
    header("location:login.php");
}
?>