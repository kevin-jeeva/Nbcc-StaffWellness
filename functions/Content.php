<?php
include_once("connect.php");
include_once("Phone.php");

class Content
{
  private $contentId;
  private $resourceId;
  private $title;
  private $contentText;
  private $image;
  private $dateCreated;
  private $eventDate;

  function __construct($contentId, $resourceId, $title, $contentText, $contentDescription, $image, $dateCreated, $eventDate)
  {
    $this->contentId = $contentId;
    $this->resourceId = $resourceId;
    $this->title = $title;
    $this->contentText = $contentText;
    $this->contentDescription = $contentDescription;
    $this->image = $image;
    $this->dateCreated = $dateCreated;
    $this->eventDate = $eventDate;
  }
  public function __destruct()
  {

    //this is destruct the object one the object is completed it process :)
  }
  public static function GetLastContentById($content_id)
  {
    $con = $GLOBALS["con"];
    $sql = "Select content_id,resource_id, content_title, content_description from content where content_id = $content_id";
    $result = mysqli_query($con, $sql);
    return $result;
  }

  public static function GetContentByResourceId($resource_id)
  {
    $con = $GLOBALS["con"];
    $sql = "Select content_id,content_title, content_description from content where resource_id = $resource_id";
    $result = mysqli_query($con, $sql);
    return $result;
  }

  public static function GetAllContents()
  {
    $con = $GLOBALS["con"];
    $sql = "Select content_id, resource_id, content_title, content_text, content_description, date_format(date_created, '%m/%d/%y') as date_created from content";
    $result = mysqli_query($con, $sql);
    return $result;
  }
  public static function getAllResourcesId()
  {
    $con = $GLOBALS["con"];
    $sql = "Select * from resources";
    $result = mysqli_query($con, $sql);
    return $result;
  }
  public static function getResourceIdByResourceName($resource_name)
  {
    $con = $GLOBALS["con"];
    $sql = "Select resource_id from resources where resource_name = UPPER('$resource_name')";
    $result = mysqli_query($con, $sql);
    if ($val = mysqli_fetch_array($result)) {
      return $val["resource_id"];
    }
  }
  public static function GetResourceNameByResourceId($resource_id)
  {
    $con = $GLOBALS["con"];
    $sql = "Select resource_name from resources where resource_id = $resource_id";
    $result = mysqli_query($con, $sql);
    if ($val = mysqli_fetch_array($result)) {
      return $val["resource_name"];
    }
  }

  //get all events
  static function getAllEvents($limit)
  {
    //important for pagination. DON'T DELETE!
    if (isset($_GET["page"])) {
      $page = $_GET["page"];
    }
    else{ 
      $page=1;
    }
    //important for pagination. DON'T DELETE!
    $start_from = ($page-1) * $limit;

    $IsThereEvents = true;
    $con = $GLOBALS['con'];
    $resource_id = self::getResourceIdByResourceName('events');
    $sql = "SELECT content_id, content_title, content_text, content_description, date_format(event_date, '%m/%d/%y') as event_date FROM content WHERE resource_id = $resource_id ORDER BY event_date DESC LIMIT $start_from, $limit";

    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $content_id = $row["content_id"];
      $eventDate = $row["event_date"];
      $today = date("d-m-Y"); //todays date Year-mth-day
      //only show events that are not expired
      if ($eventDate >= $today) {
        echo "
           <div class=\"events-tile card shadow-sm p-2 m-1\">
           <div class=\"card-body\">
           <h3 class=\"card-title\">" . $row['content_title'] . "</h3>
           <span class=\"badge badge-ngreen\">Date: $eventDate</span>
           <p class=\"content_text\">" . $row['content_description'] . "</p>
           <a href=\"#\" class=\"btn btn-outline-ngreen btn-block\" onclick=\"ReadArticle($content_id)\">Read More</a>
           </div></div>";
      }
      else{
        $IsThereEvents = false;
      }
    }
    if (!$IsThereEvents){
      echo "<div class=\"events-tile card shadow-sm p-2 m-1\">
      <div class=\"card-body text-secondary\">
      <h1><i class=\"bi bi-calendar-x-fill\"></i></h1>
      <h3 class=\"card-title\">No events scheduled for now</h3>
      </div></div>";
    }

