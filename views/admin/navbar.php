<?php
$GLOBALS['worksCount'] 			 = Explorer::getContent(VIEWS.'app/counters', 'works.txt');
$GLOBALS['inspectionsCount'] = Explorer::getContent(VIEWS.'app/counters', 'inspections.txt');
$GLOBALS['guaranteesCount']  = Explorer::getContent(VIEWS.'app/counters', 'guarantees.txt');
?>

<div class="hidden-md hidden-lg">
	<div id="navbar" class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-options" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<span class="navbar-brand" style="font-size:16px"><?= COMPANYNAME ?> | <small><?= DATE_USA ?></small></span>
			</div>
			<div class="navbar-collapse collapse" id="navbar-options">
				<ul class="nav navbar-nav">
					<li class="active">
					<a>
						<span class="glyphicon glyphicon-user margin-right"></span>
						<?= $_SESSION['user']['name'] ?>
					</a>
					</li>
					<li>
						<a href="<?= DOMAIN ?>/!#" data-toggle="modal" data-target="#search">
							<span class="glyphicon glyphicon-search margin-right"></span> Search client
						</a>
					</li>
					<li>
						<a href="<?= DOMAIN ?>/dashboard/">
							<span class="glyphicon glyphicon-stats margin-right"></span> Dashboard
						</a>
					</li>
					<li>
						<a href="<?= DOMAIN ?>/works/">
							<span class="glyphicon glyphicon-list margin-right"></span> Works
							<span class="badge pull-right"><?= $GLOBALS['worksCount'] ?></span>
						</a>
					</li>
					<li>
						<a href="<?= DOMAIN ?>/inspections/">
							<span class="glyphicon glyphicon-eye-open margin-right"></span> Inspections
							<span class="badge pull-right"><?= $GLOBALS['inspectionsCount'] ?></span>
						</a>
					</li>
					<li>
						<a href="<?= DOMAIN ?>/guarantees/">
							<span class="glyphicon glyphicon-certificate margin-right"></span> Guarantees
							<span class="badge pull-right"><?= $GLOBALS['guaranteesCount'] ?></span>
						</a>
					</li>
					<li>
						<a href="<?= DOMAIN ?>/clients/">
							<span class="glyphicon glyphicon-bookmark margin-right"></span> Clients
						</a>
					</li>
					<li>
						<a href="<?= DOMAIN ?>/intermediaries/">
							<span class="glyphicon glyphicon-briefcase margin-right"></span> Intermediaries
						</a>
					</li>
					<li>
						<a href="<?= DOMAIN ?>/crews/">
							<span class="glyphicon glyphicon-th margin-right"></span> Crews
						</a>
					</li>
					<li>
						<a href="<?= DOMAIN ?>/workers/">
							<span class="glyphicon glyphicon-wrench margin-right"></span> Workers
						</a>
					</li>

					<?php if(Session::get('kind') === 'admin'): ?>
					<li>
						<a href="<?= DOMAIN ?>/administrators">
							<span class="glyphicon glyphicon-education margin-right"></span> Administrators
						</a>
					</li>
					<li>
						<a href="<?= DOMAIN ?>/settings">
							<span class="glyphicon glyphicon-cog margin-right"></span> Settings
						</a>
					</li>
					<?php endif ?>

					<li class="hidden">
						<a href="<?= DOMAIN ?>/help">
							<span class="glyphicon glyphicon-question-sign margin-right"></span> Help
						</a>
					</li>
					<li class="danger-bg">
						<a href="<?= DOMAIN ?>/logout">
							<b><span class="glyphicon glyphicon-log-out margin-right"></span> Logout</b>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="navbar" id="navbar-background"></div>
</div>

<?php	include_once VIEWS.'app/modals/search.php';	?>
<br>
