<?php
include(__DIR__ . DIRECTORY_SEPARATOR . "sessions.php");
echo __DIR__ . DIRECTORY_SEPARATOR . "sessions.php<br>";
echo __FILE__;
echo "<br>" . dirname(__FILE__);
$include_files = get_included_files();
foreach($include_files as $includes){
	echo $includes , "<BR>";
}

echo get_current_user();
?>