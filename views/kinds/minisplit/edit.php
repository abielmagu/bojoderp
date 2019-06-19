<?php $piecesArray = $GLOBALS['pieces'] ?>
<div class="form-group">
  <label>Application permit #</label>
  <input class="form-control" type="text" name="permitSerial" value="<?= $details['permit_serial'] ?>" required>
</div>
<br>

<h4>Pieces:</h4>
<?php if($details['pieces']): $i = 0 ?>
<?php foreach($details['pieces'] as $piece):  ?>
  <div class="row">
    <div class="col-sm-3">
      <div class="form-group">
        <label>Type</label>
        <select class="form-control" name="setPieces[<?= $i ?>][kind]" required>
          <?php foreach($piecesArray as $kind => $tag): ?>
          <?php $selected = ($kind == $piece['kind']) ? 'selected' : '' ?>
          <option value="<?= $kind ?>" <?= $selected ?>><?= $tag ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label>Serial</label>
        <input class="form-control" type="text" name="setPieces[<?= $i ?>][serial]" value="<?= $piece['number_serial'] ?>" required>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label>Brand</label>
        <input class="form-control" type="text" name="setPieces[<?= $i ?>][brand]" value="<?= $piece['brand'] ?>" required>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label>Placement</label>
        <input class="form-control" type="text" name="setPieces[<?= $i ?>][placement]" value="<?= $piece['placement'] ?>" required>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="checkbox">
        <br>
        <label class="text-danger">
          <input type="checkbox" name="setPieces[<?= $i ?>][remove]" value="1"><b>DELETE PIECE</b>
          <input type="hidden" name="setPieces[<?= $i ?>][needle]" value="<?= $piece['id'] ?>">
        </label>
      </div>
    </div>
  </div>
<?php $i++; endforeach ?>
<?php endif ?>

<div id="ms-pieces">
  <div id="clone-original" class="row">
    <div class="col-sm-3">
      <div class="form-group">
        <label>Type</label>
        <select class="form-control" name="kinds[]">
          <option disabled selected></option>
          <option value="air handler">Ductless air handler</option>
          <option value="condenser">Condenser</option>
        </select>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label>Serial</label>
        <input class="form-control" type="text" name="serials[]">
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label>Brand</label>
        <input class="form-control" type="text" name="brands[]">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <label>Placement</label>
        <input class="form-control" type="text" name="placements[]">
      </div>
    </div>
    <div class="col-sm-2" style="padding-top: 2.4rem">
      <div class="form-group">
        <button data-remove="cloned" class="btn btn-warning btn-block hidden" type="button" title="Remove piece">
        	<span class="glyphicon glyphicon-remove"></span>
        	<span>Cancel</span>
        </button>
      </div>
    </div>
  </div>
</div>
<button data-clone="ms-pieces" class="btn btn-primary" type="button">
	<span class="glyphicon glyphicon-plus"></span>
	<span>Add piece</span>
</button>
<hr>