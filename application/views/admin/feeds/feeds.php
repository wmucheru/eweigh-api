<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content clearfix">
        <div class="action-bar">
            <a class="btn btn-success btn-sm" href="<?php echo site_url('feeds/form'); ?>">+ Add Feed</a>
        </div>

        <?php
            # var_dump($feeds[0]);

            $this->site_model->setFlashdataMessages('feed');

            if(!empty($feeds)){
        ?>
        <table class="table table-striped table-bordered dt">
        <thead>
            <tr>
                <th>ID</th>
                <th>Feed</th>
                <th>Feed Type</th>
                <th>Dry Matter</th>
                <th>Metabolizable Energy</th>
                <th>Crude Protein</th>
                <th>NDF</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($feeds as $f){
                    $feedType = $f->feedtype == 'forage' ? 
                        "<span class=\"label label-success\">$f->feedtype</span>" : 
                        "<span class=\"label label-danger\">$f->feedtype</span>";
            ?>
            <tr>
                <td><?php echo $f->id; ?></td>
                <td><?php echo $f->feed; ?></td>
                <td><?php echo $feedType; ?></td>
                <td><?php echo $f->drymatter; ?></td>
                <td><?php echo $f->energy; ?></td>
                <td><?php echo $f->protein; ?></td>
                <td><?php echo $f->ndf; ?></td>
                <td><?php echo $this->site_model->date_format($f->createdon); ?></td>
                <td>
                    <a href="<?php echo site_url('feeds/form/'.$f->id); ?>" class="btn btn-warning btn-xs">
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
                echo '<div class="alert alert-warning">No feeds added yet</div>';
            }
        ?>
    </div>
</div>