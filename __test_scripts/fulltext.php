<?php
include("../database/database.php");
include("../sessions.php");

$dbh = new Database();
try{
$stmt = $dbh->prepare('SELECT *, MATCH(`titles`.title) AGAINST("+agri" IN BOOLEAN MODE) FROM titles WHERE MATCH(titles.title) AGAINST("eval*" IN BOOLEAN MODE);');
$stmt->execute();
$rows = $stmt->fetchAll();
} catch(PDOException $e){
echo "count: " . $stmt->rowCount();
echo $e->getMessage();
}
echo $stmt->rowCount() . "<BR>";
foreach($rows as $row){
	echo "id: " . $row['id'] . " title: " . $row['title'] . " year: " . $row['year'] . "<br>";
}

?>