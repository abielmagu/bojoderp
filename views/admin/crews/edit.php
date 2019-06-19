<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php if($data['crew']): $crew = $data['crew'] ?>

	<?php $kinds = array('internal'=>'Local', 'external'=>'Subcontrator') ?>
	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1>Edit crew</h1>
		</div>
		<div class="panel-body">
			<p class="text-muted text-right">Last updated: <?= $crew['updated_at'] ?></p>
			<br>
			<form action="<?= DOMAIN ?>/crews/update" method="post" autocomplete="off">

				<?php $checkboxSwitch = (!$crew['enabled']) ? 'checked' : false ?>
				<div class="input-group">
					<span class="input-group-addon">
						<input name="disabled" value="0" class="toggle" id="disable-crew" data-toggle="crew-settings" type="checkbox" <?= $checkboxSwitch ?>>
					</span>
					<label for="disable-crew" class="form-control">Disable this crew to restrict access to the application</label>
				</div>

				<?php $fieldsetSwitch = ($checkboxSwitch) ? 'disabled' : false ?>
				<fieldset id="crew-settings" <?= $fieldsetSwitch ?>>

					<h3>Settings</h3>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Nickname</label>
								<input class="form-control" value="<?= $crew['nick'] ?>" name="nickname" type="text" pattern="[a-zA-Z0-9&\-]{5,}" required>
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
									<option disabled></option>
									<?php foreach($kinds as $kind=>$label): ?>
									<?php $selected = ($crew['kind'] == $kind) ? 'selected' : false ?>
									<option value="<?= $kind ?>" <?= $selected ?>><?= $label ?></option>
									<?php endforeach ?>
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
								<input class="form-control" value="<?= $crew['name'] ?>" name="username" type="text" pattern="[a-z0-9]{5,15}" required>
								<small class="help-block">
									<?php include_once VIEWS.'app/forms/helpblock-username.php' ?>
								</small>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>New password</label>
								<input class="form-control" type="password" name="passwordNew" pattern="\S{5,}" placeholder="Leave empty if you do not want">
								<small class="help-block">
									<?php include_once VIEWS.'app/forms/helpblock-password.php' ?>
								</small>
							</div>
						</div>
					</div>
					<br>
					<div class="form-group">
						<label for="">Notes</label>
						<textarea class="form-control" name="notes" rows="4" cols="40" required><?= $crew['notes'] ?></textarea>
					</div>

				</fieldset>
				<div class="hidden">
					<input type="hidden" name="usernamePrev" value="<?= $crew['name'] ?>">
					<input type="hidden" name="needle[]" value="<?= $crew['id'] ?>">
					<input type="hidden" name="needle[]" value="<?= $crew['id_user'] ?>">
				</div>
				<p class="text-right">
					<button class="btn btn-success" type="submit">Update crew</button>
					<a class="btn btn-default margin-left" href="<?= DOMAIN ?>/crews/">Cancel</a>
				</p>
			</form>
		</div>
	</div>

	<?php else: $entity = array('name' => 'Crew', 'url' => 'crews') ?>

	<?php include_once VIEWS.'app/partials/missing.php' ?>

	<?php endif ?>

</div>
