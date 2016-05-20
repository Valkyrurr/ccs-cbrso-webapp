<div id="accordion" class="col-md-2 sidebar">
	<img src="<?php echo "/ccs-cbrso-webapp/assets/imgs/logo.png"; ?>" class="page-header img-responsive">
	<ul class="nav nav-sidebar">
		<li><a href="/ccs-cbrso-webapp/index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
		<li><a href="#search" data-toggle="collapse"><span class="glyphicon glyphicon-search"></span> Search
		<span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
			<div id="search" class="collapse">
				<form class="form-inline" action="/ccs-cbrso-webapp/search.php" method="get">
					<div class="form-group">
						<div class="col-md-12">
							<div class="input-group">
								<input class="form-control" type="text" name="keyword" value=""
									placeholder="Search for..." required><span
									class="input-group-btn"> <input class="btn btn-default" type="submit" value="search">
								</span>
							</div>
						</div>
						<div class="col-md-12">
							<div class="radio">
								<label><input type="radio" name="category" value="1" required> Thematic Area</label>
								<label><input type="radio" name="category" value="2" required> CCS Area</label>
								<label><input type="radio" name="category" value="3" required> Thesis Title</label>
								<label><input type="radio" name="category" value="4" required> Adviser Name</label>
								<label><input type="radio" name="category" value="5" required> Student Name</label>
							</div>
						</div>
					</div>
				</form>
			</div></li>
		<li><a href="/ccs-cbrso-webapp/nav-sidebar.php#register" data-toggle="collapse"><span class="glyphicon glyphicon-pencil"></span> Register
		<span class="glyphicon glyphicon-chevron-down pull-right"></span></a>
			<div id="register" class="collapse">
				<ul>
					<li><a href="">Research</a></li>
					<li><a href="">Social Outreach</a></li>
					<li><a href="">On-the-Job Training</a></li>
				</ul>
			</div>
		</li>
		<li><a href="#"><span class="glyphicon glyphicon-book"></span> Logs</a></li>
		<li><a href="/ccs-cbrso-webapp/user/settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
		<?php require("sessions.php"); ?>
		<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] === TRUE): ?>
		<li><a href='/ccs-cbrso-webapp/user/logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
		<?php else: ?>
		<li><a href='/ccs-cbrso-webapp/user/index.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>
		<?php endif; ?>
		<?php var_dump($_SESSION); ?>
	</ul>
</div>