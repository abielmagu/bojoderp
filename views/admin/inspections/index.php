<?php 
$inspections = $data['inspections'];
$countPendings = count($data['pendings']);
$statusInspection = $GLOBALS['statusInspection'];
$kinds = $GLOBALS['works'];
?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>
	
<?php if($inspections): ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
    <div class="panel-heading">
			<div class="row margin-lg-y">
				<div class="col-xs-9">
					<h1 class="margin-less">Inspections</h1>
				</div>
				<div class="col-xs-3 text-right">
					<a class="btn btn-danger" href="<?= DOMAIN ?>/inspections/pending">
						<span class="badge"><?= $countPendings ?></span>
						<span class="glyphicon glyphicon-alert hidden"></span> 
						<span class="margin-sm-left hidden-xs hidden-sm">Pending inspections</span>
					</a>
				</div>
			</div>
		</div>
    <div class="panel-body">
    	 <form class="form-inline text-center" action="<?= DOMAIN ?>/inspections/filter/" method="get">
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
			<hr>
			<div class="table-responsive">
				<table class="table table-hover table-striped table-condensed table-counter">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Type</th>
							<th>By</th>
							<th>Observations</th>
							<th>Address</th>
							<th>Schedule</th>
							<th>Approval</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						<?php foreach($inspections as $inspection): ?>
						<?php 
							if(strtotime($inspection['scheduled_at']) < strtotime(DATE_NOW) && $inspection['approval'] === 'on hold')
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
							<td class="nowrap"><?= $kinds[$inspection['kind']] ?></td>
							<td><?= $inspection['name_by'] ?></td>
							<td><?= $inspection['observations'] ?></td>
							<td class="nowrap">
								<span class="block"><?= $inspection['address'].' '.$inspection['zip'] ?></span>
								<small><?= $inspection['city'].', '.$inspection['state'] ?></small>
							</td>
							<td class="nowrap">
								<b><?= $inspection['scheduled_at'] ?></b>
							</td>
							<?php 
							$label = array();
							$label['color'] = $statusInspection[$inspection['approval']]['color'];
							$label['title'] = $statusInspection[$inspection['approval']]['tag'];
							?>
							<td><span class="label label-<?= $label['color'] ?>"><?= $label['title'] ?></span></td>
							<td class="text-center">
								<a class="btn btn-primary btn-sm" href="<?= DOMAIN ?>/inspections/edit/<?= $inspection['id'] ?>">
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
			<h1>0 inspections on this date</h1>
			<br>
			<form action="<?= DOMAIN ?>/inspections/" method="get" >
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
			<p>Or maybe you want to see <a href="<?= DOMAIN ?>/inspections/pending"><b>pending inspections( <?= $countPendings ?> )</b></a></p>
		</div>
	</div>

<?php endif ?>

</div>