<div class="clearfix">
    <?php
        # var_dump($submissions[0]);

        if(!empty($submissions)){
    ?>
    <table class="table table-striped table-bordered dt">
    <thead>
        <tr>
            <th>ID</th>
            <th>Farmer</th>
            <th>Heart Girth (cm)</th>
            <th>Live Weight (kg)</th>
            <th>Lat</th>
            <th>Lng</th>
            <th>County</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($submissions as $s){
        ?>
        <tr>
            <td><?php echo $s->id; ?></td>
            <td><?php echo $s->user; ?></td>
            <td><?php echo $s->hg; ?></td>
            <td><?php echo $s->lw; ?></td>
            <td><?php echo $s->lat; ?></td>
            <td><?php echo $s->lng; ?></td>
            <td><?php echo $s->county; ?></td>
            <td><?php echo $this->site_model->date_format($s->createdon); ?></td>
            <td>-</td>
        </tr>
        <?php
            } # ENDFOREACH: Loop items
        ?>
    </tbody>
    </table>
    <?php
        }
        else{
            echo '<div class="alert alert-warning">No submissions added yet</div>';
        }
    ?>
</div>