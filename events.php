<?php
session_start();
include('functions/connect.php');
include('functions/staff.php');
include('functions/Content.php');
if ($_SESSION["active"] == 0) {
	$msg = "Not an Active User";
	header("location:login.php?loginError=$msg");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Events</title>

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

	<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Events</h1>
			<!--<p class="lead">{Description of this category: e.g. Events}.</p> -->
		</div>
	</div>

	<!--Main Content Sector -->
	<section class="main-content">
		<div class="container">
			<div class="row">

				<!--Calling Content class to retrieve all articles -->
				<?php
				Content::getAllEvents(12);
				?>

			</div> <!-- End of row -->
		</div> <!-- End of container-->
	</section>

	<!-- Footer -->
	<?php include('functions/footer.php'); ?>

</body>

</html>