<div class="panel panel-default">
	<div class="panel-heading">
		<h4>ZIP Codes calculated <span class="label label-primary pull-right"><?= $worksZip['total'] ?></span></h4>
	</div>
	<div class="panel-body">
	<?php if($worksZip['total']): ?>
		<div class="table-responsive">
			<table class="table table-condensed table-striped table-hover text-center" style="width: 100%">
				<thead>
					<tr>
						<th></th>
						<?php foreach($kinds as $kind => $title): ?>
						<th class="text-center"><?= $title ?></th>
						<?php endforeach ?>
						<th>TOTAL</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($worksZip['codes'] as $code => $values): ?>
					<tr>
						<td><?= $code ?></td>
						<?php foreach($kinds as $kind => $title): ?>
						<?php $count = ( array_key_exists($kind, $values['works']) ) ? $values['works'][ $kind ] : 0 ?>
						
						<?php if($count): ?>
						<td class="bg-info" title="<?= $code.': '.$title ?>">
							<b data-toggle="tooltip" data-placement="top" title="<?= $code.' / '.$title.' = '.$count ?>"><?= $count ?></b>
						</td>
						<?php else: ?>
						<td class="text-muted"><?= $count ?></td>
						<?php endif ?>
						
						<?php endforeach ?>
						<td class="bg-success" data-toggle="tooltip" data-placement="left" title="<?= $code.' | TOTAL' ?>">
							<b ><?= $values['total'] ?></b>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	<?php else: ?>
		<p class="text-center text-muted display-4">0 zip codes calculated</p>
	<?php endif ?>
	</div>
</div>