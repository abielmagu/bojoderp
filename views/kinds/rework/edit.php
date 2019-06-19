<?php 
$reworks = array(
	'Air condition',
	'Central furnance', 
	'Insulation',
	'Minisplit',
	'Wall furnance'
);
?>

<div class="form-group">
  <label>Rework ype</label>
  <select class="form-control" name="kindrework" required>
    <option disabled></option>

    <?php foreach($reworks as $kind): ?>
    <?php $selected = ($kind === $details['kind']) ? 'selected' : '' ?>
    <option value="<?= $kind ?>" <?= $selected ?>><?= $kind ?></option>
    <?php endforeach ?>

  </select>
</div>
<br>