<?php
include_once("functions/Content.php");
session_start();

 if(isset($_POST["contents"]) && isset($_POST["contentTitle"]) && isset($_POST["content-area"]) && isset($_POST["content-description"]))
 {
    $content_category = $_POST["contents"];
    $content_Title  = $_POST["contentTitle"];
    $content_text = $_POST["content-area"];
    $content_description = $_POST["content-description"];
    $content_date = null;
    
    if (isset($_POST["eventDate"]) && $_POST["eventDate"] != ""){
        $content_date = date("Y-m-d", strtotime($_POST["eventDate"]));
    }

    $content = new Content(0,0, $content_Title,$content_text,$content_description,0,0,$content_date);
    print_r( $content);
    $_SESSION["message"] = "content Inserted Successfully";
    Content::CheckAndInsertContent($content,$content_category);   
    //header("location:administrator.php");    
  //echo $content_category."<BR>". $content_Title."<BR>". $content_text."<BR>".$content_description ;
    
   
 }
 else{
   header("location:new_content.php");
 }

?>