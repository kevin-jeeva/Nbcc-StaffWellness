<?php
	session_start();
	include('functions/connect.php');
	include('functions/staff.php');
	include('functions/Content.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Home Page</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
</head>

<body>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<div class="container">

		<a class="navbar-brand" href="#">APP Logo</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  	<li class="nav-item active"><a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a></li>
			  	<li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
			  	<li class="nav-item"><a class="nav-link" href="articles.php">Articles</a></li>
			  	<li class="nav-item"><a class="nav-link" href="#">Events</a></li>
			  	<li class="nav-item dropdown">
				    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exercises</a>
				    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Video Exercises</a>
						<a class="dropdown-item" href="#">Sound Exercises</a>
						<div class="dropdown-divider"></zdiv>
						<a class="dropdown-item" href="#">Something else here</a>
				    </div>
			  	</li> 		
			</ul>
		  	<div class="navbar-right">
		  		<ul class="navbar-nav mr-auto">
			  		<li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
			  		<li class="nav-item"><a class="nav-link" href="#">Support</a></li>
					<li class="nav-item"><a class="btn btn-outline-warning" href="functions/logout.html">Log Out</a></li>
				</ul>
			</div>

	</div>
	</nav>

	<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">Category Page</h1>
	    <p class="lead">Description of this Category.</p>
	  </div>
	</div>

	<!--Main Content Sector (2 columns) -->
	<section class="main-content">
		<div class="container">
		  <div class="row">

              <!--Content Sector (Main) -->
              <!--Calling Content class to retrieve all articles -->
		    
		    <div class="the-content col-md-8">
		    	<?php Content::getAllArticles() ?>
		    </div>

		    <!--Sidebar (Links, Menus and other info) -->
		    <div class="sidebar col-md-4">
		    	<div class="card">
		    	  <div class="card-body">
		    	    <h3>Next Events</span></h3>
		    	    <hr>
		    		<h5 class="card-title">Lorem Ipsum</h5>
		    	    <span class="badge badge-info">Jan 30th, 2020</span>
		    	    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
		    	    <a href="#" class="btn btn-outline-info btn-block">See Details</a>
		    	    <hr>
		    		<h5 class="card-title">Lorem Ipsum</h5>
		    	    <span class="badge badge-info">Jan 31th, 2020</span>
		    	    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
		    	    <a href="#" class="btn btn-outline-info btn-block">See Details</a>

		    	  </div>
		    	</div>
		    </div>

		  </div>
		</div>
	</section>

	<!--Secondary Content Sector -->
	<section class="secondary-content text-center">
	  	<div class="overlay"></div>
	  	<div class="container">
	  	  <div class="row">
	  	    <div class="col-xl-9 mx-auto text-white">
	  	      <h3 class="mb-4">Phrase of the day</h3>
	  	      <blockquote class="blockquote">
	  	        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
	  	        <footer class="blockquote-footer text-white">Someone famous in <cite title="Source Title">Source Title</cite></footer>
	  	      </blockquote>
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
	      <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
	      	<img src="includes/imgs/nbcc-logo.png" width="20%">
	      </div>
	    </div>
	  
	  </div>
	</footer>

</body>
</html>