<?php
include_once 'connect.php';

class Media {
    private $mediaId;
    private $media_title;
    private $mediaDescription;
    private $mediaPath; 
    private $date_created;

   public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __construct($mediaId, $media_title,$mediaDescription,$mediaPath,$date_created)
    {
        $this->mediaId=$mediaId;
        $this->media_title = $media_title;
        $this->date_created = $date_created;
        $this->mediaDescription=$mediaDescription;
        $this->mediaPath=$mediaPath;
    }
    public function __destruct() 
    {
        //this is destruct the object one the object is completed it process :)
    }

    public static function GetMedia()
    {
        $con = $GLOBALS["con"];
        $sql ="select media_desc, media_path, media_id, media_title, date_format(date_created, '%m/%d/%y') as date_created from media where media_path LIKE '%.mp4'";
        $result = mysqli_query($con,$sql);
        return $result;
    }
    public static function GetSound()
    {
        $con = $GLOBALS["con"];
        $sql ="select media_desc, media_path, media_id, media_title, date_format(date_created, '%m/%d/%y') as date_created from media where media_path LIKE '%.mp3'";
        $result = mysqli_query($con,$sql);
        return $result;
    }
    public static function DisplayVideoCards()
    {
        $result = self::GetMedia();
        $count = 0;
        if(mysqli_num_rows($result) > 0)
        {
            while($val = mysqli_fetch_array($result))
            {
                $media_id = $val["media_id"];
                $title = $val["media_title"];
                $description = $val["media_desc"];

                $media_desc = $val["media_desc"];
                $count +=1;

                echo "<div class=\"col-lg-3 col-md-6 col-sm-12\">
                        <div class=\"features-categories-item mx-auto mb-5 mb-lg-0 mb-lg-3\">
                        <div class=\"main-card card\">
                            <div class=\"card-media\">
                                <h3>$title</h3>                         
                                <p>$description</p>                         
                                <a href=\"#\" class=\"btn btn-outline-ngreen btn-block\" onclick=\"WatchedVideos($media_id)\"><span>Watch Now </span><i class=\"bi bi-play-circle-fill\"></i></a>
                            </div>
                        </div>
                        </div>
                    </div>" ;
            }
        }
        else
        {
            echo "<h2>No videos</h2>";
        }
    }

    public static function PlayVideo($video_id)
    {
        $con = $GLOBALS["con"];
        $sql = "Select media_title, media_desc, media_path from media where media_id = $video_id";
        $result = mysqli_query($con,$sql);
        while($val = mysqli_fetch_array($result))
        {
            $media_desc = $val["media_desc"];
            $title = $val["media_title"];

            $video = $val["media_path"];
            echo "<div class=\"col-lg-12\">
        <h1 class=\"text-left\">$title</h1><hr>
        </div>  <div class=\"col-lg-6\"><video width=\"100%\" height=\"100%\" controls>
            <source src=\"includes/videos/$video\" type=\"video/mp4\">           
            Your browser does not support the video tag.
            </video></div><div class=\"col-lg-6\">$media_desc</div>";
        }
    }
    public static function PlayAudio($media_id)
    {
        $con = $GLOBALS["con"];
        $sql = "Select media_title, media_desc, media_path from media where media_id = $media_id";
        $result = mysqli_query($con,$sql);
        while($val = mysqli_fetch_array($result))
        {
            $media_desc = $val["media_desc"];
            $title = $val["media_title"];

            $video = $val["media_path"];
            echo "<div class=\"col-lg-12\">
        <h1 class=\"text-left\">$title</h1><hr>
        </div>  <div class=\"col-lg-6\"><audio width=\"100%\" height=\"100%\" controls>
            <source src=\"includes/sounds/$video\" type=\"audio/mp3\">            
            Your browser does not support the video tag.
            </audio></div><div class=\"col-lg-6\">$media_desc</div>";
        }
    }
    public static function GetListOfCreatedVideos()
    {
        $result = self::GetMedia();
        $count = 0;

        if(mysqli_num_rows($result) > 0)
        {
            while($val = mysqli_fetch_array($result))
            {
                $count +=1;
                $id = $val["media_id"];
                $video_title = $val["media_title"];
                $video_name = $val["media_path"];
                $desc = $val["media_desc"];
                $date = $val["date_created"];
                 echo "<tr>
                        <td>$count</td>
                        <td>$video_title</td>       
                        <td>$video_name</td>       
                        <td>$date</td>          
                        <td align=\"right\">                
                            <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-nblue\" onclick=\"RedirectEditVideo($id,'$video_title','$video_name','$desc')\">Edit Video</a>
                            <a href=\"functions/proc_delete_video.php?videoId=$id\" type=\"button\" class=\"btn btn-sm btn-danger\" onclick = \"return CheckDelete(event)\">Delete</a>
                        </td>            
                     </tr>";
            }
        }
        else
        {
             echo "<tr>
            <td>#</td>
                    <td>No videos at this moment</td>       
                    <td>###</td>       
                    <td>###</td>          
                    <td align=\"right\">                
                        <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-info\">Edit Content</a>
                        <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-danger\">Delete</a>
                    </td>            
            </tr>";
        }

    }
    
