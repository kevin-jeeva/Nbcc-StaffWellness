<?php
	include('functions/connect.php');
  $con = $GLOBALS['con'];

  //Upload video to DB code found from following site:
  //https://codingshiksha.com/php/how-to-upload-basic-video-to-mysql-database-in-php-coding-shiksha/

  if(isset($_POST['submit']))
  {
    $maxsize = 10485760; //10 MB
   $filename =$_FILES["fileToUpload"]["name"];
   $target_dir = "media/";
   $target_file = $target_dir.$_FILES["file"]["name"];
   $videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

    //if extension is ok
   if( in_array($videoFileType,$extensions_arr) ){
    // Check file size
    if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
      echo "File too large. File must be less than 5MB.";
    }else{
      // Upload
      if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
        // Insert record
        $query = "INSERT INTO video(name,location) VALUES('".$name."','".$target_file."')";

        $query = "INSERT INTO media(media_path) VALUES('$target_file')";
        $query = mysqli_query($con,$query);
          if($query){
                echo "Upload successfully.";
            }else{
                echo "Upload failed";
            }
      }
    }
  }
}
 
    
?>