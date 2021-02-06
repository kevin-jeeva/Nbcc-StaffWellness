<?php
include_once("connect.php");


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
 public static function GetProgress($user_id, $content_id)
 {
   $con = $GLOBALS["con"];
   $sql = "Select progress_id, progress_value,views from progress where user_id = $user_id and content_id = $content_id";
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

}

?>