    //pagination function: Parameters (table's name, articles number limit, link path (without '.php'))
    $result = self::pagePagination("content", $limit, "events");
    echo $result;
  }


  //get next events with limit number
  static function getNextEvents($limit)
  {
    $IsThereEvents = true;
    $con = $GLOBALS['con'];
    $today = date("d-m-Y"); //todays date Year-mth-day

    $resource_id = self::getResourceIdByResourceName('events');
    $sql = "SELECT content_id,content_title, content_description, date_format(event_date, '%m/%d/%y') as event_date FROM content WHERE resource_id = $resource_id ORDER BY event_date DESC LIMIT 2";
    $sql = "SELECT content_id, content_title, content_text, content_description, date_format(event_date, '%m/%d/%y') as event_date FROM content WHERE resource_id = $resource_id ORDER BY event_date LIMIT $limit";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $content_id = $row["content_id"];
      $eventDate = $row["event_date"];

      //only show events that are not expired
      /* if ($row["event_date"] >= $today) {
        $daystillevent = $today - $row["event_date"];
        echo $daystillevent;
        $sql2 = "SELECT content_id,content_title, content_description, date_format(event_date, '%m/%d/%y') as event_date FROM content WHERE resource_id = $resource_id ORDER BY $daystillevent DESC LIMIT 2";
        $result = mysqli_query($con, $sql2);
        while ($row = mysqli_fetch_assoc($result)) {
          $content_id = $row["content_id"];
          $eventDate = $row["event_date"];
          echo "<hr>
          <h5 class=\"card-title\">" . $row['content_title'] . "</h5>
          <span class=\"badge badge-info\">$eventDate</span>
          <p class=\"card-text\">" . $row['content_description'] . "</p>
          <a href=\"#\" class=\"btn btn-outline-info btn-block\" onclick=\"ReadEvents($content_id)\">See Details</a>";
        }*/
      echo "<hr>
                <h5 class=\"card-title\">" . $row['content_title'] . "</h5>
                <span class=\"badge badge-info\">$eventDate</span>
                <p class=\"card-text\">" . $row['content_description'] . "</p>
                <a href=\"#\" class=\"btn btn-outline-info btn-block\" onclick=\"ReadEvents($content_id)\">See Details</a>";
      $today = date("d-m-Y"); //todays date Year-mth-day
      //only show events that are not expired
      if ($eventDate >= $today) {
        echo "<hr>
        <h5 class=\"card-title\">" . $row['content_title'] . "</h5>
        <span class=\"badge badge-ngreen\">$eventDate</span>
        <p class=\"card-text\">" . $row['content_description'] . "</p>
        <a href=\"#\" class=\"btn btn-outline-ngreen btn-block\" onclick=\"ReadEvents($content_id)\">See Details</a>";
      }
      else{
        $IsThereEvents = false;
      }
    }
    if (!$IsThereEvents){
      echo "<div class=\"card-no-events\" ><div class=\"container text-secondary text-center\">
      <h1><i class=\"bi bi-calendar-x-fill\"></i></h1>
      <h5>No events scheduled for now</h5>
      </div></div>";
    }
  }

  //get two newest articles to display on index
  static function getTopArticles($limit)
  {
    $con = $GLOBALS['con'];
    $sql = "SELECT content_id, resource_id, content_title, content_text, content_description, date_format(date_created, '%m/%d/%y') as date_created FROM content ORDER BY date_created DESC LIMIT $limit";


    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $resource_name = self::GetResourceNameByResourceId($row['resource_id']);
      $date_created = $row["date_created"];
      echo "<div class=\"block-last-viewed\">
          <a class=\"text-dark\" href=\"#\"  onclick=\"ReadArticle(" . $row['content_id'] . ")\">
          <p class=\"h3 text-dark\">" . $row['content_title'] . "</p></a>
          <span class=\"badge badge-pill badge-ngreen\">$resource_name</span>
          <span class=\"badge badge-pill badge-light\">Created on: $date_created</span>
          <p class=\"content_text\">" . $row['content_description'] . "</p>
          <a class=\"btn btn-outline-ngreen\" href=\"#\" onclick=\"ReadArticle(" . $row['content_id'] . ")\">Read More</a>
          </div>";
    }
  }

  //get all articles to display on each resource page (e.g. articles.php)
  static function getAllArticles($resourceName, $limit)
  {
    //important for pagination. DON'T DELETE!
    if (isset($_GET["page"])) {
      $page = $_GET["page"];
    }
    else{ 
        $page=1;
    }
    //important for pagination. DON'T DELETE!
    $start_from = ($page-1) * $limit;

    $con = $GLOBALS['con'];
    $resource_id = self::getResourceIdByResourceName($resourceName);
    $sql = "SELECT content_id, content_title, content_text, content_description, date_format(date_created, '%m/%d/%y') as date_created FROM content WHERE resource_id = $resource_id ORDER BY date_created DESC LIMIT $start_from, $limit";

    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $date_created = $row["date_created"];
      echo "<div class=\"the-content\">
          <a class=\"text-dark\" href=\"#\"  onclick=\"ReadArticle(" . $row['content_id'] . ")\">
          <p class=\"h1 text-dark\">" . $row['content_title'] . "</p></a>
          <hr><span class=\"badge badge-pill badge-light\">Created on: $date_created</span>
          <p class=\"content_text\">" . $row['content_description'] . "</p>
          <a class=\"btn btn-outline-ngreen\" href=\"#\" onclick=\"ReadArticle(" . $row['content_id'] . ")\">Read More</a>
          </div>";
    }

    //pagination function: Parameters (table's name, articles number limit, link path (without '.php'))
    $result = self::pagePagination("content", $limit, "articles");
    echo $result;
  }

  static function getContentById($content_id)
  {
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM content WHERE content_id = '$content_id' ORDER BY date_created";

    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $date_created = $row["date_created"];
      echo "<div class=\"the-content\">
        <h1>" . $row['content_title'] . "</h1>
        <hr>
        <p class=\"content_text\">" . $row['content_text'] . "</p><br></div>";
    }
  }

  static function getContentInfo($content_id)
  {
    $con = $GLOBALS['con'];
    $sql = "SELECT * FROM content WHERE content_id = '$content_id' ORDER BY date_created";
    $db_contentinfo = array();

    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $db_contentinfo = $row;
      $db_contentinfo["resource_name"] = self::GetResourceNameByResourceId($db_contentinfo["resource_id"]);
    }
    return $db_contentinfo;
  }

  public static function getContents()
  {
    $result = self::getAllResourcesId();
    if (mysqli_num_rows($result) > 0) {
      while ($val = mysqli_fetch_array($result)) {
        $resource_name = $val['resource_name'];
        echo "<option value='$resource_name'>$resource_name</option>";
      }
    }
  }

  public static function CheckAndInsertContent($content, $resource_name)
  {
    $result = self::CheckResourceID($resource_name);
    if (mysqli_num_rows($result) > 0) {
      $resource_id = self::getResourceIdByResourceName($resource_name);
      if ($content->eventDate == null) {
        self::InsertContent($resource_id, $content->title, $content->contentText, $content->contentDescription);
        $content_id = self::getContentID($resource_id, $content->title, $content->contentDescription);
        self::insertContentNotification($content_id);
        Phone::SendMessage($resource_name, $content->contentDescription, $content->title);
        // Send Email (resource_name, description, title);

      } else {
        self::InsertContentforEvents($resource_id, $content->title, $content->contentText, $content->contentDescription, $content->eventDate);
        $content_id = self::getContentID($resource_id, $content->title, $content->contentDescription);
        self::insertContentNotification($content_id);
        Phone::SendMessage($resource_name, $content->contentDescription, $content->title);
      }
    } else {
      if (self::InsertResourceId($resource_name)) {
        $resource_id = self::getResourceIdByResourceName($resource_name);
        if ($content->eventDate == null) {
          self::InsertContent($resource_id, $content->title, $content->contentText, $content->contentDescription);
          $content_id = self::getContentID($resource_id, $content->title, $content->contentDescription);
          self::insertContentNotification($content_id);
          Phone::SendMessage($resource_name, $content->contentDescription, $content->title);
        } else {
          self::InsertContentforEvents($resource_id, $content->title, $content->contentText, $content->contentDescription, $content->eventDate);
          $content_id = self::getContentID($resource_id, $content->title, $content->contentDescription);
          self::insertContentNotification($content_id);
          Phone::SendMessage($resource_name, $content->contentDescription, $content->title);
        }
      } else {
        header("location:content.php");
      }
    }
  }
  public static function InsertContentforEvents($resource_id, $content_title, $content_text, $content_description, $event_date)
  {
    $con = $GLOBALS["con"];
    $resource_id = strtoupper($resource_id);
    $sql = "Insert into content(resource_id,content_title,content_text,content_description,event_date) Values('$resource_id','$content_title','$content_text','$content_description', '$event_date')";
    mysqli_query($con, $sql);
    if (!mysqli_affected_rows($con) == 1) {
      header("location:content.php");
    }
  }
  public static function InsertContent($resource_id, $content_title, $content_text, $content_description)
  {
    $con = $GLOBALS["con"];
    $sql = "Insert into content(resource_id,content_title,content_text,content_description) Values($resource_id,'$content_title','$content_text','$content_description') ";
    mysqli_query($con, $sql);
    if (!mysqli_affected_rows($con) == 1) {
      header("location:content.php");
    }
  }
  //get content id based on all identifiers
  //there's likely a more effecient way of doing this but this is the best I could come up with for the time being 
  public static function getContentID($resource_id, $content_title, $content_description)
  {
    $con = $GLOBALS["con"];
    $resource_id = strtoupper($resource_id);
    $sql = "SELECT content_id from content where resource_id =$resource_id and content_title = '$content_title' and content_description = '$content_description'";
    echo $sql;
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
      return $row['content_id'];
    }
  }

  //insert content notification 
  public static function insertContentNotification($contentId)
  {
    $con = $GLOBALS["con"];
    $sql = "INSERT into notification (content_id, notification_repeat) values  ($contentId, 1)";
    mysqli_query($con, $sql);
    self::sendUserNotification();
  }
  //send notification to user table 
  public static function sendUserNotification()
  {
    $con = $GLOBALS["con"];
    $sqlGetCount = "SELECT staff_id, notification_counter from user";
    $result = mysqli_query($con, $sqlGetCount);
    while ($row = mysqli_fetch_assoc($result)) {
      $count = 1;
      $count += (int)$row['notification_counter'];
      $user = $row['staff_id'];
      $sqlAddCount = "update user set notification_counter = $count where staff_id = $user";
      mysqli_query($con, $sqlAddCount);
    }
  }
  //reset notification bubble to 0
  public static function resetBubble()
  {
    $con = $GLOBALS["con"];
    $user = $_SESSION["staff_id"];
    $sql = "update user set notification_counter = 0 where staff_id = $user";
    mysqli_query($con, $sql);
  }
  //check if notifications are on or not
  public static function checkNotificationsOn(){
    $user = $_SESSION["staff_id"];
    $con = $GLOBALS["con"];
    $sql = "select notificationsOn from user where staff_id = $user";
    $result = mysqli_query($con,$sql); 
    $row = mysqli_fetch_assoc($result); 
    return $row["notificationsOn"];
  }
  //send number of unread notifications to notification bubble
  public static function setNotificationBubble()
  {
    $on = self::checkNotificationsOn();

    if ($on == "on") {
      $con = $GLOBALS["con"];
      $user = $_SESSION["staff_id"];
      $sql = "SELECT notification_counter from user where staff_id = $user";
      $result = mysqli_query($con, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $count = $row['notification_counter'];
        if ($count != 0) {
          return "<script>document.getElementById(\"notify-container\");</script>" . $count;
        } else {
          return "<script>document.getElementById(\"notify-container\").style.display = \"none\";</script>";
        }
      }
    }
  }

  public static function getContentNotifications($limit)
  {
    //important for pagination. DON'T DELETE!
    if (isset($_GET["page"])) {
      $page = $_GET["page"];
    }
    else{ 
      $page=1;
    }
    //important for pagination. DON'T DELETE!
    $start_from = ($page-1) * $limit;

    $con = $GLOBALS["con"];
    $sql = "select date_created, resource_id, content_id, content_title, content_description from content order by date_created DESC LIMIT $start_from, $limit";

    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      $contentName = self::GetResourceNameByResourceId($row["resource_id"]);
      $contentName = rtrim($contentName, "s");
      $content_id = $row["content_id"];
      $date = strtotime($row["date_created"]);
      $set_date = date("F d, Y | g:ia", $date);
      echo "<div class=\"col-lg-4 col-md-6 col-sm-12\">
            <div class=\"features-categories-item mx-auto mb-5 mb-lg-0 mb-lg-3\">
            <div class=\"main-card card\">
                <span class=\"not-time-frame bg-ngreen text-center text-white\">$set_date</span>
                <div class=\"card-notifications\">
                    <h3>" . $row['content_title'] . "</h3>                     
                    <p>" . $row['content_description'] . "</p>                        
                    <a href=\"#\" class=\"btn btn-outline-ngreen btn-block\" onclick=\"ReadArticle($content_id)\">View Content</a>
                </div>
            </div>
            </div>
          </div>";
    }

    //pagination function: Parameters (table's name, articles number limit, link path (without '.php'))
    $result = self::pagePagination("content", $limit, "notifications");
    echo $result;
  }
  public static function bellNotifications()
  { 
    $on = self::checkNotificationsOn();

    if ($on == "on") {
      $con = $GLOBALS["con"];   
      $sql = "select date_created, resource_id, content_id, content_title, content_description from content order by date_created desc limit 3";
      $string = "";
      $result = mysqli_query($con, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $contentName = self::GetResourceNameByResourceId($row["resource_id"]);
        $contentName = rtrim($contentName, "s");
        $content_id = $row["content_id"];
        if ($content_id === null) {
          $content_id = 0;
        }
        $date = strtotime($row["date_created"]);
        $content_title = $row["content_title"];
        $set_date = date("F d, Y | g:ia", $date);
        $string .=
          "<a href=\"#\" id=\"hi\" onclick=\"ReadArticle($content_id)\"><div id=\"$content_id\"><h5>$contentName</h5><p>$content_title</p><p class=\"badge badge-pill badge-ngreen\"> $set_date</p></div></a><hr>";
      }
      return $string;
    }
  }

  public static function CheckResourceID($resource_name)
  {
    $con = $GLOBALS["con"];
    $sql = "Select resource_id from resources where resource_name = UPPER('$resource_name')";
    $result = mysqli_query($con, $sql);
    return $result;
  }

  public static function InsertResourceId($resource_name)
  {
    $con = $GLOBALS["con"];
    $sql = "Insert into resources(resource_name) values('$resource_name')";
    mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
      return true;
    } else {
      return false;
    }
  }

  public static function GetListofCreatedContent()
  {
    $con = $GLOBALS["con"];
    $all_contents = self::GetAllContents();
    $count = 0;
    if (mysqli_num_rows($all_contents) > 0) {
      while ($val = mysqli_fetch_array($all_contents)) {
        $content_id = $val["content_id"];
        $resource_name = self::GetResourceNameByResourceId($val["resource_id"]);
        $title = $val["content_title"];
        $content_text = htmlentities($val["content_text"]);
        $content_description = $val["content_description"];
        $date_created = $val["date_created"];
        $count += 1;
        echo
        "<tr>
                <td>$count</td>
                <td>$title</td>
                <td>$resource_name</td>
                <td>$date_created</td>
                <td align=\"right\">
                    <a href=\"view.php?page=" . $content_id . "\" type=\"button\" class=\"btn btn-sm btn-nblue\">Preview</a>
                    <a href=\"#\" type=\"button\" onclick=\"RedirectEditContent('$resource_name','$title', '$content_description' ,`$content_text`,$content_id);\" class=\"btn btn-sm btn-nblue\">Edit</a>
                    <a href=\"functions/proc_deleteContent.php?contentId=$content_id\" onclick = \"return CheckDelete(event)\"type=\"button\" class=\"btn btn-sm btn-danger\">Delete</a>
                </td>            
                </tr>";
      }
    } else {
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
    self::DeleteNotification($contentId);
    $con = $GLOBALS["con"];
    $sql = "Delete from content where content_id = $contentId";
    mysqli_query($con, $sql);
    if (!mysqli_affected_rows($con) == 1) {
      header("location:administrator.php");
    }
  }

  public static function DeleteNotification($contentId)
  {
    $con = $GLOBALS["con"];
    $sql = "delete from notification where content_id = $contentId";
    mysqli_query($con, $sql);
  }


  public static function DeleteResourceIdInContent($resource_id)
  {
    $con = $GLOBALS["con"];
    $sql = "delete from content where resource_id = $resource_id";
    mysqli_query($con, $sql);
  }
  public static function DeleteResources($resourceId)
  {
    $con = $GLOBALS["con"];
    $sql = "delete from resources where resource_id  = $resourceId";
    mysqli_query($con, $sql);
    if (!mysqli_affected_rows($con) > 0) {
      echo "fail";
    } else {
      return true;
    }
  }
  public static function UpdateEditedContent($content, $resource_name)
  {
    $con = $GLOBALS["con"];
    $resource_id = self::getResourceIdByResourceName($resource_name);
    $sql = "update content set resource_id = $resource_id, content_title='$content->title', content_text = '$content->contentText', content_description='$content->contentDescription' where content_id = $content->contentId ";
    mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
      return true;
    } else {
      return false;
    }
  }

  public static function pagePagination($table, $limit, $linkname){
    $con = $GLOBALS["con"];
    $result_db = mysqli_query($con,"SELECT COUNT($table"."_id) FROM $table"); 
    $row_db = mysqli_fetch_row($result_db);  
    $total_records = $row_db[0];  
    $total_pages = ceil($total_records / $limit);

    $pagLink = "<div class=\"container d-flex justify-content-center\"><div class=\"row text-center\"><ul class=\"pagination\">";  
    for ($i=1; $i<=$total_pages; $i++) {
      $pagLink .= "<li class=\"page-item\"><a class=\"page-link bg-white text-ngreen\" href=\"".$linkname.".php?page=".$i."\">".$i."</a></li>";
    }
    $pagLink .= "</ul></div></div>";
    return $pagLink;
  }
}