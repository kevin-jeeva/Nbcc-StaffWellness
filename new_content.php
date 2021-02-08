<?php
session_start();
include_once('functions/staff.php');
include_once("functions/Content.php");

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
  
	<title>Create a New Content</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Script for the Rich Editor -->
	<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
  
	<!-- Script for the category-->
	<script src="functions/category.js"></script>
	
	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">

	<link rel="stylesheet" 
	href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

	<script>
		function activateEventDate(){
			category = document.getElementById("contents").value;
			if (category === "Events"){
				document.getElementById("eventDate").disabled = false;
				document.getElementById("eventDate").value = "";
			}
			else{
				document.getElementById("eventDate").disabled = true;
				document.getElementById("eventDate").value = "";
			}
		}
	</script>

</head>

<body>

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
	    <h1 class="display-4">Create a New Content</h1>
	  </div>
	</div>

	<!--Main Content Sector (2 columns) -->
	<section class="main-content" >
		<div class="container">
		  <div class="row">

		  	<!--Content Sector (Main) -->
		    <div class="the-content col-md-8">
		    	<form method="post" id="newContentForm" name="newContentForm" onsubmit="return ContentCheck()" action="proc_newcontent.php">
					<div class="form-group col-xs-12 col-md-6">
						<div>
						<label for="content-category">Select Category (or) <a href="new_category.php" class="badge btn-outline-info">Create New Category</a></label>
						</div>
						<select name ="contents" id ="contents" onchange="activateEventDate()">
						<?php Content::getContents()?>
						</select>

						<!--this will get all the resource list
						<input list="resourceList" required = "true" name="resourceListId" id="resourceListId">
						<datalist id="resourceList" name ="resourceList">

						</datalist>-->
					</div>
							 
					<div class="form-group col-xs-6 col-md-4">
						<label for="content-title" id="content-title">Content Title</label>
						<input type="text" class="form-control" placeholder="Enter content title" name ="contentTitle" id="contentTitle" required>
					</div>

					<div class="form-group col-xs-6 col-md-4">
						<label for="content-title" id="content-title">Event Date <i>(optional)</i></label>
						<input type="date" class="form-control" name ="eventDate" id="eventDate" disabled>
					</div>
					
					<div class="form-group col-lg-12">
						<label for="content-description">Content Description</label>
						<textarea class="form-control" id="content-description" name="content-description" placeholder="Category Description" rows="5" maxlength="255" required></textarea>
					</div>
					
					<div class="form-group col-lg-12">
						<!-- CKEditor area -->
						<label for="content-area">Text</label>
						<textarea cols="80" id="content-area" name="content-area" rows="15" data-sample-short>Insert your text here</textarea>
						<script>
						CKEDITOR.replace('content-area', {
							// Define the toolbar groups as it is a more accessible solution.
							toolbarGroups: [{
									"name": "basicstyles",
									"groups": ["basicstyles"]
								},
								{
									"name": "links",
									"groups": ["links"]
								},
								{
									"name": "paragraph",
									"groups": ["list", "blocks"]
								},
								{
									"name": "document",
									"groups": ["mode"]
								},
								{
									"name": "insert",
									"groups": ["insert"]
								},
								{
									"name": "styles",
									"groups": ["styles"]
								},
								{
									"name": "about",
									"groups": ["about"]
								}
							],
							// Remove the redundant buttons from toolbar groups defined above.
							removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar'
						});
					</script>

					</div>
					<br>
					<div class="form-group col-lg-12">
						<input type="submit" class="btn btn-warning" value="Submit"/>
						<a href="administrator.php" type="button" class="btn btn-danger">Cancel</a>
					</div>
		    	</form> 	
		    </div>

		    <!--Sidebar (Links, Menus and other info) -->
		    <div class="sidebar col-md-4">
		    	
		    </div>

		  </div>
		</div>
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
?>