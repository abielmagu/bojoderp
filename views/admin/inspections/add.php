<?php
$work = $data['work'];
$kinds = $GLOBALS['works'];
?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">New inspection</h1>
		</div>
		<div class="panel-body">
			<h3>Work</h3>
			<div class="row">
				<div class="col-md-6">
					<b>Client</b>
					<p class="well well-sm text-center"><?= $work['name'].' '.$work['lastname'] ?></p>
				</div>
				<div class="col-md-6">
					<b>Address</b>
					<p class="well well-sm text-center"><?= $work['address'].', '.$work['zip'].' '.$work['city'].', '.$work['state'] ?></p>
				</div>
				<div class="col-md-6">
					<b>Type</b>
					<p class="well well-sm text-center"><?= $kinds[$work['kind']] ?></p>
				</div>
				<div class="col-md-6">
					<b>Schedule</b>
					<p class="well well-sm text-center"><?= $work['scheduled_at'] ?></p>
				</div>
    	</div>
    	<h3>Inspection</h3>
    	<form action="<?= DOMAIN ?>/inspections/create" method="post">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Schedule</label>
							<input class="form-control" type="date" name="scheduled" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Inspection by</label>
							<input class="form-control" type="text" name="nameby" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Notes</label>
					<textarea class="form-control" name="notes" rows="8" cols="40" required>None</textarea>
				</div>
				<br>
				<p class="text-right">
					<input type="hidden" name="needle" value="<?= $work['id'] ?>">
					<button class="btn btn-success" type="submit" name="buttonSubmit">Create inspection</button>
					<a class="btn btn-default" href="<?= DOMAIN ?>/guarantees/">Cancel</a>
				</p>
    	</form>
		</div>
	</div>
	
</div>