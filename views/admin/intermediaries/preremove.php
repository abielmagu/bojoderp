<?php $interm = $data['interm'] ?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="jumbotron">
		<div class="container text-center">
			<h1><span>Be carefull...</span></h1>
			<p>Are you sure remove <b><?= $interm['name'] ?>?</b></p>
			<br>
			<form action="<?= DOMAIN ?>/intermediaries/remove" method="post">
				<input type="hidden" name="name" value="<?= $interm['name'] ?>">
				<input type="hidden" name="needle[]" value="<?= $interm['id'] ?>">
				<input type="hidden" name="needle[]" value="<?= $interm['id_user'] ?>">
				<button class="btn btn-danger"type="submit" name="buttonRemove">
					<span class="glyphicon glyphicon-erase margin-right"></span> Yes, remove intermediary
				</button>
				<a class="btn btn-primary" href="<?= DOMAIN ?>/intermediaries">Cancel</a>
			</form>
		</div>
	</div>

</div>
