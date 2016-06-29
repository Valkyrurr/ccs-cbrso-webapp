<?php
	// TODO: fine-tune advanced.php, replace category field with ccs and thematic area fields
	// TODO: include +year, +teacher, -program fields to sql query
?>
<?php
require_once("../includes/sessions.php");
require_once("../includes/database/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php $title = ucwords(basename($_SERVER['SCRIPT_NAME'], ".php")); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/ccs-cbrso-webapp/includes/html/header.php"); ?>
<body>
	<?php include("../includes/navbar.php"); ?>
	<div class="container-fluid col-md-offset-2">
		<?php if(isset($_GET['submit'])): ?>
		<?php
			$categories = array("theme" => 1, "area" => 2, "title" => 3, "teacher" => 4, "student" => 5);
			$category_headers = array("Thematic Area", "CCS Area", "Research Topic", "Adviser", "Members");

			$q = trim($_GET['q']);
		    $r = trim($_GET['r']);
			$category = $_GET['_category'];

			$qs = explode(" ", $q);
		    $rs = explode(" ", $r);
			foreach ($qs as $key => $value) {
				$qs[$key] = "+" . $value . "*";
			}
		    foreach ($rs as $key => $value) {
		        $rs[$key] = "-" . $value . "*";
		    }
			$q = implode(" ", $qs);
		    $r = implode(" ", $rs);

			$dbh = Database::getInstance();
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
						$sql = "WHERE MATCH(".$key."s.first_name, ".$key."s.middle_name, ".$key."s.last_name) AGAINST(:q :r IN BOOLEAN MODE)";
					} else {
						$sql = "WHERE MATCH(".$key."s.".$key.") AGAINST(:q :r IN BOOLEAN MODE)";
					}
				}
			}

			$stmt = $dbh->prepare($defaultsqlHead . $sql . $defaultsqlFoot);
			$stmt->execute(array(":q" => $q, ":r" => $r));
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
				foreach($students as $student => $name){
					$name = explode(" ", $name);
					foreach($name as $key => $value){
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
		?>
		<form id="pagination" class="pager" style="text-align: right;">
			<img src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.1/css/images/first.png" class="first" />
			<img src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.1/css/images/prev.png" class="prev" />
			<input type="text" class="pagedisplay" disabled>
			<img src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.1/css/images/next.png" class="next" />
			<img src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.1/css/images/last.png" class="last" />
			<select class="pagesize">
				<option value="10" selected>10</option>
				<option value="20">20</option>
				<option value="30">30</option>
				<option value="40">40</option>
				<option value="50">50</option>
			</select>
		</form>

		<?php else: ?>
		<h2 class="page-header">Advanced Search</h2>
		<div class="col-md-8 col-md-offset-2">
			<form action="advanced.php" method="get" class="form-horizontal">
				<div class="form-group">
					<label class="col-md-3 control-label">Any of these words</label>
					<div class="col-md-7"><input class="form-control" type="text" name="q" required></div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">None of these words</label>
					<div class="col-md-7"><input class="form-control" type="text" name="r" required></div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Year</label>
					<div class="col-md-7">
						<select class="form-control">
							<option value=0 selected>any Year</option>
							<?php
								$i = date("Y");
								$j = 2012;
								while($i >= $j){
									echo "<option value=$i>$i</option>";
									$i--;
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Adviser</label>
					<div class="col-md-7">
						<select class="form-control">
							<option value=0 selected>any Adviser</option>
							<?php
								$dbh = Database::getInstance();
								$stmt = $dbh->prepare("SELECT * FROM teachers ORDER BY last_name;");
								$stmt->execute();
								$rows = $stmt->fetchAll();
								foreach($rows as $row){
									echo "<option value=" . $row['id'] . ">" . $row['last_name'] . ", " . $row['first_name'] . "</option>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Program</label>
					<div class="col-md-7">
						<select class="form-control">
							<option selected>any Program</option>
							<option>Research and Publication</option>
							<option>Social Outreach</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Category</label>
					<div class="col-md-7">
						<div class="radio">
							<label><input value="1" name="_category" type="radio" required>Thematic Area</label>
							<label><input value="2" name="_category" type="radio">CCS Area</label>
							<label><input value="3" name="_category" type="radio">Thesis Title</label>
							<label><input value="4" name="_category" type="radio">Adviser Name</label>
							<label><input value="5" name="_category" type="radio">Student Name</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-7 col-md-offset-3">
						<input class="btn btn-md btn-primary" name="submit" type="submit" value="Search" />
						<input class="btn btn-md" name="reset" type="reset" value="Reset" />
					</div>
				</div>
			</form>
		</div>
		<?php endif; ?>
	</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/ccs-cbrso-webapp/includes/html/footer.php"); ?>
<script type="text/javascript">
$(function() {
    $("select").selectmenu();
});
$(function() {
	$("input[type='reset']").click(function () {
		$("form").[0].reset();
	});
});
</script>
<script>
$(document).ready(function() {
	$("#sortthis").tablesorter({widthFixed: true}).tablesorterPager({container: $(".pager")});
});
</script>
</body>
</html>
