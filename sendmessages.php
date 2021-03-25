<?php
require 'includes/Mailer/PHPMailer/PHPMailerAutoload.php';
require_once("functions/connect.php");
require_once('functions/staff.php');
session_start();

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
    $mails = json_decode($_GET["mails"]);
    $resource = $_GET["resource"];
    $text = $_GET["text"];
    $title = $_GET["title"];   
    $count  = count($phones);
    $mailsCount = count($mails);
    for($x = 0; $x < $count ; $x++)
    {
        // echo $phones[$x]->email;
        $mail->addBCC(''.$phones[$x]->email.'');
    }

    for($x = 0; $x < $mailsCount ; $x++)
    {
        // echo $mails[$x]->mail;
        $mail->addBCC(''.$mails[$x]->mail.'');
    }

                            
    $mail->Subject = $resource."\t".'update staffwellness';
    $mail->Body    = $resource."\r\n".$title."\r\n";
    $mail->AltBody = $title."\r\n".$text.'Please visit nbccstaffwellness.epziy.com';

    if(!$mail->send()) {
        // echo 'Message could not be sent.';
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        //send the push notification here
        $result = staff::GetExpoPushToken();
        $push_result = false;
        if($result != null){
        $count = count($result);
        for($i = 0; $i < $count; $i++){
            $fields = [
                "to" => $result[$i],
                "sound" => "default",
                "title" => "update in ".$resource,
                "body" => $title,
                "data" => [
                    "someData" => "goes here"
                ]
                ];        
           callAPI('https://exp.host/--/api/v2/push/send', json_encode($fields));
        }
        }
        $_SESSION["message"] = "content Inserted Successfully";
        header("location:administrator.php");
        // echo 'Message has been sent';
    }
}
else
{
    header("location:login.php");
}

function callApi ($url ,$data){   
    $curl = curl_init();    
    //options
    curl_setopt($curl, CURLOPT_POST ,true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "Accept: application/json",
    "Accept-Encoding: gzip, deflate",
    "Content-Type: application/json",
    "cache-control: no-cache",
    "host: exp.host"
  ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);   
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    // EXECUTE:
    $result = curl_exec($curl);    
    $err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //echo $result;
}

}
?>