<?php
include_once("connect.php");
include_once("Content.php");
include_once("Resource.php");
include_once("Progress.php");

class Welcome{
  private $welcome_id;
  private $welcome_title;
  private $welcome_text;
  private $welcome_image;
  private $date_created;
 
  function __construct($welcome_id,$welcome_title,$welcome_text,$welcome_image,$date_created)
 {
  $this->welcome_id = $welcome_id;
  $this->welcome_title = $welcome_title;
  $this->welcome_text = $welcome_text;
  $this->welcome_image = $welcome_image;
  $this->date_created = $date_created;
 }
 
 public function __set($name, $value)
 {
   $this->$name = $value;
 }
 public function __get($name)
 {
   return $this->$name;
 }

 public static function getAllDataFromWelcome()
 {
  $con = $GLOBALS["con"];
  $sql = "select welcome_id, welcome_title,welcome_text,welcome_image,date_format(date_created, '%m/%d/%y') as date_created from welcome";
  $result = mysqli_query($con,$sql);  
  return $result;

 }//end of function

 public static function GetRandomWelcome()
 {
   $con = $GLOBALS["con"];
   $sql ="Select welcome_title,welcome_text,welcome_image from welcome order by Rand() limit 1";
   $result = mysqli_query($con,$sql);
   return $result;
 }

 public static function GetListofCreatedWelcoms()
 {
   $result = self::getAllDataFromWelcome();
   $count = 0;
    if(mysqli_num_rows($result) > 0)
    {
      while($val = mysqli_fetch_array($result))
      {
        $id = $val["welcome_id"];
        $title = $val["welcome_title"];
        $text = $val["welcome_text"];
        $image = $val["welcome_image"];
        $date_created = $val["date_created"];
        $count +=1;
         echo "<tr>
       <td>$count</td>
            <td>$title</td>           
            <td>$date_created</td>          
            <td align=\"right\">                
                <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"RedirectEditWelcome($id,'$title','$text','$image')\">Edit Content</a>
               <a href=\"functions/proc_deleteWelcome.php?welcomeId=$id\" onclick = \"return CheckDelete(event)\"type=\"button\" class=\"btn btn-sm btn-danger\">Delete</a>
            </td>            
            </tr>";
      }
    }
    else{
       echo "<tr>
       <td>1</td>
            <td>No content</td>
            <td>No content</td>                   
            <td align=\"right\">                
                <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-info\">Edit Content</a>
                <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-danger\">Delete</a>
            </td>            
            </tr>";
    }
 }//end of function

 public static function InsertWelcome($welcome)
 {
  $con = $GLOBALS["con"];
  $title = $welcome->welcome_title;
  $text = $welcome->welcome_text;
  $image = $welcome->welcome_image;
  $sql = "Insert into welcome (welcome_title,welcome_text, welcome_image) values ('$title','$text','$image')";
  echo $sql;
  mysqli_query($con,$sql);
  if(mysqli_affected_rows($con) > 0)
 {
   return true;
 }
 else{
   return false;
 }
 }//end function
 
 public static function DeleteWelcomContent($id)
 {
   $con = $GLOBALS["con"];
   $sql ="Delete from welcome where welcome_id = $id";
   mysqli_query($con,$sql);
   if(mysqli_query($con,$sql) > 0)
   {
     return true;
   }
   else{
     return false;
   }
 }

 public static function UpdateWelcome($welcome)
 {
   $con = $GLOBALS["con"];
   $title = $welcome->welcome_title;
   $text = $welcome->welcome_text;
   $id = $welcome->welcome_id;
   $image_name = $welcome->welcome_image;
   
   if($image_name == 0)
   {
       $sql = "Update welcome set welcome_title = '$title',welcome_text = '$text' where welcome_id = $id";    
      mysqli_query($con, $sql);
      if(mysqli_affected_rows($con) > 0)
      {
        return true;
      }
      else
      {
        return false;
      }
   }
   else
   {
       $sql = "Update welcome set welcome_title = '$title', welcome_text = '$text' ,welcome_image = '$image_name' where welcome_id = $id";       
      mysqli_query($con, $sql);
      if(mysqli_affected_rows($con) > 0)
      {
        return true;
      }
      else
      {
        return false;
      }
   }

 }

 public static function DisplayWelcomeContent()
 {
    $result = self::GetRandomWelcome();
    
    if(mysqli_num_rows($result) > 0)
    {
      if($val = mysqli_fetch_array($result))
      {
        $welcome_title = $val["welcome_title"];
        $welcome_text = $val["welcome_text"];
        $welcome_image = $val["welcome_image"];
        echo "<div class=\"jumbotron jumbotron-fluid bg-dark\">  
        <div class=\"jumbotron-background\">
          <img src=\"includes/imgs/welcome_images/$welcome_image\" class=\"blur\">
        </div>
        <div class=\"container text-white\">
          <h1 class=\"display-5\">$welcome_title</h1>
          <p class=\"lead\">$welcome_text</p>                 
        </div>          
      </div>";
      }
    }
    else
    {
      echo "<header class=\"masthead text-white text-center\" style=\"background: url('includes/imgs/0-wellbeing-main.jpg') no-repeat center center; background-size: cover;\">
        <div class=\"overlay\"></div>
        <div class=\"container\">
          <div class=\"row\">
            <div class=\"col-xl-9 mx-auto\">
              <h1 class=\"mb-5\">Welcome</h1>                     
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac sapien sit amet elit imperdiet iaculis. Phasellus hendrerit posuere maximus.</p>
            </div>
            <div class=\"col-md-10 col-lg-8 col-xl-7 mx-auto\">
              <p></p>
            </div>
          </div>
        </div>
    </header>";
    }
   
 }
 
