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

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
</head>

<body>
<!-- Navigation -->
<?php include('functions/header.php'); ?>

    <div class="container login-container">
		<div class="row">
			<div class="col-lg-12 login-form-1">

				<h3>Change password</h3>
				<form method="post" id="password_change" action="password_edit_proc.php">
				    <div class="form-group">
				        <input type="password" class="form-control" name="currentPassword" id="currentPassword" placeholder="Your current password *" value="" required />
				    </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Your new Password *" value="" required= />
                        </div>
                    <div class="form-group">
				        <input type="password" class="form-control" name="verifyPassword" id="verifyPassword" placeholder="Re-enter your new Password *" value="" required= />
				    </div>
                        <div class="form-group">
                        <input type="submit" class="btnSubmit" value="submit" name ="submit" />
                        </div>
				      <div class="form-group">
                            <a href="#" class="ForgetPwd" value="Forget Password">Forget Password?</a>
				       </div>
				 </form>
			</div>
		</div> <!-- End of login-container-->  
	</div> <!-- End of col-xl-9 mx-auto-->
</body>
<?php include('functions/footer.php'); ?>
