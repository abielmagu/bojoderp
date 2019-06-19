<?php $interms = $data['interms'] ?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

<?php if($interms): ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
    <div class="panel-heading">
    	<div class="row margin-lg-y">
				<div class="col-xs-9">
					<h1 class="margin-less">Intermediaries</h1>
				</div>
				<div class="col-xs-3 text-right">
					<a class="btn btn-primary" href="<?= DOMAIN ?>/intermediaries/add">
						<span class="glyphicon glyphicon-plus"></span>
						<span class="hidden-xs margin-sm-left">New intermediary</span>
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
							<th></th>
							<th>Name</th>
							<th>Nick</th>
							<th>User</th>
							<th>Phone</th>
							<th>Email</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tbody>
					
						<?php foreach( $interms as $interm ): ?>
							<tr class="vertical-middle">
								<td class="text-center"></td>
								<td><?= $interm['name'] ?></td>
								<td><?= $interm['nick'] ?></td>
								<td><?= $interm['username'] ?></td>
								<td class="nowrap"><?= $interm['phone'] ?></td>
								<td><a href="mailto:<?= $interm['email'] ?>"><?= $interm['email'] ?></a></td>
								<td class="text-right nowrap">
									<a class="btn btn-primary btn-sm" href="<?= DOMAIN ?>/intermediaries/edit/<?= $interm["id"] ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
									<a class="btn btn-danger btn-sm" href="<?= DOMAIN ?>/intermediaries/preremove/<?= $interm["id"] ?>" data-toggle="tooltip" data-placement="top" title="Remove"><span class="glyphicon glyphicon-remove"></span></a>
								</td>
							</tr>
						<?php endforeach; ?>
						
					</tbody>
				</table>
			</div>
    </div>
	</div>

<?php else: $entity = array('name' => 'Intermediaries', 'url' => 'intermediaries/add') ?>

<?php include_once VIEWS.'app/partials/firstone.php' ?>

<?php endif ?>

</div>