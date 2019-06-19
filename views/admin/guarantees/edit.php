<?php
$warranty = $data['warranty'];
$statusWarranty = $GLOBALS['statusWarranty'];
$kinds = $GLOBALS['works'];
?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">Edit warranty</h1>
		</div>
		<div class="panel-body">
			<h3>Work</h3>
			<div class="row">
				<div class="col-md-6">
					<b>Client</b>
					<p class="well well-sm text-center"><?= $warranty['name'].' '.$warranty['lastname'] ?></p>			
				</div>
				<div class="col-md-6">
					<b>Address</b>
					<p class="well well-sm text-center"><?= $warranty['address'].', '.$warranty['zip'].' '.$warranty['city'].', '.$warranty['state'] ?></p>			
				</div>
				<div class="col-md-6">
					<b>Type</b>
					<p class="well well-sm text-center"><?= $kinds[$warranty['kind']] ?></p>
				</div>
				<div class="col-md-6">
					<b>Scheduled</b>
					<p class="well well-sm text-center"><?= $warranty['scheduled_work'] ?></p>
				</div>
			</div>
			<h3>Warranty</h3>
			<form action="<?= DOMAIN ?>/guarantees/update" method="post">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Repairers</label>
							<input class="form-control" type="text" name="repairers" value="<?= $warranty['repairers'] ?>" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Schedule</label>
							<input class="form-control" type="date" name="scheduled" value="<?= $warranty['scheduled_at'] ?>" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="">Status</label>
							<select class="form-control" name="status">
								<?php foreach($statusWarranty as $status => $settings): $selected = ($status === $warranty['status']) ? 'selected' : false ?>
								<option value="<?= $status ?>" <?= $selected ?>><?= $settings['tag'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="">Issues</label>
					<textarea class="form-control" name="issues" cols="30" rows="7" required><?= $warranty['issues'] ?></textarea>
				</div>
				<div class="form-group">
					<label for="">Solutions</label>
					<textarea class="form-control" name="solutions" cols="30" rows="7" required><?= $warranty['solutions'] ?></textarea>
				</div>
				<br>
				<p class="text-right">
					<input type="hidden" name="needle" value="<?= $warranty['id'] ?>">
					<button type="submit" class="btn btn-success">Update warranty</button>
					<?php 
					 /*<a class="btn btn-default" href="<?= DOMAIN ?>/guarantees/filter/?date=<?= $warranty['scheduled_at'] ?>">Cancel</a>*/
					?>				
					<a class="btn btn-default" href="<?= DOMAIN ?>/guarantees/filter/?date=<?= $warranty['scheduled_at'] ?>">Cancel</a>
				</p>
			</form>
		</div>
	</div>
	
</div>
