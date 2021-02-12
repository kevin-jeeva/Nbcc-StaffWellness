<?php
include_once('functions/staff.php');
include_once('functions/Content.php');

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
		<a class=\"dropdown-item\" href=\"new_welcome.php\">Create Welcome Content</a>
		<a class=\"dropdown-item\" href=\"new_video.php\">Create New Video</a>
		<a class=\"dropdown-item\" href=\"new_sound.php\">Create New Audio</a>
		<a class=\"dropdown-item\" href=\"active_users.php\">Active/Deactive User</a>
		<div class=\"dropdown-divider\"></div>
		<a class=\"dropdown-item text-danger\" href=\"functions/logout.php\">Log out</a>
		</li>";
}

echo "<!-- Navigation -->
	<nav class=\"navbar navbar-expand-lg navbar-light bg-light sticky-top\">
	<div class=\"container\">

		<a class=\"navbar-brand\" href=\"index.php\">APP Logo</a>
		<button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
		<span class=\"navbar-toggler-icon\"></span>
		</button>
		<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
			<ul class=\"navbar-nav mr-auto\">
			  	<li class=\"nav-item\"><a class=\"nav-link\" href=\"index.php\">Home</a></li>
				
			  	<li class=\"nav-item\"><a class=\"nav-link\" href=\"articles.php\">Articles</a></li>
			  	<li class=\"nav-item\"><a class=\"nav-link\" href=\"events.php\">Events</a></li>
			  	<li class=\"nav-item dropdown\">
				    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Exercises</a>
				    <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
					<a class=\"dropdown-item\" href=\"exercises_video.php\">Video Exercises</a>
						<a class=\"dropdown-item\" href=\"sound_exercise.php\">Sound Exercises</a>
				    </div>
			  	</li> 		
			  	<li class=\"nav-item\"><a class=\"nav-link\" href=\"support.php\">Support</a></li>
			</ul>
		  	<div class=\"navbar-right\">
		  		<ul class=\"navbar-nav mr-auto markings\">
			  		<li class=\"nav-item\"><a class=\"nav-link\" href=\"contact.php\">Contact Us</a></li>
			  		<li class=\"nav-item dropdown\">
			  				<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Your Profile</a>
			  				<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
			  				<a class=\"dropdown-item\" href=\"dashboard.php\">Dashboard</a>
			  				<div class=\"dropdown-divider\"></div>
			  				<a class=\"dropdown-item\" href=\"notifications.php\">Notifications</a>
			  				<a class=\"dropdown-item\" href=\"#\">Profile Settings</a>
			  				<a class=\"dropdown-item\" href=\"password_edit.php\">Change Your Password</a>
			  				<div class=\"dropdown-divider\"></div>
							<a class=\"dropdown-item text-danger\" href=\"functions/logout.php\">Log out</a>
			  		</li>
					
					$adminDropdown
					<div class=\"notifications\">							
						<li class=\"nav-item\">
									
						<button type=\"button\" class=\"btn btn-primary li\"  data-toggle=\"popover\" data-placement=\"bottom\" title=\"New contents\" data-trigger=\"focus\" data-param1=\"Parameter1\">
						
						<i class=\"bi bi-bell-fill\"></i></button>	
						<div class=\"notify-container\">
							<span class=\"notify-bubble\">" . Content::setNotificationBubble() . "</span>
						</div>
						</li>					
					</div>
					<script>
					$(document).ready(function(){
					var po_options = {
					html: true,
					content: function() {
						var p1 = $(this).data(\"param1\");
						return `".Content::bellNotifications()." <a href=\"notifications.php\" class=\"btn btn-block btn-outline-dark\")\">View More</a>`;
					}
					};

					$('.li').popover(po_options);

					});
					$(function() {
						$('.notifications').click(function() {
							$('.notify-bubble').hide();
						  });
					  });
					</script>

					</div>
				</ul>
			</div>
		</div><!-- end of collapse navbar-collapse -->
	</div><!-- end of container -->
	</nav><!-- end of Navigation -->"
?>