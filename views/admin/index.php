<?php require_once '_index/data.php' ?>

<?php // SCREEN ?>
<div class="hidden-print col-sm-12 col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">Dashboard</h1>
		</div>
	</div>
	<?php require_once '_index/screen/range.php' ?>
	<?php require_once '_index/screen/works.php' ?>
	<?php require_once '_index/screen/insulations.php' ?>
	<?php require_once '_index/screen/intermediaries.php' ?>
	<?php require_once '_index/screen/zipcodes.php' ?>
</div>

<?php // PRINT ?>    
<div class="visible-print-block col-xs-12">
	<p class="text-center"><strong>DASHBOARD PRINTED | <?= DATE_NOW ?></strong></p>
	<?php require_once '_index/print/range.php' ?>
	<?php require_once '_index/print/works.php' ?>
	<?php require_once '_index/print/insulations.php' ?>
	<?php require_once '_index/print/intermediaries.php' ?>
	<?php require_once '_index/print/zipcodes.php' ?>
</div>
