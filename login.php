<?php
session_start();
if (isset($_SESSION["staff_id"]) && $_SESSION["staff_id"] != "") {
    $msg = "Already logged in!";
    header("Location:index.php?msg=$msg");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Login Page</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
</head>

<body>

	<!--Successfull modal-->
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
	<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
	<div class="container justify-content-center">
		<ul class="navbar-nav">
			<li class="nav-item"><a class="navbar-brand" href="index.php">APP Logo</a></li>
		</ul>
	</div>
	</nav>

	<!-- Masterhead -->
	<header class="masthead text-white text-center">
		<!-- <div class="overlay"></div> -->
		<div class="container">

		  	<div class="col-xl-5 mx-auto">
				<h1 class="mb-5">Login</h1>

				<!-- PHP code that display error messages from other pages to login page! -->
				<?php
					sendMessage("loginError");
					function sendMessage($message){
					    if (isset($_GET["$message"])){
					        $msg = $_GET["$message"];
					        echo "<p class=\"alert alert-light text-danger\">$msg</p>";
					    }
					}
				?>
				<?php 
				 if (isset($_GET["message"])){
					        $msg = $_GET["message"];
					        echo "<p class=\"alert alert-light text-success\">$msg</p>";
					    }
						?>
				<!-- Staff Login Form -->
				<div class="container login-container">
				    <div class="row">
				        <div class="col-lg-12 login-form-1">
				            <h3>Login for Staff</h3>
				            <form method="POST" id="login_staff" action="proc_login.php">
				                <div class="form-group">
				                    <input type="text" class="form-control" name="email" id="email" placeholder="Your Email *" value="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$" required />
				                </div>
				                <div class="form-group">
				                    <input type="password" class="form-control" name="password" id="password" placeholder="Your Password *" value="" required= />
				                </div>
				                <div class="form-group">
				                    <input type="submit" class="btnSubmit" value="Login" />
				                </div>
				                <div class="form-group">

				                    <a href="forgot_password.php" class="ForgetPwd" value="Login">Forget Password?</a>
				                </div>
				            </form>
				        </div>
                                      
				    
				    <div class="container solo-text text-center">
				    	<p class="text-white">Are you a student? Please <a class="badge badge-light" href="#">Click here</a></p>
				    </div>

				</div> <!-- End of login-container-->  
			</div> <!-- End of col-xl-9 mx-auto-->

		</div> <!-- End of container-->
	</header>

	

	<!-- Footer -->
	<footer class="footer bg-light">
	  <div class="container">
	    <div class="row justify-content-center">
	      <div class="text-center">
	      	<img src="includes/imgs/nbcc-logo.png" width="40%">
			<p class="text-muted small">&copy; NBCC Welbeing App 2020. All Rights Reserved.</p>
	      </div>
	    </div> <!-- End of row-->
	  
	  </div> <!-- End of container-->
	</footer>

</body>
</html>

<?php
if(isset($_SESSION["resetMessage"]) && $_SESSION["resetMessage"] != "")
{
	$alert_message = $_SESSION["resetMessage"];
	echo "<script>
	$(\"#mySucessModal\").modal();
	document.getElementById(\"success_message\").textContent = '$alert_message';
	</script>";
	$_SESSION["resetMessage"] = "";
}
$_SESSION["resetMessage"]="";
?>