<?php $results = $data['results'] ?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

<?php if($results): ?>
	<?php Helper::breakdown($results) ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">Search</h1>
		</div>
		<div class="panel-body">
			<p class="lead">
				<span class="label label-success"><b><?= count($results) ?></b></span>
				<span>Results with: <i><?= $data['content'] ?></i></span>
			</p>
			<hr>
			<div class="table-responsive">
				<table class="table table-striped table-counter">
					<thead>
						<tr>
							<th></th>
							<th>Client</th>
							<th>Address</th>
							<th>Location</th>
							<th>Contact</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($results as $client): ?>
						<tr class="vertical-middle">
							<td class="text-center"></td>
							<td><?= $client['name'] . ' ' . $client['lastname'] ?></td>
							<td><?= $client['address'] ?>, <?= $client['zip'] ?></td>
							<td><?= $client['city'] ?>, <?= $client['state'] ?></td>
							<td><?= $client['phone'] ?> | <a href="mailto:<?= $client['email'] ?>"><?= $client['email'] ?></a></td>
							<td class="text-right">
								<a class="btn btn-primary btn-sm" href="<?= DOMAIN ?>/clients/casefile/<?= $client["id"] ?>">
								<span class="glyphicon glyphicon-eye-open"></span></a>
								<a class="btn btn-success btn-sm" href="<?= DOMAIN ?>/works/add/<?= $client["id"] ?>">
								<span class="glyphicon glyphicon-plus-sign"></span></a>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php else: ?>
 
  <div class="jumbotron bg-white">
    <div class="container text-center">
      <h1><span class="text-muted">Hmm...</span></h1>
      <p class="display-3">0 results with <i>"<?= $data['content'] ?>"</i></p>
      <p><a class="btn btn-primary" href="/!#" data-toggle="modal" data-target="#search">Try again</a></p>
    </div>
  </div>

<?php endif ?>

</div>