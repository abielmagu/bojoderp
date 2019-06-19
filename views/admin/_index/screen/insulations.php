<div class="row">
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Attic insulation <span class="pull-right label label-info"><?= $atticInsulations['total'] ?></span></h4>
			</div>
			<div class="panel-body">
				<div class="row text-center">
					<div class="col-xs-4">
						<p><b>Completed</b> <br> <?= $atticInsulations['closed'] ?></p>
					</div>
					<div class="col-xs-4">
						<p><b>Cancelled</b> <br> <?= $atticInsulations['cancelled'] ?></p>
					</div>
					<div class="col-xs-4">
						<p><b>Pending</b> <br> <?= $atticInsulations['pending'] ?></p>
					</div>
				</div>

				<?php foreach( $atticInsulations['methods'] as $title => $method ): ?>
				<hr>

				<?php if( $method['total'] ): ?>
				<a class="btn btn-primary btn-xs pull-right switcher-slide" href="#">
					<b class="margin-right"><?= $method['total'] ?></b> 
					<span class="glyphicon glyphicon-chevron-down rotator"></span>
				</a>
				<p><?= $title ?></p>
				<small class="element-slide" style="display: none">
					<table class="table table-condensed">
						<thead>
							<tr>
								<th>Global</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Sq. feets covered</td>
								<td><?= $method['sqfts'] ?></td>
							</tr>
							<tr>
								<td>Bags used</td>
								<td><?= $method['bags'] ?></td>
							</tr>
						</tbody>
					</table>

					<table class="table table-condensed">
						<thead>
							<tr>
								<th>R-Value</th>
								<th>Sq. feets</th>
								<th>Bags</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach( $method['rvalues'] as $rvalue => $details ): ?>
							<tr>
								<td><?= $rvalue ?></td>
								<td><?= $details['sqfts'] ?></td>
								<td><?= $details['bags'] ?></td>
								<td><?= $details['total'] ?></td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
				</small>

				<?php else: ?>
				<p class="text-muted"><?= $title ?></p>

				<?php endif ?>
				<?php endforeach ?>

			</div>
		</div>
	</div>
       
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">
			<h4>Wall insulation <span class="pull-right label label-info"><?= $wallInsulations['total'] ?></span></h4>
			</div>
			<div class="panel-body">
				<div class="row text-center">
					<div class="col-xs-4">
						<p><b>Completed</b> <br> <?= $wallInsulations['closed'] ?></p>
					</div>
					<div class="col-xs-4">
						<p><b>Cancelled</b> <br> <?= $wallInsulations['cancelled'] ?></p>
					</div>
					<div class="col-xs-4">
						<p><b>Pending</b> <br> <?= $wallInsulations['pending'] ?></p>
					</div>
				</div>
				
				<?php foreach( $wallInsulations['methods'] as $title => $method ): ?>
				<hr>
			
				<?php if( $method['total'] ): ?>
				<a class="btn btn-primary btn-xs pull-right switcher-slide" href="#">
					<b class="margin-right"><?= $method['total'] ?></b> 
					<span class="glyphicon glyphicon-chevron-down rotator"></span>
				</a>
				<p><?= $title ?></p>
				<small class="element-slide" style="display: none">
					<table class="table table-condensed">
						<thead>
							<tr>
								<th>Global</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Sq. feets covered</td>
								<td><?= $method['sqfts'] ?></td>
							</tr>
							<tr>
							<td>Bags used</td>
								<td><?= $method['bags'] ?></td>
							</tr>
						</tbody>
					</table>
					
					<table class="table table-condensed">
						<thead>
							<tr>
								<th>R-Value</th>
								<th>Sq. feets</th>
								<th>Bags</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach( $method['rvalues'] as $rvalue => $rvalueItem ): ?>
							<tr>
								<td><?= $rvalue ?></td>
								<td><?= $rvalueItem['sqfts'] ?></td>
								<td><?= $rvalueItem['bags'] ?></td>
								<td><?= $rvalueItem['total'] ?></td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
				</small>
				
				<?php else: ?>
				<p class="text-muted"><?= $title ?></p>
				
				<?php endif ?>
				<?php endforeach ?>
				
			</div>
		</div>
	</div>
       
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Batt insulation <span class="pull-right label label-info"><?= $battInsulations['total'] ?></span></h4>
			</div>
			<div class="panel-body">
				<div class="row text-center">
					<div class="col-xs-4">
						<p><b>Completed</b> <br> <?= $battInsulations['closed'] ?></p>
					</div>
					<div class="col-xs-4">
						<p><b>Cancelled</b> <br> <?= $battInsulations['cancelled'] ?></p>
					</div>
					<div class="col-xs-4">
						<p><b>Pendings</b> <br> <?= $battInsulations['pending'] ?></p>
					</div>
				</div>

				<?php foreach( $battInsulations['methods'] as $title => $method ): ?>
				<hr>
			
				<?php if( $method['total'] ): ?>
				<a class="btn btn-primary btn-xs pull-right switcher-slide" href="#">
					<b class="margin-right"><?= $method['total'] ?></b> 
					<span class="glyphicon glyphicon-chevron-down rotator"></span>
				</a>
				<p><?= $title ?></p>
				<small class="element-slide" style="display: none">
					<table class="table table-condensed">
						<thead>
						<tr>
						<th>Global</th>
						<th>Totals</th>
						</tr>
						</thead>
						<tbody>
						<tr>
						<td>Square feets covered</td>
						<td><?= $method['sqfts'] ?></td>
						</tr>
						</tbody>
					</table>
					
					<div class="table-responsive">
					<table class="table table-condensed text-center">
						<thead>
							<tr>
								<th class="nowrap text-center">R-Value</th>
								<th class="nowrap text-center">Square feets</th>
								<th class="nowrap text-center">Face</th>
								<th class="nowrap text-center">Unface</th>
								<th class="nowrap text-center">Big</th>
								<th class="nowrap text-center">Small</th>
								<th class="nowrap text-center">Total</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($method['rvalues'] as $rvalue => $details): ?>
							<tr>
								<td><?= $rvalue ?></td>
								<td><?= $details['sqfts'] ?></td>
								<td><?= $details['facing']['face'] ?></td>
								<td><?= $details['facing']['unface'] ?></td>
								<td><?= $details['size']['big'] ?></td>
								<td><?= $details['size']['small'] ?></td>
								<td><?= $details['total'] ?></td>
							</tr>
						<?php endforeach ?>
						</tbody>
					</table>
					</div>
				</small>
				
				<?php else: ?>
				<p class="text-muted"><?= $title ?></p>
				
				<?php endif ?>
				<?php endforeach ?> 
			</div>
		</div>
	</div>
        
</div>