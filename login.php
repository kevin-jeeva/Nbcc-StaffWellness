<?php
session_start();

if (isset($_SESSION["user"])) {
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
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container justify-content-center">
		<ul class="navbar-nav">
			<li class="nav-item"><a class="navbar-brand" href="index.html">APP Logo</a></li>
		</ul>
	</div>
	</nav>

	<!-- Masterhead -->
	<header class="masthead text-white text-center">
		<div class="overlay"></div>
		<div class="container">

		  	<div class="col-xl-9 mx-auto">
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

				<!-- Student Login. Don't need to edit it. This is not our concern -->
				<div class="container login-container">
				    <div class="row">
				        <div class="col-md-6 login-form-1">
				            <h3>Login for Staff</h3>
				            <form method="post" id="login_staff" action="proc_login.php">
				                <div class="form-group">
				                    <input type="text" class="form-control" name="email" id="email" placeholder="Your Email *" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
				                </div>
				                <div class="form-group">
				                    <input type="password" class="form-control" name="password" id="password" placeholder="Your Password *" value="" required= />
				                </div>
				                <div class="form-group">
				                    <input type="submit" class="btnSubmit" value="Login" />
				                </div>
				                <div class="form-group">

				                    <a href="#" class="ForgetPwd" value="Login">Forget Password?</a>
				                </div>
				            </form>
				        </div>

				        <!-- Staff Login. This is our concern! -->
				        <div class="col-md-6 login-form-2">
				            <h3>Administration</h3>
				            <form method="post" id="login_staff" action="proc_login.php">
				                <div class="form-group">
				                    <input type="text" class="form-control" name="email" id="email" placeholder="Your Email *" value="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
				                </div>
				                <div class="form-group">
				                    <input type="password" class="form-control" name="password" id="password" placeholder="Your Password *" value="" required= />
				                </div>
				                <div class="form-group">
				                    <input type="submit" class="btnSubmit" value="Login" />
				                </div>
				                <div class="form-group">

				                    <a href="#" class="ForgetPwd" value="Login">Forget Password?</a>
				                </div>
				            </form>
				        </div>
				    </div> <!-- End of row-->
				    
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
	    <div class="row">
	      
	      <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
	        <ul class="list-inline mb-2">
	          <li class="list-inline-item">
	            <a href="#">About Us</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Articles</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Events</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Exercises</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Support</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Contact Us</a>
	          </li>
	          <li></li>
	        </ul>
	        <p class="text-muted small mb-4 mb-lg-0">&copy; NBCC Welbeing App 2020. All Rights Reserved.</p>
	      </div> <!-- End of col-lg-6 h-100 text-center text-lg-left my-auto-->

	      <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
	      	<img src="includes/imgs/nbcc-logo.png" width="20%">
	      </div>
	    </div> <!-- End of row-->
	  
	  </div> <!-- End of container-->
	</footer>

</body>
</html>