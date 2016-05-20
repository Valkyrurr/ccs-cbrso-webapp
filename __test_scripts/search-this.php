<?php require("../sessions.php"); ?>
<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] === TRUE) header('Location: ../index.php', TRUE, 302); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CCS-CbRSO</title>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/css.css" rel="stylesheet">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function() {
    $("#output").autocomplete({
        source: "search.php",
        minLength: 1
    });                
});
</script>
</head>
<body>
	<?php include("../nav-sidebar.php"); ?>
	<div class="container-fluid col-md-offset-2">
		<form class="form-horizontal">
			<div class="form-group">
				<label class="col-md-2 control-label">Search:</label>
				<div class="col-md-8">
					<input class="form-control" id="output" type="text">
				</div>
			</div>
		</form>
	</div>
	
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/js.js"></script>
</body>
</html>