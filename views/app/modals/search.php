<!-- Start modal-search -->
<div id="search" class="modal fade" <?php // tabindex="-1" ?> role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-header">
        <button type="button" class="btn btn-default pull-right margin-sm-right" data-dismiss="modal" aria-label="Close">Cancel</button> 
        <button type="button" class="close hidden" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title">Client search</h4>
      </div>
      
      <div class="modal-body">
        <form id="searchForm" action="<?= DOMAIN ?>/clients/search/" method="post" autocomplete="off">
					<div class="row">
						<div class="col-sm-3">			
							<select name="field" class="form-control" required>
								<option value="address">Address</option>
								<option value="phone">Phone</option>
								<option value="city">City</option>
								<option value="name">Name</option>
								<option value="lastname">Lastname</option>
							</select>
							<br>
						</div>
						<div class="col-sm-9">					
							<div class="input-group">
								<input class="form-control" type="text" name="content" autofocus required>
								<div class="input-group-btn">
									<button type="submit" class="btn btn-primary">Search</button>
								</div>
							</div>
						</div>
					</div>
        </form>
      </div>
      
      <div class="modal-footer hidden"></div>
      
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->
<!-- End modal-search -->
