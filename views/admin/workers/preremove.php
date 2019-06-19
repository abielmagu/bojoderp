<?php $worker = $data['worker'] ?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php $fullname = $worker['name'].' '.$worker['lastname'] ?>
	<div class="jumbotron">
		<div class="container text-center">
			<h1><span>Be carefull...</span></h1>
			<p>Are you sure remove <b><?= $fullname ?>?</b></p>
			<br>
			<form action="<?= DOMAIN ?>/workers/remove" method="post">
				<input type="hidden" name="needle" value="<?= $worker["id"] ?>">
				<input type="hidden" name="fullname" value="<?= $fullname ?>">
				<button class="btn btn-danger"type="submit" name="buttonRemove">
					<span class="glyphicon glyphicon-erase margin-right"></span> Yes, remove worker
				</button>
				<a class="btn btn-primary" href="<?= DOMAIN ?>/workers">Cancel</a>
			</form>
		</div>
	</div>

</div>
