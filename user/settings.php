<?php require("../sessions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CCS-CbRSO</title>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/css.css" rel="stylesheet">
</head>
<body>
	<?php include("../nav-sidebar.php"); ?>
	<div class="container-fluid col-md-offset-2">
		<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] === TRUE): ?>
		<h2 class="page-header">User Settings</h2>
		<div class="col-md-8 col-md-offset-2">
		<form action="#" method="post" class="form-horizontal">
			<h4 class="sub-header">User</h4>
			<div class="form-group">
				<label class="col-md-3 control-label">Username</label>
				<div class="col-md-7"><p class="form-control-static">Administrator</p></div>
			</div>
			<div class="form-group required">
				<label class="col-md-3 control-label">First Name</label>
				<div class="col-md-7"><input class="form-control" type="text"></div>
			</div>
			<div class="form-group required">
				<label class="col-md-3 control-label">Last Name</label>
				<div class="col-md-7"><input class="form-control" type="text"></div>
			</div>
			<div class="form-group required">
				<label class="col-md-3 control-label">E-mail Address</label>
				<div class="col-md-7"><input class="form-control" type="text"></div>
			</div>
			<h4 class="sub-header">Change Your Password</h4>
			<div class="form-group">
				<label class="col-md-3 control-label">Current Password</label>
				<div class="col-md-7"><input class="form-control" type="text"></div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">New Password</label>
				<div class="col-md-7"><input class="form-control" type="text"></div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Confirm Password</label>
				<div class="col-md-7"><input class="form-control" type="text"></div>
			</div>
			<div class="form-group">
				<div class="col-md-7 col-md-offset-3"><input class="btn btn-md btn-primary" type="submit" value="Proceed"></div>
			</div>
		</form>
		</div>
		<?php else: ?>
		<p>Restricted Access!</p>
		<?php endif; ?>
	</div>
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/js.js"></script>
</body>
</html>