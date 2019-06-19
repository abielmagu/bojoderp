<?php 
$ducts  = explode(',', $details['ducts']);
$alphab = range('A','Z');
$d = 0;
?>
<div class="row">
  <div class="col-md-6">
  	<div class="form-group">
			<label>Plenum</label>
			<input class="form-control" type="number" name="plenum" min="1" max="3" value="<?= $details['plenum'] ?>" required>
			<p class="help-block"><small>Maximum = 3</small></p>
  	</div>
  </div>
  <div class="col-md-6">
  	<div class="form-group">
			<label>Tape feets</label>
			<input class="form-control" type="number" name="tapeFeets" min="1" max="500" value="<?= $details['tape_feets'] ?>" required>
			<p class="help-block"><small>Maximum = 500</small></p>
  	</div>
  </div>
  <div class="col-sm-12 countify">
    <p class="lead"><b>Ducts</b></p>
    <div class="row">
      <div class="col-sm-3 text-center">
        <label>#</label>
      </div>
      <div class="col-sm-3">
        <label>Letter</label>
      </div>
      <div class="col-sm-3">
        <label>Meassure</label>
      </div>
    </div>
  </div>
</div>

<div class="row countify">
 
	<?php foreach($ducts as $duct): ?>
	<?php list($ductLetter,$ductMeassure) = explode(':', $duct) ?>
  <div class="col-xs-2 col-sm-3">
    <div class="well well-sm text-center">
      <b class="show-countify"></b>
    </div>
  </div>
  <div class="col-xs-3 col-sm-3">
    <div class="form-group">
      <select class="form-control" name="letters[]" required>
        <option disabled selected></option>
        
        <?php foreach($alphab as $letter): ?>
        <?php $selected = ($letter == $ductLetter ) ? 'selected' : '' ?>
        <option value="<?= $letter ?>" <?= $selected ?>><?= $letter ?></option>
        <?php endforeach ?>
        
      </select>
    </div>
  </div>
  <div class="col-xs-2 col-sm-3">
    <div class="form-group">
      <input class="form-control" type="number" name="meassures[]" min="4" max="12" step="2" value="<?= $ductMeassure ?>" required>
    </div>
  </div>
  <div class="col-xs-5 col-sm-3">
    <div class="checkbox">
      <label class="text-danger">
        <input type="checkbox" name="removes[]" value="<?= $d++ ?>"> DELETE DUCT
      </label>
    </div>
  </div>
  <div class="clearfix"></div>
  <?php endforeach ?>
  
</div>

<div id="fx-ducts">
  <div id="clone-original" class="row">
    <div class="col-xs-2 col-md-3">
      <div class="well well-sm text-center">
        <strong class="show-countify"></strong>
      </div>
    </div>
    <div class="col-xs-3 col-md-3">
      <div class="form-group">
        <select class="form-control" name="letters[]">
          <option label="None" disabled selected></option>
          <?php foreach($alphab as $letter): ?>
          <option value="<?= $letter ?>"><?= $letter ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-xs-2 col-md-3">
      <div class="form-group">
        <input class="form-control" type="number" name="meassures[]" min="4" max="12" step="2">
      </div>
    </div>
    <div class="col-xs-5 col-sm-3">
      <button data-remove="cloned" class="btn btn-warning hidden" type="button"><span class="glyphicon glyphicon-remove"></span> Cancel duct</button>
    </div>
  </div>
</div>
<button data-clone="fx-ducts" class="btn btn-primary" type="button">
	<span class="glyphicon glyphicon-plus"></span>
	<span>Add duct</span>
</button>
<hr>