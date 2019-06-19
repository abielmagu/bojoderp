<div class="panel panel-default">
	<div class="panel-heading">
		<h4>Calculate by dates</h4>
	</div>
	<div class="panel-body">
	<form action="<?= DOMAIN ?>/dashboard/?">
		<div class="row">
			<div class="col-md-5" style="margin-bottom:1.5rem">           
					<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-calendar hidden"></span> From</div>  
							<input type="date" class="form-control" value="<?= $from ?>" name="from" required>
					</div>
			</div>
			<div class="col-md-5" style="margin-bottom:1.5rem">     
					<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-calendar hidden"></span> To</div>
							<input type="date" class="form-control" value="<?= $to ?>" name="to" required>
					</div>
			</div>
			<div class="col-md-2 text-center">
				<button class="btn btn-primary btn-block" type="submit">
					<span class="glyphicon glyphicon-dashboard"></span>
					<span class="margin-sm-left">Calculate</span> 
				</button>
			</div>
		</div>
	</form>
	</div>
</div>
