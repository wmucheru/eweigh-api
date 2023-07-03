<section class="content-header">
    <h1>
        <?php echo isset($page_title) ? $page_title : ''; ?>
        <small>View your details</small>
    </h1>
</section>


<?php
	# var_dump($userdata);

	$name = $userdata->name;
	$email = $userdata->email;
	$mobile = $userdata->mobile;
	$last_login = $userdata->last_login;
	$photo_url = '';

	if($userdata->photo == ''){
		$photo_url = 'assets/img/default.png';
	}
	else{
		$photo_url = 'content/uploads/avatars/' . $userdata->photo;
	}
?>
<div class="clearfix">
    <div class="col-md-7">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Basic User details</h3>
                <div class="box-tools pull-right">
                    <?php $this->load->view('users/edit-user-personal'); ?>
                </div>
            </div>
            <div class="box-body">
                <div class="clearfix">
					<div class="col-md-8">
						<?php
							if($this->session->flashdata('users_success') != ''){
								echo '<div class="alert alert-success">' . $this->session->flashdata('users_success') . '</div>';
							}

							if($this->session->flashdata('users_fail') != ''){
								echo '<div class="alert alert-danger">' . $this->session->flashdata('users_fail') . '</div>';
							}
						?>
						<p><b>Name:</b> <?php echo $name; ?></p>
						<p><b>Email:</b> <?php echo $email; ?></p>
						<p><b>Mobile:</b> <?php echo $mobile; ?></p>
						<p><b>Last login:</b> <?php echo $this->site_model->date_format($last_login, 'long'); ?></p>
					</div>
					<div class="col-md-4">
						<img src="<?php echo base_url($photo_url) ?>" class="img-responsive" />
						<br/>
						<p>
							Allowed types: .JPG, .PNG (Maximum file size: 5MB)
						</p>
						<?php echo form_open_multipart('users/upload_profileimg'); ?>
						<button class="btn btn-default btn-sm btn-upload">
							<input type="file" name="ppic" id="ppic"/> 
							<i class="fa fa-camera"></i> Select image
						</button>
						<button type="submit" class="btn btn-info btn-sm">
							<i class="fa fa-check"></i> Upload
						</button>
						<?php echo form_close(); ?>
					</div>
				</div>
            </div>
        </div>

	    <?php

	        /*
	         * Show corporate user details (for editing also)
	         */
	        if($this->auth_model->is_member('Corporate')){
	    ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Corporate Account details</h3>
                <div class="box-tools pull-right">
                    <?php $this->load->view('users/edit-corporate'); ?>
                </div>
            </div>
            <div class="box-body">
                <div class="clearfix">
					<div class="col-md-9">
						<?php 
							# var_dump($corp_userdata); 

							$corp_name = $corp_userdata->corporate_name;
							$postal = $corp_userdata->postal_address;
							$physical = $corp_userdata->physical_address;
							$telephone = $corp_userdata->telephone;
							$contact_person = $corp_userdata->contact_person;

							if($this->session->flashdata('corp_success') != ''){
								echo '<div class="alert alert-success">' . 
										$this->session->flashdata('corp_success') . 
									 '</div>';
							}

							if($this->session->flashdata('corp_fail') != ''){
								echo '<div class="alert alert-danger">' . 
										$this->session->flashdata('corp_fail') . 
									 '</div>';
							}

						?>
						<p><b>Corporate Name:</b> <?php echo $corp_name; ?></p>
						<p><b>Postal address:</b> <?php echo $postal; ?></p>
						<p><b>Physical address:</b> <?php echo $physical; ?></p>
						<p><b>Telephone:</b> <?php echo $telephone; ?></p>
						<p><b>Contact Person:</b> <?php echo $contact_person; ?></p>
					</div>
				</div>
            </div>
        </div>
    	<?php } ?>
    </div>
</div>