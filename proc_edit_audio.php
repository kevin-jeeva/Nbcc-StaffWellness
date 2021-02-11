<?php
include("functions/connect.php");
include("functions/Media.php");
session_start();

$video_name;
$allowedType = array("opus","flac","mp3","webm","wav","ogg","ogv","m4a","oga","mid","wma","au","aac");
if(isset($_POST["soundTitle"]))
{
  
  $id = $_POST["id"];
  $video_title = $_POST["soundTitle"];
  $video_description = $_POST["audio-description"];
 
    if(empty($_FILES["audio"]["name"]))
    {
      //uploaded video is good
      
      UpdateVideo($id,$video_title,$video_description);
    }
    else
    {
      
      $format = strpos($_FILES["audio"]["name"],".");
      $format = substr($_FILES["audio"]["name"],$format+1);
      
      if(in_array($format,$allowedType))
      {
       
        $media = new Media($id,$video_title,$video_description,0,0);
        $media->mediaPath = $_SESSION["staff_id"].time().".mp3";
        $_FILES["audio"]["name"] = $media->mediaPath;        
        if(move_uploaded_file($_FILES["audio"]["tmp_name"],'includes/sounds/'.$_FILES["audio"]["name"]))
        { 
          UpdateVideo($id,$video_title,$video_description,$media->mediaPath);
        }
      }
      else  
      {
        
        $_SESSION["alert_message"] = "Audio format not supported";
        header("location:edit_audio.php");
      }
    }
 
}
else
{
 header("location:administrator.php");
}

function UpdateVideo($id,$title,$desc,$video=0)
{
  $media = new Media($id,$title,$desc,$video,0);
  if(Media::UpdateVideo($media))
  {
    echo "success";
        $_SESSION["message"] = "Audio Edited Successfully";
        header("location:administrator.php");
  }
  else
  {
       $_SESSION["alert_message"] = "Audio not edited";
       header("location:administrator.php");
  }
}
?>
