<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
		<input type="file" id="your-files" multiple>
	<script>
	var control = document.getElementById("your-files");
	control.addEventListener("change", function(event) {

	    // When the control has changed, there are new files

	    var i = 0,
	        files = control.files,
	        len = files.length;

	    for (; i < len; i++) {
	        console.log("Filename: " + files[i].name);
	        console.log("Type: " + files[i].type);
	        console.log("Size: " + files[i].size + " bytes");
	    }

	}, false);
	</script></code>

</body>
</html>