<?php
	session_start();
	include_once('functions/connect.php');
	include_once('functions/staff.php');
	include_once('functions/Resource.php');
	include_once("functions/Welcome.php");
		include_once("functions/Media.php");
	include_once('functions/Content.php');

	//redirection
	if (!isset($_SESSION["staff_id"])) //not currently logged in
	{
		header("Location:login.php");
	}
	else if(staff::GetStaffAdminNumber($_SESSION["staff_id"]) != 1) //checks if user is admin
	{
		header("Location:index.php");
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Administration Page</title>

	<!-- Bootstrap core CSS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
	<!-- <script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script> -->

	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">	
	<script src="functions/admin.js"></script>

	<!-- Pagination and Sort tables plugin. Source: https://datatables.net/examples/styling/bootstrap4 -->
	<script src="includes/js/jquery.dataTables.min.js"></script>
	<script src="includes/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" type="text/css" href="includes/dataTables.bootstrap4.min.css"></script>
	<script>
		$(document).ready(function() {
		    $('#admTable').DataTable();
		    $('#admTable2').DataTable();
		} );
	</script>
	
</head>

<body>
	 <!--open modal for delete-->
	 	<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">     
			<div class="modal-header">
        <h4 class="modal-title">Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <div class="modal-body">			
         Are you sure to Delete this?	
				</div>
				<div class="modal-footer">
				<a href="#" type="button" class="btn btn-danger" id="DeleteContent">Delete</a>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="ResetLink()">Cancel</button>
      </div>
      </div>
    </div>
	</div>
  
	  <!--Error modal-->
	<div class="modal fade" id="myModal">
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

	<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">Administration Panel</h1>
	    <p class="lead">Hello <?=$_SESSION["staff_name"]?></p>
	  </div>
	</div>

	<!--Main Content Sector (2 columns) -->
	<section class="main-content">
		<div class="container">
		  <div class="row">

            <!--Content Sector (Main) -->
		    <div class="the-content col-md-12">
		    	<!-- List Model for Category -->
		    	<div class="list-sector">
			    	<div class="list-header row">
		    	  		<h2>List of created Resources</h2>
		    	  		<a href="new_category.php" type="button" class="new-btn btn-sm btn-primary" value="id">Create new</a>
			    	</div><hr>

			    	<div class="table-responsive">
			    	  	<table id="admTable" class="table sortable table-hover">
				    	      <!-- Table's Header -->
				    	      <thead>
				    	        <tr>
				    	          <th>#</th>
				    	          <th>Title</th>
				    	          <th>Created on</th>
				    	          <th class="action-header-cell">Actions</th>
				    	        </tr>
				    	      </thead>

				    	      <!-- Important SECTION: display all content's categories from database -->
				    	      <tbody>
				    	        <?php Resource::GetAllResources()?>
				    	      </tbody>
			    	    </table>
			    	</div> <!-- End of table-responsive -->
		    	</div>

		    	<!-- List Model for created Contents -->
		    	<div class="list-sector">
			    	<div class="list-header row">
		    	  		<h2>List of created Contents</h2>
		    	  		<a href="new_content.php" type="button" class="new-btn btn-sm btn-primary" value="id">Create new</a>
			    	</div><hr>

			    	<div class="table-responsive">
			    	  	<table id="admTable2" class="table sortable table-hover">
				    	      <!-- Table's Header -->
				    	      <thead>
				    	        <tr>
				    	          <th>#</th>
				    	          <th>Title</th>
				    	          <th>Resource</th>
				    	          <th>Created on</th>
				    	          <th class="action-header-cell">Actions</th>
				    	        </tr>
				    	      </thead>

				    	      <!-- Important SECTION: display all content's categories from database -->
				    	      <tbody>
									<?php Content::GetListofCreatedContent()?>				    	       
				    	      </tbody>
			    	    </table>
			    	</div> <!-- End of table-responsive -->
		    	</div>
					<div class="list-sector">
			    	<div class="list-header row">
		    	  		<h2>List of Welcome Created</h2>
		    	  		<a href="new_welcome.php" type="button" class="new-btn btn-sm btn-primary" value="id">Create new</a>
			    	</div>

			    	<div class="table-responsive">
			    	  	<table id="admTable" class="table sortable table-hover">
				    	      <!-- Table's Header -->
				    	      <thead>
				    	        <tr>
				    	          <th data-defaultsign="_19">#</th>
				    	          <th data-defaultsign="AZ">Welcome Title</th>				    	          
				    	          <th data-defaultsign="month">Created On</th>
				    	          <th data-defaultsign="disabled" class="action-header-cell">Actions</th>
				    	        </tr>
				    	      </thead>

				    	      <!-- Important SECTION: display all content's categories from database -->
				    	      <tbody>
								<?php Welcome::GetListofCreatedWelcoms()?>
				    	      </tbody>
			    	    </table>
			    	</div> <!-- End of table-responsive -->
							<div class="list-sector">
			    	<div class="list-header row">
		    	  		<h2>List of Exercies Vidoes Created</h2>
		    	  		<a href="new_video.php" type="button" class="new-btn btn-sm btn-primary" value="id">Create new</a>
			    	</div>

			    	<div class="table-responsive">
			    	  	<table id="admTable" class="table sortable table-hover">
				    	      <!-- Table's Header -->
				    	      <thead>
				    	        <tr>
				    	          <th data-defaultsign="_19">#</th>
				    	          <th data-defaultsign="AZ">Video Title</th>	
												 <th data-defaultsign="AZ">Video Name</th>				    	          
				    	          <th data-defaultsign="month">Created On</th>
				    	          <th data-defaultsign="disabled" class="action-header-cell">Actions</th>
				    	        </tr>
				    	      </thead>

				    	      <!-- Important SECTION: display all content's categories from database -->
				    	      <tbody>
								<?php Media::GetListOfCreatedVideos()?>
				    	      </tbody>
			    	    </table>
			    	</div> <!-- End of table-responsive -->
		    	</div>
		    </div> <!-- End of the-content col-md-12 -->
		  </div> <!-- End of row -->
		</div> <!-- End of container -->
	</section>

	<!-- Footer -->
	<?php include('functions/footer.php'); ?>

</body>
</html>
<?php
if($_SESSION["message"] != "")
{
	$alert_message = $_SESSION["message"];
	echo "<script>
	$(\"#mySucessModal\").modal();
	document.getElementById(\"success_message\").textContent = '$alert_message';
	</script>";
	$_SESSION["message"] = "";
}
if($_SESSION["alert_message"] != "")
{
  $alert_message = $_SESSION["alert_message"];
	echo "<script>
	$(\"#myModal\").modal();
	document.getElementById(\"alert_message\").textContent = '$alert_message';
	</script>";
	$_SESSION["alert_message"] = "";
}
?>