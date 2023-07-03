<div class="container">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>
    
    <div class="page-content clearfix">
        <div class="col-sm-8">
            <?php
                $formObj = $this->members_model->getMemberForm($memberId);
                echo $this->form_model->buildForm($formObj);
            ?>
        </div>
    </div>
</div>