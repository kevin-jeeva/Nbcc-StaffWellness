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

	<title>About Us</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
</head>

<body>
	<!-- Navigation -->
	<?php include('functions/Header.php'); ?>
		
    	<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">About Us</h1> 
        </div>
      </div>
  
   	<!--Main Content Sector (2 columns) -->
	<section class="main-content">
		<div class="container">
		  <div class="row">

		  	<!--Contact Sector (Main) -->
		    <div class="the-content col-md-8">
                <br>
		    	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eu ante malesuada, posuere nibh ac, consequat purus. Phasellus bibendum laoreet urna in porta. Maecenas bibendum viverra lobortis. Phasellus justo enim, vestibulum at lobortis eu, scelerisque ac ligula. Aliquam tincidun hendrerit nunc, vulputate consequat ex congue eu. Ut et porttitor tellus. Nunc eu libero eget magna posuere consequat. Nunc ut purus turpis.</p><br>

                <p>Pellentesque nec tincidunt elit, et dictum nibh. Pellentesque ut orci laoreet, venenatis est in, porttitor nibh. Aliquam lorem turpis, lacinia sed dolor et, vulputate sodales libero. Sed varius justo eget tincidunt pharetra. Nam eleifend hendrerit elit, imperdiet interdum ipsum malesuada sed. Proin nunc nunc, egestas a sapien in, convallis scelerisque mi. Proin magna urna, porta id mauris ultricies, congue luctus tortor. Suspendisse in nibh ultrices, vulputate erat vel, dictum massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin a dui ante. Fusce efficitur molestie sapien, vitae varius augue ornare eget. Curabitur sodales sem id vulputate faucibus.</p>
		    </div>

		    <!--Sidebar (Links, Menus and other info) -->
		    <div class="sidebar col-md-12 col-lg-4">
		    	<div class="card">
		    	  <div class="card-body">
		    	    <h3>Next Events</h3>
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
	<?php include('functions/footer.php'); ?>

</body>
</html>