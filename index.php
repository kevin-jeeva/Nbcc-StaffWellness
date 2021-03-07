<?php
session_start();
if ($_SESSION["active"] == 0) {
	$msg = "Not an Active User";
	header("location:login.php?loginError=$msg");
}
if (!isset($_SESSION["staff_id"])) {
	header("location:Login.php");
}

include_once('functions/connect.php');
include_once('functions/staff.php');
include_once('functions/Content.php');
include_once("functions/Welcome.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Home Page</title>

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

	<!--successfull modal-->
	<div class="modal fade" id="mySucessModal">
		<div class="modal-dialog  modal-lg">
			<div class="modal-content">
				<div class="modal-body success">
					<img class="modal-body-img" src="includes/imgs/tick.gif"><span id="success_message"></span>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Navigation -->
	<?php include('functions/header.php'); ?>

	<!-- Masterhead -->
	<?php Welcome::DisplayWelcomeContent() ?>

	<!-- Welcome's Intro Image Structure. It's here just to explain how its works. Delete if necessary. -->
	<!--<header class="masthead text-white text-center" style="background: url('includes/imgs/0-wellbeing-main.jpg') no-repeat center center; background-size: cover;">
	  <div class="overlay"></div>
	  <div class="container">
	    <div class="row">
	      <div class="col-xl-9 mx-auto">
	        <h1 class="mb-5">Welcome </h1>
	        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac sapien sit amet elit imperdiet iaculis. Phasellus hendrerit posuere maximus.</p>
	      </div>
	      <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
	        <p></p>
	      </div>
	    </div>
	  </div>
	</header> -->

	<!--Main Content Sector (2 columns) -->
	<section class="main-content">
		<div class="container">
			<div class="row">

				<!--Content Sector (Main) -->
				<div class="the-content col-md-8">
					<h2>Recent Contents</h2>
					<hr>
					<!--Calling the Content class to retrieve two newest articles -->
					<?php Content::getTopArticles(3) ?>
				</div>

				<!--Sidebar (Links, Menus and other info) -->
				<div class="sidebar col-md-4">
					<div class="card">
						<div class="card-body">

							<h3>Next Events</h3>
							<?php Content::getNextEvents(2); ?>

						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- Quick Links -->
	<?php include('functions/quick-links.php'); ?>

	<!-- Footer -->
	<?php include('functions/footer.php'); ?>

</body>

</html>
<?php
if ($_SESSION["message"] != "") {
	$alert_message = $_SESSION["message"];
	//echo "<script>alert('$alert_message');</script>";
	echo " <script> 	       
				 $('#mySucessModal').modal();
				 document.getElementById(\"success_message\").textContent = '$alert_message' ;
				 </script>";
	$_SESSION["message"] = "";
}
?>