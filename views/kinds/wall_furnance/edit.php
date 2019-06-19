<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Serial</label>
      <input class="form-control" type="text" name="serial" value="<?= $details['number_serial'] ?>" required>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Model</label>
      <input class="form-control" type="text" name="model" value="<?= $details['model'] ?>" required>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Cover</label>
      <div class="row">
      	<?php list($dateCover, $timeCover) = explode(' ', $details['cover_at']) ?>
      	<div class="col-xs-6">
					<input class="form-control" type="date" name="cover_date" value="<?= $dateCover ?>">
      	</div>
      	<div class="col-xs-6">
      		<input class="form-control" type="time" name="cover_time" value="<?= $timeCover ?>">
      	</div>
      </div>
    </div>
  </div>
</div>