<div class="clearfix">
    <div class="page-header">
        <h1><?php echo isset($page_title) ? $page_title : ''; ?></h1>
    </div>

    <div class="page-content clearfix">
        <?php 

            $id = '';
            $breed = '';
            $matureWeight = '';

            # var_dump($breedObj);

            if(isset($breedObj->id)){
                $id = $breedObj->id;
                $breed = $breedObj->breed;
                $matureWeight = $breedObj->matureweight;
            }

            echo form_open('admin/breeds/saveBreed', 'class="form-horizontal col-md-8"');

            echo form_hidden('id', $id);
        ?>
        <fieldset>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">Breed</label>
                <div class="col-sm-6">
                    <input name="breed" type="text" class="form-control" 
                        value="<?php echo set_value('breed', $breed); ?>" required />
                    <?php echo form_error('breed'); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Mature Weight</label>  
                <div class="col-sm-6">
                    <input name="matureweight" type="number" step="any" class="form-control" 
                        value="<?php echo set_value('matureweight', $matureWeight); ?>" required />
                    <?php echo form_error('matureweight'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <hr/>
                    <button class="btn btn-block btn-warning">Save Breed</button>
                </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>