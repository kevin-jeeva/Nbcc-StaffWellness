function ReadArticle(content_id) {
	window.location.replace("proc_insert_progress.php?content_id=" + content_id);
	console.log(content_id);
}
function ReadEvents(event_id) {
	console.log(event_id);
	window.location.replace("proc_prog_events.php?content_id=" + event_id);
	console.log(content_id);
}
function HomeContentClicked(content_id) {
	console.log(content_id);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			//console.log(this.responseText);
		}
	};
	xmlhttp.open(
		"GET",
		"proc_insert_prog_home.php?content_id=" + content_id,
		true
	);
	xmlhttp.send();
}
