<?php
	session_start();

        if(!isset($_SESSION["staff_id"]))
        {
			 
            header("location:Login.php");
        }
	
	include('functions/connect.php');
	include('functions/staff.php');
	include('functions/Content.php');  
	require_once("functions/Welcome.php");


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
	
		    	    <h3>User Information</h3><hr>
		    	    <?php
				   staff::getUserInfo();
				   ?>
		    	<br><br>
				<?php
					sendMessage("Error");
					function sendMessage($message){
						if (isset($_GET["$message"])){
							$msg = $_GET["$message"];
							echo "<p class=\"alert alert-light text-danger\">$msg</p><br>";
						}
					}
				?>
				<p>
					<a id="userBtn" class="btn btn-primary" data-toggle="collapse" href="#collapsePassword" role="button" aria-expanded="false" aria-controls="collapseExample">
						Change password
					</a>
				</p>
				<div class="collapse" id="collapsePassword">
					<div class="card card-body">
						<form method="post" id="password_change" action="password_edit_proc.php">
							<h3>Change your password</h3><hr>
							<div class="form-row">
								<div class="form-group col-xs-6 col-md-4">
								<label>Your current password *</label>
									<input type="password" class="form-control" name="currentPassword" id="currentPassword" value="" required />
								</div>
							
								<div class="form-group col-xs-6 col-md-4">
								<label>Your new password *</label>
									<input type="password" class="form-control" name="newPassword" id="newPassword" value="" required />
								</div>

								<div class="form-group col-xs-6 col-md-4">
								<label>Re-enter password *</label>
									<input type="password" class="form-control" name="verifyPassword" id="verifyPassword" value="" required />
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-lg-12">
									<input type="submit" class="btn btn-warning" value="Update" name="submit" />
									<a href="index.php" type="button" class="btn btn-danger">Cancel</a>
								</div>
							</div>
						</form> <!-- END CHANGE PASSWORD Form-->
					</div><br>
				</div>
				<!-- Change you email-->
				<p>
					<a id="userBtn" class="btn btn-primary" data-toggle="collapse" href="#collapseEmail" role="button" aria-expanded="false" aria-controls="collapseExample">
						Change Email
					</a>
				</p>

				<div class="collapse" id="collapseEmail">
					<div class="card card-body">
						<form method="post" id="email_change" action="email_edit_proc.php"  autocomplete="off">
							<h3>Change your Email</h3><hr>
							<div class="form-row">
								<div class="form-group col-xs-6 col-md-4">
									<label>Password *</label>
									<input type="password" class="form-control" name="password" id="password"  value="" required />
								</div> 
							
								<div class="form-group col-xs-6 col-md-4">
								<label>New Email * </label>
									<input type="text"  class="form-control" name="newEmail" id="newEmail" value="" required />
								</div>
							
							</div>
							<div class="form-row">
								<div class="form-group col-lg-12">
									<input type="submit" class="btn btn-warning" value="Update" name="submit" />
									<a href="index.php" type="button" class="btn btn-danger">Cancel</a>
								</div>
							</div> 
						</form> <!-- END CHANGE EMAIL Form-->
					</div><br>
				</div>	
					<!-- Change you phone-->
				<p>
					<a id="userBtn" class="btn btn-primary" data-toggle="collapse" href="#collapsePhone" role="button" aria-expanded="false" aria-controls="collapseExample">
						Change Phone Number
					</a>
				</p>

				<div class="collapse" id="collapsePhone">
					<div class="card card-body">
						<form method="post" id="phone_change" action="phone_edit_proc.php"  autocomplete="off">
							<h3>Change your Phone Number</h3><hr>
							<div class="form-row">
								<div class="form-group col-xs-6 col-md-4">
									<label>Password *</label>
									<input type="password" class="form-control" name="password" id="password"  value="" required />
								</div> 
							
								<div class="form-group col-xs-6 col-md-4">
								<label>New Phone Number * </label>
									<input type="text"  class="form-control" name="newPhone" id="newPhone" value="" required />
								</div>
							
							</div>
							<div class="form-row">
								<div class="form-group col-lg-12">
									<input type="submit" class="btn btn-warning" value="Update" name="submit" />
									<a href="index.php" type="button" class="btn btn-danger">Cancel</a>
								</div>
							</div> 
						</form> <!-- END CHANGE PHONE Form-->
					</div><br>
				</div>

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