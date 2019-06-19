<?php
$client = $data['client'];
$works  = $data['works'];

$kinds 						= $GLOBALS['works'];
$statusWork 			= $GLOBALS['statusWork'];
$statusInspection = $GLOBALS['statusInspection'];
$statusWarranty 	= $GLOBALS['statusWarranty'];

$statusLabels = array(
  'opened'   => 'New',
  'started'  => 'Working',
  'finished' => 'Done',
  'closed' 	 => 'Completed',
  'canceled' => 'Cancelled'
);
?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row margin-lg-y">
				<div class="col-xs-9">
					<h1 class="margin-less">Casefile</h1>
				</div>
				<div class="col-xs-3 text-right">
					<a class="btn btn-warning" href="<?= DOMAIN ?>/clients/edit/<?= $client['id'] ?>">
						<span class="glyphicon glyphicon-pencil"></span>
						<span class="hidden-xs margin-sm-left">Edit client</span>
					</a>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<label>Name</label>
					<div class="well well-sm"><?= $client['name'] ?> <?= $client['lastname'] ?></div>
				</div>
				<div class="col-md-6">
					<label>Address</label>
					<div class="well well-sm"><?= $client['address'] ?>, <?= $client['zip'] ?></div>
				</div>
				<div class="col-md-4">
					<label>City, State</label>
					<div class="well well-sm"><?= $client['city'] ?>, <?= $client['state'] ?></div>
				</div>
				<div class="col-md-4">
					<label>Phone</label>
					<div class="well well-sm"><?= $client['phone'] ?></div>
				</div>
				<div class="col-md-4">
					<label>Email</label>
					<div class="well well-sm">
						<a href="mailto:<?= $client['email'] ?>"><?= $client['email'] ?></a></div>
				</div>
			</div>
			<label>Notes</label>
			<div class="well"><?= $client['notes'] ?></div>
		</div>
	</div>

<?php /** WORKS *****************************************************************/ ?>

	<?php if($works): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row margin-lg-y">
				<div class="col-xs-9">
					<h1 class="margin-less"><span class="label label-default"><?= count($works) ?></span> Works</h1>
				</div>
				<div class="col-xs-3 text-right">
					<a class="btn btn-primary" href="<?= DOMAIN ?>/works/add/<?= $client['id'] ?>">
						<span class="glyphicon glyphicon-plus"></span>
						<span class="hidden-xs margin-sm-left">Add new work</span>
					</a>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div id="accordion" class="panel-group" aria-multiselectable="true">
			<?php foreach($works as $key => $case): $n = ++$key ?>
				<div class="panel panel-defaul">
						<div class="panel-heading">
								<div class="row">
									 <div class="col-xs-10">
											<h3><?= $n ?>. <?= $kinds[$case['kind']] ?></h3>
									 </div>
									 <div class="col-xs-2 text-right margin-top">
											<a href="#collapse_<?= $n ?>" class="btn btn-default" data-toggle="collapse" data-parent="#accordion">
												<span class="caret"></span>
											</a>
									 </div>
								</div>
						</div>
						<div id="collapse_<?= $n ?>" class="panel-body panel-collapse collapse in" style="padding-top:0">
								<div class="table-responsive">
										<table class="table table-striped">
												<thead>
														<tr>
																<th>Scheduled</th>
																<th>Workers</th>
																<th>Notes</th>
																<th>Status</th>
																<th class="text-center"></th>
														</tr>
												</thead>
												<tbody>
														<tr>
																<td class="nowrap"><?= $case['scheduled_at'] ?></td>
																<td><?= $case['workers'] ?></td>
																<td><?= $case['notes'] ?></td>
																<?php $label = $statusWork[ $case['status'] ] ?>
																<td><span class="label label-<?= $label['color'] ?>"><?= $label['tag'] ?></span></td>
																<td class="text-right">
																	<a class="btn btn-warning btn-xs" href="<?= DOMAIN ?>/works/edit/<?= $case['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit work">
																		<span class="glyphicon glyphicon-pencil"></span>
																	</a>
																</td>
														</tr>
												</tbody>
										</table>
								</div>
								<br>

