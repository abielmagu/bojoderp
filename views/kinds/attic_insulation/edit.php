<?php $methodsArray = $GLOBALS['atticInsulations'] ?>
<div class="row">
  <div class="col-sm-3">
    <div class="form-group">
      <label>Method</label>
      <select id="insulation-methods" class="form-control" name="method" required>
        <option disabled></option>

        <?php foreach($methodsArray as $method => $rvalues): ?>
        <?php $selected = ($method === $details['method']) ? 'selected' : '' ?>
          <option value="<?= $method ?>" <?= $selected ?>><?= $method ?></option>
        <?php endforeach ?>

      </select>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>R-Value</label>
      <select id="insulation-rvalues" class="form-control" name="rvalue" required>
        <option disabled selected></option>

        <?php foreach($methodsArray as $method => $rvalues): ?>
        <?php $hidden = ($method !== $details['method']) ? 'hidden' : '' ?>
          <optgroup label="<?= $method ?>" class="<?= $hidden ?>">
            <?php foreach($rvalues as $rvalue => $score): ?>
            <?php $selected = (empty($hidden) && $rvalue == $details['rvalue']) ? 'selected' : '' ?>
            <option value="<?= $rvalue ?>" data-score="<?= $score ?>" <?= $selected ?>><?= $rvalue ?></option>
            <?php endforeach ?>
          </optgroup>
        <?php endforeach ?>

      </select>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Square feets</label>
      <input id="insulation-sqfts" value="<?= $details['square_feets'] ?>" class="form-control" name="sqfts" min="0" step="0.01" type="number" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Bags</label>
      <input id="insulation-bags" value="<?= $details['bags'] ?>" class="form-control" name="bags" min="0" type="number" readonly required>
    </div>
  </div>
</div>