<?php
include_once('functions/staff.php');
include_once('functions/Content.php');

$adminDropdown = "";

//shows admin dropdown if admin
if(staff::GetStaffAdminNumber($_SESSION["staff_id"]) == 1 || staff::GetStaffAdminNumber($_SESSION["staff_id"]) == 2 )
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
		<a class=\"dropdown-item\" href=\"active_users.php\">User Permissions</a>
		<a class=\"dropdown-item\" href=\"user_progress.php\">User Progress</a>
		<div class=\"dropdown-divider\"></div>
		<a class=\"dropdown-item text-danger\" href=\"functions/logout.php\">Log out</a>
		</li>";
}
$notifications = "<div class=\"notifications-place row\">
<div class=\"notifications row\" >							
	<div class=\"nav-item\">									
	<button type=\"button\" class=\"btn btn-nblue li\" id=\"notifs\" data-toggle=\"popover\" data-placement=\"bottom\" title=\"New contents\" data-trigger=\"focus\" data-param1=\"Parameter1\" onclick=\"resetNotification()\">						
	<li class=\"bi bi-bell-fill\"></li></button>	
	<div class=\"notify-container\" id =\"notify-container\">
		<span class=\"notify-bubble\" id =\"bubble-noti\">" . Content::setNotificationBubble() . "</span>
	</div>
	</div>					
</div>
</div>
<script>
	$(document).ready(function(){
		var po_options = {
		html: true,
		content: function() {
			var p1 = $(this).data(\"param1\");
			return `".Content::bellNotifications()." <a href=\"notifications.php\" class=\"btn btn-block btn-outline-nblue\")\">View More</a>`;
		}
	};

	$('.li').popover(po_options);

	});
	$(function() {
		$('.notifications').click(function() {
			$('.notify-bubble').hide();
			return " . Content::resetBubble() . ";
		});
	});
</script>
";

echo "<!-- Navigation -->
  <script src=\"functions/notifications.js\"></script>
	<nav class=\"navbar navbar-expand-lg navbar bg-white sticky-top shadow-sm\">
	<div class=\"container\">
		<a class=\"navbar-brand\" href=\"index.php\"><img class=\"brand\" src=\"includes/imgs/nbcc-hor.png\" alt=\"Wellbeing App\"></a>
		<div class=\"d-block d-sm-none ml-auto\">
			$notifications		
		</div>
		&nbsp &nbsp
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
					<a class=\"dropdown-item\" href=\"https://choosebright.com/nbcc/\" target=\"_blank\">Bright <i class=\"bi bi-box-arrow-in-up-right\"></i></a>
				    </div>
			  	</li> 		
			  	<li class=\"nav-item\"><a class=\"nav-link\" href=\"support.php\">Support</a></li>
			</ul>
		  	<div class=\"navbar-right\">
		  		<ul class=\"navbar-nav mr-auto markings\">
			  		<li class=\"nav-item\"><a class=\"nav-link\" href=\"aboutus.php\">About Us</a></li>
			  		<li class=\"nav-item dropdown\">
			  				<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">Your Profile</a>
			  				<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
			  				<a class=\"dropdown-item\" href=\"dashboard.php\">Dashboard</a>
							<a class=\"dropdown-item\" href=\"rockYourResolution.php\">Rock Your Resolution</a>
			  				<div class=\"dropdown-divider\"></div>
			  				<a class=\"dropdown-item\" href=\"notifications.php\">Notifications</a>
			  				<a class=\"dropdown-item\" href=\"user_profile.php\">Profile Settings</a>
			  				<div class=\"dropdown-divider\"></div>
							<a class=\"dropdown-item text-danger\" href=\"functions/logout.php\">Log out</a>
			  		</li>
					
					$adminDropdown
					
					<div class=\"d-none d-sm-block\" id=\"notifDiv\">
						$notifications
					</div>
					</div>
				</ul>
			</div>
		</div><!-- end of collapse navbar-collapse -->
	</div><!-- end of container -->
	</nav><!-- end of Navigation -->"
?>