function onInput() {
	var val = document.getElementById("resourceListId").value.trim();
	document.getElementById("resourceListId").value = val.toUpperCase();
	var opts = document.getElementById("resourceList").childNodes;
	for (var i = 0; i < opts.length; i++) {
		if (opts[i].value === val) {
			document.getElementById("content-description").disabled = true;
			break;
		} else {
			document.getElementById("content-description").disabled = false;
		}
	}
}

var count = 0;
var msg = "";

function ContentCheck() {
	console.log("here");
	count = 0;
	msg = "";
	for (var i = 1; i <= 3; i++) {
		switch (i) {
			case 3:
				trimFun("contentTitle");
				break;
			case 2:
				if (!document.getElementById("content-description").disabled == true) {
					trimFun("content-description");
				}
				break;
			// case 1:
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
			// 		count = 0;
			// 	}
			// 	break;
		}
	}

	if (count > 0) {
		console.log(count);
		alert(msg);
		count = 0;
		msg = "";
		return false;
	} else {
		return true;
	}
}

function trimFun(id) {
	var Value = document.getElementById(id).value;
	Value = Value.trim();
	if (Value == "") {
		msg += id + " required " + "\n";
		count += 1;
	}
}
