<?php $details = $work['details'] ?>

<div class="row">
  <div class="col-sm-4">
    <label>Method</label>
    <div class="well well-sm text-center"><?= ucfirst($details['method']) ?></div>
  </div>
  <div class="col-sm-4">
    <label>R-Value</label>
    <div class="well well-sm text-center"><?= $details['rvalue'] ?></div>
  </div>
  <div class="col-sm-4">
    <label>Square feets</label>
    <div class="well well-sm text-center"><?= $details['square_feets'] ?></div>
  </div>
  <div class="col-sm-6">
    <label>Facing</label>
    <div class="well well-sm text-center"><?= ucfirst($details['facing']) ?></div>
  </div>
  <div class="col-sm-6">
    <label>Size</label>
    <div class="well well-sm text-center"><?= ucfirst($details['size']) ?></div>
  </div>
</div>
