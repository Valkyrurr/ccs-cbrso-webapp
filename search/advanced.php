<?php
require_once("../includes/sessions.php");
require_once("../includes/database/database.php");
require_once("../includes/logger/logger_error_handler.php");
?>

<!DOCTYPE html>
<html lang="en">
<?php $title = ucwords(basename($_SERVER['SCRIPT_NAME'], ".php")); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/ccs-cbrso-webapp/includes/html/header.php"); ?>
<body>
	<?php include("../includes/navbar.php"); ?>
	<div class="container-fluid col-md-offset-2">
		<h2 class="page-header">Advanced Search</h2>
		<div class="col-md-8 col-md-offset-2">
			<form action="" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-md-3 control-label">Any of these words</label>
					<div class="col-md-7"><input class="form-control" type="text"></div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">None of these words</label>
					<div class="col-md-7"><input class="form-control" type="text"></div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">Year</label>
					<div class="col-md-7">
						<select class="form-control">
							<option value=0>any Year</option>
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
							<option value=0>any Adviser</option>
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
							<option>any Program</option>
							<option>Research and Publication</option>
							<option>Social Outreach</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Category</label>
					<div class="col-md-7">
						<div class="radio">
							<label><input name="category-adv" type="radio">Thematic Area</label>
							<label><input name="category-adv" type="radio">CCS Area</label>
							<label><input name="category-adv" type="radio">Thesis Title</label>
							<label><input name="category-adv" type="radio">Adviser Name</label>
							<label><input name="category-adv" type="radio">Student Name</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-7 col-md-offset-3">
						<input class="btn btn-md btn-primary" type="submit" value="Search">
					</div>
				</div>
			</form>
		</div>
	</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/ccs-cbrso-webapp/includes/html/footer.php"); ?>
<script type="text/javascript">
$(function() {
    $("select").selectmenu();
});
</script>
</body>
</html>
