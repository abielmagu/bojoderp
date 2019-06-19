<?php
$works 		   = $data['works'];
$pendingsCount = count($data['pendings']);
$colorsArray   = array('#D3C200','#0086CE','#00CEC0','#8D00CE');
$kinds 		   = $GLOBALS['works'];
$statusWork    = $GLOBALS['statusWork'];
$prevcrew 	   = '';
#$colorsReverse = array_reverse($colorsArray);
?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

<?php if($works): ?>

	<?php include_once VIEWS.'/app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row margin-lg-y">
				<div class="col-xs-9">
					<h1 class="margin-less">Works</h1>
				</div>
				<div class="col-xs-3 text-right">
					<a class="btn btn-danger" href="<?= DOMAIN ?>/works/pending">
						<span class="badge"><?= $pendingsCount ?></span>
						<span class="glyphicon glyphicon-alert hidden"></span>
						<span class="margin-sm-left hidden-xs hidden-sm">Pending works</span>
					</a>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-2">
					<form class="form-inline" id="prioritize" action="<?= DOMAIN ?>/works/prioritize" method="post">
						<input type="hidden" name="date" value="<?= $data['date'] ?>">
						<button class="btn btn-success" type="submit">
							<span class="glyphicon glyphicon-sort-by-order"></span>
							<span class="margin-sm-left hidden-xs hidden-sm">Save order</span>
						</button>
					</form>
				</div>
				<div class="col-xs-10">
					<form class="form-inline text-right" action="<?= DOMAIN ?>/works/filter/" method="get">
						<div class="input-group">
							<input type="date" name="date" value="<?= $data['date'] ?>" class="form-control">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-primary">
									<span class="glyphicon glyphicon-calendar"></span>
									<span class="margin-sm-left hidden-xs hidden-sm">Change date</span>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<hr>

			<?php // Checkbox to show past works ?>
			<div class="input-group hidden">
				<span class="input-group-addon">
					<input id="past-works" name="past-works" type="checkbox" aria-label="">
				</span>
				<label class="form-control" for="past-works">Show the past works pending</label>
			</div>

			<div class="table-responsive">
				<table class="table table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>Order</th>
							<th>Crew</th>
							<th>Type</th>
							<th>Intermediary</th>
							<th>Address</th>
							<th>Scheduled</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($works as $work): ?>
						<?php
							#$data['date']
							$finals = array('opened', 'started', 'finished', 'pending');
							if(strtotime($work['scheduled_at']) < strtotime(DATE_NOW) && in_array($work['status'], $finals))
							{
								$colorPending  = 'warning';
							}
							else
							{
								$colorPending = false;
							}
						?>

						<tr class="<?= $colorPending ?> vertical-middle">

							<td class="text-center">
								<?php if($work['status'] !== 'closed' AND $work['status'] !== 'cancelled'): ?>
								<input form="prioritize" name="priorities[<?= $work['id'] ?>]" value="<?= $work['priority'] ?>" type="number" class="form-control input-sm" min="0" max="10">
								<?php else: ?>
								<p class="text-muted"><strong><?= $work['priority'] ?></strong></p>
								<?php endif ?>
							</td>

							<td class="nowrap text-center">
								<?php
									$bgcolor = current($colorsArray);
									if($prevcrew != $work['crew_nick'])
									{
											$prevcrew = $work['crew_nick'];
											if(!$bgcolor = next($colorsArray))
											{
													reset($colorsArray);
													$bgcolor = current($colorsArray);
											}
									}
								 ?>
								<p style="background-color: <?= $bgcolor ?>; padding:1rem; margin:0">
									<span class="text-white"><?= $work['crew_nick'] ?></span>
								</p>
							</td>

							<td class="nowrap"><?= $kinds[$work['kind']] ?></td>
							<td class="nowrap"><?= $work['interm_nick'] ?></td>
							<td>
								<?= $work['address'].', '.$work['zip'].'<br>'.$work['city'].', '.$work['state'] ?><br>
								<small class="text-muted">
									<?= $work['name'] ?> <?= $work['lastname'] ?> | <?= $work['phone'] ?>
									<?php #<a href="mailto:<?= $work['email'] ? >"><?= $work['email'] ? ></a> ?>
								</small>
							</td>
							<td class="nowrap">
								<b><?= $work['scheduled_at'] ?></b>
							</td>
							<td class="text-center">
								<span class="label label-<?= $statusWork[$work['status']]['color'] ?>"><?= $statusWork[$work['status']]['tag'] ?></span>
							</td>
							<td class="text-center">
								<a class="btn btn-primary btn-sm" href="<?= DOMAIN ?>/works/edit/<?= $work['id'] ?>">
									<span class="glyphicon glyphicon-pencil"></span>
									<span class="margin-sm-left">Edit</span>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php else: ?>

	<div class="jumbotron">
		<div class="container text-center">
			<h1>0 works on this date</h1>
			<br>
			<form action="<?= DOMAIN ?>/works/" method="get" >
				<div class="input-group input-group-lg">
					<input class="form-control" type="date" name="date" value="<?= $data['date'] ?>">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-info">
							<span class="glyphicon glyphicon-calendar"></span>
							<span class="hidden-xs hidden-sm">Change date</span>
						</button>
					</span>
				</div>
			</form>
			<br><br>
			<p>Or maybe you want to see <a href="<?= DOMAIN ?>/works/pending"><b>pending works ( <?= $pendingsCount ?> )</b></a></p>
		</div>
	</div>

<?php endif; ?>

</div>
