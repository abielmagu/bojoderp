<div class="form-group">
  <label>Application permit #</label>
  <input class="form-control" type="text" name="permitSerial" required>
</div>
<div id="ms-pieces">
  <div id="clone-original" class="row">
    <div class="col-sm-3">
      <div class="form-group">
        <label>Type</label>
        <select class="form-control" name="kinds[]" required>
          <option disabled selected></option>
          <option value="air handler">Ductless air handler</option>
          <option value="condenser">Condenser</option>
        </select>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <label>Serial</label>
        <input class="form-control" type="text" name="serials[]" required>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <label>Brand</label>
        <input class="form-control" type="text" name="brands[]" required>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <label>Placement</label>
        <input class="form-control" type="text" name="placements[]" required>
      </div>
    </div>
    <div class="col-sm-1" style="padding-top: 2.4rem">
    	<button data-remove="cloned" class="btn btn-warning btn-block hidden" type="button"><span class="glyphicon glyphicon-remove"></span></button>
    </div>
  </div>
</div>
<button data-clone="ms-pieces" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-plus"></span> Add piece</button>