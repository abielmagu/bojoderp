<?php
$crews = array();
$crews['free'] = $data['free'];
$crews['internal'] = $data['internal'];
$crews['external'] = $data['external'];
$crews['options']  = $data['options'];
?>

<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

<?php if( !empty($crews['internal']) || !empty($crews['external']) ): ?>

<?php include_once VIEWS.'app/partials/message.php'; ?>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="row margin-lg-y">
				<div class="col-xs-9">
					<h1 class="margin-less">Crews</h1>
				</div>
				<div class="col-xs-3 text-right">
					<a class="btn btn-primary" href="<?= DOMAIN ?>/crews/add">
						<span class="glyphicon glyphicon-plus"></span>
						<span class="hidden-xs margin-sm-left">New crew</span>
					</a>
				</div>
			</div>
		</div>
		<div class="panel-body"></div>
	</div>
	
	<!-- DESKTOP	-->
	<?php include '_index/screen.php' ?>
	
	<!-- PRINT -->
	<?php #include 'index_print.php' ?>

<?php else: $entity = array('name'=>'Crews', 'url'=>'crews/add') ?>

<?php include_once VIEWS.'app/partials/firstone.php' ?>

<?php endif ?>

</div>
