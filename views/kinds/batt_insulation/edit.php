<?php $methodsArray = $GLOBALS['battInsulations'] ?>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Method</label>
      <select id="insulation-methods" class="form-control" name="method" required>
       	<option disabled selected></option>
       	
        <?php foreach($methodsArray as $method => $rvalues ): ?>
        <?php $selected = ($method === $details['method']) ? 'selected' : false ?>
        <option value="<?= $method ?>" <?= $selected ?>><?= $method ?></option>
        <?php endforeach ?>
        
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>R-Value</label>
      <select id="insulation-rvalues" class="form-control" name="rvalue" required>
        <option disabled selected></option>

        <?php foreach($methodsArray as $method => $rvalues): ?>
        <?php $hidden = ($method != $details['method']) ? 'hidden' : '' ?>
          <optgroup label="<?= $method ?>" class="<?= $hidden ?>">
          <?php foreach($rvalues as $item): ?>
					<?php $selected = (empty($hidden) && $item == $details['rvalue']) ? 'selected' : '' ?>
            <option value="<?= $item ?>" <?= $selected ?>><?= $item ?></option>
          <?php endforeach ?>
          </optgroup>
        <?php endforeach ?>

      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Square feets</label>
      <input value="<?= $details['square_feets'] ?>" class="form-control" name="sqfts" min="0" step="0.01" type="number" required>
    </div>
  </div>  
  <div class="clearfix"></div>
  <div class="col-md-3">
    <label>Facing</label>
    <div class="radio">
     	<?php 
				$facing = array('face' => '', 'unface' => '');
				$facing[$details['facing']] = 'checked';
			?>
      <label><input name="facing" value="face" type="radio" <?= $facing['face'] ?>>Face</label>
      <label class="margin-lg-left"><input name="facing" value="unface" type="radio" <?= $facing['unface'] ?>>Unface</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Size</label>
    <div class="radio">
     	<?php  
				$size = array('big' => '', 'small' => '');
				$size[$details['size']] = 'checked';
			?>
      <label><input name="size" value="big" type="radio" <?= $size['big'] ?>>Big</label>
      <label class="margin-lg-left"><input name="size" value="small" type="radio" <?= $size['small'] ?>>Small</label>
    </div>
  </div>
</div>
<br>