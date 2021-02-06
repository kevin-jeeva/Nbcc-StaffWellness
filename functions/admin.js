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
function RedirectEditContent(
	resource_name,
	content_title,
	content_description,
	content_text,
	content_id
) {
	sessionStorage.setItem("content_id", content_id);
	sessionStorage.setItem("resource_name", resource_name);
	sessionStorage.setItem("content_title", content_title);
	sessionStorage.setItem("description", content_description);
	sessionStorage.setItem("content_text", content_text);

	window.location.replace(
		"http://localhost/nbcc_staffwellness/edit_content.php"
	);
}
function RedirectEditWelcome(id, title, text, image) {
	sessionStorage.setItem("welcome_id", id);
	sessionStorage.setItem("welcome_title", title);
	sessionStorage.setItem("welcome_text", text);
	sessionStorage.setItem("welcome_image", image);

	window.location.replace(
		"http://localhost/nbcc_staffwellness/edit_welcome.php"
	);
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
	} else if (
		window.location.href ===
		"http://localhost/nbcc_staffwellness/edit_content.php"
	) {
		resource_name = sessionStorage.getItem("resource_name");
		content_title = sessionStorage.getItem("content_title");
		content_description = sessionStorage.getItem("description");
		content_text = sessionStorage.getItem("content_text");
		content_id = sessionStorage.getItem("content_id");

		setTheEditContentDropDown(resource_name);
		document.getElementById("editContentTitle").value = content_title;
		document.getElementById(
			"editContent-description"
		).value = content_description;
		document.getElementById("editContent-area").value = content_text;
		document.getElementById("content_id").value = content_id;
	} else if (
		window.location.href ===
		"http://localhost/nbcc_staffwellness/edit_welcome.php"
	) {
		title = sessionStorage.getItem("welcome_title");
		text = sessionStorage.getItem("welcome_text");
		image = sessionStorage.getItem("welcome_image");
		id = parseInt(sessionStorage.getItem("welcome_id"));

		document.getElementById("edit_welcomeTitle").value = title;
		document.getElementById("edit_welcome-description").value = text;
		document.getElementById("edit_welcome_id").value = id;
		document.getElementById("image_name").textContent = image;

		console.log(document.getElementById("image_name").value);
	} else {
		sessionStorage.removeItem("resource_id");
		sessionStorage.removeItem("resource_name");

		sessionStorage.removeItem("content_id");
		sessionStorage.removeItem("resource_name");
		sessionStorage.removeItem("content_title");
		sessionStorage.removeItem("description");
		sessionStorage.removeItem("content_text");

		sessionStorage.removeItem("welcome_id");
		sessionStorage.removeItem("welcome_title");
		sessionStorage.removeItem("welcome_text");
		sessionStorage.removeItem("welcome_image");
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
function setTheEditContentDropDown(resource_name) {
	var x = document.getElementById("edit_contents");
	var count = document
		.getElementById("edit_contents")
		.getElementsByTagName("option").length;
	for (let i = 0; i < count; i++) {
		let temp = document
			.getElementById("edit_contents")
			.getElementsByTagName("option")[i].value;
		if (temp === resource_name) {
			document.getElementById("edit_contents").getElementsByTagName("option")[
				i
			].selected = "selected";
		}
	}
}

function EditContentCheck() {
	//	console.log("here");
	count = 0;
	//msg;
	for (var i = 1; i <= 2; i++) {
		switch (i) {
			case 1:
				trimFun("editContentTitle", "Content Title");
				break;
			case 2:
				if (
					!document.getElementById("editContent-description").disabled == true
				) {
					trimFun("editContent-description", "Content Description");
				}
				break;
		}
	}

	if (count > 0) {
		console.log(count);
		$("#myModal").modal();
		document.getElementById("alert_message").textContent = msg;
		count = 0;
		msg = "";
		return false;
	} else {
		return true;
	}
}

function trimFun(id, message) {
	var Value = document.getElementById(id).value;
	Value = Value.trim();
	if (Value == "") {
		msg += message + " required " + "\n";
		count += 1;
	}
}
