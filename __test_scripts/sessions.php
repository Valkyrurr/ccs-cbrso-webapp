<?php
if(session_status() === PHP_SESSION_NONE){
	session_start();
}
$_SESSION['true'] = TRUE;
$_SESSION['false'] = FALSE;
$_SESSION['const'] = PHP_SESSION_NONE;
//var_dump($_SESSION);
//session_unset();
session_destroy();
$status = session_status();
//echo $status;
unset($_SESSION['const']);
//echo "<BR>";
//var_dump($_SESSION);
?>