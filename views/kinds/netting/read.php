<?php $details = $work['details'] ?>
<div class="row">
  <div class="col-xs-12 col-sm-4">
    <label>Square feets</label>
    <div class="well well-sm text-center"><?= $details['square_feets'] ?></div>
  </div>
  <div class="col-xs-6 col-sm-4">
    <label>Attic</label>
		<?php $answerAttic = array('No', 'Yes') ?>
    <div class="well well-sm text-center"><?= $answerAttic[ $details['attic'] ] ?></div>
  </div>
  <div class="col-xs-6 col-sm-4">
    <label>Wall</label>
		<?php $answerWall = array('No', 'Yes') ?>
    <div class="well well-sm text-center"><?= $answerWall[ $details['wall'] ] ?></div>
  </div>
</div>