    public static function GetListOfCreatedSounds()
    {
        $result = self::GetSound();
        $count = 0;

        if(mysqli_num_rows($result) > 0)
        {
            while($val = mysqli_fetch_array($result))
            {
                $count +=1;
                $id = $val["media_id"];
                $sound_title = $val["media_title"];
                $sound_name = $val["media_path"];
                $desc = $val["media_desc"];
                $date = $val["date_created"];
                 echo "<tr>
                        <td>$count</td>
                        <td>$sound_title</td>       
                        <td>$sound_name</td>       
                        <td>$date</td>          
                        <td align=\"right\">                
                            <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-nblue\" onclick=\"RedirectEditAudio($id,'$sound_title','$sound_name','$desc')\">Edit Sound</a>
                            <a href=\"functions/proc_delete_audio.php?audioId=$id\" type=\"button\" class=\"btn btn-sm btn-danger\" onclick = \"return CheckDelete(event)\">Delete</a>
                        </td>            
                     </tr>";
            }
        }
        else
        {
             echo "<tr>
            <td>#</td>
                    <td>No Sound at this moment</td>       
                    <td>###</td>       
                    <td>###</td>          
                    <td align=\"right\">                
                        <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-info\">Edit Content</a>
                        <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-danger\">Delete</a>
                    </td>            
            </tr>";
        }

    }

    public static function InsertMedia($media)
    {
        $con = $GLOBALS["con"];
        $title = $media->media_title;
        $desc = $media->mediaDescription;
        $path = $media->mediaPath;

        $sql ="Insert into media (media_title,media_desc,media_path) values('$title','$desc','$path')";
        mysqli_query($con,$sql);
        if(mysqli_affected_rows($con) > 0)
        {
            return true;
        }
        else{
            return false;
        }
    }

    public static function DeleteVideo($video_id)
    {
        $con = $GLOBALS["con"];
        $sql ="Delete from media where media_id = $video_id";
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

    public static function UpdateVideo($media)
    {
        $con =$GLOBALS["con"];
        if($media->mediaPath === 0)
        {
            $sql = "Update media set media_title = '$media->media_title', media_desc='$media->mediaDescription' where media_id = $media->mediaId ";           
            mysqli_query($con,$sql);
            
        }
        else
        {
            $sql = "Update media set media_title = '$media->media_title', media_desc='$media->mediaDescription',media_path = '$media->mediaPath' where media_id = $media->mediaId";
            mysqli_query($con,$sql);
        }

        if(mysqli_affected_rows($con) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function DisplaySoundCards()
    {
        $result = self::GetSound();
        $count = 0;
        if(mysqli_num_rows($result) > 0)
        {
            while($val = mysqli_fetch_array($result))
            {
                $media_id = $val["media_id"];
                $title = $val["media_title"];
                $description = $val["media_desc"];

                $media_desc = $val["media_desc"];
                $count +=1;

                echo"  <div class=\"col-lg-3 col-md-6 col-sm-12\">
                        <div class=\"features-categories-item mx-auto mb-5 mb-lg-0 mb-lg-3\">
                        <div class=\"main-card card\">
                            <div class=\"card-media\">
                                <h3>$title</h3>                         
                                <p>$description</p>                         
                                <a href=\"#\" class=\"btn btn-outline-ngreen btn-block\" onclick=\"WatchedAudio($media_id)\"><span>Play Now </span><i class=\"bi bi-play-circle-fill\"></i></a>
                            </div>
                        </div>
                        </div>
                    </div>" ;
            }
        }
        else
        {
            echo "<h2>No Sound Exercise At This Moment :) </h2>";
        }
    }

   
} // END MEDIA CLASS