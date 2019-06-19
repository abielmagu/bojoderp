<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Serial</label>
      <input class="form-control" type="text" name="serial" value="<?= $details['serial_number'] ?>" required>
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
      <label>Tons</label>
      <input class="form-control" type="number" name="tons" min="0" step="0.1" value="<?= $details['tons'] ?>" required>
    </div>
  </div>
  <div class="col-md-3">
    <label>Type</label>
    <?php
			$kinds = array('gas' => '', 'electric' => '');
			$kinds[$details['kind']] = 'checked';
    ?>
    <div class="radio">
      <label><input name="kindcentral" value="gas" type="radio" <?= $kinds['gas'] ?>> Gas</label>
      <label class="margin-lg-left"><input name="kindcentral" value="electric" type="radio" <?= $kinds['electric'] ?>> Electric</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Platform</label>
    <?php
			$platforms = array(0 => '', 1 => '');
			$platforms[$details['platform']] = 'checked';
    ?>
    <div class="radio">
      <label><input name="platform" value="1" type="radio" <?= $platforms[1] ?>>Yes</label>
      <label class="margin-lg-left"><input name="platform" value="0" type="radio" <?= $platforms[0] ?>>No</label>
    </div>
  </div>
</div>