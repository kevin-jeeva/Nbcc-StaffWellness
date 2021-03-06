<?php
	session_start();
	include_once('functions/connect.php');
	include_once('functions/staff.php');
	include_once('functions/Resource.php');
	include_once("functions/Welcome.php");
	include_once("functions/Media.php");
	include_once('functions/Content.php');
	
	if($_SESSION["active"] == 0)
	{
		$msg = "Not an Active User" ;
		header("location:login.php?loginError=$msg");
	}
	//redirection
	if (!isset($_SESSION["staff_id"])) //not currently logged in
	{
		header("Location:login.php");
	}
	else if(staff::GetStaffAdminNumber($_SESSION["staff_id"]) != 1 && staff::GetStaffAdminNumber($_SESSION["staff_id"]) != 2) //checks if user is admin
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

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	
	<!-- Bootstrap core CSS -->
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

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
		    $('#admTable3').DataTable();
		    $('#admTable4').DataTable();
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="ResetLink()">Cancel</button>
      </div>
      </div>
    </div>
	</div>
  
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
	<?php include('functions/header.php'); ?>

	<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">User Permissions</h1>
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
		    	  		<h2>List of Users</h2>		    	  	
			    	</div><hr>
            <div class="table-responsive">
			    	  	<table id="admTable" class="table sortable table-hover">
				    	      <!-- Table's Header -->
				    	      <thead>
				    	        <tr>
				    	          <th>#</th>
				    	          <th>User Name</th>
				    	          <th>Date Created</th>
								  <?php if(staff::GetStaffAdminNumber($_SESSION["staff_id"]) == 2){
									  echo "<th>Admin</th>";
								  }?>								  
				    	          <th class="action-header-cell">Status</th>
				    	        </tr>
				    	      </thead>

				    	      <!-- Important SECTION: display all content's categories from database -->
				    	      <tbody>
				    	        <?php staff::DisplayAllUsers($_SESSION["staff_id"])?>
				    	      </tbody>
			    	    </table>
			    	</div> <!-- End of table-responsive -->
		    	</div>
		    	</div> <!-- list-sector -->
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
	$(\"#ErrormyModal\").modal();
	document.getElementById(\"alert_message\").textContent = '$alert_message';
	</script>";
	$_SESSION["alert_message"] = "";
}
?>