<?php 
$work 	= $data['work'];
$details = $data['details'];
$crews 	= $data['crews'];
$interms = $data['interms'];
$gallery = $data['gallery'];
$kindsWk = $GLOBALS['works'];
$statusWk = $GLOBALS['statusWork'];
#$statusBlocked = ( $work['closed_date'] != DATETIME_ZERO OR $work['canceled_date'] != DATETIME_ZERO ) ? true : false ;
?>

<?php include_once dirname(dirname(__FILE__)).'/_col-sizes.php' ?>

<?php include_once VIEWS.'app/partials/message.php' ?>

<!-- Screen -->
	<div class="hidden-print">
	<?php require_once '_edit/screen.php' ?>
	</div>

<!-- Print -->
	<div class="visible-print-block">
	<?php require_once '_edit/print.php' ?>
	</div>

</div>