<?php
session_start();
include_once('functions/staff.php');
include_once("functions/Content.php");

	if($_SESSION["active"] == 0)
	{
			$msg = "Not an Active User" ;
			header("location:login.php?loginError=$msg");
	}
//redirection
	if (!isset($_SESSION["staff_id"])) //not currently logged in
	{
		header("Location:login.php");
	}
	else if(staff::GetStaffAdminNumber($_SESSION["staff_id"]) != 1 && staff::GetStaffAdminNumber($_SESSION["staff_id"]) != 2) //checks if user is admin
	{
		header("Location:index.php");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
  
	<title>Create a Welcome Content</title>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
	<!-- Bootstrap core CSS -->
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

	<!-- Script for the Rich Editor -->
	<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
	
	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
	
	<!-- Script for the category-->
	<script src="functions/welcome.js"></script>
	
</head>

<body>

  <!--Error modal-->
	<div class="modal fade" id="myModal">
    <div class="modal-dialog  modal-sm">
      <div class="modal-content">     
			<div class="modal-header">
        <h4 class="modal-title">Error</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <div class="modal-body error">			
         <span id = "alert_message"></span>				
        </div>
      </div>
    </div>
	</div>

	<!--successfull modal-->
	<div class="modal fade" id="mySucessModal">
	<div class="modal-dialog  modal-lg">
	  <div class="modal-content">    
	    <div class="modal-body success">					
			<img class="modal-body-img" src="includes/imgs/tick.gif" ><span id="success_message"></span>
			<button type="button" class="close" data-dismiss="modal">&times;</button>						
	    </div>
	  </div>
	</div>
	</div>

	<!-- Navigation -->
	<?php include('functions/header.php'); ?>

	<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">Create a New Welcome Message</h1>
	  </div>
	</div>

	<!--Main Content Sector (2 columns) -->
	<section class="main-content" >
		<div class="container">
		  <div class="row">

		  	<!--Content Sector (Main) -->
		    <div class="the-content col-md-8">
		    	<form method="post" id="newContentForm" name="newContentForm" onsubmit="return WelcomeCheck()" action="proc_newWelcome.php" enctype="multipart/form-data">
		    	  <div class="form-group col-xs-12 col-md-12">   	    
							<div class="form-group col-xs-6 col-md-4">
								<label for="content-title" id="content-title">Welcome Title</label>
								<input type="text" class="form-control" placeholder="Enter welcome title" name ="welcomeTitle" id="welcomeTitle" required>
							</div>
							<div class="form-group col-lg-12">
								<label for="content-description">Select a Welcome Image</label>
                <div></div>
							  <input id="welcome_image" name="pic" type="file" accept="image/*"><br>
							</div>	
             		<div class="form-group col-lg-12">
								<label for="content-description">Welcome Text</label>
								<textarea class="form-control" id="welcome-description" name="welcome-description" placeholder="Welcome Description" rows="5" maxlength="255" required></textarea>
							</div>							
							<br>
							<div class="form-group col-lg-12">
								<input type="submit" class="btn btn-ngreen" value="Submit"/>
								<a href="administrator.php" type="button" class="btn btn-danger">Cancel</a>
							</div>
		    	</form> 	
		    </div>

		    <!--Sidebar (Links, Menus and other info) -->
		    <div class="sidebar col-md-4">
		    	
		    </div>

		  </div>
		</div>
	</section>

	<!-- Footer -->
	<?php include('functions/footer.php'); ?>

</body>
</html>
<?php
if($_SESSION["message"] != "")
{
	$alert_message = $_SESSION["message"];
	echo "<script>
	$(\"#mySucessModal\").modal();
	document.getElementById(\"success_message\").textContent = '$alert_message';
	</script>";
	$_SESSION["message"] = "";
}
if($_SESSION["alert_message"] != "")
{
  $alert_message = $_SESSION["alert_message"];
	echo "<script>
	$(\"#myModal\").modal();
	document.getElementById(\"alert_message\").textContent = '$alert_message';
	</script>";
	$_SESSION["alert_message"] = "";
}
?>