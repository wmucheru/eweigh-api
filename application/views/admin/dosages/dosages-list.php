<div class="clearfix">
    <div class="action-bar">
        <a class="btn btn-success btn-sm" href="<?php echo site_url('dosages/form'); ?>">+ Add Dosage</a>
    </div>

    <?php

        $dosages = $this->dosages_model->getDosages();

        # var_dump($dosages[0]);

        if(!empty($dosages)){
    ?>
    <table class="table table-striped table-bordered dt">
    <thead>
        <tr>
            <th>ID</th>
            <th>Disease</th>
            <th>Agent</th>
            <th>Dosage</th>
            <th>Application Mode</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($dosages as $d){
        ?>
        <tr>
            <td><?php echo $d->id; ?></td>
            <td><?php echo $d->disease; ?></td>
            <td><?php echo $d->agent; ?></td>
            <td><?php echo $d->dosage; ?></td>
            <td><?php echo $d->mode ?: '-'; ?></td>
            <td>
                <a href="<?php echo site_url('dosages/form/'. $d->id); ?>" class="btn btn-warning btn-xs">
                    <i class="ion-md-create"></i> Edit
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
            echo '<div class="alert alert-warning">No dosage list yet</div>';
        }
    ?>
</div>