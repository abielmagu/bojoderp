<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">New worker</h1>
		</div>
		<div class="panel-body">
			<form action="<?= DOMAIN ?>/workers/create" method="post" autocomplete="off">
				<h3>Personal</h3>
				<div class="form-group">
					<label for="name">Name</label>
					<input class="form-control" type="text" name="name" required>
				</div>
				<div class="form-group">
					<label for="lastname">Lastname</label>
					<input class="form-control" type="text" name="lastname" required>
				</div>
				<div class="form-group">
					<label for="birthday">Birthday</label>
					<input class="form-control" type="date" name="birthday" required>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="phone">Phone</label>
							<input class="form-control" type="text" name="phone" value="None" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="email">Email</label>
							<input class="form-control" type="email" name="email" value="none@email" required>
						</div>
					</div>
				</div>
				<h3>Skills</h3>
				<hr>
				<div class="row">
					<div class="col-sm-2">
						<label>Languages</label>
						<div class="checkbox">
							<label>
								<input name="languages[]" type="checkbox" value="english"> English
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input name="languages[]" type="checkbox" value="spanish"> Spanish
							</label>
						</div>
						<div class="form-group">
							<div class="checkbox">
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<label>Documents</label>
						<div class="checkbox">
							<label><input name="documents[]" type="checkbox" value="driver">Driver</label>
						</div>
						<div class="checkbox">
							<label><input name="documents[]" type="checkbox" value="passport">Passport</label>	
						</div>
					</div>
					<div class="col-sm-2">
						<label>Stage</label>
						<div class="radio">
							<label for="training">
								<input type="radio" name="stage" id="training" value="training" checked> Training
							</label>
						</div>
						<div class="radio">
							<label for="completed">
								<input type="radio" name="stage" id="completed" value="completed"> Completed
							</label>
						</div>
					</div>
				</div>
				<br>
				<div class="form-group">
					<label for="notes">Notes</label>
					<textarea class="form-control" name="notes" rows="3" style="resize: vertical" required>None</textarea>
				</div>
				<br>
				<p class="text-right">
					<button class="btn btn-success" type="submit" name="button">Add worker</button>
					<a class="btn btn-default margin-left" href="<?= DOMAIN ?>/workers/">Cancel</a>
				</p>
			</form>
		</div>
	</div>
	
</div>
