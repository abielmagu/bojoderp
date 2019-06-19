<?php $details = $work['details'] ?>
<div class="row">
  <div class="col-sm-4">
    <label>Serial number</label>
    <div class="well well-sm text-center"><?= $details['number_serial'] ?></div>
  </div>
  <div class="col-sm-4">
    <label>Model</label>
    <div class="well well-sm text-center"><?= $details['model'] ?></div>
  </div>
  <div class="col-sm-4">
    <label>Cover date</label>
    <div class="well well-sm text-center">
      <?php list($coverDate, $coverTime) = explode(' ', $details['cover_at']) ?>
      <?= $coverDate ?>
    </div>
  </div>
</div>
