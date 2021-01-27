<?php
include_once('functions/staff.php');

$adminDropdown = "";

//shows admin dropdown if admin
if(staff::GetStaffAdminNumber($_SESSION["staff_id"]) == 1)
{
	$adminDropdown = "
	<li class=\"nav-item dropdown\">
		<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Admin</a>
		<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
		<a class=\"dropdown-item\" href=\"administrator.php\">Admin Panel</a>
		<div class=\"dropdown-divider\"></div>
		<a class=\"dropdown-item\" href=\"new_category.php\">Create New Category</a>
		<a class=\"dropdown-item\" href=\"new_content.php\">Create New Content</a>
		";
}






echo "<!-- Navigation -->
	<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark sticky-top\">
	<div class=\"container\">

		<a class=\"navbar-brand\" href=\"index.php\">APP Logo</a>
		<button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
		<span class=\"navbar-toggler-icon\"></span>
		</button>
		<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
			<ul class=\"navbar-nav mr-auto\">
			  	<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\">Home</a></li>
			  	<li class=\"nav-item\"><a class=\"nav-link\" href=\"about.php\">About Us</a></li>
			  	<li class=\"nav-item\"><a class=\"nav-link\" href=\"articles.php\">Articles</a></li>
			  	<li class=\"nav-item\"><a class=\"nav-link\" href=\"events.php\">Events</a></li>
			  	<li class=\"nav-item dropdown\">
				    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Exercises</a>
				    <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
					<a class=\"dropdown-item\" href=\"exercises_video.php\">Video Exercises</a>
						<a class=\"dropdown-item\" href=\"exercises_sound.php\">Sound Exercises</a>
						<div class=\"dropdown-divider\"></div>
						<a class=\"dropdown-item\" href=\"#\">Something else here</a>
				    </div>
			  	</li> 		
			</ul>
		  	<div class=\"navbar-right\">
		  		<ul class=\"navbar-nav mr-auto\">
			  		<li class=\"nav-item\"><a class=\"nav-link\" href=\"contact.php\">Contact Us</a></li>
			  		<li class=\"nav-item\"><a class=\"nav-link\" href=\"#\">Support</a></li>
					
					$adminDropdown

					<li class=\"nav-item\"><a class=\"btn btn-outline-warning\" href=\"functions/logout.php\">Log out</a></li>
				</ul>
			</div>
		</div><!-- end of collapse navbar-collapse -->
	</div><!-- end of container -->
	</nav><!-- end of Navigation -->"
?>