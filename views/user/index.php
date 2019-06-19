<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
	<h1>Welcome</h1>
	<form action="<?= DOMAIN ?>/logging" method="post" autocomplete="off">
	<div class="form-group">
		<label>Username</label>
		<input class="form-control" type="text" name="username" autofocus required>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input class="form-control" type="password" name="password" required>
	</div>
	<input type="hidden" name='token' value="<?= sha1( rand() ) ?>">
	<button class="btn btn-success" type="submit">Login</button>
	<?php if($data['again']): ?>
	<span class="text-danger margin-left"><b>Please, check again.</b></span>
	<?php endif ?>
	</form>
</div>
