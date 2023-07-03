<div class="clearfix">
	<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#apModal">
		<i class="fa fa-plus"></i> Add Permission
	</button>

	<div class="modal fade" id="apModal" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Add Permission</h4>
				</div>
				<div class="modal-body clearfix">
					<?php

						$options = array('class'=>'col-md-12 form-horizontal', 'role'=>'form');

						echo form_open('users/permissions/add', $options);
					?>
					<div class="form-group">
						<label class="col-sm-4 control-label">Permission name</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" 
						  	value="<?php echo set_value('permname'); ?>" name="permname" required/>
						  <?php echo form_error('permname'); ?>
						  <br/>
						</div>
						<label class="col-sm-4 control-label">Description</label>
						<div class="col-sm-8">
							<textarea class="form-control" name="permdescription" required></textarea>
						</div>
						<?php echo form_error('permdescription'); ?>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
						  <button type="submit" class="btn btn-info">Add permission</button>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
</div>