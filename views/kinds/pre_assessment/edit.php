<?php
$preassessments = array(
	'Air condition', 
	'Central furnance', 
	'Insulation', 
	'Minisplit', 
	'Wall furnance'
);
?>
<div class="form-group">
  <label>Pre-assesment type</label>
  <select class="form-control" name="kindpreassessment" required>
    <option disabled></option>

    <?php foreach($preassessments as $kind): ?>
    <?php $selected = ($kind === $details['kind']) ? 'selected' : '' ?>
    <option value="<?= $kind ?>" <?= $selected ?>><?= $kind ?></option>
    <?php endforeach ?>

  </select>
</div>
<br>