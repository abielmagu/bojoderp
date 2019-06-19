<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label for="">Square feets</label>
			<input class="form-control" type="number" name="sqfts" min="0" step="0.01" value="<?= $details['square_feets'] ?>">
		</div>
	</div>
	<div class="col-md-3">
		<label for="">On attic</label>
		<div class="radio">
			<?php 
				$attic = array(0 => '', 1 => '');
				$attic[$details['attic']] = 'checked';
			?>
			<label><input type="radio" name="attic" value="1" <?= $attic[1] ?>> Yes</label>
			<label class="margin-lg-left"><input type="radio" name="attic" value="0" <?= $attic[0] ?>> No</label>
		</div>
	</div>
	<div class="col-md-3">
		<label for="">On wall</label>
		<div class="radio">
			<?php 
				$wall = array(0 => '', 1 => '');
				$wall[$details['wall']] = 'checked';
			?>
			<label><input type="radio" name="wall" value="1" <?= $wall[1] ?>> Yes</label>
			<label class="margin-lg-left"><input type="radio" name="wall" value="0" <?= $wall[0] ?>> No</label>
		</div>		
	</div>
</div>
