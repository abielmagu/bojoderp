<?php $workers = $data["workers"] ?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php if(count($workers)): ?>
	<?php include_once VIEWS.'app/partials/message.php' ?>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row margin-lg-y">
				<div class="col-xs-9">
					<h1 class="margin-less">Workers</h1>
				</div>
				<div class="col-xs-3 text-right">
					<a class="btn btn-primary" href="<?= DOMAIN ?>/workers/add">
						<span class="glyphicon glyphicon-plus"></span>
						<span class="hidden-xs margin-sm-left">New worker</span>
					</a>
				</div>
			</div>
		</div>
		<br>
		<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-counter table-hover table-striped table-condensed">
				<thead>
					<tr>
						<th class="text-center"></th>
						<th>Name</th>
						<th>Phone</th>
						<th>Email</th>
						<th class="text-center"></th>
					</tr>
				</thead>
				<tbody>

					<?php foreach($workers as $worker): ?>
					<tr class="vertical-middle">
						<td class="text-center"><!-- #line --></td>
						<td><?= $worker["name"].' '.$worker["lastname"] ?></td>
						<td><?= $worker["phone"] ?></td>
						<td><a href="mailto:<?= $worker["email"] ?>"><?= $worker["email"] ?></a></td>
						<td class="text-right nowrap">
							<a class="btn btn-primary btn-sm" href="<?= DOMAIN ?>/workers/edit/<?= $worker["id"] ?>" data-toggle="tooltip" data-placement="top" title="Edit">
								<span class="glyphicon glyphicon-pencil"></span>
							</a>
							<a class="btn btn-danger btn-sm" href="<?= DOMAIN ?>/workers/preremove/<?= $worker["id"] ?>" data-toggle="tooltip" data-placement="top" title="Remove">
								<span class="glyphicon glyphicon-remove"></span>
							</a>
						</td>
					</tr>
					<?php endforeach; ?>

				</tbody>
			</table>
		</div>
		</div>
	</div>

<?php else: $entity = array('name' => 'Workers', 'url' => 'workers/add/') ?>

<?php include_once VIEWS.'app/partials/firstone.php' ?>

<?php endif ?>

</div>
