<div class="clearfix">
    <div class="action-bar">
        <a class="btn btn-success btn-sm" href="<?php echo site_url('agents/form'); ?>">+ Add Chemical Agent</a>
    </div>

    <?php

        $agents = $this->dosages_model->getChemicalAgents();

        # var_dump($agents[0]);

        if(!empty($agents)){
    ?>
    <table class="table table-striped table-bordered dt">
    <thead>
        <tr>
            <th>ID</th>
            <th>Proprietary Name</th>
            <th>Agent</th>
            <th>Application Mode</th>
            <th>Dosage Basis</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($agents as $a){
        ?>
        <tr>
            <td><?php echo $a->id; ?></td>
            <td><?php echo $a->proprietaryname; ?></td>
            <td><?php echo $a->agent; ?></td>
            <td><?php echo $a->mode ?: '-'; ?></td>
            <td><?php echo $a->basis; ?></td>
            <td><?php echo $this->site_model->date_format($a->createdon); ?></td>
            <td>
                <a href="<?php echo site_url('agents/form/'. $a->id); ?>" class="btn btn-warning btn-xs">
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
            echo '<div class="alert alert-warning">No chemical agents added yet</div>';
        }
    ?>
</div>