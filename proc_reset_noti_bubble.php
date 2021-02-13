<?php
session_start();
require_once("functions/Content.php");
if(isset($_SESSION["staff_id"]))
{
 Content::resetBubble();
 echo "success";
}
else
{
 header("location:login.php");
}
?>