<?php
include_once 'connect.php';
class Resource {
   private $resourceId;
   private $resourceTitle;
   private $dateCreated; 
   
   function __construct($resourceId, $resourceTitle, $dateCreated) {
       $this->resourceId = $resourceId;
       $this->resourceTitle = $resourceTitle;
       $this->dateCreated = $dateCreated;
   }
    public function __destruct() 
    {
        //this is destruct the object one the object is completed it process :)
    }
   public static function GetResourceNameById($resource_id)
   {
       $con = $GLOBALS["con"];
       $sql = "Select resource_name, resource_id from resources where resource_id = $resource_id";
       $result = mysqli_query($con,$sql);
       return $result;

   }
   public static function GetAllResources()
   {
       $con = $GLOBALS["con"];
       $sql ="Select resource_id, resource_name, date_format(date_created, '%m/%d/%y') as date_created from resources";
       $result = mysqli_query($con,$sql);
       $count = 0;
       if(mysqli_num_rows($result) > 0)
       {
           while($val = mysqli_fetch_array($result))
           {
                $resource_id = $val["resource_id"];
                $title = $val["resource_name"];
                $date_created = $val["date_created"];
                $count += 1;
                echo"
               <tr>
               <td>$count</td>
               <td>$title</td>
               <td>$date_created</td>
               <td align=\"right\">
                   <a href=\"#\" type=\"button\" onclick =\"RedirectEditResource('$title',$resource_id)\"class=\"btn btn-sm btn-info\">Edit</a>
                   <a href=\"functions/proc_deleteResource.php?resourceId=$resource_id\" onclick = \"return CheckDelete(event)\"type=\"button\" class=\"btn btn-sm btn-danger\">Delete</a>
               </td>        
               </tr>
               ";
           }
          
       }
       else
       {
           echo"
           <tr>
           <td>1</td>
           <td>No Resources</td>
           <td>2021/01/01</td>
           <td>Author name</td>
           <td align=\"right\">
               <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-info\">Edit</a>
               <a href=\"#\" type=\"button\" class=\"btn btn-sm btn-danger\">Delete</a>
           </td>        
           </tr>
           ";
       }
       
   }
   
   public static function getAllResourcesId()
   {
       $con = $GLOBALS["con"];
       $sql = "Select * from resources";
       $result = mysqli_query($con,$sql);
       return $result;
   }

   public static function getResourceIdByResourceName($resource_name)
   {
       $con = $GLOBALS["con"];
       $sql ="Select resource_id from resources where resource_name = '$resource_name'";
       $result = mysqli_query($con,$sql);
       if($val = mysqli_fetch_array($result))
       {
           return $val["resource_id"];
       }
   }
   public static function GetResourceNameByResourceId($resource_id)
   {
       $con = $GLOBALS["con"];
       $sql ="Select resource_name from resources where resource_id = $resource_id";
       $result = mysqli_query($con,$sql);
       if($val = mysqli_fetch_array($result))
       {
           return $val["resource_name"];
       }
   }

    public static function InsertNewResource($title)
    {
        $con = $GLOBALS["con"];
       // $resource_id = strtoupper($resource_id);
        $sql = "INSERT INTO resources(resource_name) VALUES('$title')";                
        mysqli_query($con,$sql);
        if(!mysqli_affected_rows($con) == 1)
        {
          $_SESSION["message"] = "An error occurred with the database. Please Try again later.";
          header("location:new_category.php");        
        }
       
    }

    public static function InsertResourceId($resource_name)
    {
        $con = $GLOBALS["con"];
        $sql = "Insert into resources(resource_name) values('$resource_name')";
        mysqli_query($con,$sql);
        if(mysqli_affected_rows($con) == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public static function DeleteContent($contentId)
    {
        $con = $GLOBALS["con"];
        $sql = "Delete from content where content_id = $contentId";
        mysqli_query($con,$sql);
        if(!mysqli_affected_rows($con) == 1)
        {
          header("location:administrator.php");
        }
    }

    

    public static function DeleteResourceIdInContent($resource_id)
    {
        $con = $GLOBALS["con"];
        $sql = "delete from content where resource_id = $resource_id";
        mysqli_query($con,$sql);
    }
    public static function DeleteResources($resourceId)
    {
        $con = $GLOBALS["con"];
        $sql = "delete from resources where resource_id  = $resourceId";
        mysqli_query($con,$sql);
        if(!mysqli_affected_rows($con) > 0)
        {
            echo "fail";
        }
        else{
            return true;
        }
    }
    public static function UpdateResourceName($resource_name, $resource_id)
    {
        $con = $GLOBALS["con"];
        $sql = "Update resources set resource_name = '$resource_name' where resource_id = $resource_id";
        mysqli_query($con,$sql);
        if(mysqli_affected_rows($con) == 1)
        {
            return true;
        }
        else{
            return false;
        }
    }
}