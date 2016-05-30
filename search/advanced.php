<?php 
require("../includes/sessions.php");
require("../includes/database/database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CCS-CbRSO</title>
<link rel="stylesheet" href="/ccs-cbrso-webapp/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="/ccs-cbrso-webapp/assets/css/css.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.1/css/theme.default.min.css">
</head>
<body>
	<?php include("../includes/navbar.php"); ?>
	<div class="container-fluid col-md-offset-2">
		<h2 class="page-header">Advanced Search</h2>
		<div class="col-md-8 col-md-offset-2">
			<form action="" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-md-3 control-label">Any of these words</label>
					<div class="col-md-7"><input class="form-control" type="text"></div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">None of these words</label>
					<div class="col-md-7"><input class="form-control" type="text"></div>
				</div>
				
				<div class="form-group">
					<label class="col-md-3 control-label">Year</label>
					<div class="col-md-7">
						<select class="form-control">
							<option>any Year</option>
							<option>2015</option>
							<option>2014</option>
							<option>2013</option>
							<option>2012</option>
							<option>2011</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Adviser</label>
					<div class="col-md-7">
						<select class="form-control">
							<option>any Adviser</option>
							<option>2014</option>
							<option>2013</option>
							<option>2012</option>
							<option>2011</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Program</label>
					<div class="col-md-7">
						<select class="form-control">
							<option>any Program</option>
							<option>Research and Publication</option>
							<option>Social Outreach</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Category</label>
					<div class="col-md-7">
						<div class="radio">
							<label><input name="category-adv" type="radio">Thematic Area</label>
							<label><input name="category-adv" type="radio">CCS Area</label>
							<label><input name="category-adv" type="radio">Thesis Title</label>
							<label><input name="category-adv" type="radio">Adviser Name</label>
							<label><input name="category-adv" type="radio">Student Name</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-7 col-md-offset-3">
						<input class="btn btn-md btn-primary" type="submit" value="Search">
					</div>
				</div>
			</form>
		</div>
	</div>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="/ccs-cbrso-webapp/assets/js/bootstrap.min.js"></script>
	<script src="/ccs-cbrso-webapp/assets/js/js.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.1/js/jquery.tablesorter.js"></script>
</body>
</html>