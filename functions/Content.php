<?php
include_once 'connect.php';

class Content {
   private $contentId;
   private $resourceId;
   private $title;
   private $contentText;
   private $image;
   private $dateCreated; 
   
   function __construct($contentId, $resourceId, $title, $contentText, $image, $dateCreated) {
       $this->contentId = $contentId;
       $this->resourceId = $resourceId;
       $this->title = $title;
       $this->contentText = $contentText;
       $this->image = $image;
       $this->dateCreated = $dateCreated;
   }
   
   //get two newest articles to display on index
   static function getTopArticles(){
    $con = $GLOBALS['con'];
    $sql = "SELECT content_title, content_text, date_created FROM content WHERE resource_id = 'ARTICLE' ORDER BY date_created LIMIT 2";
    $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
         echo "
         <hr>
         <h2>" . $row['content_title'] . "</h2>
         <p>". $row['content_text'] . "</p>
         <button type=\"button\" class=\"btn btn-primary\">Read More</button>";
        }    
    }
    //get all articles to display on articles.php
   static function getAllArticles(){
    $con = $GLOBALS['con'];
    $sql = "SELECT content_title, content_text, date_created FROM content WHERE resource_id = 'ARTICLE' ORDER BY date_created";
    $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
         echo "<div class=\"the-content col-md-8\">
         <h1>" . $row['content_title'] . "</h1>
         <hr>
         <p>" .$row['content_text']."</p><br></div>";
        } 
        }
       
    }



