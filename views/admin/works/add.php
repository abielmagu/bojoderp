<?php
$client  = $data['client'];
$crews 	 = $data['crews'];
$interms = $data['interms'];
$kinds 	 = $GLOBALS['works'];
?>

<?php include_once dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

<?php include_once VIEWS.'app/partials/message.php' ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h1 class="margin-lg-y">Add work</h1>
	</div>
	<div class="panel-body">
		
		<h3>Client</h3>
		<div class="row">
			<div class="col-md-4">
				<label for="">Name</label>
				<div class="well well-sm"><?= $client['name'].' '.$client['lastname'] ?></div>
			</div>
			<div class="col-md-4">
				<label for="">Address</label>
				<div class="well well-sm"><?= $client['address'].', '.$client['zip'] ?></div>
			</div>
			<div class="col-md-4">
				<label for="">Location</label>
				<div class="well well-sm"><?= $client['city'].', '.$client['state'] ?></div>
			</div>
			<div class="col-md-4">
				<label for="">Phone</label>
				<div class="well well-sm"><?= $client['phone'] ?></div>
			</div>
			<div class="col-md-4">
				<label for="">Email</label>
				<div class="well well-sm"><?= $client['email'] ?></div>
			</div>
			<div class="col-md-4">
				<label for="">Notes</label>
				<textarea class="form-control" cols="30" rows="1" readonly><?= $client['notes'] ?></textarea>
			</div>
		</div>

		<h3>General</h3>
		<form action="<?= DOMAIN ?>/works/create" method="post">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Schedule</label>
						<input class="form-control" type="date" name="scheduled" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Crew</label>
						<select class="form-control" name="crew" required>
							<option disabled selected></option>
							<?php foreach($crews as $crew): ?>
							<option value="<?= $crew['id'] ?>"><?= $crew['nick'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Intermediary</label>
						<select class="form-control" name="intermediary">
							<option disabled selected></option>
							<?php foreach($interms as $interm): ?>
							<option value="<?= $interm['id'] ?>"><?= $interm['name'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>

			<h3>Setup</h3>
			<div class="form-group">
				<label>Work type</label>
				<select class="form-control input-lg-" name="kindwork" id="xjs-kindwork" required>
					<option label="" disabled selected></option>
					<?php foreach($kinds as $kind => $title): ?>
					<option value="<?= $kind ?>"><?= $title ?></option>
					<?php endforeach ?>
				</select>
			</div>

			<div id="xjs-kindwork-load"></div>

      <div class="hidden" id="xjs-kindwork-loading">
        <div class="progress text-center">
          <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            <span class="sr-only"></span>
          </div>
        </div>
      </div>

    	<div class="clearfix" style="margin-bottom:2rem"></div>
			<div class="form-group">
				<label for="">Notes</label>
				<textarea class="form-control" name="notes" id="" cols="30" rows="5" required>None</textarea>
			</div>

      <p class="text-right">
      	<input type="hidden" name="needle" value="<?= $client['id'] ?>">
        <button class="btn btn-success" type="submit">Create work</button>
        <a class="btn btn-default" href="<?= DOMAIN ?>/clients/casefile/<?= $client['id'] ?>">Cancel</a>
      </p>
		</form>
	</div>
</div>

</div>
