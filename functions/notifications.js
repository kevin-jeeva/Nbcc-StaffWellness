function resetNotification() {
	let xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
		}
	};
	xhttp.open("GET", "proc_reset_noti_bubble.php", true);
	xhttp.send();
	document.getElementById("bubble-noti").textContent = "";
	document.getElementById("notify-container").style.display = "none";
	//document.getElementById("bubble-noti").style.display = "none";
	console.log("here");
}
