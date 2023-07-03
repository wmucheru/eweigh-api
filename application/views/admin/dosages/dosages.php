<style>
.page-wrapper{
    background:transparent;
    padding:0;
}
</style>

<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content clearfix" style="background:#fff; padding:0.5em 1em;">
        <?php

            $this->site_model->setFlashdataMessages('dosage');
        ?>
        
        <div class="clearfix">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#dosages" data-toggle="tab">Dosages</a>
                </li>
                <li>
                    <a href="#agents" data-toggle="tab">Agents</a>
                </li>
                <li>
                    <a href="#diseases" data-toggle="tab">Diseases</a>
                </li>
            </ul>
        
            <div class="tab-content">
                <div class="tab-pane active" id="dosages">
                    <?php $this->load->view('admin/dosages/dosages-list'); ?>
                </div>

                <div class="tab-pane" id="agents">
                    <?php $this->load->view('admin/dosages/agents'); ?>
                </div>

                <div class="tab-pane" id="diseases">
                    <?php $this->load->view('admin/dosages/diseases'); ?>
                </div>
            </div>
        </div>
        
    </div>
</div>