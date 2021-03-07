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

	<title>Forgot Password</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
</head>

<body>
	  <!--Error modal-->
	<div class="modal fade" id="ErrormyModal">
    <div class="modal-dialog  modal-sm">
      <div class="modal-content">     
			<div class="modal-header">
        <h4 class="modal-title">Error</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <div class="modal-body error">			
         <span id = "alert_message"></span>				
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
				<h1 class="mb-5">Forgot Password</h1>

				<!-- Staff Login Form -->
				<div class="container login-container">
				    <div class="row">
				        <div class="col-lg-12 login-form-1">
				            <h3>Password Reset</h3>
				            <form method="post" id="ForgetPwd" action="proc_forgotPass.php">
				                <div class="form-group">
				                    <input type="text" class="form-control" name="email" id="email" placeholder="Your Email *" value="" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$" required />
				                </div>
				                <div class="form-group">
				                    <input type="submit" class="btnSubmit" id="submit" name="submit" value="Email password reset" />
				                </div>
				                
				            </form>
						
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
if($_SESSION["alert_message"] != "")
{
  $alert_message = $_SESSION["alert_message"];
	echo "<script>
	$(\"#ErrormyModal\").modal();
	document.getElementById(\"alert_message\").textContent = '$alert_message';
	</script>";
	$_SESSION["alert_message"] = "";
}
?>