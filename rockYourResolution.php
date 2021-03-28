<?php
session_start();
include('functions/connect.php');
include('functions/staff.php');
include('functions/Content.php');
include('functions/Progress.php');
//include('functions/Calendar.php'); put in main content->calendar
if ($_SESSION["active"] == 0) {
	$msg = "Not an Active User";
	header("location:login.php?loginError=$msg");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Rock Your Resolution</title>

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

	<!-- Todo list CSS -->
	<link rel="stylesheet" type="text/css" href="includes/todolist.css">
    
</head>

<body>
	<!-- Navigation -->
	<?php include('functions/header.php'); ?>

	<!-- Article Masterhead -->
	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1 class="display-4">Rock Your Resolution</h1>
    </div>
  </div>
  

  <section class="main-content">
		<div class="container">
      <div id="myTodoList" class="header">
        <h2>My Resolution List</h2>
      </div>
      <?php progress::getResolution() ?>

	
		<div class="card">
			<div class="card-body">
			<h3>Next Events</h3>
			<?php
			Content::getNextEvents(3);
			?>

			</div>
		</div>	    
    </div>
    <script>
		// Create a "close" button and append it to each list item
		//var myNodelist = document.getElementsByClassName("list");
		//var i;
		//for (i = 0; i < myNodelist.length; i++) {
		//var span = document.createElement("SPAN");
		//var txt = document.createTextNode("\u00D7");
		//span.className = "close";
		//span.appendChild(txt);
		//myNodelist[i].appendChild(span);
		//}

		// Click on a close button to hide the current list item
	//	var close = document.getElementsByClassName("close");
		//var i;
		//for (i = 0; i < close.length; i++) {
		//close[i].onclick = function() {
			
		//	var div = this.parentElement;
		//	div.style.display = "none";
		//}
		//}
	</script>
  </section>
			  
  <!-- Footer -->
  <?php include('functions/footer.php'); ?>
</body>

</html>