<?php include '_col-sizes.php'; ?>

	<?php include_once VIEWS.'/app/partials/message.php' ?>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">Settings</h1>
		</div>
		<div class="panel-body">
			<p class="text-muted text-right">Last update: <?= $data['userUpdated'] ?></p>
			<form action="<?= DOMAIN ?>/update" method="post" autocomplete="off">
				<div class="form-group">
					<label>New password</label>
					<input class="form-control" type="password" name="passwordNew" pattern="\S{5,}" placeholder="Leave empty if you do not want to change">
					<small class="help-block">
						<?php include_once VIEWS.'/app/forms/helpblock-password.php' ?>
					</small>
				</div>
				<hr>
				<div class="form-group">
					<div class="input-group">
						<input class="form-control" type="password" name="password" placeholder="Current password to update" pattern="\S{5,}" required>
						<span class="input-group-btn">		
							<button class="btn btn-success" type="submit">Update settings</button>
						</span>
					</div>
				</div>
			</form>
		</div>
	</div>
	
</div>
