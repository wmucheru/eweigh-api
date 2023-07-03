<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content clearfix">
        <?php 

            $id = '';
            $disease = '';
            $description = '';

            # var_dump($diseaseObj);

            if(isset($diseaseObj->id)){
                $id = $diseaseObj->id;
                $disease = $diseaseObj->disease;
                $description = $diseaseObj->description;
            }

            echo form_open('admin/dosages/saveDisease', 'class="form-horizontal col-md-8"');

            echo form_hidden('id', $id);
        ?>
        <fieldset>
            <div class="form-group">
                <label class="col-sm-3 control-label">Disease</label>
                <div class="col-sm-6">
                    <input name="name" type="text" class="form-control" 
                        value="<?php echo set_value('name', $disease); ?>" required />
                    <?php echo form_error('name'); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control" rows="4"
                        required><?php echo set_value('description', $description); ?></textarea>
                    <?php echo form_error('description'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <hr/>
                    <button class="btn btn-block btn-warning">Save Disease</button>
                </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>