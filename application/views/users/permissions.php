<div class="content-wrapper">

<section class="content-header">
    <hr />
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url('dashboard'); ?>"> Home</a></li>
        <li class="active">Group Permissions</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="clearfix">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="box-title">Groups</h4>
                        </div>
                        <div class="col-sm-6">
                            <div class="box-tools pull-right">
                                <?php $this->load->view('admin/users/add-group'); ?>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
                <?php if(!empty($groups)){ ?>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped dt">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Definition</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($groups as $group){ ?>
                        <tr>
                            <td><?php echo $group->id; ?></td>
                            <td><?php echo $group->name; ?></td>
                            <td><?php echo $group->definition; ?></td>
                            <td style="width:9em;">
                                <a href="<?php echo site_url('users/permissions/group/' . $group->id); ?>" 
                                    class="btn btn-warning btn-xs" data-toggle-="modal" data-target-="#pmModal"
                                    data-grpid="<?php echo $group->id; ?>">
                                    <i class="fa fa-lock"></i> Set Permissions
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php 
                    }
                    else{
                        echo '<div class="alert alert-info">No groups found</div>';
                    }
                ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="box-title">Permissions</h4>
                        </div>
                        <div class="col-sm-6">
                            <div class="box-tools pull-right">
                                <?php $this->load->view('admin/users/add-permissions'); ?>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="box-body table-responsive">
                <?php 

                    if($this->session->flashdata('perm_fail') != ''){
                        echo '<div class="alert alert-error">' . $this->session->flashdata('perm_fail') . '</div>';
                    }

                    if($this->session->flashdata('perm_success') != ''){
                        echo '<div class="alert alert-success">' . $this->session->flashdata('perm_success') . '</div>';
                    }
                    
                    # var_dump($perms);

                    if(!empty($perms)){
                ?>
                    <table class="table table-stripped table-condensed dt">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Definition</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($perms as $perm){ ?>
                        <tr>
                            <td><?php echo $perm->id; ?></td>
                            <td><?php echo $perm->name; ?></td>
                            <td><?php echo $perm->definition; ?></td>
                            <td>
                                <a href="<?php echo site_url('users/delete_perm/' . $perm->id); ?>" class="btn btn-danger btn-xs del"
                                    data-resource="permission">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php 
                    }
                    else{
                        echo '<div class="alert alert-info">No permissions found</div>';
                    }
                ?>
                </div>
            </div>
        </div>
        
    </div>
</section>

</div>
