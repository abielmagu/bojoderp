<?php $worker = $data['worker'] ?>
	
<?php include dirname(dirname(__FILE__)).'/_col-sizes.php' ?>
	
	<?php if(!empty($worker)): ?>
	<?php include_once VIEWS.'app/partials/message.php' ?>

	<?php 
		$languages = array('english' , 'spanish');
		$documents = array('driver'	 , 'passport');
		$stages 	 = array('training', 'completed');
	?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="margin-lg-y">Edit worker</h1>
		</div>
		<div class="panel-body">
			<p class="text-right text-muted">Last updated: <?= $worker['updated_at'] ?></p>
			<form action="<?= DOMAIN ?>/workers/update" method="post" autocomplete="off">
				<div class="form-group">
					<label for="name">Name</label>
					<input class="form-control" type="text" name="name" value="<?= $worker['name'] ?>" required>
				</div>
				<div class="form-group">
					<label for="lastname">Lastname</label>
					<input class="form-control" type="text" name="lastname" value="<?= $worker['lastname'] ?>" required>
				</div>
				<div class="form-group">
					<label for="birthday">Birthday</label>
					<input class="form-control" type="date" name="birthday" value="<?= $worker['birthday'] ?>" required>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="phone">Phone</label>
							<input class="form-control" type="text" name="phone" value="<?= $worker['phone'] ?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="email">Email</label>
							<input class="form-control" type="email" name="email" value="<?= $worker['email'] ?>" required>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-2">
						<label>Languages</label>
						<?php $worker_languages = explode(',', $worker['skills_languages']) ?>
						<?php foreach($languages as $language): ?>
						<?php $checked = (in_array($language, $worker_languages)) ? 'checked' : ''; ?>
						<div class="checkbox">
							<label>
								<input name="languages[]" type="checkbox" value="<?= $language ?>" <?= $checked ?>> <?= ucfirst($language) ?>
							</label>
						</div>
						<?php endforeach ?>
					</div>
					<div class="col-sm-2">
						<label>Documents</label>
						<?php $worker_documents = explode(',', $worker['skills_documents']) ?>
						<?php foreach($documents as $document): ?>
						<?php $checked = (in_array($document, $worker_documents)) ? 'checked' : ''; ?>
						<div class="checkbox">
							<label>
								<input name="documents[]" type="checkbox" value="<?= $document ?>" <?= $checked ?>> <?= ucfirst($document) ?>
							</label>
						</div>
						<?php endforeach ?>
					</div>
					<div class="col-sm-2">
						<label>Stage</label>
						<?php foreach($stages as $stage): ?>
						<?php $checked = $worker['stage'] == $stage ? 'checked' : ''; ?>
						<div class="radio">
						<label for="<?= $stage ?>">
								<input type="radio" name="stage" id="<?= $stage ?>" value="<?= $stage ?>" <?= $checked ?>> <?= ucfirst($stage) ?>
							</label>
						</div>
						<?php endforeach ?>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label for="notes">Notes</label>
					<textarea class="form-control" name="notes" rows="3" style="resize: vertical" required><?= $worker['notes'] ?></textarea>
				</div>
				<br>
				<p class="text-right">
					<input type="hidden" name="needle" value="<?= $worker['id'] ?>">
					<button class="btn btn-success" type="submit" name="buttonCreate">Update worker</button>
					<a class="btn btn-default margin-left" href="<?= DOMAIN ?>/workers/">Cancel</a>
				</p>
			</form>
		</div>
	</div>
	
	<?php else: $entity = array('name' => 'Worker', 'url' => 'workers') ?>

	<?php include_once VIEWS.'app/partials/missing.php' ?>
	
	<?php endif ?>
	
</div>