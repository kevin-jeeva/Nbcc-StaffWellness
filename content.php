
<?php include_once("functions/Content.php");?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
  
	<title>Create a New Content</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="includes/bootstrap-4.5.3-dist/css/bootstrap.min.css">
	<script src="includes/bootstrap-4.5.3-dist/jquery/jquery-3.5.1.slim.min.js"></script>
	<script src="includes/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>

	<!-- Script for the Rich Editor -->
	<script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
  
	<!-- Script for the category-->
  	<script src="functions/category.js"></script>
	<!-- Custom CSS and JS -->
	<link rel="stylesheet" type="text/css" href="includes/styles.css">
</head>

<body>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<div class="container">

		<a class="navbar-brand" href="#">APP Logo</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  	<li class="nav-item"><a class="nav-link" href="../../index.php">Home</a></li>
			  	<li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
			  	<li class="nav-item"><a class="nav-link" href="#">Articles</a></li>
			  	<li class="nav-item"><a class="nav-link" href="#">Events</a></li>
			  	<li class="nav-item dropdown">
				    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Exercises</a>
				    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Video Exercises</a>
						<a class="dropdown-item" href="#">Sound Exercises</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
				    </div>
			  	</li> 		
			</ul>
		  	<div class="navbar-right">
		  		<ul class="navbar-nav mr-auto">
			  		<li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
			  		<li class="nav-item"><a class="nav-link" href="#">Support</a></li>
					<li class="nav-item"><a class="btn btn-outline-warning" href="functions/logout.html">Log Out</a></li>
				</ul>
			</div>

	</div>
	</nav>

	<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
	  <div class="container">
	    <h1 class="display-4">Create a New Content</h1>
	  </div>
	</div>

	<!--Main Content Sector (2 columns) -->
	<section class="main-content">
		<div class="container">
		  <div class="row">

		  	<!--Content Sector (Main) -->
		    <div class="the-content col-md-8">
		    	<form method="post" id="newContentForm" name="newContentForm" action="proc_newcategory.php">
		    	  <div class="form-group col-xs-6 col-md-4">
		    	    <label for="content-category">Select or Create Content Category</label>

							<!--this will get all the resource list-->
							<input list="resourceList" required = "true" oninput="onInput()" name="resourceListId" id="resourceListId">
							<datalist id="resourceList" name ="resourceList">
								<?php Content::getContents()?>
							</datalist>

					   </div>
						 
							<div class="form-group col-xs-6 col-md-4">
							<label for="content-title">Select or Create Content Title</label>
							<input type="text" class="form-control" placeholder="Enter content title" name = "contentTitle" id="contentTitle">
							</div>
							
								<div class="form-group col-lg-12">
							<label for="content-description">Content Description</label>
							<textarea class="form-control" id="content-description" name="content-description" placeholder="Category Description" rows="5" maxlength="255" required></textarea>
								</div>
							<div class="form-group col-lg-12">

								<!-- CKEditor area -->
								<label for="content-area">Content Text Area</label>
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
								<a href="index.php" type="button" class="btn btn-danger">Cancel</a>
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
	      </div>
	      <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
	      	<img src="includes/imgs/nbcc-logo.png" width="20%">
	      </div>
	    </div>
	  
	  </div>
	</footer>

</body>
</html>