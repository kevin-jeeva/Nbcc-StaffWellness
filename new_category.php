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

	<title>Create a New Resource</title>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
	<!-- Bootstrap core CSS -->
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
	<script src="functions/main.js"></script>
</head>

<body>
	<!-- Navigation -->
	<?php include('functions/header.php'); ?>

	<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">Create a New Category</h1>
	  </div>
	</div>

	<!--Main Content Sector (2 columns) -->
	<section class="main-content">
		<div class="container">
		  <div class="row">

		  	<!--Content Sector (Main) -->
		    <div class="the-content col-md-8">
		    	<form method="post" id="newCategoryForm" name="newCategoryForm" action="proc_newcategory">
		    	  <div class="form-group col-xs-6 col-md-4">
		    	    <label for="question">Category Title</label>
		    	    <input type="text" class="form-control" id="category" name="category" placeholder="Category Title" size="45" maxlength="45" required>
		    	  </div>

		    	  <!-- Textarea deactivated temporarily-->
		    	  <!--<div class="form-group col-lg-12">
					<label for="question">Category Description</label>
					<textarea class="form-control" id="description" name="description" placeholder="Category Description" rows="5" maxlength="255" required></textarea>
		    	  </div>-->
		    	  
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