<?php
include_once("connect.php");
include_once("Resource.php");
include_once("Content.php");
include_once("Welcome.php");
include_once("staff.php");

class Progress{
  private $progress_id;
  private $user_id;
  private $content_id;
  private $progress_value;
  private $date_created;
  private $views;
 
  function __construct($progress_id,$user_id,$content_id,$progress_value,$date_created,$views)
 {
  $this->progress_id = $progress_id;
  $this->user_id = $user_id;
  $this->content_id = $content_id;
  $this->progress_value = $progress_value;
  $this->views = $views;
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
  public function __destruct()
  {
    //this is destruct the object one the object is completed it process :)
  }
 public static function GetProgress($user_id, $content_id)
 {
   $con = $GLOBALS["con"];
   $sql = "Select progress_id, progress_value,views from progress where user_id = $user_id and content_id = $content_id";
   $result = mysqli_query($con,$sql);
   return $result;
 }
  public static function GetProgressMedia($user_id, $media_id)
 {
   $con = $GLOBALS["con"];
   $sql = "Select progress_id, progress_value,views from progress where user_id = $user_id and media_id = $media_id";
   $result = mysqli_query($con,$sql);
   return $result;
 }
 public static function CheckInserted($user_id, $content_id)
 {
   
   $con = $GLOBALS["con"];
   $sql ="Select progress_id from progress where user_id = $user_id and content_id = $content_id";
  
   $result = mysqli_query($con,$sql);
   if(mysqli_num_rows($result) > 0)
   {
     return false;
   }
   else
   {
     return true;
   }
 }
  public static function CheckInsertedMedia($user_id, $media_id)
 {
   
   $con = $GLOBALS["con"];
   $sql ="Select progress_id from progress where user_id = $user_id and media_id = $media_id";
  
   $result = mysqli_query($con,$sql);
   if(mysqli_num_rows($result) > 0)
   {
     return false;
   }
   else
   {
     return true;
   }
 }
 public static function GetViews($content_id,$user_id)
 {
   $con =$GLOBALS["con"];
   $sql = "Select views from progress where content_id = $content_id and user_id = $user_id";
   $result = mysqli_query($con,$sql);
   if($val = mysqli_fetch_array($result))
   { echo $val["views"];
       return $val["views"];
   }
 }
 public static function UpdateViews($user_id, $content_id)
 {
   $con = $GLOBALS["con"];
   $prev_views  = self::GetViews($content_id,$user_id);
   $prev_views += 1;
   $sql ="update progress set views = $prev_views where content_id = $content_id and user_id = $user_id";
   mysqli_query($con,$sql);
 }
 public static function GetViewsMedia($media_id,$user_id)
 {
   $con =$GLOBALS["con"];
   $sql = "Select views from progress where media_id = $media_id and user_id = $user_id";
   $result = mysqli_query($con,$sql);
   if($val = mysqli_fetch_array($result))
   { echo $val["views"];
       return $val["views"];
   }
 }
 public static function UpdateViewsMedia($user_id, $media_id)
 {
   $con = $GLOBALS["con"];
   $prev_views  = self::GetViewsMedia($media_id,$user_id);
   $prev_views += 1;
   $sql ="update progress set views = $prev_views where media_id = $media_id and user_id = $user_id";
   mysqli_query($con,$sql);
 }
 public static function InsertProgress($progress)
 {
  $con = $GLOBALS["con"];
  $user = $progress->user_id;
  $content = $progress->content_id;
  $progress_value = $progress->progress_value;
  
  if(self::CheckInserted($user,$content))
  {
    $sql ="Insert into progress (user_id,content_id,progress_value) values ($user,$content,$progress_value)";
    mysqli_query($con,$sql);
    if(mysqli_affected_rows($con) > 0)
    {
      self::UpdateViews($user,$content);
      return true;
    }
    else
    {
      return false;
    }
  }
  else
  {
    self::UpdateViews($user,$content);
    return false;
  }

  
 }
 
 
  public static function InsertVideoProgress($staff_id,$media_id)
  {
    $con = $GLOBALS["con"];   
    if(self::CheckInsertedMedia($staff_id,$media_id))
    { 
      $sql = "Insert into progress (user_id,media_id,progress_value)values($staff_id,$media_id,100)";
       mysqli_query($con,$sql);
      if(mysqli_affected_rows($con) > 0)
      {
        self::UpdateViewsMedia($staff_id,$media_id);
        return true;
      }
      else
      {
        return false;
      }
    }
    else
    {
      self::UpdateViewsMedia($staff_id,$media_id);
      return false;
    }
    
  }

  public static function ViewStaffProgress()
  {
      $con = $GLOBALS["con"];
      $count_divide = 0;
      $progress_value = 0;
      $total = 0;
      $colors = array("bg-nblue","bg-ngreen","bg-ncyan","bg-nyellow","bg-nblue","bg-green");
      $prog_header = 1;
      $row_count = 0;
      $resource_color = 0;
      //get all the resource id
       $resource_ids = Resource::getAllResourcesId();

       //see if there is any resources to show
       if(mysqli_num_fields($resource_ids) > 0)
       {
          self::ProgressHeader();       

            $users = staff::GetStaff();
            if(mysqli_num_rows($users) > 0)
            {
              
              while($user_val = mysqli_fetch_array($users))
              {
                
                  $user_name = $user_val["user_name"];
                  $user_id = $user_val["staff_id"];
                  $rand_color = array_rand($colors,1);
                  $row_count += 1; 
                  $resource_color = 0;

                  echo "<tr><td scope=\"row\"> $row_count</td>
                  <td class=\"text-uppercase\">$user_name</td>";
                  $resource_ids = Resource::getAllResourcesId();
                  while($resource_val = mysqli_fetch_array($resource_ids))
                  {
                    //set it to zero
                    $count_divide = 0;
                    $progress_value = 0;
                    $total = 0;

                    $resource_id = $resource_val["resource_id"];
                    $resource_name = $resource_val["resource_name"];
                    $color = $colors[$resource_color];

                    //get the progress for the video and audio
                    if($resource_name === "Exercise Video")
                    {
                       //get the exercise video
                      self::GetProgresMedia("Exercise Video",$user_id,$color);
                      $resource_color += 1;
                      continue;
                    }
                    if($resource_name === "Exercise Sound")
                    {
                       //get the exercise video
                      self::GetProgressAudio("Exercise Sound",$user_id,$color);
                      $resource_color += 1;
                      continue;
                    }

                    $content_ids = Content::GetContentByResourceId($resource_id);  

                    if(mysqli_num_rows($content_ids) > 0)
                    {
                                               
                        while($content_val = mysqli_fetch_array($content_ids))
                        {
                          $content_id = $content_val["content_id"];
                          $progress = Progress::GetProgress($user_id,$content_val["content_id"]);
                          if(mysqli_num_rows($progress) > 0)
                          {
                            while($progress_val = mysqli_fetch_array($progress))
                            {
                              $progress_value += $progress_val["progress_value"];
                            }
                          }
                          $count_divide += 1;
                        } //content ids while loop                       
                        //display the progress of the individual users
                        $total = round($progress_value / $count_divide);
                        // $color =  $colors[$rand_color];
                        echo " 
                        <td><div class=\"progress\">
                        <div class=\"progress-bar progress-bar-striped progress-bar-animated $color\" role=\"progressbar\" aria-valuenow=\"75\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $total%\"><span class=\"text-dark font-weight-bold\">$total%</span></div>
                        </div></td>";
                        $resource_color += 1;
                    }
                    else
                    {
                      continue; //continue to the next content
                    }
                  }//resource ids while loop     
                  echo "</tr>";
              }//users while loop
          }//if users available
       }//first if resource_ids
       echo "</tbody>";
  }

  public static function ProgressHeader()
  {
    $con = $GLOBALS["con"];
    $sql = "select resource_name from staff.resources where resource_id IN (select resource_id from staff.content group by resource_id)";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0)
    {
      echo "<thead>
            <tr>
            <th>Count</th>
            <th>User Name</th>
            ";
      while($val = mysqli_fetch_array($result))
      {       
        $resource_name = $val["resource_name"];
         echo "<th>$resource_name</th>";
      }
      echo"<th>Video</th><th>Audio</th></tr></thead><tbody>";
    }
    
  }
  public static function GetProgresMedia($resource_name,$staff_id,$color)
 {
  
  $media = Media::GetMedia();
  $progress_value = 0;
  $count = 0;
  $total = 0;

  if(mysqli_num_rows($media) > 0)
  {
    while($val = mysqli_fetch_array($media))
    {
      $media_id = $val["media_id"];
      $result = Progress::GetProgressMedia($staff_id,$media_id);
      if(mysqli_num_rows($result) > 0)
      {
        if($pg_val = mysqli_fetch_array($result))
        { 
          $progress_value += $pg_val["progress_value"];
        }
        
      }
      $count +=1;
    }
     //display the progres value     
      $total = round($progress_value / $count);     
      echo "<td><div class=\"progress\">
						<div class=\"progress-bar progress-bar-striped progress-bar-animated $color\" role=\"progressbar\" aria-valuenow=\"75\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $total%\">$total%</div>
					</div></td>";  
  }

 }
 public static function GetProgressAudio($resource_name,$staff_id,$color)
 {
  
  $media = Media::GetSound();
  $progress_value = 0;
  $count = 0;
  $total = 0;

  if(mysqli_num_rows($media) > 0)
  {
    while($val = mysqli_fetch_array($media))
    {
      $media_id = $val["media_id"];
      $result = Progress::GetProgressMedia($staff_id,$media_id);
      if(mysqli_num_rows($result) > 0)
      {
        if($pg_val = mysqli_fetch_array($result))
        { 
          $progress_value += $pg_val["progress_value"];
        }
        
      }
      $count +=1;
    }
     //display the progres value     
      $total = round($progress_value / $count);     
      echo "<td><div class=\"progress\">
						<div class=\"progress-bar progress-bar-striped progress-bar-animated $color\" role=\"progressbar\" aria-valuenow=\"75\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $total%\">$total%</div>
					</div></td>";  
  }

 }

 public static function getResolution(){
  $con =$GLOBALS["con"];
  $sql="select res_text from Resolution";
  $result = mysqli_query($con, $sql);
  echo  "<ul id=\"myUL\">";
  while ($row = mysqli_fetch_assoc($result)) {
      $resolutionText = $row["res_text"];
      echo "
      <li class=\"list\">$resolutionText</li>";
  }
  echo "</ul>";
}

public static function addResolution($text){
  $con =$GLOBALS["con"];
  $sql="insert into Resolution (res_text) values ('$text')";
  mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) == 1) {
      $_SESSION["message"] = "Resolution added!"; 
      header("location:content.php");
    }

}
     
}


?>