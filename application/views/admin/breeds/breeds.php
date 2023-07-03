<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content clearfix">
        <div class="action-bar">
            <a class="btn btn-success btn-sm" href="<?php echo site_url('breeds/form'); ?>">+ Add Breed</a>
        </div>

        <?php
            # var_dump($breeds[0]);

            $this->site_model->setFlashdataMessages('breed');

            if(!empty($breeds)){
        ?>
        <table class="table table-striped table-bordered dt">
        <thead>
            <tr>
                <th>ID</th>
                <th>Breed</th>
                <th>Mature Weight (KG)</th>
                <th>Reference Weight (KG)</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($breeds as $b){
            ?>
            <tr>
                <td><?php echo $b->id; ?></td>
                <td><?php echo $b->breed; ?></td>
                <td><?php echo $b->matureweight; ?></td>
                <td><?php echo ceil($b->matureweight * 0.65); ?></td>
                <td><?php echo $this->site_model->date_format($b->createdon); ?></td>
                <td>
                    <a href="<?php echo site_url('breeds/form/'.$b->id); ?>" class="btn btn-warning btn-xs">
                        <i class="icon ion-md-create"></i> Edit
                    </a>
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
                echo '<div class="alert alert-warning">No breeds added yet</div>';
            }
        ?>
    </div>
</div>