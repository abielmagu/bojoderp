<?php $admins = $data['admins'] ?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

	<?php if($admins): ?>
	<?php 
		$kinds 				= array('admin'=>'Administrator', 'coord'=>'Coordinator');
		$iconEnabled 	= '<span class="glyphicon glyphicon-ok text-success"></span>';
		$iconDisabled = '<span class="glyphicon glyphicon-ban-circle text-muted"></span>';
	?>
	
	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row margin-lg-y">
				<div class="col-xs-9">
					<h1 class="margin-less">Administrators</h1>
				</div>
				<div class="col-xs-3 text-right">
					<a class="btn btn-primary" href="<?= DOMAIN ?>/administrators/add">
						<span class="glyphicon glyphicon-plus"></span>
						<span class="hidden-xs margin-sm-left">New administrator</span>
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
							<th class="text-center">#</th>
							<th class="text-center">Enabled</th>
							<th>Type</th>
							<th>Username</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($admins as $admin): ?>
						<tr class="vertical-middle">
							<td class="text-center"><!-- #line --></td>
							<td class="text-center"><?= ( $admin['enabled'] ) ? $iconEnabled : $iconDisabled ?></td>
							<td><?= $kinds[ $admin['kind'] ] ?></td>
							<td><?= $admin['name'] ?></td>
							<td class="text-right">
								<a class="btn btn-primary btn-sm" href="<?= DOMAIN ?>/administrators/edit/<?= $admin['id'] ?>"> 
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

<?php else: $entity = array('name' => 'Administrators', 'url' => 'administrators/add/') ?>

<?php include_once VIEWS.'app/partials/firstone.php' ?>

<?php endif; ?>

</div>