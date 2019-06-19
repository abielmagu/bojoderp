<?php 
$guarantees = $data['guarantees'];
$countPendings = count($data['pendings']);
$statusWarranty = $GLOBALS['statusWarranty'];
$kinds = $GLOBALS['works'];
?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

<?php if($guarantees): ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
    <div class="panel-heading">
			<div class="row margin-lg-y">
				<div class="col-xs-9">
					<h1 class="margin-less">Guarantees</h1>
				</div>
				<div class="col-xs-3 text-right">
					<a class="btn btn-danger" href="<?= DOMAIN ?>/guarantees/pending">
						<span class="badge"><?= $countPendings ?></span>
						<span class="glyphicon glyphicon-alert hidden"></span> 
						<span class="margin-sm-left hidden-xs hidden-sm">Pending guarantees</span>
					</a>
				</div>
			</div>
    </div>
    <div class="panel-body">
    	<form class="form-inline" action="<?= DOMAIN ?>/guarantees/filter/" method="get">
    		<div class="text-center">	
					<div class="input-group">
						<input type="date" name="date" value="<?= $data['date'] ?>" class="form-control">
						<div class="input-group-btn">
							<button type="submit" class="btn btn-primary">
								<span class="glyphicon glyphicon-calendar"></span>
								<span class="margin-sm-left hidden-xs hidden-sm">Change date</span>
							</button>
						</div>
					</div>
    		</div>
    	</form>
			<hr>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-condensed table-counter">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Type</th>
							<th>Repairers</th>
							<th>Issues</th>
							<th>Solutions</th>
							<th>Address</th>
							<th>Schedule</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						<?php foreach($guarantees as $warranty): ?>
						<?php 
							if(strtotime($warranty['scheduled_at']) < strtotime(DATE_NOW) && $warranty['status'] === 'new')
							{
								$pendingColor = 'warning';
							}
							else
							{
								$pendingColor = false;
							}
					  ?>
						<tr class="<?= $pendingColor ?>">
							<td class="text-center"></td>
							<td class="nowrap"><?= $kinds[$warranty['kind']] ?></td>
							<td class="nowrap"><?= $warranty['repairers'] ?></td>
							<td><?= $warranty['issues'] ?></td>
							<td><?= $warranty['solutions'] ?></td>
							<td class="nowrap">
								<span class="block"><?= $warranty['address'].' '.$warranty['zip'] ?></span>
								<small><?= $warranty['city'].', '.$warranty['state'] ?></small>
							</td>
							<td class="nowrap">
								<strong><?= $warranty['scheduled_at'] ?></strong>
							</td>
							<td>
								<?php $color = $statusWarranty[$warranty['status']]['color'] ?>
								<span class="label label-<?= $color ?>"><?= $statusWarranty[$warranty['status']]['tag'] ?></span>
							</td>
							<td class="text-right">
								<a class="btn btn-primary btn-sm" href="<?= DOMAIN ?>/guarantees/edit/<?= $warranty['id'] ?>">
									<span class="glyphicon glyphicon-pencil"></span>
									<span class="margin-sm-left">Edit</span>
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
			<h1>0 guarantees on this date</h1>
			<br>
			<form action="<?= DOMAIN ?>/guarantees/filter/" method="get" >
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
			<p>Or maybe you want to see <a href="<?= DOMAIN ?>/guarantees/pending">
				<b>pending guarantees( <?= $countPendings ?> )</b></a>
			</p>
		</div>
	</div>

<?php endif ?>

</div>
