<?php
$term = $_GET['term'];
$array = array();

require("../database/database.php");
$dbh = new Database();
$stmt = $dbh->prepare("SELECT * FROM `students` WHERE first_name LIKE :term OR last_name LIKE :term;");
$stmt->execute(array(":term" => '%' . $term . '%'));
$rows = $stmt->fetchAll();

foreach($rows as $row)
	array_push($array, $row['first_name'] . " " . $row['last_name']);

echo json_encode($array);
?>