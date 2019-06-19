 <div id="nav" class="col-md-2 hidden-xs hidden-sm hidden-print">
  <div class="list-group">
    <div class="list-group-item active">
			<span class="block display-2"><?= COMPANYNAME ?></span>
			<small><?= DATE_USA ?></small>
    </div>
    <div class="list-group-item active background-semiblack">
			<span class="glyphicon glyphicon-user margin-right"></span><?= $_SESSION['user']['name'] ?>
    </div>
    <a href="<?= DOMAIN ?>/!#" class="list-group-item" data-toggle="modal" data-target="#search">
      <span class="glyphicon glyphicon-search margin-right"></span> Search client
    </a>
    <a href="<?= DOMAIN ?>/dashboard" class="list-group-item">
      <span class="glyphicon glyphicon-stats margin-right"></span> Dashboard
    </a>
    <a href="<?= DOMAIN ?>/works/" class="list-group-item">
      <span class="glyphicon glyphicon-list margin-right"></span> Works
      <span class="badge"><?= $GLOBALS['worksCount'] ?></span>
    </a>
    <a href="<?= DOMAIN ?>/inspections/" class="list-group-item">
      <span class="glyphicon glyphicon-eye-open margin-right"></span> Inspections
      <span class="badge"><?= $GLOBALS['inspectionsCount'] ?></span>
    </a>
    <a href="<?= DOMAIN ?>/guarantees/" class="list-group-item">
      <span class="glyphicon glyphicon-certificate margin-right"></span> Guarantees
      <span class="badge"><?= $GLOBALS['guaranteesCount'] ?></span>
    </a>
    <a href="<?= DOMAIN ?>/clients/" class="list-group-item">
      <span class="glyphicon glyphicon-bookmark margin-right"></span> Clients
    </a>
    <a href="<?= DOMAIN ?>/intermediaries/" class="list-group-item">
      <span class="glyphicon glyphicon-briefcase margin-right"></span> Intermediaries
    </a>
    <a href="<?= DOMAIN ?>/crews/" class="list-group-item">
      <span class="glyphicon glyphicon-th margin-right"></span> Crews
    </a>
    <a href="<?= DOMAIN ?>/workers/" class="list-group-item">
      <span class="glyphicon glyphicon-wrench margin-right"></span> Workers
    </a>
    
    <?php if(Session::get('kind') === 'admin'): ?>
    <a href="<?= DOMAIN ?>/administrators/" class="list-group-item">
      <span class="glyphicon glyphicon-education margin-right"></span> Administrators
    </a>
    <a href="<?= DOMAIN ?>/settings" class="list-group-item">
      <span class="glyphicon glyphicon-cog margin-right"></span> Settings
    </a>
		<?php endif ?>
   
    <a href="<?= DOMAIN ?>/help" class="list-group-item hidden">
      <span class="glyphicon glyphicon-question-sign margin-right"></span> Help
    </a>
    <a href="<?= DOMAIN ?>/logout" class="list-group-item"><!-- list-group-item-warning -->
      <b class="text-danger">
        <span class="glyphicon glyphicon-log-out margin-right"></span> Logout
      </b>
    </a>
  </div>
</div>