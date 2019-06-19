<div class="panel panel-default">
	<div class="panel-heading">
		<h1 class="margin-lg-y"><small>WORK PRINTED: <?= DATETIME_NOW ?></small></h1>
	</div>
	<div class="panel-body">

		<h3>Client</h3>
		<table class="table table-condensed table-bordered" style="font-size: 0.75rem !important">
			<thead>
				<tr class="active" style="color: white !important">
					<th style="background-color: #333 !important">Name</th>
					<th style="background-color: #333 !important">Address</th>
					<th style="background-color: #333 !important">Location</th>
					<th style="background-color: #333 !important">Phone</th>
					<th style="background-color: #333 !important">Email</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?= $work['name'].' '.$work['lastname'] ?></td>
					<td><?= $work['address'].', '.$work['zip'] ?></td>
					<td><?= $work['city'].', '.$work['state'] ?></td>
					<td><?= $work['phone'] ?></td>
					<td><?= $work['email'] ?></td>
				</tr>
			</tbody>
		</table>

		<h3>General</h3>
		<table class="table table-condensed table-bordered" style="font-size: 0.75rem !important">
			<thead>
				<tr class="active" style="color: white !important">
					<th style="background-color: #333 !important">Status</th>
					<th style="background-color: #333 !important">Type</th>
					<th style="background-color: #333 !important">Intermediary</th>
					<th style="background-color: #333 !important">Crew</th>
					<th style="background-color: #333 !important">Workers</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?= $statusWk[ $work['status'] ]['tag'] ?></td>
					<td><?= $kindsWk[ $work['kind'] ] ?></td>

					<?php foreach($interms as $interm): ?>
					<?php if($interm['id'] == $work['id_intermediary']): ?>					
					<td><?= $interm['name'] ?> ( <?= $interm['nick'] ?> )</td>
					<?php endif ?>
					<?php endforeach ?>
										
					<?php foreach($crews as $crew): ?>
					<?php if($crew['id'] == $work['id_crew']): ?>
					<td><?= $crew['nick'] ?></td>
					<?php endif ?>
					<?php endforeach ?>
					
					<td><?= $work['workers'] ?></td>
				</tr>
			</tbody>
		</table>
		
		<h3>Time</h3>
		<table class="table table-condensed table-bordered" style="font-size: 0.75rem !important">
			<thead>
				<tr class="active" style="color: white !important">
					<th style="background-color: #333 !important">Schedule</th>
					<th style="background-color: #333 !important">Created</th>
					<th style="background-color: #333 !important">Updated</th>
					<th style="background-color: #333 !important">Started work</th>
					<th style="background-color: #333 !important">Done work</th>
					<th style="background-color: #333 !important">Closed</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?= $work['scheduled_at'] ?></td>
					<td><?= $work['opened_at'] ?></td>
					<td><?= $work['updated_at'] ?></td>
					<td><?= $work['started_at'] ?></td>
					<td><?= $work['finished_at'] ?></td>
					<td><?= $work['closed_at'] ?></td>
				</tr>
			</tbody>
		</table>

		<h3>Details</h3>
		<?php $kind_path = VIEWS."kinds/{$work['kind']}/edit.php" ?>
		<?php if( file_exists($kind_path) ): include $kind_path ?>
		<?php else: ?><p>Does not have a work template.</p><?php endif ?>
		<?php // Helper::breakdown($details) ?>
		<div class="clearfix"></div>

		<div class="form-group">
			<label for="">Notes</label>
			<textarea class="form-control" name="notes" id="" cols="30" rows="5" required><?= $work['wnotes'] ?></textarea>
		</div>

		<h3>Photos ( <?= count($gallery) ?> )</h3>
		<?php if($gallery): ?>
			<ul class="nav nav-pills">
				<?php foreach($gallery as $photo): ?>
					<?php $exploded = explode('.', $photo) ?>
					<li>
						<?php $href = SOURCES."/gallery/{$work['id_client']}/{$work['id']}/{$photo}" ?>
						<a href="<?= $href ?>" target="_blank">
							<span class="glyphicon glyphicon-camera"></span>
							<span class="margin-sm-left"><?= $exploded[0] ?></span>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		<?php else: ?>
			<p class="text-muted">None</p>
		<?php endif ?>
		<div class="box-nobreak">
		</div>

	</div>
</div>
