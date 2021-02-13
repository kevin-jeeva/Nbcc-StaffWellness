<?php
	session_start();
	include_once('functions/connect.php');
	include_once('functions/staff.php');


	//redirection
	if (!isset($_SESSION["staff_id"])) //not currently logged in
	{
		header("Location:login.php");
	}
	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Change Password</title>

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
        <h1 class="display-4">Change Your Password</h1>
      </div>
    </div>
  
   	<!--Main Content Sector (2 columns) -->
	<section class="main-content">
		<div class="container">
			<div class="row">

				<!--Contact Sector (Main) -->
				<div class="the-content col-md-8">
				<form method="post" id="password_change" action="password_edit_proc.php">

					<div class="form-row">
						<div class="form-group col-xs-6 col-md-4">
							<label for="password" id="password-title">Current Password *</label>
					        <input type="password" class="form-control" name="currentPassword" id="currentPassword" placeholder="Your current password *" value="" required />
					    </div>
					</div>

					<div class="form-row">
					    <div class="form-group col-xs-6 col-md-4">
							<label for="password" id="password-title">New Password *</label>
					        <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Your new password *" value="" required />
					    </div>

					    <div class="form-group col-xs-6 col-md-4">
							<label for="verifyPassword" id="verifyPassword-title">Confirm New Password *</label>
					        <input type="password" class="form-control" name="verifyPassword" id="verifyPassword" placeholder="Re-enter your new Password" value="" required />
					    </div>
					</div>

					<br>				
						
					<div class="form-row">
						<div class="form-group col-lg-12">
							<input type="submit" class="btn btn-warning" value="Save Changes"/>
							<a href="index.php" type="button" class="btn btn-danger">Cancel</a>
						</div>
					</div>

				</form>
				</div> <!-- End of the-content col-md-8 -->

			</div> <!-- End of row -->
		</div> <!-- End of container-->  
	</section> <!-- End of main-content section-->

	<?php include('functions/footer.php'); ?>

</body>
</html>
