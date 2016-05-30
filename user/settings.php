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
		<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] === TRUE): ?>
		<?php 
			$dbh = Database::getInstance();
			$stmt = $dbh->prepare("SELECT * FROM users WHERE username=:username;");
			$stmt->execute(array(":username" => $_SESSION['username']));
			$rows =$stmt->fetchAll();
			foreach($rows as $row);
		?>
		<?php 
			if(isset($_POST['submit'])){				
				if(isset($_POST['verified-password']) && $_POST['verified-password'] !== ""){
					if(password_verify($_POST['current-password'], $row['password'])){
						$password = password_hash($_POST['verified-password'], PASSWORD_BCRYPT);
						$sql = "UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email, password=:password WHERE username=:username;";
					} else {
						setcookie("settings-err", 1, time() + 1);
						header('Location: settings.php', TRUE, 302);
					}
				} else {
					$sql = "UPDATE users SET first_name=:first_name, last_name=:last_name, email=:email WHERE username=:username;";
				}
				$first_name = trim($_POST['first_name']);
				$last_name = trim($_POST['last_name']);
				$email = trim($_POST['email']);
				$stmt = $dbh->prepare($sql);
				if(isset($password)){
					$stmt->execute(array(":first_name" => $first_name, ":last_name" => $last_name, ":email" => $email, ":password" => $password, ":username" => $_SESSION['username']));
				} else {
					$stmt->execute(array(":first_name" => $first_name, ":last_name" => $last_name, ":email" => $email, ":username" => $_SESSION['username']));
				}
				setcookie("settings-err", 0, time() + 1);
				header('Location: settings.php', TRUE, 302);
			}
		?>
		<h2 class="page-header">User Settings</h2>
		<?php if(isset($_COOKIE['settings-err']) && $_COOKIE['settings-err'] == 0): ?>
		<span class="help-block success">User Settings Saved!</span>
		<?php elseif(isset($_COOKIE['settings-err']) && $_COOKIE['settings-err'] == 1): ?>
		<span class="help-block fail">Input password is Invalid! Changes to settings is not possible.</span>
		<?php endif; ?>
		<div class="col-md-8 col-md-offset-2">
		<form action="" method="post" class="form-horizontal">
			<h4 class="sub-header">User</h4>
			<div class="form-group">
				<label class="col-md-3 control-label">Username</label>
				<div class="col-md-7"><p class="form-control-static"><?= $_SESSION['username']; ?></p></div>
			</div>
			<div class="form-group required">
				<label class="col-md-3 control-label">First Name</label>
				<div class="col-md-7"><input class="form-control" type="text" name="first_name" value="<?= $row['first_name']; ?>" required></div>
			</div>
			<div class="form-group required">
				<label class="col-md-3 control-label">Last Name</label>
				<div class="col-md-7"><input class="form-control" type="text" name="last_name" value="<?= $row['last_name']; ?>" required></div>
			</div>
			<div class="form-group required">
				<label class="col-md-3 control-label">E-mail Address</label>
				<div class="col-md-7"><input class="form-control" type="text" name="email" value="<?= $row['email']; ?>" required></div>
			</div>
			<h4 class="sub-header">Change Your Password</h4>
			<div class="form-group">
				<label class="col-md-3 control-label">Current Password</label>
				<div class="col-md-7"><input id="password" name="current-password" type="password" class="form-control"></div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">New Password</label>
				<div class="col-md-7"><input id="validate-password" name="password" type="password" class="form-control"></div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Confirm Password</label>
				<div class="col-md-7"><input id="validate-password-ref" name="verified-password" type="password" class="form-control"></div>
			</div>
			<div class="form-group">
				<div class="col-md-7 col-md-offset-3">
					<input class="btn btn-md btn-primary" type="submit" name="submit" value="Proceed">
				</div>
			</div>
		</form>
		</div>
		<?php else: ?>
		<p>Restricted Access!</p>
		<?php endif; ?>
	</div>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="/ccs-cbrso-webapp/assets/js/bootstrap.min.js"></script>
	<script src="/ccs-cbrso-webapp/assets/js/js.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.1/js/jquery.tablesorter.js"></script>
</body>
</html>