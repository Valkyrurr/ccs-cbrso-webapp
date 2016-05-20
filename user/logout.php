<?php
	header('Location: /ccs-cbrso-webapp/user/index.php', TRUE, 302);
	require("../includes/sessions.php");
	session_unset();
	session_destroy();
?>