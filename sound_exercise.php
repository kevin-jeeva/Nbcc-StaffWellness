<?php
	session_start();
	if($_SESSION["active"] == 0)
	{
		$msg = "Not an Active User" ;
		header("location:login.php?loginError=$msg");
	}
	if(!isset($_SESSION["staff_id"]))
	{
			header("location:Login.php");
	}
	
	include('functions/connect.php');
	include('functions/staff.php');
	include('functions/Content.php');
	include('functions/Media.php');

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Sound Exercises</title>
	
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

	<!-- Masterhead -->
		<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">Sound Exercises</h1>
	  </div>
	</div>
	
	<!-- Categories Grid (4 columns) -->
	<section class="features-categories text-center">
	  <div class="container">
	    <div class="row">
			<?php Media::DisplaySoundCards()?>
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

	<!-- Footer -->
	<?php include('functions/footer.php'); ?>

</body>
</html>