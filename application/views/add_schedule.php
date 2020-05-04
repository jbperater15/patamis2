<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Schedule</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>/assets/bootstrap-4.4.1-dist\css\bootstrap.min.css">
</head>
<body>
	<div class="container">
		  	<div class="form-group">
				<label for="eval-title">Evaluation Title:</label>
				<input type="text" class="form-control" id="eval-title">
			</div>
			<div class="form-group">
				<label for="date">Date:</label>
				<input type="date" class="form-control" id="date">
			</div>
			<div class="form-group">
				<label for="time-start">Time Start:</label>
				<input type="time" class="form-control" id="time-start">
			</div>
			<div class="form-group">
				<label for="time-end"><?php echo base_url() ?></label>
				<input type="time" class="form-control" id="time-end">
			</div>
	</div>
</body>
</html>