<div class="clearfix">
	<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#euModal">
		<i class="fa fa-pencil"></i> Edit User Details
	</button>

	<div class="modal fade" id="euModal" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Edit User Details</h4>
				</div>
				<div class="modal-body clearfix">
					<?php
						$user_info = $userdata;
						# var_dump($user_info);
						
						$id = isset($user_info) ? $user_info->id : '';
						$name = isset($user_info) ? $user_info->name : '';
						$email = isset($user_info) ? $user_info->email : '';
						$mobile = isset($user_info) ? $user_info->mobile : '';

						$options = array('class'=>'col-md-12 form-horizontal', 'role'=>'form');

						echo form_open('users/user_proc/edit/self', $options);

						if(isset($user_info)){
							echo form_hidden('user_id', $id);
						}
					?>
					<div class="form-group">
						<label for="user-fullname" class="col-sm-4 control-label">Full name</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="user-fullname" 
						  	value="<?php echo set_value('user_fullname', $name); ?>" name="user_fullname">
						  <?php echo form_error('user_fullname'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="user-email" class="col-sm-4 control-label">Email Address</label>
						<div class="col-sm-8">
						  <input type="email" class="form-control" id="user-email" 
						  	value="<?php echo set_value('user_email', $email); ?>" name="user_email">
						  <?php echo form_error('user_email'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="user-mobile" class="col-sm-4 control-label">Mobile</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="user-mobile" 
						  	value="<?php echo set_value('user_mobile', $mobile); ?>" name="user_mobile">
						  <?php echo form_error('user_mobile'); ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8 form-hint">
							<br/>
							Leave password fields blank to retain old password(s)
						</div>
					</div>

					<div class="form-group">
						<label for="user_passwd" class="col-sm-4 control-label">Password</label>
						<div class="col-sm-8">
						  <input type="password" class="form-control" id="user_passwd" name="user_password">
						  <?php echo form_error('user_password'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="con-passwd" class="col-sm-4 control-label">Confirm Password</label>
						<div class="col-sm-8">
						  <input type="password" class="form-control" id="con-passwd" name="con_user_password">
						  <?php echo form_error('confirm_user_password'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-4">
							<button class="btn btn-success">
							  	<i class="fa fa-check"></i> Save Details
							</button>
						</div>
					</div>
					<?php echo form_close(); ?>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
</div>
