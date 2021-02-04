<?php 
include("functions/connect.php");
include("functions/Welcome.php");
session_start();
$picName;
$allowedType = array(IMAGETYPE_PNG,IMAGETYPE_JPEG, IMAGETYPE_ICO, IMAGETYPE_GIF, IMAGETYPE_BMP);

if(isset($_POST["welcomeTitle"]))
{
        $welcome_title = $_POST["welcomeTitle"];
        $welcome_text = $_POST["welcome-description"];
        echo $welcome_text."<BR>".$welcome_title."<BR>";
        print_r($_FILES["pic"]);
        $detectedType = exif_imagetype($_FILES['pic']['tmp_name']);
        $error = in_array($detectedType,$allowedType);
        echo $error;
        if($error)
        {
            $MAX_FILE_SIZE = 10*1024*1024;
            if($_FILES['pic']['size'] > $MAX_FILE_SIZE)
            {
                unlink($_FILES['pic']['tmp_name']);
                $_SESSION["alert_message"] = "Files should be less than 10MB";
                header("location:new_welcome.php");
                exit;
            }
            else
            {
               $welcome = new Welcome(0,$welcome_title,$welcome_text,0,0);
               $welcome->welcome_image = $_SESSION["staff_id"].time().".png";
               $_FILES['pic']['name'] = $welcome->welcome_image;
               move_uploaded_file($_FILES['pic']['tmp_name'], 'includes/imgs/welcome_images/'.$_FILES['pic']['name']);
              if(Welcome::InsertWelcome($welcome))
              {
                 $_SESSION["message"] = "Welcome Content Inserted SuccessFully";
                 header("location:administrator.php");
              }
              else{
                   $_SESSION["alert_message"] = "Welcome Content Not Inserted";
                 header("location:administrator.php");
              }
            }        

        }
        else
        {            
            $_SESSION["alert_message"] = "Invalid file type";                 
            unlink($_FILES['pic']['tmp_name']);
            header("location:new_welcome.php");
        }
    
}

else 
{
    $_SESSION["alert_message"] = "You have to select a file";
    header("location:administrator.php");
    exit;
}
    
 
?>