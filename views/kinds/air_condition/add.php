<?php $components = $GLOBALS['components'] ?>

<h4>Equipment</h4>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label>Complete</label>
      <select class="form-control" name="complete" required>
        <option disabled selected></option>
        <option value="system">System</option>
        <option value="change out">Change out</option>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Type unit</label>
      <select class="form-control" name="typeUnit" required>
        <option disabled selected></option>
        <option value="gas">Gas</option>
        <option value="electric">Electric</option>
        <option value="heat pump">Heat pump</option>
      </select>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <label>Code permit</label>
      <input class="form-control" type="text" name="codePermit" required>
    </div>
  </div>
</div>

<h4>Verification</h4>
<div class="row">
  <div class="col-md-3">
    <label>Disconnect box</label>
    <div class="radio">
      <label><input name="disconnectBox" value="1" type="radio" checked>Yes</label>
      <label class="margin-left"><input name="disconnectBox" value="0" type="radio">No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Rewire condenser to existing electrical breaker box</label>
    <div class="radio">
      <label><input name="rewireCondenser" value="1" type="radio" checked>Yes</label>
      <label class="margin-left"><input name="rewireCondenser" value="0" type="radio">No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Rewire furnance or air handler to existing disconnect box</label>
    <div class="radio">
      <label><input name="rewireFurnance" value="1" type="radio" checked>Yes</label>
      <label class="margin-left"><input name="rewireFurnance" value="0" type="radio">No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Reconnect gas line to existing gas line house or building</label>
    <div class="radio">
      <label><input name="reconnectGas" value="1" type="radio" checked>Yes</label>
      <label class="margin-left"><input name="reconnectGas" value="0" type="radio">No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Closet and door</label>
    <div class="radio">
      <label><input name="closetDoor" value="1" type="radio" checked>Yes</label>
      <label class="margin-left"><input name="closetDoor" value="0" type="radio">No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Ladder</label>
    <div class="radio">
      <label><input name="ladder" value="1" type="radio" checked>Yes</label>
      <label class="margin-left"><input name="ladder" value="0" type="radio">No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>Codes of permits or inspection</label>
    <div class="radio">
      <label><input name="codesInspections" value="1" type="radio" checked>Yes</label>
      <label class="margin-left"><input name="codesInspections" value="0" type="radio">No</label>
    </div>
  </div>
  <div class="col-md-3">
    <label>All work done according to existing gov. jurisdiction</label>
    <div class="radio">
      <label><input name="doneJurisdiction" value="1" type="radio" checked>Yes</label>
      <label class="margin-left"><input name="doneJurisdiction" value="0" type="radio">No</label>
    </div>
  </div>
</div>

<h4>Warranty</h4>
<div class="row">
  <div class="col-sm-3">
    <div class="form-group">
      <label>Compresor</label>
      <input class="form-control" type="number" name="warrantyCompresor" min="0" value="0" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Evaporator</label>
      <input class="form-control" type="number" name="warrantyEvaporator" min="0" value="0" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Heat exchanger</label>
      <input class="form-control" type="number" name="warrantyHeatExchanger" min="0" value="0" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Labor</label>
      <input class="form-control" type="number" name="warrantyLabor" min="0" value="0" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Manufacturer</label>
      <input class="form-control" type="number" name="warrantyManufacturer" min="0" value="0" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Parts</label>
      <input class="form-control" type="number" name="warrantyParts" min="0" value="0" required>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="form-group">
      <label>Maintenance</label>
      <input class="form-control" type="number" name="warrantyMaintenance" min="0" value="0" required>
    </div>
  </div>
</div>

<h4>Components</h4>
<div id="ac-components">
  <div id="clone-original" class="row">
    <div class="col-sm-8">
      <div class="form-group">
        <label>Type</label>
        <select class="form-control" name="addComponentsName[]" required>
          <option disabled selected></option>
					<?php foreach($components as $component): ?>
      		<option value="<?= $component ?>"><?= $component ?></option>
       		<?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label>Quantity</label>
        <input class="form-control" name="addComponentsQuantity[]" type="number" min="0" value="0" required>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group" style="padding-top: 2.4rem">
        <button data-remove="cloned" class="btn btn-warning btn-block hidden" type="button"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
      </div>
    </div>
  </div>
</div>
<button data-clone="ac-components" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-plus"></span> Add component</button>