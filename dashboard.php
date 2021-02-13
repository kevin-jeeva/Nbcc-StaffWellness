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
        
	require_once('functions/connect.php');
	require_once('functions/staff.php');
  require_once('functions/Content.php');
  require_once("functions/Welcome.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Dashboard</title>
  	
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
	<!-- <script src="functions/notifications.js"></script> -->

</head>

<body>

	<!--successfull modal-->
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
	<?php include('functions/header.php'); ?>
	
  	<!-- Masterhead -->
  	<?php Welcome::DisplayWelcomeContent()?>
	
	<!-- Categories Grid (4 columns) -->
	<section class="progress-table text-center">
	  <div class="container">
	    <div class="row">
			<div class="col-lg-12">
			 <h2 class="text-left"><?=$_SESSION["staff_name"]?> Progress</h2><hr>
			</div>
	      <div class="col-lg-12">	
				<table class="table table-striped ">
						<thead class="table-dark text-white">
							<tr>
							  <th scope="col">#</th>
								<th scope="col">Content</th>
								<th scope="col">Progress</th>      
							</tr>
						</thead>
						<tbody>
						<?php Welcome::GetProgressContent($_SESSION["staff_id"])?> 							
						</tbody>
				</table>				
	      </div>    
	    </div>
	  </div>
	</section>

 
	<!--Main Content Sector (2 columns) -->
	<section class="main-content">	
		<div class="container">
		  	<div class="row">

			  	<!--Content Sector (Main) -->
			    <div class="the-content col-md-8">
			    	<h2>Last Viewed</h2>
			    	<hr>
					<!--Calling the Content class to retrieve two newest articles -->
			    	<?php Welcome::GetLastViewed($_SESSION["staff_id"]) ?>
			    </div>

			    <!--Sidebar (Links, Menus and other info) -->
			    <div class="sidebar col-md-4">
			    	<div class="card">
			    	  <div class="card-body">
			    	    
			    	    <h3>Suggested</h3>
						<?php Welcome::SuggestedContent($_SESSION["staff_id"]);?>

			    	  </div>
			    	</div>
			    </div>

		  	</div>
		</div>
	</section>

	<!--Most viewed-->
	<section class="most-viewed text-center">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h2 class="text-left">Most Viewed</h2><hr>
				</div>
				<?php Welcome::GetMostViewed($_SESSION["staff_id"])?>
			</div> <!-- End of row-->
		</div> <!-- End of container-->
	</section> <!-- End of most-viewed section-->

	<!-- Footer -->
	<?php include('functions/footer.php'); ?>

</body>
</html>
<?php
if($_SESSION["message"] != "")
{
	$alert_message = $_SESSION["message"];	
	//echo "<script>alert('$alert_message');</script>";
	echo " <script> 	       
				 $('#mySucessModal').modal();
				 document.getElementById(\"success_message\").textContent = '$alert_message' ;
				 </script>";
	$_SESSION["message"] = "";
}
?>