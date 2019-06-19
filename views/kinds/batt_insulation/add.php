<?php $methodsArray = $GLOBALS['battInsulations'] ?>

 <div class="row">
  <div class="col-sm-4">
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
  <div class="col-sm-4">
    <div class="form-group">
      <label>R-Value</label>
      <select id="insulation-rvalues" class="form-control" name="rvalue" required>
        <option selected disabled></option>
        
        <?php foreach($methodsArray as $method => $rvalues): ?>
        <optgroup label="<?= $method ?>" class="hidden">
        	<?php foreach($rvalues as $rv): ?>
          <option value="<?= $rv ?>"><?= $rv ?></option>
          <?php endforeach ?>
        </optgroup>
        <?php endforeach ?>
        
      </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label>Square feets</label>
      <input class="form-control" name="sqfts" min="0" step="0.01" type="number" required>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-sm-3">
    <label>Facing</label>
    <div class="radio">
      <label class="margin-sm-right"><input name="facing" value="face" type="radio" checked>Face</label>
      <label><input name="facing" value="unface" type="radio">Unface</label>
    </div>
  </div>
  <div class="col-sm-3">
    <label>Size</label>
    <div class="radio">
      <label class="margin-sm-right"><input name="size" value="big" type="radio" checked>Big</label>
      <label><input name="size" value="small" type="radio">Small</label>
    </div>
  </div>
</div>

<?php 
/*
<optgroup label="Attic" class="hidden">
	<option value="R-19">R-19</option>
	<option value="R-30">R-30</option>
	<option value="R-38">R-38</option>
</optgroup>
<optgroup label="Wall" class="hidden">
	<option value="R-13">R-13 (2x4)</option>
	<option value="R-19">R-19 (2x6)</option>
	<option value="R-38">R-38</option>
</optgroup>
<optgroup label="Underbelly" class="hidden">
	<option value="R-11">R-11</option>
	<option value="R-13">R-13</option>
	<option value="R-19">R-19</option>
	<option value="R-30">R-30</option>
	<option value="R-38">R-38</option>
	<option value="R-60">R-60</option>
</optgroup>
*/
?>