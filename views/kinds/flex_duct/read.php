<?php $details = $work['details'] ?>
<div class="row">
  <div class="col-sm-6">
    <label>Plenum</label>
    <div class="well well-sm text-center"><?= $details['plenum'] ?></div>
  </div>
  <div class="col-sm-6">
    <label>Tape feets</label>
    <div class="well well-sm text-center"><?= $details['tape_feets'] ?></div>
  </div>
</div>
<label>Ducts</label>
<div class="row">
  <?php $ducts = explode( ',', $details['ducts']) ?>
  <?php foreach($ducts as $duct): ?>
	<div class="col-sm-1">
		<div class="well well-sm text-center"><?= $duct ?></div>
	</div>
  <?php endforeach ?>
</div>
