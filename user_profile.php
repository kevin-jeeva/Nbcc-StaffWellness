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

	<title>User Profile</title>

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
        <h1 class="display-4">Profile Settings</h1>
      </div>
    </div>
  
   	<!--Main Content Sector (2 columns) -->
	<section class="main-content">
		<div class="container">
		  <div class="row">

		  	<!--Contact Sector (Main) -->
		    <div class="the-content col-md-8">
		    	<!-- Form that holds all input fields for the user -->
			    
			    	<!--
			    	<div class="form-row"> 
						<div class="form-group col-xs-6 col-md-4">
							<label for="fname" id="fname-title">First Name *</label>
							<input type="text" class="form-control" placeholder="Enter your first name" name ="fname" id="fname" required>
						</div>

						<div class="form-group col-xs-6 col-md-4">
							<label for="lname" id="lname-title">Last Name *</label>
							<input type="text" class="form-control" placeholder="Enter your last name" name ="lname" id="lname" required>
						</div>
					</div>
					-->
					
					<!-- <div class="form-row">
						<div class="form-group col-xs-6 col-md-4">
							<label for="email" id="email-title">Email *</label>
							<input type="text" class="form-control" name="email" id="email" placeholder="Enter your email" value="" required />
						</div>
					</div> -->
			
				<!-- CHANGE YOUR PASSWORD -->
				<form method="post" id="password_change" action="password_edit_proc.php">
					<h3>Change your password:</h3>
					<div class="form-row">
						<div class="form-group col-xs-6 col-md-4">
					        <input type="password" class="form-control" name="currentPassword" id="currentPassword" placeholder="Your current password *" value="" required />
					    </div>
					
					    <div class="form-group col-xs-6 col-md-4">
					        <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Your new password *" value="" required />
					    </div>

					    <div class="form-group col-xs-6 col-md-4">
					        <input type="password" class="form-control" name="verifyPassword" id="verifyPassword" placeholder="Re-enter your new Password *" value="" required />
					    </div>
					</div>
					<div class="form-row">
						<div class="form-group col-lg-12">
							<input type="submit" class="btn btn-warning" value="Update Password" name="submit" />
							<a href="index.php" type="button" class="btn btn-danger">Cancel</a>
						</div>
					</div> <br><br>
				</form> <!-- END CHANGE PASSWORD Form-->

				<!-- Profile Picture-->
				<form> 		
					<h3>Update your Profle Picture:</h3>	
					<div class="form-row">
						<div class="form-group col-xs-6 col-md-4">
							<input id="profile_image" name="profile_image" type="file" accept="image/*" required />
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-lg-12">
							<input type="submit" class="btn btn-warning" value="Save Profile Picture"/>
							<a href="index.php" type="button" class="btn btn-danger">Cancel</a>
						</div>
					</div>
		    	</form> <!--end profile picture-->

		    </div><!-- End of the-content col-md-8 -->

		    <!--Sidebar (Links, Menus and other info) -->
		    <div class="sidebar col-md-12 col-lg-4"></div>

		  </div> <!-- End of row -->
		</div> <!-- End of container -->
	</section>

	<!-- Footer -->
	<?php include('functions/footer.php'); ?>

</body>
</html>