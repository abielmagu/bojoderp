<?php $methodsArray = $GLOBALS['atticInsulations'] ?>

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
        	<option value="<?= $rv ?>" data-score="<?= $score ?>"><?= $rv ?></option>
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
	<option value="R-13" data-score="168.5">R-13</option>
	<option value="R-19" data-score="109.5">R-19</option>
	<option value="R-22" data-score="94.1">R-22</option>
	<option value="R-26" data-score="79.6">R-26</option>
	<option value="R-30" data-score="68.5">R-30</option>
	<option value="R-38" data-score="51.8">R-38</option>
	<option value="R-44" data-score="44.5">R-44</option>
	<option value="R-49" data-score="39.5">R-49</option>
	<option value="R-60" data-score="31.4">R-60</option>
</optgroup>
<optgroup label="Cellulose" class="hidden">
	<option value="R-11" data-score="112.5">R-11</option>
	<option value="R-13" data-score="88.3">R-13</option>
	<option value="R-19" data-score="53.1">R-19</option>
	<option value="R-20" data-score="50.1">R-20</option>
	<option value="R-22" data-score="44.3">R-22</option>
	<option value="R-24" data-score="39.4">R-24</option>
	<option value="R-30" data-score="29.6">R-30</option>
	<option value="R-32" data-score="21.3">R-32</option>
	<option value="R-38" data-score="21.9">R-38</option>
	<option value="R-40" data-score="20.6">R-40</option>
	<option value="R-44" data-score="18.2">R-44</option>
	<option value="R-48" data-score="16.4">R-48</option>
	<option value="R-50" data-score="13.6">R-50</option>
	<option value="R-60" data-score="12.4">R-60</option>
</optgroup>
<optgroup label="Foam" class="hidden">
	<option value="R-13" data-score="0">R-13 (2x4)</option>
	<option value="R-19" data-score="0">R-19 (2x6)</option>
</optgroup>
*/
?>