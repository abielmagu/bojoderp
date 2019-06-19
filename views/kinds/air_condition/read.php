<?php 
$details = $work['details'];
$componentsCount = count($details['components']);
$answer = array('No', 'Yes');
?>

<h4>Equipment</h4>
<div class="row">
  <div class="col-md-4">
    <label>Complete</label>
    <div class="well well-sm text-center"><?= ucfirst($details['complete']) ?></div>
  </div>
  <div class="col-md-4">
    <label>Type unit</label>
    <div class="well well-sm text-center"><?= ucfirst($details['type_unit']) ?></div>
  </div>
  <div class="col-md-4">
    <label>Code permit</label>
    <div class="well well-sm text-center"><?= $details['code_permit'] ?></div>
  </div>
</div>

<br><br>
<h4>Verification</h4>
<div class="row">
  <div class="col-md-3">
    <label style="margin-bottom: 2.5rem"><i>Disconnect box</i></label>
    <div class="well well-sm text-center"><?= $answer[ $details['disconnect_box'] ] ?></div>
  </div>
  <div class="col-md-3">
    <label><i>Rewire condenser to existing electrical breaker box</i></label>
    <div class="well well-sm text-center"><?= $answer[ $details['rewire_condenser'] ] ?></div>
  </div>
  <div class="col-md-3">
    <label><i>Rewire furnance or air handler to existing disconnect box</i></label>
    <div class="well well-sm text-center"><?= $answer[ $details['rewire_furnance'] ] ?></div>
  </div>
  <div class="col-md-3">
    <label><i>Reconnect gas line to existing gas line house or building</i></label>
    <div class="well well-sm text-center"><?= $answer[ $details['reconnect_gas'] ] ?></div>
  </div>
  <div class="col-sm-12"><br></div>
  <div class="col-md-3">
    <label style="margin-bottom: 2.5rem"><i>Closet and door</i></label>
    <div class="well well-sm text-center"><?= $answer[ $details['closet_door'] ] ?></div>
  </div>
  <div class="col-md-3">
    <label style="margin-bottom: 2.5rem"><i>Ladder</i></label>
    <div class="well well-sm text-center"><?= $answer[ $details['ladder'] ] ?></div>
  </div>
  <div class="col-md-3">
    <label style="margin-bottom: 2.5rem"><i>Codes of permits or inspection</i></label>
    <div class="well well-sm text-center"><?= $answer[ $details['codes_inspections'] ] ?></div>
  </div>
  <div class="col-md-3">
    <label><i>All work done according to existing gov. jurisdiction</i></label>
    <div class="well well-sm text-center"><?= $answer[ $details['done_jurisdiction'] ] ?></div>
  </div>
</div>

<br><br>
<h4>Warranty</h4>
<div class="row">
  <div class="col-sm-3">
    <label>Compresor</label>
    <div class="well well-sm text-center"><?= $details['warranty_compresor'] ?></div>
  </div>
  <div class="col-sm-3">
    <label>Evaporator</label>
    <div class="well well-sm text-center"><?= $details['warranty_evaporator'] ?></div>
  </div>
  <div class="col-sm-3">
    <label>Heat exchanger</label>
    <div class="well well-sm text-center"><?= $details['warranty_heat_exchanger'] ?></div>
  </div>
  <div class="col-sm-3">
    <label>Labor</label>
    <div class="well well-sm text-center"><?= $details['warranty_labor'] ?></div>
  </div>
  <div class="col-sm-3">
    <label>Manufacturer</label>
    <div class="well well-sm text-center"><?= $details['warranty_manufacturer'] ?></div>
  </div>
  <div class="col-sm-3">
    <label>Parts</label>
    <div class="well well-sm text-center"><?= $details['warranty_parts'] ?></div>
  </div>
  <div class="col-sm-3">
    <label>Maintenance</label>
    <div class="well well-sm text-center"><?= $details['warranty_maintenance'] ?></div>
  </div>
</div>

<br>
<h4>Components <span class="badge"><?= $componentsCount ?></span></h4>
<div class="table-responsive">
	<table class="table table-bordered table-condensed table-striped table-hover table-counter">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th>Name</th>
				<th>Quantity</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($details['components'] as $component): ?>
			<tr>
				<td class="text-center text-muted"></td>
				<td><?= $component['name'] ?></td>
				<td><?= $component['quantity'] ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
</div>
<br>
