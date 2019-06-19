<?php
$client = $data['client'];
include LIBRARY.'php/states_usa.php';
?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">Edit client</h1>
		</div>
		<div class="panel-body">
			<form action="<?= DOMAIN ?>/clients/update" method="post" autocomplete="off">
				<h3>Personal</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">				
							<label>Name</label>
							<input class="form-control" type="text" name="name" value="<?= $client['name'] ?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Lastname</label>
							<input class="form-control" type="text" name="lastname" value="<?= $client['lastname'] ?>" required>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="form-group">
							<label>Address</label>
							<input class="form-control" type="text" name="address" value="<?= $client['address'] ?>" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">			
							<label>ZIP</label>
							<input class="form-control" type="number" min="1" max="99999" name="zip" value="<?= $client['zip'] ?>" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">					
							<label>City</label>
							<input class="form-control" type="text" name="city" value="<?= $client['city'] ?>" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">		
							<label>State</label>
							<select class="form-control" name="state" required>
								<option disabled selected></option>

								<?php foreach( $states_names as $state ):  ?>
								<?php $selected = ($state === $client['state']) ? 'selected' : false ?>
								<option value="<?= $state ?>" <?= $selected ?>><?= $state ?></option>
								<?php endforeach ?>

							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Phone</label>
							<input class="form-control" type="text" name="phone" value="<?= $client['phone'] ?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">			
							<label>Email</label>
							<input class="form-control" type="email" name="email" value="<?= $client['email'] ?>" required>
						</div>
					</div>
				</div>
				<h3>Comments</h3>
				<div class="form-group">
					<textarea class="form-control" name="notes" rows="5" required><?= $client['notes'] ?></textarea>
				</div>
				<br>
				<p class="text-right">
					<input type="hidden" name="needle" value="<?= $client['id'] ?>">
					<button class="btn btn-success" type="submit">Update client</button>
					<a class="btn btn-default margin-left" href="<?= DOMAIN ?>/clients/casefile/<?= $client['id'] ?>">Cancel</a>
				</p>
			</form>
		</div>
	</div>

</div>