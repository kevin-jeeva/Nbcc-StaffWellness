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
