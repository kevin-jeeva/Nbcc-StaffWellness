<?php
include_once("functions/Content.php");
session_start();

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

    // if(CheckForContentSpace($content_text))
    // {
    //   echo "failure";
    //   // $_SESSION["message"] = "Please fill the content area";
    //   // header("location:content.php");
    // }
    else{
      //echo "success";
       $content = new Content(0, $content_category, $content_Title, $content_text, 0, 0);
       Content::CheckAndInsertContent($content,$content_description);
       $_SESSION["message"] = "Content Inserted Successfully";
       header("location:index.php");
        
      // echo $content_category."<BR>". $content_Title."<BR>". $content_text ;
    }
   
 }
 else{
   header("location:new_content.php");
 }

//  function CheckForContentSpace($content)
//  {  
//    $result = strip_tags($content);
//    echo "result".$result;
//    //$result = "Hello world";
//    $result = str_replace(" ","", $result);
//    $result = ltrim($result);
//    echo "result2:".$result;
//    echo var_dump($result);
//    if(strcmp($result,""))
//    {
//       echo "false";
//       return false;
//    }
//    else{
//      echo "true";
//      return true;
//    }
//  }
?>