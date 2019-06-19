<div class="row">
  <div class="col-xs-6">
    <label>Cover</label>
    <div class="well well-sm text-center">
      <?php $cover = ( $work['details']['cover'] ) ? 'Yes' : 'No' ?>
      <?= $cover ?>
    </div>
  </div>
  <div class="col-xs-6">
    <label>Blower</label>
    <div class="well well-sm text-center">
      <?php $blower = ( $work['details']['blower'] ) ? 'Yes' : 'No' ?>
      <?= $blower ?>
    </div>
  </div>
</div>
