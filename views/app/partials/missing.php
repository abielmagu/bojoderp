	<div class="jumbotron text-center">
		<h1><span class="text-muted">Hmm...</span></h1>
		<div class="container">
			<p class="display-3"><?= $entity['name'] ?> does not exist, check the list again</p>
			<br><br>
			<a href="<?= DOMAIN.'/'.$entity['url'] ?>" class="btn btn-primary">Ok! show me the list</a>
		</div>
	</div>