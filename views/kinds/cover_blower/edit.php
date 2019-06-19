<div class="row">
  <div class="col-md-2">
    <?php
		$cover = array(0 => '', 1 => '');
		$cover[$details['cover']] = 'checked';
    ?>
    <label>Need cover?</label>
    <div class="radio">
      <label><input name="cover" value="1" type="radio" <?= $cover[1] ?>>Yes</label>
      <label class="margin-lg-left"><input name="cover" value="0" type="radio" <?= $cover[0] ?>>No</label>
    </div>
  </div>
  <div class="col-md-2">
    <?php
		$blower = array(0 => '', 1 => '');
		$blower[$details['blower']] = 'checked';
    ?>
    <label>Need blower?</label>
    <div class="radio">
      <label><input name="blower" value="1" type="radio" <?= $blower[1] ?>>Yes</label>
      <label class="margin-lg-left"><input name="blower" value="0" type="radio" <?= $blower[0] ?>>No</label>
    </div>
  </div>
</div>
<br>