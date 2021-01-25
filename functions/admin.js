function CheckDelete(event) {
	$("#myModal").modal();
	console.log(event.target.href);
	document.getElementById("DeleteContent").href = event.target.href;
	return false;
}
function ResetLink() {
	document.getElementById("DeleteContent").href = "#";
}
