<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

<?php if($data['interm']): $interm = $data['interm'] ?>
	<?php include LIBRARY.'php/states_usa.php' ?>
	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">Edit intermediary</h1>
		</div>
		<div class="panel-body">
			<form action="<?= DOMAIN ?>/intermediaries/update" method="post" autocomplete="off">
				<h3>Information</h3>
				<div class="row">
					<div class="col-md-8 form-group">
						<label for="name">Name</label>
						<input class="form-control" type="text" name="name" value="<?= $interm['name'] ?>" required>
					</div>
					<div class="col-md-4 form-group">
						<label for="nick">Nickname</label>
						<input class="form-control" type="text" name="nick" value="<?= $interm['nick'] ?>" pattern="[A-Z0-9]+" required>
						<small class="help-block">
							<ul style="padding-left:2rem">
								<li>Only uppercase letters and numbers</li>
							</ul>
						</small>
					</div>
					<div class="col-md-12 form-group">
						<label for="contact">Contact</label>
						<input class="form-control" type="text" name="contact" value="<?= $interm['contact'] ?>" required>
					</div>
					<div class="col-md-12 form-group">
						<label for="address">Address</label>
						<input class="form-control" type="text" name="address" value="<?= $interm['address'] ?>" required>
					</div>
					<div class="col-md-4 form-group">
						<label for="zip">ZIP</label>
						<input class="form-control" type="text" name="zip" value="<?= $interm['zip'] ?>" required>
					</div>
					<div class="col-md-4 form-group">
						<label for="city">City</label>
						<input class="form-control" type="text" name="city" value="<?= $interm['city'] ?>" required>
					</div>
					<div class="col-md-4 form-group">
						<label for="state">State</label>
						<select class="form-control" name="state" required>
							<option disabled selected></option>

							<?php foreach( $states_names as $state ):  ?>
							<?php $selected = ($interm['state'] === $state) ? 'selected' : false ?>
							<option value="<?= $state ?>" <?= $selected ?>><?= $state ?></option>
							<?php endforeach ?>

						</select>
					</div>
					<div class="col-md-6 form-group">
						<label for="phone">Phone</label>
						<input class="form-control" type="text" name="phone" value="<?= $interm['phone'] ?>" required>
					</div>
					<div class="col-md-6 form-group">
						<label for="email">Email</label>
						<input class="form-control" type="email" name="email" value="<?= $interm['email'] ?>" required>
					</div>
				</div>
				<h3>Login</h3>
				<div class="row">
					<div class="col-md-6 form-group">
						<label>Username</label>
						<input class="form-control" type="text" name="username" value="<?= $interm['username'] ?>" required>
						<small class="help-block">
							<?php include_once VIEWS.'app/forms/helpblock-username.php' ?>
						</small>
					</div>
					<div class="col-md-6 form-group">
						<label>New password</label>
						<input class="form-control" type="password" name="passwordNew" placeholder="Let empty if you dont want">
						<small class="help-block">
							<?php include_once VIEWS.'app/forms/helpblock-password.php' ?>
						</small>
					</div>
				</div>
				<br>
				<div class="form-group">
					<label for="">Notes</label>
					<textarea class="form-control" name="notes" rows="5" cols="40" required><?= $interm['notes'] ?></textarea>
				</div>
				<br>
				<p class="text-right">
					<input type="hidden" name="usernamePrev" value="<?= $interm['username'] ?>">
					<input type="hidden" name="needle[]" value="<?= $interm['id'] ?>">
					<input type="hidden" name="needle[]" value="<?= $interm['id_user'] ?>">
					<button class="btn btn-success" type="submit">Update intermediary</button> 
					<a class="btn btn-default margin-left" href="<?= DOMAIN ?>/intermediaries/">Cancel</a>
				</p>
			</form>
		</div>
	</div>

	<?php else: $entity = array('name'=>'Intermediary', 'url'=>'intermediaries') ?>

	<?php include_once VIEWS.'app/partials/missing.php' ?>
	
	<?php endif ?>

</div>