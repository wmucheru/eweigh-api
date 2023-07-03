<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content">
        <?php
            # var_dump($farmers[0]);

            if(!empty($farmers)){
        ?>
        <table class="table table-striped table-bordered dt">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Tag</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Id Number</th>
                <th>County</th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($farmers as $f){
            ?>
            <tr>
                <td><?php echo $f->id; ?></td>
                <td><?php echo $f->name; ?></td>
                <td><?php echo $f->tag; ?></td>
                <td><?php echo $f->email; ?></td>
                <td><?php echo $f->mobile; ?></td>
                <td><?php echo !empty($f->idno) ? $f->idno : '-'; ?></td>
                <td><?php echo $f->county; ?></td>
                <td><?php echo $this->site_model->date_format($f->createdon); ?></td>
                <td>
                    <a href="<?php echo site_url('admin/farmers/'.$f->id); ?>" class="btn btn-primary btn-xs">
                        <i class="ion-md-eye"></i> View
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
                echo '<div class="alert alert-warning">No farmers registered</div>';
            }
        ?>
    </div>
</div>