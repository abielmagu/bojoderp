<?php $details = $work['details'] ?>

<div class="row">
  <div class="col-sm-2">
    <label>Serial</label>
    <div class="well well-sm text-center"><?= $details['serial_number'] ?></div>
  </div>
  <div class="col-sm-2">
    <label>Model</label>
    <div class="well well-sm text-center"><?= $details['model'] ?></div>
  </div>
  <div class="col-sm-2">
    <label>Tons</label>
    <div class="well well-sm text-center"><?= $details['tons'] ?></div>
  </div>
  <div class="col-sm-2">
    <label>Type</label>
    <div class="well well-sm text-center"><?= ucfirst($details['kind']) ?></div>
  </div>
  <div class="col-sm-2">
    <label>Platform</label>
    <?php $answer = array(0 => 'No', 1 => 'Yes')  ?>
    <div class="well well-sm text-center"><?= $answer[ $details['platform'] ] ?></div>
  </div>
</div>
