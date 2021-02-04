<?php
include_once("connect.php");


class Progress{
  private $progress_id;
  private $user_id;
  private $content_id;
  private $progress_value;
  private $date_created;
 
  function __construct($progress_id,$user_id,$content_id,$progress_value,$date_created)
 {
  $this->progress_id = $progress_id;
  $this->user_id = $user_id;
  $this->content_id = $content_id;
  $this->progress_value = $progress_value;
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
      return true;
    }
    else
    {
      return false;
    }
  }
  else
  {
    return false;
  }

  
 }

}

?>