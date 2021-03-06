<?php
require ("../includes/database/database.php");
require ("../includes/sessions.php");
if(isset($_SESSION['logged']) && $_SESSION['logged'] === TRUE) header('Location: ../index.php', TRUE, 302);

if (isset ( $_POST ['submit'] )) {
	unset($_POST['submit']);
	$username = trim($_POST ['username']);
	$password = password_hash ( $_POST ['verified-password'], PASSWORD_BCRYPT );
	$email = trim($_POST ['email']);
	
	$dbh = Database::getInstance();
	$stmt = $dbh->prepare ( "SELECT * FROM `users` WHERE username=:username;" );
	$stmt->execute ( array (
			':username' => $username 
	) );
	if ($stmt->rowCount () == 0) {
		try {
			$stmt = $dbh->prepare ( "INSERT INTO `users` VALUES(NULL, '', '', :email, :username, :password, NOW(), '');" );
			$stmt->execute ( array (
					':email' => $email,
					':username' => $username,
					':password' => $password 
			) );
			mail ( "ccs.cbrso.smtp@gmail.com", "Registration Success!", "Hello World!\nUsername: " . $username . "\nPassword: " . $password . "\nE-mail Address: " . $email );
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		}
	} else {
		echo "Registration Failed: Username already exists!";	
	}
	header('Location: index.php', TRUE, 302);
}
?>