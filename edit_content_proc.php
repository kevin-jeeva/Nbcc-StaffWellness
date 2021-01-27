<?php 
include_once("functions/Content.php");
session_start();
if(isset($_POST["edit_contents"]) && isset($_POST["editContentTitle"]) && isset($_POST["editContent-area"]) && isset($_POST["editContent-description"]))
{
   $content_category = $_POST["edit_contents"];
   $content_Title  = $_POST["editContentTitle"];
   $content_text = $_POST["editContent-area"];
   $content_description = $_POST["editContent-description"];
   $content_id = $_POST["content_id"];
   
   $content = new Content($content_id,0, $content_Title,$content_text,$content_description,0,0,0);
   if(Content::UpdateEditedContent($content,$content_category))
   {
     echo "insert success";
    $_SESSION["message"] = "content Edited Successfully";    
    header("location:administrator.php"); 
   }
   else{
     echo "fail";
    header("location:administrator.php");
  }
  
     
 //echo $content_category."<BR>". $content_Title."<BR>". $content_text."<BR>".$content_description ;
   
  
}
else{
  echo "big fat fail";
  header("location:administrator.php");
}
?>