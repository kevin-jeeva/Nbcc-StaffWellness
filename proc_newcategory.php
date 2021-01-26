<?php
include_once("functions/Resource.php");
include_once("functions/Content.php");
session_start();

 if(isset($_POST["category"])){
    $resource_title  = $_POST["category"];
    Resource::InsertNewResource($resource_title);
    $_SESSION["message"] = "Resource Added Successfully";
    header("location:administrator.php");
 }
 else{
    header("location:administrator.php");
 }
?>