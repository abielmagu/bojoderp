<?php
$works = $data['works'];
$worksCount = count($works);
$kinds 	= $GLOBALS['works'];
$status = $GLOBALS['statusWork'];
$date = $data['date'];
?>

<div class="col-xs-12">
	<h1>Welcome <?= Session::get('name') ?> <br> <small>Summary | <?= DATE_USA ?></small></h1>
	<br>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row vertical-middle">
				<div class="col-xs-4">	
					<h4><span class="badge"><?= $worksCount ?></span> Works</h4>
				</div>
				<div class="col-xs-8">
					<form class="form-inline text-right" action="<?= DOMAIN ?>" method="get">
						<div class="input-group">
							<input type="date" class="form-control input-sm" value="<?= $date ?>" name="date">
							<div class="input-group-btn">
								<button class="btn btn-info btn-sm" type="submit">
									<span class="glyphicon glyphicon-calendar"></span>
<!--								<span class="margin-sm-left hidden-xs hidden-sm">Change date</span>-->
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
<!--
		<div class="panel-body">
-->
			<br>
			<?php if( is_array($works) && $worksCount): ?>
			<div class="table-responsive">
				<table class="table table-condensed table-hover table-stripedx table-counterx">
					<thead>
						<tr>
<!--						<th></th>-->
							<th class="text-center">Status</th>
							<th class="text-center">Priority</th>
							<th>Type</th>
							<th>Address</th>
<!--						<th>Location</th>-->
							<th>Client</th>
							<th class="text-center">Details</th>
						</tr>
					</thead>
					<tbody>
					    <?php 
                            $p = 1;
                            $k = $works[0]['kind'];
                        ?>
                        
						<?php foreach($works as $work): ?>
                       
                        <?php
                            if( $k !== $work['kind'] )
                            {
                                $p = 1;
                                $k = $work['kind'];
                                // $work['priority'] 
                            }
                        ?>
						<tr class="">
<!--						<td class="text-center text-muted"></td>-->
							<td class="text-center vertical-middle">
								<?php $label = $status[ $work['status'] ] ?>
								<span class="label label-<?= $label['color'] ?>"><?= $label['tag'] ?></span>
							</td>
							<td class="text-center vertical-middle">
							    <span class="label label-primary"><?= $p++ ?></span>
<!--							$work['priority']-->
							 </td>
							<td>
							    <span><?= $kinds[ $work['kind'] ] ?></span>
							    <br>
							    <span class="small">
							        CREW <b><?= $work['nick_crew'] ?></b>
							    </span>							    
							</td>
							<td class="text-uppercase">
							    <p style="margin:0px"><?= $work['address'] ?>, <?= $work['zip'] ?></p>
							    <small class="small"><?= $work['city'] .', '. $work['state'] ?></small>
							</td>
<!--						<td><?php //$work['city'] .', '. $work['state'] ?></td>-->
							<td>
							    <p style="margin:0"><?= $work['nameClient'] ?> <?= $work['lastname'] ?></p>
							    <small><?= $work['phone'] ?> / <?= $work['email'] ?></small>
							</td>
							<td class="text-center">
							    <a href="?date=<?= $data['date'] ?>&work=<?= $work['id'] ?>" class="btn btn-primary btn-sm">
							        <i class="glyphicon glyphicon-folder-open"></i>
							    </a>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<?php else: ?>
			<p class="text-muted"></p>
			<?php endif ?>
<!--	</div>-->
	</div>
</div>