<?php /** INSPECTIONS *****************************************************************/ ?>

								<?php $counterInspections = count($case['inspections']); ?>
								<p>
									<span class="badge"><?= $counterInspections ?></span>
									<b>Inspections</b>
									<span class="margin-sm-x">/</span>
									<a class="" href="<?= DOMAIN ?>/inspections/add/<?= $case['id'] ?>">
										<span class="glyphicon glyphicon-plus-sign"></span> Add inspection
									</a>
								</p>
								<?php if($counterInspections): ?>
								<div class="table-responsive">
										<table class="table table-counter table-striped">
												<thead>
														<tr>
																<th class="text-center">#</th>
																<th>Scheduled</th>
																<th>By</th>
																<th>Observations</th>
																<th>Notes</th>
																<th>Approval</th>
																<th class="text-center"></th>
														</tr>
												</thead>
												<tbody>
												<?php foreach($case['inspections'] as $inspection): ?>
														<tr>
																<td class="text-center"></td>
																<td class="nowrap"><?= $inspection['scheduled_at'] ?></td>
																<td><?= $inspection['name_by'] ?></td>
																<td><?= $inspection['observations'] ?></td>
																<td><?= $inspection['notes'] ?></td>
																<?php $label = $statusInspection[ $inspection['approval'] ] ?>
																<td><span class="label label-<?= $label['color'] ?>"><?= $label['tag'] ?></span></td>
																<td class="text-right">
																	<a class="btn btn-warning btn-xs" href="<?= DOMAIN ?>/inspections/edit/<?= $inspection['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit inspection">
																		<span class="glyphicon glyphicon-pencil"></span>
																	</a>
																</td>
														</tr>
												<?php endforeach ?>
												</tbody>
										</table>
								</div>
								<?php endif ?>
								<br>

<?php /** GUARANTEES *****************************************************************/ ?>

								<?php $counterGuarantees = count($case['guarantees']); ?>
								<p>
									<span class="badge"><?= $counterGuarantees ?></span>
									<b>Guarantees</b>
									<span class="margin-sm-x">/</span>
									<a class="" href="<?= DOMAIN ?>/guarantees/add/<?= $case['id'] ?>">
										<span class="glyphicon glyphicon-plus-sign"></span> Add warranty
									</a>
								</p>
								<?php if($counterGuarantees): ?>
								<div class="table-responsive">
										<table class="table table-striped">
												<thead>
														<tr>
																<th class="text-center">#</th>
																<th>Scheduled</th>
																<th>Issues</th>
																<th>Solutions</th>
																<th>Repairers</th>
																<th>Status</th>
																<th></th>
														</tr>
												</thead>
												<tbody>
												<?php $w = 1; foreach($case['guarantees'] as $warranty): ?>
														<tr>
																<td class="text-center"><?= $w ?></td>
																<td class="nowrap"><?= $warranty['scheduled_at'] ?></td>
																<td><?= $warranty['issues'] ?></td>
																<td><?= $warranty['solutions'] ?></td>
																<td><?= $warranty['repairers'] ?></td>
																<?php $label = $statusWarranty[ $warranty['status'] ] ?>
																<td><span class="label label-<?= $label['color'] ?>"><?= $label['tag'] ?></span></td>
																<td class="text-right">
																	<a class="btn btn-warning btn-xs" href="<?= DOMAIN ?>/guarantees/edit/<?= $warranty['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit warranty">
																		<span class="glyphicon glyphicon-pencil"></span>
																	</a>
																</td>
														</tr>
												<?php $w++; endforeach ?>
												</tbody>
										</table>
								</div>
								<?php endif ?>
						</div>
				</div>
			<?php endforeach ?>
			</div>
		</div>
	</div>

	<?php else: ?>

	<p class="text-center">
		<a class="btn btn-success btn-lg" href="<?= DOMAIN ?>/works/add/<?= $client['id'] ?>">
			<span class="glyphicon glyphicon-plus-sign"></span>
			Add a first work's client
		</a>
	</p>

	<?php endif ?>

</div>
