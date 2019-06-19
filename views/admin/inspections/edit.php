<?php
$inspection = $data['inspection'];
$statusInspection = $GLOBALS['statusInspection'];
$kinds = $GLOBALS['works'];
?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">Edit inspection</h1>
		</div>
		<div class="panel-body">
			<h3>Work</h3>
			<div class="row">
				<div class="col-md-6">
					<b>Client</b>
					<p class="well well-sm text-center"><?= $inspection['name'].' '.$inspection['lastname'] ?></p>
				</div>
				<div class="col-md-6">
					<b>Address</b>
					<p class="well well-sm text-center"><?= $inspection['address'].', '.$inspection['zip'].' '.$inspection['city'].', '.$inspection['state'] ?></p>
				</div>
				<div class="col-md-6">
					<b>Type</b>
					<p class="well well-sm text-center"><?= $kinds[$inspection['kind']] ?></p>
				</div>
				<div class="col-md-6">
					<b>Schedule</b>
					<p class="well well-sm text-center"><?= $inspection['scheduled_at'] ?></p>
				</div>
    	</div>
    	<h3>Inspection</h3>
    	<form action="<?= DOMAIN ?>/inspections/update" method="post">
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Schedule</label>
							<input class="form-control" type="date" name="scheduled" value="<?= $inspection['scheduled_at'] ?>" required>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Inspection by</label>
							<input class="form-control" type="text" name="nameby" value="<?= $inspection['name_by'] ?>" required>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Approval</label>
							<select class="form-control" name="approval" required>
								<?php foreach($statusInspection as $status => $settings): $selected = ($status == $inspection['approval']) ? 'selected' : false ?>
								<option value="<?= $status ?>" <?= $selected ?>><?= $settings['tag'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Notes</label>
					<textarea class="form-control" name="notes" rows="8" cols="40" required><?= $inspection['notes'] ?></textarea>
				</div>
				<div class="form-group">
					<label>Observations</label>
					<textarea class="form-control" name="observations" rows="8" cols="40" required><?= $inspection['observations'] ?></textarea>
				</div>
      	<br>
				<p class="text-right">
					<input type="hidden" name="needle" value="<?= $inspection['id'] ?>">
					<button class="btn btn-success" type="submit" name="buttonSubmit">Update inspection</button>
					<a class="btn btn-default" href="<?= DOMAIN ?>/inspections/filter/?date=<?= $inspection['scheduled_at'] ?>">Cancel</a>
					
				</p>
    	</form>
		</div>
	</div>
	
</div>