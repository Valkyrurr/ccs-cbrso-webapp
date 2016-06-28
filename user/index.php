<?php require_once("../includes/sessions.php"); ?>
<?php require_once("../includes/logger/logger_error_handler.php"); ?>
<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] === TRUE) header('Location: ../index.php', TRUE, 302); ?>
<!DOCTYPE html>
<html lang="en">
<?php $title = ucwords(basename($_SERVER['SCRIPT_NAME'], ".php")); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/ccs-cbrso-webapp/includes/html/header.php"); ?>
<body>
	<?php include("../includes/navbar.php"); ?>
	<div class="container-fluid col-md-offset-2">
		<div class="col-md-4 col-md-offset-4">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#login-tab" data-toggle="tab">Login</a></li>
				<li><a href="#register-tab" data-toggle="tab">Register</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane in active" id="login-tab">
					<p>Assume `Remember Me` is working.</p>
					<form action="login.php" method="post" class="tab-pane active">
						<?php
							if(isset($_COOKIE['login-err']) && $_COOKIE['login-err'] == 1):
								echo '<div class="form-group has-error">';
						?>
						<?php else: ?>
						<div class="form-group">
						<?php endif; ?>
						<input name="username" type="text" class="form-control"
								placeholder="Username" required autofocus>
						<?php if(isset($_COOKIE['login-err']) && $_COOKIE['login-err'] == 1): ?>
						<span class="help-block">Invalid Username</span>
						<?php endif; ?>
						</div>
						<?php
							if(isset($_COOKIE['login-err']) && $_COOKIE['login-err'] == 2):
								echo '<div class="form-group has-error">';
						?>
						<?php else: ?>
						<div class="form-group">
						<?php endif; ?>
						<input name="password" type="password" class="form-control"
								placeholder="Password" required>
						<?php if(isset($_COOKIE['login-err']) && $_COOKIE['login-err'] == 2): ?>
						<span class="help-block">Invalid Password</span>
						<?php endif; ?>
						</div>
						<div class="checkbox">
							<label><input type="checkbox"> Remember Me</label>
						</div>
						<input name="submit" type="submit"
							class="btn btn-md btn-primary btn-block" value="Login">

					</form>
				</div>
				<div class="tab-pane" id="register-tab">
					<form action="register.php" method="post" class="tab-pane">
						<div class="form-group">
							<input name="username" type="text" class="form-control"
								placeholder="Username" required>
						</div>
						<div class="form-group">
							<input id="validate-password" name="password" type="password"
								class="form-control" placeholder="Password" required>
						</div>
						<div class="form-group">
							<input id="validate-password-ref" name="verified-password"
								type="password" class="form-control"
								placeholder="Confirm Password" required>
						</div>
						<div class="form-group">
							<input name="email" type="email" type="password"
								class="form-control" placeholder="Email Address" required>
						</div>
						<br> <input name="submit" type="submit"
							class="btn btn-md btn-primary btn-block" value="Register">
					</form>
				</div>
			</div>
		</div>
	</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/ccs-cbrso-webapp/includes/html/footer.php"); ?>
</body>
</html>
