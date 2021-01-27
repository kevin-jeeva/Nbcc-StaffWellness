<?php
include_once 'connect.php';
class Content {
   private $contentId;
   private $resourceId;
   private $title;
   private $contentText;
   private $image;
   private $dateCreated; 
   private $eventDate;
   
   function __construct($contentId, $resourceId, $title, $contentText, $contentDescription, $image, $dateCreated, $eventDate) {
       $this->contentId = $contentId;
       $this->resourceId = $resourceId;
       $this->title = $title;
       $this->contentText = $contentText;
       $this->contentDescription = $contentDescription;
       $this->image = $image;
       $this->dateCreated = $dateCreated;
       $this->eventDate = $eventDate;
   }
   
   public static function GetAllContents()
   {
       $con = $GLOBALS["con"];
       $sql ="Select content_id, resource_id, content_title, content_text, content_description, date_format(date_created, '%m/%d/%y') as date_created from content";
       $result = mysqli_query($con,$sql);
       return $result;
   }
   public static function getAllResourcesId()
   {
       $con = $GLOBALS["con"];
       $sql = "Select * from resources";
       $result = mysqli_query($con,$sql);
       return $result;
   }
   public static function getResourceIdByResourceName($resource_name)
   {
       $con = $GLOBALS["con"];
       $sql ="Select resource_id from resources where resource_name = UPPER('$resource_name')";
       $result = mysqli_query($con,$sql);
       if($val = mysqli_fetch_array($result))
       {
           return $val["resource_id"];
       }
   }
   public static function GetResourceNameByResourceId($resource_id)
   {
       $con = $GLOBALS["con"];
       $sql ="Select resource_name from resources where resource_id = $resource_id";
       $result = mysqli_query($con,$sql);
       if($val = mysqli_fetch_array($result))
       {
           return $val["resource_name"];
       }
   }
   //get all events
   static function getAllEvents(){
    $con = $GLOBALS['con'];
    $resource_id = self::getResourceIdByResourceName('events');
    $sql = "SELECT content_title, content_text, date_format(event_date, '%m/%d/%y') as event_date FROM content WHERE resource_id = $resource_id ORDER BY event_date";
    $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $eventDate = $row["event_date"];
             echo "  <h3>Next Events</h3>
             <hr>
             <h5 class=\"card-title\">" . $row['content_title'] . "</h5>
             <span class=\"badge badge-info\">$eventDate</span>
             <p class=\"card-text\">" . $row['content_text'] ."</p><br>";
        }
   } 

    //get next 2 events
    static function getNextEvents(){
    $con = $GLOBALS['con'];
    $resource_id = self::getResourceIdByResourceName('events');
    $sql = "SELECT content_title, content_text, date_format(event_date, '%m/%d/%y') as event_date FROM content WHERE resource_id = $resource_id ORDER BY event_date LIMIT 2";
    $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $eventDate = $row["event_date"];
                echo "<hr>
                <h5 class=\"card-title\">". $row['content_title']."</h5>
                <span class=\"badge badge-info\">$eventDate</span>
                <p class=\"card-text\">". $row['content_text'] ."</p>
                <a href=\"events.php\" class=\"btn btn-outline-primary btn-block\">See Details</a>";
        }
    } 

   //get two newest articles to display on index
   static function getTopArticles(){
    $con = $GLOBALS['con'];
    $resource_id = self::getResourceIdByResourceName('articles');
    $sql = "SELECT content_title, content_text, date_format(date_created, '%m/%d/%y') as date_created FROM content WHERE resource_id = $resource_id ORDER BY date_created LIMIT 2";
    $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $date_created = $row["date_created"];
         echo "
         <h2>" . $row['content_title'] ."<span style=\"font-size:15px; float:right\">$date_created</span></h2>
         <div id =\"readMore\">
         <p class=\"collapse\" id=\"collapseSummary\">". $row['content_text'] . "</p>
         <a class=\"collapsed\" data-toggle=\"collapse\" href=\"#collapseSummary\" aria-expanded=\"false\" aria-controls=\"collapseSummary\"></a>
         </div><br>";
      
        }    
    }
    //get all articles to display on articles.php
   static function getAllArticles(){
    $con = $GLOBALS['con'];
    $resource_id = self::getResourceIdByResourceName('articles');
    $sql = "SELECT content_title, content_text, date_format(date_created, '%m/%d/%y') as date_created FROM content WHERE resource_id = $resource_id ORDER BY date_created";
   
    $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        $date_created = $row["date_created"];
        echo "<div class=\"the-content\">
        <h1>" . $row['content_title'] . "</h1>
        <hr> <span style=\"font-size:15px; float:left\">$date_created</span><br><br>
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
               $resource_name = $val['resource_name'];
               echo "<option value='$resource_name'>$resource_name</option>";

           }
       }
    }

    public static function CheckAndInsertContent($content,$resource_name)
    {       
        $result = self::CheckResourceID($resource_name);
        if(mysqli_num_rows($result) > 0 )
        {   
            $resource_id = self::getResourceIdByResourceName($resource_name);
            self::InsertContent($resource_id,$content->title,$content->contentText,$content->contentDescription);
        }
        else{               
                if(self::InsertResourceId($resource_name))
                {
                    $resource_id = self::getResourceIdByResourceName($resource_name);
                    self::InsertContent($resource_id,$content->title,$content->contentText,$content->contentDescription);
                }
                else{
                    header("location:content.php");
                }                
            }
    }
    public static function InsertContent($resource_id,$content_title,$content_text,$content_description)
    {
        $con = $GLOBALS["con"];
        $resource_id = strtoupper($resource_id);
        $sql = "Insert into content(resource_id,content_title,content_text,content_description) Values('$resource_id','$content_title','$content_text','$content_description') ";                
        mysqli_query($con,$sql);
        if(!mysqli_affected_rows($con) == 1)
        {
          header("location:content.php");        
        }
       
    }
    public static function CheckResourceID($resource_name)
    {
        $con = $GLOBALS["con"];
        $sql = "Select resource_id from resources where resource_name = UPPER('$resource_name')";
        $result = mysqli_query($con,$sql);
        return $result;
    }

    public static function InsertResourceId($resource_name)
    {
        $con = $GLOBALS["con"];
        $sql = "Insert into resources(resource_name) values('$resource_name')";
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

    public static function GetListofCreatedContent()
    {
        $con = $GLOBALS["con"];
        $all_contents = self::GetAllContents();
        $count = 0;
        if(mysqli_num_rows($all_contents) > 0)
        {
            while($val = mysqli_fetch_array($all_contents))
            {
                $content_id = $val["content_id"];
                $resource_name = self::GetResourceNameByResourceId($val["resource_id"]);
                $title = $val["content_title"];
                $content_text = ($val["content_text"]);
                $content_description = $val["content_description"];
                $date_created = $val["date_created"];
                $count +=1;
                echo 
                "<tr>
                <td>$count</td>
                <td>$title</td>
                <td>$resource_name</td>
                <td>$date_created</td>
                <td align=\"right\">
                    <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-secondary\">Preview</a>
                    <a href=\"#\" type=\"button\" onclick=\"RedirectEditContent('$resource_name','$title', '$content_description' ,`$content_text`,$content_id);\" class=\"btn btn-sm btn-info\">Edit</a>
                    <a href=\"functions/proc_deleteContent.php?contentId=$content_id\" onclick = \"return CheckDelete(event)\"type=\"button\" class=\"btn btn-sm btn-danger\">Delete</a>
                </td>            
                </tr>";
            }
        }
        else{
            echo "<tr>
			 <td>1</td>
            <td>No content</td>
            <td>Resource Name</td>
            <td>2021/01/01</td>
            <td>Author name</td>
            <td align=\"right\">
                <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-secondary\">Access/Preview</a>
                <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-info\">Edit Content</a>
                <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-danger\">Delete</a>
            </td>            
            </tr>";
        }
    }
    
    public static function DeleteContent($contentId)
    {
        $con = $GLOBALS["con"];
        $sql = "Delete from content where content_id = $contentId";
        mysqli_query($con,$sql);
        if(!mysqli_affected_rows($con) == 1)
        {
          header("location:administrator.php");
        }
    }
        
    

    public static function DeleteResourceIdInContent($resource_id)
    {
        $con = $GLOBALS["con"];
        $sql = "delete from content where resource_id = $resource_id";
        mysqli_query($con,$sql);
    }
    public static function DeleteResources($resourceId)
    {
        $con = $GLOBALS["con"];
        $sql = "delete from resources where resource_id  = $resourceId";
        mysqli_query($con,$sql);
        if(!mysqli_affected_rows($con) > 0)
        {
            echo "fail";
        }
        else{
            return true;
        }
    }
    public static function UpdateEditedContent($content,$resource_name)
    {
        $con = $GLOBALS["con"];
        $resource_id = self::getResourceIdByResourceName($resource_name);
        $sql = "update content set resource_id = $resource_id, content_title='$content->title', content_text = '$content->contentText', content_description='$content->contentDescription' where content_id = $content->contentId ";
        mysqli_query($con,$sql);
        if(mysqli_affected_rows($con) == 1)
        {
            return true;
        }
        else{
            return false;
        }
    }
}
