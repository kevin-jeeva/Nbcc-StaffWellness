<?php
	session_start();
	include('functions/connect.php');
	include('functions/staff.php');
	include('functions/Content.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Contact</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
	<link rel="stylesheet" 
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body>
	<!-- Navigation -->
	<?php include('functions/header.php'); ?>

    <!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Contact Us</h1> 
        </div>
      </div>
  
   	<!--Main Content Sector (2 columns) -->
	<section class="main-content">
		<div class="container">
		  <div class="row">

		  	<!--Contact Sector (Main) -->
		    <div class="the-content col-md-8">
            	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2773.490223654188!2d-66.65555798377757!3d45.96146740814412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ca4189dc87c1293%3A0x443567a4443e547!2s284%20Smythe%20St%2C%20Fredericton%2C%20NB%20E3B%203C9!5e0!3m2!1sen!2sca!4v1610654138129!5m2!1sen!2sca" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                <br>
                <hr>
		    	<p>Email:<a href="mailto:nbcc@nbcc.ca"> nbcc@nbcc.ca</a></p>
                <p>Call Campuses: (506) 460-6222</p>
                <p> 284 Smythe Street Fredericton, NB</p>
		    </div>

		    <!--Sidebar (Links, Menus and other info) -->
		    <div class="sidebar col-md-4">
		    	<div class="card">
		    	  <div class="card-body">
		    	    
		    	    <h3>Next Events</h3>
					<?php Content::getNextEvents();?>

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
	<?php include('functions/footer.php'); ?>

</body>
</html>