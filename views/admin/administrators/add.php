<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">New administrator</h1>
		</div>
		<div class="panel-body">
			<form action="<?= DOMAIN ?>/administrators/create" method="post" autocomplete="off">
     		<div class="form-group">
          <label for="kind">Type</label>
          <select class="form-control" name="kind" required>
            <option disabled selected></option>
            <option value="admin">Administrator</option>
            <option value="coord">Coordinator</option>
          </select>
          <small class="help-block"><b>Coordinators can not control others administrators</b></small>
     		</div>
     		<div class="form-group">
          <label for="username">Username</label>
          <input class="form-control" type="text" name="username" pattern="[a-zA-Z0-9]{5,}" required>
          <small class="help-block">
          	<?php include VIEWS.'app/forms/helpblock-username.php' ?>
          </small>
     		</div>
     		<div class="form-group">
          <label for="password">Password</label>
          <input class="form-control" type="password" name="password" pattern="\S{5,}" required>
          <small class="help-block">
          	<?php include VIEWS.'app/forms/helpblock-password.php' ?>
          </small>
     		</div>
				<p class="text-right">
					<button type="submit" name="submited" class="btn btn-success">Add administrator</button>
					<a class="btn btn-default margin-left" href="<?= DOMAIN ?>/administrators/">Cancel</a>
				</p>
    	</form>
		</div>
	</div>
	
</div>
