<?php
session_start();
include_once("functions/connect.php");


if(isset($_POST['submit'])){
    $selector = bin2hex(random_bytes(8));
    $token = md5(random_bytes(32)); 
    $url = "www.localhost/forgot_password.php?selector=".$selector."&validator=".bin2hex($token); 
        //set timezone, get time, format and add 15 min (link will expire in 15 min)
    date_default_timezone_set("Canada/Atlantic");
    $exp=strtotime(date("h:i:sa"))+900; //900 = 15 min
    $exp=date("h:i:sa",$exp);
  
    echo $url."<BR>";
    $con =$GLOBALS["con"];
    $email = $_POST["email"];

    $s = "Select * from password_reset where email = '$email'"; 
    echo "<BR> $s";
    while(mysqli_num_rows($con)>0){ //Tired while vs if, tried $con vs $s ... HELPPPPP
        while($row=mysqli_fetch_array($s)){
            $sqlDelete = "Delete from password_reset where email = '$email'"; 
            mysqli_query($con, $sqlDelete);
            echo $sqlDelete; 
        }
           
    }
        $sql = "Insert into password_reset (email, token, selector, expiry) values ('$email', '$token', '$selector','$exp')";
        echo $sql."  Inserted <BR>";
        if(mysqli_query($con,$sql)){
            echo "success";       
            //Email contents:
            $to = $email; //email user entered on form
            $subject = "Reset your password";
            $message = "...SOMETHING..</BR>";
            $message .= '<a href="'.$url.'">'.$url.'</a>'; 
            $headers = "FROM: NBCCWellnessStaff <email.com>\r\n";
            //send email:
            echo $to."<BR>".$subject."<BR>".$message."<BR>".$headers;
    
            mail($to, $subject, $message, $headers);
            
           //header("location:password_edit.php?reset=success");
        }
        else{ 
            echo "Error";
            // header("location:forgot_password.php?reset=success"); 
        }
    }




?>