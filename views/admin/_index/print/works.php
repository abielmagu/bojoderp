<?php if( !isset($_GET['from']) || !isset($_GET['to']) ): ?>
<div class="row">
	<div class="col-xs-4">
		<div class="panel panel-default text-center">
			<div class="panel-heading">
				<h4>Today works</h4>
			</div>
			<div class="panel-body">
				<span style="font-size: 4rem"><?= $worksDayCount ?></span>
			</div>
		</div>
	</div>
	<div class="col-xs-4">
		<div class="panel panel-default text-center">
			<div class="panel-heading">
				<h4><?= date('F') ?> works</h4>
			</div>
			<div class="panel-body">
				<span style="font-size: 4rem"><?= $worksMonthCount ?></span>
			</div>
		</div>
	</div>
	<div class="col-xs-4">
		<div class="panel panel-default text-center">
			<div class="panel-heading">
				<h4><?= date('Y') ?> works</h4>
			</div>
			<div class="panel-body">
				 <span style="font-size: 4rem"><?= $worksYearCount ?></span>
			</div>
		</div>
	</div>
</div>
<?php endif ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4>Progress</h4>
	</div>
	<div class="panel-body">
		<h5>Works</h5>
		<?php $completed = $worksClosed + $worksCancelled ?>
		<?php $percentWorks = Helper::percentage($worksCount, $completed) ?>
		<div class="progress">
			<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?= $percentWorks ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentWorks ?>%;">
			<?= $percentWorks ?>%
			<span class="sr-only"><?= $percentWorks ?>% Complete</span>
			</div>
		</div>
		
		<h5>Inspections</h5>
		<?php $completed = $inspectionsPassed + $inspectionsFailed ?>
		<?php $percentInspections = Helper::percentage($inspectionsCount, $completed) ?>
		<div class="progress">
			<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?= $percentInspections ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentInspections ?>%;">
			<?= $percentInspections ?>%
			<span class="sr-only"><?= $percentInspections ?>% Complete</span>
			</div>
		</div>		
		
		<h5>Warranty</h5>
		<?php $completed = $guaranteesDone ?>
		<?php $percentGuarantees = Helper::percentage($guaranteesCount, $completed) ?>
		<div class="progress">
			<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?= $percentGuarantees ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentGuarantees ?>%;">
			<?= $percentGuarantees ?>%
			<span class="sr-only"><?= $percentGuarantees ?>% Complete</span>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-default box-nobreak">
	<div class="panel-heading">
		<h4>Counters</h4>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th class="text-center">Pending works</th>
						<th class="text-center">Cancelled works</th>
						<th class="text-center">Completed works</th>
						<th class="text-center">Total works</th>
						<th class="text-center">Inspections</th>
						<th class="text-center">Guarantees</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-center lead"><?= $worksPending ?></td>
						<td class="text-center lead"><?= $worksCancelled ?></td>
						<td class="text-center lead"><?= $worksClosed ?></td>
						<td class="text-center lead"><?= $worksCount ?></td>
						<td class="text-center lead"><?= $inspectionsCount ?></td>
						<td class="text-center lead"><?= $guaranteesCount ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="panel panel-default box-nobreak">
	<div class="panel-heading">
		<h4>Types of works</h4>
	</div>
	<div class="panel-body">
	<?php if($worksKind): ?>
		<div id="bars-types-works-print" style="height: 300px; width: 1000px"></div>
		<?php
			$max = 0;
			$counters = [];
			$works = [];
			foreach($worksKind as $key => $value)
			{
				$title = ucfirst( str_replace('_', ' ', $key) );
				$array = ['x' => $title, 'v' => $value];				
				array_push($counters, $array);
				$max = ($value <= $max) ? $max : $value;
				$works[ $title ] = $value;
			}
			$countersJson = json_encode($counters);
			$ymax	= $max + round($max / 4);
		?>
			<script type="text/javascript">
				new Morris.Bar({
//			  barColors: ['#45C51A'],
					redraw: true,
					resize: true,
					element: 'bars-types-works-print',
					labels: ['Works'],
					xLabelAngle: 90,
					xkey: 'x',
					ykeys: ['v'],
					data: <?= $countersJson ?>,
					ymax: <?= $ymax ?>
				});
			</script>
		<br>
		<p><b class="text-danger">*</b> If the type of work does not appear, because its empty.</p>
		<br>
		<table class="table table-bordered table-condensed" style="font-size:1rem">
			<thead>
				<tr>
				<?php foreach($works as $title => $value): ?>
					<th class="text-center"><?= $title ?></th>
				<?php endforeach ?>
				</tr>
			</thead>
			<tbody>
				<tr class="text-center">
				<?php foreach($works as $title => $value): ?>
					<td><?= $value ?></td>
				<?php endforeach ?>
				</tr>
			</tbody>
		</table>
		
	<?php else: ?>
		<p class="text-center text-muted display-4">0 works</p>
		
	<?php endif ?>
	</div>
</div>