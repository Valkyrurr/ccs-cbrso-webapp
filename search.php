<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CCS-CbRSO</title>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/css.css" rel="stylesheet">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.1/css/theme.default.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/js.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.1/js/jquery.tablesorter.js"></script>
<script>
$(document).ready(function() 
	    { 
	        $("#sortthis").tablesorter(); 
	    } 
	); 
</script>
</head>
<body>
<?php include("nav-sidebar.php"); ?>
<div class="container-fluid col-md-10 col-md-offset-2">
<?php
require ("sessions.php");
require ("database/database.php");

$categories = array("theme" => 1, "area" => 2, "title" => 3, "teacher" => 4, "student" => 5);

if (isset ( $_POST ['submit'] )) {
	$keyword = $_POST ['keyword'];
	$category = $_POST['category'];
	
	$dbh = new Database ();
	$defaultsqlHead = "SELECT themes.`theme` AS theme, areas.`area` AS area, titles.`title` AS title, CONCAT(teachers.`first_name`, ' ', teachers.`middle_name`, ' ', teachers.`last_name`) AS teacher, GROUP_CONCAT(CONCAT(students.`first_name`, IF(students.middle_name IS NULL, '', CONCAT(' ', students.middle_name)), ' ', students.`last_name`, IF(students.ext IS NULL, '', CONCAT(' ', students.ext)))) AS student
		FROM root
		LEFT JOIN themes ON themes.id=root.theme_id
		LEFT JOIN areas ON areas.id=root.area_id
		INNER JOIN titles ON titles.id=root.title_id
		INNER JOIN teachers ON teachers.id=root.teacher_id
		INNER JOIN students ON students.id=root.student_id ";
	$defaultsqlFoot = " GROUP BY theme, area, title, teacher;";
	
	foreach($categories as $key => $value){
		if($category == $value){
			if($value == 4 OR $value == 5){
				$sql = "WHERE MATCH(".$key."s.first_name, ".$key."s.middle_name, ".$key."s.last_name) AGAINST(:keyword IN BOOLEAN MODE)";	
			} else {
				$sql = "WHERE MATCH(".$key."s.".$key.") AGAINST(:keyword IN BOOLEAN MODE)";
			}
		}
	}
	
	$stmt = $dbh->prepare($defaultsqlHead . $sql . $defaultsqlFoot);
	$stmt->execute(array(":keyword" => $keyword . "*"));
	$rows = $stmt->fetchAll();
	echo "Found " . $stmt->rowCount() . " results.";
	echo "<table id='sortthis' class='tablesorter'><thead><tr><th>Theme</th><th>Area</th><th>Title</th><th>Teacher</th><th>Student</th></tr></thead>";
	echo "<tbody>";
	foreach ($rows as $row){		
		echo "<tr>";
		echo "<td>" . $row['theme'] . "</td><td>" . $row['area'] . "</td><td>" . $row['title'] . "</td><td>" . $row['teacher'] . "</td><td>" . $row['student'] . "</td>";
		echo "</tr>";
	}
	echo "</tbody></table>";
}
?>
</div>
</body>
</html>