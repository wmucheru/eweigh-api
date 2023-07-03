<div class="clearfix">
	<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ecpModal">
		<i class="fa fa-pencil"></i> Edit Corporate Details
	</button>

	<div class="modal fade" id="ecpModal" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Edit Corporate Details</h4>
				</div>
				<div class="modal-body clearfix">
					<?php 
						$users_success = $this->session->flashdata('users_success');

						if(isset($users_success) && $users_success !== ''){
							echo '<div class="alert alert-success">' . $users_success . '</div>';
						}


						if($this->session->flashdata('users_fail') != ''){
		                    echo '<div class="alert alert-error">' . $this->session->flashdata('users_fail') . '</div>';
		                }

						$user_info = $userdata;
						# var_dump($user_info);
						
						$id = isset($user_info) ? $user_info->id : '';

						# Corporate account details
						$corp_name = $corp_userdata->corporate_name;
						$postal = $corp_userdata->postal_address;
						$physical = $corp_userdata->physical_address;
						$telephone = $corp_userdata->telephone;
						$contact_person = $corp_userdata->contact_person;

						$options = array('class'=>'col-md-12 form-horizontal', 'role'=>'form');

						echo form_open('users/corp_proc', $options);

						echo form_hidden('user_id', $id);
					?>
					<div class="form-group">
						<label for="corporate_name" class="col-sm-4 control-label">Corporate Name</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="corporate_name" 
						  	value="<?php echo set_value('corporate_name', $corp_name); ?>" name="corporate_name">
						  <?php echo form_error('corporate_name'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="postal_address" class="col-sm-4 control-label">Postal Address</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="postal_address" 
						  	value="<?php echo set_value('postal_address', $postal); ?>" name="postal_address">
						  <?php echo form_error('postal_address'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="physical_address" class="col-sm-4 control-label">Physical Address</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="physical_address" 
						  	value="<?php echo set_value('physical_address', $physical); ?>" name="physical_address">
						  <?php echo form_error('physical_address'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="telephone" class="col-sm-4 control-label">Mobile</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="telephone" 
						  	value="<?php echo set_value('telephone', $telephone); ?>" name="telephone">
						  <?php echo form_error('telephone'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="contact_person" class="col-sm-4 control-label">Contact Person</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="contact_person" 
						  	value="<?php echo set_value('contact_person', $contact_person); ?>" name="contact_person">
						  <?php echo form_error('contact_person'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-8 col-sm-offset-4">
							<button class="btn btn-success">
							  	<i class="fa fa-check"></i> Save Details
							</button>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
</div>
