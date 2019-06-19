<?php
$piecesArray = $GLOBALS['pieces'];
$details = $work['details'];
$piecesCount = count($details['pieces']);
$p = 1;
?>

<label>Application permit #</label>
<p class="well well-sm text-center"><?= $details['permit_serial'] ?></p>
<h4>Pieces <span class="badge"><?= $piecesCount ?></span></h4>
<div class="table-responsive">
	<table class="table table-bordered table-condensed table-striped table-hover table-counter">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th>Type</th>
				<th>Number serial</th>
				<th>Brand</th>
				<th>Placement</th>
			</tr>
		</thead>
		<tbody>	
		<?php foreach($details['pieces'] as $piece): ?>
			<tr>
				<td class="text-center text-muted"></td>
				<td><?= $piecesArray[ $piece['kind'] ] ?></td>
				<td><?= $piece['number_serial'] ?></td>
				<td><?= $piece['brand'] ?></td>
				<td><?= $piece['placement'] ?></td>
			</tr>
		<?php endforeach ?>
		</tbody>
	</table>
</div>
<br>