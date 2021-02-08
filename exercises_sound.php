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

	<title>Sound Exercises</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" 
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
</head>

<body>
	<!-- Navigation -->
	<?php include('functions/Header.php'); ?>

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
	            	<h3>audio 1</h3>
	              	<p class="card-text">audio Description</p>
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
	            	<h3>audio 2</h3>
	              	<p class="card-text">audio Description</p>
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
	            	<h3>audio 3</h3>
	              	<p class="card-text">audio Description.</p>
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
	            	<h3>audio 4</h3>
	              	<p class="card-text">audio Description</p>
	              	<a href="#" class="btn btn-outline-primary btn-block">link</a>
	            </div>
	          </div>
	        </div>
	      </div>

	    </div>
	  </div>
	</section>



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
	<?php include('functions/footer.php'); ?>

</body>
</html>