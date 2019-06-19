<?php 
$work = $data['work'];
$kinds = $GLOBALS['works'];
?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">New warranty</h1>
		</div>
		<div class="panel-body">
			<h3>Work</h3>
			<div class="row">
				<div class="col-md-6">
					<b>Client</b>
					<p class="well well-sm"><?= $work['name'].' '.$work['lastname'] ?></p>			
				</div>
				<div class="col-md-6">
					<b>Address</b>
					<p class="well well-sm"><?= $work['address'].', '.$work['zip'].' '.$work['city'].', '.$work['state'] ?></p>			
				</div>
				<div class="col-md-6">
					<b>Type</b>
					<p class="well well-sm text-center"><?= $kinds[$work['kind']] ?></p>
				</div>
				<div class="col-md-6">
					<b>Scheduled</b>
					<p class="well well-sm text-center"><?= $work['scheduled_at'] ?></p>
				</div>
			</div>
			<h3>Warranty</h3>
			<form action="<?= DOMAIN ?>/guarantees/create" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Schedule</label>
							<input class="form-control" type="date" name="scheduled">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Repairers</label>
							<input class="form-control" type="text" name="repairers">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="">Issues</label>
					<textarea class="form-control" name="issues" cols="30" rows="10" required>None</textarea>
				</div>
				<br>
				<p class="text-right">
					<input type="hidden" name="needle" value="<?= $work['id'] ?>">
					<button type="submit" class="btn btn-success">Create warranty</button>
					<a class="btn btn-default" href="<?= DOMAIN ?>/clients/casefile/<?= $work['idclient'] ?>">Cancel</a>
				</p>
			</form>
		</div>
	</div>
	
</div>