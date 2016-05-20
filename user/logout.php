<?php
	header('Location: /ccs-cbrso-webapp/user/index.php', TRUE, 302);
	require("../sessions.php");
	session_unset();
	session_destroy();
?>