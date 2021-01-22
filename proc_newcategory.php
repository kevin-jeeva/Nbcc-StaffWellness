<?php
include_once("functions/Content.php");

 if(isset($_POST["resourceListId"]) && isset($_POST["contentTitle"]) && isset($_POST["content-area"]))
 {
    $content_category = $_POST["resourceListId"];
    $content_Title  = $_POST["contentTitle"];
    $content_text = $_POST["content-area"];
    $content_description = "";
    if(isset($_POST["content-description"]))
    {
      $content_description = $_POST["content-description"];
    }
    $content = new Content(0,$content_category, $content_Title,$content_text,0,0);
    Content::CheckAndInsertContent($content,$content_description);
   // echo $content_category."<BR>". $content_Title."<BR>". $content_text ;
 }
?>