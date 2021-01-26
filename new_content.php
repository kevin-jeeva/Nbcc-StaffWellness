<?php 
session_start();
include_once("functions/Content.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
  
	<title>Create a New Content</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Script for the Rich Editor -->
	<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
  
	<!-- Script for the category-->
		<script src="functions/category.js"></script>
	
	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
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
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<div class="container">

		<a class="navbar-brand" href="index.php">APP Logo</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  	<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
			  	<li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
			  	<li class="nav-item"><a class="nav-link" href="articles.php">Articles</a></li>
			  	<li class="nav-item"><a class="nav-link" href="events.php">Events</a></li>
			  	<li class="nav-item dropdown">
				    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exercises</a>
				    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="../../exercises_video.php">Video Exercises</a>
						<a class="dropdown-item" href="../../exercises_sound.php">Sound Exercises</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
				    </div>
			  	</li> 		
			</ul>
		  	<div class="navbar-right">
		  		<ul class="navbar-nav mr-auto">
			  		<li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
			  		<li class="nav-item"><a class="nav-link" href="#">Support</a></li>
			  		<li class="nav-item"><a class="nav-link" href="administrator.php">Admin</a></li>
					<li class="nav-item"><a class="btn btn-outline-warning" href="functions/logout.php">Log out</a></li>
				</ul>
			</div>
		</div><!-- end of collapse navbar-collapse -->

	</div><!-- end of container -->
	</nav><!-- end of Navigation -->

	<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">Create a New Content</h1>
	  </div>
	</div>

	<!--Main Content Sector (2 columns) -->
	<section class="main-content" >
		<div class="container">
		  <div class="row">

		  	<!--Content Sector (Main) -->
		    <div class="the-content col-md-8">
		    	<form method="post" id="newContentForm" name="newContentForm" onsubmit="return ContentCheck()" action="proc_newcontent.php">
		    	  <div class="form-group col-xs-12 col-md-6">
		    	    <div><label for="content-category">Select Category (or) <a href="new_category.php" class="btn btn-outline-info">Create New Category</a></div></label>
							  <select name ="contents" id ="contents">
								<?php Content::getContents()?>
							  </select>
					

					<!--this will get all the resource list
					<input list="resourceList" required = "true" name="resourceListId" id="resourceListId">
					<datalist id="resourceList" name ="resourceList">
						 
					</datalist>-->

				   </div>
						 
							<div class="form-group col-xs-6 col-md-4">
								<label for="content-title" id="content-title">Content Title</label>
								<input type="text" class="form-control" placeholder="Enter content title" name = "contentTitle" id="contentTitle">
							</div>
							
							<div class="form-group col-lg-12">
								<label for="content-description">Content Description</label>
								<textarea class="form-control" id="content-description" name="content-description" placeholder="Category Description" rows="5" maxlength="255" required></textarea>
							</div>
							
							<div class="form-group col-lg-12">
								<!-- CKEditor area -->
								<label for="content-area">Text</label>
								<textarea cols="80" id="content-area" name="content-area" rows="15" data-sample-short>Insert your text here</textarea>
								<script>
								CKEDITOR.replace('content-area', {
									// Define the toolbar groups as it is a more accessible solution.
									toolbarGroups: [{
											"name": "basicstyles",
											"groups": ["basicstyles"]
										},
										{
											"name": "links",
											"groups": ["links"]
										},
										{
											"name": "paragraph",
											"groups": ["list", "blocks"]
										},
										{
											"name": "document",
											"groups": ["mode"]
										},
										{
											"name": "insert",
											"groups": ["insert"]
										},
										{
											"name": "styles",
											"groups": ["styles"]
										},
										{
											"name": "about",
											"groups": ["about"]
										}
									],
									// Remove the redundant buttons from toolbar groups defined above.
									removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
								});
							</script>

							</div>
							<br>
							<div class="form-group col-lg-12">
								<input type="submit" class="btn btn-warning" value="Submit"/>
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
	<footer class="footer bg-light">
	  <div class="container">
	    <div class="row">
	      
	      <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
		  <ul class="list-inline mb-2">
	          <li class="list-inline-item">
	            <a href="about.php">About Us</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="articles.php">Articles</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="events.php">Events</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="">Exercises</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Support</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="contact.php">Contact Us</a>
	          </li>
	          <li></li>
	        </ul>
	        <p class="text-muted small mb-4 mb-lg-0">&copy; NBCC Welbeing App 2020. All Rights Reserved.</p>
	      </div>
	      <div class="footer-logo col-lg-6 h-100 text-center text-lg-right my-auto">
	      	<img src="includes/imgs/nbcc-logo.png" alt="NBCC Logo">
	      </div>
	    </div>
	  
	  </div>
	</footer>

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
?>