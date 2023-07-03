<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content clearfix">
        <?php
            # var_dump($cattle[0]);

            if(!empty($cattle)){
        ?>
        <table class="table table-striped table-bordered dt">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tag</th>
                <th>Breed</th>
                <th>Gender</th>
                <th>Farmer</th>
                <th>Live Weight (KG)</th>
                <th>Submissions</th>
                <th>Status</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($cattle as $c){
                    $status = $c->deleted ?
                        '<span class="label label-danger">Deleted</span>' :
                        '<span class="label label-success">Active</span>';
            ?>
            <tr>
                <td><?php echo $c->id; ?></td>
                <td><?php echo $c->tag; ?></td>
                <td><?php echo $c->breed; ?></td>
                <td><?php echo ucwords($c->gender); ?></td>
                <td><?php echo anchor('admin/farmers/'.$c->farmerid, $c->user, 'target="_blank"'); ?></td>
                <td><?php echo $c->lw ?: '-'; ?></td>
                <td><?php echo $c->submissions; ?></td>
                <td><?php echo $status; ?></td>
                <td><?php echo $this->site_model->date_format($c->createdon); ?></td>
                <td>
                    <?php echo anchor('admin/cattle/'.$c->id, '<i class="ion-md-eye"></i> View', 'class="btn btn-primary btn-xs"'); ?>
                </td>
            </tr>
            <?php
                } # ENDFOREACH: Loop items
            ?>
        </tbody>
        </table>
        <?php
            }
            else{
                echo '<div class="alert alert-warning">No cattle registered</div>';
            }
        ?>
    </div>
</div>