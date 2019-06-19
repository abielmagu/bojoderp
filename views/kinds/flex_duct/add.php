<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label>Plenum</label>
      <input class="form-control" type="number" name="plenum" min="1" max="3" value="1" required>
      <p><small class="help-block">Maximum = 3</small></p>
    </div>
  </div>
  <div class="col-md-6 form-group">
    <div class="form-group">
      <label>Tape feets</label>
      <input class="form-control" type="number" name="tapeFeets" min="1" max="500" value="1" required>
      <p><small class="help-block">Maximum = 500</small></p>
    </div>
  </div>
  <div class="col-sm-12 countify">
    <div class="row">
      <div class="col-sm-3">
        <label># Duct</label>
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
<div id="fx-ducts" class="countify">
  <div id="clone-original" class="row">
    <div class="col-xs-2 col-sm-3">
      <div class="well well-sm text-center">
        <strong class="show-countify"></strong>
      </div>
    </div>
    <div class="col-xs-3">
      <div class="form-group">
        <select class="form-control" name="letters[]" required>
          <option disabled selected></option>
          <?php $alphab = range('A','Z');
          foreach( $alphab as $letter ):
            ?>
            <option value="<?= $letter ?>"><?= $letter ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-xs-2 col-sm-3">
      <div class="form-group">
        <input class="form-control" type="number" name="meassures[]" min="4" max="12" step="2" value="0" required>
      </div>
    </div>
    <div class="col-xs-5 col-sm-3">
      <button data-remove="cloned" class="btn btn-warning hidden" type="button"><span class="glyphicon glyphicon-remove"></span> Cancel duct</button>
    </div>
  </div>
</div>
<button data-clone="fx-ducts" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-plus"></span> Add duct</button>