<?php 
require_once 'data.php';
$works = $data['works'];
$workers = $data['workers'];
$worksCount = count($works);
?>

<div class="col-xs-12">
	<h1>Welcome <?= Session::get('name') ?> <br> <small>Dashboard | <?= DATE_USA ?></small></h1>
	<br>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><span class="badge"><?= $worksCount ?></span> Today works</h4>
		</div>
		<div class="panel-body">
		<label for="">Your crew for now</label>
		<p class="well well-sm bg-info"><?= $workers ?></p>
		<br>
		<?php if($worksCount): ?>
			<div class="table-responsive">
				<table class="table table-condensed table-striped table-hover">
					<thead>
						<tr>
							<th>Order</th>
							<th>Status</th>
							<th>Type</th>
							<th>Address</th>
							<th>Location</th>
							<th>Client</th>
							<th>Contact</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($works as $work): ?>
						<tr class="vertical-middle">
							<td class="text-center">
								<p class="well well-sm margin-less"><?= $work['priority'] ?></p>
							</td>
							<td>
								<?php $label = $status[ $work['status'] ] ?>
								<span class="label label-<?= $label['color'] ?>"><?= $label['tag'] ?></span>
							</td>
							<td><?= $kinds[ $work['kind'] ] ?></td>
							<td><?= $work['address'] ?>, <?= $work['zip'] ?></td>
							<td><?= $work['city'] ?>, <?= $work['state'] ?></td>
							<td><?= $work['nameClient'] ?> <?= $work['lastname'] ?></td>
							<td><?= $work['phone'] ?> <br> <?= $work['email'] ?></td>
							<td>
								<a class="btn btn-primary" href="<?= DOMAIN ?>/works/read/<?= $work['id'] ?>">
									<span class="glyphicon glyphicon-eye-open"></span>
								</a>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		<?php else: ?>
			<p class="text-muted"></p>
		<?php endif ?>
		</div>
	</div>
</div>