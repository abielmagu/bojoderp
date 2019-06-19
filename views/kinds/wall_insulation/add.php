<?php $methodsArray = $GLOBALS['wallInsulations'] ?>

<div class="row">
  <div class="col-sm-3">
    <div class="form-group">
      <label>Method</label>
      <select id="insulation-methods" class="form-control" name="method" required>
        <option disabled selected></option>
        <?php foreach($methodsArray as $method => $rvalues): ?>
        <option value="<?= $method ?>"><?= $method ?></option>
        <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>R-Value</label>
      <select id="insulation-rvalues" class="form-control" name="rvalue" required>
        <option selected disabled></option>
        <?php foreach($methodsArray as $method => $rvalues): ?>
        <optgroup label="<?= $method ?>" class="hidden">
         	<?php foreach($rvalues as $rv => $score): ?>
          <option value="<?= $rv ?>" data-score="<?= $score ?>"><?= $rv ?></option><?php //750 ?>
        	<?php endforeach ?>
        </optgroup>
        <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Square feets</label>
      <input id="insulation-sqfts" class="form-control" name="sqfts" min="0" step="0.01" value="0" type="number" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Bags</label>
      <input id="insulation-bags" class="form-control" name="bags" min="0" value="0" type="number" readonly required>
    </div>
  </div>
</div>

<?php 
/*
<optgroup label="Airkrete" class="hidden">
	<option value="R-21" data-score="0">R-21 (2x4)</option><?php //750 ?>
	<option value="R-33" data-score="0">R-33 (2x6)</option><?php //550 ?>
</optgroup>
<optgroup label="Blown" class="hidden">
	<option value="R-15" data-score="75.4">R-15 (2x4)</option>
	<option value="R-21" data-score="55.4">R-21 (2x6)</option>
</optgroup>
<optgroup label="Cellulose" class="hidden">
	<option value="R-13" data-score="72.5">R-13 (2x4)</option>
	<option value="R-15" data-score="61.5">R-15 (2x6)</option>
</optgroup>
<optgroup label="Foam" class="hidden">
	<option value="R-13" data-score="0">R-13 (2x4)</option>
	<option value="R-19" data-score="0">R-19 (2x6)</option>
</optgroup>
*/
?>