
<?php 
include_once("functions/Resource.php");
include_once("functions/Content.php");
session_start();
include_once("functions/staff.php");
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

	<title>Edit Resource</title>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
	<!-- Bootstrap core CSS -->
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
  	<script src="functions/admin.js"></script>
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

	<!-- Navigation -->
	<?php include('functions/header.php'); ?>

	<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">Edit resource</h1>
	  </div>
	</div>

	<!--Main Content Sector (2 columns) -->
	<section class="main-content">
		<div class="container">
		  <div class="row">

		  	<!--Content Sector (Main) -->
		    <div class="the-content col-md-8">
		    	<form method="post" id="newCategoryForm" name="newCategoryForm" action="proc_edit_resource" onsubmit="return TrimCategoryTitle()">
		    	  <div class="form-group col-xs-6 col-md-4">
		    	    <label for="question">Category Title</label>
		    	    <input type="text" class="form-control" id="resource_edit" name="resource_edit"  size="45" maxlength="45" required>
              		<input type = "hidden" id ="resource_id" name="resource_id">
		    	  </div>
		    	  <br>
		    	  <div class="form-group col-lg-12">
		    	    <input type="submit" class="btn btn-ngreen" value="Save Changes"/>
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
<script>
window.onload = function() 
{
PopulateEditResources();
}
</script>