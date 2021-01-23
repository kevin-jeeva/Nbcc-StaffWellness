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
   
   public static function getAllResourcesId()
   {
       $con = $GLOBALS["con"];
       $sql = "Select * from resources";
       $result = mysqli_query($con,$sql);
       return $result;
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
         echo "<div class=\"the-content\">
         <h1>" . $row['content_title'] . "</h1>
         <hr>
         <p>" .$row['content_text']."</p><br></div>";
        } 
        }

    public static function getContents()
    {
       $result = self::getAllResourcesId();
       if(mysqli_num_rows($result) > 0)
       {
           while($val= mysqli_fetch_array($result))
           {             
               $resource_id = $val['resource_id'];
               echo "<option value='$resource_id'>";
           }
       }
    }

    public static function CheckAndInsertContent($content,$resource_name ="")
    {
       
        $result = self::CheckResourceID($content->resourceId);
        if(mysqli_num_rows($result) > 0 )
        {            
            self::InsertContent($content->resourceId,$content->title,$content->contentText);
        }
        else{               
                if(self::InsertResourceId($content->resourceId,$resource_name))
                {
                    self::InsertContent($content->resourceId,$content->title,$content->contentText);
                }
                else{
                    header("location:content.php");
                }                
            }
    }
    public static function InsertContent($resource_id,$content_title,$content_text)
    {
        $con = $GLOBALS["con"];
        $resource_id = strtoupper($resource_id);
        $sql = "Insert into content(resource_id,content_title,content_text) Values('$resource_id','$content_title','$content_text') ";                
        mysqli_query($con,$sql);
        if(!mysqli_affected_rows($con) == 1)
        {
          header("location:content.php");        
        }
       
    }
    public static function CheckResourceID($resource_id)
    {
        $con = $GLOBALS["con"];
        $sql = "Select resource_id from resources where resource_id = Upper('$resource_id')";
        $result = mysqli_query($con,$sql);
        return $result;
    }

    public static function InsertResourceId($resource_id,$resource_name)
    {
        $con = $GLOBALS["con"];
        $resource_id = strtoupper($resource_id);
        $sql = "Insert into resources(resource_id,resource_name) values('$resource_id','$resource_name')";
        mysqli_query($con,$sql);
        if(mysqli_affected_rows($con) == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
        
}