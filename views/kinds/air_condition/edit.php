<?php $components = $GLOBALS['components'] ?>

<h4>Equipment</h4>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Complete</label>
      <select class="form-control" name="complete" required>
        <option disabled selected></option>
        <?php $completeArray = array('system','change out') ?>
        <?php foreach($completeArray as $complete): ?>
        <?php $select = ($complete === $details['complete']) ? 'selected' : '' ?>
        <option value="<?= $complete ?>" <?= $select ?>><?= ucfirst($complete) ?></option>
        <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Type unit</label>
      <select class="form-control" name="typeUnit" required>
        <option disabled selected></option>
        <?php $unitArray = array('gas','electric','heat pump') ?>
        <?php foreach($unitArray as $unit): ?>
        <?php $select = ($unit === $details['type_unit']) ? 'selected' : '' ?>
        <option value="<?= $unit ?>" <?= $select ?>><?= ucfirst($unit) ?></option>
        <?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Code permit</label>
      <input class="form-control" type="text" name="codePermit" value="<?= $details['code_permit'] ?>" required>
    </div>
  </div>
</div>
<br>

<h4>Verify</h4>
<div class="row">
  <div class="col-md-3">
    <label>Disconnect box</label>
    <div class="radio">
      <?php
			$disconnect_box = array(0 => '', 1 => '');
			$disconnect_box[$details['disconnect_box']] = 'checked';
      ?>
      <label><input name="disconnectBox" value="1" type="radio" <?= $disconnect_box[1] ?>>Yes</label>
      <label class="margin-lg-left"><input name="disconnectBox" value="0" type="radio" <?= $disconnect_box[0] ?>>No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Rewire condenser to existing electrical breaker box</label>
    <div class="radio">
      <?php
			$rewire_condenser = array(0 => '', 1 => '');
			$rewire_condenser[$details['rewire_condenser']] = 'checked';
      ?>
      <label><input name="rewireCondenser" value="1" type="radio" <?= $rewire_condenser[1] ?>>Yes</label>
      <label class="margin-lg-left"><input name="rewireCondenser" value="0" type="radio" <?= $rewire_condenser[0] ?>>No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Rewire furnance or air handler to existing disconnect box</label>
    <div class="radio">
      <?php
			$rewire_furnance = array(0 => '', 1 => '');
			$rewire_furnance[$details['rewire_furnance']] = 'checked';
      ?>
      <label><input name="rewireFurnance" value="1" type="radio" <?= $rewire_furnance[1] ?>>Yes</label>
      <label class="margin-lg-left"><input name="rewireFurnance" value="0" type="radio" <?= $rewire_furnance[0] ?>>No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Reconnect gas line to existing gas line house or building</label>
    <div class="radio">
      <?php
			$reconnect_gas = array(0 => '', 1 => '');
			$reconnect_gas[$details['reconnect_gas']] = 'checked';
      ?>
      <label><input name="reconnectGas" value="1" type="radio" <?= $reconnect_gas[1] ?>>Yes</label>
      <label class="margin-lg-left"><input name="reconnectGas" value="0" type="radio" <?= $reconnect_gas[0] ?>>No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Closet and door</label>
    <div class="radio">
      <?php
			$closet_door = array(0 => '', 1 => '');
			$closet_door[$details['closet_door']] = 'checked';
      ?>
      <label><input name="closetDoor" value="1" type="radio" <?= $closet_door[1] ?>>Yes</label>
      <label class="margin-lg-left"><input name="closetDoor" value="0" type="radio" <?= $closet_door[0] ?>>No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Ladder</label>
    <div class="radio">
      <?php
			$ladder = array(0 => '', 1 => '');
			$ladder[$details['ladder']] = 'checked';
      ?>
      <label><input name="ladder" value="1" type="radio" <?= $ladder[1] ?>>Yes</label>
      <label class="margin-lg-left"><input name="ladder" value="0" type="radio" <?= $ladder[0] ?>>No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Codes of permits or inspection</label>
    <div class="radio">
      <?php
			$codes_inspections = array(0 => '', 1 => '');
			$codes_inspections[$details['codes_inspections']] = 'checked';
      ?>
      <label class="margin-sm-right"><input name="codesInspections" value="1" type="radio" <?= $codes_inspections[1] ?>>Yes</label>
      <label><input name="codesInspections" value="0" type="radio" <?= $codes_inspections[0] ?>>No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>All work done according to existing gov. jurisdiction</label>
    <div class="radio">
      <?php
			$done_jurisdiction = array(0 => '', 1 => '');
			$done_jurisdiction[$details['done_jurisdiction']] = 'checked';
      ?>
      <label class="margin-sm-right"><input name="doneJurisdiction" value="1" type="radio" <?= $done_jurisdiction[1] ?>>Yes</label>
      <label><input name="doneJurisdiction" value="0" type="radio" <?= $done_jurisdiction[0] ?>>No</label>
    </div>
  </div>
