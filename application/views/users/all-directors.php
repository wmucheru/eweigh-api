<section class="content-header">
    <h1>
        <?php echo isset($page_title) ? $page_title : ''; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard'); ?>"> Home</a></li>
        <li class="active">Corporates</li>
    </ol>
</section>

<div class="row">
	<div class="col-md-12">
		<div class="box">
            <div class="box-header">
                <div class="box-tools btn-group btn-group-solid pull-right">
                    <a href="<?php echo site_url('users/corporates'); ?>" class="btn btn-default">Activated</a>
                    <a href="<?php echo site_url('users/corporates/pending'); ?>" class="btn btn-warning">Pending</a>
                </div><br/>
            </div>
	        <div class="box-body table-responsive">
	        	<?php 
					$corp_success = $this->session->flashdata('corp_success');
					$corp_fail = $this->session->flashdata('corp_fail');

					if(isset($corp_success) && $corp_success !== ''){
						echo '<div class="alert alert-success">' . $corp_success . '</div>';
					}

					if(isset($corp_fail) && $corp_fail !== ''){
						echo '<div class="alert alert-danger">' . $corp_fail . '</div>';
					}

					# var_dump($corporates);

					if(!isset($corporates) || count($corporates) === 0){
						echo '<p class="no-data">No pending accounts</p>';
					}
					else{

						if(isset($view_mode) && $view_mode == true){

							$current = $corporates[0];
							$corp_id = $current->corporate_id;

							# var_dump($current);
				?>
				<div class="clearfix">
					<h3 style="margin:0 0 1em;"><?php echo $current->corporate_name; ?></h3>

					<?php

						if($current->confirmed == '0' && $this->groups_model->isAdmin()){
					?>
					<span class="pull-right">
						<a href="<?php echo site_url('users/approve_corp/' . $corp_id); ?>" class="btn btn-success">
							<i class="fa fa-check"></i> Approve Account
						</a>

						<a href="<?php echo site_url('users/decline_corp/' . $corp_id); ?>" class="btn btn-danger">
							<i class="fa fa-times"></i> Decline Account
						</a>
					</span>
					<?php
						}
					?>
					<ul class="nav nav-tabs">
						<li class="active"><a href="#home" data-toggle="tab">Account Details</a></li>
						<li><a href="#docs" data-toggle="tab">Uploaded Documents</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="home">
							<?php 

								# var_dump($corporates);

								$corp = $corporates[0];

								$name = $corp->name;
								$corporate_name = $corp->corporate_name;
								$email = $corp->email;
								$date_created = $corp->date_created;

								$contact_person = $corp->contact_person;
								$telephone = $corp->telephone;
								$postal_address = $corp->postal_address;
								$physical_address = $corp->physical_address;
							?>
							<div class="col-sm-4" style="padding-left:0;">
								<h4>Basic Details</h4><hr/>

								<p><b>Company Name:</b> <?php echo $corporate_name; ?></p>
								<p><b>Admin:</b> <?php echo $name; ?></p>
								<p><b>Email:</b> <?php echo $email; ?></p>
								<p><b>Date Created:</b> <?php echo $date_created; ?></p>
								
								<br/>
								<h4>Contact Info</h4><hr/>

								<p><b>Contact Person:</b> <?php echo $contact_person; ?></p>
								<p><b>Telephone:</b> <?php echo $telephone; ?></p>
								<p><b>Postal Address:</b> <?php echo $postal_address; ?></p>
								<p><b>Physical Address:</b> <?php echo $physical_address; ?></p>
							</div>
							<div class="col-sm-8">
								<h4>Members</h4>
								<?php

									# var_dump($corporate_members);

									if(empty($corporate_members)){

										echo '<div class="alert alert-info">No members created yet</div>';
									}
									else{

										$members = $corporate_members[0];
								?>
								<table class="table table-bordered table-striped datatable">
					            <thead>
					            <tr>
					                <th>Name</th>
					                <th>Email</th>
					                <th>Mobile</th>
					                <th>Date Registered</th>
					                <th>Status</th>
					            </tr>
					            </thead>
					            <tbody>
					            <?php 
					            	foreach($corporate_members as $member){

					            		$corp_status = ($corp->confirmed == '0') ? 'pending' : 'active';
					            ?>
					            <tr class="<?php echo $corp_status; ?>">
					                <td><?php echo $member->name; ?></td>
					                <td><?php echo $member->email; ?></td>
					                <td><?php echo $member->mobile; ?></td>
					                <td><?php echo $this->site_model->date_format($member->date_registered); ?></td>
					                <td>
					                <?php
					                	if($member->banned == '0'){
					                		echo '<span style="color:green">ACTIVE</span>';
					                	}
					                	else{
					                		echo '<span style="color:red">BANNED</span>';
					                	}
					                ?>
					            	</td>
					            </tr>
					            <?php } ?>
					            </tbody>
					            </table>
					            <?php
									} # ENDIF: Members section not empty
					            ?>
							</div>
						</div>
						<div class="tab-pane" id="docs">
							<h4>Documents</h4>

							<div class="col-md-3">
								<ul class="nav nav-pills nav-stacked upload-doc-list">
									<li><a href="<?php echo base_url('content/uploads/corporate/' . $current->incorp_cert); ?>">Incorporation Certificate</a></li>
									<li><a href="<?php echo base_url('content/uploads/corporate/' . $current->pin_cert); ?>">Pin Certificate</a></li>
									<li><a href="<?php echo base_url('content/uploads/corporate/' . $current->council_licence); ?>">Council Licence</a></li>
								</ul>
							</div>
							<div class="col-md-9 doc-embed">
								<embed src="<?php echo base_url('content/uploads/corporate/' . $current->incorp_cert); ?>"
									width="100%" height="600px"></embed>
							</div>
							<script>
							$(document).ready(function(){
								var doc_links = $(".upload-doc-list li a"),
									embed_box = $(".doc-embed");

								doc_links.click(function(e){
									e.preventDefault();
									
									var docurl = $(this).attr('href');
									embed_box.empty()
											 .html('<embed src="' + docurl + '" width="100%" height="600px"></embed>');
								});
							});
							</script>
						</div>
					</div>
				</div>

				<?php
					}
					else{
	        	?>
	        	<div class="col-md-12">
	        		<table class="table table-bordered table-striped datatable">
		            <thead>
		            <tr>
		                <th>Corporate name</th>
		                <th>Email</th>
		                <th>Address</th>
		                <th>Telephone</th>
		                <th>Contact person</th>
		                <th>Date created</th>
		                <th>Status</th>
		                <th>Actions</th>
		            </tr>
		            </thead>
		            <tbody>
		            <?php 
		            	# var_dump($corporates);

		            	foreach($corporates as $corp){

		            		$corp_status = ($corp->confirmed == '0') ? 'pending' : 'active';
		            ?>
		            <tr class="<?php echo $corp_status; ?>">
		                <td><?php echo $corp->corporate_name; ?></td>
		                <td><?php echo $corp->email; ?></td>
		                <td><?php echo $corp->physical_address; ?></td>
		                <td><?php echo $corp->telephone; ?></td>
		                <td><?php echo $corp->contact_person; ?></td>
		                <td><?php echo $this->site_model->date_format($corp->date_created); ?></td>
		                <td>
		                <?php
		                	if($corp->confirmed == '0'){
		                		echo '<span style="color:red">PENDING</span>';
		                	}
		                	else{
		                		echo '<span style="color:green">ACTIVE</span>';
		                	}
		                ?>
		            	</td>
		                <td>
		                	<a class="btn btn-info btn-sm" href="<?php echo site_url('users/corporates/view/'. $corp->user_id); ?>">
		                		<i class="fa fa-eye"></i> View
		                	</a>
		                </td>
		            </tr>
		            <?php } ?>
		            </tbody>
		            </table>
		            <?php
							}
						}
		            ?>
	        	</div>
	        </div>
	    </div>
	</div>
</div>