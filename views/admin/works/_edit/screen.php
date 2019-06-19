		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="margin-lg-y">Edit work</h1>
			</div>
			<div class="panel-body">
			
				<a class="btn btn-primary pull-right" href="<?= DOMAIN ?>/clients/casefile/<?= $work['id_client'] ?>">See casefile</a>
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

				<form action="<?= DOMAIN ?>/works/update" method="post">
					<h3>General</h3>
					<div class="row">
						<div class="col-md-6">
							<label for="">Type</label>
							<div class="well well-sm text-center"><?= $kindsWk[$work['kind']] ?></div>
						</div>
						<div class="col-md-6">
							<label for="">Status</label>
							<?php $statusWork = $statusWk[ $work['status'] ] ?>
							<div class="well well-sm text-center"><b class="text-<?= $statusWork['color'] ?>"><?= $statusWork['tag'] ?></b></div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Crew</label>
								<select class="form-control" name="crew">
									<?php foreach($crews as $crew): $selected = ($crew['id'] === $work['id_crew']) ? 'selected' : false ?>
									<option value="<?= $crew['id'] ?>" <?= $selected ?>><?= $crew['nick'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">					
								<label for="">Intermediary</label>
								<select class="form-control" name="intermediary" id="">
									<?php foreach($interms as $interm): $selected = ($interm['id'] === $work['id_intermediary']) ? 'selected' : false ?>  
									<option value="<?= $interm['id'] ?>" <?= $selected ?>><?= $interm['name'].' - '.$interm['nick'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						
						<div class="col-xs-12">
							<div class="form-group">
								<label for="">Workers</label>
								<textarea class="form-control" name="workers" id="" rows="3"><?= $work['workers'] ?></textarea>
							</div>
						</div>
					</div>

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
					
					<h3>Photos</h3>
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
					<br>
					
					<h3>Time</h3>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Schedule</label>
								<input class="form-control" type="date" name="scheduled" value="<?= $work['scheduled_at'] ?>">
							</div>
						</div>
						<div class="col-md-4">
							<label for="">Created</label>
							<div class="well well-sm text-center"><?= $work['opened_at'] ?></div>
						</div>
						<div class="col-md-4">
							<label for="">Last update</label>
							<div class="well well-sm text-center"><?= $work['updated_at'] ?></div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<?php $started = explode(' ', $work['started_at']) ?>
								<label for="">Start working</label>
								<div class="row">
									<div class="col-xs-6" style="padding-right:0">
										<input class="form-control" type="date" name="started[date]" value="<?= $started[0] ?>">
									</div>
									<div class="col-xs-6" style="padding-left:0">
										<input class="form-control" type="time" name="started[time]" value="<?= $started[1] ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<?php $finished = explode(' ', $work['finished_at']) ?>
								<label for="">Done</label>
								<div class="row">
									<div class="col-xs-6" style="padding-right:0">
										<input class="form-control" type="date" name="finished[date]" value="<?= $finished[0] ?>">
									</div>
									<div class="col-xs-6" style="padding-left:0">
										<input class="form-control" type="time" name="finished[time]" value="<?= $finished[1] ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<label for="">Closed</label>
							<div class="well well-sm text-center"><?= $work['closed_at'] ?></div>
						</div>
					</div>
					
					<hr>
					
					<div class="form-group">
						<label for="">Status</label>
						<?php $arrayStatus = array('closed' => 'Completed', 'cancelled' => 'Cancelled', 'pending' => 'Pending') ?>
						<select class="form-control" name="status">
							
							<?php if(!array_key_exists($work['status'], $arrayStatus)): ?>
							<option value="dontchange" selected>Dont change</option>
							<?php endif ?>
							
							<?php foreach($arrayStatus as $key => $value): ?>
							<?php $selected = ($key === $work['status']) ? 'selected' : false ?>
							<option value="<?= $key ?>" <?= $selected ?>><?= $value ?></option>
							<?php endforeach ?>

						</select>
					</div>
					<div class="hidden">
						<input type="hidden" name="precrew" value="<?= $work['id_crew'] ?>">
						<input type="hidden" name="kind" value="<?= $work['kind'] ?>">
						<input type="hidden" name="needle" value="<?= $work['id'] ?>">
						<input type="hidden" name="needleKind" value="<?= $details['id'] ?>">
					</div>
					<p class="text-right">
						<button class="btn btn-success" type="submit">Update work</button> 
						<a class="btn btn-default margin-left" href="<?= DOMAIN ?>/works/filter/?date=<?= $work['scheduled_at'] ?>">Cancel</a>
					</p>
				</form>

			</div>
		</div>
