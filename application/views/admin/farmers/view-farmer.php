<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="clearfix">
        <hr/>
        <style>
        p{
            margin-bottom:8px;
        }
        </style>
        <div class="col-sm-3">
            <?php
                # var_dump($farmer);

                echo img('assets/img/user.png', $farmer->name, 'class="img-responsive" style="max-width:120px;"');

                echo "<br/><p><strong>Full Name: </strong>$farmer->name</p>";
                echo "<p><strong>Email: </strong>$farmer->email</p>";
                echo "<p><strong>Mobile: </strong>$farmer->mobile</p>";
                echo "<p><strong>County: </strong>$farmer->county</p>";
                echo "<p><strong>Registered On: </strong>$farmer->createdon</p>";
            ?>
        </div>

        <div class="page-content col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#cattle" data-toggle="tab">Cattle</a>
                </li>

                <li>
                    <a href="#submissions" data-toggle="tab">Submissions</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="cattle">
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
                            <td><?php echo $c->lw ?: '-'; ?></td>
                            <td><?php echo $c->submissions; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $this->site_model->date_format($c->createdon); ?></td>
                            <td>
                                <?php echo anchor('admin/cattle/'.$c->id, '<i class="ion-md-create"></i> Edit', 'class="btn btn-warning btn-xs"'); ?>
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

                <div class="tab-pane" id="submissions">
                    <?php
                        # var_dump($submissions[0]);

                        if(!empty($submissions)){
                    ?>
                    <table class="table table-striped table-bordered dt">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                            <td><?php echo $s->hg; ?></td>
                            <td><?php echo $s->lw; ?></td>
                            <td><?php echo $s->lat; ?></td>
                            <td><?php echo $s->lng; ?></td>
                            <td><?php echo $s->county; ?></td>
                            <td><?php echo $this->site_model->date_format($s->createdon); ?></td>
                            <td>
                                <!-- <a href="<?php echo site_url('admin/submissions/'.$s->id); ?>" class="btn btn-warning btn-xs">Edit</a> -->
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
                            echo '<div class="alert alert-warning">No submissions added yet</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>