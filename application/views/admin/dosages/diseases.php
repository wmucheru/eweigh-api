<div class="clearfix">
    <div class="action-bar">
        <a class="btn btn-success btn-sm" href="<?php echo site_url('diseases/form'); ?>">+ Add Disease</a>
    </div>

    <?php

        $diseases = $this->dosages_model->getDiseases();

        # var_dump($diseases[0]);

        if(!empty($diseases)){
    ?>
    <table class="table table-striped table-bordered dt">
    <thead>
        <tr>
            <th>ID</th>
            <th>Disease</th>
            <th>Description</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($diseases as $d){
        ?>
        <tr>
            <td><?php echo $d->id; ?></td>
            <td><?php echo $d->disease; ?></td>
            <td><?php echo $d->description ?: '-'; ?></td>
            <td><?php echo $this->site_model->date_format($d->createdon); ?></td>
            <td>
                <a href="<?php echo site_url('diseases/form/'. $d->id); ?>" class="btn btn-warning btn-xs">
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
            echo '<div class="alert alert-warning">No diseases added yet</div>';
        }
    ?>
</div>