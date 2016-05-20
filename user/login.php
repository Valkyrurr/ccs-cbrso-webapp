<?php
require ("../database/database.php");
require ("../sessions.php");
if(isset($_SESSION['logged']) && $_SESSION['logged'] === TRUE) header('Location: ../index.php', TRUE, 302);

if (isset ( $_POST ['submit'] )) {
	unset($_POST['submit']);
	define('InvalidUsername', 1);
	define('InvalidPassword', 2);
	
	$username = $_POST ['username'];
	$password = $_POST ['password'];
	
	$dbh = new Database ();
	$stmt = $dbh->prepare ( "SELECT * FROM `users` WHERE `username`=:username;" );
	$stmt->execute ( array (
			':username' => $username 
	) );
	$rows = $stmt->fetchAll ();
	if ($stmt->rowCount () == 1) {
		foreach ( $rows as $row )
			;
		if (password_verify ( $password, $row ['password'] )) {
			header('Location: index.php', TRUE, 302);
			$_SESSION ['logged'] = TRUE;
			$_SESSION ['username'] = $row ['username'];
			setcookie("login-err", 0, time() - 1);
			try {
				$stmt = $dbh->prepare ( "UPDATE `users` SET logged_last = NOW() WHERE username=:username;" );
				$stmt->execute ( array (
						':username' => $username 
				) );
			} catch ( PDOException $e ) {
				echo $e->getMessage ();
			}
		} else {
			setcookie("login-err", InvalidPassword, time() + 1);
			header('Location: index.php', TRUE, 302);
		}
	} else {
		setcookie("login-err", InvalidUsername, time() + 1);
		header('Location: index.php', TRUE, 302);
	}
}
?>