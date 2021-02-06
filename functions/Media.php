<?php
include_once 'connect.php';

class Media {
    private $mediaId;
    private $mediaDescription;
    private $mediaPath; 

<<<<<<< HEAD
    function __get($name) {
        return $this->$name;
    }
    
    function __set($name, $value) {
=======
    function get($name) {
        return $this->$name;
    }

    function set($name, $value) {
>>>>>>> dbca48919bfdddbf6233ce37d37e46ddf9ad598e
        $this->$name = $value;
    }

    function __construct($mediaId,$mediaDescription,$mediaPath)
    {
        $this->mediaId=$mediaId;
        $this->mediaDescription=$mediaDescription;
        $this->mediaPath=$mediaPath;
    }
<<<<<<< HEAD
    
    //select media based on media ID
    static function getMediaById($mediaId){
        $con = $GLOBALS['con'];
        $sql = "SELECT media_id, media_desc, media_path from media where media_id = '$mediaId' ";
      //  echo $sql;
        $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo $row['media_desc']."<BR>".
                $row['media_path'];
=======

    //select media based on media ID
    static function getMediaById($mediaId){
        $con = $GLOBALS['con'];
        $sql = "SELECT * from media where media_id = $mediaId ";
        echo $sql;
        $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo '<p>'.$row['media_desc']."<BR>".
                $row['media_path'].'</p>';
>>>>>>> dbca48919bfdddbf6233ce37d37e46ddf9ad598e
            }
    }
    //select all media
    static function getAllMedia(){
        $con = $GLOBALS['con'];
        $sql = "SELECT * from media";
        $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo $row['media_desc']."<BR>".
                $row['media_path'];
            }
    }

} // END MEDIA CLASS