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

	<title>Reset Password</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
    <script src="functions/main.js"></script>
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
		<div class="overlay"></div>
		<div class="container">

		  	<div class="col-xl-5 mx-auto">
				<h1 class="mb-5">Reset Password</h1>

				<!-- Staff Login Form -->
				<div class="container login-container">
				    <div class="row">
				        <div class="col-lg-12 login-form-1">
                        
                        <div id = "checkCodeForm">
                          <div class="form-group">
                                    <p class="text-left text-success">Enter Email</p>
				                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" required />
				            </div>
                            <div class="form-group">
                                <p class="text-left text-success">Enter Code</p>
                                <input type="text" class="form-control" name="code" id="code" placeholder="Enter your Code" required />
                           </div>
                            <div class="form-group">
                                <button onclick= "checkCode()" class="btn btn-md btn-primary">Check Code</button>
				            </div>
                        </div>
                        <form  method="post" style="display:none" id="ForgetPwd" onsubmit="return CheckResetPassword()" action="proc_update_pwd.php">
                                <div class="form-group">
                                    <p class="text-left text-success">New Password</p>
				                    <input  type="password" class="form-control" name="newpwd" id="newpwd" placeholder="New Password" required />
				                </div>
                                <input type="hidden" id="mail" name="mail"/>
                                <div class="form-group">
                                    <p class="text-left text-success">Confirm Password</p>
				                    <input  type="password" class="form-control" name="cnfpwd" id="cnfpwd" placeholder="Confirm Password" value="" required />
				                </div>
				                <div class="form-group">
				                    <input type="submit" class="btnSubmit" id="submit" name="submit" value="Reset Password" />
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
	    <div class="row">
	      
	      <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
		  <ul class="list-inline mb-2">
	          <li class="list-inline-item">
	            <a href="about.php">About Us</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="articles.php">Articles</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="events.php">Events</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="">Exercises</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="#">Support</a>
	          </li>
	          <li class="list-inline-item">&sdot;</li>
	          <li class="list-inline-item">
	            <a href="contact.php">Contact Us</a>
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