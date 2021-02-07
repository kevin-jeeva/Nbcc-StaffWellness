<?php
include("functions/connect.php");
include("functions/Media.php");
session_start();

$video_name;
$allowedType = array("ogm","wmv","mp4","mpg","webm","ogv","mov","asx","mpeg","mp4","m4v","avi");
if(isset($_POST["videoTitle"]))
{
  
  $id = $_POST["id"];
  $video_title = $_POST["videoTitle"];
  $video_description = $_POST["video-description"];
 
    if(empty($_FILES["video"]["name"]))
    {
      //uploaded video is good
      UpdateVideo($id,$video_title,$video_description);
    }
    else
    {
      
      $format = strpos($_FILES["video"]["name"],".");
      $format = substr($_FILES["video"]["name"],$format+1);

      if(in_array($format,$allowedType))
      {
    
        $media = new Media($id,$video_title,$video_description,0,0);
        $media->mediaPath = $_SESSION["staff_id"].time().".mp4";
        $_FILES["video"]["name"] = $media->mediaPath;
        if(move_uploaded_file($_FILES["video"]["tmp_name"],'includes/videos/'.$_FILES["video"]["name"]))
        {
          UpdateVideo($id,$video_title,$video_description,$media->mediaPath);
        }
      }
      else  
      {
        $_SESSION["alert_message"] = "Video format not supported";
        header("location:edit_video.php");
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
   
        $_SESSION["message"] = "Video Edited Successfully";
        header("location:administrator.php");
  }
  else
  {
       $_SESSION["alert_message"] = "Video not edited";
        header("location:administrator.php");
  }
}
?>
