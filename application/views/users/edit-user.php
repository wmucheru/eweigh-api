<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content col-sm-8">
        <?php $this->load->view('users/add-user-form'); ?>
    </div>
</div>