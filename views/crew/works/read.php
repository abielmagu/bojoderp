<?php 
require_once dirname(dirname(__FILE__)).'/data.php';
$work = $data['work'];
?>

<div class="col-xs-12">
		<?php include_once VIEWS.'app/partials/message.php' ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-8">
						<h1 class="margin-lg-y">Work</h1>
					</div>
					<div class="col-xs-4 text-right" style="padding-top: 1.25rem">
						<a href="<?= DOMAIN ?>" class="btn btn-lg btn-primary">Go back</a>
					</div>
				</div>
			</div>
			<div class="panel-body">

				<h3>Client</h3>
				<div class="row">
					<div class="col-md-4">
						<label for="">Name</label>
						<div class="well well-sm"><?= $work['name'].' '.$work['lastname'] ?></div>
					</div>
					<div class="col-md-4">
						<label for="">Address</label>
						<div class="well well-sm"><?= $work['address'].', '.$work['zip'] ?></div>
					</div>
					<div class="col-md-4">
						<label for="">Location</label>
						<div class="well well-sm"><?= $work['city'].', '.$work['state'] ?></div>
					</div>
					<div class="col-md-6">
						<label for="">Phone</label>
						<div class="well well-sm"><?= $work['phone'] ?></div>
					</div>
					<div class="col-md-6">
						<label for="">Email</label>
						<div class="well well-sm"><?= $work['email'] ?></div>
					</div>
				</div>

				<h3>General</h3>
				<div class="row">
					<div class="col-xs-6">
						<label for="">Type</label>
						<div class="well well-sm text-center"><?= $kinds[$work['kind']] ?></div>
					</div>
					<div class="col-xs-6">
						<label for="">Status</label>
						<?php $statusWork = $GLOBALS['statusWork'][$work['status']] ?>
						<div class="well well-sm text-center"><b class="text-<?= $statusWork['color'] ?>"><?= $statusWork['tag'] ?></b></div>
					</div>
				</div>

				<h3>Details</h3>
				<?php include_once VIEWS.'kinds/'.$work['kind'].'/read.php' ?>
					
				<div class="clearfix"></div>
				<div class="form-group">
					<label for="">Notes</label>
					<textarea class="form-control" name="notes" id="" cols="30" rows="5" readonly><?= $work['wnotes'] ?></textarea>
				</div>
					
				<h3>Photos</h3>
				<?php if($work['gallery']): ?>
				<ul class="nav nav-pills">
				<?php foreach($work['gallery'] as $photo): ?>
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
				<br>
				
				<form class="" action="<?= DOMAIN ?>/works/upload" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-sm-5">		
							<div class="form-group">
								<label for="">Select photo</label>
								<input type="file" class="form-control" name="photofile" required>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="form-group">
								<label for="">Name photo</label>
								<input type="text" class="form-control" name="photoname" required>
							</div>
						</div>
						<div class="col-sm-2 text-right" style="padding-top:2.5rem">
							<input type="hidden" name="needle" value="<?= $work['id'] ?>">
							<input type="hidden" name="needleClient" value="<?= $work['id_client'] ?>">
							<button class="btn btn-primary btn-block" type="submit">
								<span class="glyphicon glyphicon-upload"></span>
								<span class="margin-sm-left">Upload photo</span>
							</button>
						</div>
					</div>
				</form>
				
				<hr>
				
				<?php if($work['status'] === 'opened' || $work['status'] === 'started'): ?>
				<form action="<?= DOMAIN ?>/works/update" method="post">
					<div class="input-group">
						<select class="form-control" name="status" required>
							<option label="" selected disabled></option>
							<?php if($work['status'] === 'opened'): ?>
							<option value="start">Start work</option>
							<?php else: ?>
							<option value="finish">Done work</option>
							<?php endif ?>
						</select>
						<div class="hidden">
							<input type="hidden" name="started" value="<?= $work['started_at'] ?>">
							<input type="hidden" name="needle" value="<?= $work['id'] ?>">
						</div>
						<span class="input-group-btn">
							<button class="btn btn-success" type="submit">
								<span class="glyphicon glyphicon-refresh"></span>
								<span class="margin-sm-left">Change status</span>
							</button>
						</span>
					</div>
				</form>
				
				<?php else: ?>
				<div class="row">
					<div class="col-xs-6">
						<label for="">Started</label>
						<p class="well well-sm lead text-center"><?= $work['started_at'] ?></p>
					</div>
					<div class="col-xs-6">
						<label for="">Done</label>
						<p class="well well-sm lead text-center"><?= $work['finished_at'] ?></p>
					</div>
				</div>
				
				<?php endif ?>
				<br>
			</div>
		</div>

</div>