</div>
<br>

<h4>Warranty</h4>
<div class="row">
  <div class="col-sm-3">
    <div class="form-group">
      <label>Compresor</label>
      <input class="form-control" type="number" name="warrantyCompresor" min="0" value="<?= $details['warranty_compresor'] ?>" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Evaporator</label>
      <input class="form-control" type="number" name="warrantyEvaporator" min="0" value="<?= $details['warranty_evaporator'] ?>" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Heat exchanger</label>
      <input class="form-control" type="number" name="warrantyHeatExchanger" min="0" value="<?= $details['warranty_heat_exchanger'] ?>" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Labor</label>
      <input class="form-control" type="number" name="warrantyLabor" min="0" value="<?= $details['warranty_labor'] ?>" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Manufacturer</label>
      <input class="form-control" type="number" name="warrantyManufacturer" min="0" value="<?= $details['warranty_manufacturer'] ?>" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Parts</label>
      <input class="form-control" type="number" name="warrantyParts" min="0" value="<?= $details['warranty_parts'] ?>" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Maintenance</label>
      <input class="form-control" type="number" name="warrantyMaintenance" min="0" value="<?= $details['warranty_maintenance'] ?>" required>
    </div>
  </div>
</div>
<br>

<h4>Components</h4>
<?php if(count($details['components'])): ?>
<div class="row">
 	<?php $i = 0 ?>
  <?php foreach($details['components'] as $componentAC): $i++ ?>
  <div class="col-sm-8">
    <div class="form-group">
      <label>Type</label>
      <select class="form-control" name="setComponents[<?= $i ?>][name]" required>
       
        <?php foreach($components as $componentItem): ?>
        <?php $selected = ($componentItem == $componentAC['name']) ? 'selected' : '' ?>
        <option value="<?= $componentItem ?>" <?= $selected ?>><?= $componentItem ?></option>
        <?php endforeach ?>
        
      </select>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="form-group">
      <label>Quantity</label>
      <input class="form-control" name="setComponents[<?= $i ?>][quantity]" type="number" min="0" value="<?= $componentAC['quantity'] ?>" required>
    </div>
  </div>
  <div class="col-sm-2">
    <div class="checkbox">
      <span style="display: block; margin-bottom: 3.4rem"></span>
      <label class="text-danger">
        <input type="checkbox" name="setComponents[<?= $i ?>][remove]" value="1"><b>DELETE</b>
        <input type="hidden" name="setComponents[<?= $i ?>][needle]" value="<?= $componentAC['id'] ?>">
      </label>
    </div>
  </div>
<?php endforeach ?>
</div>
<?php endif ?>

<div id="ac-components">
  <div id="clone-original" class="row">
    <div class="col-sm-8">
      <div class="form-group">
        <label>Type</label>
        <select class="form-control" name="addComponentsName[]">
          <option disabled label="None" selected></option>
		 			<?php foreach($components as $componentItem): ?>
					<option value="<?= $componentItem ?>"><?= $componentItem ?></option>
       		<?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label>Quantity</label>
        <input class="form-control" name="addComponentsQuantity[]" type="number" min="0" value="0">
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group text-right" style="padding-top: 2.4rem">
        <button data-remove="cloned" class="btn btn-warning btn-block hidden" type="button">
        	<span class="glyphicon glyphicon-remove"></span>
        	<span>Cancel</span>
        </button>
      </div>
    </div>
  </div>
</div>
<button data-clone="ac-components" class="btn btn-primary" type="button">
	<span class="glyphicon glyphicon-plus"></span>
	<span>Add component</span>
</button>
<hr>
