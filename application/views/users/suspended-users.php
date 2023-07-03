<div class="content-wrapper">

<section class="content-header">
	<hr />
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard'); ?>"> Home</a></li>
        <li><a href="<?php echo site_url('users'); ?>"> Users</a></li>
        <li class="active">Suspended Accounts</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="clearfix">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header"></div>
			<div class="box-body table-responsive">
			<?php 
				if($this->session->flashdata('users_fail') != ''){
                    echo '<div class="alert alert-danger">' . $this->session->flashdata('users_fail') . '</div>';
                }

                if($this->session->flashdata('users_success') != ''){
                    echo '<div class="alert alert-success">' . $this->session->flashdata('users_success') . '</div>';
                }

				if(!empty($suspended_users)){
			?>
	            <table id="example" class="table table-bordered table-striped datatable">
	                <thead>
	                <tr>
	                    <th>Id</th>
	                    <th>Name</th>
	                    <th>Email</th>
	                    <th>Mobile</th>
	                    <th>Actions</th>
	                </tr>
	                </thead>
	                <tbody>
	            	<?php foreach($suspended_users as $user){ ?>
	                <tr>
	                    <td><?php echo $user->id; ?></td>
	                    <td><?php echo $user->name; ?></td>
	                    <td><?php echo $user->email; ?></td>
	                    <td><?php echo $user->mobile; ?></td>
	                    <td style="width:10em;">
	                    	<a href="<?php echo site_url('users/revoke_suspension/' . $user->id); ?>" class="btn btn-warning btn-xs">
	                    		<i class="fa fa-times"></i> Revoke Suspension
	                    	</a>
	                    </td>
	                </tr>
	                <?php } ?>
	                </tbody>
	            </table>
	        <?php 
	        	}
				else{
					echo '<div class="alert alert-info">No suspended users found</div>';
				}
	        ?>
	        </div>
	    </div>
	</div>
</div>
</section>
</div>
