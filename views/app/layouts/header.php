<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= COMPANYNAME ?></title>
	<link rel="icon" href="<?= SOURCES ?>/images/demo.ico">
	<link rel="stylesheet" href="<?= SOURCES ?>/css/bootstrap/<?= THEME ?>.min.css">
	<link rel="stylesheet" href="<?= SOURCES ?>/css/bootstrap/bootstrap.print.css">
	<link rel="stylesheet" href="<?= SOURCES ?>/css/helpers.css">

	<?php if( isset($data['chartjs']) && $data['chartjs'] ): ?>
	<link  href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet">
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<?php endif ?>

	<script type="text/javascript" src="<?= SOURCES ?>/js/modernizr-custom.js"></script>
</head>
<body class="background-whitesmok_e" style="background-color:#e9e9e9">

<?php if(EXPIRED): ?>
	<div class="alert alert-danger text-center" style="border-radius:0">
		<span class="glyphicon glyphicon-ban-circle"></span>
		<b class="margin-sm-left">Your subscription has expired, contact your administrator.</b>
	</div>
<?php endif ?>

<?php if( Helper::notSupportedBrowser() ): ?>
	<div class="alert alert-warning text-center" style="border-radius:0">
		<span class="glyphicon glyphicon-warning-sign"></span>
		<span class="margin-sm-left">This browser is <b>not recommend</b>, try with <a href="https://www.google.com/chrome/index.html" class="alert-link" target="_blank">Google Chrome</a>, <a href="http://www.opera.com" class="alert-link" target="_blank">Opera</a> or <a href="https://www.mozilla.org/en-GB/firefox/new/" class="alert-link" target="_blank">Mozilla Firefox</a>.</span>
	</div>
<?php endif ?>
