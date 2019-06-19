<?php include LIBRARY.'php/states_usa.php' ?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">New client</h1>
		</div>
		<div class="panel-body">
			<form action="<?= DOMAIN ?>/clients/create" method="post" autocomplete="off">
				<h3>Personal</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">				
							<label>Name</label>
							<input class="form-control" type="text" name="name" value="" autofocus required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Lastname</label>
							<input class="form-control" type="text" name="lastname" value="" required>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<label>Address</label>
							<input class="form-control" type="text" name="address" value="" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">			
							<label>ZIP</label>
							<input class="form-control" type="number" min="1" max="99999" name="zip" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">					
							<label>City</label>
							<input class="form-control" type="text" name="city" value="" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">		
							<label>State</label>
							<select class="form-control" name="state" required>
								<option disabled selected></option>

								<?php foreach( $states_names as $state ):  ?>
								<option value="<?= $state ?>"><?= $state ?></option>
								<?php endforeach ?>

							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Phone</label>
							<input class="form-control" type="text" name="phone" value="" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">			
							<label>Email</label>
							<input class="form-control" type="email" name="email" value="none@email" required>
						</div>
					</div>
				</div>
				<h3>Comments</h3>
				<div class="form-group">
					<textarea class="form-control" name="notes" rows="5" required>None</textarea>
				</div>
				<br>
				<p class="text-right">
					<button class="btn btn-success" type="submit">Add client</button>
					<a class="btn btn-default margin-left" href="<?= DOMAIN ?>/clients">Cancel</a>
				</p>
			</form>
		</div>
	</div>

</div>