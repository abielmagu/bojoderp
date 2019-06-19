<div class="row">
  <div class="col-sm-4">
    <div class="form-group">
      <label>Serial</label>
      <input class="form-control" type="text" name="serial" required>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label>Model</label>
      <input class="form-control" type="text" name="model" required>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label>Tons</label>
      <input class="form-control" type="number" name="tons" min="0" step="0.1" required>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="col-sm-3">
    <label>Type</label>
    <div class="radio">
      <label><input name="kindcentral" value="gas" type="radio" checked>Gas</label>
      <label class="margin-left"><input name="kindcentral" value="electric" type="radio">Electric</label>
    </div>
  </div>
  <div class="col-sm-3">
    <label>Platform</label>
    <div class="radio">
      <label><input name="platform" value="0" type="radio" checked>No</label>
      <label class="margin-left"><input name="platform" value="1" type="radio">Yes</label>
    </div>
  </div>
</div>