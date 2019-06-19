<div class="panel panel-default box-nobreak">
	<div class="panel-heading">
		<h4>Summary of intermediaries</h4>
	</div>
	<div class="panel-body">
	<?php if($intermediaries): ?>
		<br>
		<div class="row">
			<div class="col-xs-7">
				<div id="donut-intermediaries-print" style="height: 350px; width: 700px"></div>
				<?php
					$donutColors = array('#45C51A', '#EEE82C', '#ff9914', '#f21b3f', '#a80874', '#ff37a6', '#2708a0', '#246eb9', '#44BDE1', '#454955');
					$colorsJson  = json_encode($donutColors);
					$counters 	 = [];
					$intermsDonut = [];
					foreach($intermediaries as $id => $values)
					{
						$nick = html_entity_decode($values['nick']);
						$name = html_entity_decode($values['name']);
						$total = $values['total'];
						$array = ['label' => '', 'value' => $total];
						array_push($counters, $array);
						$intermsDonut[ $name ] = $total;
					}
					reset($donutColors);
					$countersJson = json_encode($counters);
				?>
				<script type="text/javascript">
					Morris.Donut({
						resize: true,
						redraw: true,
						element: 'donut-intermediaries-print',
						colors: <?= $colorsJson ?>,
						data: <?= $countersJson ?>
					});
				</script>
			</div>
			<div class="col-xs-5">
				<br>
				<p><b>List of companies:</b></p>
				<ul style="margin: 0; padding: 0">			
					<?php foreach($intermsDonut as $name => $total): ?>
					<li style="list-style-type: none">
						<span class="glyphicon glyphicon-stop" style="color: <?= current($donutColors) ?>"></span>
						<span class="badge"><?= $total ?></span>
						<span><?= $name ?></span>
					</li>
					<?php next($donutColors) ?>
				<?php endforeach ?>   
				</ul>
			</div>
		</div>
		<br>
	<?php else: ?>
		<p class="text-center text-muted display-4">No summary intermediaries</p>
	<?php endif ?>
	</div>
</div>


<div class="panel panel-default box-nobreak">
	<div class="panel-heading">
		<h4>Details by intermediaries</h4>
	</div>
	<div class="panel-body">
	<?php if($intermediaries): ?>
		<div class="table-responsive" style="font-size:0.8rem">
			<table class="table table-condensed table-striped table-bordered table-hover text-center">
				<thead>
					<tr>
						<th></th>
						<?php foreach($intermediaries as $id => $values): ?>
						<th class="text-center"><?= html_entity_decode($values['name']) ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach($kinds as $kind => $title): ?>
					<tr>
						<td class="nowrap"><?= $title ?></td>
						<?php foreach($intermediaries as $id => $values): ?>
						<?php if( array_key_exists($kind, $values['works']) ): ?>
						<td class="bg-success"><b><?= $values['works'][ $kind ] ?></b></td>
						<?php else: ?>
						<td class="text-muted">0</td>
						<?php endif ?>
						<?php endforeach ?>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	<?php else: ?>
		<p class="text-center text-muted display-4">No details intermediaries</p>
	<?php endif ?>
	</div>
</div>