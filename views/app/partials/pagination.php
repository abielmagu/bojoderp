<?php
$pagination = $data['pagination'];
$page  = $pagination['page']; 
$about = $pagination['about'];
$count = $pagination['count'];
$start = $pagination['start'];

$last  = ceil($count / LIMIT_ROWS);
$stop  = PAGINATION;

while($page > $stop)
{
	$stop += PAGINATION;
}

$init = ($stop - PAGINATION) + 1;
?>

<div class="page-navigation text-center">
	<ul class="pagination pagination-l_g">
	
		<?php if($page > PAGINATION): ?>
		<li><a href="<?= DOMAIN ?>/<?= $about ?>/page/1">First</a></li>
		<li><a href="<?= DOMAIN ?>/<?= $about ?>/page/<?= $init - PAGINATION ?>"><span class="glyphicon glyphicon-backward"></span></a></li>
		<li><a href="<?= DOMAIN ?>/<?= $about ?>/page/<?= $page - 1 ?>"><span class="glyphicon glyphicon-triangle-left"></span></a></li>
		<?php endif ?>
		
		<?php for($p = $init; $p <= $stop && $p <= $last; $p++): ?>
		<?php $active = ($p == $page) ? 'active' : false ?>
		<li class="<?= $active ?>"><a href="<?= DOMAIN ?>/<?= $about ?>/page/<?= $p ?>"><?= $p ?></a></li>
		<?php endfor ?>
		
		<?php if($page < $last && $p < $last): ?>
		<li><a href="<?= DOMAIN ?>/<?= $about ?>/page/<?= $page + 1 ?>"><span class="glyphicon glyphicon-triangle-right"></span></a></li>
		<li><a href="<?= DOMAIN ?>/<?= $about ?>/page/<?= $p ?>"><span class="glyphicon glyphicon-forward"></span></a></li>
		<li><a href="<?= DOMAIN ?>/<?= $about ?>/page/<?= $last ?>">Last</a></li>
		<?php endif ?>
	</ul>
</div>
<br>