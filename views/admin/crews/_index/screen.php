	
   <div class="hidden-print">
    <div class="row">
    
   	<?php $clearfix = 0 ?>
    <?php if($crews['free']): $clearfix++ ?>
			<div class="col-xs-12 col-sm-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<b class="display-2">Free</b>
					</div>
					<div class="panel-body">
						<form action="<?= DOMAIN ?>/crews/reorganize" method="post">
							<table class="table table-hover table-striped table-condensed table-bordered">
								<thead>
									<tr>
										<th class="text-center"><span class="glyphicon glyphicon-check"></span></th>
										<th>Workers</th>
									</tr>
								</thead>
								<tbody> 
								 <?php foreach( $crews['free'] as $worker ): ?>
								 <tr>
								 	<td class="text-center">
										<input id="<?= $worker['id'] ?>" name="emigrates[]" value="<?= $worker['id'] ?>" type="checkbox">
								 	</td>
									<td>
										<label for="<?= $worker['id'] ?>" style="font-weight:normal">
											<?= $worker['name'].' '.$worker['lastname'] ?>
										</label>
									</td>
								 </tr>
								 <?php endforeach; ?>
								</tbody>
							</table>
							<div class="form-group">
								<label>Crews</label>
								<select class="form-control" name="crew" required>
									<option selected disabled></option>

									<?php foreach( $crews['options'] as $crew ): ?>
									<option value="<?= $crew['id'] ?>"><?= $crew['nick'] ?></option>
									<?php endforeach ?>

								</select>
							</div>
							<input type="hidden" name="needle" value="0">
							<input type="hidden" name="nick" value="aa2d6e4f578eb0cfaba23beef76c2194">
							<button class="btn btn-success btn-sm" type="submit">
								<span class="glyphicon glyphicon-share-alt"></span>
								<span class="margin-sm-left">Move</span>
							</button>
						</form>
					</div>
				</div>
			</div>
		<?php endif ?>
   
    <?php foreach($crews['internal'] as $crew): $clearfix++ ?>
			<div class="col-xs-12 col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-9">
							<?php $muted = !$crew['enabled'] ? 'text-muted' : false ?>
							<b class="display-2 <?= $muted ?>"><?= $crew['nick'] ?></b>
							</div>
							<div class="col-xs-3 text-right">
								<a class="btn btn-sm btn-primary" href="<?= DOMAIN ?>/crews/edit/<?= $crew['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit">
									<span class="glyphicon glyphicon-cog"></span>
								</a>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<?php if(count($crew['workers']) && $crew['enabled']): ?>
						<form action="<?= DOMAIN ?>/crews/reorganize" method="post">
							<table class="table table-hover table-striped table-condensed table-bordered">
								<thead>
									<tr>
										<th class="text-center"><span class="glyphicon glyphicon-check"></span></th>
										<th>Worker</th>
										<th class="text-center">Leader</th>
									</tr>
								</thead>
								<tbody>

									<?php foreach($crew['workers'] as $worker): ?>
									<tr>
										<td class="text-center">
											<input id="<?= $worker['id'] ?>" value="<?= $worker['id'] ?>" name="emigrates[]" type="checkbox">
										</td>
										<td>
											<label for="<?= $worker['id'] ?>" style="font-weight:normal">
												<?= $worker['name'].' '.$worker['lastname'] ?>
											</label>
										</td>
										<td class="text-center">
											<?php $checked = ($crew['id_leader'] == $worker['id']) ? 'checked' : false ?>
											<input type="radio" name="leader" value="<?= $worker['id'] ?>" <?= $checked ?>>
										</td>
									</tr>
									<?php endforeach ?>

								</tbody>
							</table>
							<div class="form-group">
								<label>Move to</label>
								<select class="form-control" name="crew">
									<option selected disabled></option>

									<?php foreach( $crews['options'] as $option): ?>
									<?php	if( $crew['id'] != $option['id']): ?>
									<option value="<?= $option['id'] ?>"><?= $option['nick'] ?></option>
									<?php endif ?>
									<?php endforeach ?>

								</select>
							</div>
							<input type="hidden" name="nick" value="<?= $crew['nick'] ?>">
							<input type="hidden" name="needle" value="<?= $crew['id'] ?>">
							<button class="btn btn-success btn-sm" type="submit">
								<span class="glyphicon glyphicon-repeat"></span>
								<span class="margin-sm-left">Reorganize</span>
							</button>
						</form>
						<?php elseif(!$crew['enabled']): ?>
						<p class="<?= $muted ?>"><b>DISABLED</b></p>
						<?php else: ?>
						<p><b>EMPTY</b></p>
						<?php endif ?>
					</div>
				</div>
			</div>
			
			<?php if($clearfix == 3): $clearfix = 0 ?>
			<div class="clearfix"></div>
			<?php endif ?>
			
    <?php endforeach ?>
    
    <?php foreach($crews['external'] as $crew): $clearfix++ ?>
			<div class="col-xs-12 col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-9">
								<?php $muted = !$crew['enabled'] ? 'text-muted' : false ?>
								<b class="display-2 <?= $muted ?>"><?= $crew['nick'] ?></b>
							</div>
							<div class="col-xs-3 text-right">
								<a class="btn btn-sm btn-primary" href="<?= DOMAIN ?>/crews/edit/<?= $crew['id'] ?>" data-toggle="tooltip" data-placement="top" title="Edit">
									<span class="glyphicon glyphicon-cog"></span>
								</a>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<p class="<?= $muted ?>"><b>SUBCONTRATOR</b></p>
					</div>
				</div>
			</div>
			
			<?php if($clearfix == 3): $clearfix = 0 ?>
			<div class="clearfix"></div>
			<?php endif ?>

    <?php endforeach ?>
    
    </div> 
	</div>