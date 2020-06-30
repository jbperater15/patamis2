<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Google Drive</title>

</head>
<body>
	<table width="600" border="1" cellspacing="5" cellpadding="5">
	  <tr style="background:#CCC">
	    <th>Icon</th>
	    <th>ID</th>
	    <th>Title</th>
	    <th>Link</th>
	  </tr>
	  <?php
	  foreach($data['items'] as $row)
	  {
	  echo "<tr>";
	  echo "<td><img src='".$row['iconLink']."'></td>";
	  echo "<td>".$row['id']."</td>";
	  echo "<td>".$row['title']."</td>";
	  //echo "<td>".$row['alternateLink']."</td>";
	  echo '<td><a href="'. $row['alternateLink'] .'">Link</a></td>';
	  echo "</tr>";
	  }
	   ?>
	</table>
	<form action="<?php echo base_url() ?>gdrive/insert" method="post">
		<input type="file" id="files" name="filess" multiple>
		<input type="submit">
	</form>

	<button onclick="myFunction()">Try it</button>

	<p id="demo"></p>
	
	<script>	
	var control = document.getElementById("files");
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
	</script>
	
	
</body>
	

</html>