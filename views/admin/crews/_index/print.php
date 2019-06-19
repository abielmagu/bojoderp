	<div class="visible-print-block">
   
    <div class="row">
      <?php $clearfix = 1; if( $counterFreeWorkers > 0 ): ?>
      
			<div class="col-xs-4 box-nobreak">
				<div class="thumbnail">
					<div class="caption">
						<h4 class="text-success">Free workers</h4>
						<form action="<?= DOMAIN ?>crews/reorganize" method="post">
							<table class="table table-striped table-condensed table-bordered">
								<thead>
									<tr>
										<th><span class="glyphicon glyphicon-check"></span> Worker</th>
									</tr>
								</thead>
								<tbody>

								 <?php foreach( $crewFree as $workerId => $workerFullname ): ?>
								 <tr>
									 <td>
										 <input id="<?= $workerFullname ?>" name="crewMembers[]" value="<?= $workerId ?>" type="checkbox">
										 <label for="<?= $workerFullname ?>"><?= $workerFullname ?></label>
									 </td>
								 </tr>
								 <?php endforeach; ?>

								</tbody>
							</table>
							<div class="form-group">
								<label>Crews</label>
								<select class="form-control input-sm" name="crewEmigrate" required>
									<option selected disabled></option>

									<?php foreach( $crewsOptions as $nickOption => $propOption ): if( $propOption['kind'] == 'internal' ): ?>
									<option value="<?= $propOption['id'] ?>"><?= $nickOption ?></option>
									<?php endif; endforeach ?>

								</select>
							</div>
							<p class="text-right">
								<button class="btn btn-success btn-sm" type="submit" name="buttonCrewEmpty"><span class="glyphicon glyphicon-share-alt"></span> Move</button>
							</p>
						</form>
					</div>
				</div>
			</div>

    <?php $clearfix++; endif ?>
    <?php foreach($crews as $nickCrew => $propCrew): ?>

    <?php if($clearfix > 3): $clearfix = 1 ?> <div class="clearfix"></div> <?php endif ?>

			<div class="col-xs-4 box-nobreak">
				<div class="thumbnail">
					<div class="caption">
						<div class="row">
							<div class="col-xs-10">
								<h4><?= $nickCrew ?></h4>
							</div>
							<div class="col-xs-2">
								<a href="<?= BASE ?>crew/edit/<?= $propCrew["id"] ?>"><span class="glyphicon glyphicon-cog text-md-size"></span></a>
							</div>
						</div>

						<?php if( $propCrew['kind'] == 'internal' && count( $propCrew['workers'] ) > 0 ): ?>
						<form action="<?= BASE ?>crew/reorganize" method="post">
							<table class="table table-striped table-condensed table-bordered">
								<thead>
									<tr>
										<th><span class="glyphicon glyphicon-check"></span> Worker</th>
										<th class="text-center">Leader</th>
									</tr>
								</thead>
								<tbody>

									<?php foreach( $propCrew['workers'] as $workerId => $workerFullname ) : ?>
									<tr>
										<td>
											<label>
												<input value="<?= $workerId ?>" name="crewMembers[]" type="checkbox">
												<span style="font-weight: normal"><?= $workerFullname ?></span>
											</label>
										</td>
										<td class="text-center">
											<?php $checked = ( $workerId == $propCrew['leader'] ) ? 'checked' : '' ?>
											<input type="radio" name="crewLeader" value="<?= $workerId ?>" <?= $checked ?>>
										</td>
									</tr>
									<?php endforeach ?>

								</tbody>
							</table>
							<div class="form-group">
								<label>Move to</label>
								<select class="form-control input-sm" name="crewEmigrate">
									<option selected disabled></option>

									<?php
										foreach( $crewsOptions as $nickOption => $propOption ):
											if( $propOption['kind'] == 'internal' && $propOption['id'] != $propCrew['id'] ):
									 ?>
									<option value="<?= $propOption['id'] ?>"><?= $nickOption ?></option>
									<?php endif; endforeach ?>

								</select>
							</div>
							<p class="text-right">
								<input type="hidden" name="crewCurrent" value="<?= $nickCrew ?>">
								<input type="hidden" name="row" value="<?= $propCrew['id'] ?>">
								<button class="btn btn-success btn-sm" type="submit"><span class="glyphicon glyphicon-repeat"></span> Reorganize</button>
							</p>
						</form>

					<?php elseif( $propCrew['kind'] == 'external' ): ?>
						<p class="text-warning">SUBCONTRACTOR CREW</p>

					<?php else: ?>
						<p class="text-warning">EMPTY CREW</p>

					<?php endif; ?>
					</div>
				</div>
			</div>
    	<?php $clearfix++; endforeach; ?>
    </div>
	</div>