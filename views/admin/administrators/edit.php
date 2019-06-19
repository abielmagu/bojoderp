<?php $admin = $data['admin'] ?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php if(!empty($admin)): ?>
	<?php include_once VIEWS.'app/partials/message.php' ?>
	
	<?php 
		$checkboxSwitch = (!$admin['enabled']) ? 'checked'  : false;
		$fieldsetSwitch = ($checkboxSwitch) 	 ? 'disabled' : false;
	?>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">Edit administrator</h1>
		</div>
		<div class="panel-body">
			<p class="text-muted text-right">Last update: <?= $admin['updated_at'] ?></p>
			<br>
			<form action="<?= DOMAIN ?>/administrators/update" method="post" autocomplete="off">
				<div class="input-group">
					<span class="input-group-addon">
						<input name="disabled" value="0" class="toggle" id="disable-administrator" data-toggle="admin-settings" type="checkbox" <?= $checkboxSwitch ?>>
					</span>
					<label for="disable-administrator" class="form-control">Disable this administrator to restrict access to the application</label>
				</div>
				<br>
				<fieldset id="admin-settings" <?= $fieldsetSwitch ?>>
					<div class="form-group">
						<label>Type</label>
						<select class="form-control" name="kind">
							<option disabled selected></option>
							
							<?php $kinds = array('admin'=>'Administrator', 'coord'=>'Coordinator'); ?>
							<?php foreach($kinds as $key => $value): ?>
							<?php $selected = ($key === $admin['kind']) ? 'selected' : '' ?>
							<option value="<?= $key ?>" <?= $selected ?>><?= $value ?></option>
							<?php endforeach ?>
							
						</select>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input value="<?= $admin["name"] ?>" class="form-control" name="username" pattern="[a-zA-Z0-9]{5,}" type="text" required>
						<small class="help-block">
							<?php include VIEWS.'app/forms/helpblock-username.php' ?>
						</small>
					</div>
					<div class="form-group">
						<label>New password</label>
						<input class="form-control" name="passwordNew" pattern="\S{5,}" type="password" placeholder="Leave empty if you do not want">
						<small class="help-block">
							<?php include VIEWS.'app/forms/helpblock-password.php' ?>
						</small>
					</div>
				</fieldset>
				<br>
				<p class="text-right">
					<input type="hidden" name="usernamePrev" value="<?= $admin['name'] ?>">
					<input type="hidden" name="needle" value="<?= $admin['id'] ?>">
					<button type="submit" class="btn btn-success">Update administrator</button>
					<a class="btn btn-default margin-left" href="<?= DOMAIN ?>/administrators/">Cancel</a>
				</p>
			</form>
		</div>
	</div>
	
	<?php else: $entity = array('name' => 'Administrator', 'url' => 'administrators') ?>

	<?php include_once VIEWS.'app/partials/missing.php' ?>
	
	<?php endif ?>

</div>