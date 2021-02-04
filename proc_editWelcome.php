<?php 
include("functions/connect.php");
include("functions/Welcome.php");
session_start();
$picName;
$allowedType = array(IMAGETYPE_PNG,IMAGETYPE_JPEG, IMAGETYPE_ICO, IMAGETYPE_GIF, IMAGETYPE_BMP);

if(isset($_POST["edit_welcomeTitle"]))
{
        $welcome_title = $_POST["edit_welcomeTitle"];
        $welcome_text = $_POST["edit_welcome-description"];
        $welcome_id = $_POST["edit_welcome_id"];
   
        echo $welcome_id."<BR>".$welcome_title."<BR>";
        print_r($_FILES["pic"]);
        
        if(empty($_FILES['pic']['name']))
        {
            //the uploaded file is good
            UpdateEditWelcome($welcome_id,$welcome_title,$welcome_text);
        }
        else
        {
            //new file selected
            $detectedType = exif_imagetype($_FILES['pic']['tmp_name']);
            $error = in_array($detectedType,$allowedType);
            if($error)
            {
                 $MAX_FILE_SIZE = 10*1024*1024;
                if($_FILES['pic']['size'] > $MAX_FILE_SIZE)
                {
                    unlink($_FILES['pic']['tmp_name']);
                    $_SESSION["alert_message"] = "Files should be less than 10MB";
                    header("location:edit_welcome.php");
                    exit;
                }
                else
                {
                    $welcome_image_name = $_SESSION["staff_id"].time().".png";
                    $_FILES['pic']['name'] =  $welcome_image_name;
                    move_uploaded_file($_FILES['pic']['tmp_name'], 'includes/imgs/welcome_images/'.$_FILES['pic']['name']);
                    echo $welcome_image_name;
                    UpdateEditWelcome($welcome_id,$welcome_title,$welcome_text,$welcome_image_name);
                }
            }
            else
            {            
                $_SESSION["alert_message"] = "Invalid file type";                 
                unlink($_FILES['pic']['tmp_name']);
                header("location:edit_welcome.php");
            }
        }
}

function UpdateEditWelcome($welcome_id,$welcome_title,$welcome_text, $image=0)
{
    $welcome = new Welcome($welcome_id,$welcome_title,$welcome_text,$image,0);   
    if(Welcome::UpdateWelcome($welcome))
    {
       
        $_SESSION["message"] = "Welcome Content Edited SuccessFully";
        header("location:administrator.php");
    }
    else{
        
        $_SESSION["alert_message"] = "Welcome Content Not Edited";
        header("location:administrator.php");
    }
} 
 
?>