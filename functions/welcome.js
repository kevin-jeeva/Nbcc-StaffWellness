var count = 0;
var msg = "";

function WelcomeCheck() {
	for (var i = 0; i < 3; i++) {
		switch (i) {
			case 0:
				trimFun("edit_welcomeTitle", "Welcome Title");
				break;
			case 1:
				trimFun("edit_welcome-description", "Welcome content");
				break;
			case 2:
				if (document.getElementById("edit_welcome_image").files.length == 0) {
					count += 1;
					msg += "Welcom Image" + " required " + "\n";
				}
				break;
		}
	}
	if (count > 0) {
		$("#myModal").modal();
		document.getElementById("alert_message").textContent = msg;
		count = 0;
		msg = "";
		return false;
	} else {
		return true;
	}
}
function EditWelcomeCheck() {
	for (var i = 0; i < 3; i++) {
		switch (i) {
			case 0:
				trimFun("edit_welcomeTitle", "Welcome Title");
				break;
			case 1:
				trimFun("edit_welcome-description", "Welcome content");
				break;
		}
	}
	if (count > 0) {
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

function editImageChange() {
	var fullPath = document.getElementById("edit_welcome_image").value;
	if (fullPath) {
		var startIndex =
			fullPath.indexOf("\\") >= 0
				? fullPath.lastIndexOf("\\")
				: fullPath.lastIndexOf("/");
		var filename = fullPath.substring(startIndex);
		if (filename.indexOf("\\") === 0 || filename.indexOf("/") === 0) {
			filename = filename.substring(1);
		}
		document.getElementById("image_name").textContent = filename;
	}
}
