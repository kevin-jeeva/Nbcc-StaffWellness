var count = 0;
var msg = "\r";

function ContentCheck() {
	console.log("here");
	count = 0;
	//msg;
	for (var i = 1; i <= 3; i++) {
		switch (i) {
			case 1:
				trimFun("contentTitle", "Content Title");
				break;
			case 2:
				if (!document.getElementById("content-description").disabled == true) {
					trimFun("content-description", "Content Description");
				}
				break;
			case 3:
				console.log("category field");
				trimFun("resourceListId", "Category field");
				break;
			// case 4:
			// 	console.log("case1;");
			// 	var val = document.getElementById("content-area").value;
			// 	val = jQuery(val).text();
			// 	console.log(val);
			// 	val = val.trim();
			// 	console.log("insiderss");
			// 	if (val == "") {
			// 		msg += "Please fill the content area " + "\n";
			// 		count += 1;
			// 	} else {
			// 		msg = "";
			// 		console.log(count);
			// 		count -= 1;
			// 	}
			// 	break;
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
