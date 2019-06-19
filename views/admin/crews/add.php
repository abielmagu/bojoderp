<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">New crew</h1>
		</div>
		<div class="panel-body">
			<form action="<?= DOMAIN ?>/crews/create" method="post" autocomplete="off">
				<h3>Settings</h3>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Nickname</label>
							<input class="form-control" name="nickname" type="text" pattern="[a-zA-Z0-9&]{5,}" required>
							<small class="help-block">
								<ul style="padding-left:2rem">
									<li>Minimun 5 characters</li>
									<li>Use letters and numbers</li>
									<li>Also you can use "&amp;", "-" and spaces</li>
								</ul>
							</small>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Type</label>
							<select class="form-control" name="kindname" required>
								<option disabled selected></option>
								<option value="internal">Local</option>
								<option value="external">Subcontractor</option>
							</select>
							<small class="help-block">
								Groups workers in <b>local crew</b>
							</small>
						</div>
					</div>
				</div>
				
				<h3>Login</h3>
				<div class="row">				
					<div class="col-sm-6">
						<div class="form-group">
							<label>Username</label>
							<input class="form-control" type="text" name="username" pattern="[a-zA-Z0-9]{5,}" required>
							<small class="help-block">
								<?php include_once VIEWS.'app/forms/helpblock-username.php' ?>
							</small>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Password</label>
							<input pattern="\S{5,}" class="form-control" type="password" name="password" required>
							<small class="help-block">
								<?php include_once VIEWS.'app/forms/helpblock-password.php' ?>
							</small>
						</div>
					</div>
				</div>
				<br>
				<div class="form-group">
					<label for="">Notes</label>
					<textarea class="form-control" name="notes" rows="8" cols="40" required>None</textarea>	
				</div>
				<br>
				<p class="text-right">
					<button class="btn btn-success" type="submit">Add crew</button>
					<a class="btn btn-default margin-left" href="<?= DOMAIN ?>/crews/">Cancel</a>
				</p>
			</form>
		</div>
	</div>

</div>
