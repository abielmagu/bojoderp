<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

<?php $clients = $data['clients'] ?>

<?php if($clients): ?>

	<?php include_once VIEWS.'app/partials/message.php' ?>
	<div class="panel panel-default">
    <div class="panel-heading">
			<div class="row margin-lg-y">
				<div class="col-xs-9">
					<h1 class="margin-less">
						<span>Clients</span>
						<span class="badge"><b><?= $data['pagination']['count'] ?></b></span>
					</h1>
				</div>
				<div class="col-xs-3 text-right">
					<a class="btn btn-primary" href="<?= DOMAIN ?>/clients/add">
						<span class="glyphicon glyphicon-plus"></span>
						<span class="hidden-xs margin-sm-left">New client</span>
					</a>
				</div>
			</div>
    </div>
    <div class="panel-body">

			<?php include VIEWS.'app/partials/pagination.php' ?>

			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th>Name</th>
							<th>Address</th>
							<th>ZIP</th>
							<th>Location</th>
							<th>Email</th>
							<th>Phone</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

						<?php $tr = $data['pagination']['start'] ?>
						<?php foreach($clients as $client): ?>
						<tr class="vertical-middle">
							<td class="text-center"><?= $tr++ ?></td>
							<td><?= $client['name'].' '.$client['lastname'] ?></td>
							<td><?= $client['address'] ?></td>
							<td><?= $client['zip'] ?></td>
							<td><?= $client['city'] ?>, <?= $client['state'] ?></td>
							<td><a href="mailto:<?= $client['email'] ?>"><?= $client['email'] ?></a></td>
							<td><?= $client['phone'] ?></td>
							<td class="text-right nowrap">
								<a class="btn btn-primary btn-sm" href="<?= DOMAIN ?>/clients/casefile/<?= $client["id"] ?>"  data-toggle="tooltip" data-placement="top" title="See casefile">
									<span class="glyphicon glyphicon-eye-open"></span>
								</a>
								<a class="btn btn-success btn-sm" href="<?= DOMAIN ?>/works/add/<?= $client["id"] ?>"  data-toggle="tooltip" data-placement="top" title="Add work">
									<span class="glyphicon glyphicon-plus-sign"></span>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>

					</tbody>
				</table>
			</div>

			<?php include VIEWS.'app/partials/pagination.php' ?>

    </div>
	</div>

<?php elseif( is_null($clients) ): ?>
	<div class="jumbotron">
		<div class="container text-center">
			<h1>Hmm...</h1>
			<p class="lead">No more clients on this page: <b><?= $data['pagination']['page'] ?></b></p>
		</div>
	</div>

<?php else : $entity = array('name'=>'Clients', 'url'=>'clients/add') ?>

<?php include_once VIEWS.'app/partials/firstone.php' ?>

<?php endif ?>

</div>
