function CheckDelete(event) {
	$("#myModal").modal();
	console.log(event.target.href);
	document.getElementById("DeleteContent").href = event.target.href;
	return false;
}
function ResetLink() {
	document.getElementById("DeleteContent").href = "#";
}
function RedirectEditResource($resource_name, resource_id) {
	sessionStorage.setItem("resource_id", resource_id);
	sessionStorage.setItem("resource_name", $resource_name);

	window.location.replace(
		"http://localhost/nbcc_staffwellness/edit_resource.php"
	);
	//document.location.reload();
}
window.onload = function () {
	if (
		window.location.href ===
		"http://localhost/nbcc_staffwellness/edit_resource.php"
	) {
		resource_name = sessionStorage.getItem("resource_name");
		resource_id = sessionStorage.getItem("resource_id");
		document.getElementById("resource_edit").value = resource_name;
		document.getElementById("resource_id").value = resource_id;
	} else {
		sessionStorage.removeItem("resource_id");
		sessionStorage.removeItem("resource_name");
	}
};
function TrimCategoryTitle(resource) {
	var Value = document.getElementById("resource_edit").value;
	Value = Value.trim();
	if (Value == "") {
		document.getElementById("alert_message").textContent =
			"Please fill the category title";
		$("#myModal").modal();
		return false;
	} else {
		return true;
	}
}
