<?php 
$pendings = $data['pendings'];
$kinds = $GLOBALS['works'];
$statusWork = $GLOBALS['statusWork'];
?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

<?php if($pendings): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row margin-lg-y">
				<div class="col-xs-9">
					<h1 class="margin-less">Pending works</h1>
				</div>
				<div class="col-xs-3 text-right">
					<a class="btn btn-primary" href="<?= DOMAIN ?>/works/">
						<span class="glyphicon glyphicon-hourglass"></span>
						<span class="margin-sm-left hidden-xs hidden-sm">Today's works</span>
					</a>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<p class="lead text-center">TODAY IS <b><?= DATE_NOW ?></b></p>
			<hr>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-condensed table-counter">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Type</th>
							<th>Address</th>
							<th>Location</th>
							<th>Status</th>
							<th>Scheduled</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($pendings as $pending): ?>
							<tr>
								<td class="text-center"><!-- # line --></td>
								<td><?= $kinds[$pending['kind']] ?></td>
								<td><?= $pending['address'].', '.$pending['zip'] ?></td>
								<td><?= $pending['city'].', '.$pending['state'] ?></td>
								<?php 
									$label = array();
									$label['color'] = $statusWork[$pending['status']]['color'];
									$label['title'] = $statusWork[$pending['status']]['tag'];
								?>
								<td><span class="label label-<?= $label['color']?>"><?= $label['title']?></span></td>
								<td><?= $pending['scheduled_at'] ?></td>
								<td class="text-right">
									<a class="btn btn-primary btn-sm" href="<?= DOMAIN ?>/works/filter/?date=<?= $pending['scheduled_at'] ?>">
										<span class="glyphicon glyphicon-share-alt"></span>
										<span class="margin-sm-left">Work date</span>
									</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php else: ?>

  <div class="jumbotron">
		<div class="container text-center">
			<h1>No pending works for now</h1>
			<br>
			<p>Maybe you want to see <a href="<?= DOMAIN ?>/works/"><b>today's works</b></a></p>
		</div>
  </div>

<?php endif ?>

</div>