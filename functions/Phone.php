<?php
include_once 'connect.php';

class Phone{
  private $user_id;
  private $user_phone;
  private $user_carrier;
  private $user_domain;

  public function __construct($user_id, $user_phone, $user_carrier, $user_domain)
  {
    $this->user_id = $user_id;
    $this->user_phone = $user_phone;
    $this->user_carrier = $user_carrier;
    $this->user_domain = $user_domain;
  }

  public function __get($name){
    return $this->$name;
  }

  public function __set($name,$value){
    $this->$name = $value;
  }

  public function __destruct() {  
    //this is destruct the object one the object is completed it process :)
  }

  public static function GetUsersPhoneDetails()
  {
    $con = $GLOBALS["con"];
    $sql = "select user_phone_no, user_carrier from user_phone";
    $result = mysqli_query($con, $sql);
    return $result;
  }
  public static function GetDomain($carrier)
  {
    $con = $GLOBALS["con"];
    $sql = "Select carrier_domain from carrier where carrier_name = UPPER('$carrier')";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0)
    {
      while($val = mysqli_fetch_array($result)){
        return $val["carrier_domain"];
      }
    }
  }
  public static function SendMessage($resource ,$text,$title)
  {
    $phones = array();
    $phone_num_set = self::GetUsersPhoneDetails();
    if(mysqli_num_rows($phone_num_set) > 0)
    {
      while($phone_val = mysqli_fetch_array($phone_num_set))
      {
        $phone_num = $phone_val["user_phone_no"];
        $carrier = $phone_val["user_carrier"];
        $domain = self::GetDomain($carrier);
        $address = $phone_num.$domain;
        array_push($phones,array("email" => $address));
      }
      $values = json_encode($phones);  
      header("location:sendmessages.php?email=$values&resource=$resource&text=$text&title=$title");
    }
  }
}
?>