 public static function GetLastViewed($user_id)
 {
   $con = $GLOBALS["con"];
   $sql = "select content_id, progress_value, date_format(date_created, '%m/%d/%y') as date_created from progress where user_id = $user_id order by progress_id desc limit 3";
   $result = mysqli_query($con,$sql);
   if(mysqli_num_rows($result) > 0)
   {
     while($val = mysqli_fetch_array($result))
     {
       $content_id = $val["content_id"];
       $content_result = Content::GetLastContentById($content_id);
       if($content_val = mysqli_fetch_array($content_result))
       {
         $content_desc = $content_val["content_description"];
         $content_title = $content_val["content_title"];
         $date = $val["date_created"];
         echo "<h3>$content_title<span style=\"float:right; font-size:15px;\">Viewed on: $date</span></h3>
          <p>$content_desc</p>
          <a href=\"view.php?page=$content_id\" class=\"btn btn-md btn-primary\">Read More</a><hr>";
       }
     }
   }
   else
   {
     echo "<h3>No Last view at this moment</h3>";
   }
 }

 public static function GetProgressContent($staff_id)
 {
   $resource_ids = Resource::getAllResourcesId();
   $count_divide = 0;
   $progress_value = 0;
   $row_count = 0;

   if(mysqli_num_rows($resource_ids) > 0)
   {
     while($resource_id = mysqli_fetch_array($resource_ids))
     {
       $total = 0;
       $count_divide = 0;
       $progress_value = 0;

       $resource_name = $resource_id["resource_name"];
       $content_ids = Content::GetContentByResourceId($resource_id["resource_id"]);
      if(mysqli_num_rows($content_ids) > 0)
      {
        while($content_id = mysqli_fetch_array($content_ids))
        {
          $progress = Progress::GetProgress($staff_id,$content_id["content_id"]);
        
          if(mysqli_num_rows($progress) > 0)
          {
            while($progress_val = mysqli_fetch_array($progress))
            {
              $progress_value += $progress_val["progress_value"];

            }
          }          
          $count_divide += 1; //divide by total
        }
      }
      else
      {
        continue; //go to next resource
      }
      //display the progres value     
      $total = round($progress_value / $count_divide);
      $row_count += 1;
      echo "<tr><th scope=\"row\"> $row_count</th>
            <td>$resource_name</td>
            <td><div class=\"progress\">
						<div class=\"progress-bar progress-bar-striped progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"75\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $total%\">$total%</div>
					</div></td></tr>";
       
     }
   }
   else
   {
     echo "No Progressa At this moment";
   }
   	
 }
 public static function SuggestedContent($staff_id)
 {
   $con = $GLOBALS["con"];
   $sql = "select content.content_title,content.content_id,content.content_description,date_format(content.date_created, '%m/%d/%y') as date_created from content inner join resources on content.resource_id = resources.resource_id where resources.resource_name NOT IN ('Video Exercises', 'Sound Exercises') and content.content_id  NOT in (select pg.content_id from progress pg where user_id = $staff_id) order by rand() limit 2;";
   
   $result = mysqli_query($con,$sql);
   if(mysqli_num_rows($result) > 0)
   {
      while($val = mysqli_fetch_array($result))
    {
      $content_id = $val["content_id"];
       echo "<hr> 
        <h5 class=\"card-title\">". $val['content_title']."</h5>
        <span class=\"badge badge-info\">".$val['date_created']."</span>
        <p class=\"card-text\">". $val['content_description'] ."</p>
        <a href=\"#\" class=\"btn btn-outline-info btn-block\" onclick=\"ReadEvents($content_id)\">See Details</a>";
    }
   }
   else
   {
     Content::getNextEvents();
   }
  
 }

 public static function GetMostViewed($staff_id)
 {
   $con =$GLOBALS["con"];
   $sql = "select content_id from staff.progress order by views desc Limit 4";
   $result = mysqli_query($con,$sql);
   if(mysqli_num_rows($result) > 0)
   {
    while($val = mysqli_fetch_array($result))
    {
      $content_id = $val["content_id"];
      $content_result = Content::GetLastContentById($content_id);
      while($content_val = mysqli_fetch_array($content_result))
      {
        $resource_id = $content_val["resource_id"];
        $content_title = $content_val["content_title"];
        $content_description = $content_val["content_description"];
        $resource_result = Resource::GetResourceNameById($resource_id);
        if($resource_val = mysqli_fetch_array($resource_result))
        {
          $resource_name = $resource_val["resource_name"];
            echo " <div class=\"col-lg-3 col-md-6 col-sm-12\"><div class=\"card\">
              <h5 class=\"card-header\">$resource_name</h5>
              <div class=\"card-body\">
                <h5 class=\"card-title\">$content_title</h5>
                <p class=\"card-text\">$content_description</p>
                <a href=\"#\" class=\"btn btn-info\" onclick=\"ReadArticle($content_id)\">Read more</a>
              </div>
            </div>
            </div>";
        }
      }
    }
   }
   else
   {
     echo"<div class=\"col-lg-12\"><h3>Not Yet Started :)</h3><a href=\"index.php\" class=\"btn btn-md btn-success\">Get Started</a></div>";
   }

 }
}//end of class

