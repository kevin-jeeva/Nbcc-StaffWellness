
<?php include_once("functions/Content.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Create a New Resource</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
</head>

<body>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<div class="container">

		<a class="navbar-brand" href="index.php">APP Logo</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  	<li class="nav-item"><a class="nav-link" href="../../index.php">Home</a></li>
			  	<li class="nav-item"><a class="nav-link" href="../../about.php">About Us</a></li>
			  	<li class="nav-item"><a class="nav-link" href="../../articles.php">Articles</a></li>
			  	<li class="nav-item"><a class="nav-link" href="../../events.php">Events</a></li>
			  	<li class="nav-item dropdown">
				    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exercises</a>
				    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Video Exercises</a>
						<a class="dropdown-item" href="#">Sound Exercises</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
				    </div>
			  	</li> 		
			</ul>
		  	<div class="navbar-right">
		  		<ul class="navbar-nav mr-auto">
			  		<li class="nav-item"><a class="nav-link" href="../../contact.php">Contact Us</a></li>
			  		<li class="nav-item"><a class="nav-link" href="#">Support</a></li>
			  		<li class="nav-item"><a class="nav-link" href="../../administrator.php">Admin</a></li>
					<li class="nav-item"><a class="btn btn-outline-warning" href="functions/logout.php">Log out</a></li>
				</ul>
			</div>
		</div><!-- end of collapse navbar-collapse -->

	</div><!-- end of container -->
	</nav><!-- end of Navigation -->

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
		    	  <div class="form-group col-lg-12">
					<label for="question">Category Description</label>
					<textarea class="form-control" id="description" name="description" placeholder="Category Description" rows="5" maxlength="255" required></textarea>
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
	            <a href="#">About Us</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Articles</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Events</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Exercises</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Support</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Contact Us</a>
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