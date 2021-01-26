<?php
	session_start();
        if(!isset($_SESSION["staff_id"]))
        {
            header("location:Login.php");
        }
        
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

	<title>Video Exercises</title>
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
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">

		<a class="navbar-brand" href="#">APP Logo</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  	<li class="nav-item active"><a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a></li>
			  	<li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
			  	<li class="nav-item"><a class="nav-link" href="articles.php">Articles</a></li>
			  	<li class="nav-item"><a class="nav-link" href="#">Events</a></li>
			  	<li class="nav-item dropdown">
				    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exercises</a>
				    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="exercises_video.php">Video Exercises</a>
						<a class="dropdown-item" href="exercises_sound.php">Sound Exercises</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
				    </div>
			  	</li> 		
			</ul>
		  	<div class="navbar-right">
		  		<ul class="navbar-nav mr-auto">
			  		<li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
			  		<li class="nav-item"><a class="nav-link" href="#">Support</a></li>
					<li class="nav-item"><a class="btn btn-outline-primary" href="functions/logout.php">Log out</a></li>
				</ul>
			</div>

	</div>
	</nav>

	<!-- Masterhead -->
	<header class="masthead text-white text-center" style="background: url('includes/imgs/0-wellbeing-main.jpg') no-repeat center center; background-size: cover;">
	  <div class="overlay"></div>
	  <div class="container">
	    <div class="row">
	      <div class="col-xl-9 mx-auto">
	        <h1 class="mb-5">Dashboard content? </h1>
	        <p>More Text Here</p>
	      </div>
	      <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
	        <p></p>
	      </div>
	    </div>
	  </div>
	</header>

	<!-- Categories Grid (4 columns) -->
	<section class="features-categories text-center">
	  <div class="container">
	    <div class="row">

	      <div class="col-lg-3 col-md-6 col-sm-12">
	        <div class="features-categories-item mx-auto mb-5 mb-lg-0 mb-3">
	          <div class="card">
	            <img src="includes/imgs/1-wellbeing-articles.jpg" class="card-img-top" alt="...">
	            <div class="card-body">
	            	<h3>Video 1</h3>
	              	<p class="card-text">Video Description</p>
	              	<a href="#" class="btn btn-outline-primary btn-block">link</a>
	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-lg-3 col-md-6 col-sm-12">
	        <div class="features-categories-item mx-auto mb-5 mb-lg-0 mb-lg-3">
	          <div class="card">
	            <img src="includes/imgs/2-wellbeing-events.jpg" class="card-img-top" alt="...">
	            <div class="card-body">
	            	<h3>Video 2</h3>
	              	<p class="card-text">Video Description</p>
	              <a href="#" class="btn btn-outline-primary btn-block">link</a>
	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-lg-3 col-md-6 col-sm-12">
	        <div class="features-categories-item mx-auto mb-5 mb-lg-0 mb-lg-3">
	          <div class="card">
	            <img src="includes/imgs/3-wellbeing-exercises.jpg" class="card-img-top" alt="...">
	            <div class="card-body">
	            	<h3>Video 3</h3>
	              	<p class="card-text">Video Description.</p>
	              	<a href="#" class="btn btn-outline-primary btn-block">link</a>
	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-lg-3 col-md-6 col-sm-12">
	        <div class="features-categories-item mx-auto mb-5 mb-lg-0 mb-lg-3">
	          <div class="card">
	            <img src="includes/imgs/4-wellbeing-support.jpg" class="card-img-top" alt="...">
	            <div class="card-body">
	            	<h3>Video 4</h3>
	              	<p class="card-text">Video Description</p>
	              	<a href="#" class="btn btn-outline-primary btn-block">link</a>
	            </div>
	          </div>
	        </div>
	      </div>

	    </div>
	  </div>
	</section>

	<!--Main Content Sector (2 columns) -->
	<section class="main-content">
		<div class="container">
		  <div class="row">

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
	      <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
	      	<img src="includes/imgs/nbcc-logo.png" width="20%">
	      </div>
	    </div>
	  
	  </div>
	</footer>

</body>
</html>