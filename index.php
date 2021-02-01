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
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Home Page</title>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
</head>

<body>

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

	<!-- Masterhead -->
	<header class="masthead text-white text-center" style="background: url('includes/imgs/0-wellbeing-main.jpg') no-repeat center center; background-size: cover;">
	  <div class="overlay"></div>
	  <div class="container">
	    <div class="row">
	      <div class="col-xl-9 mx-auto">
	        <h1 class="mb-5">Welcome <?=$_SESSION["staff_name"]?></h1>
	        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac sapien sit amet elit imperdiet iaculis. Phasellus hendrerit posuere maximus.</p>
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
	            	<h3>Articles</h3>
	              	<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
	              	<a href="#" class="btn btn-outline-primary btn-block">Access Articles</a>
	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-lg-3 col-md-6 col-sm-12">
	        <div class="features-categories-item mx-auto mb-5 mb-lg-0 mb-lg-3">
	          <div class="card">
	            <img src="includes/imgs/2-wellbeing-events.jpg" class="card-img-top" alt="...">
	            <div class="card-body">
	            	<h3>Events</h3>
	              	<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
	              <a href="#" class="btn btn-outline-primary btn-block">Access Events</a>
	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-lg-3 col-md-6 col-sm-12">
	        <div class="features-categories-item mx-auto mb-5 mb-lg-0 mb-lg-3">
	          <div class="card">
	            <img src="includes/imgs/3-wellbeing-exercises.jpg" class="card-img-top" alt="...">
	            <div class="card-body">
	            	<h3>Exercises</h3>
	              	<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
	              	<a href="#" class="btn btn-outline-primary btn-block">Access Exercises</a>
	            </div>
	          </div>
	        </div>
	      </div>

	      <div class="col-lg-3 col-md-6 col-sm-12">
	        <div class="features-categories-item mx-auto mb-5 mb-lg-0 mb-lg-3">
	          <div class="card">
	            <img src="includes/imgs/4-wellbeing-support.jpg" class="card-img-top" alt="...">
	            <div class="card-body">
	            	<h3>Support</h3>
	              	<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
	              	<a href="#" class="btn btn-outline-primary btn-block">Get Support</a>
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

			  	<!--Content Sector (Main) -->
			    <div class="the-content col-md-8">
			    	<h2>Recent Contents</h2>
			    	<hr>
					<!--Calling the Content class to retrieve two newest articles -->
			    	<?php Content::getTopArticles() ?>
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
<?php
if($_SESSION["message"] != "")
{
	$alert_message = $_SESSION["message"];	
	//echo "<script>alert('$alert_message');</script>";
	echo " <script> 	       
				 $('#mySucessModal').modal();
				 document.getElementById(\"success_message\").textContent = '$alert_message' ;
				 </script>";
	$_SESSION["message"] = "";
}
?>