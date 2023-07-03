<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content clearfix">
        <?php
            # var_dump($submissions[0]);

            $this->load->view('admin/submissions/submissions-list');
        ?>
    </div>
</div>