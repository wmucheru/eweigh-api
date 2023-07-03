<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content">
		<div class="action-bar">
			<?php $this->load->view('users/add-user'); ?>
		</div>

		<div class="clearfix">
			<?php 
				$this->site_model->setFlashdataMessages('users');

				if(!empty($users)){
				#var_dump($users);
			?>
			
			<table class="table table-bordered table-responsive dt">		
				<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Telephone</th>
					<th>User Type</th>
					<th>Status</th>
					<th width="200px">Actions</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($users as $user){ ?>
				<tr>
					<td><?php echo $user->id; ?></td>
					<td><?php echo $user->name; ?></td>
					<td><?php echo $user->email; ?></td>
					<td><?php echo $user->mobile; ?></td>
					<td>
						<b>
							<?php
								# FOR ADMINS: Show if user is a corporate or a regular member
								# FOR CORPORATES: Show if user is a default, 
								$roles = $this->aauth->get_user_groups($user->id);
								$role_name = $roles[0]->name;
								echo $role_name;
								# var_dump($this->aauth->get_user_groups($user->id)[0]->name);
							?>
						</b>
					</td>
					<td>
					<?php 
						echo ($user->banned == '0') ? '<span class="active-status">ACTIVE</span>' 
							: '<span class="inactive-status">SUSPENDED</span>'; 
					?>
					</td>
					<td>
						<?php if($role_name != 'System'){ ?>

						<a href="<?php echo site_url('admin/users/edit/' . $user->id); ?>" class="btn btn-warning btn-xs">
							<i class="fa fa-edit"></i> Edit User
						</a>

							<?php
								if($user->banned == '0'){
							?>
							<a href="<?php echo site_url('admin/users/suspend_user/' . $user->id); ?>" class="btn btn-danger btn-xs">
								<i class="fa fa-times"></i> Suspend Account
							</a>
						
						<?php 
								} # ENDIF: Show Suspend account button if user is ACTIVE
							} # ENDIF: No actions on System User
						?>
					</td>
				</tr>
				<?php } ?>
				</tbody>
			</table>
		<?php 
			}
			else{
				echo '<div class="alert alert-info">No users found</div>';
			}
		?>
		</div>
	</div>
</div>