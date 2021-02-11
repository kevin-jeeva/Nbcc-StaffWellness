<?php
include_once("functions/connect.php");
include_once("functions/Media.php");
session_start();
$video_name;
$allowedType = array("opus","flac","mp3","webm","wav","ogg","ogv","m4a","oga","mid","wma","au","aac");
if(isset($_POST["submit"]))
{
  $video_title = $_POST["soundTitle"];
  $video_description = $_POST["audio-description"];
  $format = strpos($_FILES["audio"]["name"],".");
  $format = substr($_FILES["audio"]["name"],$format+1);
  $media = new Media(0,$video_title,$video_description,0,0);
  $media->mediaPath = $_SESSION["staff_id"].time().".mp3";
  $_FILES["audio"]["name"] = $media->mediaPath;
 
  if(in_array($format,$allowedType))
  {
    echo "true";
    if(move_uploaded_file($_FILES["audio"]["tmp_name"],'includes/sounds/'.$_FILES["audio"]["name"]))
   {
      if(Media::InsertMedia($media))
      { 
        $_SESSION["message"] = "Audio Inserted Successfully";
        header("location:administrator.php");
      }
      else
      {
        echo "Video not Inserted ";
        $_SESSION["alert_message"] = "Audio is not inserted";
        header("location:administrator.php");
      }
    }
  }
  else  
  {  
    $_SESSION["alert_message"] = "Audio format not supported";
    header("location:new_sound.php");
  }

  
}
else
{  
  $_SESSION["alert_message"] = "unsucessful submission";
  header("location:new_video.php");
  
}
?>
