<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CCS-CbRSO</title>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="/ccs-cbrso-webapp/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="/ccs-cbrso-webapp/assets/css/css.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.1/css/theme.default.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="/ccs-cbrso-webapp/assets/js/bootstrap.min.js"></script>
<script src="/ccs-cbrso-webapp/assets/js/js.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.1/js/jquery.tablesorter.js"></script>
<script>
$(document).ready(function() 
	    { 
	        $("#sortthis").tablesorter({widthFixed: true});
		} 
	); 
</script>
</head>
<body>
<?php include("../includes/navbar.php"); ?>
<div class="container-fluid col-md-10 col-md-offset-2">
<?php
require ("../includes/sessions.php");
require ("../includes/database/database.php");

$categories = array("theme" => 1, "area" => 2, "title" => 3, "teacher" => 4, "student" => 5);
$category_headers = array("Thematic Area", "CCS Area", "Research Topic", "Adviser", "Members");

if (isset ($_GET)) {
	$keyword = trim($_GET ['keyword']);
	$category = $_GET['category'];
	
	$keywords = explode(" ", $keyword);
	foreach($keywords as $key => $value){
		$keywords[$key] = "+" . $value . "*";
	}
	$keyword = implode(" ", $keywords);
	
	$dbh = new Database ();
	$defaultsqlHead = "SELECT themes.`theme` AS theme, areas.`area` AS area, titles.`title` AS title, CONCAT(teachers.`first_name`, ' ', teachers.`middle_name`, ' ', teachers.`last_name`) AS teacher, GROUP_CONCAT(CONCAT(students.`first_name`, IF(students.middle_name IS NULL, '', CONCAT(' ', students.middle_name)), ' ', students.`last_name`, IF(students.ext IS NULL, '', CONCAT(', ', students.ext))) SEPARATOR ';') AS student
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
	$stmt->execute(array(":keyword" => $keyword));
	$rows = $stmt->fetchAll();
	echo "Found " . $stmt->rowCount() . " results.";
	echo "<table id='sortthis' class='tablesorter'><thead><tr><th>$category_headers[0]</th><th>$category_headers[1]</th><th>$category_headers[2]</th><th>$category_headers[3]</th><th>$category_headers[4]</th></tr></thead>";
	echo "<tbody>";
	foreach ($rows as $row){
		$adviser = explode(" ", $row['teacher']);
		foreach($adviser as $key => $value){
			if(strlen($value) == 1){
				$adviser[$key] = $value . ".";
			}
		}
		$adviser = implode(" ", $adviser);
		$students = explode(";", $row['student']);
		foreach($students as $student => $name){	//student names
			$name = explode(" ", $name);	// student: Eriko Florenze S Torralba
			foreach($name as $key => $value){	// 0 => Eriko, 1 => Florenze, 2 => S, 3 => Torralba
				if(strlen($value) == 1){
					$name[$key] = $value . ".";
				}
			}
			$name = implode(" ", $name);
			$students[$student] = $name;
		}
		echo "<tr>";
		echo "<td>" . $row['theme'] . "</td><td>" . $row['area'] . "</td><td>" . $row['title'] . "</td><td>" . $adviser . "</td>";
		echo "<td><table id='sortthat'><thead><tr><th></th></tr></thead><tbody>";
		foreach($students as $student){
			echo "<tr><td>" . $student . "</td></tr>"; 
		}
		echo "</tbody></table></td>";
		echo "</tr>";
	}
	echo "</tbody></table>";
	echo "Found " . $stmt->rowCount() . " results.";
}
?>
</div>
</body>
</html>