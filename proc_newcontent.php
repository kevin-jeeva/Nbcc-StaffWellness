<?php
include_once("functions/Content.php");
session_start();

 if(isset($_POST["contents"]) && isset($_POST["contentTitle"]) && isset($_POST["content-area"]) && isset($_POST["content-description"]))
 {
    $content_category = $_POST["contents"];
    $content_Title  = $_POST["contentTitle"];
    $content_text = $_POST["content-area"];
    $content_description = $_POST["content-description"];

    $content = new Content(0,0, $content_Title,$content_text,$content_description,0,0,0);
    Content::CheckAndInsertContent($content,$content_category);   
    $_SESSION["message"] = "content Inserted Successfully";    
    header("location:administrator.php");    
  //echo $content_category."<BR>". $content_Title."<BR>". $content_text."<BR>".$content_description ;
    
   
 }
 else{
   header("location:new_content.php");
 }

?>